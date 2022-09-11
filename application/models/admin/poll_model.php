<?php
class poll_model extends CI_Model
{
	public function select_poll($pollID)
	{
		$polls_vote = $this->db->query('CALL select_poll_result("' . $pollID . '")');
		return $polls_vote;
	}
	
	public function do_uploads($is_image_uploaded) //function for uploading image
	{
		//print_r($is_image_uploaded); exit;
		$data['image_alt']     = $is_image_uploaded['image_alt'];
		$data['image_caption'] = $is_image_uploaded['image_caption'];
		//$data['image_name']    = $is_image_uploaded['orig_name'];
		//$data['temp_name']     = $is_image_uploaded['temp_name'];
		
		$data['temp_image_id'] = $is_image_uploaded['temp_image_id'];
		
		$data['image_library_id'] = $is_image_uploaded['image_library_id'];
		
		$upload_path = $is_image_uploaded['full_path'];
		
		$image1_type = $is_image_uploaded['image1_type'];
		$image2_type = $is_image_uploaded['image2_type'];
		$image4_type = $is_image_uploaded['image4_type'];
		$image3_type = $is_image_uploaded['image3_type'];
		
		$crop_image_name = $is_image_uploaded['image_name'];
		$save_status     = $is_image_uploaded['save_status'];
		
		$data['filename']           = $is_image_uploaded['image_name'];
		$data['physical_imagename'] = $is_image_uploaded['physical_name'];
		$set_path                   = date("Ymdhis") . $is_image_uploaded['image_name'];
		$data['img_extension']      = pathinfo($set_path, PATHINFO_EXTENSION);
		$data['img_exist']          = 'Y';
		
		$data['encode_image'] = '';
		//image resize code
		
		$image_binary_bool1 = false;
		$image_binary_bool2 = false;
		$image_binary_bool3 = false;
		$image_binary_bool4 = false;
		
		if($save_status == 2)
		{
			$data['image_name'] = $crop_image_name;
			$data['temp_name']  = $crop_image_name;
		}
		
		if(isset($upload_path) && $upload_path != '' && $save_status != 2)
		{
			$ImagePath = '';
			
			$src = $ImagePath . $upload_path;
			
			$ImageExtension = explode("/", $src);
			$LastArray      = explode('.', end($ImageExtension));
			$extType        = strtolower($LastArray[1]);
			
			$image_binary_bool1 = false;
			$image_binary_bool2 = false;
			$image_binary_bool3 = false;
			$image_binary_bool4 = false;
			
			//if(!empty($src) && $data['temp_image_id'] == '')
			if(!empty($src))
			{
				switch($extType) //check image type
				{
					case 'gif':
						$src_img = imagecreatefromgif($src);
						break;
					
					case 'jpg':
						$src_img = imagecreatefromjpeg($src);
						break;
					
					case 'jpeg':
						$src_img = imagecreatefromjpeg($src);
						break;
					
					case 'png':
						$src_img = imagecreatefrompng($src);
						break;
				}
				
				
				if(!$src_img)
				{
					$result_value['status'] = 'error';
					$result_value['msg']    = "Failed to read the image file";
					return json_encode($result_value);
				}
				
				$size  = getimagesize($src);
				$src_w = $size[0];
				$src_h = $size[1];
				
				//resize image to 600*390 size
				$dst_w   = 600;
				$dst_h   = 390;
				$dst_img = imagecreatetruecolor($dst_w, $dst_h);
				$dst     = $ImagePath . str_replace(".", "_600_390.", $upload_path);
				//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
				
				$source_ratio      = $src_w / $src_h;
				$destination_ratio = $dst_w / $dst_h;
				// crop to fit 
				if($source_ratio > $destination_ratio)
				{
					// source has a wider ratio 
					$temp_width  = (int) ($src_h * $destination_ratio);
					$temp_height = $src_h;
					$source_x    = (int) (($src_w - $temp_width) / 2);
					$source_y    = 0;
				}
				else
				{
					// source has a taller ratio 
					$temp_width  = $src_w;
					$temp_height = (int) ($src_w / $destination_ratio);
					$source_x    = 0;
					$source_y    = (int) (($src_h - $temp_height) / 2);
				}
				$destination_x          = 0;
				$destination_y          = 0;
				$source_width           = $temp_width;
				$source_height          = $temp_height;
				$new_destination_width  = $dst_w;
				$new_destination_height = $dst_h;
				
				
				$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
				
				if($result)
				{
					if(imagejpeg($dst_img, $dst))
					{
						$ImageDetails = getimagesize($dst);
						$width        = $ImageDetails[0];
						$height       = $ImageDetails[1];
						$size         = $ImageDetails['bits'];
						$imagetype    = $ImageDetails['mime'];
						
						$image_binary_bool1 = true;
						$image1_type        = 1;
						imagedestroy($dst_img);
					}
				}
				
				//resize image to 600*300 size
				$dst_w             = 600;
				$dst_h             = 300;
				$dst_img           = imagecreatetruecolor($dst_w, $dst_h);
				$dst               = $ImagePath . str_replace(".", "_600_300.", $upload_path);
				//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
				$source_ratio      = $src_w / $src_h;
				$destination_ratio = $dst_w / $dst_h;
				
				// crop to fit 
				if($source_ratio > $destination_ratio)
				{
					// source has a wider ratio 
					$temp_width  = (int) ($src_h * $destination_ratio);
					$temp_height = $src_h;
					$source_x    = (int) (($src_w - $temp_width) / 2);
					$source_y    = 0;
				}
				else
				{
					// source has a taller ratio 
					$temp_width  = $src_w;
					$temp_height = (int) ($src_w / $destination_ratio);
					$source_x    = 0;
					$source_y    = (int) (($src_h - $temp_height) / 2);
				}
				$destination_x          = 0;
				$destination_y          = 0;
				$source_width           = $temp_width;
				$source_height          = $temp_height;
				$new_destination_width  = $dst_w;
				$new_destination_height = $dst_h;
				
				
				$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
				if($result)
				{
					if(imagejpeg($dst_img, $dst))
					{
						$ImageDetails       = getimagesize($dst);
						$width              = $ImageDetails[0];
						$height             = $ImageDetails[1];
						$size               = $ImageDetails['bits'];
						$imagetype          = $ImageDetails['mime'];
						$image_binary_bool2 = true;
						$image2_type        = 1;
						imagedestroy($dst_img);
					}
				}
				
				//resize image to 150*150 size
				$dst_w             = 150;
				$dst_h             = 150;
				$dst_img           = imagecreatetruecolor($dst_w, $dst_h);
				$dst               = $ImagePath . str_replace(".", "_150_150.", $upload_path);
				//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
				$source_ratio      = $src_w / $src_h;
				$destination_ratio = $dst_w / $dst_h;
				
				// crop to fit 
				if($source_ratio > $destination_ratio)
				{
					// source has a wider ratio 
					$temp_width  = (int) ($src_h * $destination_ratio);
					$temp_height = $src_h;
					$source_x    = (int) (($src_w - $temp_width) / 2);
					$source_y    = 0;
				}
				else
				{
					// source has a taller ratio 
					$temp_width  = $src_w;
					$temp_height = (int) ($src_w / $destination_ratio);
					$source_x    = 0;
					$source_y    = (int) (($src_h - $temp_height) / 2);
				}
				$destination_x          = 0;
				$destination_y          = 0;
				$source_width           = $temp_width;
				$source_height          = $temp_height;
				$new_destination_width  = $dst_w;
				$new_destination_height = $dst_h;
				
				
				$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
				if($result)
				{
					if(imagejpeg($dst_img, $dst))
					{
						$ImageDetails       = getimagesize($dst);
						$width              = $ImageDetails[0];
						$height             = $ImageDetails[1];
						$size               = $ImageDetails['bits'];
						$imagetype          = $ImageDetails['mime'];
						$image_binary_bool4 = true;
						$image3_type        = 1;
						imagedestroy($dst_img);
					}
				}
				
				//resize image to 100*65 size
				$dst_w   = 100;
				$dst_h   = 65;
				$dst_img = imagecreatetruecolor($dst_w, $dst_h);
				$dst     = $ImagePath . str_replace(".", "_100_65.", $upload_path);
				$result  = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
				if($result)
				{
					if(imagejpeg($dst_img, $dst))
					{
						$ImageDetails       = getimagesize($dst);
						$width              = $ImageDetails[0];
						$height             = $ImageDetails[1];
						$size               = $ImageDetails['bits'];
						$imagetype          = $ImageDetails['mime'];
						$image_binary_bool3 = true;
						$image4_type        = 1;
						imagedestroy($dst_img);
					}
				}
			}
		}
		
		if($image_binary_bool1 == true || $image_binary_bool2 == true || $image_binary_bool3 == true || $image_binary_bool4 == true || ($data['temp_image_id'] != '' && $save_status == 2) || ($data['image_library_id'] != '' && $save_status == 2))
		{
			$temp_image = array();
			
			//$TempSourceURL = poll_temp_image_path.$data['temp_name'];	
			$TempSourceURL = poll_temp_image_path;
			
			$datatimestring = strtotime(date("Ymdhis"));
			$DestinationURL = imagelibrary_image_path;
			
			$image_name   = explode('.', $data['filename']);
			$NewImageName = $data['physical_imagename'] . '.' . $image_name[1];
			$Year         = date('Y');
			$Month        = date('n');
			$Day          = date('j');
			
			create_image_folder($Year, $Month, $Day);
			$FolderMapping = $Year . "/" . $Month . "/" . $Day . "/original/";
			
			ImageDeleteAndPasteToLibrary($data['filename'], $NewImageName, $TempSourceURL, $DestinationURL, $FolderMapping);
			$caption_array = explode('.', $data['filename']);
			$caption       = $caption_array[0];
			
			//$temp_image['alt_tag'] = $caption;
			//$temp_image['caption'] = $caption;
			
			$temp_image['alt_tag']     = $data['image_alt'];
			$temp_image['caption']     = $data['image_caption'];
			$temp_image['image_name']  = $FolderMapping . $NewImageName;
			$temp_image['image1_type'] = $image1_type;
			$temp_image['image2_type'] = $image2_type;
			$temp_image['image3_type'] = $image3_type;
			$temp_image['image4_type'] = $image4_type;
			
			$image_content_id = add_image_master($temp_image);
			
			$return_data                     = array();
			$return_data['image_content_id'] = $image_content_id;
			$return_data['image_path']       = $FolderMapping . $NewImageName;
			return $return_data;
		}
	}
	
