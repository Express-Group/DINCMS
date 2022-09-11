<?php

$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$widget_section_url = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$domain_name =  base_url();
$view_mode           = $content['mode'];
$show_simple_tab = "";
$show_simple_tab.= '<div class="row" >';


$show_simple_tab .=' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
if($widget_custom_title!='')       			
{
                   $show_simple_tab .=' <figure class="rel-bg-left"></figure>';
					
					if($content['widget_title_link'] == 1)
					{
						$show_simple_tab.= '<figure class="rel-bg-center1"><p><a href="'.$widget_section_url.'"  >'.$widget_custom_title.'</a></p></figure>';
					}
					else
					{
						$show_simple_tab.= 	'<figure class="rel-bg-center1"><p> '.$widget_custom_title.'</p></figure>';
					}
					    $show_simple_tab .=' <figure class="rel-bg-right"> </figure> ';
}
$show_simple_tab.= '</div> ';


$show_simple_tab.= ' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >';
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
	
				
$i =1;
														
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		$custom_title        = "";
		//$custom_summary      = "";
		if($content['RenderingMode'] == "manual")
		{
		
		$custom_title   = $get_content['CustomTitle'];
		//$custom_summary = $get_content['CustomSummary'];
		}
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
		/*if( $custom_summary == '')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag */
		
		if($i==1)
		{
	//	$show_simple_tab.= ' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >';
		$show_simple_tab.= ' <articel class="sec-read" '.$widget_bg_color.'>
		<ul class="lead-list">';
		}
		
		$show_simple_tab.= '  <li>
		<div><i class="fa fa-angle-right"></i></div>
		<p>'.$display_title.'</p>
		</li>';
		
		if($i==count($widget_contents))
		{
		$show_simple_tab.= ' </ul>';
			if($content['widget_title_link'] == 1)
			{	
			$show_simple_tab.= '	<div class="arrow"><a href="#"><span class="arrow-span"> </span>
			<div class="arrow-rightnew"></div>
			</a></div>';
			}
		$show_simple_tab.= '</articel>';
		//$show_simple_tab.= ' </div>';
		}
		
		$i =$i+1;							  
	}
  }elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div>';
}


$show_simple_tab.= ' </div>';
 echo $show_simple_tab.= '</div>';
?>
