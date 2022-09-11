<?php
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url = $content['widget_section_url'];
$view_mode           = $content['mode'];
$domain_name            =  base_url();
$show_simple_tab ="";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
<div class="junction-lead jun-list-2 junction-single junction-arrow" >';

if($widget_custom_title!='')
{ 

$show_simple_tab.='<div class="jun-center">';

if($content['widget_title_link'] == 1)
{

$show_simple_tab.='<h4><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h4>';
}
else
{

$show_simple_tab.=	'<h4>'.$widget_custom_title.'</h4>';
}

$show_simple_tab.='<div class="arrow-down"></div>';
$show_simple_tab.='</div>';	
}



if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];
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





if(count($widget_contents)>0)
{
//print_r($widget_contents);exit;
foreach($widget_contents as $get_content)
{

$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$custom_title        = "";
$custom_summary      = "";
$author_name         = ""; 
$author_image        = "";
$image_id="";
/*$author_id = '';
$section_id='';*/
//print_r($get_content);exit;
if($view_mode == "adminview")
{
$section_id=$get_content['Section_id'];
$section_details = $this->widget_model->get_section_by_id($section_id);
//print_r($section_details);exit;
$author_id = $section_details['AuthorID'];
$author_det = $this->widget_model->get_author($author_id);	
//print_r($author_det);
//  summary block endss here
if(count($author_det)>0)
{
$author_name = $author_det[0]['AuthorName'];

$author_image = "";
$imagealt = "";
$imagetitle  = "";
$image_id  = $author_det[0]['image_id'] ;

$image_path=$author_det[0]['image_path'] ;
if($image_path !='')
{
$author_image  = $author_det[0]['image_path']; 
$imagealt             = $author_det[0]['image_alt'];	
$imagetitle           = $author_det[0]['image_caption'];
}	
}	

}
else if($view_mode =="live")
{	
$author_image         =  $get_content['author_image_path'];
$imagealt             = $get_content['author_image_alt'];	
$imagetitle           = $get_content['author_image_title'];
$author_name          = $get_content['author_name'];
}



if($author_image  !='')
{
if (getimagesize(image_url_no . $author_image ) && $author_image  != '')
{	
//die('test');
$show_image = image_url. $author_image ;
}
else
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
}
}
else
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
}
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';

$content_url = $get_content['url'];
$param = $content['close_param'];
$live_article_url = $domain_name.$content_url.$param;

if( $custom_title == '')
{
$custom_title = $get_content['title'];
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title); //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	

// Assign summary block starts here
if( $custom_summary == '' && $content['RenderingMode'] == "auto")
$custom_summary =  $get_content['summary_html'];

$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag

$section_name=$get_content['section_name'];
$content_url = $get_content['url'];
$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;

$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);

if ($author_name == "")
{
$author_name=$get_content['section_name'];
}



//  Assign article links block ends hers

$show_simple_tab.=' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" '.$widget_bg_color.'>';
$show_simple_tab.='<a href="'.$sectionURL.'"><h1>'.$author_name.'</h1></a>';
$show_simple_tab.='<a href="'.$sectionURL.'" class="article_click" >
<figure class="junction-lead2"> 
<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">
</figure>
</a>

<figcaption>';
$show_simple_tab.='<a href="'.$sectionURL.'"><h1 class="junction-green">'.$section_name.'</h1></a>';
//$show_simple_tab.='<h1>'.$author_name.'</h1>';
$show_simple_tab.='<h4>'.$display_title.' </h4>';

if($is_summary_required== 1)
$show_simple_tab.='<p class="summary">'.$summary.'</p>';

$show_simple_tab.='</figcaption>';
if($content['widget_title_link'] == 1)
{	
$show_simple_tab.='<div class="arrow-jun">
<a href="'.$live_article_url.'" class="landing-arrow"><span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';
}
$show_simple_tab.='</div>';

}

}

else
{
	if($view_mode=="adminview")
		$show_simple_tab .='<div class="margin-bottom-10" style="width:100%" '.$widget_bg_color.'>'.no_articles.'</div>';
}
echo $show_simple_tab.='</div>
</div>
</div>';

?>



