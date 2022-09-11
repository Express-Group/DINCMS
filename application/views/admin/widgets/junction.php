<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color         = $content['widget_bg_color'];
$widget_custom_title     = $content['widget_title'];
$widget_instance_id      =  $content['widget_values']['data-widgetinstanceid'];
$widget_section_url      = $content['widget_section_url'];
$is_home                 = $content['is_home_page'];
$main_sction_id 	     = "";
$is_home                 = $content['is_home_page'];
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$domain_name             =  base_url();
$view_mode               = $content['mode'];
$show_simple_tab         = "";
// widget config block ends


$domain_name =  base_url();
$content_type = $content['content_type_id'];  // auto article content type

$show_simple_tab = "";
$show_simple_tab .='<div class="main-junction"'.$widget_bg_color.'><div class="row">';
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >';
if($widget_custom_title == '')
{
	$widget_custom_title='சாளரம்';
}

if($widget_custom_title!='')
{		
	if($content['widget_title_link'] == 1)
	{
	$show_simple_tab.=	'<h5 class="din-title"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></h5>';
	}
	else
	{
	$show_simple_tab.=	'<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
	}
}
$show_simple_tab .='</div></div>';
$show_simple_tab .='<section id="features"><div class="row">';
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >';
$show_simple_tab .='<div class="slider autoplay pre-arrow " id="singleplay" >';

$widget_contents = array();
//getting content block starts here . Do not change anything
if($content['RenderingMode'] == "manual")
{
	$widget_instance_contents = $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " , $view_mode,$content['show_max_article']); 	

	// content list iteration block starts here
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
else
{
	// $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'], $content_type , $view_mode);
	  if($view_mode=="live"){
			$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
	} else{
			  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
			if (function_exists('array_column')) {
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			} else {
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


	$i =1;
	$slider_side = 'L';
	if(count($widget_contents)>0)
	{
		//print_r($widget_contents);exit;
		foreach($widget_contents as $get_content)
		{
			//print_r($get_content);exit;
			// Code Block B starts here - Do not change
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$custom_title        = "";
			$custom_summary      = "";
			$author_name         = ""; 
			$Author_image_path   = "";
			$topic_name          = "";
			$author_image        = "";
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
		$author_image         = $get_content['author_image_path'];
		$imagealt             = $get_content['author_image_alt'];	
		$imagetitle           = $get_content['author_image_title'];
        $author_name          = $get_content['author_name'];
}
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';		

/*if($author_image  !='')
{
	if (getimagesize(image_url . $author_image ) && $author_image  != '')
	{	
		 $show_image = image_url. $author_image ;
	}
}*/
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
	$Image150X150 	= str_replace("original","w150X150", $original_image_path);
if (get_image_source($Image150X150, 1) && $Image150X150 != '')
{
	$show_image = image_url. imagelibrary_image_path . $Image150X150;
}
}
			$section_name=$get_content['section_name'];
			$content_url = $get_content['url'];
			$author_new_url = 'Author/'.$author_name;
			$url_array = explode('/', $content_url);
			$get_seperation_count = count($url_array)-5;
			$author_url = ($get_seperation_count==1)? $domain_name.$author_new_url : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
			
			$param = $content['close_param'];
			$live_article_url = $domain_name.$content_url.$param;
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? $get_content['title']: '' ) ;
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);   //to remove first<p> and last</p>  tag
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
			//$summary = ( $custom_summary != '') ? $custom_summary : ( ($get_content['summary_html'] != '') ? $get_content['summary_html']: '' ) ;
			//$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$summary);
			$lastpublishedon = $get_content['publish_start_date'];
			//  Assign article links block ends hers
			$section_name=$get_content['section_name'];
			$content_url = $get_content['url'];
			$url_array = explode('/', $content_url);
			$get_seperation_count = count($url_array)-4;
			$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
			$time = $lastpublishedon; 
			//$post_time = $this->widget_model->time2string($time);
			if($slider_side == 'L') 
			{
				//echo $i;
				$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
				$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				$show_simple_tab .='<div class="row"><article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mani pad-right">';
				$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mani-list junction padding-both">';
				$show_simple_tab .='<a href="'.$sectionURL.'"><h4>'.$author_name.'</h4><a>';
				$show_simple_tab .='<a href="'.$sectionURL.'"><h5>'.$section_name.'</h5></a>';
				$show_simple_tab .='<p>'.$display_title.'</p>';
				$show_simple_tab .='<time>'.date('d.m.Y',strtotime($time)).'</time></div>';
				$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click"><figure class="col-lg-6 col-md-6 col-sm-6 col-xs-6  mani-img">';
				$show_simple_tab .='<div class="arrow-left"></div>';
				$show_simple_tab .='<img src="'.$dummy_image.'" data-src="'.$show_image.'" data-lazy="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'" /></figure></a>';
				$show_simple_tab .='</article></div></div></div></div>';				
				$slider_side ='R';
			} 
			else if($slider_side == 'R') 
			{			
				$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
				$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				$show_simple_tab .='<div class="row"><article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mani2 pad-left">';
				$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click"><figure class="col-lg-6 col-md-6 col-sm-6 col-xs-3 mani-img2 ">';
				$show_simple_tab .='<img src="'.$dummy_image.'" data-src="'.$show_image.'" data-lazy="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
				$show_simple_tab .='<div class="arrow-right"></div></figure></a>';
				$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mani-list2 junction padding-both">';
				$show_simple_tab .='<a href="'.$sectionURL.'"><h4>'.$author_name.'</h4><a>';
				$show_simple_tab .='<a href="'.$sectionURL.'"><h5>'.$section_name.'</h5></a>';
				$show_simple_tab .='<p>'.$display_title.'</p>';
				$show_simple_tab .='<time>'.date('d.m.Y',strtotime($time)).'</time>';
				$show_simple_tab .='</div></a></article>';
				$show_simple_tab .='</div></div></div></div>';
				$slider_side ='L';
			}		
			$i =$i+1;							  
		}
	
	} elseif($view_mode != 'live') {
		$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
	} else {
		$show_simple_tab .='<div class="margin-bottom-10"></div>';
	}
$show_simple_tab .='</div>';
// Adding content Block ends here
if($content['widget_title_link'] == 1)
{
	$show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" >மேலும் <i class="fa fa-arrow-right" style=" color: #071c47;"></i></a></div>';
}
$show_simple_tab .='</div></div></section></div>';
echo $show_simple_tab;
?>


