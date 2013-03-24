<?php
#doc
#    classname:    Model_Config
#    scope:        PUBLIC
#    配置模块
#/doc

class Model_Config extends MB_Model
{
    function __construct ()
    {
        parent::__construct('config');
    }
    ###
    
	function beforeUpdate(&$row){
		if(isset($row['value'])){
			$row['value']=serialize($row['value']);
		}
		return $row;
	}
	
	function afterGetOne(&$row){
		if(isset($row['value'])){
			$row['value']=unserialize($row['value']);
		}
		return $row;
	}
	
    #获取配置
    #@return Array
    function getConfig($key=NULL){
		if(is_null($key)){
    		return $this->getAll(NULL);//db->fields("id,name,description")->get();
		}else{
			$where=array('name'=>$key);
			return $this->getOne($where);
		}
    }
    

}
###
