<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Adminpage extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('page_model');
	}
	
	public function index($method='', $param='')
	{
		switch($method)
		{
			
			case 'add':
					$this->add_page();
				break;
			
			case 'delete':
					$this->delete_page($param);
				break;
			case 'duplicate':
					$this->duplicate_page($param);
				break;
				
			case 'edit':
					$this->edit_page($param);
				break;
			case 'update_page':
					$this->update_page();
				break;
			
			default:
					$this->page_list($method);
				break;
		}
	}
	
	function add_page()
	{			
		$title = $_POST['title'];
		
		$new_id_title = $title;
		$new_id_title = str_replace(' ','-',$new_id_title);
		$new_id_title = str_replace("/","-",$new_id_title);
		$new_id_title = str_replace("'","",$new_id_title);
		$new_id_title = str_replace(",","-",$new_id_title);
		$new_id_title = str_replace("&","and",$new_id_title);
		$new_id_title = str_replace("+","and",$new_id_title);
		
		$data['title'] = $title;
		
		$data['id_title'] = $new_id_title;
		$data['modified'] = date('Y-m-d H:i:s');
		
		echo $this->page_model->add($data);
		
		
	}
	
	function update_page()
	{
		
		
		$id = $_POST['id'];	
		$id_title = $_POST['id_title'];		
		$description = $this->input->post('description');
		$new_id_title = $id_title;
		$new_id_title = str_replace(' ','-',$new_id_title);
		$new_id_title = str_replace("/","-",$new_id_title);
		$new_id_title = str_replace(",","-",$new_id_title);
		$new_id_title = str_replace("'","",$new_id_title);
		$new_id_title = str_replace("&","and",$new_id_title);
		$new_id_title = str_replace("+","and",$new_id_title);	
		$id_title = $new_id_title;
		
		$page = $this->page_model->get_page_by_link($id_title);
		
		$err = 0;
		if($page && $page['id'] != $id)
		{
			$err = 1;
		}
		
		if($err != 0)
		{
			$this->session->set_flashdata('update_error','This link title has already used by other page.');
		}
		else
		{
			$title = $_POST['title'];
			
			$meta_title = $_POST['meta_title'];
			$meta_desc = $_POST['meta_description'];
			$content = $_POST['content_text'];
			$gallery = $_POST['gallery_id'];
			$right_bar = 0;
			if($_POST['right_bar'])
			{
				$right_bar = $_POST['right_bar'];
			}
			
			$data['title'] = $title;
			$data['id_title'] = $id_title;
			$data['description'] = $description;
			$data['meta_title'] = $meta_title;
			$data['meta_description'] = $meta_desc;
			$data['content'] = $content;
			$data['gallery'] = $gallery;
			$data['right_bar'] = $right_bar;
			$data['modified'] = date('Y-m-d H:i:s');
			$this->page_model->update($id,$data);
			
			
			if($_FILES["userfile"]["name"]!=''){
			$pid= $id;
			$path = "./uploads/page";
			$newfolder = md5('page'.$pid);
			$dir = $path."/".$newfolder;
			if(!is_dir($dir))
			{
			  mkdir($dir);
			  chmod($dir,0777);
			  $fp = fopen($dir.'/index.html', 'w');
			  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
			  fclose($fp);
			}
			$config['upload_path'] = "./uploads/page/".md5("page".$pid);
			$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|jpeg|jpg|pdf|gif|png|txt';
			$config['max_size']	= '4096'; // 4 MB
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
			$config['overwrite'] = FALSE;
			$config['remove_space'] = TRUE;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()) {
				
					$this->session->set_flashdata('error_upload',$this->upload->display_errors());
					redirect('admin/page/edit/'.$id);
				
			}
			else
			{
				$data_image = array('upload_data' => $this->upload->data());
				$name = $data_image['upload_data']['file_name'];
				$data_upload_iamge['image'] = $name;			
				$this->page_model->update($id,$data_upload_iamge);
			}
			}
			
			
		}
		
		redirect(base_url().'admin/page/edit/'.$id);
	}
	
	function edit_page($id)
	{
		$data['page'] = $this->page_model->identify($id);
		
		$this->load->view('admin_page_edit', isset($data) ? $data : NULL);
	}
	
	function delete_page($id)
	{
		$this->page_model->delete($id);
	}
	
	function duplicate_page()
	{
		$name = $_POST['name'];
		$id = $_POST['id'];
		
		$data = $this->page_model->identify($id);
		
		$new_id_title = $name;
		$new_id_title = str_replace(' ','-',$new_id_title);
		$new_id_title = str_replace("'","",$new_id_title);
		$new_id_title = str_replace(",","",$new_id_title);
		$new_id_title = str_replace("&","and",$new_id_title);
		$new_id_title = str_replace("+","and",$new_id_title);
		
		$data = $this->page_model->identify($id);
		
		if($data['id_title'] == $new_id_title)
		{
			echo 0;
		}
		else 
		{
			$data['id'] = NULL;
			$data['title'] = $name;
			$data['id_title'] = $new_id_title;
			
			$new_id = $this->page_model->add($data);
			
			$pid= $new_id;
			$path = "./uploads/page";
			$newfolder = md5('page'.$pid);
			$dir = $path."/".$newfolder;
			if(!is_dir($dir))
			{
			  mkdir($dir);
			  chmod($dir,0777);
			  $fp = fopen($dir.'/index.html', 'w');
			  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
			  fclose($fp);
			}
			
			copy("./uploads/page/".md5('page'.$id)."/".$data['image'], "./uploads/page/".md5('page'.$pid)."/".$data['image']);
			
			
			echo $new_id;
		}
		
		
	}
	
	
	function page_list($offset='')
	{
		$data['pages'] = $this->page_model->all_pages();			
		$this->load->view('admin_page_list', isset($data) ? $data : NULL);
	}
	

}