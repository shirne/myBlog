<?php
/*
 * Created on 2012-5-6
 *
 * shirne@www.shirne.com
 */
class MB_Model extends CI_Model
{
	protected $tbl;
	
	//错误信息
    protected $lastError='';
	
	//分页相关
	public $pagesize=20;
	protected $recordcount=0;
	//protected $pagecount=0;
	protected $pagecurrent=0;
	
	//可获取的属性
	//注意:这些属性最好不要与系统属性冲突，否则系统属性将不可访问
	//如 $this->db
	//另外需要设定为可访问类型,如protected.(public就没有意义了)
	protected $fields=array('lastError');
	
	function __construct($tbl){
		parent::__construct();
		$this->tbl = $tbl;
	}
	
	/**
     * 获取相关参数
     */
    public function __get($key){
        if(in_array($key,$this->fields))
            return $this->$key;
        else
            return parent::__get($key);
    }
	
	//添加可访问属性
	//@see $this->fields
	protected function addAccess($f){
		if(!is_array($f)){
			$f=array($f);
		}
		
		$this->fields=array_merge($this->fields,$f);
	}
	
	//更新前过滤字段
	function beforeUpdate(& $row){
		if(!isset($row['id'])){
			$row['created']=time();
		}
		return $row;
	}
	//更新后回调
	function afterUpdate($id=0,$rownum=0){return $id;}
	
	//删除后回调
	function afterDelete($rownum=0){return $rownum;}
	
	//获取单条后处理
	function afterGetOne(&$row){
	    return $row;
	}
	
	//获取多条后处理
	function afterGetAll(&$rows){
	    return $rows;
	}
	
	/**
	 * 本程序所有表都以id为主键字段
	 * 包含id时为更新，否则为插入
	 */
	function save($row){
	    if(isset($row['id']) && empty($row['id']))unset($row['id']);
	    
		$row=$this->beforeUpdate($row);
		
		//更新记录
		if(isset($row['id'])){
			$id=$row['id'];
			unset($row['id']);
			$this->db->update($this->tbl,$row,array('id'=>$id),1);
		}
		//插入记录
		else{
			$this->db->insert($this->tbl,$row);
			$id=$this->db->insert_id();
		}
		return $this->afterUpdate($id, $this->db->affected_rows());
	}
	
	//返回数目
	function getCount($where){
	    if(is_array($where)){
	        $this->db->where($where);
	    }
	    return $this->db->count_all_results($this->tbl);
	}
	
	//根据条件获取一条记录,返回数组
	function getOne($where){
		//如果条件是数字，则判定为根据主键获取
		if(is_int($where)){
			$where=array(
				'id'=>$where
			);
		}
		
		return $this->afterGetOne($this->db->get_where($this->tbl,$where,1)->row_array());
	}
	
	//根据条件获取所有记录
	function getAll($where,$order=NULL,$limit=NULL,$offset=NULL){
		if(! empty($order))$this->db->order_by($order);
		return $this->afterGetAll($this->db
		    ->get_where($this->tbl,$where,$limit,$offset));
	}
	
	//自动从$_GET中获取页码，返回分页好的记录集
	function getAllPage($page=0,$where=NULL,$order=NULL){
		$this->pagecurrent=abs((int)$page);
		if(!empty($where)){
		    $this->db->where($where);
		}
		$this->recordcount=$this->db->count_all_results($this->tbl);
		
		if($this->pagecurrent>$this->recordcount){
			$this->pagecurrent=$this->recordcount - ($this->recordcount % $this->pagesize);
		}
		
		if(!empty($order)){
			$this->db->order($order);
		}
		
		return $this->afterGetAll($this->db
		    ->limit($this->pagesize,$this->pagecurrent)
		    ->get($this->tbl));
	}
	
	//分页显示
	function showPage($url,$num=5){
		$CI=& get_instance();
		$CI->load->library('pagination');
		$CI->pagination->initialize(array(
		    'base_url'=>$url,
		    'total_rows'=>$this->recordcount,
		    'per_page'=>$this->pagesize
		));
		
		return $CI->pagination->create_links();
	}
	
	//根据条件删除,如果条件为整型数，则判定为id
	function del($where){
		if(is_int($where)){
			$where=array(
				'id'=>$where
			);
		}
		$this->db->delete($this->tbl,$where);
		return $this->afterDelete($this->db->affected_rows());
	}
	
	//根据ID批量删除
	function batchdel($ids){
		if(!is_array($ids)){
			$ids=array($ids);
		}
		//过滤字段
		foreach($ids as $k=>$id){
		    $ids[$k]=(int)$id;
		}
		$this->db->where_in('id',$ids)->delete($this->tbl);
		return $this->afterDelete($this->db->affected_rows());
	}
	
	//根据ID批量处理状态,返回处理成功的条数
	function batchstate($state,$ids,$field='state'){
	    //转换状态
	    $sta=0;
	    if(is_array($state)){
	        foreach($state as $s){
	           $sta=$sta | (int)$s; 
	        }
	    }else{
	        $sta=(int)$state;
	    }
	    
	    if(!is_array($ids)){
			$ids=array($ids);
		}
		//过滤字段
		foreach($ids as $k=>$id){
		    $ids[$k]=(int)$id;
		}
		$this->db->where_in('id',$ids)->update($this->tbl,array($field=>$sta));
		return $this->db->affected_rows();
	}
	
	/**
     * 设定错误内容以便程序获取
     */
    protected function setError($code,$desc){
        $this->lastError=array(
            'number'=>$code,
            'description'=>$desc
        );
    }
}
