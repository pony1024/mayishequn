<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index()
    {
        $indexdata = M("menu")->select();
        foreach ($indexdata as &$item){
            $data = M('qrcode')->where(["menuid"=>$item["id"],'status'=>'1'])->order("zan_time desc")->limit(16)->select();
            if(sizeof($data)){
                foreach ($data as &$d){
                    $d["nickname"] = M("member")->where(['id'=>$d['memberid']])->getField("name");
                    $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
                }
                $item['data'] = $data;
            }
        }

        $topdata =  M('qrcode')->where(['status'=>'1','top_time'=>['gt',time()]])->order("rand()")->limit(4)->select();
        if(sizeof($topdata)){
            foreach ($topdata as &$d){
                $d["nickname"] = M("member")->where(['id'=>$d['memberid']])->getField("name");
                $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
            }
        }
        $lunbo = M("lunbo")->select();
        $app_type = M("app_type")->getField("id,name");
        $qr_type = M("qr_type")->getField("id,name");
        $this->assign("topdata",$topdata);
        $this->assign("app_type",$app_type);
        $this->assign("lunbo",$lunbo);
        $this->assign("qr_type",$qr_type);
        $this->assign("indexdata",$indexdata);
        $this->display();
    }
    public function send(){


    }
}