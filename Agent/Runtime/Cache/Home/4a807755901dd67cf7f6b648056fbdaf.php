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
            <div class="pd-20">
              <table  class="layui-table" lay-skin="line">
                <tbody>
                  <tr>
                    <th  width="80">商户名：</th><td><?php echo ($user["name"]); ?></td>
                  </tr>
                  <tr>
                    <th>联系方式：</th><td><?php echo ($user["contact"]); ?></td>
                  </tr>
                  <tr>
                    <th>域名/IP：</th>
                    <td><?php echo ($user["ip"]); ?></td>
                  </tr>
                  <tr>
                    <th>端口：</th>
                    <td><?php echo ($user["port"]); ?></td>
                  </tr>
                  <tr>
                    <th>账号：</th>
                    <td><?php echo ($user["usr"]); ?></td>
                  </tr>
                  <tr>
                    <th>费率：</th>
                    <td><?php echo ($user['rate']*1000); ?>‰</td>
                  </tr>
                  <tr>
                    <th>累计充值：</th>
                    <td><?php echo ($user["balance_true"]); ?></td>
                  </tr>
                  <tr>
                      <th>余额：</th>
                      <td><?php echo ($user["balance"]); ?></td>
                  </tr>
                  <tr>
                    <th>订单总额：</th>
                    <td><?php echo ($user["orderAmount"]); ?></td>
                  </tr>
                  <tr>
                    <th>总手续费：</th>
                    <td><?php echo ($user['orderAmount']*$user['rate']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
</body>
</html>