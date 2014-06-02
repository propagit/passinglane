<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Helpers
 * @author: kaushtuvgurung@gmail.com
 */

class Helpers extends MX_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	/**
	*	@name: slugify
	*	@desc: Creates slugs
	*	@access: public
	*	@param: ([string] text to slugify)
	*	@return: returns slug
	*/
	function slugify($text){ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	  // trim
	  $text = trim($text, '-');
	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  // lowercase
	  $text = strtolower($text);
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  if (empty($text)){
		return 'n-a';
	  }
	  return $text;
	}
	
	/**
	*	@name: create_folders
	*	@desc: Creates folder for documents
	*	@access: public
	*	@param: ([string]) path of the folder, ([string]) salt, ([array]) array of subfolders if applicable
	*	@return: returns the folder name to the control that called this function
	*/
	function create_folders($path,$salt,$subfolders = null)
	{	
		//create staff specific folders
		if($path && $salt){
			$newfolder = md5($salt);
			$dir = $path."/".$newfolder;
			if(!is_dir($dir))
			{
			  mkdir($dir);
			  chmod($dir,0777);
			  $fp = fopen($dir.'/index.html', 'w');
			  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
			  fclose($fp);
			}
			
			$sub_dir = '';
			if($subfolders){
				foreach($subfolders as $folder){
					$sub_dir = $dir.'/'.$folder;	
					if(!is_dir($sub_dir))
					{
					  mkdir($sub_dir);
					  chmod($sub_dir,0777);
					  $fp = fopen($sub_dir.'/index.html', 'w');
					  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
					  fclose($fp);
					}		
				}
			}
			return $newfolder;
		}
		
	}
	
	/**
	*	@name: delete_file
	*	@desc: Delete file
	*	@access: public
	*	@param: ([string]) full path of the file
	*	@return: null
	*/
	function delete_file($path)
	{
		if(file_exists($path)){
			unlink($path);
		}	
	}
	
	/**
	*	@name: delete_dir_and_contents
	*	@desc: Deletes the document contents,sub folders included and the directory iteself
	*	@access: public
	*	@param: (string) path of the folder
	*	@return: NULL
	*/
	function delete_dir_and_contents($path)
	{
		$this->load->helper("file"); // load the helper
		delete_files($path, true); // delete all files/folders
		rmdir($path);	
	}
	
	/**
	*	@name: get_remainder
	*	@desc: Get the remainder from division of a number
	*	@access: public
	*	@param: ([int] divident, [int] divisor)
	*	@return: NULL
	*/
	function get_remainder($dividend,$divisor)
	{
		$remainder = (float)($dividend / $divisor);
		$remainder = ($remainder - (int)$remainder)*$divisor;
		return $remainder;	
	}
	/**
	*	@name: field_select
	*	@desc: Populates select field 
	*	@access: public
	*	@param: ([array] select field parameters)
	*	@return: NULL
	*/
	function field_select($params)
	{
		$data['params'] = $params;
		$this->load->view('field_select', isset($data) ? $data : NULL);	
	}
	
	function country_field_select($params)
	{		
		$countries = $this->helper_model->get_countries($params['country_code']);
		$array = array();
		foreach($countries as $country)
		{
			$options[] = array(
				'value' => $country['code'],
				'label' => $country['name']
			);
		}
		$params['options'] = $options;
		return $this->field_select($params);
	}
	
	function field_select_states($params)
	{ 
		$states = $this->helper_model->get_states($params['state_code']);
		foreach($states as $state)
		{
			$options[] = array(
				'value' => $state['code'],
				'label' => $state['name']
			);
		}
		$params['options'] = $options;
		return $this->field_select($params);
	}
	
	/**
	*    @name: create_pagination
	*    @desc: Generates Pagination for search results
	*    @access public
	*    @param: ([int] total records, [int] records per page, [int] current page number) 
	*    @return: Loads page numbers for search results
	*/
	
	function create_pagination($total_records,$records_per_page = 6,$current_page = 1)
	{
		$data['total_records'] = $total_records;
		$data['records_per_page'] = $records_per_page;
		$data['current_page'] = $current_page;
		$this->load->view('pagination',isset($data) ? $data : NULL);
	}
	
	/**
	*    @name: generate_password
	*    @desc: Generates random string. Mostly used for password regeneration. The default length of the string is 6
	*    @access public
	*    @param: ([int] length of the string)
	*    @return: Returns random string.
	*/
	function generate_password($password_length = 6)
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); 
		$alpha_length = strlen($alphabet) - 1; 
		for ($i = 0; $i < $password_length; $i++) {
			$n = rand(0, $alpha_length);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); 
	}
	
	


}