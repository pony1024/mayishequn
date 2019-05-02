<?php
function checkuser()
{
    if(session("memberid")==""){
        header("Location:".U('Login/index',["msg"=>"登录后才能操作"]));
        exit;
    }
}
function errmsg($msg)
{
        header("Location:".U('Index/index',["msg"=>$msg]));
        exit;
}
function datef($t){
    $r = date("Y-m-d",$t);
    $today = date("Y-m-d");
    $today = date("Y-m-d");
    $yesterday = date("Y-m-d",strtotime("-1 day"));
    $ayesterday = date("Y-m-d",strtotime("-2 day"));
    if($r == $today){
        return "今天";
    }elseif ($r == $yesterday){
        return "昨天";
    }elseif ($r == $ayesterday){
        return "前天";
    }else{
        return $r;
    }
}
function notnull($d){
    foreach ($d as $c){
        if($c==""){
            return false;
        }
    }
    return true;
}
function SC($key){
    return M('config')->where(['key'=>$key])->getField("value");
}
function iszan($id){
    $iszan = false;
    if(session('memberid')==''){
        //未登录
        if(M('zaninfo')->where(['qrid'=>$id,'ip'=>$_SERVER['REMOTE_ADDR']])->count()>0){
            $iszan = true;
        }
    }else{
        //已登录
        if(M('zaninfo')->where(['qrid'=>$id,'memberid'=>session('memberid')])->count()>0){
            $iszan = true;
        }
    }
    return $iszan;
}
