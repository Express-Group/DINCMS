<style>
.home-gal .slick-list{background: #fff;}
.home-gal figure{position: relative;float: left;}
.home-gal figcaption{position: absolute;bottom: 0;left: 0;background: linear-gradient(to bottom,transparent 0,rgba(0,0,0,1) 80%);padding: 37px 11px 16px;font-size: 18px !important;line-height: 1.5;height:auto;}
.home-gal .slick-dots{display:none !important;}
.home-thumbnail figcaption{margin-top: 4px;background: #0d4167;padding: 10px; min-height: 74px;}
.home-thumbnail figcaption a{color: #fff!important;font-size: 12px;}
</style>
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
$show_simple_tab         = "";
// widget config block ends


if($widget_custom_title == "")
	$widget_custom_title = "புகைப்படங்கள்";	
	
$show_simple_tab = "";
$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
$content_type = $content['content_type_id'];  // auto article content type
$widget_contents = array();

//getting content block starts here .
if($content['RenderingMode'] == "manual") {
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$view_mode ,$content['show_max_article']); 
		
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
		$widget_contents = array();
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}
	
} else {
	//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'], $content_type ,  $view_mode );
	
			if($view_mode=="live"){
					$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
			}else{
					  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],   $content['sectionID'], $content_type ,  $content['mode'], $is_home);
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

	$i =1;
	if(count($widget_contents)>0)
	{
		//print_r($widget_contents);exit;
		foreach($widget_contents as $get_content)
		{		
			$custom_title        = "";
			//$custom_summary      = "";
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$Image600X300        = "";
			if($content['RenderingMode'] == "manual")// from widgetinstancecontent table    
			{
				if($get_content['custom_image_path'] != '')
				{
					$original_image_path = $get_content['custom_image_path'];
					$imagealt            = $get_content['custom_image_title'];	
					$imagetitle          = $get_content['custom_image_alt'];												
				}
				$custom_title        = stripslashes($get_content['CustomTitle']);
				//$custom_summary      = $get_content['CustomSummary'];			
			}
			
			if($original_image_path =="")// from cms || Live table    
			{
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];
			}
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
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
				if (get_image_source($Image600X300, 1) && $Image600X300 != '')
				{
					$show_image = image_url. imagelibrary_image_path . $Image600X300;
				}
			}
			
			/******************** article title and summary and url ********************/
			$content_url = $get_content['url'];
			$param = $content['close_param']; //page parameter
			$live_article_url = $domain_name. $content_url.$param;
			
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);   //to remove first<p> and last</p>  tag
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
			
			//  Assign article links block ends hers
			if($i == 1) 
			{
				$show_simple_tab.= '<div class="slider slider-for slider-for-mob home-gal">';
			}
			$show_simple_tab.= '<div><figure><a  href="'.$live_article_url.'">';
			$show_simple_tab.= '<img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" /></a>';
			$show_simple_tab.= '<figcaption>'.$display_title.' </figcaption></figure></div>';
			if($i == count($widget_contents))
			{
				$show_simple_tab.=	'</div>';
			}			
			$i =$i+1;
		}
		$k=1;
		//echo '<pre>'; print_r($get_content); die();
		foreach($widget_contents as $get_content)
		{
			
			$custom_title        = "";
			//$custom_summary      = "";
			$original_image_path = "";
			$imagealt            = "";
			$imagetitle          = "";
			$Image600X300        = "";
			if($content['RenderingMode'] == "manual") // from widgetinstancecontent table    
			{
				if($get_content['custom_image_path'] != '')
				{
					$original_image_path = $get_content['custom_image_path'];
					$imagealt            = $get_content['custom_image_title'];	
					$imagetitle          = $get_content['custom_image_alt'];												
				}
				$custom_title        = stripslashes($get_content['CustomTitle']);
				//$custom_summary      = $get_content['CustomSummary'];
			}
			if($original_image_path == "")// from cms || Live table    
			{
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];
			}
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			if ($original_image_path!='' && get_image_source($original_image_path, 1))
			{
				$imagedetails = get_image_source($original_image_path,2);
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
				if (get_image_source($Image600X300, 1) && $Image600X300 != '')
				{
					$show_image = image_url. imagelibrary_image_path . $Image600X300;
				}				
			}	
				
			
			/******************** article title and summary and url ********************/
			$content_url = $get_content['url'];
			$param = $content['close_param']; //page parameter
			$live_article_url = $domain_name. $content_url.$param;
			
			$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);   //to remove first<p> and last</p>  tag
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
			
			if($k == 1) 
			{
				$show_simple_tab.= '<div class="slider slider-nav home-thumbnail">';
			}		
			$show_simple_tab.= '<div><figure><img  title = "'.$imagetitle.'" alt = "'.$imagealt.'"  src="'.$show_image.'"/>';
			$show_simple_tab.= '<figcaption>'.$display_title.'</figcaption></figure></div>';
			if($k == count($widget_contents))
			{
              $show_simple_tab.='</div>';
			  if($content['widget_title_link'] == 1)
					{
							//$show_simple_tab .='<div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow">';
							//$show_simple_tab .='<div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';
					}
			  
			}	
			$k =$k+1; 
			$i =$i+1;
		}// content list iteration block ends here
		//$show_simple_tab .='</div></div>';
		
	//}
}
elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div></br></br></br></div><div class="margin-bottom-10">'.no_articles.'</div>';
}


// Adding content Block ends here
$show_simple_tab .='</div></div></div>';
echo $show_simple_tab;
?>

<script>
$('.slider-for').slick({
slidesToShow: 2,
slidesToScroll: 1,
infinite:true,
arrows: false,
dots: true,
asNavFor: '.slider-nav',
autoplay: true,
});
$('.slider-nav').slick({
slidesToShow: 4,
slidesToScroll: 1,
infinite:true,
asNavFor: '.slider-for',
focusOnSelect: true
});


$(function(){
$('.home-thumbnail .slick-active').eq(0).addClass('slick-center');
});
$('.slick-slide').click(function(){
$('.slick-slide').removeClass('slick-center');
//$(this).addClass('slick-center');
$('.home-thumbnail .slick-active').eq(0).addClass('slick-center');
});
$('.slider-for').on('swipe', function(event, slick, currentSlide, nextSlide){
$('.slick-slide').removeClass('slick-center');
$('.home-thumbnail .slick-active').eq(0).addClass('slick-center');
});
$('.slider-nav').on('afterChange', function(event, slick, currentSlide, nextSlide){
$('.slick-slide').removeClass('slick-center');
$('.home-thumbnail .slick-active').eq(0).addClass('slick-center');
});
//$('.slider-for').slick('unslick');
</script>

