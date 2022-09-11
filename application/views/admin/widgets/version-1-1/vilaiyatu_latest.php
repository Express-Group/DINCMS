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
$template .='<div class="vilayattu_wrap">';
if(count($widget_contents) > 0){
		$i=1;
		foreach($widget_contents as $get_content):
				$day=date('d',strtotime($get_content['last_updated_on']));
				$month=date('F',strtotime($get_content['last_updated_on']));
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
				$show_image_300	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				$show_image_65	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_100X65.jpg';
				$dummy_image_390 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				$dummy_image_65 = image_url. imagelibrary_image_path.'logo/dinamani_logo_100X65.jpg';
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
				
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
					$Image600X300 	= str_replace("original","w600X390", $original_image_path);
					$Image100X65 	= str_replace("original","w100X65", $original_image_path);
					 if (get_image_source($Image600X300, 1) && $Image600X300 != ''){
						$show_image_300 = image_url. imagelibrary_image_path . $Image600X300;
					}
					if (get_image_source($Image100X65, 1) && $Image100X65 != ''){
						$show_image_65 = image_url. imagelibrary_image_path . $Image100X65;
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
					$template .='<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 vilayattu-padding-left" style="position: relative;">';
					$template .='<div class="vilayattu-custom-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></div>';
					$template .='<a href="'.$live_article_url.'"><img src="'.$dummy_image_390.'" data-src="'.$show_image_300.'" alt="'.$imagealt.'" class="img-responsive vilaiyatu_big_image"></a>';
					$template .='<div class="vilayattu-big-story-content"><h2 class="vilayattu-big-story-lead">'.$display_title.'</h2>     <div class="vilayattu-big-story-date"><a>'.$day.'</a><div class="vilayattu-big-story-month"><a>'.$month.'</a></div></div></div>';
					$template .='</div>';
					$template .='<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 vilayattu-padding-left"><ul>';
					$template .='<li class="vilayattu_thumb-story"><a href="'.$live_article_url.'"><img src="'.$dummy_image_390.'" data-src="'.$show_image_300.'" vilaiyatu-src="'.$show_image_300.'" vilaiyatu-day="'.$day.'" vilaiyatu-month="'.$month.'" src="'.$show_image_65.'" alt="" class="img-responsive vilayattu-thumb-img"></a><h4 class="vilayattu-thumb-title" vilaiyatu-src="'.$show_image_300.'" vilaiyatu-day="'.$day.'" vilaiyatu-month="'.$month.'">'.$display_title.'</h4></li>';
				}
				if($i>1){
					$template .='<li class="vilayattu_thumb-story"><a href="'.$live_article_url.'"><img src="'.$dummy_image_390.'" data-src="'.$show_image_300.'" vilaiyatu-src="'.$show_image_300.'" vilaiyatu-day="'.$day.'" vilaiyatu-month="'.$month.'" src="'.$show_image_65.'" alt="" class="img-responsive vilayattu-thumb-img"></a><h4 class="vilayattu-thumb-title" vilaiyatu-src="'.$show_image_300.'" vilaiyatu-day="'.$day.'" vilaiyatu-month="'.$month.'">'.$display_title.'</h4></li>';
				}
				
			$i++;	
		endforeach;
		if($i > 1){
			$template .='</ul></div>';
		}
	}
	/* if(count($widget_contents)==1 || count($widget_contents)==2 || count($widget_contents)==3){
		$template .='</ul></div>';
	} */

$template .='</div>';
echo $template;

?>
<script>
$('.vilayattu-thumb-title').each(function(index){
	if(index==0){
		$(this).find('a').addClass('vilaiyatu-active');
	}
});
$('.vilayattu-thumb-img ,.vilayattu-thumb-title').hover(function(){
	var img_src=$(this).attr('vilaiyatu-src');
	var day=$(this).attr('vilaiyatu-day');
	var month=$(this).attr('vilaiyatu-month');
	var link=$(this).html();
	if(link==''){
		var link=$(this).parent('a').next('.vilayattu-thumb-title').html();
	}
	$('.vilaiyatu_big_image').attr('src',img_src);
	$('.vilayattu-big-story-lead').html(link);
	$('.vilayattu-big-story-lead').find('a').css('color','#fff');
	$('.vilayattu-big-story-date').html('<a>'+day+'</a><div class="vilayattu-big-story-month"><a>'+month+'</a>');
	$('.vilayattu-thumb-title').each(function(index){
		$(this).find('a').removeClass('vilaiyatu-active');
	});
	$(this).next('.vilayattu-thumb-title').find('a').addClass('vilaiyatu-active');
	if($(this).find('a').attr('class')=='article_click'){
		$(this).find('a').addClass('vilaiyatu-active');
	}
});

</script>