	public function inactivate_poll_status($poll_id)
	{
		$change_status = $this->db->query("CALL update_poll_status('" . $poll_id . "', '0')");
		if($change_status == true)
		{
			$this->session->set_flashdata('success', 'Updated poll status successfully');
			redirect(base_url() . folder_name . '/poll_manager');
		}
		else
		{
			$this->session->set_flashdata('error', "Problem while updating status. Please try again");
			redirect(folder_name . '/poll_manager');
		}
		
	}
	
	public function change_status()
	{
		extract($_GET);
		
		$poll_id = $id;
		
		if($status == 0)
		{
			$status = 1;
		}
		elseif($status == 1)
		{
			$status = 0;
		}
		//print_r($_GET); exit;
		$change_status = $this->db->query("CALL update_poll_status('" . $poll_id . "', '" . $status . "')");
		
		
		
		if($change_status == true)
		{
			$this->session->set_flashdata('success', 'Updated poll status successfully');
			redirect(base_url() . folder_name . '/poll_manager');
		}
		else
		{
			$this->session->set_flashdata('error', "Problem while updating status. Please try again");
			redirect(folder_name . '/poll_manager');
		}
		
	}
	
	public function delete_poll($poll_id)
	{
		$del_query   = $this->db->query("CALL delete_poll('" . $poll_id . "')");
		$poll_delete = $this->db->affected_rows();
		if($poll_delete > 0)
		{
			$this->session->set_flashdata('success', 'Deleted successfully');
			redirect(base_url() . folder_name . '/poll_manager');
		}
		else
		{
			$this->session->set_flashdata('error', "Problem while deleting. Please try again");
			redirect(folder_name . '/poll_manager');
		}
		
	}
	
