<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="renderer" content="webkit" />
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<title><?php echo $title;?><?php echo $conf['title2'];?></title>
	<meta name="keywords" content="<?php echo $conf['keywords'];?>">
	<meta name="description" content="<?php echo $conf['description'];?>">
	<link rel="shortcut icon" href="<?php echo WWW;?>favicon.ico">
	<link rel="stylesheet" href="<?php echo WWW;?>View/hybbs/icon/iconfont.css?ver=<?php echo get_theme_version('hybbs');?>">
	<link rel="stylesheet" href="<?php echo WWW;?>View/hybbs/app.css?ver=<?php echo get_theme_version('hybbs');?>">
	<link rel="stylesheet" href="<?php echo WWW;?>public/css/public.css?ver=<?php echo get_theme_version('hybbs');?>">
	<script>
	var www = "<?php echo WWW;?><?php echo RE;?>";
	var WWW = "<?php echo WWW;?>";
	var exp = "<?php echo EXP;?>";
	</script>
	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="<?php echo WWW;?>public/js/jquery.min.js"></script>
	<!--<![endif]-->
	<!--[if lte IE 8 ]>
	<script src="<?php echo WWW;?>public/js/jquery1.11.3.min.js"></script>
	<![endif]-->
	<script src="<?php echo WWW;?>View/hybbs/jquery.darktooltip.js"></script>
	<script src="<?php echo WWW;?>View/hybbs/app.js"></script>

	<?php if (IS_LOGIN): ?>
	<!-- 好友系统资源文件 -->
	<link href="<?php echo WWW;?>public/css/friend.css?ver=<?php echo get_theme_version('hybbs');?>" rel="stylesheet">
	<script src="<?php echo WWW;?>public/js/friend.js?ver=<?php echo get_theme_version('hybbs');?>"></script>
	<?php endif ?>
	<script src="<?php echo WWW;?>public/js/app.js"></script>
	
	<style type="text/css">
	<?php if (view_form('hybbs','menu_fix')): ?>
	header{
		    position: fixed;
	    top: 0;
	    left: 0;
	    right: 0;
	    z-index: 4;
	}
	body>.container{
		    margin-top: 76px !important
	}
	<?php endif ?>
	
	<?php if (view_form('hybbs','width')): ?>
		.container{
			width:<?php echo view_form('hybbs','width') ?>;
		}
		.left{
			width: <?php echo (intval(view_form('hybbs','width')) - 300-20) ?>px !important;
		}
	<?php endif ?>
	<?php if (view_form('hybbs','css')): ?>
		<?php echo view_form('hybbs','css') ?>
	<?php endif ?>
	
	</style>

	
</head>
<body>
<header>
	<div id="header" class="container">
		<a style="color:#0f88eb;font-size: 26px;" href="<?php echo WWW;?>"><?php echo view_form('hybbs','logo') ?></a>
		<nav>
			<?php if (view_form('hybbs','menu_forum')): ?>
			<?php foreach ($forum as $v): ?>
			<a href="<?php HYBBS_URL('forum',$v['id']); ?>"><?php echo $v['name'];?></a>
			<?php endforeach ?>
			<?php endif ?>
			<?php if (view_form('hybbs','diy_link')): ?>
				<?php $tmp = explode("\r\n",view_form('hybbs','diy_link')) ?>
				<?php foreach ($tmp as $v): ?>
					<?php $tmp1 = explode(",",$v) ?>
					<a href="<?php echo $tmp1[0];?>"  <?php if ($tmp1[2]==1): ?>target="_blank"<?php endif ?>><?php echo $tmp1[1];?></a>
					
				<?php endforeach ?>
			<?php endif ?>
		</nav>
		<form method="get" action="<?php HYBBS_URL('search') ?>" class="searchBar" >
			<input type="hidden" name="s" value="search">
			<div data-reactid="20">
				<div class="Popover">
					<div class="searchBar-input ">
						<input type="text" name="key" value="" autocomplete="off" placeholder="搜索帖子，用户">
							<button class="btn" aria-label="搜索" type="submit">
							<svg viewBox="0 0 16 16" class="Icon Icon--search" style="height:16px;width:16px;" width="16" height="16" aria-hidden="true" data-reactid="26"><title></title><g><path d="M12.054 10.864c.887-1.14 1.42-2.57 1.42-4.127C13.474 3.017 10.457 0 6.737 0S0 3.016 0 6.737c0 3.72 3.016 6.737 6.737 6.737 1.556 0 2.985-.533 4.127-1.42l3.103 3.104c.765.46 1.705-.37 1.19-1.19l-3.103-3.104zm-5.317.925c-2.786 0-5.053-2.267-5.053-5.053S3.95 1.684 6.737 1.684 11.79 3.95 11.79 6.737 9.522 11.79 6.736 11.79z"></path></g></svg>
							</button>
						
					</div>
				</div>
			</div>
		</form>

		<div class="pull-right menu-box">
			<?php if (!IS_LOGIN): ?>
				<a href="<?php HYBBS_URL('user','login'); ?>" style="margin-right: 5px;" class="btn"><?php echo $_LANG['登录'];?></a>
				<a href="<?php HYBBS_URL('user','add'); ?>" style="margin-right: 5px;" class="btn btn-primary"><?php echo $_LANG['注册'];?></a>
				
			<?php else: ?>
				<a href="javascript:void(0);" style="margin-right:10px" onclick="$('.friend-box').toggleClass('friend-box-a');">
					<img style="border-radius:50%;vertical-align: middle;" width="35" height="35" src="<?php echo WWW;?><?php echo $user['avatar']['b'];?>">
					<span class="xx " style="<?php if (!$user['mess']): ?>display:none<?php endif ?>"><?php echo $user['mess'];?></span>
				</a>
			<?php endif ?>
			
		</div>
	</div>
