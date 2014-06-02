<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passing extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('passing_model');
	}
	

	function index($method='', $param='')
	{
		switch($method)
		{
			case 'page':
				$this->page($param);
			break;
			case 'link':
				$this->link($param);
			break;
			default:
				$this->home();
			break;
		}
	}
	
	function home()
	{
		$data['banners'] = $this->passing_model->all_files_active();
		$this->load->view('home', isset($data) ? $data : NULL);
	}
	
	function page()
	{
		$this->load->view('pages/page', isset($data) ? $data : NULL);
	}

	function link($banner_id = '')
	{
		if($banner_id){
			$banner = $this->passing_model->update_banner_hitcount($banner_id);
		}else{
			redirect(base_url());	
		}
	}
	
	
	
}