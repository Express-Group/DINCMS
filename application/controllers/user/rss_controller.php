<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss_controller extends CI_Controller {

	public function __construct() 
	{		
		parent::__construct();
			$this->load->model("admin/widget_model");
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->live_db = $CI->load->database('live_db', TRUE);
		
		$CI = &get_instance();
		//setting the second parameter to TRUE (Boolean) the function will return the database object.
		$this->archive_db = $CI->load->database('archive_db', TRUE);
		
	} 
	
	public function index()
	{
		$view_mode           = "live";
		$page_type		     = "1"; //rss section
		$this->load->library("memcached_library");
		//$this->memcached_library->flush();  // To clear the Memacache  , Un Comment this line
		$this->load->library("template_library");  // custom library to load xml and widgets;
		$section_id  =  $this->input->get('id');
	    $section_id  =  $this->widget_model->get_sectionDetails($section_id, $view_mode);
		$parent_section_name = '';
	   if(count($section_id)>0)
	   {
			if($section_id['ParentSectionID']!=''&& $section_id['ParentSectionID']!=0 ){
				 $parent_section     = $this->widget_model->get_sectionDetails($section_id['ParentSectionID'], $view_mode);
				 $data['Parentsection'] = ($parent_section['Sectionname']!='')? $parent_section['Sectionname'] : '';
				 $parent_section_name   = strtolower($parent_section['URLSectionName']);
			}else{
			$data['Parentsection'] = '';
			}
			$data['url_section'] = base_url().$section_id['URLSectionStructure'];
			$sectionname         = strtolower($section_id['URLSectionName']);
			switch ($sectionname) {
				case ($sectionname == "galleries" || $sectionname == "photos" || $parent_section_name=="galleries" ||  $parent_section_name=="photos"):
					$content_type = 3;
					break;
				case ($sectionname == "videos" || $parent_section_name=="videos"):
					$content_type = 4;
					break;
				case "audios":
					$content_type = 5;
					break;
				case "resources":
					$content_type = 6;
					break;
				default:
					$content_type = 1;
			}
			$data['viewmode']     = $view_mode; 
			$data['content_type'] = $content_type;
			$data['Section']      = $section_id['Sectionname'];
			$data['rss_article']  = $this->widget_model->rss_section_articles($section_id['Section_id'], $content_type);
			$this->load->view("admin/rssfeed", $data);
			unset($data);
		 }
		 else
		  {
			$section_404_details= $this->widget_model->get_sectionid_with_names("404-not-found", "", "");	
			if(count($section_404_details) > 0)
			{
			$page_details 	= $this->widget_model->getPageDetails($section_404_details[0]['Section_id'], "1");	
			$page_type		= "1";    //section
			}else
			{
			 /******  Condition comes here only when the above mentioned 404 page is Not Found  ********/
			 echo $this->load->view("admin/page_not_found_404", '', true);
			 exit;
		    }
		$section_page_id      = $page_details['menuid'];
		$section_details      = $this->widget_model->get_sectionDetails($section_page_id, $view_mode); 
		$page_param           = ($this->input->get('pm')!='')? $this->input->get('pm'): $page_details['menuid'];
		$is_home_page         = 'n';
		$xml                  = "";
		$xml				  = simplexml_load_string($page_details['published_templatexml']);   // home Xml details
        $tmpl_values          = (strlen($xml)!=0)? (string)$xml->attributes()->templatevalues: "";
		if($tmpl_values!="")
		{
		$tmpl_values 		  = explode("-", $tmpl_values);	
		}else{
		$template_id 		  = $page_details['templateid'];
		$template_details 	  = $this->widget_model->getTemplateDetails($template_id); 
		$tmpl_values 		  = explode("-", $template_details['template_values']);		
		}
		$data['viewmode']     = $view_mode; 
		if(strlen($xml)!= 0)
		{
			    $tplheader_values   = $xml->tplcontainer;
				$page_type          = $page_details['pagetype'];
				$header_param 		= $tplheader_values[0];
				$right_panel_param	= $tplheader_values[count($tplheader_values)-2];
				$footer_param 		= $tplheader_values[count($tplheader_values)-1];
				$body_loop_values	= $tplheader_values[0];
				
				if($page_details['common_header']==1 || $page_details['common_footer']==1 || $page_details['common_rightpanel']==1)
				{
					$common_xml         = $this->template_library->get_parent_article_page(10000, $page_type);
					$xml                = simplexml_load_string($common_xml['published_templatexml']);
					if(count($xml)> 1){
						$common_tplheader_values 	= $xml->tplcontainer; 
						if($page_details['common_header']==1){
						$header_param 	= $common_tplheader_values[0];
						}
						if($page_details['common_rightpanel']==1){
						$right_panel_param 	= $common_tplheader_values[count($common_tplheader_values)-2];				
						}
						if($page_details['common_footer']==1){
						$footer_param 	= $common_tplheader_values[count($common_tplheader_values)-1];
						}
					}
				}
				
				$data['header']   = $this->template_library->section_xml_containers($header_param, "header", $is_home_page, $view_mode, $page_type, $page_param);
	
				$data['body']	  = '<section class="section-content"><div class="container SectionContainer"><div class="row">';
				$template_values_body_content = explode(",",$tmpl_values[1]);
				$b_section_inc = 0;
			for($i=1; $i<=count($template_values_body_content); $i++){
			
				$body_section 	= $template_values_body_content;
				$section_cl_val	= $body_section[$b_section_inc] * (12 / array_sum($body_section));
				
				$col_sm_val		= "12";
				$col_xs_val		= "12";
				$home_last_column = "";
				if($b_section_inc != (count($body_section)-1) && count($body_section) > 0)
				{
					if(($section_cl_val == 3 || $section_cl_val == 6 ) && array_sum($body_section) == 4){
						$home_last_column = "";
					}
					else{
						$home_last_column = "ColumnSpaceRight";
					}
				}
				
				//////  For only three column template  ////
				if(count($body_section) == 3)
				{
						if($b_section_inc == 0)
						{
							$col_sm_val		= "3";
						}
						if($b_section_inc == 1)
						{
							$col_sm_val		= "9";
						}
				}
				$c_class_value 	= " col-lg-".$section_cl_val." col-md-".$section_cl_val." col-sm-".$col_sm_val." col-xs-".$col_xs_val." ".$home_last_column." ";
				$data['body'] .= '<div class="'. $c_class_value .'">';
				$pass_body_content = (($i) < count($template_values_body_content)) ? $tplheader_values[$i] : $right_panel_param;			
				//$pass_body_content = $tplheader_values[$i];
				$data['body'] 	  .= $this->template_library->section_xml_containers($pass_body_content, "template_body", $is_home_page,  $view_mode, $page_type, $page_param);			
				$data['body']	  .= '</div>';
				$b_section_inc ++;
			}
				$data['body']	  .= '</div></div></section>';
	
				$data['footer']   = $this->template_library->section_xml_containers($footer_param, "footer", $is_home_page, $view_mode, $page_type, $page_param);
				
				
				$data['header_ad_script']	= $page_details['Header_Adscript'];
				
				$data['page_type'] = $page_details['pagetype'];
				
				$data['section_details']	= $section_details;
		}
		else   // if xml is not created condition will call this
		{
			$data['header'] 	= "";
			$data['body'] 		= "";
			$data['footer'] 	= "";
		}
		$this->load->view("admin/view_frontend", $data); 
	  }	
	}
public function sitemap() {
		
		$data['sectionname_list'] 	= $this->widget_model->rss_section_mapping($view_mode = 'LIVE'); 
		$data['xml_type']			= "section_sitemap";
		
		echo $this->load->view("admin/section_sitemap",$data,true); 
		
	}
public function section_year_sitemap() {
		extract($_GET);
		
		$this->load->library("memcached_library");
		
		if(isset($year) && isset($section_id) && isset($content_type) && isset($month)) {
			
			$result = array();
		
		switch($content_type) {
			case 1:
			$tablename = "article";
			break;
			
			case 3: 
			$tablename = "gallery";
			break;
			
			case 4: 
			$tablename = "video";
			break;
			
			case 5: 
			$tablename = "audio";
			break;
		}
			

			if($year == date('Y')) { 
			
				$CacheID  = "SITEMAP- SELECT last_updated_on,url FROM ".$tablename." WHERE section_id=".$section_id." AND MONTH(last_updated_on) = ".$month;
				 
				 
				 
				if(!$this->memcached_library->get($CacheID) && $this->memcached_library->get($CacheID) == '') {
				
					$this->live_db->select("last_updated_on,url");
					$this->live_db->from($tablename);
					$this->live_db->where("section_id",$section_id);
					$this->live_db->where("MONTH(last_updated_on)",$month);
					$this->live_db->where("publish_start_date < NOW()");		
					$this->live_db->order_by("last_updated_on","desc");
					
					$get = $this->live_db->get();
					
					$live_result = $get->result_array();
					
					$this->memcached_library->add($CacheID,$live_result);
					
				} else {
					
					$live_result = $this->memcached_library->get($CacheID);
					
				}
				
				$archive_result =array();
				
				if($this->archive_db->table_exists($tablename."_".$year)) {
					
					$CacheID = "SITEMAP- SELECT last_updated_on,url FROM ".$tablename."_".$year." WHERE section_id=".$section_id." AND MONTH(last_updated_on) = ".$month;
					
					if(!$this->memcached_library->get($CacheID) && $this->memcached_library->get($CacheID) == '') {
					
					$this->archive_db->select("last_updated_on,url");
					$this->archive_db->from($tablename."_".$year);
					$this->archive_db->where("section_id",$section_id);
					$this->archive_db->where("MONTH(last_updated_on)",$month);
					$this->archive_db->where("publish_start_date < NOW()");		
					$this->archive_db->order_by("last_updated_on","desc");
					$get = $this->archive_db->get();
					
					$archive_result = $get->result_array();
					
					$this->memcached_library->add($CacheID,$archive_result);
					

					
					} else {
					
					$archive_result = $this->memcached_library->get($CacheID);
					
					}
				}
				
				$result = array_merge($live_result,$archive_result);
				
				
				
				
				
				} else {
					
					
					if($this->archive_db->table_exists($tablename."_".$year)) {
						
					$CacheID = "SITEMAP- SELECT last_updated_on,url FROM ".$tablename."_".$year." WHERE section_id=".$section_id." AND MONTH(last_updated_on) = ".$month;
					
					if(!$this->memcached_library->get($CacheID) && $this->memcached_library->get($CacheID) == '') {
					
						$this->archive_db->select("last_updated_on,url");
						$this->archive_db->from($tablename."_".$year);
						$this->archive_db->where("section_id",$section_id);
						$this->archive_db->where("MONTH(last_updated_on)",$month);
						$this->archive_db->where("publish_start_date < NOW()");		
						$this->archive_db->order_by("last_updated_on","desc");
						$get = $this->archive_db->get();
						
						$result = $get->result_array();
						
						$this->memcached_library->add($CacheID,$result);
					
					} else {
					
						$result = $this->memcached_library->get($CacheID);
					
					}
					
				}
				
			}
		
		
		$data['live_articles'] 	= $result; 
		$data['xml_type']			= "section_live_sitemap";
		
		echo $this->load->view("admin/section_sitemap",$data,true); 
		
		} 
			
		
	}
	
	public function new_sitemap() {
		
				$CacheID = "SITEMAP- SELECT title,publish_start_date,tags,last_updated_on,url FROM article ORDER BY publish_starte_date desc LIMIT 1000";
					
				if(!$this->memcached_library->get($CacheID) && $this->memcached_library->get($CacheID) == '') {
		
					$this->live_db->select("title,publish_start_date,tags,last_updated_on,url");
					$this->live_db->from("article");
					$this->live_db->where("publish_start_date < NOW()");		
					$this->live_db->order_by("last_updated_on","desc");
					$this->live_db->limit("1000");
					
					$get = $this->live_db->get();
					
					$live_result = $get->result_array();					
					
					$this->memcached_library->add($CacheID,$live_result);
				
				}  else {
					
					$live_result = $this->memcached_library->get($CacheID);
					
				}
				
				$data['new_articles'] 		= $live_result; 
				$data['xml_type']			= "new_sitemap";
		
				echo $this->load->view("admin/section_sitemap",$data,true); 
				
				
		
	}
	
	public function sitemap_custom(){
		header('Content-type: application/xml');
		if(count($_GET) ==0){
			$data =[];
			echo $this->load->view("admin/sitemap_custom",$data,true);
		}else{
			if(count($_GET) ==3){
				$year = $_GET['yyyy'];
				$month = $_GET['mm'];
				$date = $_GET['dd'];
				$startDate = $year.'-'.$month.'-'.$date.' 00:00:00';
				$endDate = $year.'-'.$month.'-'.$date.' 23:59:59';
				$archiveArticleList = $archiveGalleryList = $archiveVideoList = [];
				$articleQuery = "SELECT url , last_updated_on FROM article WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW() AND section_id NOT IN(715,711) ORDER BY last_updated_on DESC";
				if(!$this->memcached_library->get($articleQuery) && $this->memcached_library->get($articleQuery) == ''){
					$liveArticleList = $this->live_db->query($articleQuery)->result_array();
					$this->memcached_library->add($articleQuery,$liveArticleList);
				}else{
					$liveArticleList = $this->memcached_library->get($articleQuery);
				}
				
				$archiveTableName ='article_'.$year;
				if($this->archive_db->table_exists($archiveTableName)){

					$articleArchiveQuery ="SELECT url , last_updated_on FROM ".$archiveTableName." WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW() AND section_id NOT IN(715,711) ORDER BY last_updated_on DESC";
					if(!$this->memcached_library->get($articleArchiveQuery) && $this->memcached_library->get($articleArchiveQuery) == ''){
						$archiveArticleList = $this->archive_db->query($articleArchiveQuery)->result_array();
						$this->memcached_library->add($articleArchiveQuery,$archiveArticleList);
					}else{
						$archiveArticleList = $this->memcached_library->get($articleArchiveQuery); 
					}
				}
				$data['articleList'] = array_merge($liveArticleList ,$archiveArticleList);
				
				$galleryQuery = "SELECT url , last_updated_on FROM gallery WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW()  ORDER BY last_updated_on DESC";
				if(!$this->memcached_library->get($galleryQuery) && $this->memcached_library->get($galleryQuery) == ''){
					$liveGalleryList = $this->live_db->query($galleryQuery)->result_array();
					$this->memcached_library->add($galleryQuery,$liveGalleryList);
				}else{
					$liveGalleryList = $this->memcached_library->get($galleryQuery);
				}
				$archiveGalleryTableName ='gallery_'.$year;
				if($this->archive_db->table_exists($archiveGalleryTableName)){
					$galleryArchiveQuery ="SELECT url , last_updated_on FROM ".$archiveGalleryTableName." WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW() ORDER BY last_updated_on DESC";
					if(!$this->memcached_library->get($galleryArchiveQuery) && $this->memcached_library->get($galleryArchiveQuery) == ''){
						$archiveGalleryList = $this->archive_db->query($galleryArchiveQuery)->result_array();
						$this->memcached_library->add($galleryArchiveQuery,$archiveGalleryList);
					}else{
						$archiveGalleryList = $this->memcached_library->get($galleryArchiveQuery);
					}
				}
				$data['galleryList'] = array_merge($liveGalleryList ,$archiveGalleryList);
				$videoQuery = "SELECT url , last_updated_on FROM video WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW()  ORDER BY last_updated_on DESC";
				if(!$this->memcached_library->get($videoQuery) && $this->memcached_library->get($videoQuery) == ''){
					$liveVideoList = $this->live_db->query($videoQuery)->result_array();
					$this->memcached_library->add($videoQuery,$liveVideoList);
				}else{
					$liveVideoList = $this->memcached_library->get($videoQuery);
				}
				$archiveVideoTableName ='video_'.$year;
				if($this->archive_db->table_exists($archiveVideoTableName)){
					$videoArchiveQuery ="SELECT url , last_updated_on FROM ".$archiveVideoTableName." WHERE last_updated_on BETWEEN '".$startDate."' AND '".$endDate."' AND status='P' AND publish_start_date < NOW() ORDER BY last_updated_on DESC";
					if(!$this->memcached_library->get($videoArchiveQuery) && $this->memcached_library->get($videoArchiveQuery) == ''){
						$archiveVideoList = $this->archive_db->query($videoArchiveQuery)->result_array();
						$this->memcached_library->add($videoArchiveQuery,$archiveVideoList);
					}else{
						$archiveVideoList = $this->memcached_library->get($videoArchiveQuery);
					}
				}
				$data['videoList'] = array_merge($liveVideoList ,$archiveVideoList);
				echo $this->load->view("admin/sitemap_custom_article",$data,true);
			}
		}
	}
			
}?>