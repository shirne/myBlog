<?php
/**
 * 系统管理相关
 */
class System extends MB_Controller
{
	function __construct ()
    {
        parent::__construct();
        
    }
	function index(){
		$this->view('system');
	}
	
	/*===================系统配置======================*/
	//
	function config(){
		$this->load->model('Model_Config','mconfig');
		$this->data['config']=$this->mconfig->getConfig();
		$this->view('system_config');
	}
	function configadd(){
		$this->view('system_configadd');
	}
	function configsave(){
		$this->ajaxMsg('修改成功');
	}
	function userconfig(){
		$userinfo=$this->user->getInfo();
		$this->data['config']=$userinfo['config'];
		$this->view('system_userconfig');
	}
	function userconfigsave(){
		$row['config']=$_POST['config'];
		$this->user->update($row);
		$this->ajaxMsg('修改成功');
	}
	/*===================系统配置 END==================*/
	
	/*===================系统菜单管理=======================*/
	//菜单管理
	function menumanage(){
		$this->load->model('Model_Menu','menu');
		
		$menu = include($this->menu->getPath());
		
		//转换权限
		foreach($menu as $k=>$m){
		    $menu[$k]['right']=$this->menu->convertRight($m['right']);
		    foreach($m['submenu'] as $sk=>$sm){
				$menu[$k]['submenu'][$sk]['right']=$this->menu->convertRight($sm['right']);
			}
		}
		
		$this->data['menu']=$menu;
		
		$this->view('system_menumanage');
	}
	//添加菜单
	function menuadd(){
	    $this->load->model('Model_Menu','menu');
	    
	    $this->data['pmenu']=$this->menu->getAll(array('parent'=>0),'SORT ASC');
	    
	    $this->data['menu']=array(
	        'id'=>'',
	        'name'=>'',
	        'parent'=>0,
	        'control'=>'',
	        'action'=>'',
	        'right'=>'',
	        'sort'=>'',
	        'show'=>1
	    );
	    
	    $this->data['action']='添加';
	    
		$this->view('system_menuadd');
	}
	//修改菜单
	function menuedit(){
	    $this->load->model('Model_Menu','menu');
	    $id=(int)$this->uri->segment(3);
	    
	    $this->data['pmenu']=$this->menu->getAll(array('parent'=>0),'SORT ASC');
	    
	    $this->data['menu']=$this->menu->getOne($id);
	    
	    $this->data['action']='修改';
	    
		$this->view('system_menuadd');
	}
	
	//菜单批量保存（排序及权限)
	function menusavebatch(){
		if(isset($_POST['savesort']) || isset($_POST['saveright'])){
		    if(!isset($_POST['savesort']))$_POST['savesort']=0;
		    if(!isset($_POST['saveright']))$_POST['saveright']=0;
			$this->load->model('Model_Menu','menu');
			$this->menu->savebatch($_POST);
		}
		$this->ajaxMsg('保存成功');
	}
	//保存
	function menusave(){
	    $this->load->model('Model_Menu','menu');
	    $id=(int)$this->uri->segment(3);
	    
	    if(!empty($_POST)){
	        $_POST['id']=$id;
	        $this->menu->save($_POST);
	    }
	    $this->ajaxMsg('保存成功',0,'system/menumanage');
	}
	//更改显示隐藏状态
	function menustat(){
	    $this->load->model('Model_Menu','menu');
	    $id=(int)$this->uri->segment(3);
	    $state=(int)$this->uri->segment(4);
	    if(!empty($id)){
	        $row=array('id'=>$id,'show'=>$state==1?0:1);
	        $this->menu->save($row);
	    }
	    $this->ajaxMsg('状态已更改');
	}
	//删除菜单
	function menudel(){
		$id = (int)$this->uri->segment(3);
		$this->load->model('Model_Menu','menu');
		$this->menu->del($id);
		$this->ajaxMsg('删除成功');
	}
	/*===================系统菜单管理 END====================*/
	
