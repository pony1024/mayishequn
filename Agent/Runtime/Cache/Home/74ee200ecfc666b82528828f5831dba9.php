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
            <form class="layui-form x-center" method="get" style="width:70%">
                <div class="layui-form-pane" style="margin-top: 15px;">
                  <div class="layui-form-item">
                    <div class="layui-input-inline">
                        <select name="id" value="">
                            <option value="">请选择代理</option>
                            <?php if(is_array($member)): foreach($member as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                      <label class="layui-form-label">日期范围</label>
                      <div class="layui-input-inline">
                          <input class="layui-input" placeholder="开始日期" name="stime" id="LAY_demorange_s" autocomplete="off" value="<?php echo ($time[0]); ?>">
                      </div>
                      <div class="layui-input-inline">
                          <input class="layui-input" placeholder="截止日期" name="etime" id="LAY_demorange_e" autocomplete="off" value="<?php echo ($time[1]); ?>">
                      </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="*"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                  </div>
                </div> 
            </form>
            <!--<xblock><button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button><span class="x-right" style="line-height:40px">共有数据：<?php echo ($count); ?> 条 </span></xblock>-->
            <table class="layui-table">
                <thead>
                    <tr>
                        <!--<th><input type="checkbox" name="" value=""></th>-->
                        <th>商户号</th>
                        <th>订单号</th>
                        <th>金额</th>
                        <th>设备账号</th>
                        <th>备注</th>
                        <th>创建时间</th>
                        <th>完成时间</th>
                        <th>回调地址</th>
                    </tr>
                </thead>
                <tbody id="x-link">
                    <?php if(is_array($orders)): foreach($orders as $key=>$li): ?><tr>
                            <!--<td><input type="checkbox" value="1" name=""></td>-->
                            <td><?php echo ($li["mid"]); ?></td>
                            <td><?php echo ($li["orderNo"]); ?></td>
                            <td><?php echo ($li["money"]); ?></td>
                            <td><?php echo ($li["appId"]); ?></td>
                            <td><?php echo ($li["remark"]); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$li["createTime"])); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$li["completeTime"])); ?></td>
                            <td><?php echo ($li["notifyUrl"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>

            <div id="page"></div>
        </div>
        <script>
            layui.use(['element','laypage','layer','form','laydate'], function(){
                $ = layui.jquery;//jquery
              lement = layui.element();//面包导航
              laypage = layui.laypage;//分页
              layer = layui.layer;//弹出层
              form = layui.form();//弹出层

              //监听提交
              form.on('submit(*)', function(data){

              });

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
                var id = "<?php echo ($id); ?>";
                if(id!=""){
                    var options = document.getElementsByTagName("dd");
                    for (var i = 0;i<options.length;i++){
                        if (options[i].getAttribute("lay-value") == id){
                            options[i].click();
                            break
                        }
                    }
                }
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
            function rule_edit (title,url,id,w,h) {
                x_admin_show(title,url,w,h); 
            }
            
            /*删除*/
            function rule_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                });
            }
            </script>

    </body>
</html>