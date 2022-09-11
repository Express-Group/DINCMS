<?php 
//print_r($content); exit;
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_section_url      = $content['widget_section_url'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$view_mode               = $content['mode'];
//print_r($widget_bg_color);exit;
// widget config block ends
//getting tab list for hte widget
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row" >
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lifestyle-lead">
<div class="health-lead margin-bottom-10">
<div class="top-news"> <div class="kural-box life-story">';
//	$url_structure = $content['url_structure'];
//	$section_landing =  "0,".$content['sectionID'].", 'section', this, '".$url_structure."'";
if($widget_custom_title  != '')

{
if($content['widget_title_link'] == 1)
{
$show_simple_tab.=	'<div class="box-botton kural-button"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></div>';
}
else
{
$show_simple_tab.=	'<div class="box-botton kural-button">'.$widget_custom_title.'</div>';
}
}


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
														
														$i =1;$n =1;
														
														foreach($widget_contents as $get_content)
														{
															$custom_title        = "";
															$custom_summary      = "";
															$original_image_path = "";
															$imagealt            = "";
															$imagetitle          = "";
															$Image600X390        = "";

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
	$Image600X390 	= $original_image_path;
}
else
{				
	$Image600X390 	= str_replace("original","w600X390", $original_image_path);
}
if (get_image_source($Image600X390, 1) && $Image600X390 != '')
{
	$show_image = image_url. imagelibrary_image_path . $Image600X390;
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
	$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
	/*if( $custom_summary == '' && $content['RenderingMode'] == "auto")
	{
		$custom_summary =  $get_content['summary_html'];
	}
	$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag */
																	
															//  Assign article links block ends hers
																														
																// display title and summary block starts here
																if($i==1)
																{
																	$show_simple_tab .='<ul class="nigalvugal_even" '.$widget_bg_color.'>';
																}
				if($n==1){
				$show_simple_tab .='<li>';
				$show_simple_tab .= '<figure><a href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure>';
				$show_simple_tab .='<figcaption><p>'.$display_title.'</p></figcaption>';
				$show_simple_tab .= '</li>';
				}else
				{
				$show_simple_tab .='<li>';
				$show_simple_tab .='<figcaption><p>'.$display_title.'</p></figcaption>';
				$show_simple_tab .= '<figure><a href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure>';
				$show_simple_tab .= '</li>';
				$n =0;	
				}
																
																if($i == count($widget_contents))
																{
																	$show_simple_tab .='</ul>';
																	if($content['widget_title_link'] == 1)
																	{
																	 $show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';
																	}		
																	$show_simple_tab .='	</div>';
																	
																}
																// display title and summary block ends here					
																//Widget design code block 1 starts here																
															//Widget design code block 1 starts here			
															$i =$i+1;	
															$n =$n+1;							  
														}
														
														 
												}
												
 elseif($view_mode=="adminview")
			{
				 $show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div></div>';
			}
			else
			{
				 $show_simple_tab .='</div>';
			}
													
											// Adding content Block ends here
													$show_simple_tab .='</div></div>
																	</div>
																  </div>
																';
echo $show_simple_tab;
?>
