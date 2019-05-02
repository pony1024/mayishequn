<?php
namespace Home\Controller;
use Think\Controller;
class SnsController extends BaseController {
    public function index()//代理管理
    {
        $this->display();
    }
    public function logs()//操作日志
    {
        $count      = M("admin_log")->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,20);// 实例化分页类
        $show       = $Page->show();// 分页显示输出
        $list = M("admin_log")->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign("list",$list);
        $this->assign("page",$show);
        $this->display();
    }
}