</header>

<div class="container" style="margin-top: 23px;">
	<div class="left">
		<div class="wrap-box">
			<a href="<?php echo WWW;?>"><?php echo $_LANG['论坛首页'];?></a>
			<?php $tmp_fid = forum($forum,$thread_data['fid'],'fid'); ?>
			<?php
			$tmp_str = '';
			while ($tmp_fid != -1) { 
				$tmp_str='<span class="grey1"> > </span><a href="' .HYBBS_URLA('forum','',forum($forum,$tmp_fid,'id')).'">'.forum($forum,$tmp_fid,'name').'</a>'.$tmp_str;
				if(forum($forum,$tmp_fid,'fid') != -1){
					$tmp_fid = forum($forum,$tmp_fid,'fid');
				}else{
					break; 
				}
			}
			echo $tmp_str;
			?>
			<span class="grey1"> > </span> 
			<a href="<?php HYBBS_URL('forum','',forum($forum,$thread_data['fid'],'id')) ?>"><?php echo forum($forum,$thread_data['fid'],'name'); ?></a>
		</div>
		<div class="wrap-box t-info">
			<div class="head">
		        <h1>
		        	<?php echo $thread_data['title'];?>
		        	<?php if ($thread_data['state']): ?><span title="<?php echo $_LANG['禁止回复'];?>" style="color: brown;"> - <?php echo $_LANG['已锁定'];?></span><?php endif ?>
		        </h1>
		        <div class="meta">
				<a href="<?php HYBBS_URL('my',$thread_data['user']); ?>" target="_blank">
					<?php echo $thread_data['user'];?>
				</a>
				&nbsp;&nbsp;·&nbsp;&nbsp;
				发表于 <?php echo humandate($thread_data['atime']); ?>
				&nbsp;&nbsp;·&nbsp;&nbsp;
				<a href="<?php HYBBS_URL('forum',$thread_data['fid']); ?>" >
					<?php echo forum($forum,$thread_data['fid'],'name'); ?>
				</a>
		        </div>
		        <a href="<?php HYBBS_URL('my',$thread_data['user']); ?>" class="avatar" target="_blank">
					<img src="<?php echo WWW;?><?php echo $thread_data['avatar']['b'];?>" pos="left" width="60" height="60" class="circle js-info" uid="<?php echo $thread_data['uid'];?>">
		        </a>
		      </div>
		      <div class="content typo editor-style">
		        
		        <?php if ($thread_data['show'] && $thread_data['gold_show']): ?>
					<?php echo $post_data['content'];?>
		        <?php else: ?>
					<?php if ($thread_data['gold_show']): ?>
						<blockquote style="color: #B75C5C;font-weight: bold;">
						<?php echo $_LANG['内容隐藏提示'];?>
						</blockquote>
					<?php else: ?>
						<blockquote style="color: #B75C5C;font-weight: bold;">
						<?php echo $_LANG['付费可见'];?> <a href="javascript:void(0);" onclick="buy_thread(<?php echo $thread_data['tid'];?>,<?php echo $thread_data['gold'];?>)">(<?php echo $_LANG['点击购买'];?>)</a> <?php echo $_LANG['售价'];?>：<?php echo $thread_data['gold'];?> <?php echo $_LANG['金币'];?>
						</blockquote>
					<?php endif ?>
		        <?php endif ?>
		        
		      </div>
		      <div class="actions">
				<button class="btn btn-info" onclick="tp('thread1',<?php echo $thread_data['tid'];?>,this)">
					<i class="iconfont icon-thumbsup1"></i> <span><?php echo $thread_data['goods'];?></span>
				</button>
				<button class="btn btn-info" onclick="tp('thread2',<?php echo $thread_data['tid'];?>,this)">
					<i class="iconfont icon-thumbsdown1"></i> <span><?php echo $thread_data['nos'];?></span>
				</button>
		        
		        <?php if (IS_LOGIN ): ?> 
					<?php $arr = explode(",",forum($forum,$thread_data['fid'],'forumg')); ?>
		            <?php if ($thread_data['uid'] == NOW_UID || NOW_GID == C("ADMIN_GROUP") || is_forumg($forum,NOW_UID,$thread_data['fid'])): ?>
		            
		            <a class="btn btn-link" href="<?php HYBBS_URL('post','edit',['id'=>$post_data['pid']]);  ?>">
		            <i class="iconfont icon-edit3" ></i> 编辑主题
		            </a>
		          
		            
		            <a href="javascript:void(0);" class="btn btn-link" onclick="del_thread(<?php echo $thread_data['tid'];?>,'thread')" >
		            <i class="iconfont icon-delete"></i> <?php echo $_LANG['删除主题'];?>
		            </a>

		            
		            <a href="javascript:void(0);" class="btn btn-link" onclick="set_state(<?php echo $thread_data['tid'];?>,<?php echo $thread_data['state'];?>)" >
		            <i class="iconfont icon-lock<?php if ($thread_data['state']): ?>1<?php endif ?>"></i> <?php if ($thread_data['state']): ?><?php echo $_LANG['解锁帖子'];?><?php else: ?><?php echo $_LANG['锁定帖子'];?><?php endif ?>
		            </a>

		            <?php endif ?>
		            <?php if (NOW_GID == C("ADMIN_GROUP")): ?>
		          
		                <?php if ($thread_data['top'] == 1): ?>

		                <a href="javascript:void(0);" class="btn btn-info is-active" onclick="thread_top(<?php echo $thread_data['tid'];?>,'off',1)" >
		                <i class="iconfont icon-top"></i> <?php echo $_LANG['取消板块置顶'];?>
		                </a>
		                <?php else: ?>
		                <a href="javascript:void(0);" class="btn btn-link" onclick="thread_top(<?php echo $thread_data['tid'];?>,'on',1)" >
		                <i class="iconfont icon-top"></i> <?php echo $_LANG['板块置顶'];?>
		                </a>
		                <?php endif ?>

		            
		                <!-- 管理员权限 -->
		                
		                <?php if ($thread_data['top'] == 2): ?>
		                <a href="javascript:void(0);" class="btn btn-info is-active" onclick="thread_top(<?php echo $thread_data['tid'];?>,'off',2)" >
		                <i class="iconfont icon-top"></i> <?php echo $_LANG['取消全站置顶'];?>
		                </a>
		                <?php else: ?>
		                <a href="javascript:void(0);" class="btn btn-link" onclick="thread_top(<?php echo $thread_data['tid'];?>,'on',2)" >
		                <i class="iconfont icon-top"></i> <?php echo $_LANG['全站置顶'];?>
		                </a>
		                <?php endif ?>

		            <?php endif ?>
		            <?php if (is_forumg($forum,NOW_UID,$thread_data['fid']) ): ?>
		                <?php if ($thread_data['top'] == 1): ?>
		                <a href="javascript:void(0);" class="btn" onclick="thread_top(<?php echo $thread_data['tid'];?>,'off',1)" ><?php echo $_LANG['取消板块置顶'];?></a>
		                <?php else: ?>
		                <a href="javascript:void(0);" class="btn" onclick="thread_top(<?php echo $thread_data['tid'];?>,'on',1)" ><?php echo $_LANG['板块置顶'];?></a>
		                <?php endif ?>
		            <?php endif ?>
		          <?php endif ?>
		      </div>
		</div>
		<?php if ($thread_data['files']): ?>
		<div class="wrap-box">
			<h2 style="border-bottom: solid #E6E6E6 1px;padding-bottom: 10px;"><?php echo $_LANG['附件列表'];?></h2>
			<?php foreach ($filelist as $v): ?>
			<?php if ($v['show']): ?>
				<p style="padding:10px 0;font-size:18px">
				<a href="javascript:void(0);" onclick="hy_downfile(<?php echo $v['fileid'];?>)"><?php echo $v['name'];?></a>
				<i style="color: grey;    font-size: 14px;">&nbsp;&nbsp;<?php echo $_LANG['文件大小'];?>:<?php echo round($v['size']/1024/1024,3); ?>M (<?php echo $_LANG['下载次数'];?>：<?php echo $v['downs'];?>)</i>
				<?php if ($v['gold']): ?>
					<span style="color: brown;"> &nbsp;&nbsp;<?php echo $_LANG['售价'];?>:<?php echo $v['gold'];?></span>
				<?php endif ?>
				</p>
			<?php else: ?>
				<p style="padding:10px 0;font-size:18px">
				<a href="javascript:void(0);" style="color: #c31d1d;"><?php echo $_LANG['附件隐藏'];?></a>
				</p>
			<?php endif ?>
			<?php endforeach ?>
		</div>
		<?php endif ?>
		<div class="wrap-box comment-list">
			<div class="head">
				<?php echo $thread_data['posts'];?> <?php echo $_LANG['条回复'];?> &nbsp;
				<span class="grey">|</span>
				&nbsp;<?php echo $_LANG['直到'];?> <?php echo humandate($thread_data['btime']); ?>
				<span class="grey">|</span>
				<?php echo $thread_data['views'];?> <?php echo $_LANG['次浏览'];?>
				<?php if (!empty($PostList)): ?>
				<div class="pull-right">
					<!-- 
					<a href="<?php HYBBS_URL('thread',$thread_data['tid']) ?>?order=desc"><?php echo $_LANG['最新回复'];?></a>
					<span class="grey">|</span>
					<a href="<?php HYBBS_URL('thread',$thread_data['tid']) ?>"><?php echo $_LANG['最早回复'];?></a> -->
					<button id="thread-sort" class="btn btn-link">
					<?php if (X('get.order')=='desc'): ?><?php echo $_LANG['最新回复'];?><?php else: ?>默认排序<?php endif ?> <i class="iconfont icon-sort"></i>
					</button>
					<div class="select-pop wrap-box">
					<button onclick="location.href='<?php HYBBS_URL('thread',$thread_data['tid']) ?>'" class="btn select-option">默认排序</button>
					<button onclick="location.href='<?php HYBBS_URL('thread',$thread_data['tid']) ?>?order=desc'" class="btn select-option"><?php echo $_LANG['最新回复'];?></button>
					</div>
					<script type="text/javascript">
					$(document).ready(function(){
						$("#thread-sort,.post--sort").click(function() {

							var _this2 = $(this).next();
							_this2.addClass('select-pop-show');
							$(document).bind('mousedown.efscbarEvent',function(e){
								$(document).unbind("mousedown.efscbarEvent");
						        if(!$(e.target).is($('#btn')) && !$(e.target).is($('#box')) && $(e.target).parent('#box').length === 0){
						        	_this2.removeClass('select-pop-show');
						        }
						    });
						});
					});
					
					function create_post_post_page_btn(pid,pageid,posts,max,sort){
						$('#post--ul-'+pid).html('<li><img src="<?php echo WWW;?>View/hybbs/loading.gif" style="margin: 0 auto;display: block;"><p style="text-align: center;color: #a3a3a3;">加载数据中...</p></li>');
						console.log(max);
						get_post_post(pid,pageid,sort);

						var tmp = (posts%max) ?(parseInt(posts/max)+1) : parseInt(posts/max);
						var page_count = (posts % max != 0)?(parseInt(posts/max)+1) : parseInt(posts/max);
						pageid = pageid || 1;
						var html = '';
						if(pageid != 1){
							html+='<button data-pageid="'+(pageid-1)+'" class="btn btn-primary">上一页</button>';
						}
						
						for (var i=(pageid-5 < 1) ? 1 : pageid -5; i< ((pageid + 5 > tmp) ? tmp+1 : pageid + 5) ; i++){
							html+='<button data-pageid="'+i+'" class="btn btn-primary '+(pageid == i ? 'disabled' : '')+'">'+i+'</a>';
						}
						if(pageid != page_count)
							html+='<button data-pageid="'+(pageid+1)+'" class="btn btn-primary">下一页</button>';
						//var tag = $(html);

						$('#post--btns-'+pid).html(html).find('button').click(function(){
							var _this = $(this);
							var _pageid = _this.data('pageid');
							location.href="#post--pos-"+pid;
							if(pageid == _pageid)
								return;
							//alert('sss');
							create_post_post_page_btn(pid,_pageid,posts,max,sort);

						});
					}
					function show_post_post_box(obj){
						var _this = $(obj);
						var state = _this.data('state');
						var pid = _this.data('pid');
						var posts = _this.data('posts');
						var sort = _this.data('sort');
						console.log(sort);
						if(state == 'hide'){ //Show
							_this.data('state','show');
							_this.html('<i class="iconfont icon-top2"></i> 收起列表');
							_this.addClass('active');
							$('#post--box-'+pid).show();
							$('#post--sort-s'+pid).text(_this.data('str'+sort));
							if(posts) //存在子评论 显示分页按钮
								create_post_post_page_btn(pid,1,posts,<?php echo intval(BBSCONF('post_post_show_size')) ?>,sort);
							else{
								$('#post--ul-'+pid).html('<li><p style="text-align: center;color: #a3a3a3;">暂无数据...</p><li>');
							}

						}else{//收起评论列表
							_this.data('state','hide');
							if(posts != 0)
								_this.html('<i class="iconfont icon-commentalt2fill"></i> '+posts+' 条点评');
							else
								_this.html('<i class="iconfont icon-commentalt2fill"></i> 点评');
							_this.removeClass('active');
							$('#post--box-'+pid).hide();
							
						}

					}
					
					</script>
				</div>
				<?php endif ?>
	        </div>
	        <?php $DataModel = M('Data');$User = M('User'); ?>
	        <?php foreach ($PostList as $k => $v): ?>
	        <?php if ($v['rpid']): ?>
	        	<?php $quote_data = $DataModel->get_post_data($v['rpid']) ?>
	        <?php endif ?>
	        <div class="item" id="post-<?php echo $v['pid'];?>">
				<a href="<?php HYBBS_URL('my',$v['user']); ?>" class="avatar" target="_blank">
	            	<img class="circle js-unveil js-info" uid="<?php echo $v['uid'];?>" pos="right" src="<?php echo WWW;?><?php echo $v['avatar']['b'];?>">
				</a>
				<div class="r">
					<p class="meta">
						<a href="<?php HYBBS_URL('my',$v['user']); ?>" class="author" target="_blank">
							<?php echo $v['user'];?>
						</a>
						<br>
						<span class="time">
							发表于 <?php echo $v['atime_str'];?>
						</span>
	            	</p>
		            <div class="text typo editor-style">
		            
		            	<?php if ($v['rpid']): ?>
		            	<div class="quote-bx quote-box" style="display: block;">
						    
						    <div class="quote-bx">
						        <div class="quote-left">
						            <img class="quote-avatar" src="<?php echo WWW;?>public/images/user.gif">
						        </div>
						        <div class="quote-info">
						            <p class="quote-user"><?php echo $User->uid_to_user($quote_data['uid']);?></sppan>
						            <p class="quote-time"><?php echo humandate($quote_data['atime']);?></p>
						        </div>
						    </div>
						    <div class="quote-content">
						    	<?php echo $quote_data['content'];?>
						    </div>
						</div>
						<?php endif ?>
		            	<div id="pid-<?php echo $v['pid'];?>">
						<?php echo $v['content'];?>
						</div>
		            
		            </div>
		            <div class="p-foot">
						<button class="btn btn-info" onclick="tp('post1',<?php echo $v['pid'];?>,this)">
							<i class="iconfont icon-thumbsup1"></i> <span><?php echo $v['goods'];?></span>
						</button>
						<button class="btn btn-info" onclick="tp('post2',<?php echo $v['pid'];?>,this)">
							<i class="iconfont icon-thumbsdown1"></i> <span><?php echo $v['nos'];?></span>
						</button>

						<button class="btn btn-link" data-pid="<?php echo $v['pid'];?>" data-uid="<?php echo $v['uid'];?>" data-avatar="<?php echo WWW;?><?php echo $v['avatar']['b'];?>" data-user="<?php echo $v['user'];?>" data-time="<?php echo $v['atime_str'];?>" onclick="jump_post(this)">
                        	<i class="iconfont icon-marks"></i> 回复帖子
                        </button>

						<button style="float: right;line-height: 2.3;<?php if ($v['posts']): ?>color: #ef6464;<?php endif ?>"  id="post--start-<?php echo $v['pid'];?>" class="btn btn-link" data-str0="默认排序" data-str1="<?php echo $_LANG['最新回复'];?>" data-sort="0" data-posts="<?php echo $v['posts'];?>" data-state="hide" data-pid="<?php echo $v['pid'];?>" onclick="show_post_post_box(this)">
                        	<i class="iconfont icon-commentalt2fill"></i> <?php if ($v['posts']): ?><?php echo $v['posts'];?> 条点评<?php else: ?>点评<?php endif ?>
                        </button>

	                	<?php if (IS_LOGIN ): ?>

	                    
	                    <?php if ($v['uid'] == NOW_UID || NOW_GID == C("ADMIN_GROUP")): ?>
	                        <!-- 帖子作者 或者 管理员 -->
	                        <a class="btn btn-link" href="<?php HYBBS_URL('post','edit',['id'=>$v['pid']]);  ?>">
	                        <i class="iconfont icon-edit3"></i> 编辑帖子
	                        </a>
	                    <?php endif ?>
	                    <?php if ($v['uid'] == NOW_UID || NOW_GID == C("ADMIN_GROUP") || is_forumg($forum,NOW_UID,$thread_data['fid'])): ?>
	                        <!-- 作者 与 管理员 判断 -->
	                        <a href="javascript:void(0);" class="btn btn-link" onclick="del_thread(<?php echo $v['pid'];?>,'post')" >
	                        <i class="iconfont icon-delete"></i> <?php echo $_LANG['删除帖子'];?>
	                        </a>
	                    <?php endif ?>
	                    
	                	<?php endif ?>
	                </div>
	                <div id="post--box-<?php echo $v['pid'];?>" class="post--box">
	                	<h2 id="post--pos-<?php echo $v['pid'];?>">
	                		评论列表
	                		<button class="btn btn-link post--sort pull-right">
							<span id="post--sort-s<?php echo $v['pid'];?>"><?php if (X('get.order')=='desc'): ?><?php echo $_LANG['最新回复'];?><?php else: ?>默认排序<?php endif ?></span> <i class="iconfont icon-sort"></i>
							</button>
							<div class="select-pop wrap-box">
							<button onclick="$('#post--start-<?php echo $v['pid'];?>').data('state','hide').data('sort','0').click()" class="btn select-option">默认排序</button>
							<button onclick="$('#post--start-<?php echo $v['pid'];?>').data('state','hide').data('sort','1').click()" class="btn select-option"><?php echo $_LANG['最新回复'];?></button>
							</div>
	                	</h2>
						<ul id="post--ul-<?php echo $v['pid'];?>">
							<li>
								<img src="<?php echo WWW;?>View/hybbs/loading.gif" style="margin: 0 auto;display: block;">
								<p style="text-align: center;color: #a3a3a3;">加载数据中...</p>
							</li>
						</ul>
						<div id="post--btns-<?php echo $v['pid'];?>" class="post--page-btns">
							
						</div>
						<div class="post--foot">
							<div id="post--loading-<?php echo $v['pid'];?>" class="loading"></div>
							<span id="post--<?php echo $v['pid'];?>" onfocus="if(this.textContent=='编写评论内容')this.textContent=''" onblur="if(this.textContent=='')this.textContent='编写评论内容'" type="text" class="input-text" contenteditable="true">编写评论内容</span>
							<button id="post--btn-<?php echo $v['pid'];?>" class="btn btn-primary" onclick="post_post(<?php echo $v['pid'];?>)">发表</button>
							<button onclick="$('#post--start-<?php echo $v['pid'];?>').data('state','show').click()" class="btn pull-right"><i class="iconfont icon-top2"></i> 收起列表</button>
						</div>
	                </div>
	        	</div>
	        </div>
	        <?php endforeach ?>
		</div>
		<div class="wrap-box">
			
			<a href="<?php if ($pageid==1): ?>javascript:void(0);<?php else: ?><?php HYBBS_URL('thread',$thread_data['tid'], $pageid-1); ?><?php echo X("get.order")?"?order=desc":''; ?><?php endif ?>"  class="btn bg-primary <?php if ($pageid==1): ?>disabled<?php endif ?>" ><?php echo $_LANG['上一页'];?></a>
			<a href="<?php if ($pageid==$page_count): ?>javascript:void(0);<?php else: ?><?php HYBBS_URL('thread',$thread_data['tid'], $pageid+1); ?><?php echo X("get.order")?"?order=desc":''; ?><?php endif ?>" class="btn bg-primary large pull-right <?php if ($pageid==$page_count): ?>disabled<?php endif ?>" ><?php echo $_LANG['下一页'];?></a>
			
		</div>
		<div class="wrap-box">
			
			<?php if (IS_LOGIN): ?>
			
