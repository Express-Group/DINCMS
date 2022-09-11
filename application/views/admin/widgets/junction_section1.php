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
					 
					 
					 
$page_section_id = $content['page_param'];
//echo $page_section_id;exit;
$author_id = '';
$section_details = $this->widget_model->get_section_by_id($page_section_id);


$linked_to_columnist = $section_details['AuthorID'];
if($linked_to_columnist != '' || $linked_to_columnist != NULL)
{
	$author_id = $section_details['AuthorID'];

$show_image = "";
if($author_id != '') 
{
$author_det = $this->widget_model->get_author($author_id);
//print_r($author_det );exit;
$author_name = $author_det[0]['AuthorName'];
//$author_image= $author_det[0]['Displayimage'];
$ShortBiography= stripslashes($author_det[0]['ShortBiography']);
$column_id= $author_det[0]['column_id'];

$author_image = "";
$imagealt = "";
$imagetitle  = "";
$image_id  = $author_det[0]['image_id'] ;

$image_path=$author_det[0]['image_path'] ;
if($image_path !='')
{
	$author_image  = $author_det[0]['image_path']; 
	$imagealt             = $author_det[0]['image_alt'];	
	$imagetitle           = $author_det[0]['image_caption'];
}

/*if($image_id!='')
{
	
	$author_details = $this->widget_model->get_image_by_contentid($image_id);
	
	if(count($author_details)>0)
	{
	$author_image         = $author_details['ImagePhysicalPath']; 
	$imagealt             = $author_details['ImageCaption'];	
	$imagetitle           = $author_details['ImageAlt'];
	}
	else
	{
		$author_image="";
		$imagealt="";
		$imagetitle  ="";
		}
}
else
{
	
}*/

if($author_image  !='')
{
	
	/*$Image150X150  = str_replace("original","w150X150", $author_image );

	if (get_image_source($Image150X150, 1) && $Image150X150 != '')
	{ 
	$show_image = image_url. imagelibrary_image_path . $Image150X150;
	}
	else
	{
	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
	}
	$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';*/
	if (getimagesize(image_url_no . $author_image ) && $author_image  != '')
	{	
		//die('test');
		 $show_image = image_url. $author_image ;
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
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
//print_r($section_details);exit;


$show_simple_tab.=  '<h4 class="text-align-center font-size-16">'.$author_name.'</h4>';


$show_simple_tab.=  '<figure class="junction-name">';

         $show_simple_tab.=  '<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
         $show_simple_tab.=  '<figcaption>
        <p>'.$ShortBiography.' </p>
         </figcaption>';
         
         $show_simple_tab.=  '</figure>';


 
}
}
else 
{
	if($view_mode=="adminview")
	 {$show_simple_tab.=  '<p> Please select the columnist to this section </p>';}
}
echo $show_simple_tab.=  '<div class="common-border"><span></span><span></span></div> </div>
                          </div>';
?>
