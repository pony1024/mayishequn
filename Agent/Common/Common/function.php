<?php
function curl_get($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;

}

function curl_post($url,$post_data,$content_type = "application/json"){
    $curl = curl_init(); // 启动一个CURL会话
    $headers = array("Content-type: ".$content_type);
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); // 设置请求头
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        $tmpInfo = 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话

    return $tmpInfo; // 返回数据，json格式
}
function sendMail($to, $subject, $content) {
    vendor('PHPMailer.PHPMailer');
    vendor('PHPMailer.SMTP');     //注意这里的大小写哦，不然会出现找不到类，PHPMailer是文件夹名字，class#phpmailer就代表class.phpmailer.php文件名
    $mail = new PHPMailer();
    // 装配邮件服务器
    if (C('MAIL_SMTP')) {
        $mail->IsSMTP();
    }
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        )
    );
    $mail->Host = C('MAIL_HOST');  //这里的参数解释见下面的配置信息注释
    $mail->SMTPAuth = C('MAIL_SMTPAUTH');
    $mail->Username = C('MAIL_USERNAME');
    $mail->Password = C('MAIL_PASSWORD');
    $mail->SMTPSecure = C('MAIL_SECURE');
    $mail->CharSet = C('MAIL_CHARSET');
    // 装配邮件头信息
    $mail->From = C('MAIL_USERNAME');
    $mail->AddAddress($to);
    $mail->FromName = C('MAIL_FROMNAME');
    $mail->IsHTML(C('MAIL_ISHTML'));
    // 装配邮件正文信息
    $mail->Subject = $subject;
    $mail->Body = $content;
    // 发送邮件
    if (!$mail->Send()) {
        return FALSE;
    } else {
        return TRUE;
    }
}
function logs($rulename,$msg,$username){
    if($rulename=="操作日志"){
        return;
    }
    $log["time"] = time();
    $log["url"] =  CONTROLLER_NAME."/".ACTION_NAME;;
    $log["name"] = $rulename;

    if (CONTROLLER_NAME=="Upload"){
        $log["args"] = "文件";
    }else{
        if(IS_POST){
            $log["method"] = "POST";
            $log["args"] = json_encode(I("post."));
        }else{
            $log["method"] = "GET";
            $log["args"] = json_encode(I("get."));
        }
    }

    $log["isajax"] = "WEB";
    if(IS_AJAX){
        $log["isajax"] = "AJAX";
    }

    $log["username"] = $username;
    $log["ip"] = $_SERVER['REMOTE_ADDR'];
    $log["referer"] = $_SERVER['HTTP_REFERER'];
    $log["ua"] = $_SERVER['HTTP_USER_AGENT'];
    $log["msg"] = $msg;
    M("admin_log")->data($log)->add();
}
function today()//今天
{
    $stime = strtotime(date("Y-m-d 00:00:00"));
    $etime = time();
    return [$stime,$etime];
}
function yesterday()//昨天
{
    $stime = strtotime(date("Y-m-d 00:00:00",strtotime("-1 day")));
    $etime = strtotime(date("Y-m-d 23:59:59",strtotime("-1 day")));
    return [$stime,$etime];
}
function curweek()//本周
{
    $w=date('w');
    //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
    $stime=strtotime(date('Y-m-d 00:00:00',strtotime("-".($w ? $w - 1 : 6).' days')));
    $etime = time();
    return [$stime,$etime];
}
function curmonth()//本月
{
    $stime=strtotime(date('Y-m-01 00:00:00'));
    $etime = time();
    return [$stime,$etime];
}