<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title    = $content['widget_title'];
$widget_instance_id     =  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$widget_section_url     = $content['widget_section_url'];
$is_home                = $content['is_home_page'];
$is_summary_required    = 'y';
$view_mode              = $content['mode'];
$domain_name            =  base_url();

$show_simple_tab        = "";
$show_simple_tab.='<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
										
		//getting content block - getting content list based on rendering mode
		//getting content block starts here . Do not change anything
		
		$content_type 		= $content['content_type_id'];  // auto article content type
		$widget_contents 	= array();
		if($content['RenderingMode'] == "manual")
		{
		
			$widget_instance_contents = $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " ", $content['mode'],$content['show_max_article']); 	

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
			
		} else {
		
		//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);
		
				if($view_mode=="live"){
						$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$content['sectionID']  , $content_type ,  $content['mode'], $is_home);
				}else{
					  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
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
		//echo $get_section['WidgetInstance_id'].'--'.$get_section['WidgetInstanceMainSection_id'].'--'.$content['mode'];
		//die();
	//	echo '<pre>'; print_r($widget_instance_contents); die();
		$j = 1; 
		$count = 1;
	
			//print_r($widget_contents);exit;
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
			$Image600X300        = "";
			$custom_image_active = '';
			$image_width         = "";	
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
				$custom_image_active = 1;			
			}
			if($original_image_path =="") // from cms || Live table    
			{
				$original_image_path  = $get_content['ImagePhysicalPath'];
				$imagealt             = $get_content['ImageCaption'];	
				$imagetitle           = $get_content['ImageAlt'];	
			}

			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';	
			if($original_image_path !='')
			{
				if($custom_image_active == 1)
				{
					if (get_image_source($original_image_path, 1) )
					{
						$image_size = get_image_source($original_image_path, 2);
						$image_width = $image_size[0];																	
						$show_image = image_url.imagelibrary_image_path. $original_image_path;
					}
				}
				else
				{
					if (get_image_source($original_image_path, 1) )
					{
						$image_size = get_image_source($original_image_path, 2);
						$image_width = $image_size[0];																	
						$show_image = image_url. imagelibrary_image_path . $original_image_path;																	
					}
				}	
			}
				
				// Code block C ends here
				
				// Assign block - assigning values required for opening the article in light box
				// Assign block starts here
			$content_url = $get_content['url'];
			$param = $content['close_param']; //page parameter
			$live_article_url = $domain_name. $content_url.$param;		
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;	
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);   //to remove first<p> and last</p>  tag
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';		

				
				if($j < 3) 
				{	
				
				$div_class = ($image_width < 200 ) ? (($j == 1) ? "col-lg-4 col-md-4 col-sm-4 col-xs-12 cartoon-small " : "" ) : "col-lg-8 col-md-8 col-sm-8 col-xs-12";
				
					if($j == 1)
					{																
						$show_simple_tab.='<div class="sports-sec">
						<div class="row">																	
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  margin-top">
						<fiugre class="bg-left"></fiugre>';
						if($content['widget_title_link'] == 1)
						{	
					$show_simple_tab.=	'<figure class="bg-center1"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></figure>';
						}
						else
						{
							$show_simple_tab.=	'<figure class="bg-center1">'.$widget_custom_title.'</figure>';
						}
						$show_simple_tab.=	'<fiugre class="bg-right"></fiugre>
						</div>';																	
						$show_simple_tab.='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
						<div class="sports-lead cartoon-section">';		
						
						/*if($image_width < 200)
						{
							$show_simple_tab.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 cartoon-small ">';
							$show_simple_tab.='<figure><img src="'.$show_image.'" /></figure>';
							$show_simple_tab.='<figcaption><h4>'.$display_title.'</h4></figcaption>';
							$show_simple_tab.='</div>';		
						}
						else{
							$show_simple_tab.='<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
							$show_simple_tab.='<figure><img src="'.$big_image.'" /></figure>';
							$show_simple_tab.='<figcaption><h4>'.$display_title.'</h4></figcaption>';
							$show_simple_tab.='</div>';
						}*/
																		
					}
				//	else{
						if($j == 1)
						{
							$show_simple_tab.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 cartoon-small ">';
							$show_simple_tab.='<figure><img src="'.$show_image.'" /></figure>';
							$show_simple_tab.='<figcaption><h4>'.$display_title.'</h4></figcaption>';
							$show_simple_tab.='</div>';		
						}
						else{
							$show_simple_tab.='<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">';
							$show_simple_tab.='<figure><img src="'.$show_image.'" /></figure>';
							$show_simple_tab.='<figcaption><h4>'.$display_title.'</h4></figcaption>';
							$show_simple_tab.='</div>';
						}
						
					//}
					if($j == count ($widget_contents))
					{
						$show_simple_tab.='</div></div></div></div>';
					}
				
				}
				else
				{
					if($j == 3){
						$show_simple_tab.='</div></div></div></div>';
						$show_simple_tab.='<div class="margin-bottom-10">';
					}
				
					$show_simple_tab.='<div class="sports-thum">';
					$show_simple_tab.='<figure class="sports-thum-img"><img src="'.$show_image.'" /></figure>';
					$show_simple_tab.='<figcaption class="sports-thum-des">'.$display_title.'</figcaption>';
					$show_simple_tab.='</div>';
					
					if($j == count ($widget_contents))
					{
						$show_simple_tab.='</div>';
					}
				
				}
				
				$j++;

			}
			//}
		}
														

$show_simple_tab.='</div></div>';
echo $show_simple_tab;
?>