<?php //Hook ##START##a:3:{s:11:"plugin_name";s:18:"HY-Editor编辑器";s:8:"dir_name";s:9:"hy_editor";s:4:"path";s:61:"D:/phpstudy_pro/WWW/test/Plugin/hy_editor/t_thread_index.hook";}## ?>

<?php $editor_inc = get_plugin_inc('hy_editor');?>
<?php if ($editor_inc['post'] == 1): ?>
<!-- HYBBS公用编辑器UI资源 -->
<link href="<?php echo WWW;?>public/css/editor.ui.css?ver=1.0" type="text/css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo WWW;?>Plugin/hy_editor/icon/iconfont.css">
<link rel="stylesheet" type="text/css" href="<?php echo WWW;?>Plugin/hy_editor/editor.css">
<script type="text/javascript" src="<?php echo WWW;?>Plugin/hy_editor/editor.js"></script>
<script type="text/javascript" src="<?php echo WWW;?>Plugin/hy_editor/lib/uploadImage.js"></script>
<script type="text/javascript" src="<?php echo WWW;?>Plugin/hy_editor/lib/help.js"></script>


<a name="post"></a>
<div class="rep-bx rep-box">
    <div class="rep-close rep-right" onclick="stop_post(this)">×</div>
    <div class="rep-bx">
        <div class="rep-left">
            <img class="rep-avatar" src="<?php echo WWW;?>public/images/user.gif">
        </div>
        <div class="rep-info">
            <p class="rep-user">loading</sppan>
            <p class="rep-time">loading</p>
        </div>
    </div>
    <div class="rep-content"></div>
