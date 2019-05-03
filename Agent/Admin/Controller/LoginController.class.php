<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        if(isset($_SESSION["userid"])){
            header("Location:".U("Index/index"));
        }
        if(IS_AJAX){
            $res["success"] = false;
            $map["user"] = I("post.username");
            $map["pwd"] = I("post.password");
            $user = M("manager")->where($map)->find();
            if(sizeof($user)>0){
                if($user["status"]=="0"){
                    $res["msg"] = "登录失败，账号被禁用！";
                    logs("登录","账号被禁用",$map["user"]);
                }else{
                    session("userid",$user["id"]);
                    session("role",$user["role"]);
                    session("a_username",$user["user"]);
                    session("a_password",$map["pwd"]);
                    session("a_lastip",$user["lastip"]);
                    session("a_lasttime",$user["lasttime"]);
                    session("dex",$user["dex"]+1);
                    M("manager")->where($map)->save(["lastip"=>$_SERVER["REMOTE_ADDR"],"lasttime"=>time(),"dex"=>$user["dex"]+1]);
                    $res["success"] = true;
                    logs("登录","登录成功",$map["user"]);
                }
            }else{
                $res["msg"] = "登录失败，用户不存在！";
                logs("登录","登录失败",$map["user"]);
            }
            $this->ajaxReturn($res);
        }
        $this->display();
    }
    public function logout(){
        logs("注销","正常",session("a_username"));
        session_unset();
        header("Location:".U("Login/index"));
    }
}