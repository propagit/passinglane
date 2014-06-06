<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Order
 * @author: propagate dev team
 */


class Order extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		modules::run('auth/is_customer_logged_in');
		$this->load->model('adminorder/order_model');
		$this->load->model('adminpromotion/promotion_condition_model');
	}

	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{
			case 'successful':
				$this->successful();
			break;
			case 'failed':
					$this->failed();
				break;
			case 'process_order':
				$this->process_order();
			break;
			case 'payment':
				$this->payment();
			break;
			case 'test':
				$this->test();
			break;
		}
	}

	function payment()
	{
		$this->load->view('payment', isset($data) ? $data : NULL);
	}

	function load_delivery_details_form($pre_filled = false)
	{
		$data['states'] = modules::run('system/get_states');
		$data['customer'] = array();
		if($pre_filled){
			$customer_id = $this->session->userdata('customer_id');
			$data['customer'] = modules::run('customer/get_customer',$customer_id);
		}
		$this->load->view('delivery_details_form', isset($data) ? $data : NULL);
	}

	function load_payment_details_form()
	{
		$customer_id = $this->session->userdata('customer_id');
		$data['customer'] = modules::run('customer/get_customer',$customer_id);
		$this->load->view('payment_details_form', isset($data) ? $data : NULL);
	}

	/* *
		Payment process control flow and logic
			-> frontend gets directed to this controller process_payment
				-> add order, set status as processing - [orders table]
					-> when completed add order items - [ order_items table]
					-> when completed passes the control back to process_payment
			-> process payment
				-> if successful update order status to success
					-> send confirmation email
					-> notify admin etc
	*/
	function process_order()
	{
		if(modules::run('cart/is_cart_empty')){
			redirect('cart');
		}
		$order_id = modules::run('order/add_order');
		$order_successful = false;
		if($order_id){
			//process payment
			#$payment = modules::run('order/process_payment');
			$payment_type = $this->input->post('payment_type',true);

			if ($payment_type == 'trading') {
				$this->order_model->update_order($order_id,array('order_status' => 'not paid'));
				$this->promotion_condition_model->increase_coupon_usages($this->session->userdata('condition_id'));
				modules::run('cart/destroy_cart');
				redirect('order/successful');
			}

			$customer_id = $this->session->userdata('customer_id');
			$customer = modules::run('customer/get_customer',$customer_id);

			$card_name = $this->input->post('ccname',true);
			$card_number = $this->input->post('ccnumber',true);
			$expiry_month = $this->input->post('expiry_month',true);
			$expiry_year = $this->input->post('expiry_year',true);
			$cvv = $this->input->post('cvv',true);


			$total = modules::run('cart/get_cart_real_total');
			#$payment = $this->process_eWay($order_id,$customer['firstname'],$customer['lastname'],$customer['email'],$customer['address'],$customer['postcode'],$card_name,$card_number,$expiry_month,$expiry_year,$cvv,$total);

			$payment = $this->process_cmwBank($order_id, $order_id, $total, $card_number, $expiry_month, $expiry_year, $cvv);

			if($payment['txnResponseCode'] == '0'){
				$this->order_model->update_order($order_id,array('order_status' => 'success'));
				$this->promotion_condition_model->increase_coupon_usages($this->session->userdata('condition_id'));
				modules::run('cart/destroy_cart');
				$order_successful = true;
			} else {
				$this->session->set_userdata('order_error_msg', $payment["message"]);
				$this->order_model->update_order($order_id,array('order_status' => 'failed'));
			}
		}
		if($order_successful){
			//send order confirmation to customer
			$this->send_order_confirmation($order_id);
			//send order notification to admin
			$this->send_order_notification($order_id);
			redirect('order/successful');
		}else{
			redirect('order/failed');
		}
	}

	function test() {
		$a = $this->process_cmwBank('testrf','testinfo',1.00,'4987654321098769','5','17','123');
		var_dump($a);
	}

	function process_cmwBank($reference, $order_info, $amount, $card_number, $expmonth, $expyear, $ccv) {
		$amount = $amount * 100; # Convert to cents
		$exp = $expyear . str_pad($expmonth, 2, "0", STR_PAD_LEFT);
		$this->load->model('cmwbank_model');
		$this->cmwbank_model->init();
		$this->cmwbank_model->add_data('vpc_MerchTxnRef', $reference);
		$this->cmwbank_model->add_data('vpc_OrderInfo', $order_info);
		$this->cmwbank_model->add_data('vpc_Amount', $amount);
		$this->cmwbank_model->add_data('vpc_CardNum', $card_number);
		$this->cmwbank_model->add_data('vpc_CardExp', $exp);
		$this->cmwbank_model->add_data('vpc_CardSecurityCode', $ccv);
		return $this->cmwbank_model->process();
	}

	function process_eWay($order_id,$firstname,$lastname,$email,$address,$postcode,$cardname,$cardnumber,$expmonth,$expyear,$cvv,$total) {
		# Payment config
		$total = 1000;
		$eWAY_CustomerID = "87654321"; // eWAY Customer ID
		#$eWAY_CustomerID = "12229578"; // eWAY Propagate
		$eWAY_PaymentMethod = 'REAL_TIME_CVN'; // payment gatway to use (REAL_TIME, REAL_TIME_CVN or GEO_IP_ANTI_FRAUD)
		$eWAY_UseLive = false; // true to use the live gateway

		$this->load->model('Eway_model');
		$this->Eway_model->init($eWAY_CustomerID, $eWAY_PaymentMethod, $eWAY_UseLive);

		# Set the payment details
		$this->Eway_model->setTransactionData("TotalAmount", $total); //mandatory field
		$this->Eway_model->setTransactionData("CustomerFirstName", $firstname);
		$this->Eway_model->setTransactionData("CustomerLastName", $lastname);
		$this->Eway_model->setTransactionData("CustomerEmail", $email);
		$this->Eway_model->setTransactionData("CustomerAddress", $address);
		$this->Eway_model->setTransactionData("CustomerPostcode", $postcode);
		$this->Eway_model->setTransactionData("CustomerInvoiceDescription", "PassingLane");
		$this->Eway_model->setTransactionData("CustomerInvoiceRef", "INV" . $order_id); # Order reference
		$this->Eway_model->setTransactionData("CardHoldersName", $cardname); # mandatory field
		$this->Eway_model->setTransactionData("CardNumber", $cardnumber); # mandatory field
		$this->Eway_model->setTransactionData("CardExpiryMonth", $expmonth); # mandatory field
		$this->Eway_model->setTransactionData("CardExpiryYear", $expyear); # mandatory field
		$this->Eway_model->setTransactionData("TrxnNumber", "TRXN".$order_id);
		$this->Eway_model->setTransactionData("Option1", "");
		$this->Eway_model->setTransactionData("Option2", "");
		$this->Eway_model->setTransactionData("Option3", "");
		$this->Eway_model->setTransactionData("CVN", $cvv);
		$this->Eway_model->setCurlPreferences(CURLOPT_SSL_VERIFYPEER, 0); // Require for Windows hosting

		$ewayResponseFields = $this->Eway_model->doPayment();


		if (strtolower($ewayResponseFields["EWAYTRXNSTATUS"])=="false") {
			$this->session->set_userdata('eway_msg', $ewayResponseFields["EWAYTRXNERROR"]);
			return false;
		}

		else if (strtolower($ewayResponseFields["EWAYTRXNSTATUS"])=="true") {
			return true;
		}
		else {
			print "Error: An invalid response was recieved from the payment gateway.";
			return false;
		}
	}

	function successful()
	{
		$this->load->view('successful', isset($data) ? $data : NULL);
	}

	function failed()
	{
		$this->load->view('failed', isset($data) ? $data : NULL);
	}

	function add_order()
	{
		$shipping = modules::run('cart/get_shipping_info');
		$discount = modules::run('cart/get_discount_info');
		$discount_amount = modules::run('cart/get_discount_amount');
		$tax = modules::run('cart/get_cart_gst');
		$subtotal = modules::run('cart/get_cart_subtotal');
		$total = modules::run('cart/get_cart_real_total');


		$customer_id = $this->session->userdata('customer_id');
		$customer = modules::run('customer/get_customer',$customer_id);

		$delivery_name = $this->input->post('delivery_name',true);
		$telephone = $this->input->post('telephone',true);
		$address1 = $this->input->post('address1',true);
		$address2 = $this->input->post('address2',true);
		$country_id = $this->input->post('country',true);
		$state_id = $this->input->post('state',true);
		$suburb = $this->input->post('suburb',true);
		$postcode = $this->input->post('postcode',true);



		$card_name = '';
		$card_number = '';
		$expiry_month = '';
		$expiry_year = '';
		$cvv = '';
		$cc_lastfour = '';
		$payment_type = $this->input->post('payment_type',true);
		if ($payment_type == "cc")
		{
			$card_name = $this->input->post('ccname',true);
			$card_number = $this->input->post('ccnumber',true);
			$expiry_month = $this->input->post('expiry_month',true);
			$expiry_year = $this->input->post('expiry_year',true);
			$cvv = $this->input->post('cvv',true);
			$cc_lastfour = '****'.substr($card_number,-4,4);
		}




		$order_data = array(
							'customer_id' => $customer['id'],
							'firstname' => $customer['firstname'],
							'lastname' => $customer['lastname'],
							'delivery_fullname' => $delivery_name,
							'email' => $customer['email'],
							'phone' => $telephone,
							'address1' => $address1,
							'address2' => $address2,
							'country_id' => $country_id,
							'country_name' => modules::run('system/get_country_name',$country_id),
							'state_id' => $state_id,
							'state_name' => modules::run('system/get_country_name',$state_id),
							'state_code' => modules::run('system/get_state_code',$state_id),
							'suburb' => $suburb,
							'postcode' => $postcode,
							'payment_type' => $payment_type,
							'card_number' => $cc_lastfour,
							'card_name' => $card_name,
							'order_status' => 'not paid',
							'subtotal' => $subtotal,
							'total' => $total,
							'tax' => $tax,
							'discount' => $discount_amount,
							'coupon_code' => $this->session->userdata('coupon'),
							'shipping_cost' => (isset($shipping) ? $shipping['price'] : 0)
							);
		$order_id = $this->order_model->add_order($order_data);
		if(modules::run('order/add_order_items',$order_id)){
			return $order_id;
		}else{
			return false;
		}
	}

	function add_order_items($order_id)
	{
		$count = 0;
		$today = date('Y-m-d');
		if($order_id){
			$cart_items = modules::run('cart/get_cart_contents');
			if($cart_items){
				foreach($cart_items as $item){
					$order_items = array(
										'order_id' => $order_id,
										'product_id' => $item['id'],
										'product_name' => $item['name'],
										'product_subtitle' => $item['subtitle'],
										'quantity' => $item['qty'],
										'price' => $item['price'],
										'attributes' => json_encode($item['options']),
										'reg_expiry' => date('Y-m-d',strtotime('+3 years',$today))
										);
					if($this->order_model->add_order_items($order_items)){
						$count++;
					}
				}
			}
		}
		return $count;
	}

	function process_payment()
	{
		$card_name = $this->input->post('ccname',true);
		$card_number = $this->input->post('ccnumber',true);
		$expiry_month = $this->input->post('expiry_month',true);
		$expiry_year = $this->input->post('expiry_year',true);
		$cvv = $this->input->post('cvv',true);

		return true;
	}

	function send_order_notification($order_id)
	{
		$order = $this->order_model->get_order($order_id);
		$data['order'] = $order;
		$message = $this->load->view('emails/order_notification', isset($data) ? $data : NULL, true);
		modules::run('email/send_email', array(
			'to' => 'team@propagate.com.au',
			'cc' => 'robintl@bigpond.com',
			#'to' => 'kaushtuvgurung@gmail.com',
			'from' => 'webmaster@passinglane.com',
			'from_text' => 'Passing Lane',
			'subject' => 'Order Notification',
			'message' => $message,
			'attachment' => modules::run('adminorder/download',$order_id,true)
		));
	}

	function send_order_confirmation($order_id)
	{
		$order = $this->order_model->get_order($order_id);
		$data['order'] = $order;
		$message = $this->load->view('emails/order_confirmation', isset($data) ? $data : NULL, true);
		modules::run('email/send_email', array(
			'to' => $order->email,
			#'to' => 'kaushtuvgurung@gmail.com',
			'from' => 'webmaster@passinglane.com',
			'from_text' => 'Passing Lane',
			'subject' => 'Order Confirmation',
			'message' => $message,
			'attachment' => modules::run('adminorder/download',$order_id,true)
		));
	}






}
