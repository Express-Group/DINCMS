<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary']; 
$view_mode              = $content['mode'];
$domain_name            =  base_url();
$content_type = $content['content_type_id'];

// widget config block ends
$show_simple_tab        = "";
$show_simple_tab       .='  <div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
$show_simple_tab.= '<div>';

$content_type = $content['content_type_id'];
$widget_contents = array();

if($content['RenderingMode'] == "manual")
{
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 						


//print_r($widget_instance_contents);exit;
if (function_exists('array_column')) 
{
$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
}else
{
$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
}
$get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='')
{
$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	

foreach ($widget_instance_contents as $key => $value) 
{
foreach ($widget_instance_contents1 as $key1 => $value1) 
{
if($value['content_id']==$value1['content_id'])
{
$widget_contents[] = array_merge($value, $value1);
}
}
}
}


}
else
{

//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);

		if($view_mode=="live"){
				$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
				
		  }else{
			  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
		
			if (function_exists('array_column')) {
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			} else{
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
$count = 1;
if(count($widget_contents)>0)
{
foreach($widget_contents as $get_content)
{
$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$custom_title        = "";
$custom_summary      = "";
if($content['RenderingMode'] == "manual")
{
if($get_content['custom_image_path'] != '')
{
$original_image_path = $get_content['custom_image_path'];
$imagealt            = $get_content['custom_image_title'];	
$imagetitle          = $get_content['custom_image_alt'];												
}
$custom_title        = stripslashes($get_content['CustomTitle']);
}	

if($original_image_path =="")                         // from cms imagemaster table    
{
$original_image_path  = $get_content['ImagePhysicalPath'];
$imagealt             = $get_content['ImageCaption'];	
$imagetitle           = $get_content['ImageAlt'];	
}

$show_image="";

if($original_image_path =="")      // from cms || live table    
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
$Image600X390 	= $original_image_path;
}
else
{				
$Image600X390 	= str_replace("original","w600X390", $original_image_path);
}

$show_image = image_url. imagelibrary_image_path . $Image600X390;

}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
}
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';	
$content_url = $get_content['url'];
$param = $content['close_param'];
$live_article_url = $domain_name.$content_url.$param;

if( $custom_title == '')
{
$custom_title = $get_content['title'];
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	

//  Assign article links block ends hers
$play_gallery_image = image_url. imagelibrary_image_path.'gallery-icon.png';
$show_simple_tab.= '<div class="gallery-sec margin-bottom">';
$show_simple_tab.= '<a href="'.$live_article_url.'" class="article_click" ><figure class="gall-img">
<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
if($content_type==3)
{
$show_simple_tab.= '<div class="play-icon gallery-play-icon">';
}
if($content_type==4)
{
$show_simple_tab.= ' <div class="play-icon">';
}

$show_simple_tab.= '</figure></a>
<figcaption class="gall-des">'.$display_title;
if($content_type==3)
{
$gallery_details = $this->widget_model->get_gallery_image_data($get_content['content_id'], $view_mode);
$gallery_count   = count($gallery_details);
$show_simple_tab.= '<div class="gallery-count">1/'.$gallery_count.'</div>';
}
$show_simple_tab.= '</figcaption>';
$show_simple_tab.='</div>';
$i =$i+1;
}
//}
// content list iteration block ends here
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10"  '.$widget_bg_color.'>'.no_articles.'</div>';
}

$show_simple_tab.='</div></div>';
echo $show_simple_tab.='</div>';


?>