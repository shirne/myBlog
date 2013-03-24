<?php
/*草稿箱*/
//覆写MB_Model的删除方法,保证删除对应表名及用户ID的数据 @see MB_Model

class Model_Craft extends MB_Model
{
	private $table='article';
	private $uid = 0;
	private $maxnum=20; //草稿箱上限
	
	function __construct()
	{
		parent::__construct('craft');
		
		$CI=& get_instance();
		$this->uid=(int)$CI->user->id;
	}
	
	//返回草稿数目
	function countAll(){
	    $where=array(
	        'table'=>$this->table,
	        'userid'=>$this->uid
	    );
	    $count=$this->getCount($where);
	    //删除超过数目的草稿
	    if($count>$this->maxnum){
	        $delids=$this->getAll($where,'created DESC',$this->maxnum,$count-$this->maxnum);
	        foreach($delids->result_array() as $row){
	            $ids[]=$row['id'];
	        }
	        $this->batchdel($ids);
	    }
	    
	    //草稿数目超过80%提示信息    
	    if($count>$this->maxnum * .8){
	        $CI=& get_instance();
	        $CI->addTips('您的草稿箱最多可使用 '.$this->maxnum.' 条,目前已使用 '.$count.' 条,已经'.($count==$this->maxnum?'':'快要').'达到上限,请尽快处理');
	    }
	    
	    return $count.'/'.$this->maxnum;
	}
	
	//根据用户ID列出草稿
	function listAll(){
	    $where=array(
	        'table'=>$this->table,
	        'userid'=>$this->uid
	    );
	    return $this->getAll($where,'created DESC');
	}
	
	//返回单条记录
	function get($id){
	    $where=array(
	        'table'=>$this->table,
	        'userid'=>$this->uid,
	        'id'=>(int)$id
	    );
	    return $this->getOne($where);
	}
	
	//根据条件删除,如果条件为整型数，则判定为id
	//@Override
	function del($where){
		if(is_int($where)){
			$where=array(
				'id'=>$where,
				'table'=>$this->table,
				'userid'=>$this->uid
			);
		}
		$this->db->delete($this->tbl,$where);
		return $this->afterDelete($this->db->affected_rows());
	}
	
	//根据ID批量删除
	//@Override
	function batchdel($ids){
		if(!is_array($ids)){
			$ids=array($ids);
		}
		//过滤字段
		foreach($ids as $k=>$id){
		    $ids[$k]=(int)$id;
		}
		$where=array(
			'table'=>$this->table,
			'userid'=>$this->uid
		);
		$this->db->where($where)->where_in('id',$ids)->delete($this->tbl);
		return $this->afterDelete($this->db->affected_rows());
	}
	
	function afterGetOne($row){
	    if(!empty($row['content'])){
	        $row['content']=unserialize($row['content']);
	        $row['content']['craft_id']=$row['id'];
	    }
	    return $row;
	}
	
	//草稿内容设定
	function beforeUpdate(& $row){
		//标题为空，则根据内容设定，内容也为空，设定为无标题
	    $title=empty($row['title'])?
	    (empty($row['content'])?
	    '无标题'
	    :substr(preg_replace('/<[^>]+>/','',$row['content'].''),0,20))
	    :$row['title'];
	    $data=array(
	        'table'=>$this->table,
	        'title'=>empty($title)?'无标题':$title,
	        'userid'=>$this->uid,
	        'content'=>serialize($row)
	    );
	    $time=time();
	    $data['saved']=$time;
	    if(!empty($row['craft_id'])){
	        $data['id']=(int)$row['craft_id'];
	    }else{
	        $data['created']=$time;
	    }
	    
	    return $data;
	}
}
