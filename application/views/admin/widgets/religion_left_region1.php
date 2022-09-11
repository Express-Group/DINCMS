<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$widget_section_url  = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$domain_name         =  base_url();
$view_mode           = $content['mode'];

$show_simple_tab     = "";
$show_simple_tab    .= '<div class="row"> ';


$show_simple_tab .=' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
if($widget_custom_title!='')       			
{
                    $show_simple_tab .=' <figure class="rel-bg-left"></figure>';
					     
					if($content['widget_title_link'] == 1)
					{
						$show_simple_tab.= '<figure class="rel-bg-center1"><p><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></p></figure>';
					}
					else
					{
						$show_simple_tab.= 	'<figure class="rel-bg-center1"><p>  '.$widget_custom_title.' </p></figure>';
					}
					$show_simple_tab .=' <figure class="rel-bg-right"> </figure> ';
}
$show_simple_tab .='  </div>';


    $show_simple_tab .='<div class="religion-join">';

                                                //getting content block - getting content list based on rendering mode
														//getting content block starts here . Do not change anything
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
														$i=1;
														$count = 1;
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$custom_title        = "";
		//$custom_summary      = "";
			if($content['RenderingMode'] == "manual")
			{
			if($get_content['custom_image_path'] != '')
			{
			$original_image_path = $get_content['custom_image_path'];
			$imagealt            = $get_content['custom_image_title'];	
			$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title   = $get_content['CustomTitle'];
			//$custom_summary = $get_content['CustomSummary'];
			}
		if($original_image_path =="")      // from cms || live table    
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
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
		// Assign summary block starts here
	/*	if( $custom_summary == '')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag */
		
		if($i==1)
		{
		$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="old-stick"><img src="'.static_url.'images/FrontEnd/images/old-roll.png" /></div>
		</div>
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-out">
		<div class="thodar" '.$widget_bg_color.'>';
		
		}
		
		$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click" >	<figure class="thoder-inline">
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
		<figcaption>'.$display_title.'</figcaption>
		</figure></a>';
		if($i==count($widget_contents))
		{
		$show_simple_tab .='</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="old-stick1"><img src="'.static_url.'images/FrontEnd/images/old-roll.png" /></div>
		</div>';
		
		}
		
		$i++;
		
	  }
   }

elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div></div>';
}

echo $show_simple_tab .='</div></div>';
?>
