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

    function get_product($product_id) {
        $this->db->where('id', $product_id);
        $query = $this->db->get('products');
        return $query->first_row('array');
    }

    function update_product($product_id, $data) {
        $this->db->where('id', $product_id);
        return $this->db->update('products', $data);
    }

    function reset_product_sale_price() {
        return $this->db->update('products', array('sale_price' => 0));
    }
}
