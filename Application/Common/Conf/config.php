<?php
return array(
	//'配置项'=>'配置值'
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => '127.0.0.1', // 服务器地址
		'DB_NAME'   => 'queueup', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => '12345678', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PARAMS' =>  array(), // 数据库连接参数
		'DB_PREFIX' => '', // 数据库表前缀
		'DB_CHARSET'=> 'utf8', // 字符集
		'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
		
		//小程序APPID和APPSECRET
		'APPID'=>'wx3e48bc922f5ecc42',
		'APPSECRET'=>'4f339d067fb4bb1f4d5ed31a4b6de2c8',
		
		'BASE_URL' => 'http://localhost:8080/queueup',
		
		'ADMIN_USERNAME' => 'admin',
		'ADMIN_PASSWORD' => '123456',
		
		'USER_USERNAME' => 'xujing',
		'USER_PASSWORD' => '123456',
		
// 		'MODULE_ALLOW_LIST'    =>    array('Home','Api'),
// 		'DEFAULT_MODULE'       =>    'Home',
);