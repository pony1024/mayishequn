<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION["userid"])){
            header("Location:".U("Login/index"));
            return;
        }
        $userid = session("userid");
        //var_dump(M("manager")->where(["id"=>$userid])->find());
        if(M("manager")->where(["id"=>$userid])->find()["status"]=="0"){
            header("Location:".U('Login/logout'));
        }
        $username = session("username");
        $role = session("role");//权限组
        $auth = M("auth_role")->where(["id"=>$role])->find()["auth"];//获取权限组信息

        //获取菜单权限
        $menu = M("auth_rule")->where(["level"=>"1","id"=>["in",$auth]])->select();
        foreach ($menu as &$item){
            $item["childen"] =  M("auth_rule")->where(["level"=>"2","pid"=>$item["id"],"id"=>["in",$auth]])->select();
        }
        $this->assign("menu",$menu);
        //判断当前访问权限
        $rules = CONTROLLER_NAME."/".ACTION_NAME; //当前访问权限规则
        $rule = M("auth_rule")->where(["rules"=>$rules])->find();//当前访问规则
        $ruleid = $rule["id"];//当前访问规则id
        $rulename = $rule["name"];//当前访问规则名称
        $supername = M("auth_rule")->where(["id"=>$rule["pid"]])->find()["name"];//当前访问规则名称
        $this->assign("supername",$supername);
        $this->assign("rulename",$rulename);
        $num = 0;
        $auths = explode(",",$auth);
        foreach($auths as $id){//寻找权限
            if($id==$ruleid){
                $num = $id;
            }
        }
        if($num == 0&&CONTROLLER_NAME!="Index"){//无权限访问呢
            if(IS_AJAX){
                $this->ajaxReturn(["success"=>false,"msg"=>"没有权限访问"]);
            }else{
                $this->error("没有权限访问");
            }
            logs($rulename,"无权限",$username);
        }else{
            logs($rulename,"正常",$username);
        }
    }

}