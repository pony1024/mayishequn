<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        易汇通代理商管理系统
    </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/css/x-admin.css" media="all">
    <link rel="stylesheet" href="/Public/css/font-awesome.min.css" media="all">
    <script src="/Public/lib/layui/layui.js" charset="utf-8"></script>
    <script src="/Public/js/x-layui.js" charset="utf-8"></script>
</head>
<body>
        <div class="x-body">
            <form class="layui-form">
                <input type="hidden" name="id" value="<?php echo ($user["id"]); ?>">
                <div class="layui-form-item">
                    <label for="L_name" class="layui-form-label">
                        <span class="x-red">*</span>商户名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_name" name="name" required="" lay-verify="nickname" disabled
                        autocomplete="off" class="layui-input" value="<?php echo ($user["name"]); ?>">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        代理商家标识
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_rate" class="layui-form-label">
                        <span class="x-red">*</span>费率
                    </label>
                    <div class="layui-input-inline">
                        <input type="number" id="L_rate" name="rate" required="required" lay-verify="rate"
                               autocomplete="off" class="layui-input" value="<?php echo ($user['rate']*1000); ?>">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        整数，千分之一则写1
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_contact" class="layui-form-label">
                        联系方式
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="L_contact" name="contact" required=""
                               autocomplete="off" class="layui-input" value="<?php echo ($user["contact"]); ?>">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        代理联系方式
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_remark" class="layui-form-label">
                        备注
                    </label>
                    <div class="layui-input-inline">
                        <textarea type="text" id="L_remark" name="remark" required="required"
                                  autocomplete="off" class="layui-textarea"><?php echo ($user["remark"]); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="add" lay-submit="">
                        保存
                    </button>
                </div>
            </form>
        </div>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;
            
              //自定义验证规则
              form.verify({
                  rate: [/^[1-9][0-9]{0,2}$/, '费率必须为1到999之间的整数']
              });

              //监听提交
              form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                  $.ajax({
                      type:"post",
                      data:data.field,
                      success:function (data) {
                          if(data.success){
                              layer.alert("修改成功", {icon: 6},function () {
                                  // 获得frame索引
                                  window.parent.history.go(0);
                                  var index = parent.layer.getFrameIndex(window.name);
                                  //关闭当前frame
                                  parent.layer.close(index);
                              });
                          }else{
                              layer.msg(data.msg, {icon: 2});
                          }
                      }
                  })

                return false;
              });
              
              
            });
        </script>
    </body>
</html>