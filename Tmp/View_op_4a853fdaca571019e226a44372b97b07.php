<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
<!DOCTYPE html>
<html>
  	<head>
	    <meta charset="utf-8">
	    <title>HYBBS后台管理系统</title>
	    <meta name="renderer" content="webkit">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit" />
		<meta name="viewport" content="width=device-width, user-scalable=yes" />
	    <meta name="description" content="">
	    <meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo WWW;?>favicon.ico">
        <link href="<?php echo WWW;?>public/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?php echo WWW;?>public/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo WWW;?>public/css/alert.css" rel="stylesheet">
		<!-- Simplify -->
		<link href="<?php echo WWW;?>public/admin/css/simplify.min.css?var=2.1" rel="stylesheet">
        <script type="text/javascript">
            var www="<?php echo WWW;?>";
            var exp="<?php echo EXP;?>";
        </script>
        <style type="text/css">
        	.table-responsive{
        		overflow: auto
        	}
        </style>
  	</head>
<div class="wrapper">
    <header class="top-nav">
    <div class="top-nav-inner">
        <div class="nav-header">
            <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleSM">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <ul class="nav-notification pull-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg"></i></a>
                    <span class="badge badge-danger bounceIn">1</span>
                    <ul class="dropdown-menu dropdown-sm pull-right user-dropdown">
                        <li class="user-avatar">
                            <img src="<?php echo WWW;?><?php echo $user['avatar']['b'];?>" alt="" class="img-circle">
                            <div class="user-content">
                                <h5 class="no-m-bottom"><?php echo $user['user'];?></h5>
                                <div class="m-top-xs">
                                    <a href="<?php echo WWW;?>" class="m-right-sm">返回网站首页</a>
                                    <a href="<?php HYBBS_URL('admin','out') ?>">退出</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="<?php HYBBS_URL('admin') ?>">
                                后台主页
                                <span class="badge badge-danger bounceIn animation-delay2 pull-right">1</span>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="<?php HYBBS_URL('admin','op') ?>">网站设置</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <a href="<?php echo WWW;?>" class="brand">
                <i class="fa fa-yc"></i><span class="brand-name">HY BBS</span>
            </a>
        </div>
        <div class="nav-container">
            <button type="button" class="navbar-toggle pull-left sidebar-toggle" id="sidebarToggleLG">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav-notification">
                <li>
                    <a href="javascript:history.back(-1)">
                        <i class="fa fa-chevron-circle-left"></i>
                        返回上一页
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick="location.href=location.href">
                        <i class="fa fa-retweet"></i>
                        刷新本页
                    </a>
                </li>
            </ul>
            <div class="pull-right m-right-sm">
                <div class="user-block hidden-xs">
                    <a href="#" id="userToggle" data-toggle="dropdown">
                        <img src="<?php echo WWW;?><?php echo $user['avatar']['b'];?>" alt="" class="img-circle inline-block user-profile-pic">
                        <div class="user-detail inline-block">
                            <?php echo $user['user'];?>
                            <i class="fa fa-angle-down"></i>
                        </div>
                    </a>
                    <div class="panel border dropdown-menu user-panel">
                        <div class="panel-body paddingTB-sm">
                            <ul>

                                <li>
                                    <a href="<?php echo WWW;?>">
                                        <i class="fa fa-inbox fa-lg"></i><span class="m-left-xs">返回首页</span>
                                        
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php HYBBS_URL('admin','out') ?>">
                                        <i class="fa fa-power-off fa-lg"></i><span class="m-left-xs">退出后台</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- ./top-nav-inner -->
</header>

    <style>
