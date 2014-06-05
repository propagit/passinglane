<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscriber_model extends CI_Model {
	
	function get_subscriber($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('subscribers');
		return $query->first_row('array');
	}
	
	function add($data) {
		$this->db->insert('subscribers',$data);
		return $this->db->insert_id();
	}
	
	function get_all_subscriber() {
		$query = $this->db->get('subscribers');
		return $query->first_row('array');
	}
}