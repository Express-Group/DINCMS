<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];
//echo $widget_instancemainsection['0']['CustomTitle'];exit;
$domain_name            =  base_url();
$show_simple_tab        = "";
$show_simple_tab       .= '<div class="row">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom">';
						   
		     $show_simple_tab.= '<div class="spotts-space ">';
			 
if($widget_custom_title!='')
	{
	$show_simple_tab.= '<fiugre class="bg-left"></fiugre> <fiugre class="bg-center1">';
		if($content['widget_title_link'] == 1)
		{
		$show_simple_tab.='<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
		}
		else
		{
		$show_simple_tab.=	$widget_custom_title;
		}
	$show_simple_tab.= '</fiugre><fiugre class="bg-right"></fiugre>';
}
			  
$show_simple_tab.= ' </div>';


if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode,$content['show_max_article']); 
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
														
$i=1;
//print_r($widget_instance_contents );exit;
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		$custom_title        = "";
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$Image600X300        = "";
		$custom_title        = "";
		$custom_summary      ="";
		if($content['RenderingMode'] == "manual")
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
		
			if($original_image_path =="")                         // from cms imagemaster table    
			{
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt             = $get_content['ImageCaption'];	
			$imagetitle           = $get_content['ImageAlt'];	
			}
		
		$show_image="";
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
				
				$show_image = image_url. imagelibrary_image_path . $Image600X300;
			}	
			else 
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			
		$content_url = $get_content['url'];
		$param = $content['close_param']; //page parameter
		$live_article_url = $domain_name. $content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = stripslashes($get_content['title']);
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		//  Assign article links block ends hers
		// Assign summary block starts here
		if( $custom_summary == '' && $content['RenderingMode'] == 'auto')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
		// Assign summary block starts here
		$play_gallery_image = image_url. imagelibrary_image_path.'gallery-icon.png';
		
		if( $i==1 || $i%2==1)
		{
		$show_simple_tab.='<div class="clear_both" '.$widget_bg_color.'>';
		}
		//  Assign article links block ends hers
		
		$show_simple_tab.=' <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-right" >
		<div class="sports-photo">';
		
		$show_simple_tab.=' <a href="'.$live_article_url.'" class="article_click" >
		<figure>
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
		<div class="play-icon1"> <img src="'.$play_gallery_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" /></div>
		</figure> </a>';
		
		
		$show_simple_tab.='      <figcaption>
		<h4>'.$display_title.' </h4>';
		
		if($is_summary_required== 1)
			{
			$show_simple_tab.='<p class="summary">'.$summary.'</p>';
			} 
		
		$show_simple_tab.='</figcaption>';
		
		$show_simple_tab.='</div> </div>';	
		
		if($i%2==0)
		{
		
		$show_simple_tab.='</div>';
		// $i=2; 
		}
		if($i==count($widget_contents))
		{
		if($i==1 || $i%2==1){ $show_simple_tab.='</div>'; }
		
		}
		$i =$i+1;	
		}
    }
elseif($view_mode=="adminview") 
{
$show_simple_tab .='<div class="margin-bottom-10" style="width:100%" '.$widget_bg_color.'>'.no_articles.'</div>';
}
if($content['widget_title_link'] == 1)
{
$show_simple_tab.='<div class="arrow"><a href="'.$widget_section_url.'"  class="landing-arrow"><span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';	
}

echo $show_simple_tab.= '</div> </div>';


?>