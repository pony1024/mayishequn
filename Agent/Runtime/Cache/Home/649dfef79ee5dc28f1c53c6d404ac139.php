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
        <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite><?php echo ($supername); ?></cite></a>
              <a><cite><?php echo ($rulename); ?></cite></a>
            </span>
            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
        </div>
        <div class="x-body">
            <form class="layui-form x-center" action="" style="width:40%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <div class="layui-input-inline">
                      <input type="text" name="name"  placeholder="分类名" autocomplete="off" class="layui-input">
                    </div>
                      <div class="layui-input-inline">
                          <input type="text" name="classname"  placeholder="图标类" autocomplete="off" class="layui-input">
                      </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="*"><i class="layui-icon">&#xe608;</i>添加</button>
                    </div>
                  </div>
                </div> 
            </form>
            <!--<xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条 </span></xblock>-->
            <table class="layui-table">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" name="" value=""></th>-->
                        <th>ID</th>
                        <th>分类名</th>
                        <th>图标类</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="x-link">
                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                            <!--<td><input type="checkbox" value="1" name=""></td>-->
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["classname"]); ?></td>
                            <td class="td-manage">
                                <a title="编辑" href="javascript:;" onclick="cate_edit('编辑','<?php echo U('Admin/cate_edit');?>','4','','510')" class="ml-5" style="text-decoration:none"><i class="layui-icon">&#xe642;</i></a>
                                <!--<a title="删除" href="javascript:;" onclick="cate_del(this,'1')" style="text-decoration:none"><i class="layui-icon">&#xe640;</i></a>-->
                            </td>
                        </tr><?php endforeach; endif; ?>


                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script>
            layui.use(['element','laypage','layer','form'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层

              //监听提交
              form.on('submit(*)', function(data){
                  data.field.type = "add";
                  $.ajax({
                      type:"post",
                      data:data.field,
                      success:function (data) {
                          if(data.success){
                              history.go(0);
                          }else{
                              layer.alert(data.msg, {icon: 2});
                          }
                      }
                  })
                //发异步，把数据提交给php

                return false;
              });
            })

              //以上模块根据需要引入

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
            
            

            //-编辑
            function cate_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            
            /*删除*/
            function cate_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>

    </body>
</html>