<?php
namespace Home\Controller;
use Think\Controller;
class QrcodeController extends BaseController {
    public function __construct()
    {
        parent::__construct();


    }
    public function zan()
    {
        $map["id"] = I('get.id');
        $res["success"] = false;
        if($map["id"] != ""){
            $qrcode = M('qrcode')->where($map)->find();
            if(sizeof($qrcode)>0){
                $iszan = iszan($map["id"]);
                if(!$iszan){
                    $data['qrid'] = $map["id"];
                    $data['ip'] = $_SERVER['REMOTE_ADDR'];
                    $data['memberid'] = session('memberid');
                    M()->startTrans();
                    M('qrcode')->where($map)->setInc('zan');
                    M('qrcode')->where($map)->setField('zan_time',time());
                    M('zaninfo')->data($data)->add();
                    M()->commit();
                    $res["success"] = true;
                }else{
                    $res["msg"] = "请不要重复点赞";
                }

            }else{
                $res["msg"] = "二维码不存在";
            }
        }else{
            $res["msg"] = "参数错误";
        }
        $this.$this->ajaxReturn($res);
    }
    public function view()
    {
        $map["id"] = I('get.id');
        $city = "";
        if($map["id"] != ""){
            $qrcode = M('qrcode')->where($map)->find();
            if(sizeof($qrcode)>0){
                M('qrcode')->where($map)->setInc('see');
                $city = $qrcode["city"];
                $qrcode["nickname"] = M("member")->where(['id'=>$qrcode['memberid']])->getField("name");
                $qrcode["area"] = M("area")->where(['id'=>$qrcode['area']])->getField("name");
                $qrcode["country"] = M("country")->where(['id'=>$qrcode['country']])->getField("name");
                $qrcode["city"] = M("city")->where(['id'=>$qrcode['city']])->getField("name");
                $qrcode["app_type"] = M("app_type")->where(['id'=>$qrcode['app_type']])->getField("name");
                $qrcode["qr_type"] = M("qr_type")->where(['id'=>$qrcode['qr_type']])->getField("name");
                $qrcode["menu"] = M("menu")->where(['id'=>$qrcode['menuid']])->getField("name");
                $qrcode["iszan"] = iszan($map["id"]);
                $qrdata = M('qrcode')->where(['city'=>$city])->limit(4)->order('rand()')->select();
                if(sizeof($qrdata)){
                    foreach ($qrdata as &$d){
                        $d["nickname"] = M("member")->where(['id'=>$d['memberid']])->getField("name");
                        $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
                    }
                }
                $app_type = M('app_type')->getField("id,name");
                $qr_type = M('qr_type')->getField("id,name");
                $this->assign("app_type",$app_type);
                $this->assign("qr_type",$qr_type);
                $this->assign("qrdata",$qrdata);
                $this->assign("qrcode",$qrcode);
            }else{
                errmsg("二维码不存在或已删除");
            }
        }else{
            errmsg("参数错误");
        }
        $this->display();
    }
    public function qrlist()
    {
        $menuid = "";
        $map = [];
        if(I('get.app_type')!=""){
            $map["app_type"] = I('get.app_type');
            $pagetitle = M('app_type')->where(["id"=>I('get.app_type')])->getField("name");
            $menuid = M('app_type')->where(["id"=>I('get.app_type')])->getField("menuid");
            $map["menuid"] = $menuid;
            $this->assign("pagetitle",$pagetitle);
        }elseif(I('get.menuid')!=""){
            $map["menuid"] = I('get.menuid');
            $menuid = I('get.menuid');
            $pagetitle = M('menu')->where(["id"=>I('get.menuid')])->getField("name");
            $this->assign("pagetitle",$pagetitle);
        }

        if(I('get.qr_type')){
            $map["qr_type"] = I('get.qr_type');
        }
        $count  = M('qrcode')->where($map)->count();// 查询满足要求的总记录数
        $Page   = new \Think\Page($count,20);// 实例化分页类
        $show   = $Page->show();// 分页显示输出
        $qrdata = M('qrcode')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("zan_time desc")->select();
        if(sizeof($qrdata)){
            foreach ($qrdata as &$d){
                $d["nickname"] = M("member")->where(['id'=>$d['memberid']])->getField("name");
                $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
            }
        }
        $app_type = M('app_type')->where(["menuid"=>$menuid])->getField("id,name");
        $qr_type = M('qr_type')->where(["menuid"=>$menuid])->getField("id,name");
        $this->assign("menuid",$menuid);
        $this->assign("app_type",$app_type);
        $this->assign("qr_type",$qr_type);
        $this->assign("qrdata",$qrdata);
        $this->assign("page",$show);
        $this->display();
    }
    public function area()
    {
        $menuid = "";
        $map = [];
        if(I('get.menuid')!=""){
            $map["menuid"] = I('get.menuid');
            $menuid = I('get.menuid');
            $qr_type = M('qr_type')->where(["menuid"=>$menuid])->select();
            $this->assign("qr_type",$qr_type);
        }
        if(I('get.areaid')!=""){
            $map["area"] = I('get.areaid');
        }
        if(I('get.qr_typeid')!=""){
            $map["qr_type"] = I('get.qr_typeid');
        }
        $count  = M('qrcode')->where($map)->count();// 查询满足要求的总记录数
        $Page   = new \Think\Page($count,20);// 实例化分页类
        $show   = $Page->show();// 分页显示输出
        $qrdata = M('qrcode')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("zan_time desc")->select();
        if(sizeof($qrdata)){
            foreach ($qrdata as &$d){
                $d["nickname"] = M("member")->where(['id'=>$d['memberid']])->getField("name");
                $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
            }
        }
        $app_type = M('app_type')->getField("id,name");
        $qr_type = M('qr_type')->getField("id,name");
        $qr_typemenu = M('qr_type')->where(["menuid"=>$menuid])->select();
        $this->assign("app_type",$app_type);
        $this->assign("qr_type",$qr_type);
        $this->assign("qr_typemenu",$qr_typemenu);
        $this->assign("qrdata",$qrdata);
        $this->assign("page",$show);
        $this->display();
    }
    public function create()
    {
        checkuser();
        if(IS_AJAX&&IS_POST){
            $res["success"] = false;
            $data = I("post.");
            unset($data["file"]);
            if(notnull($data)){
                if(M('config')->where(['key'=>'review'])->getField('value')=="0"){//判断是否需要审核
                    $data["status"] = "1";
                }else{
                    $data["status"] = "0";
                }
                $data["create_time"] = time();
                $data["memberid"] = session('memberid');
                if($data["toptime"]>0){
                    if(intval($data["toptime"])==$data["toptime"]){
                        $price = M('config')->where(['key'=>'price'])->getField('value');
                        $coin = $price*$data["toptime"];
                        $data["top_time"] = time()+(intval($data["toptime"])*3600);
                        M()->startTrans();
                            $save = M("qrcode")->data($data)->add();
                            $buy = M('member')->where(['id'=>$data["memberid"]])->setDec('coin',$coin);//扣钱
                            $balance = M('member')->where(['id'=>$data["memberid"]])->getField('coin');//获取余额
                        if ($save&&$buy&&$balance>=0){
                            M()->commit();
                            $res["success"] = true;
                        }else{
                            $res["msg"] = "置顶价格为".$price."码币/小时，您的余额不足";
                            M()->rollback();
                        }
                    }else{
                        $res["msg"] = "非法参数";
                    }
                }elseif($data["toptime"]==0){
                    $data["top_time"] = "0";
                    M("qrcode")->data($data)->add();
                    $res["success"] = true;
                }else{
                    $res["msg"] = "非法参数";
                }

            }else{
                $res["msg"] = "非法参数";
            }
            $this->ajaxReturn($res);
        }
        $qr_type = M('menu')->field('id')->select();
        foreach ($qr_type as &$item){
            $submenu = M('qr_type')->where(["menuid"=>$item["id"]])->select();
            if(sizeof($submenu)){
                $item['submenu'] = $submenu;
            }
        }
        $area = M('area')->where('pid=0')->select();//获取大区域
        foreach ($area as &$country){
            $submenu = M('area')->where(["pid"=>$country["id"]])->select();//获取国家
            if(sizeof($submenu)){//判断国家是否为空
                $country['submenu'] = $submenu;
                foreach ($country['submenu'] as &$city){
                    $citymenu = M('area')->where(["pid"=>$city["id"]])->select();//获取省份
                    if(sizeof($citymenu)){//判断省份是否为空
                        $city['citymenu'] = $citymenu;
                    }
                }
            }
        }
        $this->assign("area_submenu",json_encode($area));
        $this->assign("qr_type",json_encode($qr_type));
        $this->display();
    }
}