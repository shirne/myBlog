<?php
#doc
#    classname:    Model_User
#    scope:        PUBLIC
#
#/doc
/**
 * Error Code Map
 * 1001 User not found
 * 1002 Username Exists
 * 1003 Password not matching
 * 1004 User not login
 * 1005 Username is required
 * 1006 Password is required
 */

class Model_User extends MB_Model
{
    protected $id=NULL;
    protected $name=NULL;
    protected $account=NULL;
    protected $right=NULL;
    
    //session keys
    private $userid_key = 'USER_ID';
    
    private $session=NULL;
    
    //允许传入的表单项,用于更新时过滤
    private $form=array('name','account','password','rights','config');
    
    /**
     * 构造函数
     */
    function __construct ()
    {
        parent::__construct('admin');
        
        $this->userid_key = SESS_PRE.'USER_ID';
	    
		$this->addAccess(array('id','account','name','right'));
    }
    
    public function init( & $s){
    	$this->session = & $s;
    	
    	//如果已登陆，则更新用户资料
    	if(FALSE !== $this->session->userdata($this->userid_key)){
    	    $this->id=(int)$this->session->userdata($this->userid_key);
            $this->updata();
        }
    }
	
	function isLogin(){
		return !is_null($this->id);
	}
    
	function beforeUpdate(& $row){
		$row=parent::beforeUpdate($row);
		
		if(isset($row['password'])){
			$row['password']=$this->password($row['password']);
		}
		
		if(isset($row['config'])){
			$row['config']=serialize($row['config']);
		}
		
		return $row;
	}
	
    /**
     * 更新用户登陆资料
     */
    function updata($row=NULL){
        //如果参数为空，则从数据库中读取资料
        if(empty($row)){
            if($this->id===NULL){
                $this->setError(1004,'User not login');
                return FALSE;
            }
            $row=$this->getOne($this->id);
        }
        
        if(empty($row)){
            $this->setError(1001,'User not found');
            $this->id=NULL;
            return FALSE;
        }
		
		if(strlen($row['rights'])<RIGHT_LEVEL){
			$row['rights'] = str_repeat('0',RIGHT_LEVEL-strlen($row['rights'])).$row['rights'];
		}
        
        //将用户资料更新到当前私有变量和SESSION
        $this->id=(int)$row['id'];
        $this->name=$row['name'];
        $this->account=$row['account'];
        $this->right=$row['rights'];
        $this->session->set_userdata($this->userid_key,$this->id);
        return TRUE;
    }
    
    
    /**
     * 登陆用户
     * @return TRUE|FALSE
     */
    function login($username,$password){
        if(empty($username)){
            $this->setError(1005,'Username is required');
            return FALSE;
        }
        if(empty($password)){
            $this->setError(1006,'Password is required');
            return FALSE;
        }
        
        $row=$this->getOne(array('account'=>$username));
        
        if(empty($row)){
            $this->setError(1001,'User not found');
            return FALSE;
        }
        if($this->password($password)!=$row['password']){
            $this->setError(1003,'Password not matching');
            return FALSE;
        }
        if($this->updata($row)){
            $data=$this->session->all_userdata();
            $update=array(
                'id'=>$row['id'],
                'logintime'=>time(),
                'loginip'=>$data['ip_address'],
            );
            $this->save($update);
            return TRUE;
        }
    }
    
    /**
     * 登出用户
     */
    function logout(){
        $this->session->unset_userdata($this->userid_key);
        $this->id=NULL;
        return TRUE;
    }
    
    /**
     * 不传参数时获取当前用户的资料
     */
    function getInfo($id=NULL){
        if($id===NULL){
            $id=$this->id;
        }
        $row=$this->getOne((int)$id);
        $row['confg']=unserialize($row['config']);
        return $row;
    }
    
    /**
     * 创建用户,只有权限的管理员才可调用
     */
    function create($row){
        if(empty($row['name'])){
            $this->setError(1005, 'Username is required');
            return FALSE;
        }
        if(empty($row['password'])){
            $this->setError(1006, 'Password is required');
            return FALSE;
        }
        
        //过滤参数
        $row=array_intersect_key($row,array_flip($this->form));
        
        return $this->save($row);
    }
    
    /**
     * 更新用户资料,如果是用户自己更新，则不允许修改权限和用户名
     */
    function update($row, $id=NULL){
        if($id===NULL){
            if($this->id===NULL){
                $this->setError(1004,'User not login');
                return FALSE;
            }
            $id=$this->id;
            //不允许修改权限
            unset($row['rights']);
            //不允许修改帐户名
            unset($row['account']);
        }
		
        $row=array_intersect_key($row,array_flip($this->form));
		if(!empty($id))$row['id']=$id;
		
        if($this->save($row)){
            if($id==$this->id){
                $this->updata($this->getOne($id));
            }
        }
        
    }
    
    /**
     * 密码加密方式
     */
    function password($str){
        return md5($str);
    }
}
###
# End File
###
