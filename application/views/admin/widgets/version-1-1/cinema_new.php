<?php
$widget_bg_color        = $content['widget_bg_color']; 
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();





if($content['RenderingMode'] == "manual"){
	$content_type = $content['content_type_id'];
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode,$content['show_max_article']); 
	if(function_exists('array_column')){
		$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	}else{
		$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
	}
	$get_content_ids = implode("," ,$get_content_ids); 
	$widget_contents = array();
	if($get_content_ids!=''){
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}
}else{
	$content_type = $content['content_type_id'];  // auto article content type
		if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
		}else{
			$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
			if (function_exists('array_column')){
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			}else{
				$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
			}
			$get_content_ids = implode("," ,$get_content_ids); 
			if($get_content_ids!=''){
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
	$galleries=BASEURL.'galleries';
	$videos=BASEURL.'videos';
	$template='';
	$template .='<div class="">';
	$template .='<div class="cinema-widget-container">';
	$template .='<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 pull-left cinema-custom-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a><div class="cinema_heading_curve"> </div></div>';
	$template .='<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 pull-right text-right"><span><a href="'.$galleries.'"><i class="fa fa-camera" aria-hidden="true"></i> புகைப்படங்கள்</a></span><span><a href="'.$videos.'"><i class="fa fa-video-camera" aria-hidden="true"></i>  வீடியோக்கள்</a></span></div>';
	if(count($widget_contents) > 0){
		$i=1;
		foreach($widget_contents as $get_content):
		
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";
				$custom_title        = "";
				$custom_summary      = "";  
				$summary             = "";
				$is_vertical         = false;
				
				if($content['RenderingMode'] == "manual"):
					if($get_content['custom_image_path'] != ''){
						$original_image_path = $get_content['custom_image_path'];
						$imagealt            = $get_content['custom_image_title'];	
						$imagetitle          = $get_content['custom_image_alt'];	
					}
					$custom_title   = $get_content['CustomTitle'];
					$custom_summary = $get_content['CustomSummary'];
				endif;
				
				if($original_image_path ==""){
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];	
				}
				$show_image_390	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				$show_image_300	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
				
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
					$Image600X390 	= str_replace("original","w600X390", $original_image_path);
					$Image300X300 	= str_replace("original","w600X300", $original_image_path);
					 if (get_image_source($Image600X390, 1) && $Image600X390 != ''){
						$show_image_390 = image_url. imagelibrary_image_path . $Image600X390;
						$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
					}
					if (get_image_source($Image300X300, 1) && $Image300X300 != ''){
						$show_image_300 = image_url. imagelibrary_image_path . $Image300X300;
					} 
				}
				
				$content_url = $get_content['url'];
				$url_array = explode('/', $content_url);
				$get_seperation_count = count($url_array)-4;
				$sectionURL = $domain_name.$get_section['URLSectionStructure'];
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
				$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;	
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
				if( $custom_summary == '' && $content['RenderingMode']=="auto"){
					$custom_summary =  $get_content['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
				
				if($i==1){
					$template .='<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-off cinema-main-container"><div class="col-md-7 col-lg-7 col-sm-12 padding-off">';
					$template .='<div class="col-md-12 col-lg-12 col-sm-12 padding-off"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'" class="img-responsive" /></a><div class="cinema-widget-first-row-gradient"><div class="cinema-widget-first-row-gradient_anim">
                    <div class="mask1"><div class="  col-md-12 col-sm-12 col-lg-12 padding-off cinema-widget-first-row-content">  <h4 class="padding-10">'.$display_title.'</h4><p class="padding-10">'.$summary.'</p><a href="'.$live_article_url.'" class="btn btn-default">மேலும் படிக்க <i class="fa fa-plus-circle"></i></a></div></div></div></div></div>';
				}
				if($i==2){
					$summary=mb_substr($summary,0,65,"utf-8");
					$summary=$summary.'...';
					$template .='<div class="col-md-12 col-lg-12 col-sm-12 padding-off cinema-main-second-row cinema-widget-h4"><div class="col-md-5 col-lg-5 col-sm-12 padding-off"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive" /></a></div>
                    <div class="col-md-7 col-lg-7 col-sm-12"><h4>'.$display_title.'</h4><p>'.$summary.'</p></div></div></div>';
				}
				if($i==3){
					$template .='<div class="col-md-5 col-lg-5 col-sm-12 padding-off cinema-widget-h4"><div class="col-md-12 col-lg-12 col-sm-12  padding-off">
					<div class="col-md-6 col-lg-6 col-sm-12 padding-left-10"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'"  class="img-responsive"/></a><h4>'.$display_title.'</h4></div>';
				}
				if($i==4){
					$template .=' <div class="col-md-6 col-lg-6 col-sm-12 padding-left-10"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'" class="img-responsive" /></a><h4>'.$display_title.'</h4></div></div>';
				}
				if($i==5){
					 $template .='<div class="col-md-12 col-lg-12 col-sm-12 padding-off"><div class="col-md-6 col-lg-6 col-sm-12 padding-left-10"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'"  class="img-responsive" /></a><h4>'.$display_title.'</h4></div>';
				}
				if($i==6){
					$template .=' <div class="col-md-6 col-lg-6 col-sm-12 padding-left-10"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'" class="img-responsive" /></a><h4>'.$display_title.'</h4></div></div></div></div>';
				}
				if($i==7){
					$template .='<div class="col-md-12 col-lg-12 col-sm-12 padding-off cinema-third-container"><div class="col-md-4 col-lg-4 col-sm-12 padding-off"><div class="col-md-5 col-lg-5 col-sm-12 padding-right-5"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive" /></a></div><div class="col-md-7 col-lg-7 col-sm-12 padding-right-5"><p>'.$display_title.'</p></div></div>';
				}
				if($i==8 || $i==9){
					$template .='<div class="col-md-4 col-lg-4 col-sm-12 padding-off"><div class="col-md-5 col-lg-5 col-sm-12 padding-right-5">
					<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive" /></a></div><div class="col-md-7 col-lg-7 col-sm-12 padding-right-5"><p>'.$display_title.'</p></div></div>';
				}
				if($i==9){
					$template .='</div>';
					$template .='<div class="col-md-12 col-lg-12 col-sm-12 padding-off pull-right text-right cinema-widget-bottom"><a href="'.$widget_section_url.'">மேலும் படிக்க...</a></div>';
				}
				
				$i++;
		endforeach;
		
	}else{
	
	}
	$template .='</div>';
	$template .='</div>';
	print $template;
?>

