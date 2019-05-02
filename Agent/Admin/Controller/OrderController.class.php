<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController {
    public function index()
    {
        $orders = M("orders")->select();
        $this->assign("orders",$orders);
        $this->display();
    }
    public function index_ag()
    {
        $map = [];
        $stime = I("get.stime");
        $etime = I("get.etime");
        $id = I("get.id");
        if($id!=""&&$stime!=""&&$etime!=""){
            $user = M("member")->where(["id"=>$id])->find();
            $ip = $user["ip"];
            $port = $user["port"];
            $url = "http://".$ip.":".$port."/payweb/api/proxy/findOrderCompleteByDate?startCompleteDate=".strtotime($stime." 00:00:00")."000&endCompleteDate=".strtotime($etime." 23:59:59")."000";
            //echo $url;
            $html = curl_get($url);
            $json = json_decode($html,true);
            if($json!=null){
                $this->assign("orders",$json);
            }
            $this->assign("id",$id);
            $this->assign("time",[$stime,$etime]);
        }
        $member = M("member")->getField("id,name");
        $this->assign("member",$member);
        $this->display();
    }
}