</div>


<div class="hy-editor"></div>



<button style="margin-top: 10px" type="button" class="editor-btn editor-btn-primary" id="post_post"><i class="am-icon-check"></i> 发 表</button>



<script type="text/javascript">
    var editor = new HY_editor('.hy-editor',{
        toolbar:'<?php echo $editor_inc['toolbar_post'];?>',
        upload_image_path:'<?php HYBBS_URL('Post','upload') ?>',
        toolbarFixed:true,

        width:'<?php echo $editor_inc['width'];?>',
        height:'<?php echo $editor_inc['height'];?>'
    });
</script>


<script>
//回复帖子
function jump_post(obj){
    var _this   = $(obj);
    var pid     = _this.data('pid');
    var user    = _this.data('user');
    var avatar  = _this.data('avatar');
    var time    = _this.data('time');
    var content = $('#pid-'+pid);

    window.rep_pid = pid;

    $('.rep-user').text(user);
    $('.rep-time').text(time);
    $('.rep-avatar').attr('src',avatar);
    
    $('.rep-content').html(content.html());

    $('.rep-box').show();

    $("body,html").animate({
        scrollTop:$('.rep-box').offset().top //让body的scrollTop等于pos的top，就实现了滚动
    });
}
function stop_post(){
    $('.rep-box').hide();
    window.rep_pid = 0;
}

