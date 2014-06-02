<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @class_name: Order
 * 
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	
	function toggle_delivery_address_fields()
	{
		$toggle_type = $this->input->post('toggle_type');
		echo modules::run('order/load_delivery_details_form',($toggle_type == 'populate' ? true : false));	
	}
	
	
}