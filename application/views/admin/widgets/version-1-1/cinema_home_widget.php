<style>
.chw1 .cinema-home-widget:first-child{padding-right:5px;}
.chw1 .cinema-home-widget:last-child{padding-left:5px;}
.chw1 .cinema-home-widget{position:relative;}
.chw1{margin-bottom:10px;}
.cinema-mask{position: absolute;bottom: 0;width: calc(100% - 20px );background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,1) 80%);padding: 21px 11px 2px;}
.cinema-mask p{color:#f37c12;}
.cinema-mask h4 a{color:#fff;font-weight:bold;}
.chw2 .chw21{padding: 10px;}
.chw2{background:#1b91ce;}
.chw2 .chw21 h5{margin-bottom:0;}
.chw2 .chw21 h5 a{color:#fff;}
.chw2 img{border-radius:8px;}
@media only screen and (max-width: 991px){
	.cinema-mask p{display:none;}
	.chw1 .cinema-home-widget:first-child{padding-right: 15px;margin-bottom: 10px;}
	.chw1 .cinema-home-widget:last-child{padding-left: 15px;}
	.cinema-mask{padding: 1px 11px 2px;width: calc(100% - 30px );}
	.cinema-mask h4 a{font-size: 14px;}
}
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
if($content['widget_title_link'] == 1){
	$widget_title=	'<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
}else{
	$widget_title=	$widget_custom_title;
}	
$show_simple_tab 	   .=	'<div class="row">';
$show_simple_tab 	   .=	'<div class="margin-bottom-10">';
if(strtolower(strip_tags($widget_custom_title)) !='none' && $widget_title!=''){
	$show_simple_tab	   .=	'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h4 class="virivana-title-h4 VideoGallery-title"><p>'.$widget_title.'</p></h4></div>';	
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
			$show_simple_tab.= '<div class="WidthFloat_L chw1">';
		}
		if($i <3){
			$show_simple_tab.= '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 cinema-home-widget">';
			$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click">';
			$show_simple_tab.= '<img src="'.$dummy_image.'" data-src="'.$show_image_300.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
			$show_simple_tab .='<div class="cinema-mask">';
			$show_simple_tab .='<h4>'.$display_title.'</h4>';
			$show_simple_tab.='<p class="summary">'.$summary.'</p>';
			$show_simple_tab.= '</div>';
			
			$show_simple_tab.= '</div>';
		}
		if($i==2){
			$show_simple_tab.= '</div>';
		}
		if($i >= 3){
			if($i==3){ $j=0;}
			if($j==0){
				$show_simple_tab.= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="WidthFloat_L chw2">';
			}
			$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 chw21">';
			$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click">';
			$show_simple_tab.= '<img src="'.$dummy_image.'" data-src="'.$show_image_300.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
			$show_simple_tab .='<h5>'.$display_title.'</h5>';
			$show_simple_tab.= '</div>';
			if($j==2){
				$show_simple_tab.= '</div></div>';
			}
			if($j==2){
				$j=0;
			}else{
				$j++;
			}
		}
		
		$i++;
	endforeach;
	if($j==2 || $j==1){
		$show_simple_tab.= '</div></div>';
	}
}else{

}
$show_simple_tab 	   .=	'</div></div>';
echo $show_simple_tab;
?>

 