	public function fetch_poll_val($poll_id)
	{
		$fetch_details = $this->db->query('CALL select_poll_master("' . $poll_id . '")');
		return $fetch_details;
	}
	
	/*public function fetch_article_title($poll_id)
	{
	$fetch_article_title = $this->db->query('CALL select_article_title("'.$poll_id.'", "poll")');
	return $fetch_article_title;
	}*/
	
	public function poll_add($user_id)
	{
		extract($_POST);
		$oldimagename = trim($this->input->post('hidden_img_name'));
		$newimagename = trim($this->input->post('physical_name'));
				
		$image_content_id = 'NULL';
		$library_image_id   = '';
		$image_library_path = '';
		$temp_table_image_name = '';
		
		if($img_id != "" && $img_id != 0) 
		{
			$image_content_id   = $img_id;
			$image_library_path = $img_path;
		}
		
		if($temp_image_id != '' && $temp_image_id != 0) {
			$temp_image_save_details = $this->temp_custom_image_details($temp_image_id, '')->row_array();
			$temp_table_image_name = $temp_image_save_details['image_name']; 
			
			$is_image_uploaded = $temp_image_save_details;
			//if($temp_image_save_details['save_status'] == 1 || $temp_image_save_details['save_status'] == 2)
			{
				$is_image_uploaded['image1_type'] = $temp_image_save_details['image1_type']; //image value for 600X390
				$is_image_uploaded['image2_type'] = $temp_image_save_details['image2_type']; //image value for 600X300
				$is_image_uploaded['image3_type'] = $temp_image_save_details['image4_type']; //image value for 100X65
				$is_image_uploaded['image4_type'] = $temp_image_save_details['image3_type']; //image value for 150X150		
			}
			$is_image_uploaded['image_name']  = $temp_image_save_details['image_name'];
			$is_image_uploaded['save_status'] = $temp_image_save_details['save_status'];
		}
		
		//if($temp_image_id != '' && $temp_image_id != 0 && $image_library_id == "" && $img_id == "")
		if($img_id == "" && $image_library_id == "" &&  $temp_image_save_details['save_status'] == 1 || $temp_image_save_details['save_status'] == 2)
		{
			$is_image_uploaded['physical_name'] = $physical_name;
			$is_image_uploaded['image_alt']     = $image_alt;
			$is_image_uploaded['image_caption'] = $image_caption;
			$is_image_uploaded['temp_image_id'] = $temp_image_id;
			$is_image_uploaded['full_path']     = $full_path;
			
			
			$is_image_uploaded['image_library_id']     = $image_library_id;
			
			$get_image_data = $this->do_uploads($is_image_uploaded);
			
			$image_content_id   = $get_image_data['image_content_id'];
			$image_library_path = $get_image_data['image_path'];
		}
		elseif($image_library_id != "" && $image_library_id != 0 && $img_id == "") 
		{
			$ImageURL = get_image_by_contentid($image_library_id);

			$ImageDetails = GetImageDetailsByContentId($image_library_id);
			
			$image_library_path = $ImageDetails['ImagePhysicalPath'];
			$image_caption = $ImageDetails['ImageCaption'];
			$image_alt = $ImageDetails['ImageAlt'];
			$image_content_id   = $image_library_id;
		}
		
		$image_caption = htmlspecialchars(trim($image_caption));
		$image_caption = addslashes(str_replace("'", "&#039;", $image_caption));
		
		$image_alt = htmlspecialchars(trim($image_alt));
		$image_alt = addslashes(str_replace("'", "&#039;", $image_alt));
		
		$option_number = trim($this->input->post('ddOptions'));
		//$text1         = trim($this->input->post('txtOption1'));
		
		$text1 = htmlspecialchars(trim($this->input->post('txtOption1')));
		$text1 = addslashes(str_replace("'", "&#039;", $text1));
		
		//$text2         = trim($this->input->post('txtOption2'));
		
		$text2 = htmlspecialchars(trim($this->input->post('txtOption2')));
		$text2 = addslashes(str_replace("'", "&#039;", $text2));
		
		//$text3         = trim($this->input->post('txtOption3'));
		
		$text3 = htmlspecialchars(trim($this->input->post('txtOption3')));
		$text3 = addslashes(str_replace("'", "&#039;", $text3));
		
		//$text4         = trim($this->input->post('txtOption4'));
		
		$text4 = htmlspecialchars(trim($this->input->post('txtOption4')));
		$text4 = addslashes(str_replace("'", "&#039;", $text4));
		
		//$text5         = trim($this->input->post('txtOption5'));
		
		$text5 = htmlspecialchars(trim($this->input->post('txtOption5')));
		$text5 = addslashes(str_replace("'", "&#039;", $text5));
		
		$get_status = $this->input->post('view3');
		
		//$qstn = trim($this->input->post('txtQuestion'));
		//$qstn = str_replace ( "\'", "&quot;", addslashes($qstn) ) ; 
		
		$qstn = htmlspecialchars(trim($this->input->post('txtQuestion')));
		$qstn = addslashes(str_replace("'", "&#039;", $qstn));
		
		$hidden_id = $this->input->post('txtHiddenId');
		
		$hidden_contett_id = $this->input->post('hiddn_article_id');
		if($hidden_contett_id != "")
		{
			$get_article_id = $this->input->post('hiddn_article_id');
		}
		else
		{
			$get_article_id = 'NULL';
		}
		
		$this->db->trans_begin();
		if($hidden_id == "" or $hidden_id == 0)
		{
			if($get_status == 1)
			{
				$this->db->query("CALL update_poll_status('', '')");
			}
			$insrt_query = $this->db->query("CALL insert_poll('" . $qstn . "', " . $get_article_id . ", '" . $user_id . "' , '" . date("Y-m-d H:i:s") . "', '" . $image_library_path . "', '" . $image_caption . "','" . $user_id . "','" . date("Y-m-d H:i:s") . "', '" . $option_number . "', '" . $text1 . "', '" . $text2 . "','" . $text3 . "','" . $text4 . "', '" . $text5 . "', '" . $get_status . "', " . $image_content_id . ", '" . $image_alt . "')");
			$success_msg = 'Inserted Successfully';
			$fail_msg    = "Problem while inserting. Please try again";
		}
		else
		{
			if($get_status == 1)
			{
				$this->db->query("CALL update_poll_status('" . $hidden_id . "', '')");
			}
			
			$update_query = $this->db->query("CALL update_poll('" . $qstn . "', " . $get_article_id . ",'" . $user_id . "','" . date("Y-m-d H:i:s") . "','" . $hidden_id . "','" . $image_library_path . "','" . $image_caption . "', '" . $option_number . "', '" . $text1 . "', '" . $text2 . "','" . $text3 . "','" . $text4 . "', '" . $text5 . "', '" . $get_status . "',  " . $image_content_id . ", '" . $image_alt . "')");
			
			$success_msg = 'Updated Successfully';
			$fail_msg    = "Problem while updating. Please try again";
		}
		$this->delete_temp_custom_image_poll($temp_table_image_name, $temp_image_id);
		if($this->db->trans_status() == FALSE)
		{
			$this->db->trans_rollback();
			redirect(folder_name . '/poll_manager');
			$this->session->set_flashdata('error', $fail_msg);
		}
		else
		{
			$this->db->trans_commit();
			redirect(folder_name . '/poll_manager');
			$this->session->set_flashdata('success', $success_msg);
		}
		
	}
	
