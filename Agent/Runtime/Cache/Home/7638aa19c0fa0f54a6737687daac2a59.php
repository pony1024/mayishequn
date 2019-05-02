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
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="开始日" id="LAY_demorange_s">
                    </div>
                    <div class="layui-input-inline">
                      <input class="layui-input" placeholder="截止日" id="LAY_demorange_e">
                    </div>
                    <div class="layui-input-inline">
                      <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>代理商</th>
                        <th>订单号</th>
                        <th>金额</th>
                        <th>类型</th>
                        <th>创建时间</th>
                        <th>完成时间</th>
                        <th>操作人员</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($orders)): foreach($orders as $key=>$vo): ?><tr>
                            <td><?php echo ($vo["member_name"]); ?></td>
                            <td><?php echo ($vo["order_no"]); ?></td>
                            <td><?php echo ($vo["amount"]); ?></td>
                            <td><?php echo ($vo['type'] == '1' ? '人工充值':'在线充值'); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$vo["complete_time"])); ?></td>
                            <td><?php echo ($vo["admin_name"]); ?></td>
                            <td>
                                <?php if($vo["status"] == 1): ?><span class="layui-btn layui-btn-success layui-btn-mini">成功</span>
                                    <?php else: ?>
                                    <span class="layui-btn layui-btn-disabled layui-btn-mini">未确认</span><?php endif; ?>
                            </td>
                            <td class="td-manage">
                                <span class="layui-btn layui-btn-normal layui-btn-mini" onclick="alert('来源链接: <?php echo ($log["referer"]); ?>\n\n浏览器信息: <?php echo ($log["ua"]); ?>\n\n提交参数: <?php echo (htmlspecialchars($log["args"])); ?>')">详细信息</span>
                            </td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div id="page"><?php echo ($page); ?></div>
        </div>
        <script>
            layui.use(['element','layer','laydate'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              layer = layui.layer;//弹出层
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

            })

              
            //批量删除提交
             function delAll () {
                layer.confirm('确认要删除吗？',function(index){
                    //捉到所有被选中的，发异步进行删除
                    layer.msg('删除成功', {icon: 1});
                });
             }
           
            /*浏览-删除*/
            function view_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>
</body>
</html>