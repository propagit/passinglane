<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passing_model extends CI_Model {
	function all_files_active() {
		$this->db->where('actived',1);
		$this->db->order_by('position','asc');
		$query = $this->db->get('banners');
		return $query->result_array();		
	}
	
	function update_banner_hitcount($banner_id)
	{
		if($banner_id){
			$banner = $this->db->select('id,hit,url')->from('banners')->where('id',$banner_id)->get()->row();
			if($banner){
				$hit_count = $banner->hit + 1;
				$this->db->where('id',$banner_id)->update('banners',array('hit' => $hit_count));
				if(trim($banner->url) != ""){
					redirect(trim($banner->url));
				}else{
					redirect(base_url());		
				}
			}
		}else{
			redirect(base_url());		
		}
		

	}
	
	function update_banner_viewcount($banner_id)
	{
		if($banner_id){
			$banner = $this->db->select('id,view')->from('banners')->where('id',$banner_id)->get()->row();
			if($banner){
				$view_count = $banner->view + 1;
				$this->db->where('id',$banner_id)->update('banners',array('view' => $view_count));
			}
		}
		

	}

}