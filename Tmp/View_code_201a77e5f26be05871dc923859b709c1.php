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
            <h2 class="header-text no-margin">
				插件
                <form action="<?php HYBBS_URL('admin'); ?>" method="post" style="display:inline-block" class="form-horizontal no-margin form-border">
                <input name="one1" type="hidden" value="on">
                <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> 清理缓存</button>
                </form>
			</h2>

            <div class="gallery-filter m-top-md" style="margin:10px 0">
				<ul class="clearfix">
					<li class="active"><a href="<?php HYBBS_URL('admin','code'); ?>">我的插件 (<?php echo count($data) ?>)</a></li>
					<li><a href="<?php HYBBS_URL('admin','codeol'); ?>">线上插件 & 下载插件</a></li>
                    <li><a href="<?php HYBBS_URL('admin','code_op'); ?>">插件优先级 (调整插件位置)</a></li>
                    <li class="pull-right active"><a href="#" onclick="$('#gn1').val('add');$('#md1').html($('#text1').text());$('#zti').text('新建插件')" data-toggle="modal" data-target="#normalModal1"><i class="fa fa-plus"></i> 制作插件</a></li>

                    <li class="pull-right active"  data-toggle="tooltip" data-placement="bottom" title="如果已有相同插件,会被覆盖! 慎重上传. (HTML5上传 请勿使用IE低版本上传)">
                        <a style="background-color: #9d4141;" href="#" >
                            <label for="upload_zip" style="display: inherit;font-weight: 400;cursor: pointer;">
                                <i class="fa fa-upload"></i> 上传插件.zip
                            </label>
                        </a>
                    </li> 

                    <input type="file" id="upload_zip" name="upload_zip" onchange="fileSelected('upload_zip');" style="display:none">
				</ul>
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
                xhr.open("POST", '<?php HYBBS_URL('admin','update_code'); ?>');
                

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
                //submit from 
                function save_op(){
                    var data = $("#save_op").serialize();
                    $.ajax({
                        url:window.location.href,
                        type:'post',
                        data:data,
                        dataType:'json',
                        success:function(e){
                            if(e.error){
                                swal('成功','修改插件配置成功.','success');
                            }
                            else{
                                swal('错误','修改插件配置失败. 可能丢失了参数','error');
                            }
                        },
                        error:function(){
                            swal('失败','访问本地服务器出错.','error');
                        }

                    })
                    return false;
                }   

            </script>


            <div class="row">
            <?php foreach ($data as $key => $v): ?>
            <div class="col-sm-12">
                <div class="panel">
    				<div class="panel-body">
    					<a href="#" class="pull-left m-right-sm">
    						<!-- <i class="fa fa-<?php echo $conf[$key]['icon']; ?> fa-3x"></i> -->
                            <img width="50" height="50" src="<?php echo WWW;?>Plugin/<?php echo $v;?>/icon.png" onerror="this.onerror='';this.src='<?php echo APP_WWW;?>app/<?php echo $v;?>/icon.png'">
    					</a>

    					<div class=" m-left-sm">
    						<strong class="font-14 block"><?php echo $conf[$key]['name']; ?>  <label class="badge badge-success"><?php echo $v;?></label></strong>
    						<small style="color: purple" class="text-muted">作者: <?php echo $conf[$key]['user']; ?> <strong style="color: darkcyan;"> &nbsp;版本:<?php echo $conf[$key]['version'];?></strong></small>
    						<div class="seperator"></div>
                            <p class="m-bottom-none">
								<?php echo $conf[$key]['mess']; ?>
							</p>
                            
    						<?php $tmp = false; ?>
                            <?php if (is_plugin_function($v) && !isset($conf[$key]['on'])): ?>
                                <?php if (!get_plugin_install_state($v)): ?>
                                    <?php $tmp = true; ?>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (!$tmp): ?>
                            
                            <input class='tgl tgl-skewed' id='cb<?php echo $key;?>' type='checkbox' onclick="update(this)" data-name="<?php echo $v;?>" data-state="<?php if (isset($conf[$key]['on'])): ?>on<?php else: ?>off<?php endif ?>" <?php if (isset($conf[$key]['on'])): ?>checked<?php endif ?>>
                            <label class='tgl-btn' data-tg-off='已关闭' data-tg-on='开启中' for='cb<?php echo $key;?>'></label>

                            <?php endif ?>
                            


                            <?php if (is_plugin_function($v)): ?>
    						<?php if (!get_plugin_install_state($v)): ?>
                            <a class="btn btn-sm btn-success" onclick="$('#gn1').val('install');$('#pluginname1').val('<?php echo $v;?>');$('#md1').load('<?php HYBBS_URL('admin','code',['name'=>$v,'gn'=>'install']); ?>');$('.modal-p1').text('<?php echo $conf[$key]['name']; ?>')" data-toggle="modal" data-target="#normalModal1">安装</a>
                            
                            <?php else: ?>
                            <a class="btn btn-sm btn-danger" onclick="$('#gn1').val('uninstall');$('#pluginname1').val('<?php echo $v;?>');$('#md1').load('<?php HYBBS_URL('admin','code',['name'=>$v,'gn'=>'uninstall']); ?>');$('.modal-p1').text('<?php echo $conf[$key]['name']; ?>')" data-toggle="modal" data-target="#normalModal1">卸载</a>
                            <?php endif ?>

                            <?php endif ?>
                            <?php if (get_plugin_inc($v)): ?>
                            <a class="btn btn-sm btn-warning" onclick="$('#gn').val('op');$('#pluginname').val('<?php echo $v;?>');$('#md').load('<?php HYBBS_URL('admin','code',['name'=>$v,'gn'=>'op']); ?>');$('.modal-p').text('<?php echo $conf[$key]['name']; ?>')" data-toggle="modal" data-target="#normalModal">配置</a>
                            <?php endif ?>

                            <button class="btn btn-sm btn-danger" onclick="$('#gn1').val('del');$('#pluginname1').val('<?php echo $v;?>');$('#md1').html('<h1>删除插件目录文件,而且不执行卸载函数</h1>');$('.modal-p1').text('<?php echo $conf[$key]['name']; ?>')" data-toggle="modal" data-target="#normalModal1" <?php if (is_plugin_on($v) || (is_plugin_function($v) && get_plugin_install_state($v))): ?>title="需要关闭，卸载插件后 才能删除!" disabled<?php endif ?>>删除插件</button>
                            
    					</div>

    				</div>
    			</div>
			</div>


            <?php endforeach ?>
            </div>
            <form method="post" id="save_op" onsubmit="return save_op();">
                <input type="hidden" id="pluginname" name="name" value="" >
                <input type="hidden" id="gn" name="gn" value="" >
                <div class="modal fade in" id="normalModal" aria-hidden="false">
    			  	<div class="modal-dialog">
    			    	<div class="modal-content">
    			      		<div class="modal-header">
    			        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
    			        		<h4 class="modal-title">插件配置 - <span class="modal-p"></span></h4>
    			      		</div>
    			      		<div class="modal-body" id="md">

    			      		</div>
    			      		<div class="modal-footer">
    			        		<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
    			        		<button type="submit" class="btn btn-success">保存配置</button>
    			      		</div>
    			    	</div>
    			  	</div>
    			</div>
            </form>
            <textarea id="text1" style="display:none">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">插件名</label>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">作者名</label>
                            <input type="text" name="user" class="form-control input-sm">
                        </div>
                    </div><!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">图标</label>
                            <p class="form-control-static">创建插件后在插件目录放入icon.png即可</p>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="form-group">
					<div class="custom-checkbox">
						<input name="inc" type="checkbox" id="chk1">
						<label for="chk1"></label>
					</div>
					支持配置 (inc.php & conf.html)
					<div id="errorMessageArea1"></div>
				</div>
                <div class="form-group">
					<div class="custom-checkbox">
						<input name="fun" type="checkbox" id="chk2">
						<label for="chk2"></label>
					</div>
					支持安装&卸载函数执行 (function.php plugin_install & uninstall)
					<div id="errorMessageArea2"></div>
				</div>

                <div class="form-group">
                    <label class="control-label">插件描述</label>
                    <textarea class="form-control" name="mess" placeholder="在这里描述你的插件" rows="3" ></textarea>
                </div><!-- /form-group -->

            </textarea>

            <form method="post" >
            <input type="hidden" id="pluginname1" name="name" value="" >
            <input type="hidden" id="gn1" name="gn" value="" >
            <div class="modal fade in" id="normalModal1" aria-hidden="false">
			  	<div class="modal-dialog">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			        		<h4 class="modal-title" id="zti">插件配置 - <span class="modal-p1"></span></h4>
			      		</div>
			      		<div class="modal-body" id="md1">


			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-danger" data-dismiss="modal">取消</button>
			        		<button type="submit" class="btn btn-success">确定执行</button>
			      		</div>
			    	</div>
			  	</div>
			</div>
            </form>

            <script>
                function update(obj){
                    var _this = $(obj);
                    var name = _this.data('name');
                    var state= _this.data('state');

                    $.post(window.location.href,{gn:'apply_code',name:name,state:state},function(e){
                        if(e.error){
                            if(state=='on'){
                                
                                _this.removeAttr("checked"); 
                                _this.data('state','off');
                            }else{
                                
                                _this.attr("checked",true);
                                _this.data('state','on');
                            }
                        }else{
                            swal('开启失败',e.data,'error');
                        }

                    },'json');
                    return false;
                }
            </script>


        </div>
    



