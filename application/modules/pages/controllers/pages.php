<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Page controller.
*	@class_comments
*
*
*/

class Pages extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}

	function index($method='', $param='')
	{
		switch($param)
		{
			case 'Resources':
				$this->resources_landing_page();
				break;
			case 'Products':
				$this->products_landing_page();
			default:
				$this->page($param);
			break;
		}
	}


	function company()
	{
		$this->load->view('company', isset($data) ? $data : NULL);
	}

	function page($id_title)
	{
		$page = $this->page_model->get_page_by_link($id_title);
		$page->content = str_replace('[contact-form]', $this->contact_form(), $page->content);

		$data['page'] = $page;
		if($page->right_bar == 1)
		{
			$this->load->view('page', isset($data) ? $data : NULL);
		}
		else
		{
			$this->load->view('page', isset($data) ? $data : NULL);
		}

	}

	function contact_form()
	{
		return $this->load->view('contact_form', isset($data) ? $data : NULL, true);
	}

	function resources_landing_page()
	{
		$this->load->model('adminproduct/product_model');
		$data['products'] = $this->product_model->get_similar_products('written');
		$this->load->view('product_landing_page', isset($data) ? $data : NULL);
	}

	function products_landing_page()
	{
		$this->load->model('adminproduct/product_model');
		$data['products'] = $this->product_model->get_similar_products('video');
		$this->load->view('product_landing_page', isset($data) ? $data : NULL);
	}

}
