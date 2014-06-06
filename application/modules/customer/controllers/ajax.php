<?php

# Controller: Ajax user

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admincustomer/customer_model');
		$this->load->model('admincustomer/user_model');
		$this->load->model('admincustomer/subscriber_model');
	}
		
	function create_new_customer()
	{
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);	
		$email = $this->input->post('email',true);	
		$description = $this->input->post('description',true);
		$description_other = $this->input->post('description_other',true);
		$password = $this->input->post('password',true);	
		//$repassword = $this->input->post('repassword',true);	
		$company = $this->input->post('company',true);	
		$type = $this->input->post('type',true);
		$type_other = $this->input->post('type_other',true);
		$telephone = $this->input->post('telephone',true);	
		$facsimile = $this->input->post('facsimile',true);	
		$address1 = $this->input->post('address1',true);	
		$address2 = $this->input->post('address2',true);
		$country = $this->input->post('country',true);	
		$state = $this->input->post('state',true);	
		$suburb = $this->input->post('suburb',true);	
		$postcode = $this->input->post('postcode',true);	
		
		
		if($this->customer_model->identify_by_email($email)){
			echo 'email exists';exit();	
		}
		
		$data = array(
					'email' => $email,
					'firstname' => $firstname,
					'lastname' => $lastname,
					'type' => $type == 'other' ? $type_other : $type,
					'company' => $company,
					'address' => $address1,
					'address2' => $address2,
					'suburb' => $suburb,
					'state' => $state,
					'country' => $country,
					'postcode' => $postcode,
					'phone' => $telephone,
					'fax' => $facsimile,
					'description' => $description == 'other' ? $description_other : $description,
				);
		$customer_id = $this->customer_model->add($data);
		
		$data_user['customer_id'] = $customer_id;
		$data_user['username'] = $email;
		$data_user['password'] = md5($password);
		$data_user['level'] = 1;
		$data_user['activated'] = 1;
		$user_id = $this->user_model->add($data_user);
		
		$customer['customer_id'] = $customer_id;
		$customer['user_id'] = $user_id;
		$this->session->set_flashdata('profile_created',true);
		modules::run('auth/generate_session_vars',$customer);
		modules::run('customer/send_welcome_email',$customer_id);
		echo 'success';
				
	}
	
	function update_profile()
	{
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);	
		$email = $this->input->post('email',true);	
		$description = $this->input->post('description',true);
		$description_other = $this->input->post('description_other',true);
		$password = $this->input->post('password',true);	
		//$repassword = $this->input->post('repassword',true);	
		$company = $this->input->post('company',true);	
		$type = $this->input->post('type',true);
		$type_other = $this->input->post('type_other',true);
		$telephone = $this->input->post('telephone',true);	
		$facsimile = $this->input->post('facsimile',true);	
		$address1 = $this->input->post('address1',true);	
		$address2 = $this->input->post('address2',true);
		$country = $this->input->post('country',true);	
		$state = $this->input->post('state',true);	
		$suburb = $this->input->post('suburb',true);	
		$postcode = $this->input->post('postcode',true);	
		
		$customer_id = $this->session->userdata('customer_id');
		$user_id = $this->session->userdata('user_id');
		
		$cur_customer = $this->customer_model->identify_by_email($email);
		$valid = true;
		if($cur_customer){
			if($cur_customer['id'] != $customer_id){
				$valid = false;
				echo 'email exists';exit();	
			}
		}
		
		if($valid){
			$data = array(
						'email' => $email,
						'firstname' => $firstname,
						'lastname' => $lastname,
						'type' => $type == 'other' ? $type_other : $type,
						'company' => $company,
						'address' => $address1,
						'address2' => $address2,
						'suburb' => $suburb,
						'state' => $state,
						'country' => $country,
						'postcode' => $postcode,
						'phone' => $telephone,
						'fax' => $facsimile,
						'description' => $description == 'other' ? $description_other : $description,
					);
			$this->customer_model->update($customer_id,$data);
			
			$data_user['customer_id'] = $customer_id;
			$data_user['username'] = $email;
			if($password){
				$data_user['password'] = md5($password);
			}

			$this->user_model->update($user_id,$data_user);
			echo 'success';
		}
				
	}
	
	function login()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$customer = modules::run('auth/validate_user',$data);
		if(count($customer))
		{
			if(modules::run('auth/generate_session_vars',$customer)){
				echo 'success';	
			}else{
				echo 'failed';	
			}
			
		}
		else
		{
			echo 'failed';
		}				

	}
	
	function get_customer_order()
	{
		$params = $this->input->post();
		echo modules::run('customer/purchased_items',$params);	
	}
	
	function add_subscriber()
	{
		$out['status'] = true;
		$out['msg'] = '';
		$input_email = $this->input->post('email');
		$email = trim($input_email);
		//validate email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$out['status'] = false;
			$out['msg'] = 'Invalid email address';
		}else{
			//check if this email address is already in our system
			if($this->subscriber_model->get_subscriber($email)){
				$out['status'] = false;
				$out['msg'] = 'This email already exists in our subscription list';	
			}else{
				//if new email address add to subscription list, if successful
				if($this->subscriber_model->add(array('email' => $email))){
					$out['status'] = true;
					$out['msg'] = 'Subscription successful';
				}else{
					//if subscription unsuccessful
					$out['status'] = false;
					$out['msg'] = 'Subscription failed! Please try again!';	
				}
			}
		}
		
		echo json_encode($out);
	}
	
	function reset_password()
	{
		$out['status'] = true;
		$out['msg'] = '';
		$input_email = $this->input->post('email');
		$email = trim($input_email);
		//validate email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$out['status'] = false;
			$out['msg'] = 'Invalid email address';
		}else{
			//check if customer exists
			$customer = $this->customer_model->identify_by_email($email);
			if($customer){
				$params['customer_id'] = $customer['id'];
				$out['status'] = true;
				$out['msg'] = 'Your new password has been sent to '.$email;
				modules::run('customer/send_password_reset_email',$params);
			}else{
				$out['status'] = false;
				$out['msg'] = 'This email does not exists in our system';	
			}
		}	
		echo json_encode($out);	
	}

}