<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('category_model');
	}
	
	function get_name_product_category()
	{		
		$id = $_POST['id'];
		$data = $this->category_model->get_detail_productcategory($id);
		//print $data['price'];
		echo $data['name'];
	}
	
	function get_subname_product_category()
	{		
		$id = $_POST['id'];
		$data = $this->category_model->get_detail_productcategory($id);
		//print $data['price'];
		echo $data['subname'];
	}
	
	function set_order_features()
	{
		$list = $_POST['list'];
		$features = explode(',', $list);
		$i = 1;
		foreach($features as $f)
		{
			$feat = $this->product_model->get_feature($f);
			$ndata = array();
			$ndata['order'] = $i;
			$this->product_model->update_feature($feat['id'],$ndata);
			 
			$i++;
		}
	}
	
	function get_product_price()
	{		
		$product_id = $_POST['id'];
		$data = $this->product_model->identify($product_id);
		//print $data['price'];
		$arr=array();
		$arr[0]=$data['price'];
		echo json_encode($arr);
	}
	function get_product_saleprice()
	{		
		$product_id = $_POST['id'];
		$data = $this->product_model->identify($product_id);
		$arr=array();
		$arr[0]=$data['sale_price'];
		echo json_encode($arr);
	}
	
	function get_product_tradeprice()
	{		
		$product_id = $_POST['id'];
		$data = $this->product_model->identify($product_id);
		echo $data['price_trade'];
	}

	function get_product_saletradeprice()
	{		
		$product_id = $_POST['id'];
		$data = $this->product_model->identify($product_id);
		echo $data['sale_price_trade'];
	}
	
	function duplicate()
	{
		$name = $_POST['name'];
		$id = $_POST['id'];
		
		$data = $this->product_model->identify($id);
		
		$new_id_title = $name.'-'.$data['short_desc'];
		$new_id_title = str_replace(' ','-',$new_id_title);
		$new_id_title = str_replace("'","",$new_id_title);
		$new_id_title = str_replace("&","and",$new_id_title);
		$new_id_title = str_replace("+","and",$new_id_title);
		
		$data = $this->product_model->identify($id);
		
		if($data['id_title'] == $new_id_title)
		{
			echo 0;
		}
		else 
		{
			$data['id'] = NULL;
			$data['title'] = $name;
			$data['id_title'] = $new_id_title;
			
			$new_id = $this->product_model->add($data);
			
			$path = "./uploads/products";
			$newfolder = md5('mbb'.$new_id);
			$dir = $path."/".$newfolder;
			
			mkdir($dir,0777);
			chmod($dir,0777);
			$thumb1 = $dir."/thumb1";
			mkdir($thumb1,0777);
			chmod($thumb1,0777);
			$thumb2 = $dir."/thumb2";
			mkdir($thumb2,0777);
			chmod($thumb2,0777);
			$thumb3 = $dir."/thumb3";
			mkdir($thumb3,0777);
			chmod($thumb3,0777);
			$thumb4 = $dir."/thumb4";
			mkdir($thumb4,0777);
			chmod($thumb4,0777);
			$thumb5 = $dir."/thumb5";
			mkdir($thumb5,0777);
			chmod($thumb5,0777);
			$thumb6 = $dir."/thumb6";
			mkdir($thumb6,0777);
			chmod($thumb6,0777);
			$thumb7 = $dir."/thumb7";
			mkdir($thumb7,0777);
			chmod($thumb7,0777);
			$thumb8 = $dir."/thumb8";
			mkdir($thumb8,0777);
			chmod($thumb8,0777);
			
			echo $new_id;
		}
		
		
	}
	
	function updatesale() {
		$product_id = $_POST['id'];
		$sale_price = $_POST['saleprice'];
		//$sale_trade_price = $_POST['saletradeprice'];
		$data = array(			
			//'sale_price_trade' => $sale_trade_price,
			'sale_price' => $sale_price,
			'modified' => date('Y-m-d H:i:s')
		);
		$this->product_model->update($product_id,$data);
		// if($sale_trade_price < $sale_price)
		// {
			// if(!$this->product_model->product_category($product_id,6))
			// {
				// $data['product_id'] = $product_id;
				// $data['category_id'] = 6;
				// $this->product_model->add_category($data);
			// }
		// }
		// else
		// {
			// if($this->product_model->product_category($product_id,6))
			// {
				// $this->product_model->remove_category($product_id,6);
			// }
		// }		
	}
	function update_stock()
	{
		$stock = $_POST['stock'];
		$id = $_POST['id'];
		
		$data['stock'] = $stock;
		
		$this->product_model->update($id,$data);
	}
	
	
	function searchfeature()
	{
		$keyword = $_POST['keyword'];
		$category = $_POST['category'];
		$products = $this->product_model->search($keyword,$category,true);		
		$out = '
    <div class="box">
    <form name="featureForm" method="post" action="'.base_url().'admin/product/addfeature">
        
        <div style="margin-top: 10px;" class="list_line"></div>
		<table class="table table-hover">
		<thead>
			<tr style="font-size: 15px">
				<th style="width: 85%">PRODUCT NAME</th>
				<th style="width: 15%; text-align: center;">ADD</th>				
			</tr>
		</thead>
				
		<tbody id="subcat">';			        
		
		foreach($products as $product) { 
			if (!$this->product_model->is_feature($product['id']) && $product['deleted'] == 0 && $product['status'] == 1) {
			$out .= '			
			<tr>
				<td>'.$product['title'].'</td>
				<td style="text-align: center;">
					&nbsp; <input type="checkbox" value="'.$product['id'].'" name="products[]" /> &nbsp;
				</td>
			</tr> 
			
			';
            	} 
			}
		$out .= '
		</tbody>		
		</table>

    	<p align="right">
			
			<button class="btn btn-info" type="button" onClick="document.featureForm.submit()">Add Products</button>
		</p>        
    </div>
    </form>';
		print $out;
	}
	
	function get_product_category()
	{
		$id=$this->input->post('id');
		$categories = $this->product_model->get_categories($id);
		$thiscat = Array();
		foreach($categories as $category)
		{
			array_push($thiscat,$category['category_id']);
		}
		$main = $this->category_model->get_main_productcategory();
		$out = '';
		$out .= '<ul class="tree">';
		$out .= '<li style="line-height: 30px;">';
		$out .= '<a href="javascript:nothing()" role="branch" class="tree-toggle" data-toggle="branch" data-value="All_Category">';
		$out .= 'All Category';
		$out .= '</a>';
		$out .= '<ul class="branch in">';
		foreach($main as $maincat)
		{
			$sub2 = $this->category_model->get_detail_productcategory($maincat['id']);
			$out .= '<li style="line-height: 30px;">';
			if(count($sub2) > 0)
			{
				$out .= '<a href="javascript:nothing()" role="leaf"  data-toggle="branch" data-value="'.$maincat['name'].'">';
				if(in_array($maincat['id'],$thiscat))
				{
					$out .= '<input checked="checked" style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$maincat['id'].'"/>';
				}
				else 
				{
					$out .= '<input style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$maincat['id'].'"/>';
				}
				
				$out .= $maincat['name'];
				$out .= '</a>';
			}
			else 
			{
				$out .= '<a href="javascript:nothing()" role="leaf">';
				if(in_array($maincat['id'],$thiscat))
				{
					$out .= '<input checked="checked" style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$maincat['id'].'"/>';
				}
				else
				{
					$out .= '<input style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$maincat['id'].'"/>';
				}
				
				$out .= $maincat['name'];
				$out .= '</a>';
			}
			$out .= '<ul class="branch">';
			// $sub = $this->category_model->get_detail_productcategory($maincat['id']);
			// if(count($sub2) > 0)
			// {
				// foreach($sub as $subcat)
				// {
					// $out .= '<li style="line-height: 30px;">';
					// $out .= '<a href="javascript:nothing()" role="leaf">';
					// if(in_array($subcat['id'],$thiscat))
					// {
						// $out .= '<input checked="checked" style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$subcat['id'].'"/>';
					// }
					// else 
					// {
						// $out .= '<input style="margin-top: -3px; margin-right: 5px;" type="checkbox" name="categories[]" value="'.$subcat['id'].'"/>';
					// }
// 					
					// $out .= $subcat['title'];
					// $out .= '</li>';	
				// }
			// }
			$out .= '</ul>';
			$out .= '</li>';
		}
		$out .= '</ul>';
		$out .= '</li>';
		$out .= '</ul>';
		
		echo $out;
	}
	
	function exportstock()
	{
		/*error_reporting(E_ALL);
		$csvdir = getcwd();		
		$csvname = 'Product_Stock_'.date('d-m-Y');
		$csvname = $csvname.'.csv';		
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');	
		$stocks=$this->product_model->all();
		$headings = array('Product ID','Product Name','Unit Of Sale','Pack','Short Description','Category','Available','Price A','Sale Price A','Last Price A','Price B','Sale Price B','Last Price B','Price C','Sale Price C','Last Price C','Price D',' Sale Price D','Last Price D','Price E','Sale Price E','Last Price E','Price F','Sale Price F','Last Price F','Stock ID','Stock');
		fputcsv($fp,$headings);
		foreach($stocks as $stock) 
		{
			$cat = $this->category_model->identify($stock['main_category']);						
			fputcsv($fp,array($stock['id'],$stock['title'],$stock['unit_of_sale'],$stock['pack'],$stock['short_desc'],$cat['title'],$stock['status'],$stock['price'],$stock['sale_price'],$stock['last_price'],$stock['price_b'],$stock['sale_price_b'],$stock['last_price_b'],$stock['price_c'],$stock['sale_price_c'],$stock['last_price_c'],$stock['price_d'],$stock['sale_price_d'],$stock['last_price_d'],$stock['price_e'],$stock['sale_price_e'],$stock['last_price_e'],$stock['price_f'],$stock['sale_price_f'],$stock['last_price_f'],$stock['stock_id'],$stock['stock']));
		}
        fclose($fp);		
		*/
		ini_set('memory_limit', '128M');
		ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
		
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin Portal");
		$objPHPExcel->getProperties()->setLastModifiedBy("Admin Portal");
		$objPHPExcel->getProperties()->setTitle("Products");
		$objPHPExcel->getProperties()->setSubject("Products");
		$objPHPExcel->getProperties()->setDescription("Products Excel file, generated from Admin Portal.");
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Unit Of Sale');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Pack');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Short Description');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Available');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Sale Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Last Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Sale Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Last Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Sale Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Last Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Sale Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Last Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Sale Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Last Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Sale Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Last Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Stock ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Stock');
		
		//$products = $this->product_model->get_products();
		$stocks=$this->product_model->all();
		for($i=0; $i<count($stocks); $i++)
		{			
			$cat = $this->category_model->identify($stocks[$i]['main_category']);	
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i+2), $stocks[$i]['id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . ($i+2), $stocks[$i]['title']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . ($i+2), $stocks[$i]['unit_of_sale']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . ($i+2), $stocks[$i]['pack']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . ($i+2), $stocks[$i]['short_desc']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . ($i+2), $cat['title']);			
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . ($i+2), $stocks[$i]['status']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . ($i+2), $stocks[$i]['price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . ($i+2), $stocks[$i]['sale_price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . ($i+2), $stocks[$i]['last_price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . ($i+2), $stocks[$i]['price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . ($i+2), $stocks[$i]['sale_price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . ($i+2), $stocks[$i]['last_price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . ($i+2), $stocks[$i]['price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . ($i+2), $stocks[$i]['sale_price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . ($i+2), $stocks[$i]['last_price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($i+2), $stocks[$i]['price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . ($i+2), $stocks[$i]['sale_price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . ($i+2), $stocks[$i]['last_price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . ($i+2), $stocks[$i]['price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('U' . ($i+2), $stocks[$i]['sale_price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('V' . ($i+2), $stocks[$i]['last_price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('W' . ($i+2), $stocks[$i]['price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('X' . ($i+2), $stocks[$i]['sale_price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Y' . ($i+2), $stocks[$i]['last_price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Z' . ($i+2), $stocks[$i]['stock_id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('AA' . ($i+2), $stocks[$i]['stock']);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('product');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "CSV");
		$file_name = "products_" . time() . ".csv";
		$objWriter->save("./exports/" . $file_name);
		die($file_name);
	}
	function exportproduct() {
		
		$csvdir = getcwd();		
		$csvname = 'Product_Stock_'.date('d-m-Y');
		$csvname = $csvname.'.csv';		
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');	
		$stocks=$this->product_model->all();
		
		
		
		
		$headings = array('Product ID','Product Name','Short Description','Status','Price','Stock');
		fputcsv($fp,$headings);
		foreach($stocks as $stock) 
		{
			
									
			fputcsv($fp,array($stock['id'],$stock['title'],$stock['short_desc'],$stock['status'],$stock['price'],$stock['stock']));
		}
        fclose($fp);		
	}
	
	function load_cross_sell_modal()
	{
		$product_id = $this->input->post('product_id');
		$data['main_product_id'] = $product_id;
		$data['main_product'] = $this->product_model->identify($product_id);
		$data['products'] = $this->product_model->all_active();
		echo $this->load->view('cross_sale/add_cross_sale', isset($data) ? $data : NULL . TRUE);
	}
	
	function add_cross_sale()
	{
		$main_product_id = $this->input->post('main_product_id');
		$cross_sale_product_id = $this->input->post('cross_sale_product_id');
		$out['msg'] = '';
		$out['status'] = false;
		if($main_product_id && $cross_sale_product_id){
			if(!$this->product_model->is_cross_sale_already_assigned($main_product_id,$cross_sale_product_id)){
				$data = array(
					'main_product_id' => $main_product_id,
					'product_id' => $cross_sale_product_id,
					);	
				$this->product_model->insert_cross_sale($data);
				$out['status'] = true;
				$out['msg'] = "Cross Sale product successfully added";
			}else{
				$out['msg'] = 'This cross sale item already exists. Operation aborted!';	
			}
		}else{
			$out['msg'] = 'Empty parameter. Please try again';	
		}
		echo json_encode($out);	
	}
	
	function load_existing_cross_sales()
	{
		$main_product_id = $this->input->post('main_product_id');
		$data['main_product_id'] = $main_product_id;
		$data['products'] = $this->product_model->get_product_cross_sales($main_product_id);	
		echo $this->load->view('cross_sale/list_existing_cross_sales',$data,true);
	}
	
	function delete_cross_sale()
	{
		$main_product_id = $this->input->post('main_product_id');
		$product_id = $this->input->post('product_id');
		if($this->product_model->delete_product_cross_sale($main_product_id,$product_id)){
			echo 'success';	
		}else{
			echo 'failed';	
		}
	}
	
	function set_feature_product()
	{
		$product_id = $this->input->post('product_id');
		$out['msg'] = '';
		$out['status'] = false;
		if($product_id){
			if(!$this->product_model->is_feature_product($product_id)){
				$data = array(
					'product_id' => $product_id
					);	
				$this->product_model->insert_feature_product($data);
				$out['status'] = true;
				$out['msg'] = "Product successfully set as feature product";
			}else{
				$out['msg'] = 'This product is already a feature product. Operation aborted!';	
			}
		}else{
			$out['msg'] = 'Empty parameter. Please try again';	
		}
		echo json_encode($out);	
	}
	
	function load_existing_feature_products()
	{
		echo modules::run('adminproduct/feature_products_list');
	}
	
	function remove_feature_product()
	{
		$product_id = $this->input->post('product_id');
		if($this->product_model->remove_feature_product($product_id)){
			echo 'success';	
		}else{
			echo 'failed';	
		}
	}
	
	function sort_feature_product_display_order()
	{
		$product_ids = $this->input->post('product_ids');
		$out['msg'] = '';
		$out['status'] = false;
		if($product_ids){
			
			$count = 0;
			foreach($product_ids as $product_id){
				$this->product_model->update_feature_product_by_product_id($product_id,array('display_order' => $count));
				$count++;
			}
			$out['status'] = true;
			$out['msg'] = "Feature product display order successfully changed!";
		}else{
			$out['msg'] = 'Empty parameter. Please try again';	
		}
		echo json_encode($out);	
	}
	
	
	function uploading($product_id)
	{
		// Make sure file is not cached (as it happens for example on iOS devices)
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
		/*
		// Support CORS
		header("Access-Control-Allow-Origin: *");
		// other CORS headers if any...
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			exit; // finish preflight CORS requests here
		}
		*/
		
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		
		// Uncomment this one to fake upload time
		// usleep(5000);
		
		// Settings
		//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
		//$targetDir = 'uploads';
		# Create dir for storing file related to the product
		$path = "./uploads/products";
		$salt = 'mbb'.$product_id;
		$folder_name = modules::run('helpers/create_folders',$path,$salt);
		$targetDir = $path.'/'.$folder_name."/product_file";
		//$targetDir = "./uploads/test";
		
			
		$cleanupTargetDir = true; // Remove old files
		$maxFileAge = 5 * 3600; // Temp file age in seconds
		
		
		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}
		
		// Get a file name
		if (isset($_REQUEST["name"])) {
			$fileName = $_REQUEST["name"];
		} elseif (!empty($_FILES)) {
			$fileName = $_FILES["file"]["name"];
		} else {
			$fileName = uniqid("file_");
		}
		
		$filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
		
		// Chunking might be enabled
		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		
		
		// Remove old temp files
		if ($cleanupTargetDir) {
			if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}
		
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
		
				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}
		
				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}
		
		
		// Open temp file
		if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
		}
		
		if (!empty($_FILES)) {
			if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
			}
		
			// Read binary input stream and append it to temp file
			if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		} else {
			if (!$in = @fopen("php://input", "rb")) {
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}
		}
		
		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}
		
		@fclose($out);
		@fclose($in);
		
		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			// Strip the temp .part suffix off
			rename("{$filePath}.part", $filePath);
		}
		$product_update_data = array(
			'product_file_name' => $fileName
		);
		$this->product_model->update($product_id,$product_update_data);	
		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}
	
}