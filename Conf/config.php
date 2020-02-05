<?php
return array(
    'DEBUG_PAGE'=>true,
    'REWRITE'=>false,//伪静态规则

    'DOMAIN_NAME' => 'http://127.0.0.1/test',

    'url_suffix'=>'.html',
    'url_explode'=>'/',
    'PLUGIN_DOWN'=>'http://bbs.hyphp.cn/' ,//官方下载服务器 ,这个不是你的域名填写地方 ，没事勿修改

    'HY_URL'=>array(
        'action'=>array(
            'thread'=>'t',
            'forum'=>'f',
            'my'=>'u',
        ),
        'method'=>array(
            'thread'=>array(
                'del'=>'d'
            )
        )
    ),
    'MORE_LANG_LIB_FILE'=>array(
            (defined('MYLIB_PATH') ? MYLIB_PATH : '') . 'more_lang_lib_conf/hybbs.php',
    ),

    //数据库类型
    "SQL_TYPE" => "mysql",
    //数据库名称
    "SQL_NAME" => "hybbs",
    //数据库地址
    "SQL_IP"=>"localhost",
    //数据库账号
    'SQL_USER' => 'root',
    //数据密码
    'SQL_PASS' => 'root',
    //数据库字符集
    'SQL_CHARSET' => 'utf8',
    //数据库端口
    'SQL_PORT' => 3306,
    //数据库前缀
    'SQL_PREFIX' => 'hy_',
    //PDO配置
    'SQL_OPTION' => array(
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        //PDO::ATTR_PERSISTENT => true //长连接
    ),
    'SQL_STORAGE_ENGINE'=>'MyISAM',

    //全站加密字符串, 请勿泄露 安装时会随机生成 , 注意备份!
    //目前用于用户信息COOKIE加密
    //缓存文件名加密
    //头像文件名加密
    'MD5_KEY' => 'kz9FrbBxUvNVv2bg',

    //管理员用户组 ID
    'ADMIN_GROUP' =>1,
    'lang_switch_on'=>true,

    'TMP_PATH_KEY'      =>  'FYitdm0ngsU590Up',
    'TMP_PATH_PREFIX'   =>  'un4RoJPq',




);
