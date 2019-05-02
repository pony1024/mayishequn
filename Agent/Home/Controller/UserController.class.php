<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
    public function index()//代理管理
    {
        $uid = I('get.uid');
        $userinfo = [];
        if($uid==""){
            $uid=session('memberid');
        }
        if($uid==""){
            checkuser();
        }else{
            $userinfo = M('member')->where(["id"=>$uid])->find();
        }
        if(sizeof($userinfo)==0){
            errmsg("用户不存在");
        }
        $userinfo["qrcount"] = M('qrcode')->where(["memberid"=>$uid])->count();
        $userinfo["zan"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('zan'));
        $userinfo["see"] = intval(M('qrcode')->where(["memberid"=>$uid])->sum('see'));
        $map["memberid"] = $uid;
        $count  = M('qrcode')->where($map)->count();// 查询满足要求的总记录数
        $Page   = new \Think\Page($count,20);// 实例化分页类
        $show   = $Page->show();// 分页显示输出
        $qrdata = M('qrcode')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order("id desc")->select();
        if(sizeof($qrdata)){
            foreach ($qrdata as &$d){
                $d["nickname"] = $userinfo["name"];
                $d["city"] = M("city")->where(['id'=>$d['city']])->getField("name");
            }
        }
        $app_type = M("app_type")->getField("id,name");
        $qr_type = M("qr_type")->getField("id,name");
        $this->assign("app_type",$app_type);
        $this->assign("qr_type",$qr_type);
        $this->assign("qrdata",$qrdata);
        $this->assign("userinfo",$userinfo);
        $this->assign("page",$show);
        $this->display();
    }
}