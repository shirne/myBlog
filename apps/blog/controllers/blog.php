<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

#doc
#    classname:    Blog
#    scope:        PUBLIC
#
#/doc

class Blog extends CI_Controller {
    
    private $modelBlog;
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Model_Blog','blog');
		
		$this->output->enable_profiler(true);
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['site_title']='Welcome to Shirne\'s blog';
		$this->load->view('index', $data);
	}
	
	public function lists(){
	
	}
	
	public function search(){
	
	}
	
	public function tag(){
	
	}
	
	public function view(){
	
	}
	
	public function comment(){
	
	}
}

/* End of file blog.php */
