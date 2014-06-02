<?php
class Order_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function add_order($data)
	{
		$this->db->insert('orders',$data);
		return $this->db->insert_id();	
	}
	
	function add_order_items($data)
	{
		$this->db->insert('order_items',$data);
		return $this->db->insert_id();	
	}
	
	function update_order($order_id,$data)
	{
		$this->db->where('order_id',$order_id)
				 ->update('orders',$data);	
		return $this->db->affected_rows();
	}
	
	function search_order($params = array(),$return_total = false)
	{
		$records_per_page = records_per_page;
		
		$sql = "SELECT * FROM orders 
				WHERE deleted = 'no' ";
		
		//check keyword
		if(isset($params['keyword']) && $params['keyword']){
			//check for numeric before matching it against order id or it will cause the query to fail
			if(is_numeric($params['keyword'])){
				$sql .= " AND order_id = ".$params['keyword'];
			}else{
				$sql .= " AND ( email LIKE '%".$params['keyword']."' 
						  OR delivery_fullname LIKE '%".$params['keyword']."' 
						  )";
			}
		}
		
		//check status
		if(isset($params['order_status']) && $params['order_status']){
			$sql .= " AND order_status = '".$params['order_status']."'";	
		}
		
		//check from date
		if(isset($params['date_from']) && $params['date_from']){
			$sql .= " AND created >= '".date('Y-m-d H:i:s',strtotime($params['date_from'].' 00:00:00'))."'";	
		}
		
		//check to date
		if(isset($params['date_to']) && $params['date_to']){
			$sql .= " AND created <= '".date('Y-m-d H:i:s',strtotime($params['date_to'].' 23:59:59'))."'";
		}
		
		//sort params
		if(isset($params['sort_by']) && $params['sort_by']){
			$sql .= " ORDER BY `".$params['sort_by']."` ";
			$sql .= (isset($params['sort_order']) && $params['sort_order']) ?  $params['sort_order'] : " DESC";
		}else{
			$sql .= " ORDER BY created DESC";	
		}
		
		//if return total is set return all staff and not limit by records per page
		if($return_total){
			return $this->db->query($sql)->result();	
		}
		
		//add limit
		if(isset($params['limit'])){ 
			//if limit is not set it will default start the pagination
			$sql .= " LIMIT " . $params['limit']; 
		}else{
			if(!$return_total && isset($params['current_page'])){
				$sql .= " LIMIT ".(($params['current_page']-1)*$records_per_page)." ,".$records_per_page;
			}
		}
		
		return $this->db->query($sql)->result();	
	}
	
	function get_order($order_id)
	{
		return $this->db->where('order_id',$order_id)
						->get('orders')	
						->row();
			
	}
	
	function get_order_items($order_id)
	{
		return $this->db->where('order_id',$order_id)	
						->get('order_items')
						->result();
	}
	
	
	
}