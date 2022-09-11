<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = $content['page_param'];
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$section_widgetID    = $content['widget_values']['data-widgetid'];  // current widget id
$content_type        = $content['content_type_id'];  // auto article content type
$widget_section_url  = $content['widget_section_url'];

//$section_details = $this->widget_model->get_section_by_id($main_sction_id);
//print_r($section_details);exit;
// widget config block ends
//getting tab list for hte widget
if($content['RenderingMode'] == "manual")
{
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " ", $view_mode); 		
}
else
{
	$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type, $view_mode);	
	/*$page_section_id     = $content['page_param']; //page sectionid
	$sectionname         = $this->widget_model->get_section_by_id($page_section_id);
	if($sectionname['ParentSectionID'] == 0 || $sectionname['ParentSectionID'] == "NULL")  
	{
		$content_type = $content['content_type_id'];  // auto article content type
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $main_sction_id , $content_type, $view_mode);	
	}
	else // condition for lead stories widget in sub section page - auto mode
	{
		$widget_instance_contents = array();
		$get_widget_instance      =  $this->widget_model->getWidgetInstance('', '','', '', $widget_instance_id, $view_mode);
		$page_section_id          = $get_widget_instance['Pagesection_id'];
		$section_widgetID = $this->widget_model->get_widget_byname('Section Lead Stories', $view_mode);
		$section_leadstory        = $this->widget_model->get_sub_sec_lead_stories_data($sectionname['ParentSectionID'], $get_widget_instance['Page_type'], $get_widget_instance['WidgetDisplayOrder'], $section_widgetID['widgetId'] , $page_section_id, $get_widget_instance['Page_version_id'], $view_mode)->row_array();
		
		if(count($section_leadstory)>0)
		{
			$sec_leadstory_max_article    = $section_leadstory ['Maximum_Articles'];
			$sec_leadstory_remdering_mode = $section_leadstory ['RenderingMode'];
			$sec_leadstory_instanceID     = $section_leadstory ['WidgetInstance_id'];
			$sec_leadstory_sectionID      = $section_leadstory ['WidgetSection_ID'];
			
			if($sec_leadstory_remdering_mode == "manual")
			{			
				$widget_instance_contents = $this->widget_model->get_widgetInstancearticles_rendering($sec_leadstory_instanceID, '',$view_mode);
			}
			elseif($sec_leadstory_remdering_mode == "auto")
			{
				if($page_section_id  == $sec_leadstory_sectionID)
				{
					$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($sec_leadstory_max_article, $sec_leadstory_sectionID , $content_type, $view_mode);
				}
				else
				{
					$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($sec_leadstory_max_article, $page_section_id , $content_type, $view_mode);				
				}
			}
			//echo $this->db->last_query();
			//echo '<pre>'; print_r($widget_instance_contents); die();
		}
		if(count($widget_instance_contents)==0)
		{
			$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $main_sction_id, $content_type, $view_mode);
		}
	}*/
}
//echo '<pre>'; print_r($widget_instance_contents); die();	
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="sub-section-list" '.$widget_bg_color.'>';

/*if($content['widget_title_link'] == 1)
{
	$show_simple_tab.=	' <legend class="topic"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></legend>';
}
else
{
	$show_simple_tab.=	' <legend class="topic">'.$widget_custom_title.'</legend>';
}*/

$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
$get_content_ids = implode("," ,$get_content_ids);
	//echo '<pre>'; echo $get_content_ids; die();	
if($get_content_ids!='')
{
	$content_type = $content['content_type_id'];
	$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
	$widget_contents = array();
	//echo '<pre>'; print_r($widget_instance_contents1); die();	
	foreach ($widget_instance_contents as $key => $value) {
		foreach ($widget_instance_contents1 as $key1 => $value1) {
			if($value['content_id']==$value1['content_id']){
				$widget_contents[] = array_merge($value, $value1);
			}
		}
	}
	//echo 'hhhh';exit;
				// content list iteration block - Looping through content list and adding it the list
				// content list iteration block starts here
				$i =1;
				foreach($widget_contents as $get_content)
				{
					/*if($content['RenderingMode'] == "manual"):
					$content_type = $get_content['content_type_id']; 
					else:
					$content_type = $content['content_type_id'];  
					endif;*/
					
					//$content_details = $this->widget_model->get_contentdetails_from_database($get_content['content_id'], $content_type, $is_home, $view_mode);	
					//echo '<pre>'; print_r($content_details);																	
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
					}
					if($original_image_path =="")                                                // from cms imagemaster table    
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
						$lastpublishedon = $get_content['last_updated_on'];
						$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
						$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
					//  Assign article links block ends hers
					
						$time = '';															
						/*if($i == 1) {
						
						$show_simple_tab.=	' <div class="city_lead1"> <a   href="'.$live_article_url.'"  class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a><h4 class="subtopic">'.$display_title.'</h4>
						</div>';
					  
						} else {
							if($i == 2) 
								$show_simple_tab.=	'<div class="city_lead2 common_p">';
							
							$show_simple_tab.=	'<p> <i class="fa fa-angle-right"></i> '.$display_title.'</p>';
							$time = $lastpublishedon; 
							$post_time= $this->widget_model->time2string($time); 
							$show_simple_tab.=	'<p class="post_time br_bottom">'.$post_time.' ago</p>';
							
							 
							 if($i == count($widget_contents))
								$show_simple_tab.=	'</div>'; 
						}*/
						if($i == 1) {
																
							$show_simple_tab.=	'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><article> 
							<a   href="'.$live_article_url.'"  class="article_click" ><figure><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure></a>
							<figcaption class="lead-news"><h4 class="subtopic">'.$display_title.'</h4></figcaption></article></div>';
						  
							} else {
								if($i == 2) 
									$show_simple_tab.=	'<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 first-top "><ul class="lead-list">';
								
								 $show_simple_tab.=	'<li><div><i class="fa fa-angle-right"></i></div><p>'.$display_title.'</p>';
								$show_simple_tab.=	'</li>';
								
								 
								 if($i == count($widget_contents))
									$show_simple_tab.=	'</ul></div>'; 
							}
						
						// display title and summary block ends here					
						//Widget design code block 1 starts here																
					//Widget design code block 1 starts here			
					$i =$i+1;							  
				}
				
				// content list iteration block ends here
		}
		 elseif($view_mode=="adminview")
		{
			$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
		}
/*if($content['widget_title_link'] == 1)
{
$show_simple_tab.='<div class="arrow">
<a href="'.$widget_section_url.'" class="landing-arrow"> <span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';
}
*/			$show_simple_tab .='</div>
          </div>
          </div>';
																			  
												
																			  
echo $show_simple_tab;
?>
