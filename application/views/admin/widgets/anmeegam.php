<?php 
/*
Finame 		: 	anmeegam
Created On 	: 	27-4-2016
Purpose for	:	Display the anmeegam widget
*/

$widget_bg_color        = $content['widget_bg_color']; 
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();


$show_simple_tab = "";
$show_simple_tab .=' <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
          <div class="sec-12" '.$widget_bg_color.' >
          <div class="row" >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >';
	if($widget_custom_title!='')
	{
		$show_simple_tab .= '<figure class="bg-left"></figure>';
			if($content['widget_title_link'] == 1)
			{
			$show_simple_tab.=	'<figure class="bg-center1"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
			}
			else
			{
			$show_simple_tab	.=	'<figure class="bg-center1">'.$widget_custom_title.'</figure>';
			}
		$show_simple_tab.= '<figure class="bg-right"></figure>';
	}
															$show_simple_tab.= '</div>
															
															    </div>
															   <div class="row">
															  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
															  <div class="row">';
				
	
								$widget_contents 	= array();
								$content_type 		= $content['content_type_id'];
													
								// Adding content Block starts here
								if($content['RenderingMode'] == "manual") {
									
								
								$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 		
														
								if (function_exists('array_column'))  {
									$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
								}else {
									$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
								}
								$get_content_ids = implode("," ,$get_content_ids);
								if($get_content_ids!='') {
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

								} else {
									//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);
									
									if($view_mode=="live"){
										$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
									}else{
										  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],  $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
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
								}

								if(count($widget_contents)>0)
								{
														//print_r($widget_contents);exit;
														//getting content block ends here
														//Widget code block - code required for simple tab structure creation. Do not delete
														//Widget code block Starts here
													
														// content list iteration block - Looping through content list and adding it the list
														// content list iteration block starts here
														$i =1;
														
														foreach($widget_contents as $get_content)
														{
															$custom_title        = "";
															$custom_summary      = "";
															$original_image_path = "";
															$imagealt            = "";
															$imagetitle          = "";
															$Image600X300        = "";

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
	$Image600X300 	= $original_image_path;
}
else
{				
	$Image600X300 	= str_replace("original","w600X300", $original_image_path);
}
if ($Image600X300 != '' && get_image_source($Image600X300, 1))
{
	$show_image = image_url. imagelibrary_image_path . $Image600X300;
}
else 
{
	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
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
	if( $custom_summary == '' && $content['RenderingMode'] == "auto")
	{
		$custom_summary =  $get_content['summary_html'];
	}
	$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
																// Assign summary block starts here
																
																// display title and summary block starts here
																
																if($i == 1) {
																	
																		 $show_simple_tab.= '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pad-right ">
																	  <article>
																		<figure><a  href="'.$live_article_url.'"   class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a></figure>
																		<figcaption class="lead-news temp-lead">
																		  <h4>'.$display_title.'</h4>';
																		  if($is_summary_required== 1 ){
																		  $show_simple_tab.= '<p>'.$summary.'</p>';
																		  }
																		$show_simple_tab.= '</figcaption>
																	  </article>
																	</div>';
																	
																} else 
																{
																	if($i==2)
																	{
																		 $show_simple_tab.= '<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
																							  <div class="row">';
																	}
																	if($i%2 == 0) {
																	
																		 
																	  $show_simple_tab.= '
																		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 temple-rel">
																		  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  temple">
																			<div class="arrow-right3"></div>
																			<p>'.$display_title.'</p>';
																			if($is_summary_required=='1'){
																			$show_simple_tab.= '<p>'.$summary.'</p>';
																			}
																		  $show_simple_tab.= '</div>
																		  <figure class="col-lg-6 col-md-6 col-sm-6 col-xs-12  move"><a  href="'.$live_article_url.'"   class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a></figure>
																		</div>';
																		/*
																		if(count($widget_contents) == 2) {
																			$show_simple_tab.= '  </div>
																								</div>';
																		}*/
																	
																} 
																 if($i%2 == 1) {
																	
																	$show_simple_tab.= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 temple-rel">
																	  <figure class="col-lg-6 col-md-6 col-sm-6 col-xs-12  move2"><a  href="'.$live_article_url.'"   class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a></figure>
																	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  temple">
																		<div class="arrow-left3"></div>
																		<p>'.$display_title.'</p>';
																		if($is_summary_required=='1'){
																		$show_simple_tab.= '<p>'.$summary.'</p>';
																		}
																	  $show_simple_tab.= '</div>';
																	  
																	  $string_value = "'',".$widgetsectionid.", 'section'";
																	 
																	$show_simple_tab.= '</div>';
																	
																}
																if($i==count($widget_contents))
																	{
																		$show_simple_tab.= '  </div>
																							  </div>';
																	}
															}
																
																// display title and summary block ends here					
																//Widget design code block 1 starts here																
															//Widget design code block 1 starts here			
															$i =$i+1;							  
														}
														 
														// content list iteration block ends here
														$show_simple_tab.= '</div>';
													}
													elseif($view_mode=="adminview")
													{
													 $show_simple_tab .='</div><div class="margin-bottom-10">'.no_articles.'</div>';
													}else
													{
														 $show_simple_tab .='</div>';
													}
													 if($content['widget_title_link'] == 1)
																	{
																		 $show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';										
																	}
													
													// Adding content Block ends here
													$show_simple_tab .='</div></div><div class="common-border"><span></span><span></span></div></div></div></div>';
echo $show_simple_tab;
?>
