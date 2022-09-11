
<?php
$widget_bg_color 		=	$content['widget_bg_color'];
$widget_custom_title 	=	$content['widget_title'];
$widget_instance_id 	=	$content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= 	$content['sectionID'];
$main_sction_id 		= 	"";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];
$max_article         = 5;
$render_mode         = $content['RenderingMode'];
$domain_name 		    =	base_url();
$show_simple_tab 	    = 	"";
if($content['widget_title_link'] == 1){
	$widget_title=	'<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
}else{
	$widget_title=	$widget_custom_title;
}
$show_simple_tab 	   .=	' <div class="row">'; // Row Started 
$show_simple_tab 	   .=	'<div class="">';
if(strtolower(strip_tags($widget_custom_title))!='none'){
	$show_simple_tab.='<div class="col-md-12"><h4 class="virivana-title-h4"><p>'.$widget_title.'</p></h4></div>';
}	
$content_type = $content['content_type_id'];
$widget_contents = array();
if($render_mode == "manual")
{
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $max_article); 	

$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
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
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);

}


$i =1;
$count = 1;
if(count($widget_contents)>0)
{
	$show_simple_tab 	   .=	'<div style="float:left;" class="SundaySecond margin-bottom-15" '.$widget_bg_color.'>';
	foreach($widget_contents as $get_content) // For Get Content Start Here 
	{
		$sectionName = $get_content['section_name'];                     
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$custom_title        = "";
		$custom_summary      = "";
		if($render_mode == "manual")
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
		if($original_image_path ==""){
		$original_image_path  = $get_content['ImagePhysicalPath'];
		$imagealt             = $get_content['ImageCaption'];	
		$imagetitle           = $get_content['ImageAlt'];	
		}
		$logo_prefix = ($is_home=='y') ? 'dinamani' : 'dinamani';
	    $show_image="";
		if($original_image_path !='' && get_image_source($original_image_path, 1))
		{
			$imagedetails = get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];	
			$Image600X300 	= str_replace("original","w600X390", $original_image_path);
			if (get_image_source($Image600X300, 1) && $Image600X300 != '')
			{
			$show_image = image_url. imagelibrary_image_path . $Image600X300;
			}
			else 
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
		}
		else
		{
		$show_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
		$dummy_image	= image_url. imagelibrary_image_path.'logo/'.$logo_prefix.'_logo_600X390.jpg';
		}
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		if( $custom_summary == '' && $render_mode=="auto")
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
		if($i<=5){
			if($i==1 || $i==4){
				$show_simple_tab.= '<div class="col-md-3 col-lg-3 col-sm-12 padd-'.$i.'">';
			}
			if($i<=2 || $i==4 || $i==5){
				//$show_image = str_replace('600X390','600X300',$show_image);
				$show_simple_tab.= '<div class="suttrula-widget">';
				$show_simple_tab.= '<a href="'.$live_article_url.'"><img src="'.$dummy_image.'" data-src="'.$show_image.'" class="img-responsive"></a>';
				$show_simple_tab.= '<h5>'.$display_title.'</h5>';
				$show_simple_tab.= '</div>';
			}
			if($i==3){
				$show_simple_tab.= '<div class="col-md-6 col-lg-6 col-sm-12 padd-'.$i.'">';
				$show_simple_tab.= '<div class="suttrula-widget">';
				$show_simple_tab.= '<a href="'.$live_article_url.'"><img class="suttrula-center-img" src="'.$dummy_image.'" data-src="'.$show_image.'" class="img-responsive"></a>';
				$show_simple_tab.= '<h5>'.$display_title.'</h5>';
				$show_simple_tab.= '</div>';
				$show_simple_tab.= '</div>';
			}
			if($i==2 || $i==5){
				$show_simple_tab.= '</div>';
			}
			
		}
			
		$i =$i+1;							  
	}	
	if($i!=6){
		$show_simple_tab.= '</div>';
	}
	$show_simple_tab.= '</div>';
  }
 elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}

$show_simple_tab .='</div>';// col-lg-12
$show_simple_tab .='</div>';


echo $show_simple_tab;
?>
  