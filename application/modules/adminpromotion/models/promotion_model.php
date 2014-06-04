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
        if (isset($params['keyword']) && $params['keyword'] != '') {
            $this->db->like('name', $params['keyword']);
        }
        if (isset($params['status']) && $params['status'] != '') {
            $this->db->like('status', $params['status']);
        }
        if (isset($params['date_from']) && $params['date_from'] != '') {
            $date_from = date('Y-m-d', strtotime($params['date_from']));
            $where = "(valid_period = 0 OR (valid_period = 1 AND (date_from >= '$date_from' OR date_to >= '$date_from')))";
            $this->db->where($where);
        }
        if (isset($params['date_to']) && $params['date_to'] != '') {
            $date_to = date('Y-m-d', strtotime($params['date_to']));
            $where = "(valid_period = 0 OR (valid_period = 1 AND (date_from <= '$date_to' OR date_to <= '$date_to')))";
            $this->db->where($where);
        }
        $query = $this->db->get('promotions');
        return $query->result_array();
    }

    function delete_promotion($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        return $this->db->delete('promotions');
    }



    function get_cart_promotions() {
        $today = date('Y-m-d');
        $sql = "SELECT *
                FROM promotions
                WHERE status = 1
                AND promotion_type = 'cart'
                AND (valid_period = 0 OR (valid_period = 1 AND
                    date_from <= '$today' AND date_to >= '$today'))";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