	public function search_internal_article()
	{
		extract($_POST);
		
		$Field          = $order[0]['column'];
		$order          = $order[0]['dir'];
		$article_start  = 0;
		$article_length = 70;
		
		$content_type = $article_Type;
		
		switch($Field = 2)
		{
			case 0:
				$order_field = 'm.title';
				break;
			case 1:
				$order_field = 's.Sectionname';
				break;
			case 2:
				$order_field = 'm.Modifiedon';
				break;
			default:
				$order_field = 'm.content_id';
		}
		
		if($content_id != '')
		{
			$content_where_condition = " AND m.content_id != " . $content_id . " ";
		}
		else
		{
			$content_where_condition = "";
		}
		
		$Total_rows = $this->db->query('CALL get_link_article_content ("'.$content_where_condition.' ","","","","","")')->num_rows();
		
		$Search_value = $Search_text;
		
		if($Search_by == 'article_id')
		{
			$Search_result = filter_var($Search_text, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);
			
			if($Search_result == '')
				$Search_value = $Search_text;
			else
				$Search_value = $Search_result;
		}
		
		if($check_in != '')
		{
			$check_in_date = new DateTime($check_in);
			$check_in      = $check_in_date->format('Y-m-d');
		}
		
		if($check_out != '')
		{
			$check_out_date = new DateTime($check_out);
			$check_out      = $check_out_date->format('Y-m-d');
		}
		
		$article_manager = $this->db->query('CALL get_link_article_content ("' . $content_where_condition . 'ORDER BY ' . $order_field . ' ' . $order . ' LIMIT ' . $article_start . ', ' . $article_length . '","' . $check_in . '","' . $check_out . '","' . $Search_value . '","' . $Section . '","' . $Status . '")')->result_array();
		
		
		
		$recordsFiltered = $this->db->query('CALL get_link_article_content ("' . $content_where_condition . ' ","' . $check_in . '","' . $check_out . '","' . $Search_value . '","' . $Section . '","' . $Status . '")')->num_rows();
		
		$data['draw']            = $draw;
		$data["recordsTotal"]    = $Total_rows;
		$data["recordsFiltered"] = $recordsFiltered;
		$data['data']            = array();
		$Count                   = 0;
		
		
		foreach($article_manager as $article)
		{
			$subdata = array();
			
			$subdata[] = '<div align="center"><p title="' . strip_tags($article['title']) . '" href="">' . shortDescription(strip_tags($article['title'])) . '</p></div>';
			$subdata[] = $article['URLSectionStructure'];
			$subdata[] = $article['Modifiedon'];
			
			
			$subdata[] = '<input type="hidden" id="hidden_txt' . $article['content_id'] . '" value="' . strip_tags($article['title']) . '"><a href="javascript:void(0);" long_title ="' . strip_tags($article['title']) . '" short_title="' . shortDescription(strip_tags($article['title'])) . '" value="' . $article['content_id'] . '" rel="article"  onclick="get_content_id(' . $article['content_id'] . ', hidden_txt' . $article['content_id'] . '.value)"  title="Link"  data-toggle="tooltip" class="button tick" data-original-title="Add" id="internal_action" ><i class="fa fa-plus"></i></a>';
			
			$data['data'][$Count] = $subdata;
			$Count++;
		}
		
		if($recordsFiltered == 0)
		{
			
		}
		
		echo json_encode($data);
		exit;
	}
	
