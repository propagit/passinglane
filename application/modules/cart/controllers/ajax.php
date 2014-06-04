<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @class_name: Cart
 *
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('adminproduct/product_model');
		$this->load->model('adminpromotion/promotion_model');
		$this->load->model('adminpromotion/promotion_condition_model');
	}

	function add_to_cart()
	{
		$out['status'] = false;
		//if cart already has this product increase the quantity by given quantity
		//this is not a udate process but simply an increment of the quantity
		if(modules::run('cart/cart_has_product')){
			$rowid = modules::run('cart/increment_item_quantity');
		//else add new item to the cart
		}else{
			$rowid = modules::run('cart/insert_to_cart');
		}

		if($rowid){
			$out['status'] = true;
		}

		echo json_encode($out);
	}

	function get_item_count()
	{
		$out['total_items'] = count(modules::run('cart/get_cart_contents'));
		echo json_encode($out);
	}

	function remove_cart_item()
	{
		$out['status'] = false;
		//to remove the cart item from the cart set the qty to zero
		$rowid = $this->input->post('rowid');
		$data = array(
					'rowid' => $rowid,
					'qty' => 0
					);
		if($this->cart->update($data)){
			//check if cart is empty after removing an item
			//remove shipping and any discount associated with it
			if(!count(modules::run('cart/get_cart_contents'))){
				$this->cart->destroy();
			}
			$out['status'] = true;
		}
		echo json_encode($out);
	}

	function update_cart()
	{
		$out['status'] = false;
		$data = $this->input->post('data');
		if(isset($data) && count($data) > 0){
			foreach($data as $key => $val){
				$cart_data['rowid'] = $key;
				$cart_data['qty'] = $val;
				$this->cart->update($cart_data);
			}
			$out['status'] = true;
		}
		echo json_encode($out);
	}

	function get_total()
	{
		$total = $this->cart->total();
		$out['is_empty'] = $total > 0 ? false : true;
		$out['total'] = '$'.money_format('%i',$total);
		echo json_encode($out);
	}

	function add_coupon()
	{
		$coupon = $this->input->post('coupon');
		$promotions = $this->promotion_model->get_cart_promotions();
		foreach($promotions as $promotion)
		{
			$conditions = $this->promotion_condition_model->get_promotion_conditions($promotion['promotion_id']);
			if (count($conditions) > 0)
			{
				foreach($conditions as $condition)
				{
					if ($condition['condition_type'] == 'coupon')
					{
						if ($condition['value'] == $coupon)
						{
							$this->session->set_userdata('coupon', $this->input->post('coupon'));
							$this->session->set_userdata('condition_id', $condition['condition_id']);
							echo 'true';
							return;
						}
					}
				}
			}
		}
		echo 'false';
	}

	function get_cart_checkout_options()
	{
		$show_discount_input = $this->input->post('show_discount_input');
		$out['html'] = modules::run('cart/get_cart_checkout_options',$show_discount_input);
		echo json_encode($out);
	}

	function update_shipping()
	{
		$out['status'] = false;
		//if cart has shipping info update it else add new shipping info
		if(modules::run('cart/get_shipping_info')){
			$rowid = modules::run('cart/update_shipping');
		//else add new item to the cart
		}else{
			$rowid = modules::run('cart/add_shipping');
		}

		if($rowid){
			$out['status'] = true;
		}

		//echo print_r($this->cart->contents());exit();
		echo json_encode($out);
	}



}
