<?php
namespace Home\Controller;
use Think\Controller;
class DownController extends BaseController {
    public function index()//代理管理
    {
        $uuid = I('get.uuid');
        $appinfo['uuid'] = str_replace('.mobileconfig','',$uuid);
        $appinfo['url'] = "http://www.mysq.gq/if.html";
        $appinfo['title'] = "mayishequn";
        $this.$this->assign("appinfo",$appinfo);
        $this->display('','','application/octet-stream');
    }
}