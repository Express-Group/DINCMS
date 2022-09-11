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

//getting tab list for hte widget
if($content['RenderingMode'] == "manual")
{
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
}else{
$widget_instancemainsection	= $content['widget_values']->widgettab;
}

$domain_name            =  base_url();
$show_simple_tab        = "";
$show_simple_tab       .='<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 						
							<div id="parentHorizontalTab_'.$widget_instance_id.'"  class="margin-bottom">
							<div class="tour-content">';
$show_simple_tab       .= '<div class="row">
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 cinema-link ">  ';
							
							if($widget_custom_title!='')
{
							$show_simple_tab.='<figure class="bg-left"></figure>';

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
$show_simple_tab.='</div>
<div class="col-lg-7 col-md-7 col-sm-7 col-xs-6 cine-head">';
$show_simple_tab .= '<ul class="resp-tabs-list hor_1" >';
// Code Block A ends here

// Tab Creation Block- Below code gets the record from windgetinstancemainsection table to create tabs for this widget 
// Tab Creation Block Starts here

$instance_id = "";
$widget_main_section_id = "";
if($content['RenderingMode'] == "manual")
			{       
				$l=1;
				foreach($widget_instancemainsection as $get_section)
				{
				$add_attr = ($l>1)?'id="sutrulla'.$get_section['WidgetInstanceMainSection_id'].'"': '';
				$show_simple_tab .= ' <li '.$add_attr.'> '.$get_section['CustomTitle'].'</li> ';
				$l++;
				}
				
			}
			else
			{
				$l=1;
				foreach($widget_instancemainsection as $get_section)
				{
				$add_attr = ($l>1)?'id="sutrulla'.$get_section['cdata-categoryId'].'"': '';
				$show_simple_tab .= ' <li '.$add_attr.'> '.$get_section['cdata-customTitle'].'</li> ';
				$l++;
				}
				
			}
$show_simple_tab .='</ul></div></div>';


$show_simple_tab .= '<div class="resp-tabs-container hor_1 cinema-tab" '.$widget_bg_color.'>';
                                                $j = 0;
												foreach($widget_instancemainsection as $get_section)
												{
													if($j==0){
												
												if($content['RenderingMode'] == "manual")
															{
															$content_type = $content['content_type_id'];  // auto article content type
															$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($get_section['WidgetInstance_id'], $get_section['WidgetInstanceMainSection_id'],$content['mode'], $content['show_max_article']); 						
															}
															else
															{
															$content_type = $content['content_type_id'];  // auto article content type
															$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['cdata-categoryId'] , $content_type ,  $content['mode']);
															}
//getting content block ends here

$show_simple_tab .='<div>';
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="tour-line sutrulla-tour">';
//Widget code block ends here

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
$i = 1;$w = 1;
if(count($widget_contents)>0)
{
//echo '<pre>'; print_r($widget_contents); die();

foreach($widget_contents as $get_content)
{

$original_image_path = "";
	$imagealt            = "";
	$imagetitle          = "";
	$custom_title        = "";
	$custom_summary      = "";  
	$summary      = "";
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
	
	if($original_image_path =="") // from cms || Live table    
	{
	$original_image_path  = $get_content['ImagePhysicalPath'];
	$imagealt             = $get_content['ImageCaption'];	
	$imagetitle           = $get_content['ImageAlt'];	
	}
	
//$SourceURL = $content['widget_img_phy_path'];
$show_image="";
if ($original_image_path!='' && getimagesize(image_url . imagelibrary_image_path .$original_image_path))
			{
			$imagedetails = getimagesize(image_url . imagelibrary_image_path.$original_image_path);
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
$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;

$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
$param = $content['page_param']; //page parameter
$live_article_url = $domain_name. $content_url."?pm=".$param;

if( $custom_title == '')
{
	$custom_title = stripslashes($get_content['title']);
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';				
if( $custom_summary == '' && $content['RenderingMode'] == "auto")
{
	$custom_summary =  $get_content['summary_html'];
}
$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag

	if($i==1){
	$show_simple_tab.= '<div class="clear_both">';
	}
	$show_simple_tab .= '<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 tour">
	<a href="'.$live_article_url.'" class="article_click" >
	<figure><img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure>
	</a><figcaption class="tour1">';
	$show_simple_tab .='<h4>'.$display_title.'</h4>';
	if($is_summary_required==1)
	$show_simple_tab .= '<p>'.$summary.'</p>';
	$show_simple_tab .= '</figcaption></div>';
	if($i==3 || $w == count($widget_contents)){
	$show_simple_tab.= '</div>';
	$i = 0;
	}
$i = $i+1;	
$w = $w+1;						  
}

			if(count($widget_contents)>0)
			{
			$show_simple_tab .='<div class="arrow">
			<a href="'.$sectionURL.'" class="landing-arrow"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';
			
			}

     }
}
elseif($view_mode=="adminview")
{
	$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
$show_simple_tab .= '</div></div></div></div>';
												}
												else
   {
	   if($content['RenderingMode'] == "manual"){
			$show_simple_tab .='<div id="sutrulla_'.$get_section['WidgetInstanceMainSection_id'].'_'.$widget_instance_id.'">
			<div class="cssload-container" id="add_article_process_img'.$get_section['WidgetInstanceMainSection_id'].'" style="display:none;"><div class="cssload-zenith"></div></div>
<div class=" ajaxStatus ajaxFailed noDisplay" style="display: none;">Failed to load the content...</div></div>';
			}else{
			$show_simple_tab .='<div id="sutrulla_'.$get_section['cdata-categoryId'].'_'.$widget_instance_id.'">
			<div class="cssload-container" id="add_article_process_img'.$get_section['cdata-categoryId'].'" style="display:none;"><div class="cssload-zenith"></div></div>
<div class=" ajaxStatus ajaxFailed noDisplay" style="display: none;">Failed to load the content...</div></div>';
			}
   }
												
// content list iteration block ends here

$j++;
}
// Adding content Block ends here

$show_simple_tab .='</div></div></div></div></div>';
echo $show_simple_tab;
?>

<script>	
// script used for tab creation	
//$(document).ready(function() {
$('#parentHorizontalTab_<?php echo $widget_instance_id; ?>').easyResponsiveTabs({activate: function(event, tab){
	
	
	//accordion load
		var list =$('#parentHorizontalTab_<?php echo $widget_instance_id; ?> .resp-tab-item').attr('aria-controls');
var accord=$('#parentHorizontalTab_<?php echo $widget_instance_id; ?> .resp-accordion').attr('aria-controls');
//console.log(accord);
var itemCount = 0;
$( "#parentHorizontalTab_<?php echo $widget_instance_id; ?> .resp-tab-item" ).each(function() {
if(list==accord){
	var idattr = $(this).attr('id');
	//console.log(idattr);
	 var category_attr = $(this).attr('data-contentype');
    $('#parentHorizontalTab_<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('id',idattr);
	$('#parentHorizontalTab_<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('data-contentype',category_attr);
}
 itemCount++;
});
//end
	
	var id = $(this).attr('id');
	var sutrulla_id= id.substring(8);
	//console.log(sutrulla_id);
	$('#add_article_process_img'+sutrulla_id).css('display','block');
	if ($(this).attr('id')){
		
								$.ajax({
									url    : '<?php echo base_url(); ?>user/commonwidget/sutrulla_content',
									method : 'post',
									data   : {section_id:sutrulla_id, widgetinstanceid:'<?php echo $widget_instance_id; ?>',mode: '<?php echo $content['mode'];?>', 'rendermode' : '<?php echo $content['RenderingMode'];?>', is_home : '<?php echo $is_home;?>', max_article : '<?php echo $content['show_max_article'];?>', summary_option: '<?php echo $is_summary_required;?>',param : '<?php echo $content['page_param'];?>' ,widget_type: 'suttrula-3col'},
							   	beforeSend	: function() {				
								},
								success		: function(result){ 
								//console.log(result);
								$('#'+id).removeAttr('id');
									   $('#sutrulla_'+sutrulla_id+'_<?php echo $widget_instance_id; ?>').html(result).hide().fadeIn({ duration: 2000 });
									   }
								});
						   }
},
	
});
//});
</script>
