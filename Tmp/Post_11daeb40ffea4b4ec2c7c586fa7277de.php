<?php
namespace Action;
use HY\Action;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class Post extends HYBBS {
	public $tid=0;
	public $pid=0;
	public $posts=0;
	public $title;
	public $content;
	public $ante_type=0;
	public function __construct() {
		parent::__construct();
		
		if(!IS_LOGIN){
			if(IS_AJAX && IS_POST){
				die($this->json(array('error'=>false,'info'=>'请登录后再操作')));
			}
			else{
				header("location: ". HYBBS_URLA('user','login'));
				die;
			}

		}
		
		
	}
	//发表评论
	public function Post(){
		
		$this->v('title','发表评论');
		if(!IS_POST)
			return;
		if($this->_user['ban_post']){
			$this->json(array('error'=>false,'info'=>'您的账号已被禁言!'));
		}

		$UsergroupLib = L("Usergroup");
		//用户组权限判断
		if(!$UsergroupLib->read(NOW_GID,'post',$this->_usergroup))
			return $this->json(array('error'=>false,'info'=>'你当前所在用户组无法发表评论'));

		
		$tid= intval(X("post.id"));
		if(empty($tid))
			return $this->json(array('error'=>false,'info'=>'文章ID不能为空'));
		if(!isset($_POST['content']))
			return $this->json(array('error'=>false,'info'=>'内容不能为空'));
		
		$content = X('post.content');
		if (get_magic_quotes_gpc())
  			$content = stripslashes($content);
		
		if(NOW_GID != C("ADMIN_GROUP")){
			$Kses =L("Kses");
        	$content = $Kses->Parse($content);
		}
		//去除image 所有属性
		//$content = preg_replace("/<img.*?src=(\"|\')(.*?)\\1[^>]*>/is",'<img src="$2" />', $content);
		//删除 img的宽度与高度 
		//$content = preg_replace('/(<img.*?)((width)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);
		$content = preg_replace('/(<img.*?)((height)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);
		//去除泰文音标
		$content = preg_replace( '/\p{Thai}/u' , '' , $content );
		$tmp = str_replace('&nbsp;','',$content);
		$tmp = trim(strip_tags($tmp,'<img><iframe><embed><video>'));

		if(empty($tmp) || $tmp == '&nbsp;')
			return $this->json(array('error'=>false,'info'=>'内容不能为空'));
		
		//获取文章数据
		$Thread = M('Thread');
		$thread_data = $Thread->read($tid);
		//锁帖判断
		if($thread_data['state'] && NOW_UID != $thread_data['uid'] && NOW_GID != C("ADMIN_GROUP") && !is_forumg($this->_forum,NOW_UID,$thread_data['fid']))
			return $this->json(array('error'=>false,'info'=>'帖子已经被锁定'));
		if(!L("Forum")->is_comp($thread_data['fid'],NOW_GID,'post',$this->_forum[$thread_data['fid']]['json']))
			return $this->json(array('error'=>false,'info'=>'你没有权限发表'));

		
		$this->tid = $tid;
		$this->posts = $thread_data['posts'];
		$this->title = $thread_data['title'];

		//发送消息摘要
		$this->content = mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']);

		
		
		//回复评论 非点评评论
		$rpid = intval(X('post.pid',0));

		//写入评论数据
		$Post = S("Post");

		//评论不存在 或 评论是主题内容 无法引用回复
		if(!$Post->has(['pid'=>$rpid]) || $thread_data['pid'] == $rpid)
			$rpid = 0;


		$Post->insert(array(
			'tid'	=> $tid,
			'fid'	=> $thread_data['fid'],
			'uid'	=> NOW_UID,
			'rpid'	=> $rpid,
			'content' => trim($content),
			'atime'	  => NOW_TIME,
			'etime'	  => NOW_TIME
		));
		$this->pid = $pid = $Post->id();

		//@用户
		$this->ante_type = 'post';
		if($UsergroupLib->read(NOW_GID,'mess',$this->_usergroup))
			$content = $this->ante($content);
		$Post->update(['content'=>$content],['pid'=>$pid]);


		
		//分类 评论数量+1
		M("Forum")->update_int($thread_data['fid'],'posts');
		$this->_forum[$thread_data['fid']]['posts']++;
		$this->CacheObj->forum = $this->_forum;
		$this->_count['post']++;
		$this->_count['day_post']++;
		$this->CacheObj->bbs_count = $this->_count;
		if($thread_data['top']==1) //如果是板块置顶帖子，清理该板块置顶帖子缓存
			$this->CacheObj->rm("forum_top_id_".$thread_data['fid']);
		elseif($thread_data['top']==2)
			$this->CacheObj->rm("top_data_2");
		
		//更新主题 回复帖子数
		$Thread->update([
			'posts'=>$Post->count(['tid'=>$tid])-1, //评论数+1
			'btime'=>NOW_TIME, // 最后评论过时间
			'buid'=>NOW_UID, //最后回复者用户ID
		],[
			'tid'=>$tid
		]);
		
		$User = M("User");
		//用户评论数+1
		$User->update_int(NOW_UID,'posts','+');
		//增加金币
		$User->update_int(NOW_UID,'gold','+',$this->conf['gold_post']);
		//增加积分
		$User->update_int(NOW_UID,'credits','+',$this->conf['credits_post']);
		$this->_user['posts']++;
		if($thread_data['uid'] != NOW_UID){
			M("Chat")->sys_send($thread_data['uid'],'<a href="'. HYBBS_URLA('my',NOW_USER).'" target="_blank">['.NOW_USER.']</a> 回复了你的主题 <a href="'. HYBBS_URLA('thread',$thread_data['tid']).'" target="_blank">['.$thread_data['title'].']</a>');
		}
		if($this->conf['gold_post'] != 0 || $this->conf['credits_post'] != 0){
			S("Log")->insert(array(
				'uid'=>NOW_UID,
				'gold'=>$this->conf['gold_post'],
				'credits'=>$this->conf['credits_post'],
				'content'=>'发表评论 文章ID['.$thread_data['tid'].']',
				'atime'=>NOW_TIME
			));
		}
		

		if($thread_data['top'] == 2)
			$this->CacheObj->rm("top_data_2");
		elseif($thread_data['top'] == 1)
			$this->CacheObj->rm("forum_top_id_".$thread_data['fid']);

		$this->CacheObj->rm("index_index_Btime_1");
		$this->CacheObj->rm("index_index_{$thread_data['fid']}_1_Btime");
		$this->CacheObj->rm('thread_data_'.$tid);

		$count = intval(($thread_data['posts'] /  $this->conf['postlist']) + 1)+1;
        for ($i=0; $i < $count; $i++) {
            $this->CacheObj->rm("post_list_{$tid}_DESC_{$i}");
            $this->CacheObj->rm("post_list_{$tid}_ASC_{$i}");
        }


		//用户组升级检测
		M('Usergroup')->check_up(NOW_UID);
		

		
		return $this->json(array('error'=>true,'info'=>'发表成功'));

	}
	//发表主题
	public function Index(){
		
		$this->v('title','发表主题');
		if($this->_user['ban_post']){
			return $this->message('您的账号已被禁言!');
		}
        if(IS_GET){ //显示发表主题模板
			
          
			
            
    		$this->display('post_index');
        }elseif(IS_POST){ //POST发表主题
			
			$UsergroupLib = L("Usergroup");

			if(!$UsergroupLib->read(NOW_GID,'thread',$this->_usergroup))
				return $this->json(array('error'=>false,'info'=>'你当前所在用户组无法发表主题'));


			//获取提交数据
            $forum = X("post.forum",'-1');
            $title = trim(X("post.title"));
            $title = htmlspecialchars($title);
            $tgold = intval(X("post.tgold"));
            $thide = intval(X("post.thide"));
            


            
            if(!$UsergroupLib->read(NOW_GID,'thide',$this->_usergroup)){
            	if($thide)
            		return $this->json(array('error'=>false,'info'=>'你所在用户组无法隐藏帖子'));
            	$thide = 0;
            }
            if(!$UsergroupLib->read(NOW_GID,'tgold',$this->_usergroup)){
            	if($tgold)
            		return $this->json(array('error'=>false,'info'=>'你所在用户组无法设置金币付费帖子'));
            	$tgold = 0;
            }
            

            //去除泰文音标
			$title = preg_replace( '/\p{Thai}/u' , '' , $title );
			$this->title=$title;

            $content = X('post.content');
            if (get_magic_quotes_gpc())
  				$content = stripslashes($content);
            
			if(NOW_GID != C("ADMIN_GROUP")){
				$Kses =L("Kses");
        		$content = $Kses->Parse($content);
			}
            $content=preg_replace( '/\p{Thai}/u' , '' , $content );

            
			$tmp = str_replace('&nbsp;','',$content);
			$tmp = trim(strip_tags($tmp,'<img><iframe><embed><video>'));
            if(empty($tmp))
				return $this->json(array('error'=>false,'info'=>'内容不能为空'));

			
            if(mb_strlen($title) < $this->conf['titlemin'])
				return $this->json(array('error'=>false,'info'=>'标题长度不能小于'.$this->conf['titlemin'].'个字符'));
			if(mb_strlen($title) > $this->conf['titlesize'])
				return $this->json(array('error'=>false,'info'=>'标题长度不能大于'.$this->conf['titlesize'].'个字符'));
			if($forum < 0 ){
				return $this->json(array('error'=>false,'info'=>'请选择一个分类'));
			}
			
			//用户组在分类下的权限判断
			if(!isset($this->_forum[$forum])){
				if(empty($this->_forum[$forum]['id']))
					return $this->json(array('error'=>false,'info'=>'不存在该分类'));
			}
			
			if(!L("Forum")->is_comp($forum,NOW_GID,'thread',$this->_forum[$forum]['json']))
				return $this->json(array('error'=>false,'info'=>'你没有权限在该板块发表帖子'));
			
            //去除image 所有属性
            //$content = preg_replace("/<img.*?src=(\"|\')(.*?)\\1[^>]*>/is",'<img src="$2" />', $content);

            //去除图标中的width 与 height 防止在页面上 变形
            //$content = preg_replace('/(<img.*?)((width)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);
			$content = preg_replace('/(<img.*?)((height)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);
			
            //获取所有图片地址
			$pattern="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
			preg_match_all($pattern,$content,$match);
			$img = '';
			$sz=0;
			if(isset($match[1][0])){
				foreach ($match[1] as $v) {
					if(substr_count($v,'data:image/') || substr_count($v,';base64') || strpos($v,'/emoji/') !== FALSE || empty($v))
						continue;
					if($sz++<$this->conf['post_image_size']){
						$img.=$v;
						$img.=",";
					}
				}
			}
			
			//发送消息 摘要
			$this->content = mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']);

			
			
			
			//主题数据
            $Thread = S("Thread");
            $Thread->insert(array(
                'fid'=>$forum,
                'uid'=>NOW_UID,
                'title'=>$title,
                'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
				'atime'	=>NOW_TIME,
				'etime'	=>NOW_TIME,
				'btime'	=>NOW_TIME,
				'img'	=>$img,
				'img_count'	=>$sz,
				'hide'	=>$thide?1:0,
				'gold'	=>$tgold,
            ));
            $this->tid = $tid = $Thread->id();
            
            
            //@用户
			$this->ante_type = 'thread';
			if($UsergroupLib->read(NOW_GID,'mess',$this->_usergroup))
				$content = $this->ante($content); //@ 用户函数

            //主题帖子数据
            $Post = S("Post");
            $Post->insert(array(
				'tid'	=> $tid,
				'fid'	=>$forum,
				'uid'	=> NOW_UID,
				'isthread'=> 1,
				'content' => $content,
				'atime'	  => NOW_TIME
            ));
            $pid = $Post->id();

            $Thread->update(['pid'=>$pid],['tid'=>$tid]);

            

            //是否有权限上传附件
            if($UsergroupLib->read(NOW_GID,'uploadfile',$this->_usergroup)){

	            //处理附件
	            $fileid 	= X("post.fileid");
	            $filegold 	= X("post.filegold");
	            $filemess 	= X("post.filemess");
	            $filehide 	= X("post.filehide");
	            

	            if(!empty($fileid)){
	            	
	            	$fileid_arr 	= explode("||",$fileid);
	            	$filegold_arr 	= explode("||",$filegold);
	            	$filemess_arr 	= explode("||",$filemess);
	            	$filehide_arr 	= explode("||",$filehide);

	            	if(count($fileid_arr)){
	            		

	            		$File = M("File");
	            		$Fileinfo = S("Fileinfo");
	            		$i = 0;
	            		foreach ($fileid_arr as $key => $v) {
	            			
	            			if(empty($v))
	            			{
	            				
	            				continue;
	            			}
	            			$i++;
	            			//判断附件ID 是否属于 发帖者
	            			if($File->is_comp(intval($v),NOW_UID)){
	            				$Fileinfo->insert(array(
	            					'fileid'	=>	intval($v),
	            					'tid'		=>	$tid,
	            					'uid'		=>	NOW_UID,
	            					'gold'		=>	isset($filegold_arr[$key]) ? intval($filegold_arr[$key]) : 0,
	            					'hide'		=>	isset($filehide_arr[$key]) ? intval($filehide_arr[$key]) : 0,
	            					'mess'		=>	isset($filemess_arr[$key]) ? htmlspecialchars(strip_tags($filemess_arr[$key])) : '',
	            				));
	            			}

	            		}
	            		
	            		$Thread->update(['files'=>$i],['tid'=>$tid]); //更新主题附件数量
	            	}
	            }//处理附件结束

            }
            



			$User = M("User");
			//用户增加 主题数
			$User->update_int(NOW_UID,'threads','+');

			//用户增加 金钱
			$User->update_int(NOW_UID,'gold','+',$this->conf['gold_thread']);
			//用户增加 积分
			$User->update_int(NOW_UID,'credits','+',$this->conf['credits_thread']);

			if($this->conf['gold_thread'] != 0 || $this->conf['credits_thread'] != 0){
				S("Log")->insert(array(
					'uid'=>NOW_UID,
					'gold'=>$this->conf['gold_thread'],
					'credits'=>$this->conf['credits_thread'],
					'content'=>'发表文章 文章ID['.$tid.']',
					'atime'=>NOW_TIME
				));
			}

			//分类板块 帖子数量++
			M("Forum")->update_int($forum);

			//更新分类缓存
			$this->_forum[$forum]['threads']++;
			$this->CacheObj->forum = $this->_forum;
			//更新统计缓存
			$this->_count['thread']++;
			$this->_count['day_thread']++;
			$this->CacheObj->bbs_count = $this->_count;

			$this->_user['threads']++;

			//删除第一页缓存
			$this->CacheObj->rm("index_index_New_1");
			$this->CacheObj->rm("index_index_Btime_1");

			$this->CacheObj->rm("index_index_{$forum}_1_Btime");
			$this->CacheObj->rm("index_index_{$forum}_1_New");
			


			//用户组升级检测
			M('Usergroup')->check_up(NOW_UID);

			
            $this->json(array('error'=>true,'info'=>'发表成功','id'=>$tid));




        }

	}

	//发表子评论
	public function post_post(){
		
		if(IS_POST && IS_AJAX){
			
			if($this->_user['ban_post']){
				$this->json(array('error'=>false,'info'=>'您的账号已被禁言!'));
			}
			
			$pid = intval(X('post.pid'));
			$content = trim(X('post.content'));
			$content = str_replace(['<div><br></div>','<div>','</div>','<p>','</p>'],"\n",$content);
			$content = strip_tags($content); //去除HTML标签并
			$content = preg_replace( '/\p{Thai}/u' , '' , $content );
			$content = str_replace(["\n\n","\n"],"<br>",$content);
			$content = str_replace("<br><br>","<br>",$content);
			$content = trim($content);
			
			
			if(substr($content,-4) == '<br>')
				$content = substr($content,0,-4);
			if($content == '' || !mb_strlen($content))
				$this->json(['error'=>false,'info'=>'请输入提交内容']);
			
			$Post = M('Post');
			if(!$Post->is_pid($pid))
				$this->json(['error'=>false,'info'=>'该帖子已被删除，无法评论！']);
			

			$post_data = $Post->get_row($pid,['tid','uid','content']);
			$tid = $post_data['tid'];

			$this->title = mb_substr(trim(strip_tags($post_data['content'])), 0,50);

			if(!$tid)
				$this->json(['error'=>false,'info'=>'无法找到原主题数据，无法评论！']);
			
			$this->pid = $pid;

			
			//@用户
			$this->ante_type = 'post_post';
			if(L("Usergroup")->read(NOW_GID,'mess',$this->_usergroup))
				$content = $this->ante($content);
			
			$Thread = M('Thread');
			$Post_post = S('Post_post');
			$Post_post->insert([
				'pid'=>$pid,
				'tid'=>$tid,
				'uid'=>NOW_UID,
				'content'=>$content,
				'atime'=>NOW_TIME,
			]);
			
			$Post->update(['posts[+]'=>1],['pid'=>$pid]);
			M('User')->update(['post_ps[+]'=>1],['uid'=>NOW_UID]);
			$data = [
				'avatar'=>$this->avatar(NOW_UID),
				'user'=>NOW_USER,
				'uid'=>NOW_UID,
				'content'=>$content
			];
			
			if(NOW_UID != $post_data['uid']){
				M("Chat")->sys_send(
					$post_data['uid'],
					'<a href="'. HYBBS_URLA('my',NOW_USER) .'" target="_blank">['.NOW_USER.']</a> 评论了你的回复 <a href="'. HYBBS_URLA('thread','post',$pid).'" target="_blank">['.mb_substr(strip_tags($post_data['content']),0,25).']</a>'
				);
			}
			
			$this->json(['error'=>true,'info'=>'发表成功！','data'=>$data]);
		}
	}

	//@事件
	private function ante($content){
		
		return preg_replace_callback('/@([^:|： @<&])+/',array($this, 'ante_callback'),$content);
	}
	private function ante_callback($tagStr){
		
		if(is_array($tagStr)) $tagStr = $tagStr[0];

		$tagStr = stripslashes($tagStr);
		$user = substr($tagStr,1);
		$User = M("User");
		$Chat = M("Chat");
		static $tmp_user=array(); //@发送一次
		if($user != NOW_USER){ //不能发送给自己
			if(!isset($tmp_user[$user])){ //本帖未@过该用户名
				if($User->is_user($user)/* && isset($tmp_user[$user])*/){ //判断用户是否存在
					$tmp_user[$user]=true;
					if($this->ante_type == 'thread')
						$Chat->sys_send($User->user_to_uid($user),'<a href="'. HYBBS_URLA('my',NOW_USER).'" target="_blank">['.NOW_USER.']</a> 在发表主题 <a href="'. HYBBS_URLA('thread',$this->tid).'" target="_blank">['.$this->title.']</a> 的时候@了你');
					elseif($this->ante_type == 'post')
						$Chat->sys_send($User->user_to_uid($user),'<a href="'. HYBBS_URLA('my',NOW_USER).'" target="_blank">['.NOW_USER.']</a> 在评论 <a href="'. HYBBS_URLA('thread','post',$this->pid).'" target="_blank">['.$this->title.']</a> 的时候@了你');
					elseif($this->ante_type == 'post_post')
						$Chat->sys_send($User->user_to_uid($user),'<a href="'. HYBBS_URLA('my',NOW_USER).'" target="_blank">['.NOW_USER.']</a> 回复评论 <a href="'. HYBBS_URLA('thread','post',$this->pid).'" target="_blank">['.$this->title.']</a> 的时候@了你');
					
				}
			}
			return '<span class="label label-primary">'.$tagStr.'</span>';
		}
		return $tagStr;
	}
	//附件上传
	public function uploadfile(){
		
		//检测当前用户组是否有权限上传
		$UsergroupLib = L("Usergroup");
		if(!$UsergroupLib->read(NOW_GID,'uploadfile',$this->_usergroup))
			$this->json(array('error'=>false,'info'=>'你没有权限上传附件'));
		if($this->_user['file_size'] >= $this->_usergroup[NOW_GID]['space_size'])
			return $this->json(array("success"=>false,'msg'=>"你已经没有空间上传文件了!需要提升用户组哦!","file_path"=>''));

		
		$upload = new \Lib\Upload();
        $upload->maxSize   =     ($this->conf['uploadfilemax']*1024)*1024 ;// 设置附件上传大小  3M
        $upload->exts      =     explode(",",$this->conf['uploadfileext']);// 设置附件上传类型
        $upload->rootPath  =      INDEX_PATH. "upload/userfile/".NOW_UID."/"; // 设置附件上传根目录
        $upload->replace    =   true;
        $upload->autoSub    =   false;
        $upload->saveName   =   md5(NOW_USER . NOW_TIME.mt_rand(1,9999));
        
        if(!is_dir(INDEX_PATH. "upload"))
			mkdir(INDEX_PATH. "upload");
		if(!is_dir(INDEX_PATH. "upload/userfile"))
			mkdir(INDEX_PATH. "upload/userfile");
        if(!is_dir($upload->rootPath)){
        	mkdir($upload->rootPath);
        }

        $info   =   $upload->upload();
        
        //$id = 0;
        if($info) {
        	$File = S('File');
        	$File->insert(array(
        		'uid'		=>	NOW_UID,
        		'filename'	=>	isset($info['photo'])?$info['photo']['name']:'未命名.'.$info['photo']['ext'],
        		'md5name'	=>	$upload->saveName.'.'.$info['photo']['ext'],
        		'filesize'	=>	$info['photo']['size'],
        		'atime'		=>	NOW_TIME
        	));
        	$id = $File->id();
        	$file_size = $info['photo']['size'] / 1024; //得到kb单位
			if($file_size < 1 && $file_size > 0) //如果值为 0.x 则算作 1kb
				$file_size = 1;
			M("User")->update_int(NOW_UID,'file_size','+',$file_size);

        	
        	$this->json(array('error'=>true,'info'=>"上传成功",'id'=>$id,'name'=>$info['photo']['name']));
        }
        
        $this->json(array('error'=>false,"info"=>$upload->getError()));
        
	}
	//图片上传
	public function upload(){
		
		$UsergroupLib = L("Usergroup");
		if(!$UsergroupLib->read(NOW_GID,'upload',$this->_usergroup))
			return $this->json(array("success"=>false,'msg'=>"用户组禁止上传图片!",'state'=>"用户组禁止上传图片!","file_path"=>''));

		if($this->_user['file_size'] >= $this->_usergroup[NOW_GID]['space_size'])
			return $this->json(array("success"=>false,'msg'=>"你已经没有空间上传文件了!需要提升用户组哦!",'state'=>"你已经没有空间上传文件了!需要提升用户组哦!","file_path"=>''));

		
		$upload = new \Lib\Upload();// 实例化上传类
        $upload->maxSize   =     ($this->conf['uploadimagemax']*1024)*1024 ;// 设置附件上传大小  3M

        $upload->exts      =     explode(",",$this->conf['uploadimageext']);// 设置图片上传类型
        $upload->rootPath  =      INDEX_PATH. "upload/userfile/".NOW_UID."/"; // 设置图片上传根目录

        $upload->replace    =   true;
        $upload->autoSub    =   false;
        $upload->saveName   =   md5(NOW_USER . NOW_TIME.mt_rand(1,9999)); //保存文件名

        
		if(!is_dir(INDEX_PATH. "upload"))
			mkdir(INDEX_PATH. "upload");
		if(!is_dir(INDEX_PATH. "upload/userfile"))
			mkdir(INDEX_PATH. "upload/userfile");
        if(!is_dir($upload->rootPath)){
        	mkdir($upload->rootPath);
        }
		
		$info   =   $upload->upload();
		
		
		$d=array("success"=>true,'msg'=>"上传成功!","file_path"=>'');
		if(!$info) {
			$d['success']	= false;
        	$d['msg']		= $upload->getError();

		}else{ //上传成功
			
			$d['file_path'] = WWW . "upload/userfile/".NOW_UID."/".$info['photo']['savename'];
			$file_size = $info['photo']['size'] / 1024; //得到kb单位
			if($file_size < 1 && $file_size > 0) //如果值为 0.x 则算作 1kb
				$file_size = 1;
			M("User")->update_int(NOW_UID,'file_size','+',$file_size);

		}
		
		if(X("post.geturl") == '1')
			die($d['file_path']);
		$this->json($d);

	}
	//编辑帖子
	public function edit(){
		
		$this->v('title','编辑帖子内容');
		if(IS_POST){
			
			$id = intval(X("post.id"));
			$content = X('post.content');
			if (get_magic_quotes_gpc())
  				$content = stripslashes($content);
			
			if(NOW_GID != C("ADMIN_GROUP")){
				$Kses =L("Kses");
        		$content = $Kses->Parse($content);
			}

			//$content = preg_replace('/(<img.*?)((width)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);
			$content = preg_replace('/(<img.*?)((height)=[\'"]+[0-9]+[\'"]+)/is','$1', $content);

			$content = preg_replace( '/\p{Thai}/u' , '' , $content );
			$tmp = strip_tags($content,'<img><iframe><embed><video>');
			if(empty($tmp))
				return $this->json(array('error'=>false,'info'=>'内容不能为空'));
			
			$Post = S("Post");
			$post_data = $Post->find("*",array(
				'pid'=>$id
			));
			if(empty($post_data))
				return $this->json(array('error'=>false,'info'=>'评论不存在'));
        	
			
			//评论数据不存在 或者 评论不属于当前登陆者 或者 登陆者不是管理员
			if(
				
				$post_data['uid'] != NOW_UID && //编辑者不属于帖子作者
				NOW_GID != C("ADMIN_GROUP") &&  //不属于管理员
				!is_forumg($this->_forum,NOW_UID,$post_data['fid']) //不是版主
			)
				return $this->json(array('error'=>false,'info'=>'太坏了,你居然想修改别人帖子'));

			$isthread = $post_data['isthread'];
			


			//修改主题 评论是主题内容
			if($isthread){
				

				$fid = intval(X("post.fid"));
				$title = trim(X("post.title"));
				$title = htmlspecialchars($title);
				$title = preg_replace( '/\p{Thai}/u' , '' , $title );
				if(mb_strlen($title) < $this->conf['titlemin'])
					return $this->json(array('error'=>false,'info'=>'标题长度不能小于'.$this->conf['titlemin'].'个字符'));
				if(mb_strlen($title) > $this->conf['titlesize'])
					return $this->json(array('error'=>false,'info'=>'标题长度不能大于'.$this->conf['titlesize'].'个字符'));
				
				if($fid < 0 ){
					return $this->json(array('error'=>false,'info'=>'请选择一个分类,板块'));
				}
				
	            if(!isset($this->_forum[$fid])){
					if(empty($this->_forum[$fid]['id']))
						return $this->json(array('error'=>false,'info'=>'不存在该分类'));
				}
				if(!L("Forum")->is_comp($fid,NOW_GID,'thread',$this->_forum[$fid]['json']))
					return $this->json(array('error'=>false,'info'=>'你没有权限在该板块发表帖子'));

				$tgold = intval(X("post.tgold"));
            	$thide = intval(X("post.thide"));
            	$UsergroupLib = L("Usergroup");
            	$User = M('User');
            	if(!$UsergroupLib->read(NOW_GID,'thide',$this->_usergroup)){
	            	$thide = 0;
	            }
	            if(!$UsergroupLib->read(NOW_GID,'tgold',$this->_usergroup)){
	            	$tgold = 0;
	            }
	            

	            //获取所有图片地址
				$pattern="/\<img.*?src\=\"(.*?)\"[^>]*>/i";
				preg_match_all($pattern,$content,$match);
				$img = '';
				$sz=0;
				if(isset($match[1][0])){
					foreach ($match[1] as $v) {
						if(substr_count($v,'data:image/')  || substr_count($v,';base64') || strpos($v,'/emoji/') !== FALSE || empty($v))
							continue;
						if($sz++<$this->conf['post_image_size']){
							$img.=$v;
							$img.=",";
						}
					}
				}

				

            	//编辑主题数据
				$Thread = S("Thread");
				$Thread->update(array(
					'fid'=>$fid,
					'title'=>$title,
					'hide'		=>	$thide?1:0,
					'summary'=>mb_substr(trim(strip_tags($content)), 0,$this->conf['summary_size']),
					'gold'		=>	$tgold,
					'img'	=>	$img,
					'img_count'	=>	$sz,
					'etime'=>NOW_TIME
					),[
					'tid'=>$post_data['tid']
				]);
				$this->CacheObj->rm('thread_data_'.$post_data['tid']);
            	$this->CacheObj->rm('post_data_'.$post_data['pid']);
				

				//判断是否有上传附件权限
				if($UsergroupLib->read(NOW_GID,'uploadfile',$this->_usergroup)){
					
					//echo 'xxxxxxxxxxxxx';
					//编辑附件
		            $fileid 	= X("post.fileid");
		            $filegold 	= X("post.filegold");
		            $filemess 	= X("post.filemess");
		            $filehide 	= X("post.filehide");
		            
		            $File = M("File");
		            $Fileinfo = S("Fileinfo");
		            $Filegold = S('Filegold');
		            if(!empty($fileid)){
		            	

		            	$fileid_arr 	= explode("||",$fileid);
		            	$filegold_arr 	= explode("||",$filegold);
		            	$filemess_arr 	= explode("||",$filemess);
		            	$filehide_arr 	= explode("||",$filehide);

		            	if(count($fileid_arr)){
		            		

		            		$FileinfoList = $Fileinfo->select('*',['tid'=>$post_data['tid']]);
		            		if(empty($FileinfoList)) $FileinfoList=[];
		            		
		            		$tmp_arr=[];
		            		foreach($FileinfoList as $key => $v){
		            			$tmp_arr[$v['fileid']]=[
		            				'tid'	=>	$v['tid'],
		            				'uid'	=>	$v['uid'],
		            				'gold'	=>	$v['gold'],
		            				'hide'	=>	$v['hide'],
		            				'downs'	=>	$v['downs'],
		            				'mess'	=>	$v['mess'],
		            				//是否被删除
		            				'is_del'	=> true
		            			];
		            		}


		            		
	            			foreach ($fileid_arr as $key => $fileid_v) {
		            			$fileid_v=intval($fileid_v);
		            			if(empty($fileid_v)) continue;
		            			//判断文件是否属于文章作者
		            			if($File->is_comp($fileid_v,$post_data['uid']) || NOW_GID == C('ADMIN_GROUP') || is_forumg($this->_forum,NOW_UID,$post_data['fid'])){
		            				$tmp_arr[$fileid_v]=[
		            					'tid'	=>	$post_data['tid'],
		            					'uid'	=>	$post_data['uid'],
		            					'gold'	=>	isset($filegold_arr[$key]) ? intval($filegold_arr[$key]) : 0,
		            					'hide'	=>	isset($filehide_arr[$key]) ? intval($filehide_arr[$key]) : 0,
		            					'downs'	=>	isset($tmp_arr[$fileid_v]) ? $tmp_arr[$fileid_v]['downs'] : 0,
		            					'mess'	=>	isset($filemess_arr[$key]) ?  htmlspecialchars(strip_tags($filemess_arr[$key])) : '',
		            					//是否被删除
		            					'is_del'	=>	false
		            				];
		            				
		            			}

		            		}
		            		$i = 0;
		            		
		            		foreach($tmp_arr as $key => $v){
		            			if($v['is_del']){//删除附件
		            				$Fileinfo->delete(['fileid'=>$key]);
		            				$Filegold->delete(['fileid'=>$key]);
		            				$FileData = $File->read($key,['uid','md5name','filesize']);
		            				if(!empty($FileData)){
		            					//删除数据记录
		            					$File->delete(['id'=>$key]);

		            					//更新用户上传字节
		            					$User->update([
		            						'file_size[-]'=>$FileData['filesize']
		            					],[
		            						'uid'=>$FileData['uid']
		            					]);

		            					//文件路劲
		            					$FilePath = INDEX_PATH . 'upload/userfile/' . $FileData['uid'] . '/' . $FileData['md5name'];
		            					if(is_file($FilePath)){
		            						unlink($FilePath);
		            					}

		            				}
		            			}else{
		            				$i++;
		            				if($Fileinfo->has(['fileid'=>$key])){ //存在旧附件
		            					$Fileinfo->update([
		            						'tid'		=>	$v['tid'],
		            						'gold'		=>	$v['gold'],
		            						'hide'		=>	$v['hide'],
		            						'downs'		=>	$v['downs'],
		            						'mess'		=>	$v['mess']
		            					],[
		            						'fileid'	=>	$key
		            					]);
		            				}else{
		            					$Fileinfo->insert([
		            						'fileid'	=>	$key,
		            						'tid'		=>	$v['tid'],
		            						'uid'		=>	$v['uid'],
		            						'gold'		=>	$v['gold'],
		            						'hide'		=>	$v['hide'],
		            						'downs'		=>	$v['downs'],
		            						'mess'		=>	$v['mess']
		            					]);
		            				}
		            			}
		            		}
		            		


		            		
		            		
		            		$Thread->update(['files'=>$i],['tid'=>$post_data['tid']]); //更新主题附件数量
		            	}
		            }else{ //清空附件
		            	$FileinfoList = $Fileinfo->select('*',['tid'=>$post_data['tid']]);
		            	if(empty($FileinfoList)) $FileinfoList=[];

		            	foreach($FileinfoList as $v){
		            		$Fileinfo->delete(['fileid'=>$v['fileid']]);
		            		$Filegold->delete(['fileid'=>$v['fileid']]);
            				$FileData = $File->read($v['fileid'],['uid','md5name','filesize']);
            				if(!empty($FileData)){
            					//删除数据记录
            					$File->delete(['id'=>$v['fileid']]);

            					//更新用户上传字节
            					$User->update([
            						'file_size[-]'=>$FileData['filesize']
            					],[
            						'uid'=>$FileData['uid']
            					]);

            					//文件路劲
            					$FilePath = INDEX_PATH . 'upload/userfile/' . $FileData['uid'] . '/' . $FileData['md5name'];
            					if(is_file($FilePath)){
            						unlink($FilePath);
            					}

            				}
		            	}

	            		
	            		$Thread->update(['files'=>0],['tid'=>$post_data['tid']]); //更新主题附件数量

	            	}
				}//结束附件信息

			}//修改主题结束
			else{ //编辑帖子不是主题
				$thread_data_posts = S("Thread")->find('posts',['tid'=>$post_data['tid']]);


				$count = intval(($thread_data_posts /  $this->conf['postlist']) + 1)+1;
		        for ($i=0; $i < $count; $i++) {
		            $this->CacheObj->rm("post_list_{$post_data['tid']}_DESC_{$i}");
		            $this->CacheObj->rm("post_list_{$post_data['tid']}_ASC_{$i}");
		        }
		        $this->CacheObj->rm('post_data_'.$post_data['pid']);
			}
			
			//修改评论内容
			$Post->update([
				'content'=>$content,
				'etime'=>NOW_TIME
			],[
				'pid'=>$id
			]);


			return $this->json(array('error'=>true,'info'=>'修改成功'));
		} //End Post
		

		//编辑器帖子
		$id = intval(X("get.id"));
		$Post = M("Post");

		$data = $Post->read($id);

		
		if(empty($data))
			return $this->message('评论不存在');
		//不是帖子作者 并且 不是管理员 并且不是版主
		if(
			NOW_UID != $data['uid'] && 
			NOW_GID != C("ADMIN_GROUP") && 
			!is_forumg($this->_forum,NOW_UID,$data['fid'])
		)
			return $this->message('太坏了,你居然想修改别人帖子 E= 2');
		
		//获取帖子数据
		

		//属于主题帖子
		if($data['isthread']){
			
			$thread_data = M("Thread")->read($data['tid']);
			$this->v('thread_data',$thread_data);


			$Fileinfo = S("Fileinfo");
	
			$file_list = $Fileinfo->select("*",array(
				'tid'=>$data['tid'],
				'ORDER' => ['fileid' => 'DESC'],
			));
			
			if(!empty($file_list)){
				$File = M("File");
				foreach ($file_list as &$v) {
					$v['filename']=$File->get_name($v['fileid']);
				}
				

			}
			$this->v("file_list",$file_list);
		}
		
		
		

		
		
		
		$this->v('id',$id);
		$this->v("data",$data);
        $this->display("edit_post");

	}
	//投票
	public function vote(){
		
		if(!IS_LOGIN)
			return $this->json(["error"=>false,"info"=>"你需要登录才可投票"]);
		$id=intval(X("post.id")); // 提交ID
		$type = X("post.type"); //类型
		if(!in_array($type,['thread1','thread2','post1','post2']))
            return $this->json(["error"=>false,"info"=>"投票类型不符"]);
		$type1=substr($type,0,-1);

		if($type1 == 'thread'){
			$Thread = S("Thread");
			if(!$Thread->has(['tid'=>$id]))
				return $this->json(["error"=>false,"info"=>"不存在该主题"]);
			$obj = S("Vote_thread");
			if(!$obj->has([
				'AND'=>[
					'uid'=>NOW_UID,
					'tid'=>$id
					]
				]
			)){
				if($type == 'thread1')
					$Thread->update(['goods[+]'=>1],['tid'=>$id]);
				else
					$Thread->update(['nos[+]'=>1],['tid'=>$id]);
				$obj->insert(array(
					'uid'	=>	NOW_UID,
					'tid'	=>	$id,
					'atime'	=>	NOW_TIME,
				));
				$this->CacheObj->rm('thread_data_'.$id);

				return $this->json(["error"=>true,"info"=>"投票成功"]);
				

			}
			return $this->json(["error"=>false,"info"=>"你投过了"]);
			
		}elseif($type1 == 'post'){
			$Post = S("Post");
			if(!$Post->has(['pid'=>$id]))
				return $this->json(["error"=>false,"info"=>"不存在该评论"]);

			$obj = S("Vote_post");
			if(!$obj->has([
				'AND'=>[
					'uid'=>NOW_UID,
					'pid'=>$id
					]
				]
			)){
				if($type == 'post1')
					$Post->update(['goods[+]'=>1],['pid'=>$id]);
				else
					$Post->update(['nos[+]'=>1],['pid'=>$id]);
				$obj->insert([
					'uid'	=>	NOW_UID,
					'pid'	=>	$id,
					'atime'	=>	NOW_TIME,
				]);
				return $this->json(["error"=>true,"info"=>"投票成功"]);
			}
			return $this->json(["error"=>false,"info"=>"你投过了"]);
			
		}

	}
	
	//删除评论， 不是 删除主题！
	public function del(){
		
		if(!IS_LOGIN)
            $this->json(array('error'=>false,'info'=>'请登录'));

		//用户组权限判断
		$UsergroupLib = L("Usergroup");
		if(!$UsergroupLib->read(NOW_GID,'del',$this->_usergroup))
			return $this->json(array('error'=>false,'info'=>'你当前所在用户组无法删除评论'));
		
		$pid = intval(X("post.id"));
        $Post = M("Post");

		//获取 评论数据
        $post_data = $Post->read($pid);
        if(empty($post_data))
            return $this->json(array('error'=>false,'info'=>'不存在此评论'));
        
		//获取 评论的板块ID
		$fid = $post_data['fid'];

		
        //用户组不是 管理员 &&  用户不是文章作者
        if(
			(NOW_GID != C("ADMIN_GROUP")) &&
			(NOW_UID != $post_data['uid']) &&
			//array_search(NOW_UID,$arr) === false
			!is_forumg($this->_forum,NOW_UID,$fid)
		)
            return $this->json(array('error'=>false,'info'=>'你没有权限操作这个评论'));

        //删除该ID评论
        $Post->del($pid);
        //主题评论数-1
		$Thread = M('Thread');
		$Thread->update_int($post_data['tid'],'posts','-');
		//帖子作者-1
		M("User")->update_int($post_data['uid'],'posts','-');
		//更新缓存
		$this->_forum[$fid]['posts']--;
		$this->CacheObj->forum = $this->_forum;
		$this->_count['post']--;
		$this->CacheObj->bbs_count = $this->_count;

		
        M("Chat")->sys_send(
            $post_data['uid'],
            '你的评论被删除 所在主题<a href="'.HYBBS_URLA('thread',$post_data['tid']).'" target="_blank">['.M('Thread')->get_title($post_data['tid']).']</a> 操作者:'.NOW_USER
        );
        $tid = $post_data['tid'];
        $count = intval(($Thread->get_row($tid,'posts') /  $this->conf['postlist']) + 1)+1;
        for ($i=0; $i < $count; $i++) {
            $this->CacheObj->rm("post_list_{$tid}_DESC_{$i}");
            $this->CacheObj->rm("post_list_{$tid}_ASC_{$i}");
        }
        $this->CacheObj->rm("post_data_".$post_data['pid']);

		
        return $this->json(array('error'=>true,'info'=>'删除成功'));
	}
	

}
