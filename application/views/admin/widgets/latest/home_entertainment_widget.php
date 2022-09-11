<style>
.cinema-upper{position: relative;margin-bottom:10px;}
.cinema-upper span{position: absolute;right: 15px;top: 15px;background: #f37c12;color: #fff;   padding: 2px 12px 0px;font-weight: 700;border-radius: 8px;font-size: 1rem;}
.cinema-upper img{border-radius:8px;}
.cinema-upper .cinema-upper-item{background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,1) 80%);position: absolute;bottom: 0;padding: 21px 11px 12px;border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;width:100%;}
.cinema-upper .cinema-upper-item h4 a{color: #fff;font-weight: 700;}
.cinema-upper .cinema-upper-item p{color: #f37c12;}
.cinema-left-pad{padding: 0 6px 0 15px;}
.cinema-right-pad{padding: 0px 14px 0 6px;}
</style>
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
$template='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
if(strtolower($widget_custom_title)!='none'){
	if($content['widget_title_link'] == 1){
		$template.='<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
	}else{
		$template.='<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
	}
}
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

if(count($widget_contents) > 0){
		$i=1;
		$count=1;
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
			$show_image_300	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			$show_image_390	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			if($original_image_path !='' && get_image_source($original_image_path, 1)){
			
				$imagedetails = get_image_source($original_image_path, 2);
				$imagewidth = $imagedetails[0];
				$imageheight = $imagedetails[1];				
				$Image600X300 	= str_replace("original","w600X300", $original_image_path);
				$Image600X390 	= str_replace("original","w600X390", $original_image_path);
				 if (get_image_source($Image600X300, 1) && $Image600X300 != ''){
					$show_image_300 = image_url. imagelibrary_image_path . $Image600X300;
					$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
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
				$template .='<div class="row"><div class="col-md-12">';
				$template .='<div class="cinema-upper">';
				if($get_content['section_name']!=''){
				$template .='<span>'.$get_content['section_name'].'</span>';	
				}
				$template .='<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$imagealt.'" title="'.$imagetitle.'"></a>';
				$template .='<div class="cinema-upper-item">';
				$template .='<h4>'.$display_title.'</h4>';
				$template .='<p>'.$summary.'</p>';
				$template .='</div>';
				$template .='</div>';
				$template .='</div></div>';
			}
			if($i==2 || $i==4){
				$template .='<div class="row">';
			}
			if($i > 1 && $i <=7){
				$template .='<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 '.(($count==1)? 'cinema-left-pad' :'cinema-right-pad').'">';
				$template .='<div class="cinema-upper">';
				if($get_content['section_name']!=''){
				$template .='<span>'.$get_content['section_name'].'</span>';	
				}
				$template .='<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" alt="'.$imagealt.'" title="'.$imagetitle.'"></a>';
				$template .='<div class="cinema-upper-item">';
				$template .='<h4>'.$display_title.'</h4>';
				$template .='</div>';
				$template .='</div>';
				$template .='</div>';
				if($count==2){
					$count=1;
				}else{
					$count++;
				}					
			}

			if($i==3 || $i==7){
				$template .='</div>';	
			}
			$i++;
		endforeach;

		if($content['widget_title_link'] == 1){
			$template .='<a class="pull-right" href="'.$widget_section_url.'">மேலும்  <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
		}
		
		
	}
$template .='</div></div>';
echo $template;
?>