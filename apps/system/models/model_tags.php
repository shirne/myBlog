<?php
/**
 * 标签模型
 */
class Model_Tags extends MB_Model
{
	function __construct(){
		parent::__construct('tags');
	}
	
	#@Override
	function getAllPage($page=0,$where=NULL,$order=NULL){
		$this->pagecurrent=abs((int)$page);
		if(!empty($where)){
		    $this->db->where($where);
		}
		$this->recordcount=$this->db->count_all_results($this->tbl.'_count');
		
		if($this->pagecurrent>$this->recordcount){
			$this->pagecurrent=$this->recordcount - ($this->recordcount % $this->pagesize);
		}
		
		if(!empty($order)){
			$this->db->order($order);
		}
		
		return $this->afterGetAll($this->db
		    ->limit($this->pagesize,$this->pagecurrent)
		    ->get($this->tbl.'_count'));
	}
}