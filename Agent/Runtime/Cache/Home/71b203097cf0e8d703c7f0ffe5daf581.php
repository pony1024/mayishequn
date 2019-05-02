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
            <form class="layui-form x-center" action="" style="width:80%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <label class="layui-form-label">加入日期</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="开始日期" name="stime" id="LAY_demorange_s" value="<?php echo ($time[0]); ?>">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="截止日期" name="etime" id="LAY_demorange_e" value="<?php echo ($time[1]); ?>">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="username"  placeholder="请输入登录名" autocomplete="off" class="layui-input" value="<?php echo ($user); ?>">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <xblock><!--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>--><button class="layui-btn" onclick="admin_add('添加管理员','<?php echo U('Admin/add');?>','600','500')"><i class="layui-icon">&#xe608;</i>添加</button><span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条</span></xblock>
            <table class="layui-table">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" name="" value=""></th>-->
                        <th>ID</th>
                        <th>登录名</th>
                        <th>角色</th>
                        <th>加入时间</th>
                        <th>最后登录时间</th>
                        <th>最后登录IP</th>
                        <th>备注</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                        <!--<td><input type="checkbox" value="1" name=""></td>-->
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["user"]); ?></td>
                        <td ><?php echo ($role[$vo["role"]]); ?></td>
                        <td><?php echo (date("Y-m-d H:i:s",$vo["createtime"])); ?></td>
                        <td ><?php echo (date("Y-m-d H:i:s",$vo["lasttime"])); ?></td>
                        <td ><?php echo ($vo["lastip"]); ?></td>
                        <td ><?php echo ($vo["remark"]); ?></td>
                        <td class="td-status">
                            <?php if($vo['status'] == '1'): ?><span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                                <?php else: ?>
                                <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span><?php endif; ?>
                        </td>
                        <td class="td-manage">
                            <?php if($vo['status'] == '1'): ?><a style="text-decoration:none" onclick="admin_stop('<?php echo ($vo["id"]); ?>')" href="javascript:;" title="停用"><i class="fa fa-stop-circle" aria-hidden="true"></i></a>
                                <?php else: ?>
                                <a style="text-decoration:none" onClick="admin_start('<?php echo ($vo["id"]); ?>')" href="javascript:;" title="启用"><i class="fa fa-play-circle" aria-hidden="true"></i></a><?php endif; ?>

                            </a>
                            <a title="编辑" href="javascript:;" onclick="admin_edit('修改管理员','<?php echo U('Admin/edit',['id'=>$vo['id']]);?>','4','','510')"
                            class="ml-5" style="text-decoration:none">
                                <i class="layui-icon">&#xe642;</i>
                            </a>
                            <a title="删除" href="javascript:;" onclick="admin_del('<?php echo ($vo["id"]); ?>')"
                            style="text-decoration:none">
                                <i class="layui-icon">&#xe640;</i>
                            </a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script>
            layui.use(['laydate','element','laypage','layer'], function(){
                $ = layui.jquery;//jquery
              laydate = layui.laydate;//日期插件
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层

              //以上模块根据需要引入

              /*laypage({
                cont: 'page'
                ,pages: 100
                ,first: 1
                ,last: 100
                ,prev: '<em><</em>'
                ,next: '<em>></em>'
              }); */
              
              var start = {
                min: '2000-06-16 23:59:59'
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                  end.min = datas; //开始日选好后，重置结束日的最小日期
                  end.start = datas //将结束日的初始值设定为开始日
                }
              };
              
              var end = {
                min: '2000-06-16 23:59:59'
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                  start.max = datas; //结束日选好后，重置开始日的最大日期
                }
              };
              
              document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
              }
              document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
              }
              
            });

            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
             /*添加*/
            function admin_add(title,url,w,h){
                x_admin_show(title,url,w,h);
            }

             /*停用*/
            function admin_stop(id){
                layer.confirm('确认要停用吗？',function(index){
                    $.ajax({
                        type:"post",
                        data:{type:"set",id:id,status:"0"},
                        success:function (data) {
                            if (data.success){
                                layer.msg('已停用!',{icon: 5,time:1000});
                                history.go(0);
                            } else{
                                layer.msg(data.msg,{icon: 2,time:1000});
                            }
                        }
                    })

                });
            }

            /*启用*/
            function admin_start(id){
                layer.confirm('确认要启用吗？',function(index){
                    $.ajax({
                        type:"post",
                        data:{type:"set",id:id,status:"1"},
                        success:function (data) {
                            if (data.success){
                                layer.msg('已启用!',{icon: 6,time:1000});
                                history.go(0);
                            } else{
                                layer.msg(data.msg,{icon: 2,time:1000});
                            }
                        }
                    })
                });
            }
            //编辑
            function admin_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            /*删除*/
            function admin_del(id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $.ajax({
                        type:"post",
                        data:{type:"del",id:id},
                        success:function (data) {
                            if (data.success){
                                layer.msg('已删除!',{icon: 1,time:1000});
                                history.go(0);
                            } else{
                                layer.msg(data.msg,{icon: 2,time:1000});
                            }
                        }
                    })
                });
            }
            </script>
</body>
</html>