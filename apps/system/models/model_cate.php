<?php
/**
 * 分类数据模型
 * 暂时只做二级分类
 */
class Model_Cate extends MB_Model
{
    //默认管理文章分类
    private $colkey='article';
    
    function __construct()
    {
        parent::__construct('cates');
    }
    
    function setCol($key)
    {
        $this->colkey=$key;
    }
    
    function beforeUpdate(&$row){
        if(empty($row['pid'])){
            $row['pid']=0;
        }else{
            $row['pid']=(int)$row['pid'];
        }
        
        $pcate=$this->getOne($row['pid']);
        if(!empty($pcate)){
            $CI=& get_instance();
            $CI->ajaxMsg('父级分类不存在',3);
            $row['path']=$pcate['path'].','.$pcate['id'];
        }else{
            $row['path']='0';
        }
        if(empty($row['name'])){
            $CI=& get_instance();
            $CI->ajaxMsg('分类名称必须填写',3);
        }
        $row['name']=htmlspecialchars($row['name']);
        $row['colkey']=$this->colkey;
        
        if(isset($row['detail']))$row['detail']=htmlspecialchars($row['detail']);
        
        return $row;
    }
    
    function getList($where=NULL,$feilds=NULL,$order='pid asc,SORT ASC'){
        if(empty($where)){
            $where=array();
        }
        $where['colkey']=$this->colkey;
        if(! empty($fields))$this->db->select($fields);
        $result= $this->getAll($where,$order);
		$return=array();
		foreach($result->result_array() as $r){
			if($r['pid']==0){
				$return[$r['id']]=$r;
			}else{
				$return[$r['pid']]['subcate'][$r['id']]=$r;
			}
		}
		
		return $return;
    }
    
    //批量保存，可以保存排序
	function savebatch($arr){
	    if(!isset($arr['id']) || !is_array($arr['id']))return FALSE;
	    $sort=$arr['sort'];
	    $savesort= ($arr['savesort']=='1' && is_array($sort));
	    $rows=array();
	    if($savesort){
		    foreach($arr['id'] as $k=>$v){
			    $rows[]=array('id'=>(int)$v,'sort'=>(int)$sort[$k]);
		    }
		
		    $this->db->update_batch($this->tbl,$rows,'id');
		    return TRUE;
		}
		return FALSE;
	}

}
