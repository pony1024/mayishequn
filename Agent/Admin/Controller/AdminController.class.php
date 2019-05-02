<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController {
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
    public function add() //添加管理员
    {
        if(IS_AJAX){
            $data["user"] = I("post.username");
            $data["pwd"] = I("post.password");
            $data["role"] = I("post.role");
            $data["remark"] = I("post.remark");
            $res["success"] = false;
            if ($data["user"]!=""&&$data["pwd"]!=""&&$data["role"]!=""){
                if(sizeof(M("manager")->where(["user"=>  $data["user"]])->find())==0){
                    $data["createtime"] = time();
                    $data["status"] = "1";
                    M("manager")->data($data)->add();
                    $res["success"] = true;
                }else{
                    $res["msg"] = "用户已存在";
                }
            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $role = M("auth_role")->select();
        $this->assign("role",$role);
        $this->display();
    }
    public function edit() //修改管理员
    {
        if(IS_AJAX){
            $select["id"] = I("post.id");
            if(I("post.password")!=""){
                $data["pwd"] = I("post.password");
            }
            $data["role"] = I("post.role");
            $data["remark"] = I("post.remark");
            $res["success"] = false;
            if ($select["id"]!=""&&$data["role"]!=""){
                M("manager")->where(["id"=> $select["id"]])->save($data);
                $res["success"] = true;
            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $id = I("get.id");
        if($id!=""){
            $role = M("auth_role")->select();
            $user = M("manager")->where(["id"=> $id])->find();
            $this->assign("role",$role);
            $this->assign("user",$user);
            $this->display();
        }else{
            $this->error("参数错误");
        }

    }
    public function role()//角色管理
    {
        if(IS_AJAX){
            //删除角色
            $res["success"] = false;
            $select["id"] = I("post.id");
            M("auth_role")->where($select)->delete();
            $res["success"] = true;
            $this->ajaxReturn($res);
        }
        $count = M("auth_role")->count();
        $list = M("auth_role")->select();
        foreach ($list as &$li){
            $auths = M("auth_rule")->where(["id"=>["in",$li["auth"]]])->getField("name",true);
            $li["authname"] = join(",",$auths);
        }
        $this->assign("count",$count);
        $this->assign("list",$list);
        $this->display();
    }
    public function role_edit()//角色编辑
    {
        if(IS_AJAX){
            $select["id"] = I("post.id");
            $data["name"] = I("post.name");
            $data["auth"] = I("post.auth");
            $data["remark"] = I("post.remark");
            $res["success"] = false;
            if ($select["id"]!=""&&$data["name"]!=""&&$data["auth"]!=""){
                M("auth_role")->where(["id"=> $select["id"]])->save($data);
                $res["success"] = true;
            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }
        $role["id"] = I("get.id");
        if($role["id"]!=""){
            $role = M("auth_role")->where($role)->find();//当权角色拥有的信息
            $auths = M("auth_rule")->where(["level"=>"1"])->select();//所有权限
            foreach ($auths as &$item){
                $item["childen"] =  M("auth_rule")->where(["pid"=>$item["id"]])->select();
            }
            $this->assign("role",$role);
            $this->assign("auths",$auths);
            $this->display();
        }else{
            $this->error("参数错误");
        }

    }
    public function role_add()//添加角色
    {
        if(IS_AJAX){
            $select["name"] = I("post.name");
            $data["name"] = I("post.name");
            $data["auth"] = I("post.auth");
            $data["remark"] = I("post.remark");
            $res["success"] = false;
            if ($data["name"]!=""&&$data["auth"]!=""){
                if(sizeof(M("auth_role")->where($select)->find())==0){
                    M("auth_role")->data($data)->add();
                    $res["success"] = true;
                }else{
                    $res["msg"] = "角色已存在";
                }

            }else{
                $res["msg"] = "参数错误";
            }
            $this->ajaxReturn($res);
        }

        $auths = M("auth_rule")->where(["level"=>"1"])->select();//所有权限
        foreach ($auths as &$item){
            $item["childen"] =  M("auth_rule")->where(["pid"=>$item["id"]])->select();
        }
        $this->assign("auths",$auths);
        $this->display();

    }
    public function cate()//权限分类
    {
        if(IS_AJAX){
            $type = I("post.type");
            $res["success"] = false;
            switch ($type){
                case "add":
                    $data["name"] = I("post.name");
                    $data["classname"] = I("post.classname");
                    $data["level"] = "1";
                    if(sizeof(M("auth_rule")->where(["name"=>$data["name"]])->find())==0){
                        M("auth_rule")->lock(true)->data($data)->add();
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "权限已存在";
                    }
                    break;
                case "del":
                    $data["id"] = I("post.id");
                    if(sizeof(M("auth_rule")->where(["id"=>$data["id"]])->find())>0){
                        M("auth_rule")->where($data)->delete();
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "权限不存在";
                    }
                    break;
                default:
                    $res["msg"] = "参数错误";
                    break;
            }
            $this->ajaxReturn($res);
        }
        //$count = M("auth_rule")->where(["level"=>"1"])->count();
        $list = M("auth_rule")->where(["level"=>"1"])->select();
        //$this->assign("count",$count);
        $this->assign("list",$list);
        $this->display();
    }
    public function rule()//权限管理
    {
        if(IS_AJAX){
            $type = I("post.type");
            $res["success"] = false;
            switch ($type){
                case "add":
                    $data["pid"] = I("post.pid");
                    $data["rules"] = I("post.rules");
                    $data["name"] = I("post.name");
                    $data["level"] = I("post.level");
                    if(sizeof(M("auth_rule")->where(["rules"=>$data["rules"]])->find())==0){
                        M("auth_rule")->lock(true)->data($data)->add();
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "权限已存在";
                    }
                    break;
                case "del":
                    $data["id"] = I("post.id");
                    if(sizeof(M("auth_rule")->where(["id"=>$data["id"]])->find())>0){
                        M("auth_rule")->where($data)->delete();
                        $res["success"] = true;
                    }else{
                        $res["msg"] = "权限不存在";
                    }
                    break;
                default:
                    $res["msg"] = "参数错误";
                    break;
            }
            $this->ajaxReturn($res);
        }
        $type = M("auth_rule")->where(["level"=>"1"])->getField("id,name");
        $list = M("auth_rule")->where(["level"=>["gt","1"]])->select();
        //$count = M("auth_rule")->where(["level"=>["gt","1"]])->count();
        $this->assign("type",$type);
        $this->assign("list",$list);
        //$this->assign("count",$count);
        $this->display();
    }
}