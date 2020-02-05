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

    <div class="main-container">
        <div class="padding-md">
            <h3 class="m-left-xs header-text m-top-lg">版主指派</h3>
                版主如每个板块有个管理员权限一样，版主可以删除主题，帖子，修改主题，修改评论。
            <div class="table-responsive">
            <table class="table table-striped table-bordered m-top-md" id="dataTable">
				<thead>
					<tr class="bg-dark-blue">
						<th>分类ID</th>
						<th>分类名称</th>
                        <th>版主用户列表</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($data as $v): ?>
                    <tr >
                        <td><?php echo $v['id'];?></td>
                        <td><?php echo $v['name'];?></td>
                        <td>
                            <?php foreach ($v['user'] as $vv): ?>
                            <span class="label label-info"><?php echo $vv;?></span>
                            <?php endforeach ?>
                            <button onclick="$('#gn').val('forumg');$('.modal-body').load('<?php HYBBS_URL('admin','forumg',['id'=>$v['id'],'gn'=>'forumg']) ?>')" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#normalModal">编辑</button>
                        </td>
                    </tr>
                    <?php endforeach ?>


				</tbody>
			</table>
            </div>
            

        </div>
    </div>
    <form method="post">
    <input type="hidden" id="gn" name="gn" value="">
    <div class="modal fade in" id="normalModal" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="zti">编辑<span class="modal-p1"></span></h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-success">确定执行</button>
                </div>
            </div>
        </div>
    </div>
    </form>


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
