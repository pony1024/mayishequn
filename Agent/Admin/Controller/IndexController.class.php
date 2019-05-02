<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index()
    {
        $this->display();
    }
    public function welcome()
    {
        $today = today();
        $yesterday = yesterday();
        $curweek = curweek();
        $curmonth = curmonth();
        //代理商
        $agent["count"] = M("member")->count();
        $agent["today"] = M("member")->where(["createtime"=>["between",$today]])->count();
        $agent["yesterday"] = M("member")->where(["createtime"=>["between",$yesterday]])->count();
        $agent["curweek"] = M("member")->where(["createtime"=>["between",$curweek]])->count();
        $agent["curmonth"] = M("member")->where(["createtime"=>["between",$curmonth]])->count();
        //充值笔数
        $orders["count"] = M("orders")->count();
        $orders["today"] = M("orders")->where(["complete_time"=>["between",$today]])->count();
        $orders["yesterday"] = M("orders")->where(["complete_time"=>["between",$yesterday]])->count();
        $orders["curweek"] = M("orders")->where(["complete_time"=>["between",$curweek]])->count();
        $orders["curmonth"] = M("orders")->where(["complete_time"=>["between",$curmonth]])->count();
        //充值金额
        $money["count"] = doubleval(M("orders")->sum("amount"));
        $money["today"] = doubleval(M("orders")->where(["complete_time"=>["between",$today]])->sum("amount"));
        $money["yesterday"] = doubleval(M("orders")->where(["complete_time"=>["between",$yesterday]])->sum("amount"));
        $money["curweek"] = doubleval(M("orders")->where(["complete_time"=>["between",$curweek]])->sum("amount"));
        $money["curmonth"] = doubleval(M("orders")->where(["complete_time"=>["between",$curmonth]])->sum("amount"));
        //在线充值金额
        $online["count"] = doubleval(M("orders")->where(["type"=>"2"])->sum("amount"));
        $online["today"] = doubleval(M("orders")->where(["type"=>"2","complete_time"=>["between",$today]])->sum("amount"));
        $online["yesterday"] = doubleval(M("orders")->where(["type"=>"2","complete_time"=>["between",$yesterday]])->sum("amount"));
        $online["curweek"] = doubleval(M("orders")->where(["type"=>"2","complete_time"=>["between",$curweek]])->sum("amount"));
        $online["curmonth"] = doubleval(M("orders")->where(["type"=>"2","complete_time"=>["between",$curmonth]])->sum("amount"));
        //人工入款金额
        $offline["count"] = M("orders")->where(["type"=>"1"])->sum("amount");
        $offline["today"] = doubleval(M("orders")->where(["type"=>"1","complete_time"=>["between",$today]])->sum("amount"));
        $offline["yesterday"] = doubleval(M("orders")->where(["type"=>"1","complete_time"=>["between",$yesterday]])->sum("amount"));
        $offline["curweek"] = doubleval(M("orders")->where(["type"=>"1","complete_time"=>["between",$curweek]])->sum("amount"));
        $offline["curmonth"] = doubleval(M("orders")->where(["type"=>"1","complete_time"=>["between",$curmonth]])->sum("amount"));

        $this->assign("online",$online);
        $this->assign("offline",$offline);
        $this->assign("money",$money);
        $this->assign("orders",$orders);
        $this->assign("agent",$agent);
        $this->display();
    }
}