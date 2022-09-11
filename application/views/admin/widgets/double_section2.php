<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];

$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab.=  '<div class="row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
									 
/*$show_simple_tab.=	'<h4 class="junction-link">தினமணி ஜங்ஷன்</h4>';*/
									 
$show_simple_tab.='<div class="junction-lead" '.$widget_bg_color .'>';

if($widget_custom_title!='')
{ 

   $show_simple_tab.='<div class="jun-center">';

	if($content['widget_title_link'] == 1)
	{
		
	$show_simple_tab.='<h4><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h4>';
	}
	else
	{
		
	$show_simple_tab.=	'<h4>'.$widget_custom_title.'</h4>';
	}
	
	$show_simple_tab.='<div class="arrow-down"></div>';
    $show_simple_tab.='</div>';	
}
										
                                       
if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode']); 						
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
			
		//print_r($widget_contents);exit;	
																
$i=1;
if(count($widget_contents)>0)
{
	//print_r($widget_contents);exit;
	
	foreach($widget_contents as $get_content)
	{
$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$custom_title        = "";
$custom_summary      = "";
$author_name         = ""; 
$Author_image_path   ="";
$image_id="";

if($view_mode == "adminview")
{	
      $Author_image_path="";
	  $image_id=$get_content['image_id'] ;
		if($image_id!='')
		{
		$author_details = $this->widget_model->get_image_by_contentid($image_id);
	    $Author_image_path  = $author_details['ImagePhysicalPath'];
        $Author_image_path; 
		$imagealt             = $author_details['ImageCaption'];	
		$imagetitle           = $author_details['ImageAlt'];
		}
		if($Author_image_path=="")
		{
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
		}
	}
else if($view_mode =="live")
{	
		$Author_image_path    =  $get_content['author_image_path'];
		$imagealt             = $get_content['author_image_alt'];	
		$imagetitle           = $get_content['author_image_title'];

if($Author_image_path=="")
		{
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
			
		}
		/*if( $Author_image_path =="")                                                // from cms || live table    
		{
		$original_image_path  = $get_content['ImagePhysicalPath'];
		$imagealt             = $get_content['ImageCaption'];	
		$imagetitle           = $get_content['ImageAlt'];	
		}*/
		//print_r($get_content);exit;
		//echo $imagealt;
}
$show_image="";
if($Author_image_path !='')
{
	
	$Image150X150  = str_replace("original","w150X150", $Author_image_path);

	if (get_image_source($Image150X150, 1) && $Image150X150 != '')
	{ 
	$show_image = image_url. imagelibrary_image_path . $Image150X150;
	}
	else
	{
	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
	}
	
}
else
{
	if($original_image_path !='')
	{
		$Image150X150  = str_replace("original","w150X150", $original_image_path);
		
		if (get_image_source($Image150X150, 1) && $Image150X150 != '')
		{
		$show_image = image_url. imagelibrary_image_path . $Image150X150;
		}
		else
		{
		$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
		}
		
	}
	else
	{
		$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
	}

}
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
			
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
			if( $custom_summary == '')
			{
			$custom_summary =  $get_content['summary_html'];
			}
			$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	
			//  summary block endss here
			if($view_mode == "adminview")
			{
				$author_id = $get_content['AuthorID']; 
				$author_name = $get_content['AuthorName'];				
			}
			else 
			{
				$author_name=$get_content['author_name'];
			}
			
			$section_name=$get_content['section_name'];
			$content_url = $get_content['url'];
			$url_array = explode('/', $content_url);
			$get_seperation_count = count($url_array)-4;
			
			$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
			//echo $section_name;
			
			
			if ($author_name == "")
			{
			$author_name=$get_content['section_name'];
			}
			//  Assign article links block ends hers
			
			if( $i==1 || $i%2==1)
				{
				
				$show_simple_tab.='<div class="clear_both">';
				}
			
			
			$show_simple_tab.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
			$show_simple_tab.='<a href="'.$sectionURL.'"><h1>'.$author_name.'</h1></a>';
			$show_simple_tab.='<a href="'.$sectionURL.'">
			<figure> <img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"> </figure> </a>
			<figcaption>';
			//$show_simple_tab.='<h1>'.$author_name.'</h1>';
			$show_simple_tab.='<a href="'.$sectionURL.'"><h1 class="junction-green">'.$section_name.'</h1></a>';
			$show_simple_tab.='<h4>'.$display_title.' </h4>';
			//echo $is_summary_required;
			if($is_summary_required== 1)
			{
			$show_simple_tab.='<p class="summary">'.$summary.'</p>';
			}
			
			$show_simple_tab.='</figcaption>';
			
			if($content['widget_title_link'] == 1)
			{	
			$show_simple_tab.='<div class="arrow-jun">
			<a href="'.$widget_section_url.'" class="landing-arrow"><span class="arrow-span"> </span>
			<div class="arrow-rightnew"></div>
			</a></div>';
			}
			$show_simple_tab.='</div>';
			if($i%2==0)
			{
			$show_simple_tab.='<div class="border-right"></div>';
			}
			if($i%2==0)
				{
				$show_simple_tab.='</div>';
				}
			if($i==count($widget_contents))
			{
				if(  $i==1 || $i%2==1)
				{
				
				$show_simple_tab.='</div>';
				}
			}
			
			$i =$i+1;
		
		}
    }
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10"  '.$widget_bg_color.'>'.no_articles.'</div>';
}
echo $show_simple_tab.='</div> </div>
</div>';
?>