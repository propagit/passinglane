<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @controller: AdminPromotion
**/

class AdminPromotion extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('promotion_model');
    }

    function index($method, $param='')
    {
        switch($method)
        {
            case 'create': $this->create_view();
                break;
            case 'edit': $this->edit_view($param);
                break;
            default: $this->main_view();
                break;
        }
    }

    function main_view()
    {
        $this->load->view('main_view');
    }

    function create_view() {
        $this->load->view('create_view');
    }

    function edit_view($promotion_id)
    {
        $promotion = $this->promotion_model->get_promotion($promotion_id);
        if (!$promotion)
        {
            redirect('admin/promotion');
        }
        $data['promotion'] = $promotion;
        $this->load->view('edit_view', isset($data) ? $data : NULL);
    }
}