	public function pagination_datatable()
	{
		extract($_POST);
		
		$Field = $order[0]['column'];
		$order = $order[0]['dir'];
		
		switch($Field)
		{
			case 0:
				$order_field = 'PollQuestion';
				break;
			case 1:
				$order_field = 'title';
				break;
			case 2:
				$order_field = 'Username';
				break;
			case 3:
				$order_field = 'total_count';
				break;
			case 4:
				$order_field = 'Createdon';
				break;
			case 5:
				$order_field = 'Status';
				break;
			default:
				$order_field = 'Poll_id';
		}
		
		
		$Total_rows = $this->db->query('CALL poll_datatable("","","","","","")')->num_rows();
		
		
		
		if($from_date != '')
		{
			$check_in_date = new DateTime($from_date);
			$from_date     = $check_in_date->format('Y-m-d');
		}
		
		if($to_date != '')
		{
			$check_out_date = new DateTime($to_date);
			$to_date        = $check_out_date->format('Y-m-d');
		}
		
		$searchtxt = htmlspecialchars(trim($searchtxt));
		$searchtxt = addslashes(str_replace("'", "&#039;", $searchtxt));
		
		$poll_values = $this->db->query('CALL poll_datatable(" ORDER BY ' . $order_field . ' ' . $order . ' LIMIT ' . $start . ', ' . $length . '","' . $from_date . '","' . $to_date . '","' . $searchtxt . '","' . $search_by . '","' . $Status . '")')->result_array();
		
		
		//echo $this->db->last_query();
		$recordsFiltered         = $this->db->query('CALL poll_datatable("","' . $from_date . '","' . $to_date . '","' . $searchtxt . '","' . $search_by . '","' . $Status . '")')->num_rows();
		$data['draw']            = $draw;
		$data["recordsTotal"]    = $Total_rows;
		$data["recordsFiltered"] = $recordsFiltered;
		$data['data']            = array();
		$Count                   = 0;
		
		$Menu_id = get_menu_details_by_menu_name('Poll');
		
		foreach($poll_values as $poll)
		{
			$subdata = array();
			
			$poll_title = str_replace("&quot;", "''", $poll['PollQuestion']);
			
			$subdata[] = '<p class="tooltip_cursor" title="' . ($poll_title) . '">' . mb_substr(($poll['PollQuestion']), 0, 20) . '...' . '</p>';
			if($poll['Content_ID'] != "")
			{
				$subdata[] = '<p class="tooltip_cursor" title="' . strip_tags($poll['title']) . '">' . mb_substr(strip_tags($poll['title']), 0, 20) . '...' . '</p>';
			}
			else
			{
				$subdata[] = '-';
			}
			$subdata[] = $poll['Username'];
			if($poll['total_count'] != 0 && $poll['total_count'] != "")
			{
				$subdata[] = $poll['total_count'];
			}
			else
			{
				$subdata[] = '-';
			}
			
			$subdata[] = date("d-m-Y h:i:s A", strtotime($poll['Createdon']));
			
			if($poll['Status'] == 1)
			{
				$status_icon = '<i title="Active" id="status_img' . $poll['Poll_id'] . '"  class="fa fa-check"></i>';
			}
			elseif($poll['Status'] == 0)
			{
				$status_icon = '<i title="Inactive" id="status_img' . $poll['Poll_id'] . '" class="fa fa-times"></i>';
			}
			$subdata[] = $status_icon;
			
			$set_rights = "";
			
			if(defined("USERACCESS_EDIT" . $Menu_id) && constant("USERACCESS_EDIT" . $Menu_id) == 1)
			{
				$set_rights .= '<div class="buttonHolder"><a class="button heart tooltip-3"  href="' . base_url() . folder_name . '/poll_manager/update_poll/' . urlencode(base64_encode($poll['Poll_id'])) . '" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a>';
			}
			else
			{
				$set_rights .= "";
			}
			
			
			if($poll['Status'] == 1)
			{
				$set_rights .= '<a class="button heart tooltip-3" href="#" data-toggle="tooltip" onclick="change_status(' . $poll['Poll_id'] . ', ' . $poll['Status'] . ')" title="Inactive"  id=""> <i class="fa fa-pause"></i> </a></div>';
			}
			else
			{
				$set_rights .= '<a class="button heart tooltip-3" href="#" data-toggle="tooltip" onclick="change_status(' . $poll['Poll_id'] . ', ' . $poll['Status'] . ')" title="Inactive"  id=""> <i class="fa fa-caret-right"></i> </a></div>';
			}
			
			
			$subdata[] = $set_rights;
			
			$subdata[] = '<a class="button heart tooltip-3" target="_blank" href="' . base_url() . folder_name . '/poll_manager/get_poll_result/' . urlencode(base64_encode($poll['Poll_id'])) . '" data-toggle="tooltip"  title="View Result"  id=""> <i class="fa fa-eye"></i> </a>';
			
			//$subdata[] = '<a class="button heart tooltip-3"  href="#" poll_id="'.$poll['Poll_id'].'" data-toggle="tooltip"  title="View Result"  id="view_poll_result"> <i class="fa fa-eye"></i> </a>';
			$data['data'][$Count] = $subdata;
			$Count++;
		}
		
		if($recordsFiltered == 0)
		{
			
		}
		echo json_encode($data);
		exit;
		
	}
	
	
	public function custom_image_upload($userid, $imagecontent_id, $contenttype, $caption, $alt_tag, $physical_name, $file_name, $image1_type, $image2_type, $image3_type, $image4_type, $display_order, $article_id, $instance_id, $mainSectionConfig_id)
	{
		
		$createdon            = date('Y-m-d H:i:s');
		$modifiedon           = date('Y-m-d H:i:s');
		$mainSectionConfig_id = ($mainSectionConfig_id == '') ? 'NULL' : $mainSectionConfig_id;
		$query                = $this->db->query("CALL insert_temp_poll_image('" . $userid . "'," . $imagecontent_id . ",'" . $contenttype . "','" . addslashes($caption) . "','" . addslashes($alt_tag) . "','" . addslashes($physical_name) . "','" . addslashes($file_name) . "'," . $image1_type . "," . $image2_type . "," . $image3_type . "," . $image4_type . "," . $display_order . ",'" . $createdon . "','" . $modifiedon . "',@insert_id,'" . $instance_id . "','" . $mainSectionConfig_id . "','" . $article_id . "')");
		
		$query    = $this->db->query("SELECT @insert_id");
		$returnid = $query->result_array();
		
		if(isset($returnid[0]['@insert_id']) && $returnid[0]['@insert_id'] != '')
		{
			
			$data['image_id']        = $returnid[0]['@insert_id'];
			$data['imagecontent_id'] = $imagecontent_id;
			$data['caption']         = $caption;
			$data['alt_tag']         = $alt_tag;
			$data['physical_name']   = $physical_name;
			
			
			switch($contenttype)
			{
				case 1:
					$data['image'] = image_url . poll_temp_image_path . $file_name;
					break;
				case 2:
					$data['image'] = image_url . imagelibrary_temp_image_path . $file_name;
					break;
				case 3:
					$data['image'] = image_url . gallery_temp_image_path . $file_name;
					break;
				case 4:
					$data['image'] = image_url . video_temp_image_path . $file_name;
					break;
				case 5:
					$data['image'] = image_url . audio_temp_image_path . $file_name;
					break;
				case 6:
					$data['image'] = image_url . resource_temp_image_path . $file_name;
					break;
			}
			
			$PhysicalExtension_array    = explode('.', $file_name);
			$data['physical_extension'] = $PhysicalExtension_array[1];
			
			$data['image1_type'] = $image1_type;
			$data['image2_type'] = $image1_type;
			$data['image3_type'] = $image1_type;
			$data['image4_type'] = $image1_type;
			
		}
		else
		{
			echo '{"type":1,"message":"Invalid image, please try again","line":0}';
			exit;
		}
		return $data;
	}
	