<style type="text/css">
    #md:after{
        display: table;
        content: " ";
        clear: both;
    }
</style>
  <!-- <h2>Toggle it!</h2>
  <ul class='tg-list'>
  <li class='tg-list-item'>
    <h4>Light</h4>
    <input class='tgl tgl-light' id='cb1' type='checkbox'>
    <label class='tgl-btn' for='cb1'></label>
  </li>
  <li class='tg-list-item'>
    <h4>iOS 7</h4>
    <input class='tgl tgl-ios' id='cb2' type='checkbox'>
    <label class='tgl-btn' for='cb2'></label>
  </li>
  <li class='tg-list-item'>
    <h4>Skewed</h4>
    <input class='tgl tgl-skewed' id='cb3' type='checkbox'>
    <label class='tgl-btn' data-tg-off='OFF' data-tg-on='ON' for='cb3'></label>
  </li>
  <li class='tg-list-item'>
    <h4>Flat</h4>
    <input class='tgl tgl-flat' id='cb4' type='checkbox'>
    <label class='tgl-btn' for='cb4'></label>
  </li>
  <li class='tg-list-item'>
    <h4>Flip</h4>
    <input class='tgl tgl-flip' id='cb5' type='checkbox'>
    <label class='tgl-btn' data-tg-off='Nope' data-tg-on='Yeah!' for='cb5'></label>
  </li>
  </ul> -->
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
