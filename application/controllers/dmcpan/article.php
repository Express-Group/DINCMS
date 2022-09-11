<?php

/**
 * Article Controller Class
 *
 * @package	NewIndianExpress
 * @category	News
 * @author	IE Team
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');
class Article extends CI_Controller

{
	
	public function __construct()

	{
		parent::__construct();
		$this->load->model('admin/article_model');
		$this->load->model('admin/common_model');
		$this->load->model('admin/article_image_model');
		$this->load->model('admin/live_content_model');
		$this->load->model('admin/image_model');

	}
	public function index()

	{
		
 
		$data['Menu_id'] = get_menu_details_by_menu_name('Article');
		
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD".$data['Menu_id']) == 1) {
	
		$data['get_country'] 		= $this->common_model->get_country_details();
		$data['get_agency'] 		= $this->common_model->get_agency_details();
		$data['section_mapping'] 	= $this->common_model->multiple_section_mapping();

		$data['get_content_type'] 	= $this->common_model->get_content_type();
		$data['image_library'] 		= $this->article_image_model->get_image_library();
		
		//$this->image_model->DeleteTempAllImages(1);
		
		if (set_value('ddState') != '') $data['get_state'] = $this->common_model->get_state_details(set_value('ddCountry'));
		if (set_value('ddCity') != '') $data['get_city'] = $this->common_model->get_city_details(set_value('ddCountry') , set_value('ddState'));
		/*if (set_value('ddAgency') != '') $data['get_byline'] = $this->common_model->get_author_agency_id(set_value('ddAgency'));*/
		
		$data['title'] 				= 'Create Article';
		$data['template'] 			= 'article';
		if($this->input->post('utm')=='agencies' || $this->input->post('utm')=='printdesk'){
			if($this->input->post('content_image')!=''){
				$imageresponse = $this->saveprintdeskimage($this->input->post('content_image'));
				$data['utm_imgid'] = $imageresponse['id'];
				$data['utm_imgcaption'] = $imageresponse['article_caption'];
				$data['utm_imgalt'] = $imageresponse['article_alt'];
				$data['utm_imgname'] = $imageresponse['imagename'];
				$data['utm_t_image_id'] = $imageresponse['t_image_id'];
			}
			$data['template'] 			= 'agencies_article';
		}
		$this->load->view('admin_template', $data);
		
		} else {
			redirect(folder_name.'/common/access_permission/add_article');
		}
	
	}
	
	public function saveprintdeskimage($ImageName){
		$ImageYear=date('Y');
		$ImageMonth=date('n');
		$ImageDate=date('j');
		$folderArray=['/original','/w100X65','/w150X150','/w600X300','/w600X390'];
		$SourceUrl='http://printimg.newindianexpress.com/dm_image/';
		$DestinationUrl=destination_base_path.imagelibrary_image_path;
		$imagesizes=array();
		$imagesizes[0]=[0,0];
		$imagesizes[1]=[100,65];
		$imagesizes[2]=[150,150];
		$imagesizes[3]=[600,300];
		$imagesizes[4]=[600,390];
		if(!is_dir($DestinationUrl.$ImageYear)){	mkdir($DestinationUrl.$ImageYear); chmod($DestinationUrl.$ImageYear , 0777); }	
		if(!is_dir($DestinationUrl.$ImageYear.'/'.$ImageMonth)){	mkdir($DestinationUrl.$ImageYear.'/'.$ImageMonth);chmod($DestinationUrl.$ImageYear.'/'.$ImageMonth , 0777);	}
		if(!is_dir($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate)){ mkdir($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate); chmod($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate, 0777);	}
		for($i=0;$i<count($folderArray);$i++):
			if(!is_dir($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$i])){
				mkdir($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$i]);
				chmod($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$i], 0777);
			}
		endfor;
		$ImageNamePosition=strrpos($ImageName,'/');
		$NewImageName=substr($ImageName,$ImageNamePosition + 1);
		copy($SourceUrl.$ImageName,$DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[0].'/'.$NewImageName);
		chmod($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[0].'/'.$NewImageName, 0777);
		$this->load->library('image_lib'); 
		for($j=1;$j<count($folderArray);$j++){
			copy($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[0].'/'.$NewImageName,$DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$j].'/'.$NewImageName);
			chmod($DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$j].'/'.$NewImageName,0777);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $DestinationUrl.$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[$j].'/'.$NewImageName;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['width']         = $imagesizes[$j][0];
			$config['height']       = $imagesizes[$j][1];
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
		$CaptionName = explode('.',$NewImageName);
		$fname =$ImageYear.'/'.$ImageMonth.'/'.$ImageDate.$folderArray[0].'/'.$NewImageName;
		$this->load->database();
		$this->db->insert('imagemaster',['ImageCaption' =>@$CaptionName[0] , 'ImageAlt' =>@$CaptionName[0] , 'ImagePhysicalPath' => $fname ,'Image1Type' =>2, 'Image2Type'=>2 ,'Image3Type' => 2, 'Image4Type' => 2, 'status' => 1 , 'Createdby' =>USERID ,'Createdon' => date('Y-m-d h:i:s'),'Modifiedby' =>USERID ,'Modifiedon' => date('Y-m-d h:i:s')]);
		$img['id']=$this->db->insert_id();
		$img['imagename']=$fname;
		$img['article_caption']=@$CaptionName[0];
		$img['article_alt']=@$CaptionName[0];
		$NewImageName		= md5(rand(10000000000000000,99999999999999999).date('yymmddhis'));
		$SourceURL  		= imagelibrary_image_path;
		$DestinationURL		= article_temp_image_path;
		$path = $fname;
		$NewPath = GenerateNewImageName($path, $NewImageName);
		ImageLibraryCopyToTemp($path,$NewPath, $SourceURL, $DestinationURL);
		$path = $NewPath;
		$createdon 		= $modifiedon = date('Y-m-d H:i:s');
		$PhysicalName = GetPhysicalNameFromPhysicalPath($fname);
		$this->db->insert('image_temp_gallery',['user_id' =>USERID , 'imagecontent_id' =>$img['id'] , 'contenttype' => 1 ,'caption' =>@$CaptionName[0], 'alt_tag'=>@$CaptionName[0] ,'physical_name' => addslashes($PhysicalName), 'image_name' => addslashes($path), 'image1_type' => 2 , 'image2_type' =>2 ,'image3_type' => 2,'image4_type' =>2,'display_order' =>1,'save_status'=>1,'crop_resize_status'=>0,'createdon'=>$createdon,'modifiedon'=>$createdon]);
		$img['t_image_id']  = $this->db->insert_id();
		return $img;
	
	}
	
	public function create_article()
	
	{

	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('txtArticleHeadLine', 'Article Head Line', 'required|trim');
		$this->form_validation->set_rules('ddMainSection', 'Section', 'required|trim');
		
		if ($this->input->post('txtStatus') != 'D')
		{
			$this->form_validation->set_rules('txtMetaTitle', 'Meta Title', 'required|trim');
			$this->form_validation->set_rules('txtBodyText', 'Body Text', 'required|trim');
		}
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			if($this->article_model->insert_article()) {
			
			if ($this->input->post('txtStatus') == 'P')
				$this->session->set_flashdata('success', 'Article Published Successfully');
			else if ($this->input->post('txtStatus') == 'D')
				$this->session->set_flashdata('success', 'Article Drafted Successfully');
			else
				$this->session->set_flashdata('success', 'Article Send to Approval Successfully');
		 
				$this->session->set_userdata('main_section',$this->input->post('ddMainSection'));
		 
			} else {
				$this->session->set_flashdata('error', "Doesn't create article, Try Again");
			}
			 
			 if($this->input->post('page_status')==1){
				echo "<script type='text/javascript'>window.close();</script>"; 
			 }else{
				redirect(folder_name.'/article_manager'); 
			 }
				
		}
	}
	/*
	* Search the related contents in article
	*
	* @access public
	* @param Ajax call post values
	* @return JSON format array values
	*/
	
	public function search_internal_article()

	{
		$this->article_model->search_internal_article();
	}
}
/* End of file article.php */
/* Location: ./application/controllers/article.php */