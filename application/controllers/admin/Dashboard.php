<?php

class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		
		if($this->auth->check_access('Orders'))
		{
			redirect($this->config->item('admin_folder').'/orders');
		}
		$this->load->helper('date');
		$this->lang->load('dashboard');
	}
	
	function index()
	{	
		$data['page_title']	=  lang('dashboard');	
		$this->load->view($this->config->item('admin_folder').'/dashboard', $data);
	}
}