	/*===================系统管理员管理======================*/
	//
	function adminmanage(){
		$result = $this->user->getAll(NULL);
		foreach($result->result_array() as $r){
			$rst[]=$r;
		}
		$this->data['list'] = $rst;
		
		$this->view('system_adminmanage');
	}
	function adminadd(){
	    $this->data['admin']=array(
	        'id'=>'',
	        'account'=>'',
	        'name'=>'',
	        'rights'=>''
	    );
		$this->_adminedit();
	}
	function adminedit(){
	    $id=(int)$this->uri->segment(3);
	    
	    if($id == $this->user->id){
	        $this->error('您不能在此处修改您的信息,请到<font color="red">修改资料处修改</font>','系统提示');
	    }else{
	    
	        $this->data['admin']=$this->user->getOne($id);
	        
	        if(empty($this->data['admin'])){
	            $this->error('要修改的管理员不存在'.anchor('system/adminmanage','点此返回'),'信息有误');
	        }else{
	            $this->load->model('Model_Menu','menu');
	            $this->data['admin']['rights']=$this->menu->convertRight($this->data['admin']['rights']);
	            $this->_adminedit();
	        }
	    }
	}
	private function _adminedit(){
	    $this->view('system_adminadd');
	}
	function adminright(){
	    $id=(int)$this->uri->segment(3);
	    if($id == $this->user->id){
	        $this->error('您不能修改自己的权限','系统提示');
	    }else{
	        $this->data['admin']=$this->user->getOne($id);
	        if(empty($this->data['admin'])){
	            $this->error('要修改的管理员不存在'.anchor('system/adminmanage','点此返回'),'信息有误');
	        }else{
	            $this->load->model('Model_Menu','menu');
	            $menu = include($this->menu->getPath());
	            
	            foreach($menu as $k=>$m){
	                if($this->menu->check($m['right'],$this->data['admin']['rights'])){
	                    $menu[$k]['hasright']=1;
	                }else{
	                    $menu[$k]['hasright']=0;
	                }
	                foreach($m['submenu'] as $sk=>$sm){
	                    if($this->menu->check($sm['right'],$this->data['admin']['rights'])){
	                        $menu[$k]['submenu'][$sk]['hasright']=1;
	                    }else{
	                        $menu[$k]['submenu'][$sk]['hasright']=0;
	                    }
	                }
	            }
	            $this->data['menu']=$menu;
	            
	            $this->view('system_adminright');
	        }
	    }
	}
	
	//保存可视化修改的权限
	function adminrightsave(){
	    $id=$this->uri->segment(3);
	    if(empty($id)){
	        $this->ajaxMsg('参数有误，请选择要修改的管理员',3);
	    }
	    if($id == $this->user->id){
	        $this->ajaxMsg('您不能修改自己的权限',3);
	    }
	    
	    $row['id']=$id;
	    $row['rights']=str_repeat('0',RIGHT_LEVEL);
	    if(!empty($_POST['rights']) && is_array($_POST['rights'])){
	        foreach($_POST['rights'] as $r){
	            $row['rights']=bit_or($row['rights'],$r);
	        }
	    }
	    $this->user->save($row);
	    $this->ajaxMsg('保存成功',0,'system/adminmanage');
	}
	
	//删除管理员
	function admindel(){
	    $id=(int)$this->uri->segment(3);
	    if(empty($id)){
	        $this->ajaxMsg('参数有误，请选择要删除的管理员',3);
	    }
	    if($id == $this->user->id){
	        $this->ajaxMsg('您不能删除自己',3);
	    }
	    $this->user->del($id);
	    $this->ajaxMsg('删除成功');
	}
	//保存管理员的信息
	function adminsave(){
	    $id=$this->uri->segment(3);
	    if($id == $this->user->id){
	        $this->ajaxMsg('您不能在此处修改您的信息',3);
	    }
	    if(empty($id) && empty($_POST['password'])){
	        $this->ajaxMsg('请填写密码',3);
	    }
	    if(empty($_POST['account'])){
	        $this->ajaxMsg('账号不能为空',3);
	    }
	    if(empty($_POST['name'])){
	        $this->ajaxMsg('名称不能为空',3);
	    }
	    
	    //检测账号
	    if(!preg_match('/^[\w\d\-\_]{4,}$/',$_POST['account'])){
	        $this->ajaxMsg('账号格式不正确，请使用字母及数字',3);
	    }
	    $user=$this->user->getOne(array('account'=>$_POST['account'],'id <>'=>$id));
	    if(!empty($user)){
	        $this->ajaxMsg('账号有重复',3);
	    }
	    
	    //检测用户名
	    $user=$this->user->getOne(array('name'=>$_POST['name'],'id <>'=>$id));
	    if(!empty($user)){
	        $this->ajaxMsg('名称有重复',3);
	    }
	    
	    if(empty($_POST['password']))unset($_POST['password']);
	    
	    $this->load->model('Model_Menu','menu');
	    
	    $_POST['rights']=$this->menu->convertRightBack($_POST['rights']);
	    $this->user->update($_POST,$id);
	    $this->ajaxMsg('保存成功');
	}
	//批量修改的保存
	function adminbatch(){}
	//修改个人资料
	function admindata(){
	    $this->data['admin']=$this->user->getInfo();
		$this->view('system_admindata');
	}
	function admindatasave(){
	    $id=$this->user->id;
	    $row['name']=$_POST['name'];
	    
	    if(empty($_POST['password'])){
	        $this->ajaxMsg('请输入密码',3);
	    }else{
	        $user=$this->user->getInfo();
	        if($user['password'] != $this->user->password($_POST['password'])){
	            $this->ajaxMsg('密码不正确',3);
	        }
	    }
	    
	    //检测用户名
	    $user=$this->user->getOne(array('name'=>$_POST['name'],'id <>'=>$id));
	    if(!empty($user)){
	        $this->ajaxMsg('该用户名已存在',3);
	    }
	    
	    if(!empty($_POST['newpassword'])){
	        if($_POST['newpassword'] != $_POST['newpasswordconfirm']){
	            $this->ajaxMsg('两次输入密码不一致',3);
	        }
	        $row['password']=$_POST['newpassword'];
	    }
	    
	    $this->user->update($row);
	    
	    $this->ajaxMsg('修改成功');
	}
	/*===================系统管理员管理 END==================*/
	
