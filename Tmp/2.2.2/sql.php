<?php
    function bbs_install(){
        if(is_file(MODEL_PATH . 'Mess.php'))
            unlink(MODEL_PATH . 'Mess.php');
        if(is_file(VIEW_PATH . 'hy_user/user_mess.html'))
            unlink(VIEW_PATH . 'hy_user/user_mess.html');
        
        $sql = S("Plugin");
        //主题锁定
        $table_type = C('SQL_STORAGE_ENGINE') ? C('SQL_STORAGE_ENGINE') : 'MyISAM';
        $Count = M("Count");
        $sql_string ='';
        //清空用户消息
        $config_php = file_get_contents(CONF_PATH   . "config.php");
        if(strpos($config_php,'lang_switch_on') === FALSE && !empty($config_php)){
            $config_php = str_replace(
                                      "'ADMIN_GROUP'",
                                      "'lang_switch_on'=>true,'ADMIN_GROUP'",
                                      $config_php
                                      );
            file_put_contents(CONF_PATH   . "config.php", $config_php);
        }
        $config_php = file_get_contents(CONF_PATH   . "config.php");
        if(strpos($config_php,'more_lang_lib_conf') === FALSE && !empty($config_php)){
            $config_php = str_replace(
                                      "'HY_URL'=>array(",
                                      "'MORE_LANG_LIB_FILE'=>array((defined('MYLIB_PATH') ? MYLIB_PATH : '') . 'more_lang_lib_conf/hybbs.php',),'HY_URL'=>array(",
                                      $config_php
                                      );
            file_put_contents(CONF_PATH   . "config.php", $config_php);
        }
        //清空未读消息
        $sql->query("UPDATE `hy_chat_count` SET `c` = 0;\r\n");
        
        if($Count->xget('1.5.33') != '1'){
            $sql_string.="CREATE TABLE if not exists `hy_log` (
            `uid` INT UNSIGNED NOT NULL ,
            `gold` INT NOT NULL ,
            `credits` INT NOT NULL ,
            `content` VARCHAR(32) NOT NULL ,
            `atime` INT UNSIGNED NOT NULL ,
            KEY `uid` (`uid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;";
            M("Count")->_set('1.5.33',1);
        }
        if($Count->xget('1.5.27') != '1'){
            $sql->query("ALTER TABLE `hy_thread` CHANGE `summary` `summary` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;\r\n");
            M("Count")->_set('1.5.27',1);
        }
        if($Count->xget('1.5.1') != '1'){
            $sql->query("ALTER TABLE `hy_forum` ADD `fgid` INT NOT NULL DEFAULT '1' AFTER `fid`;\r\n");
            $sql_string.="CREATE TABLE if not exists `hy_forum_group` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(32) NOT NULL,
            UNIQUE KEY `id` (`id`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;\r\n";
            //$sql_string.= "INSERT INTO `hy_forum_group` (`id`, `name`) VALUES (1, '默认分组');";
            
        }
        if($Count->xget('1.5') != '1'){
            $sql->query("ALTER TABLE `hy_thread` ADD `state` TINYINT(1) NOT NULL DEFAULT '0' AFTER `gold`;\r\n");
            //删除 用户消息字段
            $sql->query("ALTER TABLE `hy_user` DROP `mess`;\r\n");
            
            
            //用户表增加积分
            $sql->query("ALTER TABLE `hy_user` ADD `credits` INT NOT NULL DEFAULT '0' AFTER `gold`;\r\n");
            //个性签名
            $sql->query("ALTER TABLE `hy_user` ADD `ps` VARCHAR(40) NULL DEFAULT NULL AFTER `etime`;\r\n");
            //用户组积分升级
            $sql->query("ALTER TABLE `hy_usergroup` ADD `credits` INT NOT NULL DEFAULT '-1' AFTER `id`;\r\n");
            //粉丝数量
            $sql->query("ALTER TABLE `hy_user` ADD `fans` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `ps`;\r\n");
            $sql->query("ALTER TABLE `hy_user` ADD `follow` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `fans`;\r\n");
            
            $sql->query("ALTER TABLE `hy_user` ADD `ctime` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `follow`;\r\n");
            $sql->query("ALTER TABLE `hy_user` ADD `file_size` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `ctime`;\r\n");
            //聊天记录空间
            $sql->query("ALTER TABLE `hy_user` ADD `chat_size` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `file_size`;\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` ADD `space_size` INT UNSIGNED NOT NULL DEFAULT '4294967295' AFTER `credits`;\r\n");
            
            $sql->query("ALTER TABLE `hy_usergroup` ADD `chat_size` INT UNSIGNED NOT NULL DEFAULT '4294967295' AFTER `space_size`;\r\n");
            $sql->query("ALTER TABLE `hy_forum` ADD `html` LONGTEXT NOT NULL AFTER `json`;\r\n");
            $sql->query("ALTER TABLE `hy_forum` ADD `background` VARCHAR(30) NOT NULL AFTER `json`;\r\n");
            $sql->query("ALTER TABLE `hy_forum` ADD `color` VARCHAR(30) NOT NULL AFTER `json`;\r\n");
            $sql_string.="DROP TABLE IF EXISTS hy_vote;\r\n";
            $sql_string.="DROP TABLE IF EXISTS hy_mess;\r\n";
            $sql_string.="CREATE TABLE if not exists `hy_chat` (
            `uid1` int(11) NOT NULL,
            `uid2` int(11) NOT NULL,
            `content` tinytext NOT NULL,
            `atime` int(11) NOT NULL,
            KEY `uid1` (`uid1`,`uid2`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            $sql_string.="CREATE TABLE if not exists `hy_chat_count` (
            `uid` int(11) NOT NULL,
            `c` int(11) UNSIGNED NOT NULL DEFAULT '0',
            `atime` int(11) NOT NULL,
            UNIQUE KEY `uid` (`uid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            
            $sql_string.="CREATE TABLE if not exists `hy_friend` (
            `uid1` int(11) NOT NULL,
            `uid2` int(11) NOT NULL,
            `c` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
            `atime` int(11) UNSIGNED NOT NULL DEFAULT '0',
            `state` tinyint(1) NOT NULL DEFAULT '0',
            KEY `uid1` (`uid1`),
            KEY `uid2` (`uid2`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            $sql_string.="CREATE TABLE if not exists `hy_vote_post` (
            `uid` int(11) NOT NULL,
            `pid` int(11) NOT NULL,
            `atime` int(11) NOT NULL,
            KEY `uid` (`uid`),
            KEY `pid` (`pid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            $sql_string.="CREATE TABLE if not exists `hy_vote_thread` (
            `uid` int(11) NOT NULL,
            `tid` int(11) NOT NULL,
            `atime` int(11) NOT NULL,
            KEY `uid` (`uid`),
            KEY `tid` (`tid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            $sql->query("ALTER TABLE `hy_thread` CHANGE `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;\r\n");
            $sql->query("ALTER TABLE `hy_thread` ADD `pid` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `uid`;\r\n");
            M("Count")->_set('1.5',1);
        }
        
        
        
        
        if(M("Count")->xget('2.0.20') != '1'){
            $sql->query("ALTER TABLE `hy_user` ADD `ban_login` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `chat_size`;\r\n");
            $sql->query("ALTER TABLE `hy_user` ADD `ban_post` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `chat_size`;\r\n");
            $sql->query("ALTER TABLE `hy_thread` ADD `etime` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `atime`;\r\n");
            $sql->query("ALTER TABLE `hy_post` ADD `etime` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `atime`;\r\n");
            
            
            M("Count")->_set('2.0.20',1);
        }
        if(M("Count")->xget('2.0.17') != '1'){
            $sql->query("ALTER TABLE `hy_log` ADD `id` INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);\r\n");
            M("Count")->_set('2.0.17',1);
        }
        if(M("Count")->xget('2.0.12') != '1'){
            $sql->query("ALTER TABLE `hy_chat` ADD `id` INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);\r\n");
            M("Count")->_set('2.0.12',1);
        }
        if(M("Count")->xget('2.0') != '1'){
            $sql->query("ALTER TABLE `hy_chat` CHANGE `uid1` `uid1` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_chat` CHANGE `uid2` `uid2` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_chat` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_chat_count` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_chat_count` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_count` DROP INDEX name;\r\n");
            $sql->query("ALTER TABLE `hy_file` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL COMMENT '附件主人UID';\r\n");
            $sql->query("ALTER TABLE `hy_file` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `uid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_file` DROP INDEX uid;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` CHANGE `fileinfoid` `fileid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` DROP INDEX `uid`;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` DROP INDEX `fileinfoid`;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` DROP INDEX `uid_fileinfoid`;\r\n");
            $sql->query("ALTER TABLE `hy_filegold` ADD PRIMARY KEY (`uid`, `fileid`);\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` DROP `id`;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `fileid` `fileid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `gold` `gold` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `downs` `downs` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` CHANGE `hide` `hide` TINYINT(1) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_fileinfo` DROP INDEX `fileid`, ADD PRIMARY KEY (`fileid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_forum` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_forum` CHANGE `fgid` `fgid` INT(10) UNSIGNED NOT NULL DEFAULT '1';\r\n");
            $sql->query("ALTER TABLE `hy_forum` CHANGE `threads` `threads` INT(10) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_forum` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_forum` DROP INDEX `id`, ADD PRIMARY KEY (`id`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_forum_group` DROP INDEX `id`, ADD PRIMARY KEY (`id`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_friend` CHANGE `uid1` `uid1` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_friend` CHANGE `uid2` `uid2` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_friend` CHANGE `state` `state` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_friend` DROP INDEX `uid1_uid2`, ADD PRIMARY KEY (`uid1`, `uid2`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_friend` DROP INDEX `uid1`;\r\n");
            $sql->query("ALTER TABLE `hy_friend` DROP INDEX `uid2`;\r\n");
            $sql->query("ALTER TABLE `hy_friend` DROP INDEX `uid1_uid2_state`;\r\n");
            $sql->query("ALTER TABLE `hy_friend` DROP INDEX `uid1_state`;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `id` `pid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `fid` `fid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `isthread` `isthread` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `goods` `goods` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `nos` `nos` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_post` DROP INDEX `id`, ADD PRIMARY KEY (`pid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_post` DROP INDEX atime;\r\n");
            $sql->query("ALTER TABLE `hy_post` DROP INDEX tid_isthread;\r\n");
            $sql->query("ALTER TABLE `hy_post` DROP INDEX tid_uid;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `id` `tid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `fid` `fid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `buid` `buid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `views` `views` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `goods` `goods` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `nos` `nos` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `gold` `gold` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `top` `top` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `hide` `hide` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_thread` CHANGE `state` `state` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_thread` DROP INDEX `id`, ADD PRIMARY KEY (`tid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_thread` DROP INDEX top_fid;\r\n");
            $sql->query("ALTER TABLE `hy_thread` DROP INDEX img_count;\r\n");
            $sql->query("ALTER TABLE `hy_thread` DROP INDEX atime;\r\n");
            $sql->query("ALTER TABLE `hy_thread` DROP INDEX goods;\r\n");
            $sql->query("ALTER TABLE `hy_threadgold` DROP INDEX `tid_uid`, ADD PRIMARY KEY (`tid`, `uid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `id` `uid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `threads` `threads` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `posts` `posts` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `group` `gid` SMALLINT(2) UNSIGNED NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `gold` `gold` INT(10) NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `credits` `credits` INT(10) NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `etime` `etime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `ctime` `ctime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `file_size` `file_size` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` DROP INDEX `id`, ADD PRIMARY KEY (`uid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_user` DROP INDEX `user`, ADD UNIQUE `user` (`user`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_user` DROP INDEX `email`, ADD UNIQUE `email` (`email`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_user` DROP INDEX atime;\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` CHANGE `id` `gid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` CHANGE `space_size` `space_size` INT(10) UNSIGNED NULL DEFAULT '4294967295';\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` DROP INDEX `id`, ADD PRIMARY KEY (`gid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_vote_post` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_post` CHANGE `pid` `pid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_post` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_post` DROP INDEX `uid`, ADD PRIMARY KEY (`uid`, `pid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_vote_post` DROP INDEX pid;\r\n");
            $sql->query("ALTER TABLE `hy_vote_thread` CHANGE `uid` `uid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_thread` CHANGE `tid` `tid` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_thread` CHANGE `atime` `atime` INT(10) UNSIGNED NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_vote_thread` DROP INDEX `uid`, ADD PRIMARY KEY (`uid`, `tid`) USING BTREE;\r\n");
            $sql->query("ALTER TABLE `hy_vote_thread` DROP INDEX tid;\r\n");
            
            $sql_string.="CREATE TABLE `hy_online` (
            `uid` int(10) UNSIGNED NOT NULL,
            `user` char(18) NOT NULL,
            `gid` int(10) UNSIGNED NOT NULL,
            `atime` int(10) UNSIGNED NOT NULL,
            PRIMARY KEY `uid` (`uid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            
            M("Count")->_set('2.0',1);
        }
        if(M("Count")->xget('2.1.0') != '1'){
            $sql->query("ALTER TABLE `hy_user` ADD `post_ps` INT UNSIGNED NOT NULL AFTER `posts`;\r\n");
            $sql_string.="CREATE TABLE if not exists `hy_post_post` (
            `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `pid` int(10) UNSIGNED NOT NULL,
            `tid` int(10) UNSIGNED NOT NULL,
            `uid` int(10) UNSIGNED NOT NULL,
            `content` longtext NOT NULL,
            `atime` int(10) UNSIGNED NOT NULL,
            `goods` int(10) UNSIGNED DEFAULT '0',
            `nos` int(10) UNSIGNED NOT NULL DEFAULT '0',
            UNIQUE KEY `id` (`id`),
            KEY `pid` (`pid`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;\r\n";
            
            M("Count")->_set('2.1.0',1);
        }
        if(M("Count")->xget('2.1.3') != '1'){
            $sql->query("ALTER TABLE `hy_usergroup` ADD `credits_max` INT NOT NULL DEFAULT '-1' AFTER `credits`;\r\n");
            $sql->query("ALTER TABLE `hy_chat_count` CHANGE `c` `c` INT(11) NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_friend` CHANGE `c` `c` INT(11) NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_log` CHANGE `gold` `gold` INT(11) NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_log` CHANGE `credits` `credits` INT(11) NOT NULL;\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `gold` `gold` INT(11) NOT NULL DEFAULT '0';\r\n");
            $sql->query("ALTER TABLE `hy_user` CHANGE `credits` `credits` INT(11) NOT NULL DEFAULT '0';\r\n");
            M("Count")->_set('2.1.3',1);
        }
        if(M("Count")->xget('2.2') != '1'){
            $sql->query("ALTER TABLE `hy_post` ADD `rpid` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `uid`;\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` ADD `font_css` LONGTEXT NOT NULL AFTER `name`;\r\n");
            $sql->query("ALTER TABLE `hy_usergroup` ADD `font_color` VARCHAR(30) NOT NULL DEFAULT '' AFTER `name`;\r\n");
            
            M("Count")->_set('2.2',1);
        }
        
        if(M("Count")->xget('2.2.1') != '1'){
            $sql_string.="CREATE TABLE if not exists `hy_file_type` (
            `id` INT NOT NULL ,
            `name` VARCHAR(12) NOT NULL ,
            UNIQUE KEY `id` (`id`)
            ) ENGINE={$table_type} DEFAULT CHARSET=utf8;\r\n";
            
            $sql->query("ALTER TABLE `hy_file` ADD `file_type` INT NOT NULL DEFAULT '0' AFTER `filesize`;\r\n");
            $sql->query("ALTER TABLE `hy_friend` ADD `update_time` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `atime`;\r\n");
            $sql->query("UPDATE `hy_file` SET `file_type` = '2';\r\n");
            
            
            
        }
        
        $update_bool = true;
        if(!empty($sql_string)){
            $sql->query($sql_string);
            if($sql->pdo->pdo->errorCode() != 0)
                $update_bool = false;
            
        }
        
        
        if($Count->xget('1.5.1') != '1'){
            if(!S("Forum_group")->has(array('id'=>1))){
                S("Forum_group")->insert(array('id'=>1,'name'=>'默认分组'));
            }
            
            M("Count")->_set('1.5.1',1);
        }
        
        if($Count->xget('2.2.1') != '1'){
            S("file_type")->insert(array('id'=>0,'name'=>'未知'));
            S("file_type")->insert(array('id'=>1,'name'=>'图片'));
            S("file_type")->insert(array('id'=>2,'name'=>'附件'));
            
            M("Count")->_set('2.2.1',1);
        }
        
        
        return $update_bool;
    }
