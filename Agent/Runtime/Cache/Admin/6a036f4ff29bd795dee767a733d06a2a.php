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
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header header header-demo">
                <div class="layui-main">
                    <a class="logo" href="javascript:;">
                        易汇通代理商管理系统
                    </a>
                    <ul class="layui-nav" lay-filter="">
                      <li class="layui-nav-item">
                        <a href="javascript:;"><?php echo (session('a_username')); ?></a>
                        <!--<dl class="layui-nav-child"> &lt;!&ndash; 二级菜单 &ndash;&gt;
                          <dd><a href="">个人信息</a></dd>
                          <dd><a href="">切换帐号</a></dd>
                          <dd><a href="/Public/login.html">退出</a></dd>
                        </dl>-->
                      </li>
                      <!-- <li class="layui-nav-item">
                        <a href="" title="消息">
                            <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                        </a>
                        </li> -->
                      <li class="layui-nav-item x-index"><a href="<?php echo U('Login/logout');?>">注销</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black x-side">
                <div class="layui-side-scroll">
                    <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                        <?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><li class="layui-nav-item">
                                <a class="javascript:;" href="javascript:;">
                                    <i class="<?php echo ($vo["classname"]); ?>" aria-hidden="true"></i><cite><?php echo ($vo["name"]); ?></cite>
                                </a>

                                <dl class="layui-nav-child">
                                    <?php if(is_array($vo["childen"])): foreach($vo["childen"] as $key=>$child): ?><dd class="">
                                            <a href="javascript:;" _href="<?php echo (U($child["rules"])); ?>">
                                                <cite><?php echo ($child["name"]); ?></cite>
                                            </a>
                                        </dd><?php endforeach; endif; ?>
                                </dl>
                            </li><?php endforeach; endif; ?>

                    </ul>
                </div>

            </div>
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        我的桌面
                        <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
                    </li>
                </ul>
                <div class="layui-tab-content site-demo site-demo-body">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" src="<?php echo U('Index/welcome');?>" class="x-iframe"></iframe>
                    </div>
                </div>
            </div>
            <div class="site-mobile-shade">
            </div>
        </div>
        <script src="/Public/js/x-admin.js"></script>
        </body>
</html>