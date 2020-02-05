<?php
namespace Action;
use HY\Action;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class Friend extends HYBBS {
    //设置状态
	public function friend_state(){
        
        if(!IS_LOGIN)
            $this->json(['error'=>false,'info'=>'请登录后操作!']);
        
        $uid = intval(X("post.uid"));
        if(NOW_UID == $uid){
            $this->json(['error'=>false,'info'=>'无法添加自己!']);
        }
        
        $User = M("User");
        if(!$User->is_uid($uid))
            $this->json(['error'=>false,'info'=>'你玩的挺嗨的!']);
        $Friend = M("Friend");
        
        $state = $Friend->get_state(NOW_UID,$uid);

        //陌生人
        
        if($state == 0){ //添加好友
            
            $Friend->add_friend(NOW_UID,$uid);
     
            
            //更新关注数量
            
            $count1 = $Friend->count(['AND'=>['uid1'=>NOW_UID,'OR'=>['state'=>[1,2]]]]);
            $count2 = $Friend->count(['AND'=>['uid2'=>$uid,   'OR'=>['state'=>[1,2]]]]);
            
            
            $User->update(['follow'=>$count1],['uid'=>NOW_UID]);
            $User->update(['fans'  =>$count2],['uid'=>$uid]);

            $this->json(['error'=>true,'info'=>'添加成功!','id'=>1]);
        }
        elseif($state == 1 || $state == 2){ //删除好友
            
            $Friend->rm_friend(NOW_UID,$uid);
        
            $count1 = $Friend->count(['AND'=>['uid1'=>NOW_UID,'OR'=>['state'=>[1,2]]]]);
            $count2 = $Friend->count(['AND'=>['uid2'=>$uid,   'OR'=>['state'=>[1,2]]]]);
            

            $User->update(['follow'=>$count1],['uid'=>NOW_UID]);
            $User->update(['fans'  =>$count2],['uid'=>$uid]);
            

            $this->json(['error'=>true,'info'=>'删除成功!','id'=>0]);
        }
        $this->json(['error'=>false,'info'=>'没有返回值!']);
        

    }
    //发送聊天信息
    public function send_chat(){
        
        if(!IS_LOGIN)
            $this->json(['error'=>false,'info'=>'你需要重新登录!']);
        
        if(IS_POST){
            if($this->_user['chat_size'] >= $this->_usergroup[NOW_GID]['chat_size'])
                $this->json(["error"=>false,'info'=>"你已经没有聊天记录储存空间,需要提升用户组或者到个人中心清空你的聊天记录!"]);
            
            //发送给ID
            $uid = intval(X("post.uid"));
            $content = htmlspecialchars(X("post.content"));
            $content = str_replace('&nbsp;','',$content);
            $content = trim($content);
            if(empty($content))
                $this->json(['error'=>false,'info'=>'内容不能为空!']);

            
            //不能发送给自己
            if($uid == NOW_UID)
                $this->json(['error'=>false,'info'=>'你玩的挺嗨的!']);
            $User = M("User");
            
            if(!$User->is_uid($uid))
                $this->json(['error'=>false,'info'=>'该用户不存在!']);
            
            M("Chat")->send($uid,NOW_UID,$content);
            M("User")->update_int(NOW_UID,'chat_size','+',strlen($content));
            $this->json(['error'=>true,'info'=>'发送成功！']);
        }
        
    }
    //朋友列表
    public function friend_list(){
        
        if(!IS_LOGIN)
            return $this->json(['error'=>false,'info'=>'你需要重新登录!']);
        
        if(IS_POST){
            
            $Friend = S("Friend");
            //获取我关注的
            $list = $Friend->select('*',['uid1'=>NOW_UID]);
            //获取我的粉丝
            $list1 = $Friend->select("*",['AND'=>['uid2'=>NOW_UID,'state'=>[1,2]]]);

            
            foreach ($list as $k=> &$v) {
                
                foreach ($list1 as &$vv) {
                    
                    if($v['state']== 0 && $v['uid1'] == $vv['uid2'] && $v['uid2'] == $vv['uid1']){
                        $vv['c'] = $v['c'];
                        unset($list[$k]);

                    }
                }
             
             
            }
            
            foreach ($list1 as &$v) {
                
                $v['state'] = 3;
                $v['uid2'] = $v['uid1'];
             
            }
            
            
            $list = array_merge($list,$list1);
            $User= M("User");
            
            $user_tmp = array();
            $Online = S("Online");
            
            foreach ($list as $key => &$v) {
                if(!isset($user_tmp[$v['uid2']]))
                    $user_tmp[$v['uid2']] = $User->uid_to_user($v['uid2']);
                
                $v['uid'] = $v['uid2'];
                $v['user'] = $user_tmp[$v['uid2']];
                $v['ps'] = $User->get_row($v['uid'],'ps');
                $v['avatar'] = $this->avatar($v['uid']);
                $v['ol']=$Online->has(['AND'=>['uid'=>$v['uid'],'atime[>]'=>NOW_TIME-BBSCONF('out_s')]]);
                unset($v['uid2']);
                unset($v['uid1']);
                if($v['uid'] <= 0)
                    unset($list[$key]);
            }
            
            $this->json($list);
        }
    }
    //获取历史聊天记录
    public function get_old_chat(){
        
        if(!IS_LOGIN)
            return $this->json(['error'=>false,'info'=>'你需要重新登录!']);
        
        if(IS_POST){
            
            $uid1 = intval(X("post.uid"));
            $uid2 = NOW_UID;
            $start_limit=X('post.start_limit',0);
            $Chat = S("Chat");
            $Friend = M("Friend");
            
            $size = $size1 = $Friend->get_c($uid2,$uid1);
            $history = false;
            //echo $size;
            if(!$size){
                $size = 10;
                $history = true; //获取历史记录
            }
            
            $data = [];
            if($size == 10){
                //echo $start_limit;
                
                $data = $Chat->select('*',
                     array(
                        "OR" => array(
                            "AND" => array(
                                "uid1" => $uid1,
                                "uid2" => $uid2
                            ),
                            "AND #" => array(
                                "uid1" => $uid2,
                                "uid2" => $uid1
                            )
                        ),
                        'LIMIT' => [$start_limit,$size],
                        'ORDER' => ['id'=>'DESC']
                    )
                );
                
            }else{
                
                $data = $Chat->select('*',
                    [
                        "AND" => [
                            "uid1" => $uid2,
                            "uid2" => $uid1
                            
                        ],
                        'LIMIT' => $size,
                        'ORDER' => ['id' => 'DESC']
                    ]
                );
                
            }
            

            //扣除未读消息       
            if(!$history){
                $Friend->update_int($uid2,$uid1,'-',$size);
                $Chat_count = M("Chat_count");
                $Chat_count->update_int(NOW_UID,'-',$size1);
            }
            
            foreach ($data as &$v) {
                
                $v['time'] = humandate($v['atime']);
                
            }
            
            $this->json($data);
        }
    }

    public function pm(){
        
        if(!IS_LOGIN)
            return $this->json(['error'=>false,'info'=>'你需要重新登录!','error_id'=>1]);
        
        if(IS_POST && IS_AJAX){
            
            $time = X("post.time");
            $Chat_count = S("Chat_count");
            $c = $Chat_count->find('*',['uid'=>NOW_UID]);
            
            //没有好友
            if(empty($c))
                return $this->json(array('error'=>false,'info'=>array(),'atime'=>$c['atime'],'ex'=>'no','error_id'=>2));
            
 
            if($time == $c['atime'] || $c['c'] == 0)
                return $this->json(array('error'=>false,'info'=>array(),'atime'=>$c['atime'],'error_id'=>3));
            $Friend = S("Friend");
            $data = $Friend->select(['uid2','c'],['AND'=>['uid1'=>NOW_UID,'c[!]'=>0]]);
            if(empty($data))
                $Chat_count->update(['c'=>0],['uid'=>NOW_UID]);
            
            $this->json(['error'=>true,'info'=>$data,'atime'=>$c['atime']]);
            //var_dump($c);
        }
    }
    public function user_info(){
        
        if(!IS_LOGIN)
            return $this->json(array('error'=>false,'info'=>'你需要重新登录!'));
        
        if(IS_POST && IS_AJAX){
            
            $uid = intval(X("post.uid"));
            $User = M("User");
            if(!$User->is_uid($uid))
                return $this->json(array('error'=>false,'info'=>'没有这个用户!'));
            
            $user = $User->uid_to_user($uid);
            $avatar = $this->avatar($uid);
            
            return $this->json(array('error'=>true,'info'=>array('user'=>$user,'avatar'=>$avatar)));;
        }
    }
    
}