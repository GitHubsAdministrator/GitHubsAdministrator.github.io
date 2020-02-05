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

    <div class="main-container">
    	<div class="padding-md">
            <div id="mess">
            	

            </div>
            <div id="code-mess">
            	
            </div>
			
            <style>
            .list-group-item>.sone{
                width: 100px;
                display: inline-block;
            }
            </style>
            <h3 class="m-left-xs header-text m-top-lg">缓存清理</h3>
            <div class="smart-widget">
			<div class="smart-widget-header">
				缓存清理

			</div>
			<div class="smart-widget-inner">
				<div class="smart-widget-body">

                    <form action="" method="post" id="formToggleLine" class="form-horizontal no-margin form-border">
                    
                    <div class="form-group">
						<label class="col-lg-2 control-label">文件组建缓存</label>
						<div class="col-lg-10">
							<div class="checkbox inline-block">
								<div class="custom-checkbox">
									<input name="one1" type="checkbox" id="inlineCheckbox1" class="checkbox-red" checked="">
									<label for="inlineCheckbox1"></label>
								</div>
								<div class="inline-block vertical-top">
									缓存文件(Tmp)
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">多语言 文件缓存</label>
						<div class="col-lg-10">
							<div class="checkbox inline-block">
								<div class="custom-checkbox">
									<input name="lang" type="checkbox" id="lang" class="checkbox-red" checked="">
									<label for="lang"></label>
								</div>
								<div class="inline-block vertical-top">
									多语言缓存文件(Tmp/Lang)
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">数据缓存</label>
						<div class="col-lg-10">
							<div class="checkbox inline-block">
								<div class="custom-checkbox">
									<input name="one3" type="checkbox" id="inlineCheckbox3" class="checkbox-red">
									<label for="inlineCheckbox3"></label>
								</div>
								<div class="inline-block vertical-top">
									数据缓存
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">日志文件</label>
						<div class="col-lg-10">
							<div class="checkbox inline-block">
								<div class="custom-checkbox">
									<input name="one4" type="checkbox" id="inlineCheckbox4" class="checkbox-red">
									<label for="inlineCheckbox4"></label>
								</div>
								<div class="inline-block vertical-top">
									文件大小: <?php if(is_file(TMP_PATH .'log.php')){echo number_format(floatval(((filesize(TMP_PATH .'log.php')/1024)/1024)),3,'.', '') . 'MB'; }else{echo ' 无日志文件';} ?>
								</div>
							</div>
						</div>
					</div>


                    
					<div class="form-group">
						<label class="col-lg-2 control-label">重构板块主题与评论数量</label>
						<div class="col-lg-10">
							<div class="checkbox inline-block">
								<div class="custom-checkbox">
									<input name="one2" type="checkbox" id="inlineCheckbox2" class="checkbox-info">
									<label for="inlineCheckbox2"></label>

								</div>
								<div class="inline-block vertical-top">
									<span class="help-block">由于大量删除主题以及评论导致的板块主题评论数量不正确,勾选此方案重建. 如果你只清理论坛缓存，不需要勾选该选项！</span>
								</div>
							</div>
						</div>
					</div>
                    <div class="form-group">
						<label class="col-lg-2 control-label">确认表单</label>
						<div class="col-lg-10">
							<button class="btn btn-danger">提交</button>
						</div><!-- /.col -->
					</div>
                </form>
				</div>
			</div><!-- ./smart-widget-inner -->
		</div>
				<h3 class="m-left-xs header-text m-top-lg">服务器信息</h3>
    		<div class="row m-top-md">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered " id="dataTable">
						<thead>
							<tr class="bg-dark-blue">
								<th class="col-sm-2">名称</th>
								<th class="col-sm-10">信息</th>

							</tr>
						</thead>
						<tbody>
                            
                            <tr>
								<td>论坛版本</td>
								<td><label class="label label-success"><?php echo HYBBS_V;?></label></td>

							</tr>
							<tr>
								<td>HYPHP框架版本</td>
								<td><?php echo HYPHP_VERSION;?></td>

							</tr>
							<tr>
								<td>
									伪静态条件
								</td>
								<td id="re">检测中...</td>
							</tr>
							<tr>
								<td>服务器IP地址</td>
								<td><?php if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);} ?></td>
							</tr>
							<tr>
								<td>本机发信IP</td>
								<td id="ip">加载中...</td>
							</tr>
							<?php if (function_exists('disk_free_space') && function_exists('disk_total_space')): ?>
							<tr>
								<td>磁盘空间大小</td>
								<td>
									<div class="progress" style="height: 20px;margin-bottom: 0;">
										<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo 100-number_format((disk_free_space(INDEX_PATH)/disk_total_space(INDEX_PATH))*100,0); ?>%">
									    	<span class="">已用<?php echo 100-number_format((disk_free_space(INDEX_PATH)/disk_total_space(INDEX_PATH))*100,0); ?>% 剩余<?php echo number_format(disk_free_space(INDEX_PATH)/1024/1024,0,'.','.');?> G / 总量<?php echo number_format(disk_total_space(INDEX_PATH)/1024/1024,0,'.','.');?> G</span>
									  	</div>
									</div>
									
								</td>
							</tr>
							<?php endif ?>
							<tr>
								<td>服务器信息</td>
								<td><?php if(function_exists('php_uname')) echo php_uname();?></td>
							</tr>
							<tr>
								<td>服务器系统</td>
								<td><?php if(function_exists('php_uname')) echo php_uname('s');?></td>

							</tr>
							<tr>
								<td>WEB服务器类型</td>
								<td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
							</tr>
							<tr>
								<td>根目录</td>
								<td><?php echo INDEX_PATH;?></td>
							</tr>
							<tr>
								<td>PHP支持模块</td>
								<td>
								<?php
