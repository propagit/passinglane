<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Adminorder
 * @author: namnd86@gmail.com
 */

class Adminorder extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
	}
	
	public function index($method='', $param='' ,$param2='')
	{
		switch($method)
		{	
			case 'view_order':
				$this->view_order($param);
			break;	
			case 'download':
					$this->download($param);
				break;
			case 'test':
					$this->test();
				break;
			default:
				$this->main_view();
			break;
		}
	}
	
	function main_view()
	{
		$this->load->view('main_view', isset($data) ? $data : NULL);
	}
	
	function search_form()
	{
		$this->load->view('search_form', isset($data) ? $data : NULL);	
	}
	
	function search_results($params = '')
	{
		$data['orders'] = $this->order_model->search_order($params);
		$this->load->view('search_results', isset($data) ? $data : NULL);	
	}
	
	function view_order($order_id)
	{
		$data['order_id'] = $order_id;
		$this->load->view('view_order', isset($data) ? $data : NULL);	
	}
	
	function tax_invoice($order_id)
	{
		$data['order'] = $this->order_model->get_order($order_id);
		$this->load->view('invoice/main_view', isset($data) ? $data : NULL);
	}
	
	function invoice_company_details()
	{
		$this->load->view('invoice/company_info', isset($data) ? $data : NULL);		
	}
	
	function invoice_items($order_id)
	{
		$data['order_items'] = $this->order_model->get_order_items($order_id);
		$this->load->view('invoice/invoice_items', isset($data) ? $data : NULL);		
	}
	
	function test()
	{
		$this->send_order_notification(23);
	}
	
	function send_order_notification($order_id)
	{
		$message = $this->load->view('email/order_notification', isset($data) ? $data : NULL, true);
		modules::run('email/send_email', array(
			'to' => 'kaushtuvgurung@gmail.com.au',
			'from' => 'webmaster@passinglane.com',
			'from_text' => 'Passing Lane',
			'subject' => 'Order Notification',
			'message' => $message
		));
	}
	
	function download($order_id,$return_path = false)
	{
		# As PDF creation takes a bit of memory, we're saving the created file in /uploads/pdf/
		$filename = "order_" . $order_id;
		$site_path = './';
		$upload_path = $site_path . 'uploads';
		if(!file_exists($upload_path .'/orders/'.$filename.'.pdf')){
			$pdfFilePath = $upload_path ."/orders/$filename.pdf";
			
			$dir = $upload_path .'/orders/';
			if(!is_dir($dir))
			{
			  mkdir($dir);
			  chmod($dir,0777);
			  $fp = fopen($dir.'/index.html', 'w');
			  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
			  fclose($fp);
			}
			 
			ini_set('memory_limit','128M'); # boost the memory limit if it's low 
			$data['order_id'] = $order_id;
			$data['order'] = $this->order_model->get_order($order_id);
			$data['order_items'] = $this->order_model->get_order_items($order_id);
			$html = $this->load->view('invoice/download_view', isset($data) ? $data : NULL, true); 
	
					
			$this->load->library('pdf');
			$pdf = $this->pdf->load(); 			
			$stylesheet = file_get_contents('./assets/backend-assets/css/backend.css');
			//echo $html;exit();
			$pdf->WriteHTML($stylesheet,1);
			$pdf->WriteHTML($html,2);
			$pdf->Output($pdfFilePath, 'F'); // save to file 
			#var_dump($html); die();
		}
		if($return_path){
			return $upload_path . "/orders/$filename.pdf";
		}else{
			redirect($upload_path . "/orders/$filename.pdf"); 
		}
	}
	
}