	public function search_image_library($Caption)
	{
		//$Order = "ORDER BY Modifiedon desc LIMIT 0, 16";	
		$Order = "ORDER BY Modifiedon desc LIMIT 0, 12";
		//$Order = "ORDER BY Modifiedon DESC";
		if($Caption != '')
			$search = $this->db->query('CALL search_image_related_data("' . $Caption . '","' . $Order . '")');
		else
			$search = $this->db->query('CALL get_image_related_data("' . $Order . '")');
		
		return $search->result();
	}
	
	public function Insert_temp_from_image_library($ImageDetails, $content_id, $caption, $alt, $path, $contenttype, $article_id, $instance_id, $mainSectionConfig_id, $NewImageName)
	{
		$Image1Type   = $ImageDetails['Image1Type'];
		$Image2Type   = $ImageDetails['Image2Type'];
		$Image3Type   = $ImageDetails['Image3Type'];
		$Image4Type   = $ImageDetails['Image4Type'];
		$createdon    = $modifiedon = date('Y-m-d H:i:s');
		$PhysicalName = GetPhysicalNameFromPhysicalPath($ImageDetails['ImagePhysicalPath']);
		
		$query = $this->db->query("CALL insert_temp_poll_image('" . USERID . "'," . $content_id . ",'" . $contenttype . "','" . addslashes($caption) . "','" . addslashes($alt) . "','" . addslashes($PhysicalName) . "','" . addslashes($path) . "'," . $Image1Type . "," . $Image2Type . "," . $Image3Type . "," . $Image4Type . ",1,'" . $createdon . "','" . $modifiedon . "',@insert_id,'" . $instance_id . "','" . $mainSectionConfig_id . "','" . $article_id . "')");
		
		$result           = $this->db->query("SELECT @insert_id")->result_array();
		$image_temp_id    = $result[0]['@insert_id'];
		$data['image_id'] = $image_temp_id;
		$data['source']   = image_url . poll_temp_image_path . $path;
		
		$Physical_extension_array = explode(".", $path);
		
		$data['caption'] = $caption;
		$data['alt']     = $alt;
		
		$data['physical_name']      = $PhysicalName;
		$data['physical_extension'] = $Physical_extension_array[1];
		$data['orig_name']          = $PhysicalName . '.' . $Physical_extension_array[1];
		
		$data['temp_name'] = $NewImageName . '.' . $Physical_extension_array[1];
		
		$data['imagecontent_id'] = $content_id;
		$data['image1_type']     = $Image1Type;
		$data['image2_type']     = $Image2Type;
		$data['image3_type']     = $Image3Type;
		$data['image4_type']     = $Image4Type;
		
		return $data;
	}
	
	public function search_image_library_scroll($page)
	{
		$offset  = ($page * 12) - 12;
		$Caption = $this->session->userdata('image_caption');
		
		$Order = "ORDER BY Modifiedon desc LIMIT " . $offset . ", 12";
		
		if($Caption != '')
			$search = $this->db->query('CALL search_image_related_data("' . $Caption . '","' . $Order . '")');
		else
			$search = $this->db->query('CALL get_image_related_data("' . $Order . '")');
		
		return $search->result();
	}
	
