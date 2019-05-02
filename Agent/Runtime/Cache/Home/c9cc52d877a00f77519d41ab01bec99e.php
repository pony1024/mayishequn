<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>发布二维码 - <?php echo C('sitename');?> - <?php echo C('jieshao');?></title>
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
            发布二维码
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
    <div class="qr-block qr-block-white" >
        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">标题</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" maxlength="16" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">联系方式</label>
                <div class="layui-input-block">
                    <input type="text" name="touid" required  lay-verify="required" placeholder="请输入联系方式" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-inline">
                    <select name="menuid" lay-verify="required" lay-filter="type1">
                        <option value=""></option>
                        <?php if(is_array($menu)): foreach($menu as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="app_type" id="app_type" lay-verify="required">
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="qr_type" id="qr_type" lay-verify="required">
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">国家</label>
                <div class="layui-input-inline">
                    <select name="area" lay-verify="required" lay-filter="area">
                        <option value=""></option>
                        <?php if(is_array($area)): foreach($area as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="country" id="country" lay-verify="required" lay-filter="country">
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="city" id="city" lay-verify="required">
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <!--<label class="layui-form-label">封面</label>-->
                <input type="hidden" name="cover" required  lay-verify="required" >
                <input type="hidden" name="qrcode" required  lay-verify="required" >
                <div class="layui-row layui-col-space20" style="text-align: center">
                    <div class="layui-col-xs12 layui-col-sm4 layui-col-md3">
                        <div class="layui-row layui-col-space10">
                            <div class="layui-col-xs12">
                                <img src="/Public/images/cover.jpg" class="cover" width="200" height="200" alt="">
                            </div>
                            <div class="layui-col-xs12" >
                                <button class="layui-btn" type="button" id="cv-upload" style="width: 200px;"><i class="layui-icon layui-icon-upload"></i> 上传封面</button>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-xs12 layui-col-sm4 layui-col-md3">
                        <div class="layui-row layui-col-space10">
                            <div class="layui-col-xs12">
                                <img src="/Public/images/qrcode.jpg" class="qrcode" width="200" height="200" alt="">
                            </div>
                            <div class="layui-col-xs12">
                                <button class="layui-btn" type="button" id="qr-upload" style="width: 200px;"><i class="layui-icon layui-icon-upload"></i> 上传二维码</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">置顶</label>
                <div class="layui-input-block">
                    <input type="checkbox" name="switch" lay-skin="switch" lay-filter="dotop">
                </div>
            </div>
            <div class="layui-form-item toptime">
                <label class="layui-form-label">置顶时间</label>
                <div class="layui-input-inline">
                    <input type="number" class="layui-input" name="toptime"  placeholder="置顶时间,单位为小时" value="0">
                </div>
                <div class="layui-form-mid layui-word-aux">置顶时间,单位为小时</div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">介绍</label>
                <div class="layui-input-block">
                    <textarea name="content" placeholder="请输入内容" lay-verify="required" maxlength="150" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    window.onload = function(){
        //Demo
        layui.use(['form','jquery','upload'], function(){
            var form = layui.form;
            $ = layui.jquery;
            var upload = layui.upload;
            var menu = <?php echo json_encode($menu);?>;
            var qr_type = <?php echo ($qr_type); ?>;
            var area = <?php echo ($area_submenu); ?>;
            //置顶开关
            form.on('switch(dotop)', function(data){
                if(data.elem.checked){
                    $('.toptime').show();
                }else{
                    $('.toptime').hide();
                }
            });
            //选择类型
            form.on('select(type1)',function (data) {
                console.log(data.value)
                $('#app_type').html('');
                $('#qr_type').html('');
                for(var o in menu){
                    if(menu[o].id == data.value){
                        $('#app_type').append($('<option value=""></option>'))
                        var submenu = menu[o].submenu;
                        for (var i in submenu){
                            $('#app_type').append($('<option value="'+submenu[i].id+'">'+submenu[i].name+'</option>'))
                        }
                        form.render('select');
                        break;
                    }
                }
                for(var o in qr_type){
                    if(qr_type[o].id == data.value){
                        $('#qr_type').append($('<option value=""></option>'))
                        var submenu = qr_type[o].submenu;
                        for (var i in submenu){
                            $('#qr_type').append($('<option value="'+submenu[i].id+'">'+submenu[i].name+'</option>'))
                        }
                        form.render('select');
                        break;
                    }
                }
            });
            //选择区域
            form.on('select(area)',function (data) {
                if(data.value==""){
                    return;
                }
                $('#country').html('');
                var layid = layer.load(2)
                $.ajax({
                    url:"<?php echo U('Area/getcountry');?>?pid="+data.value,
                    type:"get",
                    success:function (data) {
                        if(!!data.success){
                            $('#country').append($('<option value=""></option>'))
                            for (var i in data.msg){
                                $('#country').append($('<option value="'+data.msg[i].id+'">'+data.msg[i].name+'</option>'))
                            }
                            form.render('select');
                        }else{
                            layer.msg(data.msg,{icon:2})
                        }
                    },
                    complete:function () {
                        layer.close(layid);
                    }
                })
            });
            //选择国家
            form.on('select(country)',function (data) {
                if(data.value==""){
                    return;
                }
                $('#city').html('');
                var layid = layer.load(2)
                $.ajax({
                    url:"<?php echo U('Area/getcity');?>?pid="+data.value,
                    type:"get",
                    success:function (data) {
                        if(!!data.success){
                            $('#city').append($('<option value=""></option>'))
                            for (var i in data.msg){
                                $('#city').append($('<option value="'+data.msg[i].id+'">'+data.msg[i].name+'</option>'))
                            }
                            form.render('select');
                        }else{
                            layer.msg(data.msg,{icon:2})
                        }
                    },
                    complete:function () {
                        layer.close(layid);
                    }
                })
            });
            upload.render({
                elem:"#qr-upload",
                url:"<?php echo U('Upload/index');?>",
                choose:function(){
                    layid = layer.load(2)
                },
                done:function (res) {
                    layer.close(layid);
                    if(!!res.file){
                        var file = res.file;
                        var path = "/Uploads/"+file.savepath+file.savename;
                        $('input[name=qrcode]').val(path);
                        $('.qrcode').attr("src",path);
                    }else{
                        layer.msg(res.info,{icon:2})
                    }
                },
                error:function (e) {
                    layer.close(layid);
                }
            });
            upload.render({
                elem:"#cv-upload",
                url:"<?php echo U('Upload/index');?>",
                choose:function(){
                    layid = layer.load(2)
                },
                done:function (res) {
                    layer.close(layid);
                    if(!!res.file){
                        var file = res.file;
                        var path = "/Uploads/"+file.savepath+file.savename;
                        $('input[name=cover]').val(path);
                        $('.cover').attr("src",path);
                    }else{
                        layer.msg(res.info,{icon:2})
                    }

                },
                error:function (e) {
                    layer.close(layid);
                }
            });
            //监听提交
            form.on('submit(formDemo)', function(data){
                //layer.msg(JSON.stringify(data.field));
                var layid = layer.load(2)
                $.ajax({
                    type:"post",
                    data:data.field,
                    success:function (data) {
                        if(!!data.success){
                            location.href="<?php echo U('User/index');?>";
                        }else{
                            layer.msg(data.msg,{icon:2})
                        }
                    },
                    complete:function () {
                        layer.close(layid);
                    }
                })
                return false;
            });
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