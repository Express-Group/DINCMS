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

$widget_contents = array();

$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
<div class="latest-news boder-bot" '.$widget_bg_color.'>
<div class="row">';

$content_type = $content['content_type_id'];  
//getting content block starts here . Do not change anything
if($content['RenderingMode'] == "manual")
{
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 			

	// content list iteration block starts here
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
else
{
	if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$content['sectionID'] , $content_type ,  $content['mode'], $is_home);
	} else {
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
		if (function_exists('array_column'))  {
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


	$i =1;
	if(count($widget_contents)>0)
	{
		$odd_widget_contents=array();
		$even_widget_contents=array();
		$count=1;
		$total_articles = count($widget_contents);
		foreach($widget_contents as $widget_contents_val)
		{
			if($count<=$total_articles/2)  //if($count%2==1)
			{
				$odd_widget_contents[]=$widget_contents_val;
			}
			else
			{
				$even_widget_contents[]=$widget_contents_val;
			}
			$count++;
		}
		//var_dump($odd, $even);
		
	if(count($odd_widget_contents)>0)
	{          $odd_count = 1;
				foreach($odd_widget_contents as $get_content)
			{		
				$custom_title        = "";
				$custom_summary      = "";		
				if($content['RenderingMode'] == "manual")// from widgetinstancecontent table    
				{
					$custom_title        = stripslashes($get_content['CustomTitle']);
					$custom_summary      = $get_content['CustomSummary'];
				}		
				
				/******************** article title and summary and url ********************/
				$content_url = $get_content['url'];
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
				$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);   //to remove first<p> and last</p>  tag
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
				/******************** article title and summary and url ********************/
				
				// display title and summary block starts here
				if($odd_count==1){
					$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  top-title ">';
					if($widget_custom_title!='')
					{
						if($content['widget_title_link'] == 1)
						{
							//$show_simple_tab.='<h4><i class="fa fa-backward"></i><p><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></p>';
							//$show_simple_tab.='<i class="fa fa-forward"></i></h4>';
							$show_simple_tab.='<figure class="seithigal-strip week-button"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></figure>';
						}
						else
						{
							$show_simple_tab.='<h4><i class="fa fa-backward"></i><p> '.$widget_custom_title.'</p>';
							$show_simple_tab.='<i class="fa fa-forward"></i></h4>';
						}
					}
$show_simple_tab .='<ul class="lead-list ">';
				}
				$show_simple_tab .='<li><div><i class="fa fa-angle-right"></i></div>';
				$show_simple_tab .='<p>'.$display_title.'</p>';			
				$show_simple_tab .= '</li>';
				if(($odd_count == count($odd_widget_contents))){
					$show_simple_tab .='</ul></div>';
				}
				$odd_count++;
				if((count($even_widget_contents)==0) && $odd_count == count($odd_widget_contents)){
						if($content['widget_title_link'] == 1){
							$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow">';
							$show_simple_tab .='<div class="arrow-span"></div><div class="arrow-rightnew"></div></a></div></div>';					
						}
					}
			}
			
			}
			if(count($even_widget_contents)>0)
			{
				 $even_count = 1;
				foreach($even_widget_contents as $get_content)
			{		
				$custom_title        = "";
				$custom_summary      = "";		
				if($content['RenderingMode'] == "manual")// from widgetinstancecontent table    
				{
					$custom_title        = stripslashes($get_content['CustomTitle']);
					$custom_summary      = $get_content['CustomSummary'];
				}		
				
				/******************** article title and summary and url ********************/
				$content_url = $get_content['url'];
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
				$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);   //to remove first<p> and last</p>  tag
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
				/******************** article title and summary and url ********************/
				
				// display title and summary block starts here
				if($even_count == 1)
				{
					$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pad-left"><ul class="lead-list latest-news-2">';
				}
				$show_simple_tab .=' <li><div><i class="fa fa-angle-right"></i></div>';			
				$show_simple_tab .='<p>'.$display_title.'</p>';			
				$show_simple_tab .='</li>';  
				if($even_count == count($even_widget_contents))
				{
					$show_simple_tab .='</ul></div>';			
				}
					if($even_count == count($even_widget_contents)){
						if($content['widget_title_link'] == 1){
							$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow">';
							$show_simple_tab .='<div class="arrow-span"></div><div class="arrow-rightnew"></div></a></div></div>';					
						}
					}	

			   $even_count++;
			}
			}
		
	}
elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
else
{
	$show_simple_tab .='';
}

$show_simple_tab .='</div><div class="common-border"><span></span><span></span></div></div></div></div>';
echo $show_simple_tab;
?>
