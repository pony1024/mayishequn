<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index()//主页
    {
        $uid = I('get.uid');
        $userinfo = [];
        if($uid==""){
            $uid=session('memberid');
        }
        if($uid==""){
            checkuser();
        }else{
            $userinfo = M('member')->where(["id"=>$uid])->find();
        }
        if(sizeof($userinfo)==0){
            errmsg("用户不存在");
        }
        $userinfo["qrcount"] = M('qrcode')->where(["memberid"=>$uid])->count();
        $userinfo["zan"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('zan'));
        $userinfo["see"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('see'));
        $map["memberid"] = $uid;
        $count  = M('qrcode')->where($map)->count();// 查询满足要求的总记录数
        $Page   = new \Think\Page($count,20);// 实例化分页类
        $show   = $Page->show();// 分页显示输出
        $qrdata = M('qrcode')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        if(sizeof($qrdata)){
            foreach ($qrdata as &$d){
                $d["nickname"] = $userinfo["name"];
                $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
            }
        }
        $app_type = M("app_type")->getField("id,name");
        $qr_type = M("qr_type")->getField("id,name");
        $this->assign("app_type",$app_type);
        $this->assign("qr_type",$qr_type);
        $this->assign("qrdata",$qrdata);
        $this->assign("userinfo",$userinfo);
        $this->assign("page",$show);
        $this->display();
    }
    public function info()//资料
    {
        if(IS_AJAX){
            $select['id'] = session("memberid");
            $data['name'] = I("post.name");
            $data['remark'] = I("post.remark");
            $res["success"] = false;
            if(I("post.pwd")!=""){
                if(preg_match('/[^0-9a-zA-Z_]/', I("post.pwd"))>0){
                    $res["msg"] = "密码只能包含大小写字母、数字和下划线";
                }elseif(!(strlen(I("post.pwd"))>5&&strlen(I("post.pwd"))<17)){
                    $res["msg"] = "密码长度位6-16位";
                }elseif(!(mb_strlen($data['name'])>0&&mb_strlen($data['name'])<9)){
                    $res["msg"] = "昵称长度为1-8位";
                }elseif(!(mb_strlen($data['remark'])>0&&mb_strlen($data['remark'])<16)){
                    $res["msg"] = "签名长度为1-15位";
                }else{
                    $data['pwd'] = I("post.pwd");
                    M('member')->where($select)->save($data);
                    $res["success"] = true;
                }
            }else{
                if(!(mb_strlen($data['name'])>0&&mb_strlen($data['name'])<9)){
                    $res["msg"] = "昵称长度为1-8位";
                }elseif(!(mb_strlen($data['remark'])>0&&mb_strlen($data['remark'])<16)){
                    $res["msg"] = "签名长度为1-15位";
                }else{
                    M('member')->where($select)->save($data);
                    $res["success"] = true;
                }

            }


            $this->ajaxReturn($res);
        }
        $userinfo = [];
        $uid=session('memberid');
        if($uid==""){
            checkuser();
        }else{
            $userinfo = M('member')->where(["id"=>$uid])->find();
        }
        if(sizeof($userinfo)==0){
            errmsg("用户不存在");
        }
        $userinfo["qrcount"] = M('qrcode')->where(["memberid"=>$uid])->count();
        $userinfo["zan"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('zan'));
        $userinfo["see"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('see'));
        $this->assign("userinfo",$userinfo);
        $this->display();
    }
}