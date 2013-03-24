<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#    classname:    Model_Article
#    scope:        PUBLIC
#
#/doc

class Model_Article extends MB_Model
{
    private $uid;
	
	private $form=array('id','title', 'cate', 'state', 'thumb', 'summary', 'tags', 'refer', 'content', 'author','path');
	private $craft_id;
	
    function __construct ()
    {
        parent::__construct('articles');
        
        $CI=& get_instance();
        $this->uid=(int)$CI->user->id;
    }
    
	//更新前的数据处理
	function beforeUpdate(&$row){
		if(!empty($row['craft_id'])){
			$this->craft_id=(int)$row['craft_id'];
		}
		
		$row = array_intersect_key($row,array_flip($this->form));
		if(isset($row['id'])){
			$row['mdate']=time();
		}else{
			$row['date']=time();
			$row['mdate']=$row['date'];
		}
		
		$row['title']=htmlspecialchars($row['title']);
		
		if(isset($row['state']) && is_array($row['state'])){
			$state=0;
			foreach($row['state'] as $r){
				$state = $state | (int)$r;
			}
			$row['state']=$state;
		}
		
		return $row;
	}
	
	//更新成功后,删除对应的草稿
	function afterUpdate($id,$num){
	    if( !empty($this->craft_id)){
	        $CI=& get_instance();
	        $CI->load->model('Model_Craft','craft');
	        $CI->craft->del($this->craft_id);
	    }
	}
	
	#@Override
	function getAllPage($page=0,$where=NULL,$order=NULL){
		$this->pagecurrent=abs((int)$page);
		if(!empty($where)){
		    $this->db->where($where);
		}
		$this->recordcount=$this->db->count_all_results($this->tbl.'_list');
		
		if($this->pagecurrent>$this->recordcount){
			$this->pagecurrent=$this->recordcount - ($this->recordcount % $this->pagesize);
		}
		
		if(!empty($order)){
			$this->db->order($order);
		}
		
		return $this->afterGetAll($this->db
		    ->limit($this->pagesize,$this->pagecurrent)
		    ->get($this->tbl.'_list'));
	}
    
}

/*End of file model_article.php*/
