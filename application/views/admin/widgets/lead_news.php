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
$max_article             = $content['show_max_article'];
$render_mode             = $content['RenderingMode'];
//$start_time = microtime(true);
/************* Widget HTML Starts here ***********************/
$show_simple_tab .='<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
          
            $show_simple_tab .=' <div class="row">
           
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border ">';
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

if($content['RenderingMode'] == "manual")
{
	$content_type = $content['content_type_id'];  // auto article content type
	$widget_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']);
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
              $show_simple_tab.='<div class="slide home-lead maim-lead new-main-lead">';
			  $i =1;
	if(count($widget_contents)>0)
	{
		//print_r($widget_contents);exit;
		foreach($widget_contents as $get_content)
		{
			if($render_mode == "manual"){
			$content_type = $get_content['content_type_id'];  // from widgetinstancecontent table
			$content_details = $this->widget_model->get_contentdetails_from_database($get_content['content_id'], $content_type, $is_home, $view_mode);
			}else{
			 $content_type = $content['content_type_id'];  // from xml
			}
			$custom_title        = "";
			$custom_summary      = "";
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$Image600X390        = "";
			if($render_mode == "manual")            // from widgetinstancecontent table    
			{
				if($get_content['custom_image_path'] != '')
				{
					$original_image_path = $get_content['custom_image_path'];
					$imagealt            = $get_content['custom_image_title'];	
					$imagetitle          = $get_content['custom_image_alt'];												
				}
					$custom_title        = stripslashes($get_content['CustomTitle']);
					$custom_summary      = $get_content['CustomSummary'];
					$content_url         = $content_details[0]['url'];

			}
			else
				{
				    $content_url    = $get_content['url'];
					$custom_title   = $get_content['title'];
					$custom_summary = $get_content['summary_html'];
				}
			if($original_image_path =="" && $render_mode =="manual")     // from cms || Live table    
				{
					   $original_image_path  = $content_details[0]['ImagePhysicalPath'];
					   $imagealt             = $content_details[0]['ImageCaption'];	
					   $imagetitle           = $content_details[0]['ImageAlt'];	
				}	
			else if($original_image_path =="" && $render_mode =="auto")                 // from cms || Live table    
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
				$Image600X390 	= $original_image_path;
			}
			else
			{				
				$Image600X390 	= str_replace("original","w600X390", $original_image_path);
			}
			if ($Image600X390 != '' && get_image_source($Image600X390, 1))
			{
				$show_image = image_url. imagelibrary_image_path . $Image600X390;
			}
			else 
			{
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
		}	
		else 
		{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		}	
				
				                               /******************** article title and summary and url ********************/
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
			
				if( $custom_title == '' && $render_mode=="manual" )
					{
						$custom_title = $content_details[0]['title'];
					}	
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
								
				if( $custom_summary == '' && $render_mode=="manual")
				{
					$custom_summary =  $content_details[0]['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
				$add_active =($i==1) ? 'active' : '';	
				$img_icon = ((($content_type==3) ? '<span class="play-icon gallery-play-icon lead-img-icon"></span>': (($content_type==4)? '<span class="play-icon lead-play-icon"></span>' : (($content_type==5)? '<span class="play-icon audio-play-icon "></span>' : ''))));	
                $show_simple_tab .='<div>
                  <article>
                    <figure>'.$img_icon.'<img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" /></figure>';
                    
                   
                      $show_simple_tab .='<figcaption class="lead-news">
                        <h4><a href="'.$live_article_url.'" class="article_click">'.$display_title.' </a></h4>';
                        $show_simple_tab .='<p>'.$summary.' </p>
                      </figcaption>
                   
                  </article>';
				  if($content['RenderingMode'] == "manual")
				{
					$get_related_article 	= $this->widget_model->get_widgetInstanceRelatedarticles_rendering($widget_instance_id, '','',$get_content['content_id'], $view_mode); 
				if(count($get_related_article)>0) {
							 $show_simple_tab .='<ul class="lead-list new-lead-story">';
							foreach($get_related_article as $key => $get_article)
							{
								$content_type_id = $get_article['content_type_id'];
				$related_contents = $this->widget_model->get_contentdetails_from_database($get_article['content_id'], $content_type_id, $is_home, $view_mode);	
				if($get_article['CustomTitle'] != '') {
					$Title = $get_article['CustomTitle'];
				} else {
					$Title =  $related_contents[0]['Title'];
				}

				$content_url = $related_contents[0]['url'];
				$param = $content['close_param']; //page parameter
				$related_article_url = $domain_name. $content_url.$param;
				
				$Title =  preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$Title);
					 $show_simple_tab .='<li>
                  <div><i class="fa fa-circle" aria-hidden="true"></i></div>';
	$show_simple_tab .= '<p><a  href="'.$related_article_url.'" class="article_click" >'.$Title.'</a>';
                                 
				  if($content_type_id=='3'){
		$show_simple_tab .= ' <i class="fa fa-picture-o lead_relate_icon"></i>';
	}
	elseif($content_type_id=='4'){
		$show_simple_tab .= ' <i class="fa fa-video-camera lead_relate_icon"></i>';
	}
	elseif($content_type_id=='5'){
		$show_simple_tab .= ' <i class="fa fa-volume-up lead_relate_icon"></i>';
	}
				 $show_simple_tab .= '</p>
                </li>';
                
				}
				}
				}
                $show_simple_tab .='</div>';
		 }
	}
	
                $show_simple_tab .='</div>
             
           
          <div class="common-border"><span></span><span></span></div></div>
        </div>';
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