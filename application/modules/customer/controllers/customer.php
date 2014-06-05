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

			case 'download':
				$this->download($param1,$param2);
			break;

			case 'download_failed':
				$this->download_failed();
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

	function download($order_item_id,$file_id)
	{
		if(modules::run('auth/is_customer_logged_in')){
			$valid = true;
			$this->load->helper('download');
			$customer_id = $this->session->userdata('customer_id');
			$order_item = $this->customer_model->validate_purchase($order_item_id,$customer_id);
			if($order_item){
				//valid order -> proceed with download
				//product_file
				//get product file name
				$product_id = $order_item['product_id'];
				$product_file = modules::run('product/get_product_file',$file_id);
				$dir = md5('mbb'.$product_id); //get the encrypted dir
				$filename = $product_file['file_name'];
				$path = $product_file['file_path'];
				if(file_exists($path)){
					$data = file_get_contents($path); // Read the file's contents
					redirect(base_url().$path);
				}else{
					redirect('customer/download_failed');
				}
			}
		}
	}

	function download_failed()
	{
		$this->load->view('orders/download_failed', isset($data) ? $data : NULL);
	}

	function send_welcome_email($customer_id)
	{
		$customer = $this->customer_model->identify($customer_id);
		$data['customer'] = $customer;
		$message = $this->load->view('emails/welcome', isset($data) ? $data : NULL, true);
		modules::run('email/send_email', array(
			'to' => $customer['email'],
			'from' => 'webmaster@passinglane.com',
			'from_text' => 'Passing Lane',
			'subject' => 'Welcome @ Passing Lane Online Store',
			'message' => $message
		));
	}







}