$able=get_loaded_extensions();
foreach ($able as $key=>$value) {
	if ($key!=0 && $key%13==0) {
		echo '<br /><br />';
	}
	echo '<label class="label label-success" style="margin-bottom:10px">'.$value.'</label>&nbsp;&nbsp;';
	
}
?>
								</td>
							</tr>
							

                            <tr>
								<td>PHP版本</td>
								<td><?php echo PHP_VERSION;?></td>
							</tr>
							<tr>
								<td>PHP安装路劲</td>
								<td><?php echo DEFAULT_INCLUDE_PATH;?></td>
							</tr>
							<tr>
								<td>PHP运行方式</td>
								<td><?php echo strtoupper(php_sapi_name());?></td>
							</tr>
							<tr>
								<td>PHP脚本最大内存可用</td>
								<td><?php echo get_cfg_var("memory_limit");?></td>
							</tr>
							<tr>
								<td>POST提交字节最大限制</td>
								<td><?php echo get_cfg_var("post_max_size");?></td>
							</tr>
							<tr>
								<td>上传文件最大限制字节</td>
								<td><?php echo get_cfg_var("upload_max_filesize");?></td>
							</tr>
							<tr>
								<td>脚本超时时间</td>
								<td><?php echo get_cfg_var("max_execution_time");?>秒</td>
							</tr>
							
							<?php if (function_exists('Zend_Version')): ?>
                            <tr>
								<td>Zend版本</td>
								<td><?php echo Zend_Version();?></td>
							</tr>
							<?php endif ?>
                            
                            <tr>
								<td>网站根目录</td>
								<td><?php echo INDEX_PATH;?></td>
							</tr>
							<?php if (function_exists('GetHostByName')): ?>
                            <tr>
								<td>服务器IP</td>
								<td><?php echo GetHostByName($_SERVER['SERVER_NAME']);?></td>
							</tr>
							<?php endif ?>
                            
                            <tr>
								<td>当前你的访问IP</td>
								<td><?php echo $_SERVER['ip'];?></td>
							</tr>
                            
                            <tr>
								<td>服务器语言</td>
								<td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];?></td>
							</tr>


						</tbody>

					</table>
                </div>
    		</div>
           
		
    	</div>
    	<!-- ./padding-md -->
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

    <div class="modal fade" id="normalModal" aria-hidden="true" style="display: none;">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
	        		<h4 class="modal-title">升级论坛</h4>
	      		</div>
	      		<div class="modal-body">
	        		<div class="progress progress-striped active">
					  <div id="jdt" class="progress-bar progress-bar-success" role="progressbar" style="width: 0%">
					    <span class="sr-only">80% Complete (success)</span>
					  </div>
					</div>
					<pre id="open-mess"></pre>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
	        		<button type="button" class="btn btn-primary" onclick="openA(this)">确定升级</button>
	      		</div>
	    	</div>
	  	</div>
	</div>


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
<script type="text/javascript">
	function add_mess(info,on){
		$("#open-mess").html($("#open-mess").html()+'<label class="label label-'+on+'" style="margin-bottom:5px;display: inline-block;">'+info+'</label>\r\n');
	}
	function openA(obj){
		$(obj).attr('disabled','disabled');
		$("#open-mess").html('');
		$("#jdt").stop(true,true);
		
		add_mess('升级任务正在执行，请勿关闭该页面！','success');
		add_mess('正在下载最新论坛程序包！','success');
		$("#jdt").animate({width:"30%"},10000);
		$.ajax({
			url: "<?php HYBBS_URL('admin','update2') ?>",
			type:"POST",
			cache: false,
			data:{gn:'down'},
			dataType: 'json'
	    }).then(function(e) {
	    	
	         if(!e.error){
	         	$(obj).removeAttr('disabled');
	         	return add_mess(e.info,'danger');
	         }
	         	

	        $("#jdt").stop(true,true);
	        $("#jdt").animate({width:"60%"},10000);
	        add_mess(e.info,'success');
	        $.ajax({
				url: "<?php HYBBS_URL('admin','update2') ?>",
				type:"POST",
				cache: false,
				data:{gn:'unzip'},
				dataType: 'json'
		    }).then(function(e) {
		    	
		        if(!e.error){
		        	$(obj).removeAttr('disabled');
		         	return add_mess(e.info,'danger');
		        }
		        
		        if(!e.url){
		        	$(obj).removeAttr('disabled');
		        	return add_mess('没有找到升级地址！','danger');
		        }
		        $("#jdt").stop(true,true);
		        $("#jdt").animate({width:"80%"},10000);
		        add_mess('SQL升级成功...','success');
	        	add_mess('正在覆盖源文件...','success');
	        	$.get(e.url,function(e){
	        		
	        		if(e == '0'){
	        			$(obj).removeAttr('disabled');
	        			return add_mess('升级失败，原因：升级压缩包丢失！','danger');
	        		}
	        		if(e == '1'){
	        			add_mess('升级成功！','success');
						$("#jdt").stop(true,true);
						$("#jdt").animate({width:"100%"});
						setTimeout(function(){
							window.location.reload();
						},3000);
	        			return;
	        		}
	        		$(obj).removeAttr('disabled');
	        		return add_mess('升级失败，原因：未知 Error = 1！ 如果卡在此处 可以覆盖最新程序文件','danger');
	        		
	        	},'html');
		         
		   }, function() {
		   		$(obj).removeAttr('disabled');
		   		$("#jdt").stop(true,true);
		     	add_mess('访问本地服务器出错！Error = 2','danger');
		   });
	   }, function() {
	   		$(obj).removeAttr('disabled');
	   		$("#jdt").stop(true,true);
	     	add_mess('访问本地服务器出错！Error = 1','danger');
	   });


	}
	function add_mess(info,on){
		$("#open-mess").html($("#open-mess").html()+'<label class="label label-'+on+'" style="margin-bottom:5px;display: ;    line-height: 3;">'+info+'</label>\r\n');
	}
	$.ajax({
		url:'<?php echo WWW;?>admin<?php echo EXP;?>GetNewVersion',
		type:'get',
		dataType:'json',
		success:function(e){
			if(e.error){
				$("#mess").html('<div class="alert alert-success alert-custom alert-dismissible" role="alert"><i class="fa fa-check-circle m-right-xs"></i><strong>有新版本更新</strong> 当前论坛版本：<?php echo HYBBS_V;?>，论坛有新版本: '+e.info.version+' 更新吗？ <a class="label label-danger" href="<?php HYBBS_URL('admin','updatebbs') ?>">跳转更新页</a> </div>');
			}
			
			
		},error:function(xhr,ts){
			$('#re').html('<label class="label label-danger"><i class="fa fa-close"></i> 运行出错，请查看日志！</label>');
		}
	})
	// $.get("<?php HYBBS_URL('admin','hybbsupdate2') ?>",function(e){
	// 	if(e.error){
	// 		var html ='';
	// 		for(o in e.json){
	// 			html+= '<li>' + e.json[o] + '</li>';
	// 		}
	// 		$("#mess").html('<div class="alert alert-success alert-custom alert-dismissible" role="alert"><i class="fa fa-check-circle m-right-xs"></i><strong>信息!</strong> 论坛有新版本: '+e.info+' 更新吗？ <a class="label label-danger" href="<?php HYBBS_URL('admin','updatebbs') ?>">跳转更新页</a> <div><h3>更新日志</h3><ul style="margin-left:20px">'+html+'</ul></div></div>');
	// 	}

	// },'json');
	
	$.get('<?php HYBBS_URL('admin','getip') ?>',function(e){
		$("#ip").text(e.ip);
	},'json');
	$.ajax({
		url:'<?php echo WWW;?>admin<?php echo EXP;?>is_rewrite',
		type:'get',
		dataType:'html',
		success:function(e){
			if(e=='on')
				return $('#re').html('<label class="label label-success"><i class="fa fa-check"></i> 支持</label>');
			$('#re').html('<label class="label label-danger"><i class="fa fa-close"></i> 不支持</label>');
		},error:function(e){
			$('#re').html('<label class="label label-danger"><i class="fa fa-close"></i> 不支持</label>');
		}
	})
</script>