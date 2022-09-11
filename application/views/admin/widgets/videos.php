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
$show_simple_tab         = "";
// widget config block ends

$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
<div class="sec-9">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';

if($widget_custom_title !='')
{
	$show_simple_tab .= '<figure class="bg-left"></figure>';
		
	if($content['widget_title_link'] == 1)
	{
	$show_simple_tab.=	'<figure class="bg-center1"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
	}
	else
	{
	$show_simple_tab.=	'<figure class="bg-center1">'.$widget_custom_title.'</figure>';
	}
	$show_simple_tab.= '<figure class="bg-right"></figure>';
}

$show_simple_tab.='</div></div> ';
$content_type = $content['content_type_id'];  // auto article content type
$widget_contents = array();
//getting content block starts here .
if($content['RenderingMode'] == "manual") {
	
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
					$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
			}else{
					  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],   $content['sectionID'], $content_type ,  $content['mode'], $is_home);
					if (function_exists('array_column')) {
						$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
					} else {
						$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
					}
					$get_content_ids = implode("," ,$get_content_ids); 
					if($get_content_ids!='') {
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
//getting content block ends here

$i =1;
$count = 1;
if(count($widget_contents)>0)
{
	// content list iteration block - Looping through content list and adding it the list
	// content list iteration block starts here
foreach($widget_contents as $get_content)
{

/*if(@$original_image_path =='')
{
$original_image_path = @$content_details[0]['video_image_path'];
$imagealt = @$content_details[0]['video_image_alt'];	
$imagetitle= @$content_details[0]['video_image_title'];
}*/

$custom_title        = "";
//$custom_summary      = "";
$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$Image600X300        = "";
if($content['RenderingMode'] == "manual")            // from widgetinstancecontent table    
{
	if($get_content['custom_image_path'] != '')
	{
		$original_image_path = $get_content['custom_image_path'];
		$imagealt            = $get_content['custom_image_title'];	
		$imagetitle          = $get_content['custom_image_alt'];												
	}
		$custom_title        = stripslashes($get_content['CustomTitle']);
		//$custom_summary      = $get_content['CustomSummary'];

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
	$Image600X300 	= $original_image_path;
}
else
{				
	$Image600X300 	= str_replace("original","w600X300", $original_image_path);
}
if (get_image_source($Image600X300, 1) && $Image600X300 != '')
{
	$show_image = image_url. imagelibrary_image_path . $Image600X300;
}
else 
{
	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}
	$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';

}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
$dummy_image = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}	
	
								   /******************** article title and summary and url ********************/
	$content_url = $get_content['url'];
	$param = $content['close_param']; //page parameter
	$live_article_url = $domain_name. $content_url.$param;

	if( $custom_title == '')
	{
		$custom_title = stripslashes($get_content['title']);
	}	
	$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
	$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
//  Assign article links block ends hers


//  Assign article links block ends hers

																	
// display title and summary block starts here
if($content['RenderingMode'] == "manual")
{
$show_image ='<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
}
else
{
$show_image ='<img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
}

if($count==1)
{
$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="video-sec"><div class="row">';
}

$show_simple_tab .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">';
$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click" ><div class="video-box">'.$show_image;
$show_simple_tab .='<figure class="play-icon"></figure>';
$show_simple_tab .= '</div>';
$show_simple_tab .='<figcaption class="video-p">'.$display_title.'</figcaption>';
$show_simple_tab .='</a></div>';

if($count==3 || ($i == count($widget_contents)))
{
$show_simple_tab .= '</div></div></div></div>';
}
$count ++;
if($count>3)
{
$count=1;
}
// display title and summary block ends here					
$i =$i+1;							  
}
// content list iteration block ends here
//}
}
elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}

if($content['widget_title_link'] == 1)
{
$show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';										
}
// Adding content Block ends here
$show_simple_tab .='</div><div class="common-border"><span></span><span></span></div>
</div>
</div>';
echo $show_simple_tab;
?>
