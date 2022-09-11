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
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name            =  base_url();
$show_simple_tab        = "";
$show_simple_tab       .='  <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="main-gall">
							<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >';
			  

$show_simple_tab.='<div class="gal-sub-sec margin-top">';

$show_simple_tab.='<figure class="bg-left"></figure>';
$show_simple_tab.= 	'<figure class="bg-center1">சமீபத்திய புகைப்படங்கள்</figure>';		
$show_simple_tab.=' <figure class="bg-right"></figure>';
	
$show_simple_tab.='</div>';

if($widget_custom_title!='')
	{
		if($content['widget_title_link'] == 1)
		{
		$show_simple_tab.='<h4><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h4>';
		}
		else
		{
		$show_simple_tab.=	'<h4>'.$widget_custom_title.'</h4>';
		}
	}
					
					                                     // $show_simple_tab.='  <h4> '.$section.'</h4>';
			   
			    	
														//getting content block - getting content list based on rendering mode
														//getting content block starts here . Do not change anything
$content_type = $content['content_type_id'];
$widget_contents = array();

if($content['RenderingMode'] == "manual")
{

$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode);

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

//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'], $content_type ,  $view_mode);		

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


$i=1;
$count = 1;

if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
        $custom_title        = "";
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$Image600X390        = "";
		$custom_title        = "";
		$custom_summary      ="";
		if($content['RenderingMode'] == "manual")
		{
			if($get_content['custom_image_path'] != '')
			{
			$original_image_path = $get_content['custom_image_path'];
			$imagealt            = $get_content['custom_image_title'];	
			$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title        = stripslashes($get_content['CustomTitle']);
		}	
		if($view_mode == "live")
		{
			if($original_image_path =='')
			{
			$original_image_path = $get_content['first_image_path'];
			$imagealt            = $get_content['first_image_alt'];	
			$imagetitle          = $get_content['first_image_title'];
			}
		}
		else
		{
			if($original_image_path =="")                         // from cms imagemaster table    
			{
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt             = $get_content['ImageCaption'];	
			$imagetitle           = $get_content['ImageAlt'];	
			}
		}
		$show_image="";
		if ($original_image_path!='' && get_image_source($original_image_path, 1))
			{
			$imagedetails = get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];	
			
				if ($imageheight > $imagewidth)
				{
				$Image600X390 	= $original_image_path;
				}
				else
				{				
				$Image600X390 	= str_replace("original","w600X390", $original_image_path);
				}
				
				$show_image = image_url. imagelibrary_image_path . $Image600X390;
			}	
			else 
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			
		$content_url = $get_content['url'];
		$param = $content['close_param']; //page parameter
		$live_article_url = $domain_name. $content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = stripslashes($get_content['title']);
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		//  Assign article links block ends hers
		// Assign summary block starts here
		if( $custom_summary == '')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
		// Assign summary block starts here
		$play_gallery_image = image_url. imagelibrary_image_path.'gallery-icon.png';
																
																
		if($i==1)
		{
			$show_simple_tab.=' <div class="row">
			<div class="clear_both">';
		}
		if($i==1)
		{
			 
		$show_simple_tab.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                    <div class="gal-sub-list">
							
		<a href="'.$live_article_url.'" class="article_click" >
		<figure class="gal-sub-img">
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
		<div class="play-icon gallery-play-icon"> </div>
		</figure></a>';
		$show_simple_tab.='<figcaption class="gal-sub-des">'.$display_title .'</figcaption>';
		
		
		$show_simple_tab.= '</div>
		</div>';

		}
		if($i==2)
		{
		$show_simple_tab.=' <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="gal-sub-list gal-sub-list-1">
		<a href="'.$live_article_url.'" class="article_click" >
		<figure class="gal-sub-img gal-sub-img-1">
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
		<div class="play-icon gallery-play-icon"></div>
		</figure></a>
		<figcaption class="gal-sub-des gal-sub-des-1">'.$display_title .'</figcaption>
		
		';
		
		$show_simple_tab.='</div></div>';
		
		$show_simple_tab.= '</div>
		                    </div> ';
		
		}
		if($i%3==0)
		{
			$count=1;
		}
		if($i>2)
		{
			if($i==3){$show_simple_tab.='<div class="clear_both  boder-bottom">';};	
		if($count===1)
		{
		//$show_simple_tab.='<div class="clear_both boder-bottom">';
		$show_simple_tab.='<div class="gallery-sub-list ">';
		}
		
		
		$show_simple_tab.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="gal-sub-list gal-sub-list-1">
		<a href="'.$live_article_url.'" class="article_click" >
		<figure class="gal-sub-img gal-sub-img-1">
		<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
		<div class="play-icon gallery-play-icon"></div>
		</figure></a>
		<figcaption class="gal-sub-des gal-sub-des-1">'.$display_title.'</figcaption>';
		
		$show_simple_tab.=' </div>';
		$show_simple_tab.='</div>';
		
		
		if($count%3===0)
		{
			$show_simple_tab.=' </div>';
			$count=1;
			
		}
		
		if($i==count($widget_contents))
		{
			if( $i%3==0 || $i%3==1){$show_simple_tab.=' </div>';}
		if($content['widget_title_link'] == 1)
        {
		$show_simple_tab.='<div class="arrow">
				<a href="'.$widget_section_url.'" class="landing-arrow">  
				<span class="arrow-span"> </span>
				<div class="arrow-rightnew"></div>
				</a></div>';	 
		}
		$show_simple_tab.=' </div>';
		
		}
		
		
		
		}
		if($i>2)
		{
		$count=$count+1;	
		}
		
		if($i==count($widget_contents))
		{
			if($i==1)
			{$show_simple_tab.= '</div> </div> ';}
		}
		$i =$i+1;	
		
		
     }
 //  }
 }
elseif($view_mode=="adminview") 
{
$show_simple_tab .='<div class="margin-bottom-10" style="width:100%" '.$widget_bg_color.'>'.no_articles.'</div>';
}
													 																
				
echo $show_simple_tab.='
						</div>
						</div>
						</div>
						</div>
						</div>';
?>
