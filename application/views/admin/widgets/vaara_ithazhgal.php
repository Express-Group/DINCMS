<?php 
/*
Finame 		: 	cinema_seithigal
Created On 	: 	26-4-2016
Purpose for	:	Display the cinema_seithigal widget
*/

$widget_bg_color        = $content['widget_bg_color']; 
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required 	= $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();

$show_simple_tab = "";
$show_simple_tab .='<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
		  <div id="features">
            <div class="lead-stories side-gap week-story" '.$widget_bg_color.'>';
													if($content['widget_title_link'] == 1)
													{
													$show_simple_tab.=	'<figure class="box-botton week-button"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
													}
													else
													{
														$show_simple_tab	.=	'<figure class="box-botton week-button">'.$widget_custom_title.'</figure>';
													}
													
													
													$show_simple_tab.= '  <div class="box-one week-box">';
													
$content_type 		= $content['content_type_id'];
$widget_contents 	= array();
													
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
		
}
else
{

//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);

	if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
	}else{
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],  $content['sectionID'], $content_type ,  $content['mode'], $is_home);
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
													
														$i =1; 

														foreach($widget_contents as $get_content)
														{
															$custom_title        = "";
															$custom_summary      = "";
															$original_image_path = "";
															$original_image_path1 = "";
															$imagealt            = "";
															$imagetitle          = "";
															$imagealt1 			 = "";
															$imagetitle1		 = "";
															$Image600X300        = "";

															//$content_type = @$get_content['content_type_id'];
															//$content_details = $this->widget_model->get_contentdetails_from_live_database($get_content['content_id'], $content_type,$is_home);	
												
if($content['RenderingMode'] == "manual")            // from widgetinstancecontent table    
{
	if($get_content['custom_image_path'] != '')
	{
		/*$original_image_path = $get_content['custom_image_path'];
		$imagealt            = $get_content['custom_image_title'];	
		$imagetitle          = $get_content['custom_image_alt'];		
		*/
		$original_image_path1 	= $get_content['custom_image_path'];
		$imagealt1 				= $get_content['custom_image_title'];	
		$imagetitle1			= $get_content['custom_image_alt'];											
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

$show_image1 = '';

//if ($imageheight > $imagewidth)
if (false)
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
}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}	

// For original_image_path1 //
if($original_image_path1 !='')
{
	if (get_image_source($original_image_path1, 1) )
	{																
		$show_image1 	= image_url.imagelibrary_image_path. $original_image_path1;																		
	}
	else 
	{
		$show_image1	= image_url. imagelibrary_image_path.'logo/custom120x180.jpg' ;
	}
	$dummy_image1		= image_url. imagelibrary_image_path.'logo/custom120x180.jpg';
	
}
else 
{ 
	$show_image1	= image_url. imagelibrary_image_path.'logo/custom120x180.jpg' ;
	$dummy_image1	=image_url. imagelibrary_image_path.'logo/custom120x180.jpg'; 
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
		$custom_summary =  $get_content['summary_html'];
	
	$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
	
																// Assign summary block starts here
																
																// display title and summary block starts here
																//print_r($from_contents_table[0]);exit;
																$add_active =($i==1) ? 'active' : '';	
																if($i==1){
																$show_simple_tab .='<div class="slider Week-Autoplay">';
                                                                }
																$show_simple_tab .='<div '.$add_active.'">
                                                           <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12   week">
														   <a href="'.$live_article_url.'" class="article_click"> <figure class="ithal-date">';
														   	$last_publish = @$get_content['last_updated_on'];
															$publish_date =date('d-m-Y', strtotime($last_publish));
															$custom_imagealt = '';
															$custom_imagetitle= '';															
															
														   $show_simple_tab .='<img src="'.$dummy_image1.'" data-lazy="'.$show_image1.'" title = "'.$imagetitle1.'" alt = "'.$imagealt1.'" />
														   <time>'.$publish_date.'</time> 
															  </figure></a>
															</div>
														  <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12   week1">'; 
																	
																		$show_simple_tab .='<h5>'.$display_title.'</h5>';
																		
																		$show_simple_tab .=' <a href="'.$live_article_url.'" class="article_click"><figure><img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" /> </figure></a>';
																		
																		 if($is_summary_required== 1)
																		 $show_simple_tab .= '<p>'.$summary.'</p>';
																		
																		 $show_simple_tab .= '</div>
                                                                                             </div>';
																
																// display title and summary block ends here					
																//Widget design code block 1 starts here																
															//Widget design code block 1 starts here			
															$i =$i+1;							  
														}
														 
														// content list iteration block ends here
														$show_simple_tab .= '</div>';
													}
													elseif($view_mode=="adminview")
													{
													 $show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
													}else
													{
														 //$show_simple_tab .='</div>';
													}
													
													if($content['widget_title_link'] == 1 && count($widget_contents)>0 )
												  	{
															// $show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';									
													}
													// Adding content Block ends here
													$show_simple_tab .='
																</div>
															</div>
														</div>
													</div></div>';
echo $show_simple_tab;
?>
