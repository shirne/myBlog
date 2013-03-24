<?php
#doc
#    classname:    MB_Controller
#    scope:        PUBLIC
#
#/doc

class MB_Controller extends CI_Controller
{
    
    //用于输出到页面的内容
    protected $data;
    
	//验证码键名
	protected $code;
	
	//上传文件的子文件夹,必须在子类中定义后再上传文件
	protected $subfolder;
    
	//控制器统一构造函数
	//加载必须模块，检查权限
    function __construct ()
    {
		//swfupload上传过程中不能附带cookie导致无登陆状态
		global $CFG;
		if(isset($_POST[$CFG->config['sess_cookie_name']])){
			if(!empty($_POST[$CFG->config['sess_cookie_name']])){
				$_COOKIE[$CFG->config['sess_cookie_name']]=$_POST[$CFG->config['sess_cookie_name']];
			}
			unset($_POST[$CFG->config['sess_cookie_name']]);
		}
		/*
		//swfupload上传过程中userAgent不符导致session丢失，目前此方法不能适应所有浏览器
		if(isset($_POST['HTTP_USER_AGENT'])){
			if(!empty($_POST['HTTP_USER_AGENT'])){
				$_SERVER['HTTP_USER_AGENT']=$_POST['HTTP_USER_AGENT'];
			}
			unset($_POST['HTTP_USER_AGENT']);
		}
		*/
        parent::__construct();
		//验证码
		$this->code = SESS_PRE.'code';
        
        //开启评估
        #$this->output->enable_profiler();
        
        //加载权限管理
        $this->load->model('Model_Rights','rights');
        
		//加载辅助函数
		$this->load->helper('bit_oper');
		
        //加载角色管理
        $this->load->model('Model_User','user');
        
        //加载日志管理，与系统log冲突,使用alog
        $this->load->model('Model_Log','alog');
        
        //默认加载到页面的信息
        $this->data['title']='MyBlog 后台管理系统 - Powered By Shirne';
        
        //初始化用户数据,将session对象传入以便记录数据
        $this->user->init($this->session);
		
		#$this->alog->log(0,'',$_SERVER['HTTP_USER_AGENT']);
		
        //过滤POST参数,确保键名都为小写字母
        if(!empty($_POST)){
            foreach($_POST as $k=>$v){
                if(strtolower($k) !== $k){
                    unset($_POST[$k]);
                    $_POST[strtolower($k)]=$v;
                }
            }
        }
        
		global $class;
		global $method;
		
		//main控制器下的登陆及验证码操作不需要登陆，已登陆跳转至首页
		if($class == 'main'){
			if(!$this->user->isLogin() && !in_array($method,array('login','dologin','checkcode'))){
				redirect('main/login');
			}else if($this->user->id !== NULL && in_array($method,array('login','dologin'))){
				redirect('main/index');
			}
		}else{
			//检查登陆
			if(!$this->user->isLogin()){
            	redirect('main/login');
            }
			//检查权限
			if(! $this->rights->check($this->user->right ,$class, $method)){
				if($this->input->is_ajax_request()){
					$this->ajaxMsg('权限不足',3);
				}else{
            		die('权限不足');
				}
            }else{
				$this->data['navigator']=$this->rights->nav;
			}
		}
    }
    
    function addTips($msg,$num=0){
        $this->data['tips'][]=$msg;
    }
    
    //显示
    function view($htm){
		$this->data['username']=$this->user->name;
		$this->data['userid']=$this->user->id;
        $this->load->view($htm, $this->data);
    }
	
	//输出json信息
	function ajaxMsg($msg,$error=0,$url=NULL,$data=NULL){
		$json['message']=$msg;
		$json['number']=$error;
		if(! empty($url))$json['url']=$url==-1?-1:site_url($url);
		if(! empty($data))$json['data']=$data;
		echo json_encode($json);
		exit;
	}
    
    //错误页
    function error($msg='服务器处理错误!',$title='系统信息',$url=NULL, $timeout=3){
        $this->data['title'] .= $title;
        $this->data['tiptitle'] = $title;
        $this->data['message'] = $msg;
        $this->data['url'] = $url;
        $this->data['timeout'] = $timeout;
        
        $this->view('error');
    }
    
	//文件上传
    function uploadfile($field,$cfg){
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
		$config['file_name'] = str_replace('0.','',implode('',array_reverse(explode(' ',microtime()))));
		
        $config = array_merge($config,$cfg);
        $config['upload_path']=DOC_ROOT.UPLOAD_PATH.$this->subfolder.'/';
        
		//创建保存位置
		$savePath = $config[ 'upload_path' ];
		if ( !file_exists( $savePath ) ) {
			mkdir( "$savePath" , 0777 );
		}
		
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload($field)){
            return FALSE;
        }else{
			return TRUE;
        }
    }

}
###
