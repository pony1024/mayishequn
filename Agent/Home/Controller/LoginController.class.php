<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
        if(isset($_SESSION["memberid"])){
            header("Location:".U("Index/index"));
        }
        if(IS_AJAX){
            $res["success"] = false;
            $map["user"] = strtolower(I("post.username"));
            $map["pwd"] = I("post.password");
            $user = M("member")->where($map)->find();
            if(sizeof($user)>0){
                if($user["status"]=="0"){
                    $res["msg"] = "登录失败，账号被禁用！";
                }else{
                    session("memberid",$user["id"]);
                    session("nickname",$user["name"]);
                    session("username",$user["user"]);
                    session("password",$map["pwd"]);
                    session("lastip",$user["lastip"]);
                    session("lasttime",$user["lasttime"]);
                    M("member")->where($map)->save(["lastip"=>$_SERVER["REMOTE_ADDR"],"lasttime"=>time()]);
                    $res["success"] = true;
                }
            }else{
                $res["msg"] = "登录失败，账号或密码错误！";
            }
            $this->ajaxReturn($res);
        }
        $this->display();
    }
    public function register(){
        if(isset($_SESSION["memberid"])){
            header("Location:".U("Index/index"));
        }
        if(IS_AJAX){
            $res["success"] = false;
            if(SC('reg_status')=="1"){
                $map["user"] = strtolower(I("post.username"));
                $map["mail"] = I("post.email");
                if($map["user"]!=""&&$map["mail"]!=""&&strlen($map["user"])>2&&strlen($map["user"])<12&&stripos($map["mail"],"@")!==false&&preg_match('/[^0-9a-zA-Z]/', $map["user"])==0){
                    $map["_logic"] = "or";
                    $user = M("member")->where($map)->find();
                    if(sizeof($user)>0){
                        if($user["user"]==$map["user"]&&$user["mail"]==$map["mail"]){
                            if(sendMail($user["mail"],"恭喜您的蚂蚁社群账号注册成功！","您的初始密码为 ".$user["pwd"]." 请尽快登录修改密码！")){
                                $res["success"] = true;
                            }else{
                                $res["msg"] = "网络错误，请稍后重试！";
                            }
                        }else{
                            if($user["user"]==$map["user"]){
                                $res["msg"] = "账号已存在！";
                            }else{
                                $res["msg"] = "邮箱已被注册！";
                            }
                        }
                    }else{
                        $map["pwd"] = rand(400000,999999);
                        $map["name"] = "小蚂蚁".$map["user"];
                        $map["createtime"] = time();
                        $map["status"] = "1";
                        $map["vcode"] = strtoupper(substr(md5($map["mail"].$map["createtime"]),8,16));
                        M('member')->data($map)->add();
                        if(sendMail($map["mail"],"恭喜您的蚂蚁社群账号注册成功！","您的初始密码为 ".$map["pwd"]." 请尽快登录修改密码！")){
                            $res["success"] = true;
                        }else{
                            $res["msg"] = "网络错误，请稍后重试！";
                        }
                    }
                }else{
                    if($map["user"]==""){
                        $res["msg"] = "账号不能为空，请检查！";
                    }elseif ($map["mail"]==""){
                        $res["msg"] = "邮箱不能为空，请检查！";
                    }elseif (!(strlen($map["user"])>2&&strlen($map["user"])<12)){
                        $res["msg"] = "账号长度为5-11位，请检查！";
                    }elseif (stripos($map["mail"],"@")===false){
                        $res["msg"] = "邮箱格式不正确，请检查！";
                    }elseif (preg_match('/[^0-9a-zA-Z]/', $map["user"])>0){
                        $res["msg"] = "账号只能包含字母和数字，请检查！";
                    }
                }
            }else{
                $res["msg"] = "网站已关闭用户注册，请联系管理员！";
            }
            $this->ajaxReturn($res);
        }
        $this->display();
    }
    public function logout(){
        session_unset();
        header("Location:".U("Index/index"));
    }
}