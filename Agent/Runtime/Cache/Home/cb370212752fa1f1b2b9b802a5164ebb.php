<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo ($pagetitle); ?>社交群 - <?php echo C('sitename');?> - <?php echo C('jieshao');?></title>
    <link rel="stylesheet" href="/Public/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/layui/global.css">
</head>
<body>
<div class="layui-header layui-bg-green layui-hide-xs">
    <div class="qr-content layui-row">
        <div class="layui-logo layui-col-sm2">
            🐜蚂蚁社群
        </div>
        <ul class="layui-nav layui-layout layui-bg-green  layui-col-sm7 layui-col-md7">
            <li class="layui-nav-item">
                <a href="<?php echo U('Index/index');?>">首页</a>
            </li>
            <?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><li class="layui-nav-item">
                    <a href="<?php echo U('Qrcode/'.$vo['url']);?>"><?php echo ($vo["name"]); ?></a>
                    <?php if($vo['submenu'] != ''): ?><dl class="layui-nav-child">
                            <?php if(is_array($vo["submenu"])): foreach($vo["submenu"] as $key=>$item): ?><dd><a href="<?php echo U('Qrcode/'.$vo['url'],['app_type'=>$item['id']]);?>"><?php echo ($item["name"]); ?></a></dd><?php endforeach; endif; ?>
                        </dl><?php endif; ?>
                </li><?php endforeach; endif; ?>
            <li class="layui-nav-item">
                <a href="">国家</a>
                <dl class="layui-nav-child">
                <?php if(is_array($area)): foreach($area as $key=>$item): ?><dd><a href=""><?php echo ($item["name"]); ?></a></dd><?php endforeach; endif; ?>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="">社区</a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout layui-bg-green layui-hide-sm layui-show-md-block layui-col-md3">
            <li class="layui-nav-item"><a class="qr-icon" href=""><i class="layui-icon layui-icon-search"></i></a></li>
            <li class="layui-nav-item"><a class="qr-icon" href="<?php echo U('Qrcode/create');?>"><i class="layui-icon layui-icon-release"></i></a></li>
            <?php if(session('memberid') != ''): ?><li class="layui-nav-item"><a  href="<?php echo U('User/index');?>"><?php echo session('nickname');?></a></li>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/logout');?>">注销</a></li>
                <?php else: ?>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/index');?>">登录</a></li>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/index');?>">注册</a></li><?php endif; ?>
        </ul>
    </div>

</div>
<div class="layui-header layui-row layui-bg-green layui-hide-sm">
    <ul class="layui-nav layui-layout layui-bg-green layui-col-xs2">
        <li class="layui-nav-item">
            <a class="qr-icon" href="javascript:;"><i class="layui-icon layui-icon-user"></i></a>
        </li>
    </ul>
    <div class="layui-logo layui-col-xs8">
            <?php echo ($pagetitle); ?>社交群
    </div>
    <ul class="layui-nav layui-layout-right layui-bg-green  layui-col-xs2">
        <li class="layui-nav-item" style="float: right">
            <a class="qr-icon" href="javascript:;" style="padding: 0"><i class="layui-icon layui-icon-shrink-right"></i></a>
        </li>
    </ul>

</div>
<div class="qr-content">
    <div class="lunbo">
        <div class="layui-carousel" id="test1">
            <div carousel-item>
                <div><img src="https://img.zcool.cn/community/0119e45cc591c3a801214168584aad.jpg@1380w" alt=""></div>
                <div><img src="https://img.zcool.cn/community/01eae85cc595cba80121416891d01c.jpg@1380w" alt=""></div>
                <div><img src="https://img.zcool.cn/community/0152725cc65e4aa801208f8bc130ec.jpg@1380w" alt=""></div>
                <div><img src="https://img.zcool.cn/community/01a4d85cc595b4a801208f8b05912b.jpg@1380w" alt=""></div>
            </div>
        </div>
    </div>

    <div class="tuijian layui-row layui-col-space20">
        <div class="layui-col-xs6 layui-col-sm3">
            <div class="layui-card">
                <div class="layui-card-body cover">
                    <img src="https://img.zcool.cn/community/01b24f5cc2a748a801208f8b78adfb.jpg@260w_195h_1c_1e_1o_100sh.jpg" alt="">
                </div>
                <div class="layui-card-body">
                    <span class="top"></span>
                    <p class="card-title">乌鸦喝水三集连播</p>
                    <p class="card-type">微信群-宝妈</p>
                    <hr>
                    <div class="layui-row">
                        <span class="card-username layui-col-sm6"><i class="layui-icon layui-icon-username"></i>xiaoming</span>
                        <span class="card-date layui-hide-xs layui-col-sm6">两天前</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    window.onload = function(){
        layui.use('carousel', function(){
            var carousel = layui.carousel;
            //建造实例
            carousel.render({
                elem: '#test1'
                ,width: '100%' //设置容器宽度
                ,height:'350'
                ,arrow: 'hover' //始终显示箭头
                //,anim: 'updown' //切换动画方式
            });
        });
    }
</script>
<script src="/Public/layui/layui.all.js"></script>
<script>
    var msg = "<?php echo I('get.msg');?>";
    if(msg!=""){
        layer.msg(msg);
    }

</script>
<div class="layui-footer" style="margin-top: 24px">
    <div class="qr-content">

        <div class="layui-row footer-menu layui-hide-xs" style="height: 100px;line-height: 100px">
            <div class="layui-col-sm3">
                &nbsp;
            </div>
            <div class="layui-col-sm6">
                <ul>
                    <li>关于我们</li>
                    <li>用户协议</li>
                    <li>隐私政策</li>
                    <li>商业合作</li>
                    <li>联系我们</li>
                </ul>
            </div>
            <div class="layui-col-sm3">
            </div>
        </div>
        <fieldset class=" layui-hide-xs"><legend><?php echo C('sitename');?> - 亿万二维码联盟</legend></fieldset>
        <div class="layui-row">
            <div class="layui-col-xs12" style="height: 56px;line-height: 56px;text-align: center">
                Copyright &copy; <?php echo C('sitename');?>
            </div>
        </div>
    </div>
</div>
</body>
</html>