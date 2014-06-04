<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @module: AdminPromotion
*   @controller: Ajax
**/

class Ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('promotion_model');
        $this->load->model('promotion_condition_model');
    }

    function create_promotion()
    {
        $input = $this->input->post();
        if (!$input['name'])
        {
            echo json_encode(array('ok' => false, 'error_id' => 'name'));
        }
        $data = array(
                'promotion_type' => $input['promotion_type'],
                'name' => $input['name'],
                'description' => $input['description'],
                'discount_type' => $input['discount_type'],
                'discount_value' => $input['discount_value'][$input['discount_type']],
                'status' => $input['status'],
                'valid_period' => 0,
                'date_from' => '',
                'date_to' => ''
            );
        if (isset($input['valid_period']))
        {
            $data['valid_period'] = 1;
            $data['date_from'] = date('Y-m-d', strtotime($input['date_from']));
            $data['date_to'] = date('Y-m-d', strtotime($input['date_to']));
        }

        $promotion_id = $this->promotion_model->create_promotion($data);
        echo $promotion_id;
    }

    function update_promotion()
    {
        $input = $this->input->post();

        $data = array(
                'promotion_type' => $input['promotion_type'],
                'name' => $input['name'],
                'description' => $input['description'],
                'discount_type' => $input['discount_type'],
                'discount_value' => $input['discount_value'][$input['discount_type']],
                'status' => $input['status'],
                'valid_period' => 0,
                'date_from' => '',
                'date_to' => ''
            );

        if (isset($input['valid_period']))
        {
            $data['valid_period'] = 1;
            $data['date_from'] = date('Y-m-d', strtotime($input['date_from']));
            $data['date_to'] = date('Y-m-d', strtotime($input['date_to']));
        }
        $this->product_model->reset_product_sale_price();
        if (isset($input['conditions']))
        {
            $conditions = $input['conditions'];
            foreach($conditions as $condition_id => $value)
            {
                if (is_array($value)) # condition_type: product
                {
                    foreach($value as $product_id)
                    {
                        $product = $this->product_model->get_product($product_id);
                        $price = $product['price'];
                        $discount_value = $data['discount_value'];
                        if ($data['discount_type'] == 'percentage')
                        {
                            $discount_value = $product['price'] * $discount_value / 100;
                        }
                        $sale_price = $product['price'] - $discount_value;
                        $this->product_model->update_product($product_id, array('sale_price' => $sale_price));
                    }
                    $value = serialize($value);
                }
                $this->promotion_condition_model->update_promotion_condition($condition_id, array('value' => $value));
            }
        }

        if($this->promotion_model->update_promotion($input['promotion_id'], $data))
        {
            echo 'true';
        }
        else
        {
            echo 'false';
        }
    }

    function search_promotions()
    {
        $input = $this->input->post();
        $data['promotions'] = $this->promotion_model->search_promotions($input);
        $this->load->view('list_view', isset($data) ? $data : NULL);
    }

    function delete_promotion()
    {
        $promotion_id = $this->input->post('promotion_id');
        # Delete condition
        $this->promotion_condition_model->delete_promotion_conditions($promotion_id);
        # Delete promotion
        $this->promotion_model->delete_promotion($promotion_id);
    }

    function add_condition()
    {
        $input = $this->input->post();
        $promotion_condition_id = $this->promotion_condition_model->add_promotion_condition($input);
    }

    function list_conditions()
    {
        $conditions = $this->promotion_condition_model->get_promotion_conditions($this->input->post('promotion_id'));

        foreach($conditions as $condition)
        {
            $data['condition'] = $condition;
            $this->load->view('condition/' . $condition['condition_type'] . '_view', isset($data) ? $data : NULL);
        }
    }

    function delete_condition()
    {
        $condition_id = $this->input->post('condition_id');
        $this->promotion_condition_model->delete_promotion_condition($condition_id);
    }

    function reset_conditions()
    {
        $this->update_promotion();
        $promotion_id = $this->input->post('promotion_id');
        $this->promotion_condition_model->delete_promotion_conditions($promotion_id);
    }
}
