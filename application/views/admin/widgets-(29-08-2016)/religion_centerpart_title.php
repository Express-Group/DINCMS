<?php
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$widget_section_url = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$domain_name =  base_url();
$view_mode           = $content['mode'];
$show_simple_tab = "";
$show_simple_tab .= '<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="religion-head">';
	 if($widget_custom_title=='')
{
	$widget_custom_title='செய்திகள்';
}
	  
	  
	  
	  if($widget_custom_title!='')
{
	   $show_simple_tab.= '<figure class="rel-left"></figure>';

                   if($content['widget_title_link'] == 1)
					{
						$show_simple_tab.= '<h4><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></h4>';
					}
					else
					{
						$show_simple_tab.= 	' <h4> '.$widget_custom_title.'</h4>';
					}
		$show_simple_tab .=' <figure class="rel-right"></figure> ';

}
/*elseif($view_mode=="adminview")
{
	$msg='Please add the title to show';
$show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'> <h4> '.$msg.'</h4></div>';
}*/
 echo $show_simple_tab .='</div>
      </div>
      </div>';


?>
