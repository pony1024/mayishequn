<?php
namespace Home\Controller;
use Think\Controller;
use Think\Think;

class UploadController extends BaseController
{
    public function index(){
        $upload = new \Think\Upload(C('upload'));
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $this->ajaxReturn($info);
        }
    }
}