<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {

	function get_countries() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('countries');
		return $query->result_array();
	}

	function get_states() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('state');
		return $query->result_array();
	}

	function get_country_name($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('countries');
		$result = $query->first_row('array');
		return ($result) ? $result['name'] : '';
	}

	function get_state_name($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('state');
		$result = $query->first_row('array');
		return ($result) ? $result['name'] : '';
	}

	function get_state_code($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('state');
		$result = $query->first_row('array');
		return ($result) ? $result['code'] : '';
	}


}
