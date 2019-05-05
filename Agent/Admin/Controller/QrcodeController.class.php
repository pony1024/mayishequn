<?php
namespace Admin\Controller;
use Think\Controller;
class QrcodeController extends BaseController {
    public function index()
    {
        if(IS_AJAX){
            $type = I("post.type");
            $res["success"] = false;
            switch($type){
                case "pass":
                    $select["id"] = I("post.id");
                    if($select["id"]!=""){
                        M("qrcode")->where($select)->setField('status','1');
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "参数错误";
                    }
                    break;
                case "top":
                    $select["id"] = I("post.id");
                    $time = I("post.time");
                    if($select["id"]!=""&&$time!=""){
                        $time = time()+(intval($time)*3600);
                        M("qrcode")->where($select)->setField('top_time',$time);
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "参数错误";
                    }
                    break;
                case "del":
                    $select["id"] = I("post.id");
                    if($select["id"]!=""){
                        M("qrcode")->where($select)->delete();
                        $res["success"] = true;
                    }
                    break;
                default:
                    $res["msg"] = "参数错误";
                    break;
            }
            $this->ajaxReturn($res);
        }
        $map = [];
        $stime = I("get.stime");
        $etime = I("get.etime");
        $username = I("get.username");
        if($stime!=""&&$etime!=""){
            $map["create_time"] = ["between",[strtotime($stime),strtotime($etime)+(24*60*60)]];
            $this->assign("time",[$stime,$etime]);
        }
        if($username!=""){
            $map["name"] = ["like","%".$username."%"];
            $this->assign("user",$username);
        }
        $count  = M('qrcode')->where($map)->count();// 查询满足要求的总记录数
        $Page   = new \Think\Page($count,20);// 实例化分页类
        $show   = $Page->show();// 分页显示输出
        $qrdata = M('qrcode')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        if(sizeof($qrdata)){
            foreach ($qrdata as &$d){
                $d["user"] = M("member")->where(['id'=>$d['memberid']])->getField("user,name");
                $d["menu"] = M('menu')->where(["id"=>$d["menuid"]])->getField("name");
                $d["app_typename"] = M('app_type')->where(["id"=>$d["app_type"]])->getField("name");
                $d["qr_typename"] = M('qr_type')->where(["id"=>$d["qr_type"]])->getField("name");
                $d["areaname"] = M("area")->where(['id'=>$d['area']])->getField("name");
                $d["countryname"] = M("country")->where(['id'=>$d['country']])->getField("name");
                $d["cityname"] = M("city")->where(['id'=>$d['city']])->getField("name");

            }
        }
        $this->assign("qrdata",$qrdata);
        $this->assign("page",$show);
        $this->display();
    }
}