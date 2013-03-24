<?php
/**
 * 单页管理
 */
class Page extends MB_Controller
{
	function __cnstruct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->view('page');
	}
	
	function add()
	{
		$this->_edit();
	}
	
	function edit()
	{
		$this->_edit();
	}
	
	function save(){
	}
	
	function bat(){
	}
	
	function craft(){
		$this->view('page_craft');
	}
	
	function craftread(){
		$this->_edit();
	}
	
	private function _edit()
	{
		$this->view('page_edit');
	}
	
}