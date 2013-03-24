<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#doc
#    classname:    Article
#    scope:        PUBLIC
#
#/doc

class Article extends MB_Controller {
    
    function __construct(){
		parent::__construct();
		
		$this->load->model('Model_Article','article');
		
	}

	/**
	 * Index
	 */
	public function index()
	{
	    $this->load->model('Model_Craft','craft');
	    $this->load->model('Model_Article','article');
		$this->article->pagesize=20;
	    $this->data['list']=$this->article->getAllPage($this->uri->segment(3));
		$this->data['page']=$this->article->showPage(site_url('article/index'));
		$this->data['craftcount']=$this->craft->countAll();
		$this->view('article');
	}
	
	public function add(){
	    $this->data['art']=array(
	        'id'=>'',
	        'title'=>'',
	        'cate'=>'',
	        'state'=>STATE_SHOW | STATE_FILT,
	        'tags'=>'',
	        'thumb'=>'',
	        'refer'=>'',
	        'summary'=>'',
	        'content'=>''
	    );
	    
	    $this->data['action']='添加';
	    
		$this->_edit();
	}
	
	public function edit(){
	    
	    $this->load->model('Model_Article','article');
	    $id=(int)$this->uri->segment(3);
	    
	    $this->data['art']=$this->article->getOne($id);
	    
	    $this->data['action']='修改';
	    
		$this->_edit();
	}
	
	public function save(){
	    $this->load->model('Model_Article','article');
	    $id=(int)$this->uri->segment(3);
		$_POST['id']=$id;
		if(empty($_POST['title'])){
			$this->ajaxMsg('请填写文章标题',1);
		}		
		$cid=(int)$_POST['cate'];
		if(empty($cid)){
			$this->ajaxMsg('请选择分类',1);
		}
		$this->load->model('Model_Cate','cate');
		$cate=$this->cate->getOne($cid);
		if(empty($cate)){
			$this->ajaxMsg('选择的分类不存在',3);
		}
		$_POST['cate']=$cate['id'];
		$_POST['path']=$cate['path'];
		$_POST['author']=$this->user->name;
	    $this->article->save($_POST);
	    $this->ajaxMsg('保存成功',0,'article/index');
	}
	
	private function _edit(){
		$this->load->helper('ueditor');
		$this->load->model('Model_Cate','cate');
		$this->data['cate']=$this->cate->getList(NULL,'id,name');
		
		$this->load->model('Model_Craft','craft');
		$this->data['craftcount']=$this->craft->countAll();
		
		$this->view('article_add');
	}
	
	//删除单篇文章
	public function del(){
		$this->load->model('Model_Article','article');
		$id = (int)$this->uri->segment(3);
		$this->article->del($id);
	    $this->ajaxMsg('删除成功');
	}
	
	public function batch(){
		$this->load->model('Model_Article','article');
		$action=$_POST['action'];
		$act='';
		$num=0;
		if(isset($_POST['id']) && is_array($_POST['id'])){
			switch($action){
				case 'del':     //批量删除操作
				$num=$this->article->batchdel($_POST['id']);
				$act='删除';
				break;
				case 'state':   //批量修改状态操作
				if(isset($_POST['state']) && is_array($_POST['state']))$num=$this->article->batchstate($_POST['state'],$_POST['id']);
				$act='处理';
				break;
			}
			$this->ajaxMsg("成功{$act}了 $num 条数据");
		}else{
			$this->ajaxMsg("请选择要处理的数据",3);
		}
	}
	
	//草稿箱
	public function craft(){
	    $this->load->model('Model_Craft','craft');
	    $this->data['craft']=$this->craft->listAll();
	    
		$this->view('article_craft');
	}
	
	//保存草稿
	public function craftsave(){
	    $id=$this->uri->segment(3);
	    if(!empty($id)){
	        $_POST['id']=(int)$id;
	    }
	    $this->load->model('Model_Craft','craft');
	    $id=$this->craft->save($_POST);
	    $this->ajaxMsg('草稿自动保存 '.date('Y-m-d H:i:s'),0,NULL,$id);
	}
	
