<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$widget_section_url  = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$domain_name         =  base_url();
$view_mode           = $content['mode'];
$show_simple_tab     = "";
$show_simple_tab    .= '<div class="row" >
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					    <articel class="sec-read" '.$widget_bg_color.'>';

if($widget_custom_title!='')
{	
	if($content['widget_title_link'] == 1)
	{
	$show_simple_tab.=	'<h4> '.$widget_custom_title.'</h4>';
	}
	else
	{
	$show_simple_tab.='<h4>'.$widget_custom_title.'</h4>';
	}
}
													
	$show_simple_tab.='<ul class="lead-list" >';
																										
														
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
$i =1;

if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		$custom_title        = "";
		if($content['RenderingMode'] == "manual")
		{
		$custom_title   = $get_content['CustomTitle'];
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
		$show_simple_tab.='<li>
		<div><i class="fa fa-angle-right"></i></div>
		<p>'.$display_title.'</p>
		</li>';
		$i =$i+1;							  
		}
    }
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div>';
}                                                
$show_simple_tab .='</ul>';
echo $show_simple_tab .='</articel>
</div>
</div>';
?>


