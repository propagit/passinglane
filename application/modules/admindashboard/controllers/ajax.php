<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Dashboard Ajax
 * @author: propagate dev team
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('dashboard_model');
	}
	
	
	function get_web_stats()
	{
		echo $this->dashboard_model->get_webstat();	
	}
	
	function get_customer_stats()
	{
		echo $this->dashboard_model->get_customer_stats();	
	}
	
	function get_products_stats()
	{
		echo $this->dashboard_model->get_products_stats();	
	}
	
	function get_pages_stats()
	{
		echo $this->dashboard_model->get_pages_stats();	
	}
	
	function get_articles_stats()
	{
		echo $this->dashboard_model->get_articles_stats();	
	}
	
	function get_galleries_stats()
	{
		echo $this->dashboard_model->get_galleries_stats();	
	}
	
	function get_dash_modules()
	{
		echo $this->dashboard_model->generate_dashboard_lists();	
	}
	
	function get_sales_stats()
	{
		$today = date('Y-m-d');
		$month = date('m');
		$year = date('Y');
		$weekday = date('N');
		//weekday 1 = monday; 7  = sunday
		if($weekday == 1){
			$monday = $today;
		}else{
			$monday = date('Y-m-d',strtotime('last monday'));		
		}
		
		$out['sales_today'] = $this->dashboard_model->get_todays_sales($today);
		$out['today_failed_sales'] = $this->dashboard_model->get_todays_failed_sales($today);
		$out['sales_week'] = $this->dashboard_model->get_week_sales($monday);
		$out['week_failed_sales'] = $this->dashboard_model->get_week_failed_sales($monday);
		$out['sales_month'] = $this->dashboard_model->get_month_sales($year,$month);
		$out['sales_year'] = $this->dashboard_model->get_year_sales($year,$month);
		
		echo json_encode($out);
	}
	
}