<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct()
    {
        parent::__construct();
        if(SC('site_status')=="0"){
            $this->display("Public:siteoff");
            die;
        }
        $userid = session("memberid");
        $menu = M('menu')->select();
        foreach ($menu as &$item){
            $submenu = M('app_type')->where(["menuid"=>$item["id"]])->select();
            if(sizeof($submenu)){
                $item['submenu'] = $submenu;
            }
        }
        $area = M('area')->where('pid=0')->select();
        $this->assign("menu",$menu);
        $this->assign("area",$area);
    }

}