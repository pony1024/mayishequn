<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index()//代理管理
    {
        if (IS_AJAX){
            $select["id"] = I("post.id");
            $res["success"] = false;
            if ($select["id"]!=""){
                $user = M("member")->where($select)->find();
                $ip = $user["ip"];
                $port = $user["port"];
                $rate = $user["rate"];
                $balance = curl_get("http://".$ip.":".$port."/payweb/api/proxy/searchAdminMoney");
                $orderAmount = curl_get("http://".$ip.":".$port."/payweb/api/proxy/sumOrderAmountCompleteByDate?startCompleteDate=0&endCompleteDate=".time()."000");
                $balance = $balance - ($orderAmount*$rate);
                $res["msg"] = $balance;
                $res["success"] = true;
            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $map = [];
        $stime = I("get.stime");
        $etime = I("get.etime");
        $username = I("get.username");
        if($stime!=""&&$etime!=""){
            $map["createtime"] = ["between",[strtotime($stime),strtotime($etime)]];
            $this->assign("time",[$stime,$etime]);
        }
        if($username!=""){
            $map["name"] = ["like","%".$username."%"];
            $this->assign("user",$username);
        }
        $list = M("member")->where($map)->select();
        $count = M("member")->where($map)->count();
        foreach ($list as &$li){
            $ip = $li["ip"];
            $port = $li["port"];
            $html = curl_get("http://".$ip.":".$port."/payweb/api/proxy/test");
            if (!!json_decode($html,true)){
                $li["status"] = 1;
            }else{
                $li["status"] = 0;
            }
        }
        $this->assign("count",$count);
        $this->assign("list",$list);
        $this->display();
    }
    public function show() // 显示代理详细信息
    {
        $select["id"] = I("get.id");
        if ($select["id"]!=""){
            $user = M("member")->where($select)->find();
            $ip = $user["ip"];
            $port = $user["port"];
            $rate = $user["rate"];
            $balance = curl_get("http://".$ip.":".$port."/payweb/api/proxy/searchAdminMoney");
            $orderAmount = curl_get("http://".$ip.":".$port."/payweb/api/proxy/sumOrderAmountCompleteByDate?startCompleteDate=0&endCompleteDate=".time()."000");
            $user["balance"] = $balance - ($orderAmount*$rate);
            $user["balance_true"] = $balance;
            $user["orderAmount"] = $orderAmount;
            $this->assign("user",$user);
            $this->display();
        }else{
         $this->error("参数错误");
        }
    }
    public function topup() // 充值
    {
        if (IS_AJAX){
            $res["success"] = false;
            $select["id"] = I("post.id");
            $data["member_id"] = I("post.id");
            $data["amount"] = I("post.amount");
            if(I("post.password")==session("password")){
                if($select["id"]!=""&&$data["amount"]){
                    $data["amount"] = number_format($data["amount"],1,'.','');
                    if($data["amount"]==I("post.amount")){
                        $user = M("member")->where($select)->find();
                        $data["member_name"] = $user["name"];
                        $data["admin_name"] = session("username");
                        $data["admin_id"] = session("userid");
                        $data["create_time"] = time();
                        $data["complete_time"] = time();
                        $data["order_no"] = strtoupper(substr(md5(json_encode($data)),8,20));
                        $data["type"] = "1";
                        $data["status"] = "1";
                        $name = $user["usr"];
                        $ip = $user["ip"];
                        $port = $user["port"];
                        $html = curl_post("http://".$ip.":".$port."/payweb/api/proxy/addAdeminMoney",json_encode(["money"=>$data["amount"],"key"=>md5($data["amount"]."Qwe123456.".$name)]));
                        if ($html == "true"){
                            M("orders")->lock(true)->data($data)->add();
                            $res["success"] =true;
                        }else{
                            $res["msg"] = "提交失败";
                        }
                    }else{
                        $res["msg"] = "金额不正确";
                    }

                }
            }else{
                $res["msg"] = "密码错误";
            }
            $this->ajaxReturn($res);
        }
    }
    public function edit() // 编辑代理
    {
        if (IS_AJAX){
            $res["success"] = false;
            $select["id"] = I("post.id");
            $data["rate"] = I("post.rate");
            if(I("post.contact")!=""){
                $data["contact"] = I("post.contact");
            }
            if(I("post.remark")!=""){
                $data["remark"] = I("post.remark");
            }
            if($select["id"]!=""&&$data["rate"]!=""){
                $data["rate"] = $data["rate"]/1000;
                $user = M("member")->where($select)->find();
                $name = $user["usr"];
                $ip = $user["ip"];
                $port = $user["port"];
                if($data["rate"]!=$user["rate"]){
                    $html = curl_post("http://".$ip.":".$port."/payweb/api/proxy/setAdmingHandlin",json_encode(["handlin"=>$data["rate"],"key"=>md5($data["rate"]."Qwe123456.".$name)]));
                    if($html=="true"){
                        M("member")->where($select)->save($data);
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "设置费率失败";
                    }
                }else{
                    M("member")->where($select)->save($data);
                    $res["success"] = true;
                }

            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $select["id"] = I("get.id");
        if ($select["id"]!=""){
            $user = M("member")->where($select)->find();
            $this->assign("user",$user);
            $this->display();
        }else{
            $this->error("参数错误");
        }
    }
    public function add(){//添加代理
        if (IS_AJAX){
            $data["name"] = I("post.name");
            $data["usr"] = I("post.username");
            $password = I("post.password");
            $data["ip"] = I("post.domain");
            $data["port"] = I("post.port");
            $data["rate"] = I("post.rate");
            $res["success"] = false;
            if(I("post.contact")!=""){
                $data["contact"] = I("post.contact");
            }
            if(I("post.remark")!=""){
                $data["remark"] = I("post.remark");
            }
            $num = 0;
            foreach ($data as $item){
                if($item == ""){//如果必填项为空
                    $num = 1;
                    break;
                }
            }
            if($num==0){
                if(sizeof(M("member")->where(["name"=>$data["name"]])->find())==0){
                    $data["rate"] = $data["rate"]/1000;
                    $html = curl_post("http://".$data["ip"].":".$data["port"]."/payweb/api/proxy/addAdmin",json_encode(["loginName"=>$data["usr"],"password"=>$password,"rate"=>$data["rate"]]));
                    $json = json_decode($html,true);
                    if(!!$json){
                        if($json["code"]=="000"){
                            $data["createtime"] = time();
                            M("member")->data($data)->add();
                            $res["success"] = true;
                        }else{
                            $res["msg"] = $json["message"];
                        }
                    }else{
                        $res["msg"] = "代理服务器不存在或网络异常！";
                    }
                }else{
                    $res["msg"] = "代理商户名已存在";
                }
            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $this->display();
    }
}