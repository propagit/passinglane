<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Customer Controller 
*	@class_comments 
*	
*
*/
 
class Customer extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admincustomer/customer_model');
		$this->load->model('admincustomer/user_model');
	}	
	
	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{
			case 'profile':
				$this->profile();
			break;
			
			case 'orders':
				$this->orders();
			break;
			
			case 'logout':
				$this->logout();
			break;					
					
			default:
				$this->sign_up();
			break;
		}
	}
	
	function sign_up()
	{
		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$data['redirect_after_login_url'] = ($referer == base_url().'cart' ? base_url().'cart/checkout' : base_url().'customer/profile');
		$this->load->view('sign_in_main_view', isset($data) ? $data : NULL);	
	}
	
	function login_form()
	{
		$this->load->view('login_form', isset($data) ? $data : NULL);	
	}
	
	function customer_sign_up_form()
	{
		$data['states'] = modules::run('system/get_states');
		$this->load->view('customer_sign_up_form', isset($data) ? $data : NULL);	
	}
	
	function profile()
	{
		modules::run('auth/is_customer_logged_in');
		$this->load->view('profile/main_view', isset($data) ? $data : NULL);	
	}
	
	function customer_profile_update_form()
	{
		$customer_id = $this->session->userdata('customer_id');
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user_model->id($user_id);
		$data['customer'] = $this->customer_model->identify($customer_id);
		$data['states'] = modules::run('system/get_states');
		$this->load->view('profile/customer_profile_update_form', isset($data) ? $data : NULL);		
	}
	
	function customer_header_info()
	{
		if($this->session->userdata('customer_id')){
			$customer_id = $this->session->userdata('customer_id');
			$data['customer'] = $this->customer_model->identify($customer_id);
		}
		$this->load->view('profile/customer_page_header_info', isset($data) ? $data : NULL);
	}
	
	function logout()
	{
		modules::run('auth/logout_customer');
		redirect(base_url().'customer/sign_in');	
	}
	
	function orders()
	{
		modules::run('auth/is_customer_logged_in');	
		$this->load->view('orders/main_view', isset($data) ? $data : NULL);
	}
	
	function purchased_items()
	{
		modules::run('auth/is_customer_logged_in');	
		$customer_id = $this->session->userdata('customer_id');
		$data['orders'] = $this->customer_model->get_customer_orders($customer_id);
		$this->load->view('orders/purchased_items', isset($data) ? $data : NULL);
	}
	
	function get_customer($customer_id)
	{
		return $this->customer_model->identify($customer_id);	
	}
	



	
	
	
}