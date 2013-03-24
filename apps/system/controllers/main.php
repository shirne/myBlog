<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#doc
#    classname:    Main
#    scope:        PUBLIC
#
#/doc

class Main extends MB_Controller
{
	
    function __construct ()
    {
        parent::__construct();
        
    }
    
    //主界面
    function index(){
		//加载菜单模块
		$this->load->model('Model_Menu','menu');
		
		//根据权限获取所有菜单,自动切分为二级菜单
        $this->data['menu']=$this->menu->getMenu($this->user->right);
		
		$this->view('main');
    }
	
    function ajax(){
        $action=$this->uri->segment(3);
        switch($action){
            case 'craft':
            $this->load->model('Model_Craft','craft');
            $this->ajaxMsg($this->craft->countAll());
            break;
            
            default:
            $this->ajaxMsg('请求参数有误');
        }
    }
    
    //登陆
    function login(){
		
		//初始化数据
//		$row=array(
//			'name'=>'管理员',
//          'account'=>'admin',
//			'password'=>'123456',
//			'rights'=>str_repeat('1',RIGHT_LEVEL),
//			'config'=>''
//		);
        //修改权限
		//$row = array('id'=>1,'rights'=>str_repeat('1',RIGHT_LEVEL));
		//更新
		//$this->user->save($row);
		$this->data['checkcode']=$this->checkcode(TRUE);
        $this->view('main_login');
    }
    //登陆操作
    function dologin(){
		if(empty($_POST['checkcode'])){
            $this->ajaxMsg('请输入验证码',1);
        }
		
		//验证码忽略大小写
		if(strtolower($_POST['checkcode']) != $this->session->userdata($this->code)){
			$this->ajaxMsg('验证码不正确',3);
		}
        if(empty($_POST['username'])){
            $this->ajaxMsg('用户名不能为空',1);
        }
        if(empty($_POST['password'])){
            $this->ajaxMsg('密码不能为空',1);
        }
        if($this->user->login($_POST['username'],$_POST['password'])){
			$this->session->unset_userdata($this->code);
			$this->alog->log($this->user->id,$this->user->account,'登陆成功');
            $this->ajaxMsg('登陆成功');
        }else{
            $this->alog->log(NULL,htmlentities($_POST['username']),'登陆失败',$this->user->lastError['description']);
            $this->ajaxMsg('登陆失败,用户名或密码错误',3);
        }
    }
    //登出
    function logout(){
    	$this->user->logout();
    	redirect('main/login');
    }
    
    //验证码
    function checkcode($r=FALSE){
    	$this->load->helper('captcha');
		
		$config=array(
			'img_path'=>'./upload/captcha/',
			'img_url'=>UPLOAD_PATH.'captcha/'
		);
		
		$img = create_captcha($config);
		
		$this->session->set_userdata($this->code,strtolower($img['word']));
		
		if($r){
			return $img['image'];
		}else{
			echo $img['image'];
			exit;
		}
    }

}
###
