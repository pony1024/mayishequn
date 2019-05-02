<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends BaseController {
    public function index() //管理员列表
    {
        if(IS_AJAX){
            $type = I("post.type");
            $res["success"] = false;
            switch($type){
                case "set":
                    $select["id"] = I("post.id");
                    $data["status"] = I("post.status");
                    if($select["id"]!=""&&$data["status"]!=""){
                        M("manager")->where($select)->save($data);
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "参数错误";
                    }
                    break;
                case "del":
                    $select["id"] = I("post.id");
                    M("manager")->where($select)->delete();
                    $res["success"] = true;
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
            $map["createtime"] = ["between",[strtotime($stime),strtotime($etime)]];
            $this->assign("time",[$stime,$etime]);
        }
        if($username!=""){
            $map["user"] = $username;
            $this->assign("user",$username);
        }
        $list = M("manager")->where($map)->select();
        $count = M("manager")->where($map)->count();
        $role = M("auth_role")->getField("id,name");
        $this->assign("count",$count);
        $this->assign("list",$list);
        $this->assign("role",$role);
        $this->display();
    }
}