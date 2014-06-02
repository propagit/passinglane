<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Product controller. 
*	@class_comments 
*	@update required : copy product_model function to adminproduct/models/product_model and use one model for all db operations.
*
*/
 
class Product extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('adminproduct/product_model');
		$this->load->model('adminproduct/category_model');
	}	
	
	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{		
			case 'get_quotes':
				$this->get_quotes();
			break;
			
			case 'product_preview':
				$this->product_preview($param1);
			break;
			
			default:
				$this->products($param1);
			break;
		}
	}
	
	/**
	*	@desc Shows the product overview
	*	
	*	@name products
	*	@access public
	*	@return Loads product overview
	* 
	*/	
	function products($slug = "")
	{
		$product = $this->product_model->get_product_by_link($slug);		
		if(!$product){
			redirect('404');	
		}
		$data['product'] = $product;
		$this->load->view('products_overview', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Loads supporting resource
	*	
	*	@name load_supporting_resource
	*	@access public
	*	@return loads the supporting products or resource in the carousel slider
	* 
	*/	
	function load_supporting_resource($main_product_id)
	{
		$data['carousel_id'] = 'supporting-resources';
		$data['products'] = $this->product_model->get_product_cross_sales($main_product_id);
		$this->load->view('carousel/product_list', isset($data) ? $data : NULL);
	}
	/**
	*	@desc Loads similar resource or products
	*	
	*	@name load_similar_products
	*	@access public
	*	@return loads similar products or resource in the carousel slider, for this particular project it loads the product based on the product_type, the default is set as written in the model
	* 
	*/
	function load_similar_products()
	{
		$data['carousel_id'] = 'similar-resources';
		$data['products'] = $this->product_model->get_similar_products();
		$this->load->view('carousel/product_list', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Loads the view file for carousel slider for a single item
	*	
	*	@name load_product_list_item
	*	@access public
	* 
	*/	
	function load_product_list_item($product)
	{
		$data['product'] = $product;
		$this->load->view('carousel/product_list_item', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Loads product modules in the list format from semi colan separated format in database
	*	
	*	@name load_product_modules
	*	@access public
	* 
	*/		
	function load_product_modules($product_modules)
	{
		$data['product_modules'] = $product_modules;
		$this->load->view('product_modules', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Load hero image
	*	
	*	@name load_product_hero_image
	*	@access public
	*	@return Loads product overview
	* 
	*/	
	function load_product_hero_image($product_id)
	{
		$data['dir'] = md5('mbb'.$product_id);
		$data['hero'] = $this->product_model->get_product_hero_image($product_id);
		$this->load->view('product_hero_image', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Loads thumb hero image 
	*	
	*	@name load_product_hero_thumb_image
	*	@access public
	* 
	*/	
	function load_product_hero_thumb_image($product_id)
	{
		$data['dir'] = md5('mbb'.$product_id);
		$data['hero'] = $this->product_model->get_product_hero_image($product_id);
		$this->load->view('product_hero_thumb_image', isset($data) ? $data : NULL);	
	}
	/**
	*	@desc Shows the product preview for admin
	*	
	*	@name product_preview
	*	@access public
	* 
	*/	
	function product_preview($slug = "")
	{
		$is_admin_logged_in = modules::run('auth/is_admin_logged_in');
		if (!$is_admin_logged_in){
			
				redirect('products');
			
		}
		$data['product'] = $this->product_model->get_product_for_preview($slug);
		$this->load->view('products_overview', isset($data) ? $data : NULL);	
	}
	
	function has_cross_sale($main_product_id)
	{
		$product = $this->product_model->get_product_cross_sales($main_product_id);
		if($product){
			return true;	
		}
		return false;
	}
	
	function load_feature_products()
	{
		$data['feature_products'] = $this->product_model->get_feature_products();
		$this->load->view('feature/feature_products', isset($data) ? $data : NULL);	
	}
	

	function get_quotes()
	{
		$product_id = $this->input->post('product_id');
		$product_link = $this->input->post('product_link');
		$category_link = $this->input->post('category_link');
		$salutation = $this->input->post('salutation');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$companyname = $this->input->post('companyname');
		$position = $this->input->post('position');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zip = $this->input->post('zip');
		$country = $this->input->post('country');
		$phone = $this->input->post('phone');
		$mobile = $this->input->post('mobile');
		$department = $this->input->post('department');
		$message = $this->input->post('message');
		$product = $this->input->post('product');
		
		$msg = "<table>
					<tr>
						<td>Company</td>
						<td>$companyname</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>$salutation $firstname $lastname</td>
					</tr>
					<tr>
						<td>Position</td>
						<td>$position</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>$email</td>
					</tr>
					<tr>
						<td>Street Address</td>
						<td>$address</td>
					</tr>
					<tr>
						<td>City</td>
						<td>$city</td>
					</tr>
					<tr>
						<td>State / County</td>
						<td>$state</td>
					</tr>
					<tr>
						<td>Zip / Postal Code</td>
						<td>$zip</td>
					</tr>
					<tr>
						<td>Country</td>
						<td>$country</td>
					</tr>
					<tr>
						<td>Office Phone</td>
						<td>$phone</td>
					</tr>
					<tr>
						<td>Mobile Phone</td>
						<td>$mobile</td>
					</tr>
					<tr>
						<td>Department</td>
						<td>$department</td>
					</tr>
					<tr>
						<td>Message</td>
						<td>$message</td>
					</tr>
				<table>";
		
		$this->load->library('email');
		$config['mailtype'] = 'html';	
		$this->email->initialize($config);	
		$this->email->from('noreply@wave1.com.au','Get Quote '.$product);		
		
		$this->email->to('raquel@propagate.com.au');
		
		$this->email->subject('Get Quote '.$product);
		$this->email->message($msg);
		$sent = $this->email->send();
		
		$this->session->set_flashdata('quote_success','Thank you for contacting us, we will back to you shortly');		
		redirect('products/'.$category_link.'/'.$product_link);
	}	
	
	function get_product($product_id)
	{
		return $this->product_model->identify($product_id);
	}
	
	
}