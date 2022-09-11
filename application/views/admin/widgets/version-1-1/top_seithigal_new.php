<?php 
/*
Finame 		: 	top_seithigal
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
$showDate = false;
$temp  = trim(str_replace(["style='background-color:" , ";'"],['',''],$widget_bg_color));
$temp = ($temp!='') ? (int) $temp : '';
if($temp==1){
	$showDate = true;
}
$show_simple_tab = "";
$show_simple_tab.='<div class="row">
          <div class="top-news-sec-custom">
		  <div '.$widget_bg_color.'>
          <div class="top-news top-news-sec boder-bottom ">';
		  
		  
/*$show_simple_tab.='	  <div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  margin-top">';

if($widget_custom_title!='')
{
	$show_simple_tab.='	<figure class="bg-left"></figure>';
		if($content['widget_title_link'] == 1)
		{
		$show_simple_tab.=	'<figure class="bg-center1"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
		}
		else
		{
		$show_simple_tab	.=	'<figure class="bg-center1">'.$widget_custom_title.'</figure>';
		}
	$show_simple_tab.=' <figure class="bg-right"></fiugre>';
}
$show_simple_tab.='	</div></div>';*/
$show_simple_tab.='<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lead-stories">
   <div class="LeadStories cinema-widget" >';
   
$content_type 		= $content['content_type_id'];
$widget_contents 	= array();

if($content['RenderingMode'] == "manual")
{

$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 		


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
			  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
		
			if (function_exists('array_column')) {
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			} else{
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
														$i =1;
														$count = 1;
														$currentDate = date('Y-m-d H:i:s');
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
	$dummy	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
	if ($original_image_path!='' && get_image_source($original_image_path, 1))
	{ 
		$imagedetails = get_image_source($original_image_path, 2);
		$imagewidth = $imagedetails[0];
		$imageheight = $imagedetails[1];	

		if ($imageheight > $imagewidth){
			$Image600X300 	= $original_image_path;
		}else{			
			$Image600X300 	= str_replace("original","w600X390", $original_image_path);
		}
		if (get_image_source($Image600X300, 1) && $Image600X300 != ''){
			$show_image = image_url. imagelibrary_image_path . $Image600X300;
			$dummy	 = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		}else{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		} 
	}else {
		$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
	} 	
																
	$content_url = $get_content['url']; 
	$dateTime = time_elapsed_string($get_content['last_updated_on']);
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
	//echo  mb_substr($summary,0,255,"utf-8");
	$summary=(mb_strlen($summary) <=80)? $summary : mb_substr($summary,0,80,"utf-8")."...";// 80 = desired char count
	
																			
																//  Assign article links block ends hers
																$play_gallery_image = image_url. imagelibrary_image_path.'gallery-icon.png';
																if($i==1)
																{
																$show_simple_tab 	   .=	'<div id="feature">
																						<div class="slide cinema-lead'.$widget_instance_id.'">';
																}
																if($showDate){
																	$show_simple_tab.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-10">
																	<article>
																	<a href="'.$live_article_url.'"><figure><img class="top_seithigal_image" src="'.$dummy.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"><span><i class="fa fa-clock-o" aria-hidden="true"></i> '.$dateTime.'</span></figure></a>
																	<figcaption class="lead-news-custom-widget">
																	<h4>'.$display_title.'</a></h4>';
																}else{
																	$show_simple_tab.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-10">
																	<article>
																	<a href="'.$live_article_url.'"><figure><img class="top_seithigal_image" src="'.$dummy.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure></a>
																	<figcaption class="lead-news-custom-widget">
																	<h4>'.$display_title.'</a></h4>';
																}
																
																if($is_summary_required== 1)
																$show_simple_tab.='<p class="summary">'.$summary.'</p>';
																
																$show_simple_tab.='</figcaption>
																</article>
																</div>';
																if($count==3 )
																{
															 
																	$show_simple_tab.=  '</div>';
																	//$show_simple_tab .='</div>';
																	
																	$count=0;
														
																} 
															if($i == count($widget_contents))
															{
																if($i%3!=0)
																{
																//$show_simple_tab.=  '</div>';
																$show_simple_tab .='</div>';
																} 
															$show_simple_tab .='</div>';
															}
														$count ++;	
			
														
														//if($i==)
														// display title and summary block ends here					
														//Widget design code block 1 starts here																
														//Widget design code block 1 starts here			
														$i =$i+1;							  
														} // For Get Content Start Here 	
													// content list iteration block ends here
													  //}
												  }
												 elseif($view_mode=="adminview")
												{
												$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
												}
																												
													
												echo $show_simple_tab.='	
																	</div>
																	</div>
																	</div>
																	</div>
																	</div>
																	</div>
																	</div>';
													

?>



