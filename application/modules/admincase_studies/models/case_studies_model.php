<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_studies_model extends CI_Model {
	
	
	function add_case_study($data)
	{
		$this->db->insert('case_studies',$data);
		return $this->db->insert_id();	
	}
	
	function delete_case_study_category_relation($case_study_id)
	{
		if($case_study_id){
			$this->db->where('case_studies_id',$case_study_id)->delete('case_studies_categories_relation');
			return true;	
		}
		return false;
	}
	
	function update_case_study($case_study_id,$data)
	{
		$this->db->where('id',$case_study_id)->update('case_studies',$data);	
	}
	
	function add_case_study_categories($article_category_ids,$case_study_id)
	{
		foreach($article_category_ids as $cat_id){
			  $data = array(
						  'case_studies_id' => $case_study_id,
						  'case_studies_category_id' => $cat_id
						  );
			  $this->add_case_study_categories_relationship($data);
		 }	
	}
	
	function delete_case_study($case_study_id)
	{
		if($case_study_id){
			$folder = md5('case_std'.$case_study_id);
			$full_path = './uploads/case_studies/'.$folder;
			//delete all images
			$this->delete_image_by_id($case_study_id);
			//delete documents
			$this->delete_document_by_id($case_study_id);
			//delete category relationship
			$this->delete_case_study_category_relation($case_study_id);
			//remove directory
			$this->remove_case_study_directory($full_path);
			//delete case study
			$this->db->where('id',$case_study_id)->delete('case_studies');
		}	
	}
	
	
	function remove_case_study_directory($path)
	{
		if (is_dir($path) === true){
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
	
			foreach ($files as $file){
				if (in_array($file->getBasename(), array('.', '..')) !== true){
					if ($file->isDir() === true){
						rmdir($file->getPathName());
					}
	
					else if (($file->isFile() === true) || ($file->isLink() === true)){
						unlink($file->getPathname());
					}
				}
			}
	
			return rmdir($path);
		}
	
		else if ((is_file($path) === true) || (is_link($path) === true)){
			return unlink($path);
		}
	
		return false;
	}
	
	function load_gallery_options($current_gallery_id = "")
	{
		$this->load->model('admingallery/gallery_model');
		$active_gallery = $this->gallery_model->get_galleries_activepreview();
		$out = '<option '.($current_gallery_id == '' ? 'selected="selected"' : '').' value="0">Select Gallery</option>';
		if($active_gallery){
			foreach($active_gallery as $gallery){
				$out .= '<option value="'.$gallery['id'].'" '.($current_gallery_id == $gallery['id'] ? 'selected="selected"' : '').'>'.trim($gallery['title']).'</option>';	
			}
		}
		return $out;
			
	}
	
	function add_case_study_categories_relationship($data)
	{
		$this->db->insert('case_studies_categories_relation',$data);
		return $this->db->insert_id();	
	}
	
	function get_all_categories()
	{
		$categories = $this->db->where('status','active')->get('case_studies_category')->result();
		if($categories){
			return $categories;	
		}
		return false;
	}
	
	function add_new_category($data)
	{
		$this->db->insert('case_studies_category',$data);
		return $this->db->insert_id();
	}
	
	function delete_category($category_id)
	{
		if($category_id){
			//delete from case_studies_category
			$this->db->where('id',$category_id)->delete('case_studies_category');
			//delete from case_studies_categories_relation
			$this->db->where('case_studies_category_id',$category_id)->delete('case_studies_categories_relation');	
			return true;
		}
		return false;
	}
	
	function get_case_study_and_category_relation($case_study_id)
	{
		if($case_study_id){
			$relations = $this->db->where('case_studies_id',$case_study_id)->order_by('id','desc')->get('case_studies_categories_relation')->result();
			if($relations){
				return $relations;	
			}
		}
		return false;
	}
	
	function create_category_list($case_study_id = '',$just_created_category_id = '')
	{
		$categories = $this->get_all_categories();
		if($case_study_id){
			$relations = $this->get_case_study_and_category_relation($case_study_id);	
		}
		$out = '';
		if($categories){
			
			//to mark existing category for the selected case study as checked 
			foreach($categories as $cat){
				$checked = '';
				$checked_class = '';
				if($case_study_id){
					if($relations){
						foreach($relations as $rel){
							if($cat->id == $rel->case_studies_category_id){
								$checked = 'checked="checked"';	
								$checked_class = 'class="checked"';
							}
						}
					}
			}
				
			 //mark newly added category as checked 
			 if($just_created_category_id){
				  if($cat->id == $just_created_category_id){
					  $checked = 'checked="checked"';	
					  $checked_class = 'class="checked"';
				  }
			  }
				
				$out .= '<tr id="case_study_cat_tr_'.$cat->id.'">
							<td class="td-title">'.$cat->name.'</td>
							<td class="td-status">
							<div class="checker center-align">
								<span '.$checked_class.'>
									<input type="checkbox" name="article_categories[]"  class="check" value="'.$cat->id.'" '.$checked.' />
								</span>
							</div>
							</td>
							<td class="td-delete"><i onclick="case_std.confirm_delete_category('.$cat->id.',\''.$cat->name.'\');" class="fa fa-trash-o"></i></td>
						 </tr>';
                    
			}
		}
		echo $out;
	}
	
	function get_case_study($case_study_id)
	{
		if($case_study_id){
			$case_study = $this->db->where('id',$case_study_id)->get('case_studies')->row();	
			if($case_study){
				return $case_study;
			}
		}
		return false;
			
	}
	
	function permalink_exists($permalink,$update_id="")
	{
		//ignore this the update id supplied from the record as this will always return true
		if($update_id){
			$row = $this->db->where('id !=',$update_id)->where('id_title',$permalink)->get('case_studies')->row();
		}else{
			$row = $this->db->where('id_title',$permalink)->get('case_studies')->row();
		}
		if($row){
			return true;	
		}
		return false;
	}
	
	function create_thumbs($image_name,$path)
	{
		# image name, path, sub dir, width, height, maintain ratio = true
		# Create thumbnails thumb
		$this->resizephoto($image_name,$path,"thumb",165,95);	
		# Create thumbnails thumb 2
		$this->resizephoto($image_name,$path,"thumb2",145,75);	
	}
	
	
	function resizephoto($name,$directory,$sub,$width,$height,$maintain_ratio = TRUE) 
	{
		$config = array();
		$config['source_image'] = $directory."/".$name;
		$config['create_thumb'] = FALSE;
		$config['new_image'] = $directory."/".$sub."/".$name;
		$config['maintain_ratio'] = $maintain_ratio;
		$config['quality'] = 100;
		$config['width'] = $width;
		$config['height'] = $height;
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();		
		$this->image_lib->clear();	
	}
	
	function create_folders($path,$salt,$subfolders)
	{
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
	
	function delete_image($folder,$image_name)
	{
		if($image_name && $folder){
			$main_path = "./uploads/case_studies/".$folder;
			//delete main image
			if(file_exists($main_path.'/'.$image_name)){
				unlink($main_path.'/'.$image_name);
			}
			//delete thumb 
			if(file_exists($main_path.'/thumb/'.$image_name)){
				unlink($main_path.'/thumb/'.$image_name);
			}
			//delete thumb2
			if(file_exists($main_path.'/thumb2/'.$image_name)){
				unlink($main_path.'/thumb2/'.$image_name);
			}
		}
	}
	
    function delete_image_by_id($case_study_id)
	{
		if($case_study_id){
			$case_study = $this->get_case_study($case_study_id);
			if($case_study){
				$folder = md5('case_std'.$case_study_id);
				$this->delete_image($folder,$case_study->image);
				$this->update_case_study($case_study_id,array('image'=>''));
				return true;	
			}
		}
		return false;
	}
	
	function delete_document_by_id($case_study_id)
	{
		if($case_study_id){
			$case_study = $this->get_case_study($case_study_id);
			if($case_study){
				$folder = md5('case_std'.$case_study_id);
				$this->delete_document($folder,$case_study->doc);
				$this->update_case_study($case_study_id,array('doc'=>''));
				return true;	
			}
		}
		return false;
	}
	
	function delete_document($folder,$document_name)
	{
		if($document_name && $folder){
			$main_path = "./uploads/case_studies/".$folder;
			//delete doc
			if(file_exists($main_path.'/doc/'.$document_name)){
				unlink($main_path.'/doc/'.$document_name);
			}
		}
	}
	
	function get_case_studies_categories($case_study_id,$return = false)
	{
		$sql = "select case_studies_category.* from case_studies_category,case_studies_categories_relation where case_studies_category.id = case_studies_categories_relation.case_studies_category_id and case_studies_categories_relation.case_studies_id = ".$case_study_id." group by case_studies_category.id order by case_studies_categories_relation.id desc";
		$categories = $this->db->query($sql)->result();
		$out = '';
		if($categories){
			if($return){
				return $categories;	
			}else{
				$total = count($categories);
				$count = 1;
				foreach($categories as $cat){
					if($count == 1){
						$out .= $cat->name;
					}
					$count++;
				}
				if($total > 1){
					$out .= ',(and '.($total-1).' Others)';	
				}
				return $out;
			}
		}
	}
	
	function search_case_studies($params = "")
	{
		$out = '';
		
		$data_per_page = 25;
		if($this->get_records_per_page('backend')){
			$data_per_page = $this->get_records_per_page('backend');	
		}
		

		$category_id = '';
		if(isset($params['category_id'])){
			$category_id = $params['category_id'];
		}
		
		$keywords = '';
		if(isset($params['keywords'])){
			$keywords = $params['keywords'];
		}
		
		$active_sort = '';
		if(isset($params['sort_params']['active_sort'])){
			$active_sort = $params['sort_params']['active_sort'];
		}
		
		$sort_type = '';
		if(isset($params['sort_params']['sort_type'])){
			$sort_type = $params['sort_params']['sort_type'];
		}
		
		$limit = '0,'.$data_per_page;

		
		if($category_id){
			$sql = "select distinct 
			case_studies.id, 
			case_studies.id_title,
			case_studies.title, 
			case_studies.study_date,
			case_studies.status 
			from case_studies, case_studies_categories_relation 
			where case_studies.id = case_studies_categories_relation.case_studies_id 
			and case_studies_categories_relation.case_studies_category_id = ".$category_id;	
		}else{
			$sql = "select id,id_title,title,study_date,status from case_studies where id != '' ";	
		}
		
		if($keywords){
			$sql .= " and title like '%".$keywords."%'";
		}
		
		if($active_sort && $sort_type){
			$sql .= $this->get_sort_type($active_sort,$sort_type);	
		}
		
		//get all data first
		$all_data = $this->db->query($sql)->result();
		$total = count($all_data);

		$sql .= " limit ".$limit;

		$case_studies = $this->db->query($sql)->result();
		
		$arr[0] = '[ Total Records - 0 | Showing '.$data_per_page.' Records Per Search ]';
		$arr[1] = '';
		
		//output - no changes required here for any sql related changes
		if($case_studies){
			foreach($case_studies as $case){
				$clean_title = $case->title;
				$clean_title = str_replace('"', "", $clean_title);
				$clean_title = str_replace("'", "", $clean_title);
				$out .= '<tr class="list-tr">
							<td class="list-case-title"><a class="my-tooltip" data-toggle="tooltip" title="Edit article" href="'.base_url().'admin/case_studies/edit/'.$case->id.'">'.$case->title.'</a> <a class="my-tooltip" data-toggle="tooltip" title="Preview article" target="_blank" href="'.base_url().'preview-story/'.$case->id_title.'"><i class="fa fa-search"></i></a></th>
							<td class="list-case-cat remove-left-padding">'.$this->get_case_studies_categories($case->id).'</th>
							<td class="list-case-date remove-left-padding">('.date('d-m-Y',strtotime($case->study_date)).')</th>
							<td class="list-case-status remove-left-padding">'.($case->status == 'active' ? '<a class="my-tooltip" data-toggle="tooltip" title="Deactivate article" href="'.base_url().'admin/case_studies/deactivate/'.$case->id.'"><i class="fa fa-check-circle status-active"></i></a>' : '<a class="my-tooltip" data-toggle="tooltip" title="Activate article" href="'.base_url().'admin/case_studies/activate/'.$case->id.'"><i class="fa fa-times-circle status-inactive"></i></a>').'</th>
							<td class="list-case-view remove-left-padding"><a class="my-tooltip" data-toggle="tooltip" title="Edit article" href="'.base_url().'admin/case_studies/edit/'.$case->id.'"><i class="fa fa-edit"></i></a></th>
							<td class="list-case-del remove-left-padding"><i data-toggle="tooltip" title="Delete article"onclick="case_std_list.confirm_delete_case_study(\''.$clean_title.'\','.$case->id.')" class="fa fa-trash-o cursor my-tooltip"></i></th>
						</tr>';	
			}
			
			
			$arr[0] = '[ Total Records - '.$total.' | Showing '.$data_per_page.' Records Per Search ]';
			$arr[1] = $out;
			//$arr[1] = $sql;
		}
		return json_encode($arr);
	}
	
	function get_sort_type($active_sort, $sort_type)
	{
		$sql = '';
		if($active_sort && $sort_type){
			switch($active_sort){
				case 'title':
					$sql = ' order by title '.($sort_type == 'az' ? ' asc ' : ' desc ');	
				break;
				
				case 'date':
					$sql = ' order by study_date '.($sort_type == 'az' ? ' asc ' : ' desc ');	
				break;
				
				case 'status':
					$sql = ' order by status '.($sort_type == 'az' ? ' asc ' : ' desc ');	
				break;
				
				default:
					$sql = ' order by study_date '.($sort_type == 'az' ? ' asc ' : ' desc ');
				break;		
			}
		}
		return $sql;
	}
	
	function get_records_per_page($return = '')
	{
		$records_per_page = $this->db->where('module','article')->get('records_per_page_config')->row();
		if($records_per_page){
			if($return){
				if($return == 'backend'){
					return $records_per_page->backend;
				}else{
					return $records_per_page->frontend;	
				}
			}else{
				return $records_per_page;	
			}
		}
		return false;
	}
	
	function update_records_per_page($id,$data)
	{
		$this->db->where('id',$id)->update('records_per_page_config',$data);
	}
	
}