<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
#doc
#    classname:    Model_Rights
#    scope:        PUBLIC
#    description:  权限检查模块
#/doc

class Model_Rights extends MB_Model
{
	//默认返回的权限,如，未设定权限的模块
    private $defaultReturn=true;
	
	public $nav=array();
	
	function __construct ()
    {
        parent::__construct('menu');
    }
    
    #$right 当前用户权限值
    #$model 当前模块
    #$action当前操作
    function check($right, $model, $action){
        if(empty($model)){
			return true;
		}
		if(empty($action)){
			$action='index';
		}
		$where['control']=$model;
		
		$where['parent']=0;
		$m=$this->getOne($where);
		if(empty($m)){
			return $this->defaultReturn;
		}else{
			$this->nav[]=$m;
		}
		
		$where['parent']=$m['id'];
		$where['action']=$action;
		
		$row=$this->getOne($where);
		if(empty($row)){
			return $this->defaultReturn;
		}else{
			$this->nav[]=$row;
			/*$right = (float)$right;
			$row['right'] = (float)$row['right'];
			echo $right,'<br />';
			echo $row['right'] & $right;
			echo '<br />',$row['right'];*/
			return (bit_and($row['right'], $right) == $row['right']);
		}
    }
}
###
