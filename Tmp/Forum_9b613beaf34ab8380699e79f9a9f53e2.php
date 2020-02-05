<?php
namespace Model;
use HY\Model;
!defined('HY_PATH') && exit('HY_PATH not defined.');
class Forum extends Model {
    public function get_row($id,$name = '*'){
        return $this->find($name,['id'=>$id]);
    }
    //修改整数数据
    //分类ID
    //更新字段
    //+ - 
    //数量
    public function update_int($id,$key='threads',$type="+",$size=1){
        
        $key .= ($type=='+') ? '[+]' : '[-]';
        $this->update(array(
            $key=>$size
        ),array(
            'id'=>$id
        ));
        
    }
    //判断用户组板块权限
    //$id = 分类ID
    //$group = 用户组ID
    //判断权限类型 vforum vthread trehad post  downfile
    public function is_comp($id,$group,$type){
        
        $json = json_decode(
            $this->find("json",array(
                "id"=>$id
            ))
        ,true);
        
        //echo $json[$type];
        $str = isset($json[$type]) ? $json[$type] : false ;
        $arr = explode(",",$str);
        
        foreach ($arr as $v) {
            
            if($v == $group)
                return false;
        }
        
        return true;
    }
    //获取分类数据
    //分类ID
    public function read($id){
        
        return $this->get_row($id);
    }
    //获取全部分类数组
    public function read_all(){
        
        //去除分类所有数据
        $forum = $this->select("*",['ORDER'=>['id'=>'ASC']]);
        if(empty($forum)) 
            $forum=array();
        
        $tmp = array();
        //进行ID序列化
        foreach ($forum as $k => $v) {
            
            $tmp[intval($v['id'])] = $v;
        }

        
        return $tmp;
    }

    //子分类排序
    public function format(&$forum){
        
        $tmp_forum = $forum;
        foreach ($forum as $key => &$v) {
            $v['z']=false;
            
            if($v['fid']!= -1){
                
                foreach ($tmp_forum as &$vv) {
                    
                    if($v['fid'] == $vv['id']){
                        
                        $forum[$v['fid']][$v['id']] = $v;
                        $forum[$v['fid']]['z'] = true;
                        //$vv[] = $v;
                        //echo $v['id'];
                        //unset($forum[$v['id']]);
                    }
                }

            }
        }
        
        
    }

    
}
