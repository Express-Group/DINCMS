<?php
$widget_bg_color      = $content['widget_bg_color'];
$widget_custom_title  = $content['widget_title'];
$widget_instance_id   =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	  = "";
$is_home              = $content['is_home_page'];
$is_summary_required  = $content['widget_values']['cdata-showSummary'];
$widget_section_url   = $content['widget_section_url'];
$view_mode            = $content['mode'];
$domain_name          =  base_url();
$show_simple_tab      = "";
$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10" >';

if($widget_custom_title!=''){
	if($content['widget_title_link'] == 1){
		$show_simple_tab.= '<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
	}else{
		$show_simple_tab.= '<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
	}
}

$content_type 		= $content['content_type_id'];  // auto article content type
$widget_contents 	= array();

if($content['RenderingMode'] == "manual") {
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 	

// content list iteration block starts here
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
					
} else {

//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'], $content_type ,  $content['mode']);

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

if(count($widget_contents)>0)
{
$show_simple_tab .='<div class="center-page-stories">';
$i =1;
//$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
foreach($widget_contents as $get_content)
{
$custom_title        = "";
$custom_summary      = "";
$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$Image100X65        = "";

//$content_type = @$get_content['content_type_id'];
//$content_details = $this->widget_model->get_contentdetails_from_live_database($get_content['content_id'], $content_type,$is_home);	

if($content['RenderingMode'] == "manual")            // from widgetinstancecontent table    
{
if($get_content['custom_image_path'] != '')
{
$original_image_path = $get_content['custom_image_path'];
$imagealt            = $get_content['custom_image_title'];	
$imagetitle          = $get_content['custom_image_alt'];												
}
$custom_title        = stripslashes($get_content['CustomTitle']);
$custom_summary      = $get_content['CustomSummary'];

}
if($original_image_path =="")                         // from cms || Live table    
{
$original_image_path  = $get_content['ImagePhysicalPath'];
$imagealt             = $get_content['ImageCaption'];	
$imagetitle           = $get_content['ImageAlt'];	
}

if ($original_image_path!='' && get_image_source($original_image_path, 1))
{
$imagedetails = get_image_source($original_image_path, 2);
$imagewidth = $imagedetails[0];
$imageheight = $imagedetails[1];	

if ($imageheight > $imagewidth)
{
$Image100X65 	= $original_image_path;
}
else
{				
$Image100X65 	= str_replace("original","w600X390", $original_image_path);
}
if (get_image_source($Image100X65, 1) && $Image100X65 != '')
{
$show_image = image_url. imagelibrary_image_path . $Image100X65;
}
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
}
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
}	

$content_url = $get_content['url'];
$param = $content['close_param']; //page parameter
$live_article_url = $domain_name. $content_url.$param;

if( $custom_title == '')
{
$custom_title = stripslashes($get_content['title']);
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
				
//  Assign article links block ends hers
$show_simple_tab .='<a href="'.$live_article_url.'">';
$show_simple_tab .='<img src="'.$dummy_image.'" data-src="'.$show_image.'" title="'.$imagetitle.'" alt="'.$imagealt.'">';
$show_simple_tab .='<div class="center-stories-inner">';
$show_simple_tab .='<h5>'.$display_title.'</h5>';
$show_simple_tab .='<p><span style="padding:3px 5px; background: #c700001c; color: #c70000;">-'.$get_content['author_name'].'</span></p>';
$show_simple_tab .='</div>';
$show_simple_tab .='</a>';
$i =$i+1;

}

$show_simple_tab .='</div>';
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}else
{
//$show_simple_tab .='</div>';
}
				   


if($content['widget_title_link'] == 1)
{
	$show_simple_tab .='<a href="'.$widget_section_url.'" style="width: 100%; background: #01206126; padding: 0.7rem; font-size: 12px;float:left;"><span style="float: right;">மேலும் <i class="fa fa-arrow-right" style=" color: #071c47;"></i></span></a>';
}	
$show_simple_tab .='</div></div>';
echo $show_simple_tab;
?>
<script>
$(document).ready(function(e){
	var hs = [$('.tg-wrapper').height() , $('.center-page-stories').height()];
	$('.tg-wrapper,.center-page-stories').height(Math.max(...hs));
});
</script>