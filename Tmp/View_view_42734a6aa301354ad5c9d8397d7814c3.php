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

    <style>
    .gallery-list .gallery-item {
        position: relative;
        display: inline-block;
        
      
    }
    .gallery-list .gallery-item .gallery-wrapper .gallery-title.action{
        background-color: #2baab1;
    }
    .gallery-list .gallery-item .gallery-wrapper .gallery-overlay .gallery-action.action {
        background-color: #2baab1;
    }
    .ss{
        display: none;
    }
    .show{
        display: block;
    }
    </style>
    <div class="main-container">
        <div class="padding-md">
            <h2 class="header-text no-margin">
				外观 & 模板 
                <form action="<?php HYBBS_URL('admin') ?>" method="post" style="display:inline-block" class="form-horizontal no-margin form-border">
                <input name="one1" type="hidden" value="on">
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> 清理缓存</button>
                </form>
                
			</h2>
            <div class="gallery-filter m-top-md">
				<ul class="clearfix">
					<li class="active"><a href="<?php HYBBS_URL('admin','view') ?>">我的模板</a></li>
					<li><a href="<?php HYBBS_URL('admin','viewol') ?>">线上模板 & 下载模板</a></li>
                    <li onclick="$('.ss').toggleClass('show');$(this).toggleClass('active');"><a href="javascript:;">模板高级设置</a></li>
                    
                    <li class="pull-right active"><a href="#" onclick="$('#gn1').val('add');;$('#zti').text('新建模板')" data-toggle="modal" data-target="#normalModal1"><i class="fa fa-plus"></i> 制作模板</a></li>
                    <li class="pull-right active"  data-toggle="tooltip" data-placement="bottom" title="如果已有相同模板,会被覆盖! 慎重上传. (HTML5上传 请勿使用IE低版本上传)">
                        <a style="background-color: #9d4141;" href="#" >
                            <label for="upload_zip" style="display: inherit;font-weight: 400;cursor: pointer;">
                                <i class="fa fa-upload"></i> 上传模板.zip
                            </label>
                        </a>
                    </li> 

                    <input type="file" id="upload_zip" name="upload_zip" onchange="fileSelected('upload_zip');" style="display:none">
				</ul>
			</div>

            <div class="smart-widget widget-green ss" style="margin-top: 15px;">
                <div class="smart-widget-inner">
                <div class="smart-widget-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-custom alert-dismissible" role="alert" style="margin-top: 10px;margin-bottom: 0;">
                       
                        <i class="fa fa-check-circle m-right-xs"></i><strong>高级设置说明!</strong> 这里展现了各个部位所使用的模板. 切换后立即生（非专业人员 请勿乱改！）
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">电脑 用户中心模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('userview',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['userview']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">电脑 登陆注册模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('userview2',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['userview2']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">电脑 错误提示模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('messview',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['messview']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">电脑 搜索页模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('pc_search',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['pc_search']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">手机 用户中心模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('messview',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['wapuserview']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">手机 登陆注册模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('wapuserview2',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['wapuserview2']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">手机 错误提示模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('wapmessview',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['wapmessview']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <label class="col-lg-12 control-label">手机 搜索页模板</label>
                        <div class="col-lg-12">
                            <select onchange="select_view('wap_search',this)" class="form-control">
                                <?php foreach ($all_data as $key => $v): ?>
                                <option value="<?php echo $v['value'];?>" <?php if ($conf['wap_search']==$v['value']): ?>selected<?php endif ?>><?php echo $v['value'];?> - <?php echo $v['name'];?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            </div>
            </div>



            <div class="modal fade" id="smallModal" data-backdrop="static">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">上传进度</h4>
                        </div>
                        <div class="modal-body">
                            <div class="progress progress-striped active">
                              <div id="jdt" class="progress-bar progress-bar-danger" role="progressbar"  style="width: 0%">
                                <span class="sr-only">8</span>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
            function select_view(v,obj){
                var _this = $(obj);
                _this.attr('disabled','disabled');
                $.post('<?php HYBBS_URL('admin','ajax_edit_view') ?>',{name:v,value:_this.val()},function(e){
                    _this.removeAttr('disabled');
                },'json');
                //$(obj).val();

            }
            function fileSelected(id) {
                var file = document.getElementById(id).files[0];
                if (file) {
                    $("#smallModal").modal("show");
                    $("#jdt").css('width', '0%')  ;
                    uploadFile(id);
                
                }
              }

              function uploadFile(id) {
                var fd = new FormData();
                fd.append("photo", document.getElementById(id).files[0]);
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener("progress", uploadProgress, false);
                xhr.addEventListener("load", uploadComplete, false);
                xhr.open("POST", '<?php HYBBS_URL('admin','update_view') ?>');
                xhr.send(fd);
                document.getElementById(id).value = '';
              }

                function uploadProgress(evt) {
                    if (evt.lengthComputable) {
                      var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                      console.log(percentComplete);
                      $("#jdt").css('width',percentComplete.toString()+ '%')  ;
                    }
                    else {
                      
                    }
              }
              function uploadComplete(evt) {
                    $("#smallModal").modal("hide");
                    var json = eval('('+evt.target.responseText+')');
                    if(json.error){
                        swal("上传成功 请手动刷新本页");
                    }else{
                        swal(json.data);
                    }

                    //console.log(json);
                    //
                    //window.location.reload();
                    
                }

            </script>



            <form method="post" id="form">
            <input type="hidden" name="gn" value="create_view">
            <div class="modal fade in" id="normalModal1" aria-hidden="false">
			  	<div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			        		<h4 class="modal-title" id="zti">新建模板</h4>
			      		</div>
			      		<div class="modal-body" id="md1">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">模板名</label>
                                        <input type="text" name="name" class="form-control input-sm">
                                    </div>
                                </div><!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">英文名</label>
                                        <input type="text" name="name2" class="form-control input-sm">
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">作者名</label>
                                        <input type="text" name="user" class="form-control input-sm">
                                    </div>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="form-group">
                                <label class="control-label">模板描述</label>
                                <textarea class="form-control" name="mess" placeholder="" rows="3" ></textarea>
                            </div>
                            <h4 class="header-text">可选结构 (你可以跳过这步)</h4>
                            <div class="form-group">
                                <label class="control-label">必装插件</label>
                                <div id="lib">

                                    <div class="lib1"></div>
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="text" id="text" class="form-control"  placeholder="请输入插件英文名">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" onclick="add_lib()">按插件英文名-添加</button>
                                </span>
                            </div>
                            
        
                        
			      		</div>
			      		<div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="create_viee()">建立</button>
			        		

			      		</div>

			    	</div>
			  	</div>
			</div>
            </form>
            
            <div class="row m-top-md" id="list">
            <?php foreach ($data as $key => $v): ?>
            
                <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
                    <div class="panel">
                        <div class="panel-body no-padding">
                            <div class="owl-carousel no-controls owl-theme owl-loaded">
                                <div class="owl-stage-outer owl-height" style="padding-left: 0px; padding-right: 0px;height: 200px;overflow: hidden; ">
                               
                                <span style="background:url('<?php echo WWW;?>View/<?php echo $v;?>/back.png');display: inline-block;width: 100%;height: 100%;background-position: center 0;background-repeat: no-repeat;background-size: cover;-webkit-background-size: cover;-o-background-size: cover;background-color: #404040;position: relative;">
                                    <?php if (is_file(VIEW_PATH . $v . '/conf.html')): ?>
                                    <a class="label label-warning" style="position: absolute;right: 10px;bottom: 10px;padding: 7px 10px;font-size: 14px;" href="<?php HYBBS_URL('admin','view',['op'=>$v]) ?>">
                                        <i class="fa fa-cog"></i> 配置
                                    </a>
                                    <?php endif ?>
                                    
                                </span>
                                    <!-- <img src="<?php echo WWW;?>View/<?php echo $v;?>/back.png"> -->
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer bg-white">
                            
                            <div class="h3 text-success" style="min-height: 52px;max-height: 52px;overflow: hidden;">
                                <?php echo $qj[$key]['name'];?> - <?php echo $v;?> 
                            </div>
                            <span class=" block" style="color: purple;font-size:14px">
                                作者:<?php echo $qj[$key]['user'];?> <span style="color: darkcyan;">版本:<?php echo $qj[$key]['version'];?></span>
                            </span>
                            <span class=" block" style="margin-top:5px;min-height: 44px;max-height: 44px;overflow: hidden;">
                                <?php echo $qj[$key]['mess'];?>
                            </span>
                            <?php if ($qj[$key]['code']): ?>
                            <hr>
                            <label>使用模板-必装插件</label>
                            <div id="lib1">
                                <?php foreach ((array)explode(",",$qj[$key]['code']) as $vv): ?>
                                <span class="label label-<?php if (is_plugin_dir($vv)): ?>success<?php else: ?>danger<?php endif ?>"><?php echo $vv;?></span>
                                <?php endforeach ?>
                                
                                <div style="clear: both;"></div>
                            </div>
                            <?php endif ?>
                            <hr>
                            <div class="clearfix">
                                <div class="btn-group" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            应用为 <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a onclick="apply_theme('<?php echo $v;?>','pc')" href="javascript:;"><i class="fa fa-tv"></i> 电脑端模板</a></li>
                                            <li class="divider"></li>
                                            <li><a onclick="apply_theme('<?php echo $v;?>','wap')" href="javascript:;"><i class="fa fa-mobile"></i> 移动端模板</a></li>
                                            
                                        </ul>
                                    </div>
                                    <?php if ($conf['theme'] == $v): ?>
                                    <a class="btn btn-danger disabled" disabled>
                                        <i class="fa fa-tv fa-lg"></i> 已用于电脑端
                                    </a>
                                    <?php endif ?>
                                    <?php if ($conf['wapview'] == $v): ?>
                                    <a class="btn btn-danger disabled" disabled>
                                        <i class="fa fa-mobile  fa-lg"></i> 已用于移动端
                                    </a>
                                    <?php endif ?>
                                </div>
                          
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            </div>


        </div>
    </div>


<style type="text/css">
.lib1{
        clear: both;
    }
    #lib,#lib1{
        min-height: 30px;
    border: 1px solid #DDD;
    padding: 10px;
    }
    
    #lib .label,#lib1 .label{
        margin-right: 10px;
        margin-bottom: 10px;
            float: left;
    }
    .lte{
            font-style: normal;
    }


</style>
<script type="text/javascript">
    function apply_theme(theme,type){
        $.post('<?php HYBBS_URL('admin','view') ?>',{gn:'apply',theme:theme,type:type},function(e){
            if(e.error)
                window.location.reload();
            else
                swal(e.info);
        },'json');
    }
    function add_lib(){
        if($("#text").val()=='')
            return;
        $(".lib1").before('<span class="label label-success"><i class="lte">'+$("#text").val()+'</i> &nbsp;<i class="fa fa-close" onclick="$(this).parent().remove()"></i></span>');
        $("#text").val('');
    }
    function create_viee(){
        var code = $("#form").serialize();
        code+="&code=";
        $("#lib .lte").each(function(){
            code+=$(this).text()+",";
        });
        $.post(window.location.href,code,function(e){
            if(e.error)
                window.location.reload()
            else
                alert(e.info);
        },'json');
    }

</script>
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
