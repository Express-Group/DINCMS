<?php
$widget_bg_color = $content['widget_bg_color']; 
$widget_custom_title = $content['widget_title'];
$widget_instance_id = $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid = $content['sectionID'];
$main_sction_id = "";
$is_home = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$view_mode = $content['mode'];
$widget_section_url = $content['widget_section_url'];
$domain_name =  base_url();
$content['show_max_article'] = 10;  
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
	$content_type = $content['content_type_id'];
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
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php
		if($widget_custom_title!=''){
			if($content['widget_title_link'] == 1){
				echo '<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
			}else{
				echo '<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
			}
		}
		?>
	</div>
</div>
<?php
if(count($widget_contents) > 0 ){
	echo '<div class="gallery-items">';
	foreach($widget_contents as $get_content):
		$original_image_path = "";
		$imagealt  = "";
		$imagetitle = "";
		$custom_title = "";
		$custom_summary = "";  
		$summary = "";
		$is_vertical = false;
		if($content['RenderingMode'] == "manual"):
			if($get_content['custom_image_path'] != ''){
				$original_image_path = $get_content['custom_image_path'];
				$imagealt = $get_content['custom_image_title'];	
				$imagetitle = $get_content['custom_image_alt'];	
			}
			$custom_title   = $get_content['CustomTitle'];
			$custom_summary = $get_content['CustomSummary'];
		endif;
		if($original_image_path ==""){
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt = $get_content['ImageCaption'];	
			$imagetitle = $get_content['ImageAlt'];	
		}
		if($original_image_path!=''){
			$original_image_path = image_url. imagelibrary_image_path.$original_image_path;
		}else{
			$original_image_path = image_url.imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
		}
		$live_article_url = $domain_name.$get_content['url'];
		$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
		echo '<div class="gallery-item">';
		echo '<a href="'.$live_article_url.'"><img src="'.$original_image_path.'" alt="'.$imagealt.'" title="'.$imagetitle.'"></a>';
		echo '<i class="fa fa fa-camera" aria-hidden="true"></i>';
		echo '<p class="gallery-title"><a href="'.$live_article_url.'">'.$display_title.'</a></p>';
		echo '</div>';
	endforeach;
	echo '</div>';
}
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".gallery-items").slick({dots:false,infinite:!0,speed:500,slidesToShow:4,slidesToScroll:1,autoplay:true,arrow:true,prevArrow: '<button class="slider-prev"><img src="<?php echo image_url; ?>images/FrontEnd/images/left.png" /></i></button>',nextArrow: '<button class="slider-next"><img src="<?php echo image_url; ?>images/FrontEnd/images/right.png" /></i></button>',responsive:[{breakpoint:768,settings:{slidesToShow:1}}]})});
</script>