	/*===================辅助功能===========================*/
	//编辑器图片上传
	function imageupload(){
		$this->subfolder='editor';
		//上传配置
		$config = array(
			"allowed_types"=>"gif|png|jpg|jpeg|bmp",   //文件允许格式
			"is_image"=>TRUE,
			"max_size"=>2 * 1024               //文件大小限制，2MB
		);
		
		$json['title']=htmlspecialchars($_POST['pictitle']);
		if($this->uploadfile('picdata',$config)){
			$data=$this->upload->data();
			$json['url']=$data['file_name'];
			$json['state']='SUCCESS';
		}else{
			$data=$this->upload->data();
			$json['url']='';
			$json['state']=$this->upload->display_errors('',';');
		}
		echo json_encode($json);
		exit;
	}
	
	//编辑器附件上传
	function fileupload(){
		$this->subfolder='attachment';
		$config = array(
			"allowed_types" => "rar|doc|docx|zip|pdf|txt|swf|wmv" , //文件允许格式
			"is_image"=>FALSE,
			"max_size" => 2 * 1024 //文件大小限制，2MB
		);
		
		if($this->uploadfile('Filedata',$config)){
			$data=$this->upload->data();
			$json['url']=$data['file_name'];
			$json['state']='SUCCESS';
			$json['fileType']=$data['file_ext'];
		}else{
			$json['url']='null';
			$json['fileType']='null';
			$json['state']=$this->upload->display_errors('',';');
		}
		
		echo json_encode($json);
		exit;
	}
	
	//远程图片保存
	function remote(){
		$uri = htmlspecialchars( $_POST[ 'content' ] );
		//Ajax提交的网址内容中如果包含了&符号，上述函数会将其转成&amp;导致地址解析不对，这里要转回来
		$uri = str_replace( "&amp;" , "&" , $uri );
		getRemoteImage( $uri );
		//忽略抓取时间限制
		set_time_limit( 0 );
		//远程抓取图片配置
		$config = array(
			"savePath" => DOC_ROOT.UPLOAD_PATH."remote/" , //保存路径
			"fileType" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" ) , //文件允许格式
			"fileSize" => 3000 //文件大小限制，单位KB
		);
		//ue_separate_ue  ue用于传递数据分割符号
		$imgUrls = explode( "ue_separate_ue" , $uri );
		$tmpNames = array();
		foreach ( $imgUrls as $imgUrl ) {
			//格式验证
			$fileType = strtolower( strrchr( $imgUrl , '.' ) );
			if ( !in_array( $fileType , $config[ 'fileType' ] ) ) {
				array_push($tmpNames,"error" );
				continue;
			}
			//死链检测
			if ( !urlTest( $imgUrl ) ) {
				array_push($tmpNames, "error" );
				continue;
			};
	
			//打开输出缓冲区并获取远程图片
			ob_start();
			//请确保php.ini中的fopen wrappers已经激活
			readfile( $imgUrl );
			$img = ob_get_contents();
			ob_end_clean();
	
			//大小验证
			$uriSize = strlen( $img ); //得到图片大小
			$allowSize = 1024 * $config[ 'fileSize' ];
			if ( $uriSize > $allowSize ) {
				array_push($tmpNames,"error" );
				continue;
			}
			//创建保存位置
			$savePath = $config[ 'savePath' ];
			if ( !file_exists( $savePath ) ) {
				mkdir( "$savePath" , 0777 );
			}
			//写入文件
			$tmpName = $savePath . rand( 1 , 10000 ) . time() . strrchr( $imgUrl , '.' );
			try {
				$fp2 = @fopen( $tmpName , "a" );
				fwrite( $fp2 , $img );
				fclose( $fp2 );
				array_push($tmpNames,substr($tmpName,strlen(DOC_ROOT))); //同图片上传一样，去掉容易引起路径混乱的../
				//array_push($tmpNames,$tmpName);
			} catch ( Exception $e ) {
				array_push($tmpNames, "error" );
			}
		}
	
		echo( "{'url':'" . implode("ue_separate_ue", $tmpNames) . "','tip':'远程图片抓取成功！','srcUrl':'" . $uri . "'}" );
		exit;
	}
	
	//图片浏览,仅支持浏览编辑器上传的图片
	function imageview(){
		$action=$this->input->get('action');
		echo $action;
		$path= UPLOAD_PATH.'editor';
		$spath=DOC_ROOT.$path;
		echo implode('ue_separate_ue',$this->getfiles($spath,$path));
		exit;
	}
	
	private function getfiles($path, $root, &$files=array()){
		$handle = opendir($path);
		while (FALSE !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path .'/'. $file;
				if (is_dir($path2)) {
					$this->getfiles($path2,$root.'/'.$file , $files);
				} else {
					if (preg_match("/\.(gif|jpeg|jpg|png|bmp)$/i", $file)) {
						$files[] = $root .'/'. $file;
					}
				}
			}
		}
		return $files;
	}
	
	//截图上传,暂不支持此功能
	function snapimgup(){
	}
}

/*End of file system.php*/
