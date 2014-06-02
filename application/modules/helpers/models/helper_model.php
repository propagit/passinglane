<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper_model extends CI_Model {
	
	function get_countries($code = '')
	{
		$sql = "SELECT * 
				FROM countires";
		if($code){
			$sql .= " WHERE code = '".$code."'";
		}
		$sql .= "ORDER BY name ASC";
		
		if($code){
			return $this->db->query($sql)->row();
		}else{
			return $this->db->query($sql)->result();	
		}
		
	}
	
	function get_states($code = '')
	{
		$sql = "SELECT * 
				FROM state";
		if($code){
			$sql .= " WHERE code = '".$code."'";
		}
		$sql .= "ORDER BY name ASC";
		
		if($code){
			return $this->db->query($sql)->row();
		}else{
			return $this->db->query($sql)->result();	
		}
	}
	
}
