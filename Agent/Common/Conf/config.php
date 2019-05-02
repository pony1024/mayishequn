<?php
return array(
    //数据库配置项
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '202.60.235.50', // 服务器地址
    'DB_NAME'   => 'www_mysq_gq', // 数据库名
    'DB_USER'   => 'www_mysq_gq', // 用户名
    'DB_PWD'    => 'M6NWFwTX5W5hYZFx', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
    //网站配置项
    'DEFAULT_CHARSET' => 'utf-8',
    'sitename'=>'蚂蚁社群',
    'jieshao'=>'立足于菲律宾，服务全球海外华人',
    // 配置邮件发送服务器
    'MAIL_SMTP'            =>  TRUE,
    'MAIL_HOST'            =>  'smtp.gmail.com',          //邮件发送SMTP服务器
    'MAIL_SMTPAUTH'   =>  TRUE,
    'MAIL_USERNAME'   =>  'mayishequn@gmail.com',       //SMTP服务器登陆用户名
    'MAIL_PASSWORD'   =>  'AdGjMpTw1.',              //SMTP服务器登陆密码
    'MAIL_SECURE'         =>  'tls',
    'MAIL_CHARSET'       =>  'utf-8',
    'MAIL_ISHTML'         =>  TRUE,
    'MAIL_FROMNAME' =>  '蚂蚁社群',
    //文件上传配置项
    'upload' => array(
        'maxSize'    =>    3145728,
        'rootPath'   =>    './Uploads/',
        'savePath'   =>    '',
        'saveName'   =>    array('uniqid',''),
        'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        'autoSub'    =>    true,
        'subName'    =>    array('date','Ymd'),
    )
);