$(function(){
    var edit_bool = function(){};

    $("#post_post").click(function(){
        var _obj = $(this);
        _obj.attr('disabled','disabled');
        _obj.text("提交中...");

        var forum = $("#forum").val();
        $.ajax({
            url: '<?php HYBBS_URL('post','post') ?>',
            type:"POST",
            cache: false,
            data:{
                id:<?php echo $tid;?>,
                pid:window.rep_pid,
                content:editor.getValue(),
                
                },
            dataType: 'json'
        }).then(function(e) {
            if(e.error){
                window.location.reload();
            }else{
                _obj.removeAttr('disabled');
                _obj.text("发 表");
                swal(e.error?"发表成功":"发表失败", e.info, e.error?"success": "error");
            }
        }, function() {
            _obj.removeAttr('disabled');
            _obj.text("发 表");
            swal("失败", "请尝试重新提交", "error");
        });
    })
})
</script>
<?php endif ?>

<?php //Hook ##END##a:3:{s:11:"plugin_name";s:18:"HY-Editor编辑器";s:8:"dir_name";s:9:"hy_editor";s:4:"path";s:61:"D:/phpstudy_pro/WWW/test/Plugin/hy_editor/t_thread_index.hook";}## ?>

			<?php else: ?>
			<a href="<?php HYBBS_URL('user','login') ?>"><?php echo $_LANG['登录'];?></a><?php echo $_LANG['后才可发表内容'];?>
			<?php endif ?>
			
      </div>
	</div>
