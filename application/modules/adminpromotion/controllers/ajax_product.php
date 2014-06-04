<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @controller: Ajax_Product
**/

class Ajax_product extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('promotion_condition_model');
    }

    function list_products()
    {
        $condition_id = $this->input->post('condition_id');
        $condition = $this->promotion_condition_model->get_promotion_condition($condition_id);
        $data['products'] = $this->product_model->search_products();
        $data['condition'] = $condition;
        $this->load->view('condition/product/list_view', isset($data) ? $data : NULL);
    }

}
