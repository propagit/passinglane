<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Cart
 * @author: propagate dev team
 *  
 */


// few things to take into consideration before using this class
// the CI default $this->cart->contents() to get all contents is replace by $this->get_cart_contents() to accomodate discount and shipping 
// which is added as cart items


class Cart extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}
	
	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{		
			case 'checkout':
				$this->checkout();
			break;
			
			default:
				$this->main_view();
			break;
		}
	}
	
	function main_view()
	{
		$data['cart_items'] = $this->get_cart_contents();
		$this->load->view('main_view', isset($data) ? $data : NULL);		
	}
	
	function checkout()
	{
		modules::run('auth/is_customer_logged_in');	
		$cart_items = $this->get_cart_contents();
		if(count($cart_items) <= 0){
			redirect('cart');
		}
		$data['cart_items'] = $cart_items;
		$data['total'] = $this->cart->total();

		$this->load->view('checkout', isset($data) ? $data : NULL);	
	}
	
	function cart_contents($quantity_box_enabled = true)
	{
		$data['quantity_box_enabled'] = $quantity_box_enabled;
		$data['cart_items'] = $this->get_cart_contents();
		$data['total'] = $this->cart->total();
		$this->load->view('cart_contents', isset($data) ? $data : NULL);		
	}
	
	function insert_to_cart()
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		
		//the discount_coupon key is set as true if a discount coupon is added
		//the coupon is simply treated as a another cart item  
		
		$product = modules::run('product/get_product',$product_id);
		$data = array(
				 	'id' => $product['id'],
					'qty' => $quantity,
					'price' => ($product['sale_price'] > 0 ? $product['sale_price'] : $product['price']),
					'name' => $product['title'],
					'subtitle' => $product['subtitle'],
					'discount_coupon' => false,
					'shipping' => false,
					'options' => array()
					); 
		//this returns rowid
		return $this->cart->insert($data);
	}

	function cart_has_product()
	{
		$product_id = $this->input->post('product_id');
		$cart_items = $this->get_cart_contents();
		if($cart_items){
			foreach($cart_items as $item){
				if($item['id'] == $product_id){
					return true;	
				}
			}
		}
		return false;
	}
	
	
	function increment_item_quantity($id)
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$cart_items = $this->get_cart_contents();
		if($cart_items){
			foreach($cart_items as $item){
				if($item['id'] == $product_id){
					$rowid = $item['rowid'];
					$cur_quantity = $item['qty'];
					$data = array(
              			 'rowid' => $rowid,
               			 'qty'   => $cur_quantity+$quantity,
           		 	);
					return $this->cart->update($data); 
				}
			}
		}
		return false;	

	}
	
	
	/* *
		shipping
	*/
	function add_shipping()
	{
		//shipping is just a new item that has the key shipping set as true
		
		//when a customer has shipping moudles get shipping details from shipping id and get shipping info else use the default setting or hard coded value
		$shipping_id = $this->input->post('shipping_id');
		
		$shipping = $this->get_default_shippings($shipping_id);
		
		if($shipping){
			$data = array(
						'id' => $shipping['shipping_id'],
						'qty' => $shipping['qty'],
						'price' => $shipping['price'],
						'name' => $shipping['name'],
						'subtitle' => $shipping['subtitle'],
						'discount_coupon' => false,
						'shipping' => true,
						'options' => array()
						); 
			//this returns rowid
			return $this->cart->insert($data);
		}else{
			return false;	
		}
	}
	
	function update_shipping()
	{
		$shipping_id = $this->input->post('shipping_id');
		//get current shipping info that is in the cart
		$shipping = $this->get_shipping_info();	
		//get new shipping info
		$new_shipping = $this->get_default_shippings($shipping_id);
		if($new_shipping){	
			$rowid = $shipping['rowid'];
			
			//if new price is not zero update the shipping
			//else remove shipping by marking the qty as zero
			//since CI does not allow item with zero price to be added to the cart we have to remove the shipping
			if($new_shipping['price']){
				$data = array(
					 'rowid' => $rowid,
					 'id' => $new_shipping['shipping_id'],
					 'qty' => $new_shipping['qty'],
					 'price' => $new_shipping['price'],
					 'name' => $new_shipping['name'],
					 'subtitle' => $new_shipping['subtitle']
				);
			}else{
				$this->remove_shipping();
			}
			return $this->cart->update($data);
		}else{
			return false;	
		}
	}
	
	function get_default_shippings($shipping_id = '')
	{
		$shippings[1] = array(
						'shipping_id' => 'SHP_1',
						'qty' => 1,
						'price' => 0,
						'name' => 'Download Online',
						'subtitle' => 'FREE'
						);
		$shippings[2] = array(
						'shipping_id' => 'SHP_2',
						'qty' => 1,
						'price' => 35,
						'name' => 'Deliver DVD Box Set',
						'subtitle' => 'INC GST'
						);
		if($shipping_id){
			foreach($shippings as $shipping){
				if($shipping['shipping_id'] == $shipping_id){
					return $shipping;	
				}
			}
		}else{
			return $shippings;	
		}
			
	}
	
	function remove_shipping()
	{
		$shipping = $this->get_shipping_info();	
		$rowid = $shipping['rowid'];
		$data = array(
					'rowid' => $rowid,
					'qty' => 0
					);	
		return $this->cart->update($data);
	}
	
	/* *
		loads cart total in a table row 
	*/
	function cart_total_table_row()
	{
		$data['total'] = $this->get_cart_real_total();
		$this->load->view('cart_total_table_row', isset($data) ? $data : NULL);
	}
	
	function get_cart_checkout_options($enable_inputs,$return = true)
	{
		//if enable_inputs is true it shows the input field to add coupon code to get a discount
		//and show the delivery or shipping input
		$data['enable_inputs'] = $enable_inputs;
		$data['discount_amount'] = $this->get_discount_amount();
		$data['cart_gst'] = $this->get_cart_gst();
		$data['cart_subtotal'] = $this->get_cart_subtotal();
		
		//popupate shipping data from backend modules if the system have a shipping modules
		//else load the default one from this class (get_default_shippings())
		$data['shippings'] = $this->get_default_shippings();
		$data['current_shipping'] = $this->get_shipping_info();
		
		if(!$return){
			$this->load->view('cart_checkout_options', isset($data) ? $data : NULL);
		}else{
			return $this->load->view('cart_checkout_options', isset($data) ? $data : NULL);
		}
	}
	
	
	function get_cart_real_total()
	{
		$total = $this->cart->total();
		$discount = $this->get_discount_amount();
		$shipping = $this->get_shipping_amount();
		return $total - ($discount + $shipping);
	}
	
	function get_cart_subtotal()
	{
		$cart_total = $this->get_cart_real_total();
		$cart_gst = $this->get_cart_gst();
		return $cart_total - $cart_gst;
	}
	
	function get_cart_gst()
	{
		$cart_total = $this->get_cart_real_total();
		return round($cart_total * GST,2);	
	}
	
	
	function get_discount_amount()
	{
		$discount_item = $this->get_discount_info();
		if($discount_item){
			return $discount_item['price'];	
		}
		return 0;
	}
	
	function get_discount_info()
	{
		$cart_items = $this->cart->contents();
		if($cart_items){
			foreach($cart_items as $item){
				if(isset($item['discount_coupon']) && $item['discount_coupon']){
					return $item;
				}
			}
		}	
		return false;	
	}
	
	function get_shipping_amount()
	{
		$shipping_item = $this->get_shipping_info();
		if($shipping_item){
			return $shipping_item['price'];	
		}
		return 0;
	}
	
	function get_shipping_info()
	{
		$cart_items = $this->cart->contents();
		if($cart_items){
			foreach($cart_items as $item){
				if(isset($item['shipping']) && $item['shipping']){
					return $item;
				}
			}
		}	
		return false;	
	}
	
	function is_cart_empty()
	{
		if($this->get_cart_contents()){
			return false;	
		}
		return true;
	}
	
	function get_cart_contents()
	{
		$cart_items = $this->cart->contents();
		if($cart_items){
			foreach($cart_items as $key => $val){
				if( (isset($val['discount_coupon']) && $val['discount_coupon']) || (isset($val['shipping']) && $val['shipping'])){
					unset($cart_items[$key]);	
				}
			}
		}
		return $cart_items;
	}	
	
	function destroy_cart()
	{
		$this->cart->destroy();	
	}

	function checkout_stage($checkout_state = checkout_stage_signin)
	{
		$data['checkout_state'] = $checkout_state;
		$this->load->view('checkout_stage', isset($data) ? $data : NULL);			
	}
	
	
	

	
	
}