<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>区域查询 - <?php echo C('sitename');?> - <?php echo C('jieshao');?></title>
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
                    <a href="<?php echo U('Qrcode/qrlist',['menuid'=>$vo['id']]);?>"><?php echo ($vo["name"]); ?></a>
                    <?php if($vo['submenu'] != ''): ?><dl class="layui-nav-child">
                            <?php if(is_array($vo["submenu"])): foreach($vo["submenu"] as $key=>$item): ?><dd><a href="<?php echo U('Qrcode/qrlist',['app_type'=>$item['id']]);?>"><?php echo ($item["name"]); ?></a></dd><?php endforeach; endif; ?>
                        </dl><?php endif; ?>
                </li><?php endforeach; endif; ?>
            <li class="layui-nav-item">
                <a href="<?php echo U('Qrcode/area');?>">国家</a>
                <dl class="layui-nav-child">
                <?php if(is_array($area)): foreach($area as $key=>$item): ?><dd><a href="<?php echo U('Qrcode/area',['areaid'=>$item[id]]);?>"><?php echo ($item["name"]); ?></a></dd><?php endforeach; endif; ?>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo U('Sns/index');?>">社区</a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout layui-bg-green layui-hide-sm layui-show-md-block layui-col-md3">
            <li class="layui-nav-item"><a class="qr-icon" href=""><i class="layui-icon layui-icon-search"></i></a></li>
            <li class="layui-nav-item"><a class="qr-icon" href="<?php echo U('Qrcode/create');?>"><i class="layui-icon layui-icon-release"></i></a></li>
            <?php if(session('memberid') != ''): ?><li class="layui-nav-item"><a  href="<?php echo U('User/index');?>"><?php echo session('nickname');?></a></li>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/logout');?>">注销</a></li>
                <?php else: ?>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/index');?>">登录</a></li>
                <li class="layui-nav-item"><a  href="<?php echo U('Login/register');?>">注册</a></li><?php endif; ?>
        </ul>
    </div>

</div>
<div class="layui-header layui-row layui-bg-green layui-hide-sm">
    <ul class="layui-nav layui-layout layui-bg-green layui-col-xs2">
        <li class="layui-nav-item">
            <a class="qr-icon" href="javascript:;"><i class="layui-icon layui-icon-search"></i></a>
        </li>
    </ul>
    <div class="layui-logo layui-col-xs8">
            区域查询
    </div>
    <ul class="layui-nav layui-layout-right layui-bg-green  layui-col-xs2">
        <li class="layui-nav-item" style="float: right">
            <a class="qr-icon" href="javascript:right();" style="padding: 0"><i class="layui-icon layui-icon-shrink-right"></i></a>
        </li>
    </ul>

</div>
<div class="qr-right-menu layui-hide-sm layui-show-xs-block">
    <table  class="layui-table" lay-even lay-skin="line" lay-size="lg">
        <colgroup>
            <col>
        </colgroup>
        <tbody>
        <?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><tr>
                <td><a href="<?php echo U('Qrcode/qrlist',['menuid'=>$vo['id']]);?>"><?php echo ($vo["name"]); ?></a></td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<script>
    var right = function(){
        document.querySelector(".qr-right-menu").classList.toggle("active");
    }
</script>
<div class="qr-content">
    <form action="" id="areaform">
        <input type="hidden" name="areaid" value="<?php echo I('get.areaid');?>"/>
        <input type="hidden" name="menuid" value="<?php echo I('get.menuid');?>"/>
        <input type="hidden" name="qr_typeid" value="<?php echo I('get.qr_typeid');?>"/>
    </form>
    <div class="qr-block sort">
        <span>地区:</span>
        <ul class="area">
            <li id="allarea">全部</li>
            <?php if(is_array($area)): foreach($area as $key=>$vo): ?><li id="area<?php echo ($vo["id"]); ?>" data="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
        </ul>
        <span>菜单:</span>
        <ul class="menu">
            <li id="allmenu">全部</li>
            <?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><li id="menu<?php echo ($vo["id"]); ?>" data="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
        </ul>
        <span>分类:</span>
        <ul class="qr_type">
            <li id="allqr_type">全部</li>
            <?php if(is_array($qr_typemenu)): foreach($qr_typemenu as $key=>$vo): ?><li id="qr_type<?php echo ($vo["id"]); ?>" data="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; ?>
        </ul>
    </div>

    <div class="qr-block tuijian layui-row layui-col-space20">
        <?php if(sizeof($qrdata) > 0): if(is_array($qrdata)): foreach($qrdata as $key=>$data): ?><div class="layui-col-xs6 layui-col-sm3">
                <div class="layui-card">
                    <div class="layui-card-body cover">
                        <a href="<?php echo U('Qrcode/view',['id'=>$data[id]]);?>"> <img src="<?php echo ($data["cover"]); ?>" alt=""></a>
                    </div>
                    <div class="layui-card-body">
                        <p class="card-title"><a href="<?php echo U('Qrcode/view',['id'=>$data[id]]);?>"> <span class="card-area"><?php echo ($data["city"]); ?></span><?php echo ($data["title"]); ?></a></p>
                        <p class="card-type"><?php echo ($app_type[$data[app_type]]); ?>-<?php echo ($qr_type[$data[qr_type]]); ?></p>
                        <hr>
                        <div class="layui-row">
                            <span class="card-username layui-col-sm6"><a href="<?php echo U('User/index',['uid'=>$data[memberid]]);?>"> <i class="layui-icon layui-icon-username"></i><?php echo ($data["nickname"]); ?></a></span>
                            <span class="card-date layui-hide-xs layui-col-sm6"><?php echo datef($data[create_time]);?></span>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>
            <?php else: ?>
            <center>
                <img src="/Public/images/nocontent.png" alt="">
            </center><?php endif; ?>
    </div>
