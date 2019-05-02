<?php
namespace Home\Controller;
use Think\Controller;
use Think\Think;

class AreaController extends BaseController
{
    public function getcountry(){
        $pid = I("get.pid");
        $res["success"] = false;
        if($pid!=""){
            $res["success"] = true;
            $res["msg"] = M('country')->where(["pid"=>$pid])->select();
        }else{
            $res["msg"] = "参数错误";
        }
        $this->ajaxReturn($res);
    }
    public function getcity(){
        $pid = I("get.pid");
        $res["success"] = false;
        if($pid!=""){
            $res["success"] = true;
            $res["msg"] = M('city')->where(["pid"=>$pid])->select();
        }else{
            $res["msg"] = "参数错误";
        }
        $this->ajaxReturn($res);
    }
}