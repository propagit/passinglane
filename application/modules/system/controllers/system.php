<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: System
 * @author: propagate dev team
 */

class System extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('system_model');

	}
	
	function get_state_name($state_id)
	{
		return $this->system_model->get_state_name($state_id);
	}
	
	function get_country_name($country_id)
	{
		return $this->system_model->get_country_name($country_id);	
	}
	
	function get_states()
	{
		return $this->system_model->get_states();
	}
	
	function get_state_code($state_id)
	{
		return $this->system_model->get_state_code($state_id);
	}
	
	
}