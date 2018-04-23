<?php
return array(
    //'配置项'=>'配置值'
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'zidoo_app', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'usbw', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_CHARSET'=> 'utf8', // 字符集
    'DB_PREFIX'	=>'t_',

    'AUTH_CONFIG'=>array(	//认证配置
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_USER' => 'user',//用户信息表
        'AUTH_SUPER'	=>'admin',//指定超级管理员
    ),
);