</div>


<script>
    window.onload = function(){
        layui.use('jquery', function(){
            var $ = layui.jquery;
            var areaid = "<?php echo I('get.areaid');?>";
            var menuid = "<?php echo I('get.menuid');?>";
            var qr_typeid = "<?php echo I('get.qr_typeid');?>";
            var area = $('.area');
            var menu = $('.menu');
            var qr_type = $('.qr_type');
            if(areaid!=""){
                area.find('li').removeClass('active');
                area.find('#area'+areaid).addClass('active');
            }else{
                area.find('#allarea').addClass('active');
            }
            if(menuid!=""){
                menu.find('li').removeClass('active');
                menu.find('#menu'+menuid).addClass('active');
            }else{
                menu.find('#allmenu').addClass('active');
            }
            if(qr_typeid!=""){
                qr_type.find('li').removeClass('active');
                qr_type.find('#qr_type'+qr_typeid).addClass('active');
            }else{
                qr_type.find('#allqr_type').addClass('active');
            }
            area.find('li').on("click",function () {
                var id = $(this).attr('data');
                $('input[name=areaid]').val(id);
                $('#areaform').submit();
            })
            menu.find('li').on("click",function () {
                var id = $(this).attr('data');
                $('input[name=menuid]').val(id);
                $('input[name=qr_typeid]').val('');
                $('#areaform').submit();
            })
            qr_type.find('li').on("click",function () {
                var id = $(this).attr('data');
                $('input[name=qr_typeid]').val(id);
                $('#areaform').submit();
            })
        });
    }
</script>
<script src="/Public/layui/layui.all.js"></script>
<script>
    var msg = "<?php echo I('get.msg');?>";
    if(msg!=""){
        layer.msg(decodeURIComponent(msg));
    }
</script>
<div class="qr-footer layui-show-xs-block layui-hide-sm">
    <ul class="qr-footer-menu">
        <li><a href="<?php echo U('Index/index');?>"><p><i class="layui-icon layui-icon-home"  style="font-size: 20px"></i></p><p>首页</p></a></li>
        <li><a href="<?php echo U('Qrcode/area');?>"><p><i class="layui-icon layui-icon-location"  style="font-size: 20px"></i></p><p>国家</p></a></li>
        <li class="send"><a href="<?php echo U('Qrcode/create');?>"><i class="layui-icon layui-icon-release"  style="font-size: 20px"></i></a></li>
        <li><a href="<?php echo U('Sns/index');?>"><p><i class="layui-icon layui-icon-chat"  style="font-size: 20px"></i></p><p>社区</p></a></li>
        <li><a href="<?php echo U('User/index');?>"><p><i class="layui-icon layui-icon-user"  style="font-size: 20px"></i></p><p>我的</p></a></li>
    </ul>
</div>
<div class="layui-footer" style="margin-top: 24px">
    <div class="qr-content">

        <div class="layui-row footer-menu layui-hide-xs" style="height: 100px;line-height: 100px">
            <div class="layui-col-sm3">
                &nbsp;
            </div>
            <div class="layui-col-sm6">
                <ul>
                    <li><a href="<?php echo U('About/index',['id'=>'about']);?>">关于我们</a></li>
                    <li><a href="<?php echo U('About/index',['id'=>'userbook']);?>">用户协议</a></li>
                    <li><a href="<?php echo U('About/index',['id'=>'private']);?>">隐私政策</a></li>
                    <li><a href="<?php echo U('About/index',['id'=>'hand']);?>">商业合作</a></li>
                    <li><a href="<?php echo U('About/index',['id'=>'service']);?>">联系我们</a></li>
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