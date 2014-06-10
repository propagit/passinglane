<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ajax extends MX_Controller {

    function __construct()
    {
        parent::__construct();
    }


    function submit_contact_form()
    {
        $input = $this->input->post();
        if (!$input['name']) {
            echo json_encode(array('ok' => false, 'error_id' => 'name'));
            return;
        }
        $this->load->helper('email');
        if (!$input['email'] || !valid_email($input['email'])) {
            echo json_encode(array('ok' => false, 'error_id' => 'email'));
            return;
        }
        if (!$input['message']) {
            echo json_encode(array('ok' => false, 'error_id' => 'message'));
            return;
        }

        modules::run('email/send_email', array(
            'to' => 'nam@propagate.com.au',
            'from' => $input['email'],
            'from_text' =>  $input['name'],
            'subject' => 'Website Contact Form',
            'message' => $input['message']
        ));
        echo json_encode(array('ok' => true));
    }

}
