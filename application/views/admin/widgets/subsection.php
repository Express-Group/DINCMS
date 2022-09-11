<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid = $content['sectionID'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$widget_section_url = $content['widget_section_url'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
// widget config block ends
//getting tab list for hte widget
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name =  base_url();
if($widget_custom_title == "")
$widget_custom_title = "";
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				   <div class="state-sec" '.$widget_bg_color.'>
				   <div class="row">';  
			  
										//$show_simple_tab .= '<figure class="bg-left"></figure>';
													
													/*$show_simple_tab.=	'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sate-head">';		
													if($content['widget_title_link'] == 1)
													{
														$show_simple_tab.=	'<h4><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h4>';
													}
													else
													{
														$show_simple_tab.='<h4>'.$widget_custom_title.'</h4>';
													}
													$show_simple_tab.= '</div>';*/
													
																					

													
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

														
$i =1;
if(count($widget_contents)>0)
{
foreach($widget_contents as $get_content)
{
	// getting content details 
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
			$custom_title   = $get_content['CustomTitle'];
			$custom_summary = $get_content['CustomSummary'];
		}
		if($original_image_path =="")                                                // from cms || live table    
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
																// display title and summary block starts here
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
		if( $custom_summary == '' && $content['RenderingMode'] == "auto")
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	
		//  summary block endss here
		$lastpublishedon = $get_content['last_updated_on'];														
																if($i==1)
																{
																
																	$show_simple_tab .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																	<article>
																	<a href="'.$live_article_url.'" class="article_click"><figure><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" /></figure></a>
																	<figcaption class="lead-news">';
																	 $show_simple_tab .='<h4>'.$display_title.'</h4>';
																	 
																	if($is_summary_required== 1)
																	{
																	$show_simple_tab.='<p class="summary">'.$summary.'</p>';
																	}
		
																	 
																	 
																	 
																	 $show_simple_tab .=' </figcaption>
																	  </article>
																	</div>';
																	
																	 /*$show_simple_tab .=' <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 first-top ">
																	  <ul class="lead-list">';*/
																		 
																}
																else
			
																{
																	if($i==2)
																{
																	$show_simple_tab .=' <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 first-top ">
																	  <ul class="lead-list">';
																}
																
																$show_simple_tab .='<li><div><i class="fa fa-angle-right"></i></div>';
																$show_simple_tab .='<p>'.$display_title.'</p>';
																
																	//$time = $lastpublishedon; 
																	//$post_time= $this->widget_model->time2string($time); 
																	//$show_simple_tab.=	'<p class="post_time br_bottom">'.$post_time.' ago</p>';
																$show_simple_tab.=	'<p class="post_time br_bottom">'.date('d-m-Y',strtotime($lastpublishedon)).'</p>';
																$show_simple_tab .='</li>';
					
																if($i == count($widget_contents))
																{
																	$show_simple_tab .='</ul></div>';
																}
													
																/*if($widgetsectionid !='')
																{
																	$string_value = $contentID.",".$widgetsectionid.", 'section'";
																}*/				
															}
															$i =$i+1;	
															
														}
}

elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
	$show_simple_tab .='</div>';
}
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
/*if($content['widget_title_link'] == 1)
{
$show_simple_tab.='<div class="arrow">
<a href="'.$widget_section_url.'" class="landing-arrow"> <span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';
}*/
														$show_simple_tab .='</div>';
													
													$show_simple_tab .='</div><div class="common-border"><span></span><span></span></div></div></div></div>';
													echo $show_simple_tab;
?>
