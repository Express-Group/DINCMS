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
}

if($author_id != '') 
{
$author_det = $this->widget_model->get_author($author_id);
//$topicname = $this->widget_model->gettopic_name();
//print_r($author_det);exit;

$author_name = $author_det[0]['AuthorName'];
//$author_image= $author_det[0]['Displayimage'];
$ShortBiography= $author_det[0]['ShortBiography'];
$column_id= $author_det[0]['column_id'];
$topic=$author_det[0]['column_name'];
$description=$author_det[0]['description'];

}
//print_r($section_details);exit;
$show_simple_tab.=  ' <h4 class="text-align-center font-size-16">'.$topic.'</h4> ';


$show_simple_tab.=  '<figure class="junction-name">
         <figcaption>
         <p>'.$description.' </p>
          </figure>';
		  

echo $show_simple_tab.=  '</div>
                          </div>';
?>
