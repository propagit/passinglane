<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @model: Product
**/

class Product_model extends CI_Model {

    function search_products($params = array()) {
        $this->db->where('deleted', 0);
        $this->db->order_by('title', 'asc');
        $query = $this->db->get('products');
        return $query->result_array();
    }
}