<?php !defined('HY_PATH') && exit('HY_PATH not defined.'); ?>
    <?php if (ACTION_NAME != 'Post'): ?>
    <div class="right" style="float: right;width: 300px;">
        
        <?php if (view_form('hybbs','forum_right')): ?>
        <?php isset($fid) || $fid = -1; ?>
        <?php if (ACTION_NAME == 'Thread'): ?><?php $fid = $thread_data['fid'] ?><?php endif ?>
        <?php if ((ACTION_NAME == 'Thread' || ACTION_NAME == 'Forum') && isset($forum[$fid]['z'])): ?>
        <div class="right-widget only-logo">
            
            <ul id="right-forum-list">
                <?php if ($forum[$fid]['fid'] != -1): ?>
                <li>
                    <a href="<?php HYBBS_URL('forum',$forum[$forum[$fid]['fid']]['id']); ?>">
                        <img src="<?php echo WWW;?>upload/forum<?php echo $forum[$forum[$fid]['fid']]['id'];?>.png" onerror="this.src='<?php echo WWW;?>upload/de.png'">
                        返回：<?php echo $forum[$forum[$fid]['fid']]['name'];?> <i class="iconfont icon-right2 pull-right"></i>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo WWW;?>">
                        <img src="<?php echo WWW;?>View/hybbs/forum_home.png">
                        返回首页 <i class="iconfont icon-right2 pull-right"></i>
                    </a>
                </li>
                <?php endif ?>
                <li>
                    <a class="active" href="<?php HYBBS_URL('forum',$fid); ?>">
                        <img src="<?php echo WWW;?>upload/forum<?php echo $fid;?>.png" onerror="this.src='<?php echo WWW;?>upload/de.png'">
                        <?php echo $forum[$fid]['name'];?> <i class="iconfont icon-right2 pull-right"></i>
                    </a>
                </li>
                <?php foreach ($forum as $key => $v): ?>
                <?php if ($v['fid'] == $fid): ?>
                <li>
                    <a href="<?php HYBBS_URL('forum',$v['id']); ?>">
                        <img src="<?php echo WWW;?>upload/forum<?php echo $key;?>.png" onerror="this.src='<?php echo WWW;?>upload/de.png'">
                        <?php echo $v['name'];?> <i class="iconfont icon-right2 pull-right"></i>
                    </a>
                </li>
                <?php endif ?>
                <?php endforeach ?>
            
            </ul>
        </div>
        <?php else: ?>
        <div class="right-widget only-logo">
            <div class="head">
                分类列表 <a href="<?php HYBBS_URL('forum') ?>" class="pull-right js-tooltip">更多</a>
            </div>
            <ul id="right-forum-list">
                <?php foreach ($forum as $key => $v): ?>
                <?php if ($v['fid'] == -1): ?>
                <li>
                    <a href="<?php HYBBS_URL('forum',$v['id']); ?>" >
                        <img src="<?php echo WWW;?>upload/forum<?php echo $key;?>.png" onerror="this.src='<?php echo WWW;?>upload/de.png'" >
                        <?php echo $v['name'];?> <i class="iconfont icon-right2 pull-right"></i>
                    </a>
                </li>
                <?php endif ?>
                <?php endforeach ?>
            
            </ul>
        </div>
        <?php endif ?>
        <?php endif ?>
        
    </div>
    <?php endif ?>