	//删除草稿
	public function craftdel(){
	    $this->load->model('Model_Craft','craft');
	    $id=(int)$this->uri->segment(3);
	    $num=0;
	    if(!empty($id)){
	        $num=$this->craft->del($id);
	    }else if(isset($_POST['id']) && is_array($_POST['id'])){
	        $num=$this->craft->batchdel($_POST['id']);
	    }
	    $this->ajaxMsg("成功删除了 $num 条数据");
	}
	
	//从草稿读取
	public function craftread(){
	    $this->load->model('Model_Craft','craft');
	    $id=(int)$this->uri->segment(3);
	    
	    $data=$this->craft->get($id);
	    $this->data['action']='添加';
	    if(!empty($data)){
	        $this->data['art']=$data['content'];
	        $this->data['action']='保存';
	    }
	    
		$this->_edit();
	}
	
	/*=============分类管理===============*/
	function cate(){
	    $this->load->model('Model_Cate','cate');
	    
	    $this->data['cate']=$this->cate->getList();
	    
		$this->view('article_cate');
	}
	function cateadd(){
	    $this->load->model('Model_Cate','cate');
	    $id=(int)$this->uri->segment(3);
	    
        $this->data['cate']=array(
            'id'=>'',
            'name'=>'',
            'pid'=>$id,
            'sort'=>0,
            'thumb'=>'',
            'detail'=>''
        );
        
	    $this->data['action']='添加';
	    $this->_cateedit();
	}
	function cateedit(){
	    $this->load->model('Model_Cate','cate');
	    $id=(int)$this->uri->segment(3);
	    
        $this->data['cate']=$this->cate->getOne($id);
        $this->data['action']='修改';
	    
		$this->_cateedit();
	}
	private function _cateedit(){
	    $this->data['pcate']=$this->cate->getList(array('pid'=>0));
	
	    $this->view('article_cateedit');
	}
	
	function catedel(){
	    $this->load->model('Model_Cate','cate');
	    $id=(int)$this->uri->segment(3);
	    
	    $this->cate->del($id);
	    $this->ajaxMsg('删除成功');
	}
	
	function catesave(){
		$this->load->model('Model_Cate','cate');
	    $id=$this->uri->segment(3);
	    
	    if(empty($id)){
	        unset($_POST['id']);
	        $this->cate->save($_POST);
	    }else{
	        $_POST['id']=(int)$id;
	        $this->cate->save($_POST);
	    }
	    $this->ajaxMsg('保存成功');
	}
	function catebatch(){
		$this->load->model('Model_Cate','cate');
		if(isset($_POST['sort']) && is_array($_POST['sort'])){
		    $this->cate->savebatch($_POST);
		}
		$this->ajaxMsg('排序保存成功!');
	}
	/*=============分类管理===============*/
	
	
	/*=============标签管理===============*/
	public function tags(){
		$this->load->model('Model_Tags','tags');
		$this->data['tags']=$this->tags->getAllPage($this->uri->segment(3));
		$this->data['page']=$this->tags->showPage(site_url('article/tags'));
		$this->view('article_tags');
	}
	public function tagsbatchadd(){
		$this->view('article_tagsbatchadd');
	}
	public function tagsedit(){
		$this->view('article_tagsedit');
	}
	
	public function tagssave(){
	}
	
	public function tagsdel(){
	}
	
	public function tagsbatch(){
	}
	/*=============标签管理 END===============*/
	
	/*=============评论管理===============*/
	public function comment(){
		$this->load->model('Model_comment','comment');
		$this->data['comment']=$this->comment->getAllPage($this->uri->segment(3));
		$this->data['page']=$this->comment->showPage(site_url('article/comment'));
		$this->view('article_comment');
	}
	
	public function commentedit(){
		$this->view('article_commentreply');
	}
	
	public function commentreply(){
		$this->view('article_commentreply');
	}
	
	public function commentsave(){
		
	}
	
	public function commentdel(){
		
	}
	
	public function commentbatch(){
		
	}
	/*=============评论管理 END===============*/
}

/* End of file blog.php */
