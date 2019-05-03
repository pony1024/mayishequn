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
            <blockquote class="layui-elem-quote">
                <p>登录次数：<?php echo (session('dex')); ?> </p>
                <p>上次登录IP：<?php echo (session('a_lastip')); ?>  上次登录时间：<?php echo (date("Y-m-d H:i:s",session('a_lasttime'))); ?></p>
            </blockquote>

            <fieldset class="layui-elem-field layui-field-title site-title">
              <legend><a name="default">信息统计</a></legend>
            </fieldset>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th>统计</th>
                        <th>代理商数</th>
                        <th>充值笔数</th>
                        <th>充值金额</th>
                        <th>在线充值金额</th>
                        <th>人工入款金额</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>总数</td>
                        <td><?php echo ($agent["count"]); ?></td>
                        <td><?php echo ($orders["count"]); ?></td>
                        <td><?php echo ($money["count"]); ?></td>
                        <td><?php echo ($online["count"]); ?></td>
                        <td><?php echo ($offline["count"]); ?></td>
                    </tr>
                    <tr>
                        <td>今日</td>
                        <td><?php echo ($agent["today"]); ?></td>
                        <td><?php echo ($orders["today"]); ?></td>
                        <td><?php echo ($money["today"]); ?></td>
                        <td><?php echo ($online["today"]); ?></td>
                        <td><?php echo ($offline["today"]); ?></td>
                    </tr>
                    <tr>
                        <td>昨日</td>
                        <td><?php echo ($agent["yesterday"]); ?></td>
                        <td><?php echo ($orders["yesterday"]); ?></td>
                        <td><?php echo ($money["yesterday"]); ?></td>
                        <td><?php echo ($online["yesterday"]); ?></td>
                        <td><?php echo ($offline["yesterday"]); ?></td>
                    </tr>
                    <tr>
                        <td>本周</td>
                        <td><?php echo ($agent["curweek"]); ?></td>
                        <td><?php echo ($orders["curweek"]); ?></td>
                        <td><?php echo ($money["curweek"]); ?></td>
                        <td><?php echo ($online["curweek"]); ?></td>
                        <td><?php echo ($offline["curweek"]); ?></td>
                    </tr>
                    <tr>
                        <td>本月</td>
                        <td><?php echo ($agent["curmonth"]); ?></td>
                        <td><?php echo ($orders["curmonth"]); ?></td>
                        <td><?php echo ($money["curmonth"]); ?></td>
                        <td><?php echo ($online["curmonth"]); ?></td>
                        <td><?php echo ($offline["curmonth"]); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="layui-footer footer " style="position: absolute;bottom: 0px;width:100%;">
            <div class="layui-main">
                <p>
                    <a href="/">
                        Copyright ©2007 - 2019 YHT All Rights Reserved.
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>