	public function temp_custom_image_details($temp_table_image_id, $saved_image_id)
	{
		return $query = $this->db->query("CALL temp_poll_image_data('" . $temp_table_image_id . "','" . $saved_image_id . "')");
	}
	
	
	public function common_resize_all_images($ImageDetails)
	{
		try
		{
			$ArrayImage = $ImageDetails;
			
			$physical_name   = $ArrayImage['physical_name'];
			$image1_type     = $ArrayImage['image1_type'];
			$image2_type     = $ArrayImage['image2_type'];
			$image3_type     = $ArrayImage['image3_type'];
			$image4_type     = $ArrayImage['image4_type'];
			$image_name      = $ArrayImage['image_name'];
			$imageid         = $ArrayImage['imageid'];
			$imagecontent_id = $ArrayImage['imagecontent_id'];
			$contenttype     = $ArrayImage['contenttype'];
			$caption         = $ArrayImage['caption'];
			$alt_tag         = $ArrayImage['alt_tag'];
			
			$TempSourceURL = poll_temp_image_path;
			
			
			$Image600X390 = str_replace(".", "_600_390.", $image_name);
			$Image600X300 = str_replace(".", "_600_300.", $image_name);
			$Image100X65  = str_replace(".", "_100_65.", $image_name);
			$Image150X150 = str_replace(".", "_150_150.", $image_name);
			
			
			$image_binary_bool1 = false;
			$image_binary_bool2 = false;
			$image_binary_bool3 = false;
			$image_binary_bool4 = false;
			
			if(isset($image_name))
			{
				$ImagePath = source_base_path . poll_temp_image_path;
				
				$src = $ImagePath . $image_name;
				
				if(file_exists($src))
				{
					$ImageDetails = getimagesize($src);
					
					$ImageExtension = explode("/", $ImageDetails['mime']);
					$extType        = strtolower($ImageExtension[1]);
					
					if(!empty($src))
					{
						switch($extType)
						{
							case 'gif':
								$src_img = imagecreatefromgif($src);
								break;
							
							case 'jpg':
								$src_img = imagecreatefromjpeg($src);
								break;
							
							case 'jpeg':
								$src_img = imagecreatefromjpeg($src);
								break;
							
							case 'png':
								$src_img = imagecreatefrompng($src);
								break;
						}
						if(!$src_img)
						{
							$result_value['status'] = 'error';
							$result_value['msg']    = "Failed to read the image file";
							return json_encode($result_value);
						}
						
						$size  = getimagesize($src);
						$src_w = $size[0]; // natural width
						$src_h = $size[1]; // natural height	
						
						
						if(!file_exists(source_base_path . $TempSourceURL . $Image600X390))
						{
							
							$dst_w = 600;
							$dst_h = 390;
							
							$dst_img = imagecreatetruecolor($dst_w, $dst_h);
							$dst     = $ImagePath . str_replace(".", "_600_390.", $image_name);
							
							//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
							$source_ratio      = $src_w / $src_h;
							$destination_ratio = $dst_w / $dst_h;
							
							// crop to fit 
							if($source_ratio > $destination_ratio)
							{
								// source has a wider ratio 
								$temp_width  = (int) ($src_h * $destination_ratio);
								$temp_height = $src_h;
								$source_x    = (int) (($src_w - $temp_width) / 2);
								$source_y    = 0;
							}
							else
							{
								// source has a taller ratio 
								$temp_width  = $src_w;
								$temp_height = (int) ($src_w / $destination_ratio);
								$source_x    = 0;
								$source_y    = (int) (($src_h - $temp_height) / 2);
							}
							$destination_x          = 0;
							$destination_y          = 0;
							$source_width           = $temp_width;
							$source_height          = $temp_height;
							$new_destination_width  = $dst_w;
							$new_destination_height = $dst_h;
							
							
							$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
							if($result)
							{
								if(imagejpeg($dst_img, $dst))
								{
									$ImageDetails = getimagesize($dst);
									$width        = $ImageDetails[0];
									$height       = $ImageDetails[1];
									$size         = $ImageDetails['bits'];
									$imagetype    = $ImageDetails['mime'];
									
									$image_binary_bool1 = true;
									
									$image1_type = 1;
									
									imagedestroy($dst_img);
								}
							}
						}
						
						if(!file_exists(source_base_path . $TempSourceURL . $Image600X300))
						{
							$dst_w = 600;
							$dst_h = 300;
							
							$dst_img = imagecreatetruecolor($dst_w, $dst_h);
							$dst     = $ImagePath . str_replace(".", "_600_300.", $image_name);
							
							//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
							$source_ratio      = $src_w / $src_h;
							$destination_ratio = $dst_w / $dst_h;
							
							// crop to fit 
							if($source_ratio > $destination_ratio)
							{
								// source has a wider ratio 
								$temp_width  = (int) ($src_h * $destination_ratio);
								$temp_height = $src_h;
								$source_x    = (int) (($src_w - $temp_width) / 2);
								$source_y    = 0;
							}
							else
							{
								// source has a taller ratio 
								$temp_width  = $src_w;
								$temp_height = (int) ($src_w / $destination_ratio);
								$source_x    = 0;
								$source_y    = (int) (($src_h - $temp_height) / 2);
							}
							$destination_x          = 0;
							$destination_y          = 0;
							$source_width           = $temp_width;
							$source_height          = $temp_height;
							$new_destination_width  = $dst_w;
							$new_destination_height = $dst_h;
							
							
							$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
							if($result)
							{
								if(imagejpeg($dst_img, $dst))
								{
									$ImageDetails = getimagesize($dst);
									$width        = $ImageDetails[0];
									$height       = $ImageDetails[1];
									$size         = $ImageDetails['bits'];
									$imagetype    = $ImageDetails['mime'];
									
									$image_binary_bool2 = true;
									$image2_type        = 1;
									
									imagedestroy($dst_img);
								}
							}
						}
						
						if(!file_exists(source_base_path . $TempSourceURL . $Image150X150))
						{
							$dst_w = 150;
							$dst_h = 150;
							
							$dst_img = imagecreatetruecolor($dst_w, $dst_h);
							$dst     = $ImagePath . str_replace(".", "_150_150.", $image_name);
							
							//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
							$source_ratio      = $src_w / $src_h;
							$destination_ratio = $dst_w / $dst_h;
							
							// crop to fit 
							if($source_ratio > $destination_ratio)
							{
								// source has a wider ratio 
								$temp_width  = (int) ($src_h * $destination_ratio);
								$temp_height = $src_h;
								$source_x    = (int) (($src_w - $temp_width) / 2);
								$source_y    = 0;
							}
							else
							{
								// source has a taller ratio 
								$temp_width  = $src_w;
								$temp_height = (int) ($src_w / $destination_ratio);
								$source_x    = 0;
								$source_y    = (int) (($src_h - $temp_height) / 2);
							}
							$destination_x          = 0;
							$destination_y          = 0;
							$source_width           = $temp_width;
							$source_height          = $temp_height;
							$new_destination_width  = $dst_w;
							$new_destination_height = $dst_h;
							
							
							$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
							if($result)
							{
								if(imagejpeg($dst_img, $dst))
								{
									$ImageDetails = getimagesize($dst);
									$width        = $ImageDetails[0];
									$height       = $ImageDetails[1];
									$size         = $ImageDetails['bits'];
									$imagetype    = $ImageDetails['mime'];
									
									
									$image_binary_bool4 = true;
									$image3_type        = 1;
									
									imagedestroy($dst_img);
								}
							}
						}
						
						if(!file_exists(source_base_path . $TempSourceURL . $Image100X65))
						{
							
							$dst_w = 100;
							$dst_h = 65;
							
							$dst_img = imagecreatetruecolor($dst_w, $dst_h);
							$dst     = $ImagePath . str_replace(".", "_100_65.", $image_name);
							
							//$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
							$source_ratio      = $src_w / $src_h;
							$destination_ratio = $dst_w / $dst_h;
							
							// crop to fit 
							if($source_ratio > $destination_ratio)
							{
								// source has a wider ratio 
								$temp_width  = (int) ($src_h * $destination_ratio);
								$temp_height = $src_h;
								$source_x    = (int) (($src_w - $temp_width) / 2);
								$source_y    = 0;
							}
							else
							{
								// source has a taller ratio 
								$temp_width  = $src_w;
								$temp_height = (int) ($src_w / $destination_ratio);
								$source_x    = 0;
								$source_y    = (int) (($src_h - $temp_height) / 2);
							}
							$destination_x          = 0;
							$destination_y          = 0;
							$source_width           = $temp_width;
							$source_height          = $temp_height;
							$new_destination_width  = $dst_w;
							$new_destination_height = $dst_h;
							
							
							$result = imagecopyresampled($dst_img, $src_img, $destination_x, $destination_y, $source_x, $source_y, $new_destination_width, $new_destination_height, $source_width, $source_height);
							if($result)
							{
								if(imagejpeg($dst_img, $dst))
								{
									$ImageDetails = getimagesize($dst);
									$width        = $ImageDetails[0];
									$height       = $ImageDetails[1];
									$size         = $ImageDetails['bits'];
									$imagetype    = $ImageDetails['mime'];
									
									$image_binary_bool3 = true;
									$image4_type        = 1;
									
									imagedestroy($dst_img);
								}
							}
						}
						
						if($image_binary_bool1 == true || $image_binary_bool2 == true || $image_binary_bool3 == true || $image_binary_bool4 == true)
						{
							
							$imagecontent_id = 'NULL';
							
							$caption = str_replace("'", '"', $caption);
							$alt     = str_replace("'", '"', $alt_tag);
							
							$createdon = $modifiedon = date('Y-m-d H:i:s');
							
							$query = $this->db->query("CALL update_full_temp_images('" . $imageid . "','" . USERID . "'," . $imagecontent_id . ",'" . $contenttype . "','" . addslashes($caption) . "','" . addslashes($alt_tag) . "','" . addslashes($physical_name) . "','" . addslashes($image_name) . "'," . $image1_type . "," . $image2_type . "," . $image3_type . "," . $image4_type . ",1,'" . $createdon . "','" . $modifiedon . "')");
							
							imagedestroy($src_img);
						}
					}
				}
				else
				{
					redirect(folder_name);
				}
			}
			else
			{
				$result_value['status'] = 'error';
				$result_value['msg']    = "Invalid Image";
				echo json_encode($result_value);
			}
			
			
			return true;
		}
		catch(Exception $e)
		{
			$result_value['status'] = 'error';
			$result_value['msg']    = 'Caught exception: ' . $e->getMessage() . "\n";
			echo json_encode($result_value);
		}
	}
	
