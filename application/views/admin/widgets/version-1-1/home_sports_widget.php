<style>
.sphw1{width: 34%;}
.sphw1 h4{height: 109px;}
.sphw2{width: 66%;margin-left: 0% !important;}
.sphw2-inner{width: 23.3%;margin-left: 10px !important;}
.sphw2-inner h4{height: 83px;}
@media only screen and (min-width: 1551px){
	.sphw1 h4{height: 97px;}
}
@media only screen and (max-width: 767px){
	.sphw1 ,.sphw2{width: 100%;}
	.sphw2-inner{width: 49%;margin-left: 3px !important;}
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
$content['show_max_article'] = ((int) $content['show_max_article'] > 9)? 9 :$content['show_max_article'];
$border=str_replace(array("style='background-color:",";'"),'',$widget_bg_color);
if($border=='#495675' || $border=='#495675;'){
	$innerbg="style='background-color:#e9effd;'";
}else{
	$innerbg=$widget_bg_color;
}
$template='';
$template .='<h2 class="vivasayam-title margin-top-10"><span class="bold_line"><span '.$widget_bg_color.'></span></span><span class="solid_line" ></span><a class="title_text"  '.$widget_bg_color.'  href="'.$widget_section_url.'">'.$widget_custom_title.'</a> </h2>';
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
					$template .='<div class="vivasayam-container sphw1"><a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image_390.'" class="ing-responsive"></a><h4 '.$innerbg.' >'.$display_title.'</h4></div>';
				}
				if($i==2){
					$template .='<div class="vivasayam-container sphw2">';
				}
				if($i==2 || $i==3 || $i==4 ||  $i==5 || $i==6 || $i==7 || $i==8 || $i==9){
					$template .='<div class="vivasayam-inner-container sphw2-inner">';
					$template .='<a href="'.$live_article_url.'"><img class="img-responsive" src="'.$dummy_image.'" data-src="'.$show_image_300.'"></a>';
					$template .='<h4 '.$innerbg.'  >'.$display_title.'</h4>';
					$template .='</div>';
					
				}
				if($i==9){
					$template .='</div>';
				}
				
				
			$i++;	
		endforeach;
		/* if(count($widget_contents)==2 || count($widget_contents)==3 || count($widget_contents)==4 || count($widget_contents)==6 || count($widget_contents)==7 ){
			$template .='</div>';
		} */
		if(count($widget_contents) > 0 && $i!=10 && $i!=2){
			$template .='</div>';
		}		
		$style="style='color:".$border."';";
		$template .='<a class="vivasayam-arrow" '.$style.' href="'.$widget_section_url.'">மேலும்  <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
		
		if($border!=''){
			$template .='<h2 class="vivasayam-footer" style="border-top: 4px solid '.$border.';border-bottom: 4px solid '.$border.';" ></h2>';
		}else{
			$template .='<h2 class="vivasayam-footer"></h2>';
		}
		
		
	}



echo $template;
?>




 