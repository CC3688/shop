<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀
    'SHOW_PAGE_TRACE'       =>  true,
    //图片相关的配置文件
    'IMG_maxSizw'           => '3M',
    'IMG_exts'              => array('jpg', 'gif', 'png', 'jpeg','bmp'),
    'IMG_rootPath'          => './Uploads/',
    /******* 修改I函数底层过滤函数 ***********/
    'DEFAULT_FILTER'        =>'trim,removeXSS',
);