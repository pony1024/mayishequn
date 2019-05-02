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
            <form action="" method="post" class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <?php if(is_array($auths)): foreach($auths as $key=>$vo): ?><tr>
                                    <td width="25%" align="center">
                                        <input class="auth" id="id<?php echo ($vo["id"]); ?>" type="checkbox" title="<?php echo ($vo["name"]); ?>" value="<?php echo ($vo["id"]); ?>">
                                    </td>
                                    <td width="75%">
                                        <div class="layui-input-block">
                                            <?php if(is_array($vo["childen"])): foreach($vo["childen"] as $key=>$child): ?><input class="auth" id="id<?php echo ($child["id"]); ?>" type="checkbox" title="<?php echo ($child["name"]); ?>" value="<?php echo ($child["id"]); ?>"><?php endforeach; endif; ?>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="remark" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">增加</button>
              </div>
            </form>
        </div>
        <script src="./lib/layui/layui.js" charset="utf-8">
        </script>
        <script src="./js/x-layui.js" charset="utf-8">
        </script>
        <script>
            layui.use(['form','layer'], function(){
                $ = layui.jquery;
              var form = layui.form()
              ,layer = layui.layer;

              //监听提交
              form.on('submit(add)', function(data){
                console.log(data);
                  var objs = $("[type=checkbox]:checked");
                  var auth = []
                  for (var i =0 ;i<objs.length;i++){
                      auth.push(objs[i].value);
                  }
                  auth = auth.join(",");
                  data.field.auth = auth;
                  $.ajax({
                      type:"post",
                      data:data.field,
                      success:function (data) {
                          if (data.success){

                              layer.alert("添加成功", {icon: 6},function () {
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
              
              
            });
        </script>
</body>
</html>