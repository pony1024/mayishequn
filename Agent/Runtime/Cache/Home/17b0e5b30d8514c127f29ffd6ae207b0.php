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
    <body>
        <div class="x-body">
            <form class="layui-form">
                <input type="hidden" name="id" value="<?php echo ($user["id"]); ?>">
                <div class="layui-form-item">
                    <label for="username" class="layui-form-label">
                        <span class="x-red">*</span>登录名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="username" name="username" required="" lay-verify="required" disabled
                               autocomplete="off" class="layui-input" value="<?php echo ($user["user"]); ?>">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        <span class="x-red">*</span>将会成为您唯一的登入名
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_pass" class="layui-form-label">
                        <span class="x-red">*</span>密码
                    </label>
                    <div class="layui-input-inline">
                        <input type="password" id="L_pass" name="password"
                               autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        6到16个字符,不修改请留空
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="role" class="layui-form-label">
                        <span class="x-red">*</span>角色
                    </label>
                    <div class="layui-input-inline">
                        <select name="role" id="role" required="" lay-verify="role">
                            <option value="">请选择角色</option>
                            <?php if(is_array($role)): foreach($role as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                        <span class="x-red">*</span>备注
                    </label>
                    <div class="layui-input-inline">
                        <textarea type="text" id="L_repass" name="remark" required="" autocomplete="off" class="layui-textarea"><?php echo ($user["remark"]); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="L_repass" class="layui-form-label">
                    </label>
                    <button  class="layui-btn" lay-filter="save" lay-submit="">
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
                nikename: function(value){
                  if(value.length < 5){
                    return '昵称至少得5个字符啊';
                  }
                }
                ,pass: [/[a-zA-Z0-9]{6,12}$/, '密码必须6到12位']
                ,role: function(value){
                      if(value.length < 1){
                          return '请选择角色';
                      }
                  }
              });

              //监听提交
              form.on('submit(save)', function(data){
                console.log(data);
                  $.ajax({
                      type:"post",
                      data:data.field,
                      success:function (data) {
                          if (data.success){
                              layer.alert("修改成功", {icon: 6},function () {
                                  // 获得frame索引
                                  window.parent.history.go(0);
                                  var index = parent.layer.getFrameIndex(window.name);
                                  //关闭当前frame
                                  parent.layer.close(index);
                              });
                          } else{
                              layer.alert(data.msg, {icon: 2});
                          }
                      }
                  })
                return false;
              });
              var objs = $("#role+div dl dd");
              for (var i =0;i<objs.length;i++){
                  if(objs.eq(i).attr("lay-value")=="<?php echo ($user["role"]); ?>"){
                      objs.eq(i).click();
                      break;
                  }
              }
              
            });
        </script>
        </body>
</html>