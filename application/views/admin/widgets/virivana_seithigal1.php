<style>
.virivana1{width:49% !important;margin-right:1%;margin-bottom: 8px;}
.virivana2{width:49% !important;margin-left:1%;margin-bottom: 8px;}
li.virivana2:last-child{border-bottom: 1px solid #d1d2d2 !important;padding-top: 0;}
.virivana-title-h4{box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.29), 0 4px 20px 0 rgba(0,0,0,0.19); background: radial-gradient(circle, #36A2D9 0%, #0e6c9c 100%);border-bottom-left-radius: 32px;border-top-right-radius: 32px;color: #fff !important;padding: 7px 23px 7px;float:left;margin-bottom:15px;}
.virivana-title-h4 p{padding: 0 !important;margin: 0 !important;color: #fff !important;font-size:13px !important;}
.top-title h4 p{color: #fff !important;}
</style>
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
// widget config block ends

$widget_contents = array();

$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
<div class="latest-news boder-bot" '.$widget_bg_color.'>
<div class="row">';

$content_type = $content['content_type_id'];  
//getting content block starts here . Do not change anything
if($content['RenderingMode'] == "manual")
{
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 			

	// content list iteration block starts here
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
else
{
	if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$content['sectionID'] , $content_type ,  $content['mode'], $is_home);
	} else {
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
		if (function_exists('array_column'))  {
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
		$count=1;
		$total_articles = count($widget_contents);
		
	if(count($widget_contents)>0)
	{          $odd_count = 1;
				$n =1;
				foreach($widget_contents as $get_content)
			{	
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";
				$custom_title        = "";
				$custom_summary      = "";		
				if($content['RenderingMode'] == "manual")// from widgetinstancecontent table    
				{
					$custom_title        = stripslashes($get_content['CustomTitle']);
					$custom_summary      = $get_content['CustomSummary'];
				}
				if($content['RenderingMode'] == "manual")
				{
					if($get_content['custom_image_path'] != '')
					{
						$original_image_path = $get_content['custom_image_path'];
						$imagealt            = $get_content['custom_image_title'];	
						$imagetitle          = $get_content['custom_image_alt'];												
					}
				}
				
				if($original_image_path =="") // from cms || Live table    
				{
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];	
				}
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
				if($original_image_path !='' && get_image_source($original_image_path, 1))
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
						$Image600X390 	= str_replace("original","w150X150", $original_image_path);
					}
					if (get_image_source($Image600X390, 1) && $Image600X390 != '')
					{
						$show_image = image_url. imagelibrary_image_path . $Image600X390;
					}
				}
				
				/******************** article title and summary and url ********************/
				$content_url = $get_content['url'];
				$param = $content['close_param']; //page parameter
				$live_article_url = $domain_name. $content_url.$param;
				$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title);   //to remove first<p> and last</p>  tag
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
				/******************** article title and summary and url ********************/
				
				// display title and summary block starts here
				if($odd_count==1){
					$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  top-title ">';
					if($widget_custom_title!='')
					{
						if($content['widget_title_link'] == 1)
						{
							//$show_simple_tab.='<h4><i class="fa fa-backward"></i><p><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></p>';
							//$show_simple_tab.='<i class="fa fa-forward"></i></h4>';
							$show_simple_tab.='<figure class="seithigal-strip week-button"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></figure>';
						}
						else
						{
							$show_simple_tab.='<h4 class="virivana-title-h4"><p> '.$widget_custom_title.'</p>';
							$show_simple_tab.='</h4>';
						}
					}
				//$show_simple_tab .='<ul class="lead-list ">';
				}
				if($n==1){
					$show_simple_tab .='<ul class="lead-list ">';
				}
				$show_simple_tab .='<li class="pull-left virivana'.$n.'"><div><img style="width:70px;margin-right:6px;float:left;" src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></div>';
				$show_simple_tab .='<p>'.$display_title.'</p>';			
				$show_simple_tab .= '</li>';
				if($n==2){
					$n=1;
					$show_simple_tab .='</ul>';
				}else{
					$n++;
				}
				if(($odd_count == count($odd_widget_contents))){
					if($n==2){
						$show_simple_tab .='</ul>';
					}
					$show_simple_tab .='</div>';
				}
				$odd_count++;
				if((count($even_widget_contents)==0) && $odd_count == count($odd_widget_contents)){
						if($content['widget_title_link'] == 1){
							$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="arrow"><a href="'.$widget_section_url.'" class="landing-arrow">';
							$show_simple_tab .='<div class="arrow-span"></div><div class="arrow-rightnew"></div></a></div></div>';					
						}
					}
			}
			
			}
		
	}
elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
else
{
	$show_simple_tab .='';
}

$show_simple_tab .='</div><div class="common-border"><span></span><span></span></div></div></div></div></div>';
echo $show_simple_tab;
?>
 