.control-label,.help-block{
	
}
    </style>
    <script type="text/javascript">
    function save_op(){
    	var data = $("#save_op").serialize();
        $.ajax({
            url:window.location.href,
            type:'post',
            data:data,
            dataType:'json',
            success:function(e){
                if(e.error){
                    swal('成功',e.info,'success');
                }
                else{
                    swal('错误',e.info,'error');
                }
            },
            error:function(){
                swal('失败','访问本地服务器出错.','error');
            }

        })
    	return false;
    }
    </script>
    <div class="main-container">
        <div class="padding-md">
            <h2 class="header-text">
				设置
				<span class="sub-header">
					Config
				</span>
			</h2>
			<form  method="POST" class="form-horizontal no-margin form-border" id="save_op" onsubmit="return save_op();">
			<div class="smart-widget">
				<div class="smart-widget-inner">
					<ul class="nav nav-tabs tab-style2">
						<li class="active">
					  		<a href="#style2Tab1" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-bar-chart-o"></i></span>
					  			<span class="text-wrapper">基本设置</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#user" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-user"></i></span>
					  			<span class="text-wrapper">用户操作相关</span>
					  		</a>
					  	</li>
					  	<li class="">
					  		<a href="#style2Tab2" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-book"></i></span>
					  			<span class="text-wrapper">主题与帖子相关</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#style2Tab5" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-street-view"></i></span>
					  			<span class="text-wrapper">用户发帖相关</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#style2Tab6" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-upload"></i></span>
					  			<span class="text-wrapper">上传设置</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#style2Tab7" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-at"></i></span>
					  			<span class="text-wrapper">邮箱设置</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#style2Tab8" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-database"></i></span>
					  			<span class="text-wrapper">数据缓存&内存</span>
					  		</a>
					  	</li>
					  	<li>
					  		<a href="#style2Tab9" data-toggle="tab">
					  			<span class="icon-wrapper"><i class="fa fa-bug"></i></span>
					  			<span class="text-wrapper">调试相关</span>
					  		</a>
					  	</li>
					</ul>
					<div class="smart-widget-body">
						<div class="tab-content">
							<div class="tab-pane fade  active in" id="style2Tab1">
								<div class="form-group">
									<label class="col-lg-2 control-label">网站授权秘钥</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="key" value="<?php echo $conf['key'];?>">
										<span class="help-block">网站授权秘钥KEY,申请地址: http://app.hyphp.cn</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-2 control-label">网站标题</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="title" value="<?php echo $conf['title'];?>">
										<span class="help-block">这是你的首页标题.</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">网站LOGO文字</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="logo" value="<?php echo $conf['logo'];?>">
										<span class="help-block">在模板中显示的LOGO 文字.</span>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">网站关键字</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="keywords" value="<?php echo $conf['keywords'];?>">
										<span class="help-block">这将是你的首页keyword.</span>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">网站描述</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="de" value="<?php echo $conf['description'];?>">
										<span class="help-block">这将是你的首页description.</span>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">网站标题尾巴</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="title2" value="<?php echo $conf['title2'];?>">
										<span class="help-block">每个页面的标题后缀</span>
									</div>
								</div>

								
							</div>
							<div class="tab-pane fade  active in" id="user">
								<div class="form-group">
									<label class="col-lg-2 control-label">注册账号敏感词</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="user_have_badword" value="<?php echo $conf['user_have_badword'];?>">
										<span class="help-block">禁止用户账号携带敏感词注册,每个词请用小写,号分隔</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">找回密码邮件标题</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="emailtitle" value="<?php echo $conf['emailtitle'];?>">
										<span class="help-block">发送找回密码邮件给用户时,邮件标题名称从此项获取 默认为: HYBBS找回密码验证码邮件</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">发送找回密码邮箱模板</label>
									<div class="col-lg-10">
										<textarea  class="form-control" name="emailcontent"><?php echo $conf['emailcontent'];?></textarea>
										<span class="help-block">请根据默认的内容去修改! 需要注意%s, 第一个%s会转换为用户名 第二个%s将是验证码. 模板支持HTML代码</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-2 control-label">找回密码间隔</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="send_email_s" value="<?php echo $conf['send_email_s'];?>">
										<span class="help-block">发送邮件找回密码 间隔时间(秒)</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">离线判断</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="out_s" value="<?php echo $conf['out_s'];?>">
										<span class="help-block">超出N秒不访问论坛 判断为离线，建议设置为300.  则是5分钟不访问则判断为离线用户</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">系统提示音</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="mp3_system" value="<?php echo $conf['mp3_system'];?>">
										<span class="help-block">系统消息提示音路径, 默认:public/mp3/system.mp3</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">好友提示音</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="mp3_friend" value="<?php echo $conf['mp3_friend'];?>">
										<span class="help-block">好友消息提示音路径, 默认:public/mp3/msg.mp3</span>
									</div>
								</div>

							</div>
							<div class="tab-pane fade" id="style2Tab2">
								<div class="form-group">
									<label class="col-lg-2 control-label">发表帖子标题最大长度</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="titlesize" value="<?php echo $conf['titlesize'];?>">
										<span class="help-block">在发表主题当中,允许用户发表的标题长度,默认使用 : 128</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">发表帖子标题最小长度</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="titlemin" value="<?php echo $conf['titlemin'];?>">
										<span class="help-block">在发表主题当中,标题长度必须超过多少位,默认使用 : 5</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">摘要保留长度</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="summary_size" value="<?php echo $conf['summary_size'];?>">
										<span class="help-block">将帖子内容去掉HTML格式 保留纯文本, 最终从纯文本中得到相应长度的内容作为摘要. 默认: 200</span>
									</div>
								</div>




								<div class="form-group">
									<label class="col-lg-2 control-label">首页显示主题个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="homelist" value="<?php echo $conf['homelist'];?>">
										<span class="help-block">在首页中每页显示的主题数目默认为:10</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">板块显示主题个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="forumlist" value="<?php echo $conf['forumlist'];?>">
										<span class="help-block">在分类板块中每页显示的主题数目 默认为:10</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">主题页评论显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="postlist" value="<?php echo $conf['postlist'];?>">
										<span class="help-block">主题内页中 每页显示评论个数</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">子评论显示数量</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="post_post_show_size" value="<?php echo $conf['post_post_show_size'];?>">
										<span class="help-block"></span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-2 control-label">搜索页面每页显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="searchlist" value="<?php echo $conf['searchlist'];?>">
										<span class="help-block">搜索页面中,每页显示的搜索个数,默认:10</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">搜索关键字长度限制</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="search_key_size" value="<?php echo $conf['search_key_size'];?>">
										<span class="help-block">搜索关键字最大长度限制 默认: 2</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">后台 - 分类页面显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="adminforum" value="<?php echo $conf['adminforum'];?>">
										<span class="help-block">在管理后台-分类管理中,每页显示多少个分类, 默认:10</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">后台 - 主题管理显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="adminthread" value="<?php echo $conf['adminthread'];?>">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">后台 - 评论管理显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="admin_show_post" value="<?php echo $conf['admin_show_post'];?>">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">后台 - 子评论管理显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="admin_show_post_post" value="<?php echo $conf['admin_show_post_post'];?>">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">后台 - 用户管理显示个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="adminuser" value="<?php echo $conf['adminuser'];?>">
										<span class="help-block"></span>
									</div>
								</div>
							</div>
							
							<!-- 帖子相关 -->
							<div class="tab-pane fade" id="style2Tab5">
								<div class="form-group">
									<label class="col-lg-2 control-label">发表主题增加金钱数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="gold_thread" value="<?php echo $conf['gold_thread'];?>">
										<span class="help-block">用户发表主题增加金钱数</span>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">回复增加金钱数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="gold_post" value="<?php echo $conf['gold_post'];?>">
										<span class="help-block">用户回复增加金钱数</span>
									</div>
								</div>

								<div class="form-group">
									<label class="col-lg-2 control-label">发表主题增加积分</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="credits_thread" value="<?php echo $conf['credits_thread'];?>">
										<span class="help-block">用户积分仅用于用户组升级以及后续额外功能</span>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">回复增加积分</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="credits_post" value="<?php echo $conf['credits_post'];?>">
										<span class="help-block">同上</span>
									</div>
								</div>
								
							</div>
							<!-- 上传设置 -->
							<div class="tab-pane fade" id="style2Tab6">
								<div class="form-group">
									<label class="col-lg-2 control-label">帖子图片列表保存个数</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="post_image_size" value="<?php echo $conf['post_image_size'];?>">
										<span class="help-block">储存展示缩略图个数, 如果模板有该功能</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">图片上传允许格式</label>
									<div class="col-lg-10">
										
										
										<input class="form-control" type="text" name="uploadimageext" value="<?php echo $conf['uploadimageext'];?>">
										<span class="help-block">请用 , 隔开</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">图片上传大小限制</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="uploadimagemax" value="<?php echo $conf['uploadimagemax'];?>">
										<span class="help-block">单位（ M ）.如输入3 则限制3M以下图片上传,输入0为无限制大小 , 如果是单位kb以下 请输入小数点 0.1 = 100kb</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">附件上传允许格式</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="uploadfileext" value="<?php echo $conf['uploadfileext'];?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">附件上传大小限制</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="uploadfilemax" value="<?php echo $conf['uploadfilemax'];?>">
										<span class="help-block">单位（ M ）.如输入3 则限制3M以下附件上传，输入0为无限制大小</span>
									</div>
								</div>
								<h4>当前PHP.ini配置上传文件最大字节：<label class="label label-success"><?php echo ini_get('upload_max_filesize') ?></label> 与 POST提交字节最大限制为：<label class="label label-success"><?php echo ini_get('post_max_size') ?></label></h4><hr><h4>特别提醒，你在本页配置的限制只是局部的，全局控制上传大小在php.ini中修改！ 可在网上搜索一下 php.ini 上传大小限制</h4>
								<hr>PHP.ini <h4>upload_max_filesize : <label class="label label-success"><?php echo ini_get('upload_max_filesize') ?></label> </h4><h4>post_max_size : <label class="label label-success"><?php echo ini_get('post_max_size') ?></label></h4>
							</div>
							<!-- 邮箱设置 -->
							<div class="tab-pane fade" id="style2Tab7">
								<div class="form-group">
									<label class="col-lg-2 control-label">SMTP服务器地址</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="emailhost" value="<?php echo $conf['emailhost'];?>">
										<span class="help-block">这是你的服务器SMTP地址</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">SMTP服务器端口</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="emailport" value="<?php echo $conf['emailport'];?>">
										<span class="help-block">一般默认为:25</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">邮箱账号</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="emailuser" value="<?php echo $conf['emailuser'];?>">
										<span class="help-block">这是你的邮箱验证账号</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">邮箱密码</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="emailpass" value="<?php echo $conf['emailpass'];?>">
										<span class="help-block">现在使用SMTP的邮箱大多都采用了授权码,这里填写你的邮箱授权码,如果没有此类功能,请填写邮箱密码</span>
									</div>
								</div>
							</div>
							<!-- 缓存 -->
							<div class="tab-pane fade" id="style2Tab8">
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存类型</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_type" value="<?php echo $conf['cache_type'];?>">
										<span class="help-block">目前支持: Apachenote, Apc, db, file, Eacceleratpr, Memcache, Memcached, Redis, Shmop, Wincache, Xcache , 请选择一款你服务器支持的缓存扩展. </span>
										<span class="help-block">效率比较: File < DB < 内存缓存</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">DB缓存表</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_table" value="<?php echo $conf['cache_table'];?>">
										<span class="help-block">当你使用DB缓存时,此项将生效. 输入一个数据表作为缓存表. 默认: cache (不建议更改)</span>
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存加密KEY</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_key" value="<?php echo $conf['cache_key'];?>">
										<span class="help-block">只有缓存类型为File才生效,主要用于加密缓存文件名,你可以随便输入几个字符保存即可!</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存过期时间(秒)</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_time" value="<?php echo $conf['cache_time'];?>">
										<span class="help-block">缓存的过期时间，输入0等于无限制缓存！</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存前缀</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_pr" value="<?php echo $conf['cache_pr'];?>">
										<span class="help-block">默认为空 , 不建议修改</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存数据压缩</label>
									<div class="col-lg-10">
										<div class="checkbox inline-block">
											<div class="custom-checkbox">
												<input type="checkbox" name="cache_ys" id="inlineCheckbox1" class="checkbox-red" <?php if ($conf['cache_ys'] == 'on'): ?>checked="checked"<?php endif ?>>
												<label for="inlineCheckbox1"></label>
											</div>
											<div class="inline-block vertical-top">
												压缩缓存数据
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">缓存服务器连接超时(秒)</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_outtime" value="<?php echo $conf['cache_outtime'];?>">
										<span class="help-block">当使用缓存服务器时生效,连接缓存服务器超时时间</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Redis 服务器地址</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_redis_ip" value="<?php echo $conf['cache_redis_ip'];?>">
										<span class="help-block">当你的缓存类型为Redis时使用</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Redis 服务器端口</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_redis_port" value="<?php echo $conf['cache_redis_port'];?>">
										<span class="help-block">当你的缓存类型为Redis时使用</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Memcache 服务器地址</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_mem_ip" value="<?php echo $conf['cache_mem_ip'];?>">
										<span class="help-block">当你的缓存类型为Memcache时使用</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Memcache 服务器端口</label>
									<div class="col-lg-10">
										<input class="form-control" type="text" name="cache_mem_port" value="<?php echo $conf['cache_mem_port'];?>">
										<span class="help-block">当你的缓存类型为Memcache时使用</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Memcached 服务器分布IP</label>
									<div class="col-lg-10">
										<textarea rows="4" name="cache_memd_ip" class="form-control"><?php echo $conf['cache_memd_ip'];?></textarea>
										<span class="help-block">Memcache 负载均衡,多台服务器配置,参数配置: IP:端口:调用权重, 多台换行配置 例: 127.0.0.1:11211:33</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Memcached 配置参数</label>
									<div class="col-lg-10">
										请到Config.php 手动配置 MEMCACHED_LIB
									</div>
								</div>


							</div>
							<div class="tab-pane fade" id="style2Tab9">
								<div class="form-group">
									<label class="col-lg-2 control-label">右下角调试窗口</label>
									<div class="col-lg-10">
										<div class="checkbox inline-block">
											<div class="custom-checkbox">
												<input type="checkbox" name="debug_page" id="inlineCheckbox3" class="checkbox-red" <?php if ($conf['debug_page']): ?>checked="checked"<?php endif ?>>
												<label for="inlineCheckbox3"></label>
											</div>
											<div class="inline-block vertical-top">
												显示右下角调试小窗口，网站上线请关闭
											</div>
										</div>
									</div>
								</div>
	                            <div class="form-group">
									<label class="col-lg-2 control-label">开启DEBUG模式</label>
									<div class="col-lg-10">
										<div class="checkbox inline-block">
											<div class="custom-checkbox">
												<input type="checkbox" name="debug" id="inlineCheckbox4" class="checkbox-red" <?php if ($conf['debug']): ?>checked="checked"<?php endif ?>>
												<label for="inlineCheckbox4"></label>
											</div>
											<div class="inline-block vertical-top">
												打开论坛调试模式，开启后将得到详细的PHP警告与错误信息，但他会让你的论坛降低两倍运行速度，网站上线后，请关闭该功能！
											</div>
										</div>
									</div>
								</div>
								
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
								<label class="col-lg-2 control-label"></label>
								<div class="col-lg-10">
									
									<button type="submit" class="btn btn-success">保存配置</button>

								</div><!-- /.col -->
							</div>
			</form>
            
        </div>
    </div>
    <aside class="sidebar-menu fixed">
	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
		<div class="sidebar-inner scrollable-sidebar" style="overflow: hidden; width: auto; height: 100%;">
			<div class="main-menu">
				<ul class="accordion">
					<li class="menu-header">
						Main Menu
					</li>
					<li class="bg-palette1 <?php if (METHOD_NAME == 'Index'): ?>active open<?php endif ?>">
						<a href="<?php HYBBS_URL('admin') ?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-home fa-lg"></i></span>
								<span class="text m-left-sm">首页</span>
							</span>
							<span class="menu-content-hover block">
								首页
							</span>
						</a>
					</li>
					<li class="bg-palette4 <?php if (METHOD_NAME == 'Op'): ?>active open<?php endif ?>">
						<a href="<?php HYBBS_URL('admin','op') ?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-cog fa-lg"></i></span>
								<span class="text m-left-sm">全局设置</span>
							</span>
							<span class="menu-content-hover block">
								全局设置
							</span>
						</a>
					</li>
					<li class="bg-palette2">
						<a href="<?php echo WWW;?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-desktop fa-lg"></i></span>
								<span class="text m-left-sm">网站首页</span>
							</span>
							<span class="menu-content-hover block">
								网站首页
							</span>
						</a>
					</li>
					<li class="openable bg-palette3 <?php if (METHOD_NAME == 'Forum_group' || METHOD_NAME == 'Forum' || METHOD_NAME == 'Forumg' || METHOD_NAME == 'Forum_json' ): ?>active open<?php endif ?>">
						<a href="#">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-list fa-lg"></i></span>
								<span class="text m-left-sm">板块分类</span>
								<span class="submenu-icon"></span>
							</span>
							<span class="menu-content-hover block">
								板块分类
							</span>
						</a>
						<ul class="submenu bg-palette4">
							<li><a <?php if (METHOD_NAME == 'Forum_group'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','forum_group') ?>" title="板块分组"><span class="submenu-label">大分组</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Forum'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','forum') ?>" title="板块分类列表管理"><span class="submenu-label">分类管理</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Forumg'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','forumg') ?>" title="板块分类 版主列表编辑"><span class="submenu-label">分类版主</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Forum_json'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','forum_json') ?>" title="板块用户组列表权限控制"><span class="submenu-label">分类用户组权限</span></a></li>

						</ul>
					</li>
					<li class="openable bg-palette4 <?php if (METHOD_NAME == 'User' || METHOD_NAME == 'Usergroup'): ?>active open<?php endif ?>">
						<a href="#">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-users fa-lg"></i></span>
								<span class="text m-left-sm">用户管理</span>
								<span class="submenu-icon"></span>
							</span>
							<span class="menu-content-hover block">
								用户管理
							</span>
						</a>
						<ul class="submenu"  style="display: none;">
							<li><a <?php if (METHOD_NAME == 'User'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','user') ?>"><span class="submenu-label">用户管理</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Usergroup'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','usergroup') ?>"><span class="submenu-label">用户组</span></a></li>

						</ul>
					</li>

					<li class="openable bg-palette3 <?php if (METHOD_NAME == 'Thread' || METHOD_NAME == 'Post' || METHOD_NAME == 'Post_post'): ?>active open<?php endif ?>">
						<a href="#">
							<span class="menu-content block">
								<span class="menu-icon">
								<i class="block fa fa-tags fa-lg"></i>
								</span>
								<span class="text m-left-sm">文章 & 评论</span>
								<span class="submenu-icon"></span>
							</span>
							<span class="menu-content-hover block">
								文章&评论
							</span>
						</a>
						<ul class="submenu"  style="display: none;">
							<li><a <?php if (METHOD_NAME == 'Thread'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','Thread') ?>"><span class="submenu-label">文章管理</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Post'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','Post') ?>"><span class="submenu-label">评论管理</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Post_post'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','Post_post') ?>"><span class="submenu-label">子评论管理</span></a></li>

						</ul>
					</li>


					
					<li class="bg-palette2 <?php if (METHOD_NAME == 'View'): ?>active open<?php endif ?>">
						<a href="<?php HYBBS_URL('admin','view') ?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-paint-brush fa-lg"></i></span>
								<span class="text m-left-sm">外观&模板</span>

							</span>
							<span class="menu-content-hover block">
								外观模板
							</span>
						</a>
					</li>
					<li class="bg-palette3 <?php if (METHOD_NAME == 'Code'): ?>active open<?php endif ?>">
						<a href="<?php HYBBS_URL('admin','code') ?>">
							<span class="menu-content block">
								<span class="menu-icon"><i class="block fa fa-code fa-lg"></i></span>
								<span class="text m-left-sm">插件</span>

							</span>
							<span class="menu-content-hover block">
								插件
							</span>
						</a>
					</li>

					<li class="openable bg-palette3 <?php if (METHOD_NAME == 'Log' || METHOD_NAME == 'Log_php'): ?>active open<?php endif ?>">
						<a href="#">
							<span class="menu-content block">
								<span class="menu-icon">
								<i class="block fa fa-cube fa-lg"></i>
								</span>
								<span class="text m-left-sm">日志</span>
								<span class="submenu-icon"></span>
							</span>
							<span class="menu-content-hover block">
								日志
							</span>
						</a>
						<ul class="submenu"  style="display: none;">
							<li><a <?php if (METHOD_NAME == 'Log'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','Log') ?>"><span class="submenu-label">用户日志</span></a></li>
							<li><a <?php if (METHOD_NAME == 'Log_php'): ?>class="active"<?php endif ?> href="<?php HYBBS_URL('admin','Log_php') ?>"><span class="submenu-label">PHP日志</span></a></li>
							

						</ul>
					</li>

					

					

				</ul>
			</div>
			<div class="sidebar-fix-bottom clearfix">
				<div class="user-dropdown dropup pull-left">
					<a title="快捷菜单" href="javascript:;" class="dropdwon-toggle font-18" data-toggle="dropdown">
						<i class="fa fa-flickr"></i>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header"><i class="fa fa-flickr"></i> 快捷菜单</li>
						<li>
							<a href="javascript:;" onclick="delete_cache({'one1':true})">
								<i class="fa fa-trash"></i> 清空文件缓存
							</a>
						</li>
						<li>
							<a href="<?php HYBBS_URL('admin','view',['op'=>BBSCONF('theme')]) ?>" >
								<i class="fa fa-cog"></i> 配置PC模板
							</a>
						</li>
						<li>
							<a href="<?php HYBBS_URL('admin','view',['op'=>BBSCONF('wapview')]) ?>" >
								<i class="fa fa-cog"></i> 配置手机模板
							</a>
						</li>			  	  
						<li class="divider"></li>
						<li>
							<a href="<?php HYBBS_URL('admin','op') ?>"><i class="fa fa-cog"></i> 全局设置</a>
						</li>			  	  
					</ul>
				</div>
				<a title="注销后台账户" href="<?php HYBBS_URL('admin','out') ?>" class="pull-right font-18">
					<i class="fa fa-sign-out"></i>
				</a>
			</div>
			<script type="text/javascript">
			function delete_cache(data){
				swal({
		            title: "删除缓存",
		            text: '确认删除文件缓存！',
		            type: "warning",
		            confirmButtonColor: "#DD6B55",
		            confirmButtonText: "确定",
		            cancelButtonText: '取消',
		           //allowOutsideClick:false,
		           showCancelButton: true,
		        }).then(
		        	function() {
		        		$.ajax({
							url:'<?php HYBBS_URL('admin') ?>',
							type:'post',
							data:data,
							dataType:'json',
							success:function(e){
								if(e.error){
				                    swal('成功',e.info,'success');
				                }
				                else{
				                    swal('错误',e.info,'error');
				                }
							},error:function(e){

							}
						});
		            },
		            function(){

		            }
		        );
				
				

			}
			</script>
			
		</div>
		<div class="slimScrollBar" style="width: 0px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 651px; background: rgb(0, 0, 0);"></div>
		<div class="slimScrollRail" style="width: 0px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
	</div><!-- sidebar-inner -->
</aside>


	<footer class="footer">
	    <span class="footer-brand">
			<strong ><a class="text-danger" href="http://bbs.hyphp.cn/" target="_blank">HYBBS</a></strong> 后台管理 Version <?php echo HYBBS_V;?>
		</span>
	    <!-- <p class="no-margin">
	        &copy; 2018 <strong><a class="text-danger" href="http://bbs.hyphp.cn/" target="_blank">HYBBS</a></strong> 后台管理</strong>. ALL Rights Reserved.
	    </p> -->
	</footer>
	</div>
	<!-- Jquery -->
	<script src="<?php echo WWW;?>public/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo WWW;?>public/admin/bootstrap/js/bootstrap.min.js"></script>
	<!-- Slimscroll -->
	<script src='<?php echo WWW;?>public/admin/js/jquery.slimscroll.min.js'></script>
	<!-- Simplify -->
	<script src="<?php echo WWW;?>public/admin/js/simplify.js"></script>
	<script src="<?php echo WWW;?>public/js/sweet-alert.min.js"></script>
	<script>
	$(function() {
	    $('#lockScreen').modal({
	        show: true,
	        backdrop: 'static'
	    })
	});
	</script>
	</body>

</html>
