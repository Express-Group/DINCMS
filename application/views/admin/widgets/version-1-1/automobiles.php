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
$template='';
$template .='<div class="automobiles_wrap-padding">';
$template .='<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pull-left automobiles-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a><div class="automobiles_heading_curve"> </div></div>';

if(count($widget_contents) > 0 ){
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
				
				$show_image_300	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$show_image_390	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
				
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
					$Image600X300 	= str_replace("original","w600X300", $original_image_path);
					$Image600X390 	= str_replace("original","w600X390", $original_image_path);
					if (get_image_source($Image600X300, 1) && $Image600X300 != ''){
						$show_image_300 = image_url. imagelibrary_image_path . $Image600X300;
						
					} 
					if (get_image_source($Image600X390, 1) && $Image600X390 != ''){
						$show_image_390 = image_url. imagelibrary_image_path . $Image600X390;
						
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
					$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 automobiles_wrap-padding">';
					$template .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 automobiles-container-right">';
					$template .='<div class="automobiles_wrap_megastory_anim">';
					$template .='<div class="automobiles_wrap_megastory">';
					$template .='<img src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive">';
					$template .='</div>';
					$template .='<div class="automobiles_wrap_megastory-lead">'.$display_title.'</div>';
					$template .='<div class="automobiles_wrap_megastory-readmore"><a href="'.$live_article_url.'">மேலும் படிக்க</a></div></div></div>';
				}
				if($i==2){
					$template .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 automobiles-container-left">';
					$template .='<div class="automobiles_wrap_megastory_anim">';
					$template .='<div class="automobiles_wrap_megastory">';
					$template .='<img src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive">';
					$template .='</div>';
					$template .='<div class="automobiles_wrap_megastory-lead">'.$display_title.'</div>';
					$template .='<div class="automobiles_wrap_megastory-readmore"><a href="'.$live_article_url.'">மேலும் படிக்க</a></div></div></div></div>';
				}
				
				if($i==3){
					$template .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 automobiles_wrap-padding">';
				}
				if($i==3 || $i==4){
					$template .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 automobiles-container-right">
					<div class="automobiles_wrap_megastory_anim">
					<div class="automobiles_wrap_megastory">
					<img src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive">
					</div>
					<div class="automobiles_wrap_thumbstory-lead">'.$display_title.'</div>
					<div class="automobiles_wrap_thumbstory-readmore"><a href="'.$live_article_url.'">மேலும்</a></div>
					</div>
					</div>';
				}
				if($i==5){
					$template .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 automobiles-container-left"><div class="automobiles_wrap_megastory_anim"><div class="automobiles_wrap_megastory"><img src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive"></div><div class="automobiles_wrap_thumbstory-lead">'.$display_title.'</div>       <div class="automobiles_wrap_thumbstory-readmore"><a href="'.$live_article_url.'">மேலும்</a></div></div></div></div>';
				}
			
				
              
				$i++;
			endforeach;
		 if(count($widget_contents)==1 || count($widget_contents)==3  || count($widget_contents)==4){
			$template .='</div>';
		} 
}
$template .='</div>';
echo $template;
?>
