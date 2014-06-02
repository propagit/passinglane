<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Order Ajax
 * @author: namnd86@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
	}
	
	function search_order()
	{
		$params = $this->input->post();
		$data['orders'] = $this->order_model->search_order($params);
		$data['total_orders'] = $this->order_model->search_order($params,true);
		$data['current_page'] = $this->input->post('current_page',true);
		echo $this->load->view('search_results', isset($data) ? $data : NULL,true);	
	}
	
	function delete_order()
	{
		$order_id = $this->input->post('order_id');
		$affected_rows = 0;
		$out['status'] = true;
		$out['msg'] = '';
		$affected_rows = $this->order_model->update_order($order_id,array('deleted' => 'yes'));
		if($affected_rows <= 0){
			$out['status'] = false;	
			$out['msg'] = 'Deletion Failed! Please try again!';
		}
		echo json_encode($out);
	}
	
	function update_order_status()
	{
		$order_id = $this->input->post('order_id');
		$status = $this->input->post('status');
		$order_data = array('order_status' => $status);
		if ($status == "paid") {
			$order_data['paid_on'] = date('Y-m-d H:i:s');
		}
		$this->order_model->update_order($order_id, $order_data);
		$data['status'] = $status;
		$data['order_id'] = $order_id;
		$this->load->view('order_status', isset($data) ? $data : NULL);
	}
	
}