<?php
namespace Model;
use HY\Model;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class Chat_count extends Model{
	public function update_int($uid,$type="+",$size=1){
		
		if($this->has(array('uid'=>$uid))){
			
			if($type==="+")
				$this->update(array("c[{$type}]"=>$size,'atime'=>NOW_TIME),array('uid'=>$uid));
			else
				$this->update(array("c[{$type}]"=>$size),array('uid'=>$uid));
			$this->get_c($uid);
		}
		
		$this->insert(array('uid'=>$uid,'c'=>1,'atime'=>NOW_TIME));
		
	}
	//获取未读消息数量
	public function get_c($uid){
		
		$c = $this->find('c',['uid'=>$uid]);
		if($c < 0)
			$this->clear_c($uid);
		
		return ($c < 0 )?0:$c;
	}
	public function clear_c($uid){
		$this->update(['c'=>0],['uid'=>$uid]);
	}
	public function get_time($uid){
		
		$atime = $this->find('atime',array('uid'=>$uid));
		
		return (!$atime)?0:$atime;
	}
	
}