</div>
<footer>
    <div class="container">
        <div class="version">
            <p>HYBBS © 2016. All Rights Reserved. <a href="<?php echo WWW;?>"><?php echo $conf['logo'];?></a> </p>
            <p>Powered by <a href="http://bbs.hyphp.cn/">HYBBS</a> Version <?php echo HYBBS_V;?></p>
            <?php if (view_form('hybbs','show_sleep')): ?>
            <p>Runtime:<?php echo number_format(microtime(1) - $GLOBALS['START_TIME'], 4); ?>s Mem:<?php echo round((memory_get_usage() - $GLOBALS['START_MEMORY'])/1024); ?>Kb</p>
            <?php endif ?>
        </div>
    </div>
</footer>

<?php if (IS_LOGIN): ?>
<div class="friend-box">
	<audio id="play-msg">
    <source src="<?php echo WWW;?>public/mp3/msg.mp3" type="audio/mp3">
</audio>
	<audio id="play-system">
    <source src="<?php echo WWW;?>public/mp3/system.mp3" type="audio/mp3">
</audio>
	<div class="friend-box-close" onclick="$('.friend-box').toggleClass('friend-box-a')">×</div>
	<div class="friend-info-box">
		<img src="<?php echo WWW;?><?php echo $user['avatar']['b'];?>">
		<h2><?php echo $user['user'];?> </h2>
		<p>
			<span class="badge badge-purple bounceIn animation-delay2" style="font-size: 14px;font-weight: 400;background: cadetblue;"><?php echo $usergroup[NOW_GID]['name'];?></span>
		</p>
		<p>
		<a href="<?php HYBBS_URL('my',$user['user']); ?>"><?php echo $_LANG['个人中心'];?></a>
		<span>|</span>
		<a href="<?php HYBBS_URL('user','out') ?>"><?php echo $_LANG['退出账号'];?></a>
		</p>
		<p>
		<a href="javascript:void(0);" onclick="clear_mess()"><?php echo $_LANG['清空未读'];?></a>
		<?php if ($user['gid'] == C('ADMIN_GROUP')): ?>
		<span>|</span>
		<a href="<?php HYBBS_URL('admin') ?>"><?php echo $_LANG['管理后台'];?></a>
		<?php endif ?>
		</p>
	</div>
	<script type="text/javascript">
	<?php if (IS_LOGIN): ?>
	window.hy_user = "<?php echo NOW_USER;?>";
	window.hy_avatar = WWW + "<?php echo $user['avatar']['a'];?>";
	<?php else: ?>
	window.hy_user = '';
	window.hy_avatar = '';
	<?php endif ?>
	$(function(){
		load_friend();
	})
	</script>
	<div class="friend-div-box">
		<input type="text" class="friend-text" placeholder="<?php echo $_LANG['搜索好友名'];?>">
		<img src="<?php echo WWW;?>View/hy_friend/cog.png" style="padding-top: 7px;padding-left: 7px;font-size: 18px;display: inline-block;"></span>
	</div>
	<div class="friend-title">
		<?php echo $_LANG['关注列表'];?> +
	</div>
	<div class="friend-div-box">
		<ul class="friend-ul" id="friend-1">
			<li><a onclick="new_chat('title','ssss',444,465,0,'<?php echo $_LANG['系统'];?>','View/hy_friend/bell.png','系统消息')" class="clearfix">
			<img src="<?php echo WWW;?>View/hy_friend/bell.png" class="img-circle" alt="user avatar">
			<div class="chat-detail m-left-sm">
				<div class="chat-name"><?php echo $_LANG['系统'];?></div>
				<div class="chat-message"><?php echo $_LANG['系统消息'];?></div>
			</div>
			<div class="chat-status">
			<span class="friend-zx"></span>
			</div>
			<div class="chat-alert">
				<span id="friend-span-0" class="badge badge-purple bounceIn animation-delay2 friend-hide">0</span></div></a></li>
		</ul>
	</div>
	<div class="friend-title">
		<?php echo $_LANG['粉丝列表'];?> +
	</div>
	<div class="friend-div-box">
		<ul class="friend-ul" id="friend-3">
			
		</ul>
	</div>
	<div class="friend-title">
		<?php echo $_LANG['陌生人'];?> +
	</div>
	<div class="friend-div-box">
		<ul class="friend-ul" id="friend-0">
			
		</ul>
	</div>

</div>
<div class="friend-v" onclick="$('.friend-box').toggleClass('friend-box-a')"></div>
<script type="text/javascript">
	$(function(){
		$(".friend-title").click(function(){
			$(this).next().toggleClass('friend-div-box-hide');
		})
	})
</script>
<?php endif ?>
</body>
</html>