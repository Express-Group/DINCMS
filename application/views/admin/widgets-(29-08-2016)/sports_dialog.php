<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();
$view_mode              = $content['mode'];
$show_simple_tab        = "";
$show_simple_tab       .='<div class="row">
						   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						   <div class="dialog-wrapper margin-bottom-10" >';
				   
if($widget_custom_title!='')
{
    $show_simple_tab.='<div class="dialog-1">
	<figure class="comma-left"></figure>';
	if($content['widget_title_link'] == 1)
	{
	$show_simple_tab.='<h4 class="junction-link><a href="'.$widget_section_url.'"   >'.$widget_custom_title.'</a></h4>';
	}
	else
	{
	$show_simple_tab.=	'<h4 class="junction-link"> '.$widget_custom_title.' </h4>';
	}
	$show_simple_tab.=' <figure class="comma-right"></figure>
	</div>';	

}

if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 						
}
else
{
$content_type = $content['content_type_id'];  // auto article content type
$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);
}
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
		$widget_contents = array();
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
			
														
$i=1;	
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
			
			$custom_title   = $get_content['CustomTitle'];
			$custom_summary = $get_content['CustomSummary'];
		}
		
		
			
		$content_url = $get_content['url'];
		$param = $content['page_param'];
		$live_article_url = $domain_name.$content_url."?pm=".$param;
		
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
		// Assign summary block starts here
		/*if( $custom_summary == '')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	 */
		//  summary block endss here
			
			
if($view_mode == "adminview")
{

$author_name = $get_content['AuthorName'];
$url_section_value=$get_content['URLStructure'];
}
else 
{
$author_name=$get_content['author_name'];
$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-5;

$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
$url_section_value = $sectionURL;
}

if ($author_name == "")
{
$author_name=$get_content['section_name'];
}
															
		$show_simple_tab.=' <div class="dialog-2" '.$widget_bg_color.'>
							<p>'.$display_title.'</p>';
							//$show_simple_tab.='<h5>'.$author_name.'</h5>';
							$show_simple_tab.='</div>';
							
																			
	   $i=$i+1;
	}
  }
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div>';
}
if($content['widget_title_link'] == 1)
{
							
$show_simple_tab.='<div class="arrow"><a href="'.$widget_section_url.'"  class="landing-arrow"><span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';
}
echo $show_simple_tab.='</div>
						</div>
						</div>';
?>