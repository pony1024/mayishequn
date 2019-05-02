<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>帮助手册 - <?php echo C('sitename');?> - <?php echo C('jieshao');?></title>
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
            帮助手册
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
    <div class="qr-block">
        <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
            <ul class="layui-tab-title">
                <li class="about layui-this">关于我们</li>
                <li class="userbook">用户协议</li>
                <li class="private">隐私政策</li>
                <li class="hand">商业合作</li>
                <li class="service">联系我们</li>
            </ul>
            <div class="layui-tab-content" style="min-height: 640px">
                <div class="layui-tab-item about layui-show">
                    一般社会学家与地理学家所指的社群(community)，广义而言是指在某些边界线、地区或领域内发生作用的一切社会关系。<br><br>
                    它可以指实际的地理区域或是在某区域内发生的社会关系，或指存在于较抽象的、思想上的关系，除此之外。<br><br>
                    Worsley(1987)曾提出社群的广泛涵义：<br><br>
                    可被解释为地区性的社区；<br><br>
                    用来表示一个有相互关系的网络；<br><br>
                    社群可以是一种特殊的社会关系，<br><br>
                    包含社群精神(community spirit)或社群情感(community feeling) 。<br><br>
                    蚂蚁社群，立足于菲律宾，服务于全球海外华人，帮助刚出国的小白快速找到属于自己的圈子。<br><br>
                    蚂蚁社群名称的含义:<br><br>
                    蚂蚁——象征着在海外漂泊的游子，渺小但坚强;<br><br>
                    蚂——谐音码，表示二维码;<br><br>
                    蚁——谐音亿，表示很多;<br><br>
                    蚂蚁社群域名（www.mysq.gq）的含义:<br><br>
                    WWW——World Wide Web<br><br>
                    MYSQ——蚂蚁社群拼音MA-YI-SHE-QUN的首字母简写<br><br>
                    GQ——群二维码英文GROUP-QRCODE的首字母简写<br><br>
                    蚂蚁是群居动物，象征着团结，蚂蚁社群综合意义就是一个有亿万个二维码组成的一个大圈子。<br><br>
                    在这里，你可以找到你附近的圈子;<br><br>
                    在这里，你可以发布你的群组，让更多的朋友加入你的圈子;<br><br>
                    在这里，能够让你认识更多各行各业的朋友;<br><br>
                    在这里，你能实现儿时的梦;<br><br>
                    在这里，你将拥有一切。。。<br><br>
                    蚂蚁社群——亿万海外华人的新手村<br><br>
                </div>
                <div class="layui-tab-item userbook">您在注册成为蚂蚁社群用户时，即表示您接受本协议所包含的所有条款和条件的约束。本协议阐述之条款和条件适用于您使用蚂蚁社群网站所提供的各种工具和服务(下称“服务”)。<br><br>1. 接受条款。<br><br>进入蚂蚁社群网站即表示您同意自己已经与蚂蚁社群订立本协议，且您将受本协议的条款和条件 (“条款”) 约束。蚂蚁社群可随时自行全权决定更改“条款”。如“条款”有任何变更，蚂蚁社群将在其网站上要求公告，通知予您。如您不同意相关变更，必须停止使用“服务”。经修订的“条款”一经在蚂蚁社群网站公布后，立即自动生效。您应在第一次登录后仔细阅读修订后的“条款”，并有权选择停止继续使用“服务”；一旦您继续使用“服务”，则表示您已接受经修订的“条款”，当您与蚂蚁社群发生争议时，应以最新的服务协议为准。除另行明确声明外，任何使“服务”范围扩大或功能增强的新内容均受本协议约束。<br><br>2. 谁可使用蚂蚁社群？<br><br>“服务”仅供能够根据相关法律规定的有完全民事行为能力的人（自然人或单位和个人）。蚂蚁社群可随时自行全权决定拒绝向任何人士提供“服务”。<br><br>3. 费用。<br><br>蚂蚁社群保留在根据第1条通知您后，收取“服务”费用的权利。您因进行交易、向蚂蚁社群获取有偿服务或其他行为而发生的相关税赋和费用均由您自行承担。蚂蚁社群保留在无须发出书面通知，仅在本网站公示的情况下，暂时或永久地更改或停止部分或全部“服务”的权利。<br><br>4.1 注册义务。<br><br>如您在蚂蚁社群网站注册，您同意：(a) 根据蚂蚁社群所要求的会员资料，提供关于您或贵单位和个人的真实、准确、完整和反映当前情况的资料；(b) 维持并及时更新会员资料，使其保持真实、准确、完整和反映当前情况。倘若您提供任何不真实、不准确、不完整或不能反映当前情况的资料，或蚂蚁社群有合理理由怀疑该等资料不真实、不准确、不完整或不能反映当前情况，蚂蚁社群有权暂停或终止您的注册身份及资料，并拒绝您在目前或将来对“服务”(或其任何部份) 以任何形式使用。如您代表一家单位和个人或其他法律主体在蚂蚁社群登记，则您声明和保证，您有权使该单位和个人或其他法律主体接受本协议“条款”约束。<br><br>4.2 会员注册名、密码和保密。<br><br>在登记过程中，您将选择会员注册名和密码。您须自行负责对您的会员注册名和密码保密，且须对您在会员注册名和密码下发生的所有活动承担责任。您同意：(a) 如发现任何人未经授权使用您的会员注册名或密码，或发生违反保密规定的任何其他情况，您会立即通知蚂蚁社群；及 (b) 确保您在每个上网时段结束时，以正确步骤离开网站。蚂蚁社群不能也不会对因您未能遵守本款规定而发生的任何损失或损毁负责。<br><br>4.3 用户管理<br><br>用户单独承担发布内容的责任。用户对服务的使用是根据所有适用于服务的地方法律、国家法律和国际法律标准的。用户承诺：<br><br>（1）在蚂蚁社群的网页上发布信息或者利用蚂蚁社群的服务时必须符合中国有关法规，不得在蚂蚁社群的网页上或者利用蚂蚁社群的服务制作、复制、发布、传播以下信息：<br><br>  (a)反对宪法所确定的基本原则的；<br><br>  (b)危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；<br><br>  (c)损害国家荣誉和利益的；<br><br>  (d)煽动民族仇恨、民族歧视，破坏民族团结的；<br><br>  (e)破坏国家宗教政策，宣扬邪教和封建迷信的；<br><br>  (f)散布谣言，扰乱社会秩序，破坏社会稳定的；<br><br>  (g)散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；<br><br>  (h)侮辱或者诽谤他人，侵害他人合法权益的；<br><br>  (i)含有法律、行政法规禁止的其他内容的。<br><br>（2）在蚂蚁社群的网页上发布信息或者利用蚂蚁社群的服务时还必须符合其他有关国家和地区的法律规定以及国际法的有关规定。<br><br>（3）不利用蚂蚁社群的服务从事以下活动：<br><br>  (a)未经允许，进入计算机信息网络或者使用计算机信息网络资源的；<br><br>  (b)未经允许，对计算机信息网络功能进行删除、修改或者增加的；<br><br>  (c)未经允许，对进入计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加的；<br><br>  (d)故意制作、传播计算机病毒等破坏性程序的；<br><br>  (e)其他危害计算机信息网络安全的行为。<br><br>（4）不以任何方式干扰蚂蚁社群的服务。<br><br>（5）遵守蚂蚁社群的所有其他规定和程序。<br><br>（6）对于存在恶意刷票行为的问卷，蚂蚁社群有权在不事先通知用户的情况下直接终止此问卷。<br><br>用户须对自己在使用蚂蚁社群服务过程中的行为承担法律责任。用户承担法律责任的形式包括但不限于：对受到侵害者进行赔偿，以及在蚂蚁社群首先承担了因用户行为导致的行政处罚或侵权损害赔偿责任后，用户应给予蚂蚁社群等额的赔偿。用户理解，如果蚂蚁社群认为用户发布的信息明显属于上段第(1)条所列内容之一，依据中国法律，蚂蚁社群有权利立即停止向该用户提供服务，删除该用户发布的非法信息，并保存有关记录向国家有关机关报告。<br><br>用户使用蚂蚁社群电子公告服务，包括电子布告牌、电子白板、电子论坛、网络聊天室和留言板等以交互形式为上网用户提供信息发布条件的行为，也须遵守本条的规定以及蚂蚁社群将专门发布的电子公告服务规则，上段中描述的法律后果和法律责任同样适用于电子公告服务的用户。若用户的行为不符合以上提到的服务条款，蚂蚁社群将作出独立判断立即取消用户服务帐号。<br><br>4.4 关于您的资料的规则。<br><br>您同意，“您的资料”<br><br>a. 不会有欺诈成份，与伪造或盗窃无涉；<br><br>b. 不会侵犯任何第三者享有的物权、版权、专利、商标、商业秘密或其他知识产权，或隐私权、名誉权；<br><br>c. 不会违反任何法律、法规、条例或规章；<br><br>d. 不会含有诽谤（包括商业诽谤）、非法恐吓或非法骚扰的内容；<br><br>e. 不会含有淫秽、或包含任何儿童色情内容；<br><br>f. 不会含有蓄意毁坏、恶意干扰、秘密地截取或侵占任何系统、数据或个人资料的任何病毒、伪装破坏程序、电脑蠕虫、定时程序炸弹或其他电脑程序；<br><br>g. 不会直接或间接与下述各项服务连接，或包含对下述各项服务的描述：(i) 本协议项下禁止的服务；或(ii) 您无权连接或包含或服务。此外，您同意不会：(h) 在与任何连锁信件、大量胡乱邮寄的电子邮件、滥发电子邮件或任何复制或多余的信息有关的方面使用“服务”；(i) 未经其他人士同意，利用“服务”收集其他人士的电子邮件地址及其他资料；或 (j) 利用“服务”制作虚假的电子邮件地址，或以其他形式试图在发送人的身份或信息的来源方面误导其他人士。<br><br>5. 您授予本单位和个人的许可使用权。<br><br>您授予本单位和个人独家的、全球通用的、永久的、免费的许可使用权利 (并有权在多个层面对该权利进行再授权)，使本单位和个人有权(全部或部份地) 使用、复制、修订、改写、发布、翻译、分发、执行和展示“您的资料”或制作其派生作品，和/或以现在已知或日后开发的任何形式、媒体或技术，将“您的资料”纳入其他作品内。此条款不适用于专业版或企业版用户，并且对于专业版或企业版用户设置为不公开的问卷以及答卷数据，蚂蚁社群不得以任何形式向第三方公开。<br><br>6. 隐私。<br><br>尽管有第5条所规定的许可使用权，蚂蚁社群将仅根据蚂蚁社群的隐私声明使用“您的资料”。蚂蚁社群隐私声明的全部条款属于本协议的一部份，因此，您必须仔细阅读。蚂蚁社群承诺绝对不会在未经您同意的情况下有意或无意向任何第三方泄漏您的隐私。<br><br>7. 终止或访问限制。<br><br>您同意，根据本协议的任何规定终止您使用“服务”之措施可在不发出事先通知的情况下实施，并承认和同意，蚂蚁社群可立即使您的帐户无效，或撤销您的帐户以及在您的帐户内的所有相关资料和档案，和/或禁止您进一步接入该等档案或“服务”。帐号终止后，蚂蚁社群没有义务为您保留原帐号中或与之相关的任何信息，或转发任何未曾阅读或发送的信息给您或第三方。此外，您同意，蚂蚁社群不会就终止您接入“服务”而对您或任何第三者承担任何责任。第9、10、11和19各条应在本协议终止后继续有效。<br><br>8. 违反规则会有什么后果？<br><br>在不限制其他补救措施的前提下，发生下述任一情况，蚂蚁社群可立即发出警告，暂时中止、永久中止或终止您的会员资格，删除您的任何现有信息，以及您在网站上展示的任何其他资料：(i) 您违反本协议；(ii) 蚂蚁社群无法核实或鉴定您向蚂蚁社群提供的任何资料；或 (iii) 蚂蚁社群相信您的行为可能会使您、蚂蚁社群用户或通过蚂蚁社群或蚂蚁社群网站提供服务的第三者服务供应商发生任何法律责任。在不限制任何其他补救措施的前提下，倘若发现您从事涉及蚂蚁社群网站的诈骗活动，蚂蚁社群可暂停或终止您的帐户。<br><br>9. 服务“按现状”提供。<br><br>蚂蚁社群会尽一切努力使您在使用蚂蚁社群网站的过程中得到乐趣。遗憾的是，蚂蚁社群不能随时预见到任何技术上的问题或其他困难。该等困难可能会导致数据损失或其他服务中断。为此，您明确理解和同意，您使用“服务”的风险由您自行承担。“服务”以“按现状”和“按可得到”的基础提供。蚂蚁社群明确声明不作出任何种类的所有明示或暗示的保证，包括但不限于关于适销性、适用于某一特定用途和无侵权行为等方面的保证。蚂蚁社群对下述内容不作保证：(i)“服务”会符合您的要求；(ii)“服务”不会中断，且适时、安全和不带任何错误；(iii) 通过使用“服务”而可能获取的结果将是准确或可信赖的；及 (iv) 您通过“服务”而购买或获取的任何产品、服务、资料或其他材料的质量将符合您的预期。通过使用“服务”而下载或以其他形式获取任何材料是由您自行全权决定进行的，且与此有关的风险由您自行承担，对于因您下载任何该等材料而发生的您的电脑系统的任何损毁或任何数据损失，您将自行承担责任。您从蚂蚁社群或通过或从“服务”获取的任何口头或书面意见或资料，均不产生未在本协议内明确载明的任何保证。<br><br>10. 责任范围。<br><br>您明确理解和同意，蚂蚁社群不对因下述任一情况而发生的任何损害赔偿承担责任，包括但不限于利润、商誉、使用、数据等方面的损失或其他无形损失的损害赔偿 (无论蚂蚁社群是否已被告知该等损害赔偿的可能性)：(i) 使用或未能使用“服务”；(ii) 因通过或从“服务”购买或获取任何货物、样品、数据、资料或服务，或通过或从“服务”接收任何信息或缔结任何交易所产生的获取替代货物和服务的费用；(iii) 未经批准接入或更改您的传输资料或数据；(iv) 任何第三者对“服务”的声明或关于“服务”的行为；或 (v) 因任何原因而引起的与“服务”有关的任何其他事宜，包括疏忽。<br><br>11. 赔偿。<br><br>您同意，因您违反本协议或经在此提及而纳入本协议的其他文件，或因您违反了法律或侵害了第三方的权利，而使第三方对蚂蚁社群、董事、职员、代理人提出索赔要求（包括司法费用和其他专业人士的费用），您必须赔偿给蚂蚁社群、董事、职员、代理人，使其等免遭损失。<br><br>12. 遵守法律。<br><br>您应遵守与您使用“服务”有关的所有相关的法律、法规、条例和规章。<br><br>13. 无代理关系。<br><br>您与蚂蚁社群仅为独立订约人关系。本协议无意结成或创设任何代理、合伙、合营、雇用与被雇用或特许权授予与被授予关系。<br><br>14. 广告和金融服务。<br><br>您与在“服务”上或通过“服务”物色的刊登广告人士通讯或进行业务往来或参与其推广活动，包括就相关信息或服务付款和交付相关信息或服务，以及与该等业务往来相关的任何其他条款、条件、保证或声明，仅限于在您和该平台刊登广告之间发生。您同意，对于因任何该等业务往来或因在“服务”上出现该等刊登广告人士而发生的任何种类的任何损失或损毁，蚂蚁社群无需负责或承担任何责任。您如打算通过“服务”创设或参与任何单位和个人、股票行情、投资或证券有关的任何服务，或通过“服务”收取或要求与任何单位和个人、股票行情、投资或证券有关的任何新闻信息、警戒性信息或其他资料，敬请注意，蚂蚁社群不会就通过“服务”传送的任何该等资料的准确性、有用性或可用性、可获利性负责或承担任何责任，且不会对根据该等资料而作出的任何交易或投资决策负责或承担任何责任。<br><br>15. 链接。<br><br>“服务”或第三者均可提供与其他万维网网站或资源的链接。由于蚂蚁社群并不控制该等网站和资源，您承认并同意，蚂蚁社群并不对该等外在网站或资源的可用性负责，且不认可该等网站或资源上或可从该等网站或资源获取的任何内容、宣传、产品、服务或其他材料，也不对其等负责或承担任何责任。您进一步承认和同意，对于任何因使用或信赖从此类网站或资源上获取的此类内容、宣传、产品、服务或其他材料而造成（或声称造成）的任何直接或间接损失，蚂蚁社群均不承担责任。<br><br>16. 通知。<br><br>除非另有明确规定，任何通知应以电子邮件形式发送，(就蚂蚁社群而言) 电子邮件地址为13739@qq.com，或 (就您而言) 发送到您在登记过程中向蚂蚁社群提供的电子邮件地址，或有关方指明的该等其他地址。在电子邮件发出二十四 (24) 小时后，通知应被视为已送达，除非发送人被告知相关电子邮件地址已作废。或者，蚂蚁社群可通过邮资预付挂号邮件并要求回执的方式，将通知发到您在登记过程中向蚂蚁社群提供的地址。在该情况下，在付邮当日三 (3) 天后通知被视为已送达。<br><br>17. 不可抗力。<br><br>对于因蚂蚁社群合理控制范围以外的原因，包括但不限于自然灾害、罢工或骚乱、物质短缺或定量配给、暴动、战争行为、政府行为、通讯或其他设施故障或严重伤亡事故等，致使蚂蚁社群延迟或未能履约的，蚂蚁社群不对您承担任何责任。<br><br>18. 转让。<br><br>蚂蚁社群转让本协议无需经您同意。<br><br>19. 其他规定。<br><br>本协议构成您和蚂蚁社群之间的全部协议，规定了您对“服务”的使用，并取代您和蚂蚁社群先前订立的任何书面或口头协议。本协议各方面应受中华人民共和国大陆地区法律的管辖。倘若本协议任何规定被裁定为无效或不可强制执行，该项规定应被撤销，而其余规定应予执行。条款标题仅为方便参阅而设，并不以任何方式界定、限制、解释或描述该条款的范围或限度。蚂蚁社群未就您或其他人士的某项违约行为采取行动，并不表明蚂蚁社群撤回就任何继后或类似的违约事件采取行动的权利。<br><br>20. 诉讼。<br><br>因本协议或蚂蚁社群服务所引起或与其有关的任何争议应向人民法院提起诉讼，并以中华人民共和国法律为管辖法律。</div>
                <div class="layui-tab-item private">蚂蚁社群.（以下简称“公司”）遵守相关法律法规规定的个人信息保护规定，如“通信保密法”，“电信业务法”，“信息促进法”和通信网络利用和信息保护等，信息通信技术服务提供商必须遵守的个人信息保护法等，并根据相关法律法规制定个人信息保护政策，努力保护适用于用户的权利。 。<br><br>本公司认为订阅蚂蚁社群及其他附带服务的用户权利至关重要，其个人信息保护政策如下。<br><br>第1条（收集个人信息的目的）<br>公司为以下目的收集用户的个人信息。除下述规定外，不得使用此类个人信息，并且在发生任何变更的情况下，计划采取必要的措施，例如根据相关法规要求单独的同意等。<br><br>提供蚂蚁社群服务<br><br>用途包括确认服务使用意图，根据执行有限身份确认机制进行自我确认，防止非法服务使用，在处理14岁以下个人信息时对法定代理人同意的确认，各种通知/通知，付款等等<br><br>会员管理和投诉等<br><br>目的包括提供会员服务，会员资格维护/管理，投诉人的各种通知/通知和身份确认，投诉事项确认，事实调查联络/通知，处理结果通知等方面的自我验证/认证<br><br>新服务开发与营销<br><br>目的包括新服务开发和提供定制服务，根据统计特征和广告显示提供服务，确认服务有效性，提供活动信息和参与机会，提供营销信息，了解联系频率，有关会员服务使用的统计数据等。<br><br>第2条（个人信息项目）<br>本公司在使用蚂蚁社群和其他附带服务的过程中收集以下个人信息。<br><br>执行有关蚂蚁社群服务等的协议<br><br>必填项目：电子邮件，昵称或名称以及会员账号<br>可选项目：性别，年龄<br>会员管理和投诉等<br><br>电子邮件地址，姓名等（如果会员通过电子邮件或其他方式向公司查询，则应处理并回复请求，并且为了改进蚂蚁社群服务，可能会保留相关内容，包括用户名，电子邮件地址。 ）<br>以下个人信息项目可能会在使用互联网服务的过程中自动生成和收集。<br><br>日志数据（包括IP信息，浏览器类型，搜索域名，访问页面，电信公司分类，移动设备和应用程序ID，搜索词等）和链接，cookie数据，蚂蚁社群服务使用记录，不良使用记录等信息。<br>第3条（个人信息共享及其提供）<br>公司应仅在第1条规定的限度内使用用户的个人信息，未经用户事先同意，不得超出标准或公开披露。但以下是例外情况。<br><br>如果用户事先同意<br>如有必要，由于提供信息通信服务而支付任何款项<br>如果需要统计，学术研究或市场研究，以处理数据的形式提供任何特定个人无法识别的数据<br>如果相关机构根据相关立法按照标准程序和方法提出要求<br>如果其他法律包含特殊规定<br>如果信息通信伦理委员会（即ICEC）根据相关立法提出要求<br>第4条（个人信息的维护和使用期限）<br>公司应在维护和使用期间根据相关法律或经用户同意维护和使用个人信息。<br><br>一旦达到维护和使用信息的目的，用户信息原则上应毫不拖延地销毁。但如果公司有义务或允许根据商业法等相关法律保留包含个人详细信息的信息，公司可以维持相关法律规定的期限。<br><br>第5条（破坏个人信息的程序和方法）<br>在通过维护期后，实现个人信息处理等目的时，公司会毫不拖延地销毁用户的个人信息。<br><br>尽管通过了关于用户同意的个人信息的维护期或实现其过程目的，但如果公司有义务根据其他法规保留个人信息，则应将此类信息转移到单独的数据库或维护在不同的存储中地点。<br><br>公司的个人信息破坏程序和方法如下。<br><br>销毁程序<br><br>经公司保护监督员批准后，公司应根据销毁原因选择信息后销毁个人信息。<br><br>破坏方法<br><br>公司应通过利用碎纸机或焚烧方式销毁以硬拷贝记录/存储的个人信息，并通过技术删除以软拷贝记录/存储的个人信息，以防止任何恢复。<br><br>第6条（用户和法定代理人的权利以及行使方法）<br>用户和法定代理人（以下简称“用户等”）可以随时搜索和修改14岁以下自己/孩子的个人信息，并要求取消会员资格。<br><br>用户等等为了取消会员资格（即撤销协议），点击主页上的“我的蚂蚁社群”菜单，然后完成身份确认过程，然后直接检查，更正或撤销就成为可能。<br><br>对于前面第六条第（2）款的规定，如果用户等联系个人信息保护主管通过信件，电话或电子邮件要求检查，更正或撤回，公司应立即采取行动，不得有任何延误。<br><br>如果用户等要求纠正错误，公司将不会使用相关信息或提供第三方，直到更正为止。如果已提供任何不正确的个人信息，公司应通知第三方此类更正，从而完成更正程序<br><br>公司应根据第4条和第5条的规定，处理用户等要求取消或删除的个人信息，防止其检查或用于其他目的。<br><br>第7条（关于个人信息保护的技术/管理措施）<br>在处理用户个人信息的过程中，公司应考虑采取以下技术/管理措施，以确保个人信息不会丢失，被盗，泄露，伪造或受到损害。<br><br>针对黑客攻击准备的措施等：它经常进行数据备份，以防止对个人信息造成任何伤害，防止用户的个人信息被最新的疫苗程序泄漏或损坏，并通过加密通信等在网络上安全地传输个人信息此外，它利用黑客防火墙系统控制来自外部的未经授权的访问，并承诺安装所有技术设备，以确保系统的安全性。<br><br>最大限度地减少处理人员和培训：公司的个人信息处理人员仅限于负责人，在这方面它给予单独的密码定期更新，并进一步强调通过频繁的相关的公司个人信息保护政策的遵守为负责人提供培训。<br><br>经营独家个人信息保护工作组：执行个人信息保护政策和对负责人的合规性通过运营专属个人信息保护工作组等确认，公司已尽力解决可能发生的任何问题。<br><br>但由于用户疏忽或互联网问题，公司对由于身份证，密码，国民身份证号码等个人信息的泄露而引起的事务概不负责。</div>
                <div class="layui-tab-item hand">
                    联系微信：ponysoftware<br><br>
                    <img src="/Public/images/wx.jpg" width="300">
                </div>
                <div class="layui-tab-item service">
                    联系微信：ponysoftware<br><br>
                    <img src="/Public/images/wx.jpg" width="300"><br><br>
                    微信公众号：www_mysq_gq<br><br>
                    <img src="/Public/images/wxp.jpg" width="300"><br><br>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    window.onload = function(){
        layui.use('jquery', function(){
            var id = "<?php echo I('get.id');?>";
            var $ = layui.jquery;
            if(id!=""){
                $('.layui-tab-title li').removeClass('layui-this');
                $('.layui-tab-title li.'+id).addClass('layui-this');
                $('.layui-tab-content .layui-tab-item').removeClass('layui-show');
                $('.layui-tab-content .layui-tab-item.'+id).addClass('layui-show');
            }
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