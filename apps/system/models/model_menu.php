<?php
/**
 * 菜单模型
 */
class Model_Menu extends MB_Model
{
	private $path='apps/config/menu.php';
	
	function __construct()
	{
		parent::__construct('menu');
	}
	//@override
	function beforeUpdate(&$row){
	    if(isset($row['right'])){
	        $row['right']=$this->convertRightBack($row['right']);
	    }
	    return $row;
	}
	//@override
	function afterUpdate($id,$num){
	    $this->generMenu();
	    return $id;
	}
	//@override
	function afterDelete($num){
	    $this->generMenu();
	    return $num;
	}
	//@override
	function afterGetOne(&$row){
	    $row['right']=$this->convertRight($row['right']);
	    return $row;
	}
	
	function getPath(){
		return $this->path;
	}
	
	//获取菜单
	function getMenu($right, $update=false)
	{
		//仅在需要时更新
		if($update || ! is_file($this->path)){
			$this->generMenu();
		}
		
		//取出菜单并过滤隐藏和无权限的
		$menu = include($this->path);
		foreach($menu as $k=>$m){
			if($m['show']==0 || !$this->check($m['right'], $right)){
				unset($menu[$k]);
				continue;
			}
			foreach($m['submenu'] as $sk=>$sm){
				if($sm['show']==0 || !$this->check($sm['right'] , $right)){
					unset($menu[$k]['submenu'][$sk]);
				}
			}
		}
		
		return $menu;
	}
	
	//批量保存，可以保存排序和权限
	function savebatch($arr){
	    if(!isset($arr['id']) || !is_array($arr['id']))return;
	    $sort=$arr['sort'];
	    $rght=$arr['right'];
	    $savesort= ($arr['savesort']=='1' && is_array($sort));
	    $saverght= ($arr['saveright']=='1' && is_array($rght));
	    $rows=array();
		foreach($arr['id'] as $k){
			$k=intval($k);
		    $row=array('id'=>$k);
			if($savesort)$row['sort']=intval($sort[$k]);
			if($saverght){
			    $row['right']=$this->convertRightBack($rght[$k]);
			}
			$rows[]=$row;
		}
		
		$this->db->update_batch($this->tbl,$rows,'id');
		$this->generMenu();
	}
	
	//检测权限, $r->菜单权限 $ur->用户权限
	function check($r,$ur){
		if(strlen($r)<RIGHT_LEVEL)
			$r = str_repeat('0',RIGHT_LEVEL - strlen($r)).$r;
		return $r == bit_and($r,$ur);
	}
	
	//将权限值由 1,2,30 ..的格式转换成 01000的格式
	function convertRightBack($str){
	    $a=explode(',',$str);
	    for($i=1;$i<=RIGHT_LEVEL;$i++){
	        if(in_array($i,$a)){
				$r[]='1';
			}else{
				$r[]='0';
			}
	    }
	    return implode('',array_reverse($r));
	}
	//与上面相反
	function convertRight($str){
		$l=strlen($str);
		if($l < RIGHT_LEVEL){
			$str = str_repeat('0',RIGHT_LEVEL-$l).$str;
		}
		$r=array();
        for($i=0;$i < RIGHT_LEVEL;$i++){
            if($str[$i] == '1'){
                $r[]=RIGHT_LEVEL - $i;
            }
        }
	    return implode(',',$r);
	}
	
	//生成菜单到文件
	function generMenu(){
		$CI =& get_instance();
		$CI->load->helper('file');
		
		//读取菜单数据
		$order='parent asc,sort asc';
		$menus = $this->getAll(null,$order);
		$menu=array();
		foreach($menus->result_array() as $m)
		{
			if($m['parent']==0){
				$menu[$m['id']]=$m;
				$menu[$m['id']]['submenu']=array();
			}else{
				$menu[$m['parent']]['submenu'][$m['id']]=$m;
			}
		}
		
		//生成文件
		$data[]='<?php';
		$data[]='return array(';
		foreach($menu as $m){
			$data[]='	array(';
			foreach($m as $k=>$v){
				if($k == 'submenu'){
					$data[]= '		\'submenu\'=>array(';
					
					foreach($v as $sm){
						$data[]='			array(';
						foreach($sm as $sk=>$sv){
							$data[]="				'$sk'=>".(is_int($sv)?$sv:"'$sv'").',';
						}
						$data[]= '			),';
					}
					
					$data[]= '		),';
				}else{
					$data[]="		'$k'=>".(is_int($v)?$v:"'$v'").',';
				}
			}
			$data[]='	),';
		}
		$data[]=');';
		
		write_file($this->path,implode("\n",$data));
		
		return true;
	}
}

/*End of file model_menu.php*/
