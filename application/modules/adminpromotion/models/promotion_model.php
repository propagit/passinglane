<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @model: Promotion
**/

class Promotion_model extends CI_Model {

    function create_promotion($data) {
        $this->db->insert('promotions', $data);
        return $this->db->insert_id();
    }

    function get_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get('promotions');
        return $query->first_row('array');
    }

    function update_promotion($promotion_id, $data) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->update('promotions', $data);
    }

    function search_promotions($params) {
        $query = $this->db->get('promotions');
        return $query->result_array();
    }

    function delete_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->delete('promotions');
    }
}
