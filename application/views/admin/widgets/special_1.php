<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color         = $content['widget_bg_color'];
$widget_custom_title     = $content['widget_title'];
$widget_instance_id      =  $content['widget_values']['data-widgetinstanceid'];
$widget_section_url      = $content['widget_section_url'];
$is_home                 = $content['is_home_page'];
$main_sction_id 	     = "";
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$domain_name             =  base_url();
 $view_mode               = $content['mode'];
//echo $content['sectionID'];
$show_simple_tab         = "";
// widget config block ends

//getting tab list for hte widget
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="boder-bot" '.$widget_bg_color.'>      
<div class="row" >
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  lead-stories" id="feature">';


$show_simple_tab .='<div class="row"> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border ">';
if($widget_custom_title!='')
{
$show_simple_tab .= '<figure class="bg-left"></figure>';
	if($content['widget_title_link'] == 1)
	{	
		$show_simple_tab.=	'<figure class="bg-center1"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
	}
	else
	{
		$show_simple_tab.=	'<figure class="bg-center1">'.$widget_custom_title.'</figure>';
	}
$show_simple_tab.= '<figure class="bg-right"></figure>';
}

$show_simple_tab.= '</div></div>';


//getting content block starts here .
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
  $widget_contents = array();
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
$show_simple_tab.='<div class="HomeLeadStories slide">';

			  /********************* content list iteration block - Looping through content list and adding it the list ********************/
// content list iteration block starts here

   $i =1;
	if(count($widget_contents)>0)
	{
		foreach($widget_contents as $get_content)
		{		
			$custom_title        = "";
			$custom_summary      = "";
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$Image600X390        = "";
			if($content['RenderingMode'] == "manual")// from widgetinstancecontent table    
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
			if($original_image_path =="") // from cms || Live table    
			{
				$original_image_path  = $get_content['ImagePhysicalPath'];
				$imagealt             = $get_content['ImageCaption'];	
				$imagetitle           = $get_content['ImageAlt'];	
			}
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				if($i==1){
				if($original_image_path !='' && get_image_source($original_image_path, 1))
				{
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
					if ($imageheight > $imagewidth)
					{
						$Image600X390 	= $original_image_path;
						$is_vertical    = true;
					}
					else
					{				
						$Image600X390 	= str_replace("original","w600X390", $original_image_path);
					}
					if (get_image_source($Image600X390, 1) && $Image600X390 != '')
					{
						$show_image = image_url. imagelibrary_image_path . $Image600X390;
					}
				}
				}else{
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_100X65.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_100X65.jpg';
				if($original_image_path !='' && get_image_source($original_image_path, 1))
				{
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];				
						$Image100X65 	= str_replace("original","w100X65", $original_image_path);
					if (get_image_source($Image100X65,1) && $Image100X65 != '')
					{
						$show_image = image_url. imagelibrary_image_path . $Image100X65;
					}
				}
				}	
				
			
			/******************** article title and summary and url ********************/
			$content_url = $get_content['url'];
			$param = $content['close_param']; //page parameter
			$live_article_url = $domain_name. $content_url.$param;		
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;	
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);   //to remove first<p> and last</p>  tag
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
			
			if( $custom_summary == '' && $content['RenderingMode'] == "auto")
				{
					$custom_summary =  $get_content['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
			
			/******************** article title and summary and url ********************/
					
			// display title and summary block starts here			
			/* if($i <=1)
			{
				$add_active =($i==1) ? 'active' : '';	
				if($i==1){
					$show_simple_tab .=' <div class="slide home-lead maim-lead">';
				}
				$show_simple_tab .='<div><article><figure>';
				$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click"><img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
				$show_simple_tab .='</a></figure>';
				$show_simple_tab .='<figcaption class="lead-news home-title">';
				$show_simple_tab .='<h4>'.$display_title.'</h4>';	
				
				if($is_summary_required == 1)
					$show_simple_tab .= '<p>'.$summary.'</p>';
			
				$show_simple_tab .= '</figcaption></article></div>';
				if( $i == 1 || $i == count($widget_contents)){
					$show_simple_tab .='</div></div></div>';
				}
			} */
		//	else
		//	{
				if($i == 1)
				{
					$show_simple_tab .='</div></div>';
					$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 first-top pad-left cinema-list" style="padding-right:15px !important;padding-left:15px !important;"><ul class="lead-list">';
				}
				$show_simple_tab .='<li><a href="'.$live_article_url.'" class="article_click" >';
				$show_simple_tab .='<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
				$show_simple_tab .='<p style="margin-left:73px!important;">'.$display_title.'</p>';
				$show_simple_tab .='</li>'; 
				if($i == count($widget_contents))
				{
					$show_simple_tab .='</ul></div>';				
				}			
			//} 
			if($i == count($widget_contents))
			{
				    $show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
					if($content['widget_title_link'] == 1)
					{
					$show_simple_tab.='<div class="arrow">
					<a href="'.$widget_section_url.'" class="landing-arrow"> <span class="arrow-span"> </span>
					<div class="arrow-rightnew"></div>
					</a></div>';
					}
					$show_simple_tab .='</div>';
				
				$show_simple_tab .='</div>';
								
			}
				
			$i =$i+1;							  
		} // content list iteration block ends here
	}
else
{
			if($view_mode=="adminview")
			{
			$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
			$show_simple_tab .='</div>';
			
			$show_simple_tab .='</div>';
			
			$show_simple_tab .='</div>';
			}
			if($view_mode!="adminview")
			{
			$show_simple_tab .='</div>';
			$show_simple_tab .='</div>';
			$show_simple_tab .='</div>';
			}
}
// Adding content Block ends here
/*if($content['widget_title_link'] == 1)
{
$show_simple_tab.='<div class="arrow">
<a href="'.$widget_section_url.'" class="landing-arrow"> <span class="arrow-span"> </span>
<div class="arrow-rightnew"></div>
</a></div>';
}*/
$show_simple_tab .='<div class="common-border"><span></span><span></span></div></div></div></div>';
echo $show_simple_tab;
?>
<script>
$('.home-lead').slick({
dots: true,
infinite: true,
speed: 500,
slidesToShow: 1,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 4000,
arrows: false
});
</script>