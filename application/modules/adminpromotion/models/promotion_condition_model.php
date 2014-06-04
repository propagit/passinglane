<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @model: Promotion_Condition
**/

class Promotion_condition_model extends CI_Model {

    function add_promotion_condition($data) {
        $this->db->insert('promotion_conditions', $data);
        return $this->db->insert_id();
    }

    function get_promotion_conditions($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get('promotion_conditions');
        return $query->result_array();
    }

    function get_promotion_condition($condition_id) {
        $this->db->where('condition_id', $condition_id);
        $query = $this->db->get('promotion_conditions');
        return $query->first_row('array');
    }

    function update_promotion_condition($condition_id, $data) {
        $this->db->where('condition_id', $condition_id);
        return $this->db->update('promotion_conditions', $data);
    }

    function delete_promotion_condition($condition_id) {
        $this->db->where('condition_id', $condition_id);
        return $this->db->delete('promotion_conditions');
    }

    function delete_promotion_conditions($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->delete('promotion_conditions');
    }

    function increase_coupon_usages($condition_id) {
        $condition = $this->get_promotion_condition($condition_id);
        return $this->update_promotion_condition($condition_id, array('actual_usages' => $condition['actual_usages'] + 1));
    }
}