	function delete_temp_custom_image($custom_image_tempid)
	{
		$query = $this->db->query("CALL delete_poll_temp_image ('" . $custom_image_tempid . "')");
	}
	
	function update_custom_crop_image($ContentImageId, $crop_caption, $crop_alt, $image_600X390_type, $image_600X300_type, $image_100X65_type, $image_150X150_type, $modifiedon, $crop_image_id, $imagetype, $commit_status)
	{
		$CI =& get_instance();
		
		$crop_caption = str_replace("'", '"', $crop_caption);
		$crop_alt     = str_replace("'", '"', $crop_alt);
		
		$query = $CI->db->query("CALL update_poll_crop_image('" . $ContentImageId . "','" . $crop_caption . "','" . $crop_alt . "','" . $image_600X390_type . "','" . $image_600X300_type . "','" . $image_100X65_type . "','" . $image_150X150_type . "','" . $modifiedon . "','" . $crop_image_id . "','" . $imagetype . "','" . $commit_status . "')");
		
		return $query;
		
	}
	
	public function add_image_by_temp_id($caption, $alt, $home_physical_name, $tempid)
	{
		
		$NewImageName		= '';
		$DestinationURL 	= imagelibrary_image_path;
							
		$Year = date('Y');
		$Month = date('n');
		$Day =  date('j');
			
		create_image_folder( $Year, $Month, $Day);
		$FolderMapping = $Year."/".$Month."/".$Day."/original/";
		
		$query = $this->temp_custom_image_details($tempid, '');
		$temp_image = $query->row_array();
		
		if(isset($temp_image['contenttype'])) {
			$TempSourceURL = article_temp_image_path;
		
			$query = $this->temp_custom_image_details($tempid, '');						
			$TempObject = $query->result();
			
			$Resize_Class = new Common_Resize_class();
			$Resize_Class->common_resize_all_images($TempObject);
		
		if((isset($temp_image['imageid']) && ($temp_image['imagecontent_id'] == "NULL" || $temp_image['imagecontent_id'] == "" || $temp_image['imagecontent_id'] == 0)) || ($temp_image['save_status'] == 2 ) || (  trim($temp_image['caption']) != trim($caption) || trim($temp_image['alt_tag']) != trim($alt) || trim($temp_image['physical_name']) != trim($home_physical_name) ) )
		{	
			$image_name = explode('.',$temp_image['image_name']);
			$NewImageName = $home_physical_name.'.'.$image_name[1];
			
			ImageDeleteAndPasteToLibrary($temp_image['image_name'],$NewImageName, $TempSourceURL, $DestinationURL, $FolderMapping);
			
			$query = $this->temp_custom_image_details($tempid, '');
			
			$temp_image = $query->row_array();
		
			$temp_image['caption']      = trim($caption);
			$temp_image['alt_tag'] 		= trim($alt);
			$temp_image['image_name'] 	= $FolderMapping.$NewImageName;
			
			$image_details =  add_image_master($temp_image);						
			
			///// Delete the Temp Images in Table /////						
			$query = $this->db->query("CALL delete_temp_custom_image ('" . $tempid . "')");
			return $image_details ;
			
		} else {
			
			$ImageDetails = get_imagedetails_by_contentid($temp_image['imagecontent_id']);
			$PhysicalName = end(explode("/",$ImageDetails['ImagePhysicalPath']));
			
			$PhysicalPath = str_replace($PhysicalName,"",$ImageDetails['ImagePhysicalPath']);
			
			if(ImageDeleteAndPasteToLibrary($temp_image['image_name'],$PhysicalName, $TempSourceURL, $DestinationURL, $PhysicalPath)) {
				DeleteTempImage($temp_image['image_name'],$tempid, $TempSourceURL);
			}

			return $temp_image['imagecontent_id'];
			
		}
		
	}
	}
	
	
	public function delete_temp_custom_image_poll($temp_table_image_name, $temp_image_id)
	{
		$TempSourceURL = poll_temp_image_path;
		/* Delete existed temporary images */
		DeleteTempImage($temp_table_image_name, $temp_image_id, $TempSourceURL);
		$this->delete_temp_custom_image($temp_image_id);
	}
}
?>