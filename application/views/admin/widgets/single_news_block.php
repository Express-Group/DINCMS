<style>
.latest-news-block .latest-news-block-single img{border-radius:8px;}
.latest-news-block .latest-news-block-single h5{font-weight: 700 !important;margin-top: 5px;}
.latest-news-block .latest-news-block-single h6 a{display: flex;}
.latest-news-block .latest-news-block-single h6 i{font-size: 16px;margin-right: 5px;color: #ddd;font-weight:700;}
</style>
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
$widgettype=3;
$temp  = trim(str_replace(["style='background-color:" , ";'"],['',''],$widget_bg_color));
if($temp!=''){
	$widgettype = (int) $temp;
}

//echo $content['sectionID'];
$show_simple_tab         = "";
// widget config block ends
/* $content['widget_title_link']  */
//getting tab list for hte widget
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="latest-news-block">';
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

			  /********************* content list iteration block - Looping through content list and adding it the list ********************/
// content list iteration block starts here

   $i =1;
   $count=count($widget_contents);
	if(count($widget_contents)>0)
	{
		$responseData = array_chunk($widget_contents ,round(count($widget_contents) /1));
		$show_simple_tab .='<div class="latest-news-block-single">';
		for($m=0;$m<count($responseData);$m++){
			if(count($responseData[$m]) > 0){
				$show_simple_tab .='<ul>';
			}
			for($n=0;$n<count($responseData[$m]);$n++){
				$custom_title        = "";
				$custom_summary      = "";
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";
				$Image600X390        = "";
				if($content['RenderingMode'] == "manual"){
					if($responseData[$m][$n]['custom_image_path'] != ''){
						$original_image_path = $responseData[$m][$n]['custom_image_path'];
						$imagealt            = $responseData[$m][$n]['custom_image_title'];	
						$imagetitle          = $responseData[$m][$n]['custom_image_alt'];												
					}
					$custom_title        = stripslashes($responseData[$m][$n]['CustomTitle']);
					$custom_summary      = $responseData[$m][$n]['CustomSummary'];	
				}
				if($original_image_path ==""){
					$original_image_path  = $responseData[$m][$n]['ImagePhysicalPath'];
					$imagealt             = $responseData[$m][$n]['ImageCaption'];	
					$imagetitle           = $responseData[$m][$n]['ImageAlt'];	
				}
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
						$Image100X65 	= str_replace("original","w600X300", $original_image_path);
					if (get_image_source($Image100X65,1) && $Image100X65 != ''){
						$show_image = image_url. imagelibrary_image_path . $Image100X65;
					}
				}
				$content_url = $responseData[$m][$n]['url'];
				$param = $content['close_param'];
				$live_article_url = $domain_name. $content_url.$param;
				$display_title = ( $custom_title != '') ? $custom_title : ( ($responseData[$m][$n]['title'] != '') ? stripslashes($responseData[$m][$n]['title']) : '' ) ;
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);
				if($n==0):
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
				else:
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" ><i class="fa fa-angle-right"></i>'.$display_title.'</a>';
				endif;
				$show_simple_tab .='<li>';
				if($n==0):
				$show_simple_tab .='<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image.'" class="img-responsive"></a>';
				$show_simple_tab .='<h5>'.$display_title.'</h5>';
				else:
				$show_simple_tab .='<h6>'.$display_title.'</h6>';
				endif;
				$show_simple_tab .='</li>';
			}
			if(count($responseData[$m]) > 0){
				$show_simple_tab .='</ul>';
			}
		}
		 
	}
$show_simple_tab .='</div></div>';
echo $show_simple_tab;
?>
 