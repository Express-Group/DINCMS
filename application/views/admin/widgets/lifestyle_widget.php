<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color         = $content['widget_bg_color'];
$widget_custom_title     = $content['widget_title'];
$widget_instance_id      =  $content['widget_values']['data-widgetinstanceid'];
$widget_section_url      = $content['widget_section_url'];
$is_home                 = $content['is_home_page'];
$main_sction_id 	     = "";
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$domain_name             =  base_url();
$view_mode               = $content['mode'];
$render_mode             = $content['RenderingMode'];
$show_simple_tab         = "";
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row"><div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">';
if(trim(strip_tags($widget_custom_title))!='' &&trim(strip_tags($widget_custom_title))!='none'):
	if($widget_section_url!=''){
		$show_simple_tab .='<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
	}else{
		$show_simple_tab .='<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
	}
endif;




//getting content block starts here .
if($content['RenderingMode'] == "manual")
{
	$content_type = $content['content_type_id'];  // auto article content type
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']);
	if (function_exists('array_column')) 
	{
		$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	}
	else
	{
		$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
	}
	$get_content_ids = implode("," ,$get_content_ids); 
$widget_contents = array();
if($get_content_ids!='')
{
	$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
	foreach ($widget_instance_contents as $key => $value) {
		foreach ($widget_instance_contents1 as $key1 => $value1) {
			if($value['content_id']==$value1['content_id']){
				$widget_contents[] = array_merge($value, $value1);
			}
		}
	}
}
}
else
{
  $widget_contents = array();
  $content_type = $content['content_type_id'];  // auto article content type
  if($view_mode=="live"){
$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
  }else{
	  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
	if (function_exists('array_column')) 
	{
		$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	}
	else
	{
		$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
	}
	$get_content_ids = implode("," ,$get_content_ids); 
	if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	 }
  }
}


   $i =1;
   $count=count($widget_contents);
	if(count($widget_contents)>0){
		foreach($widget_contents as $get_content){
			if($render_mode == "manual"){
				$content_type = $get_content['content_type_id'];  // from widgetinstancecontent table
				$content_details = $this->widget_model->get_contentdetails_from_database($get_content['content_id'], $content_type, $is_home, $view_mode);
				$sectionname = $content_details[0]['section_name'];
			}else{
				$content_type = $content['content_type_id'];  // from xml
				$sectionname ='';
			}
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$custom_title        = "";
			$custom_summary      = "";
			if($render_mode == "manual"){
				if($get_content['custom_image_path'] != ''){
					$original_image_path = $get_content['custom_image_path'];
					$imagealt = $get_content['custom_image_title'];	
					$imagetitle= $get_content['custom_image_alt'];												
				}
				$custom_title   = $get_content['CustomTitle'];
				$custom_summary = $get_content['CustomSummary'];
				$content_url = $content_details[0]['url'];
			}else{
				$content_url    = $get_content['url'];
				$custom_title   = $get_content['title'];
				$custom_summary = $get_content['summary_html'];
			}
			if($original_image_path =="" && $render_mode =="manual"){
				$original_image_path  = $content_details[0]['ImagePhysicalPath'];
				$imagealt             = $content_details[0]['ImageCaption'];	
				$imagetitle           = $content_details[0]['ImageAlt'];	
			}else if($original_image_path =="" && $render_mode =="auto"){
				$original_image_path  = $get_content['ImagePhysicalPath'];
				$imagealt             = $get_content['ImageCaption'];	
				$imagetitle           = $get_content['ImageAlt'];	
			}
			$show_image="";
			$is_image = false;
			
			if($original_image_path !='' &&  get_image_source($original_image_path, 1)){
				$imagedetails =  get_image_source($original_image_path, 2);
				$imagewidth = $imagedetails[0];
				$imageheight = $imagedetails[1];				
				if ($imageheight > $imagewidth){
					$Image600X300 	= $original_image_path;
				}else{
					$Image600X300  = str_replace("original","w600X300", $original_image_path);
				}
				if ($Image600X300 != '' && get_image_source($Image600X300, 1)){
					$show_image = image_url. imagelibrary_image_path . $Image600X300;
					$is_image = true;
				}else{
					$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				}
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}else{
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$is_image = false;
			}
			$param = $content['close_param']; //page parameter
			$live_article_url = $domain_name. $content_url.$param;			
			if( $custom_title == '' && $render_mode=="manual" ){
				$custom_title = $content_details[0]['title'];
			}	
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);			
			$display_title = '<a  href="'.$live_article_url.'"  class="article_click" >'.$display_title.'</a>';
			$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
			if($i==1){
				$show_simple_tab .='<div class="lifestyle-upper"><div class="row">';
			}
			if($i<=2){
				$show_simple_tab .='<div '.(($i==1) ? 'style="border-right: 1px dashed #8f9292;" ':'').' class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
				$show_simple_tab .='<div class="lifestyle-inner">';
				$show_simple_tab .='<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image.'" alt="'.$imagealt.'" title="'.$imagetitle.'"></a>';
				$show_simple_tab .='<h4>'.$display_title.'</h4>';
				$show_simple_tab .='<p>'.$summary.'</p>';
				$show_simple_tab .='</div>';
				$show_simple_tab .='</div>';
			}
			if($i==2){
				$show_simple_tab .='</div></div>';
			}
			if($i==3){
				$show_simple_tab .='<div class="lifestyle-bottom margin-bottom-15"><div class="row">';
			}
			if($i>2 && $i<=5){
				$show_simple_tab .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
				$show_simple_tab .='<div class="lifestyle-inner">';
				$show_simple_tab .='<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image.'" alt="'.$imagealt.'" title="'.$imagetitle.'"></a>';
				$show_simple_tab .='<p>'.$display_title.'</p>';
				$show_simple_tab .='</div>';
				$show_simple_tab .='</div>';
			}
			if($i==5){
				$show_simple_tab .='</div></div>';
				$i=1;
			}else{
				$i =$i+1;
			}						  
		}
		if($i!=1){
			$show_simple_tab .='</div></div>';
		}
		if($content['widget_title_link'] == 1){
			$show_simple_tab.= '<div class="arrow"><a href="'.$widget_section_url.'">மேலும் <i class="fa fa-arrow-right" style=" color: #071c47;"></i></a></div>';
		}
		 
	}
$show_simple_tab .='</div></div>';
echo $show_simple_tab;
?>
 