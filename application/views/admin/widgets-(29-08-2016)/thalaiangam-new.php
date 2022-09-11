<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url = $content['widget_section_url'];
$tab_sections	     = $content['widget_values']->widgettab;
$view_mode           = $content['mode'];


// widget config block ends
//getting tab list for hte widget
if($content['RenderingMode'] == "manual")
{
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
}else{
$widget_instancemainsection	= $content['widget_values']->widgettab;

}// Code block A - this code block is needed for creating simple tab widget. Do not delete
//print_r($widget_instancemainsection);exit;
$domain_name =  base_url();
$show_simple_tab = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="cartoon pair-one">
<div class="row">
<div class="sports-padd">';

if(count($widget_instancemainsection)>0)
{

// Code Block A ends here


// Tab Creation Block Starts here
$j = 0;

// // Tab Creation Block- Below code gets the record from windgetinstancemainsection table to create tabs for this widget 
// Adding content Block - to add contents for each tab
// Adding content Block starts here
foreach($widget_instancemainsection as $get_section)
{

//getting content block - getting content list based on rendering mode
//getting content block starts here . Do not change anything
if($content['RenderingMode'] == "manual")
{
$content_type = $content['content_type_id'];
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , $get_section['WidgetInstanceMainSection_id'] ,$content['mode'],$content['show_max_article']); 						
}
else
{
$content_type = $content['content_type_id'];  // auto article content type
$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['cdata-categoryId'] , $content_type ,  $content['mode']);
}
$section_id = (string)$tab_sections[$j]['cdata-categoryId'];
$section_details = $this->widget_model->get_section_by_id($section_id);
$widget_section_url = $domain_name .$section_details ['URLSectionStructure'];														//getting content block ends here
//Widget code block - code required for simple tab structure creation. Do not delete
//Widget code block Starts here
if($j==0){
$add_class='box-botton font-size-11';
$add_sub_class='box-one';
$show_image	=  base_url().'images/FrontEnd/images/Nammazhvar.jpg';
}
elseif($j==1){
$add_class='box-botton font-size-11';
$add_sub_class='box-one';
$show_image	=  base_url().'images/FrontEnd/images/Thiruppugazh.jpg';
}

$show_simple_tab .='<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12  cart">';


$show_simple_tab.=	'<div class="'.$add_class.'">';
if($content['RenderingMode'] == "manual")
{
$show_simple_tab.='<a href="'.$widget_section_url.'">'.$get_section['CustomTitle'].'</a>';
}
else
{
$show_simple_tab.='<a href="'.$widget_section_url.'">'.$get_section['cdata-customTitle'].'</a>';
}
$show_simple_tab.='</div>';


//Widget code block ends here

// content list iteration block - Looping through content list and adding it the list
// content list iteration block starts here

/* if(empty($widget_instance_contents))
{
$show_simple_tab .='</div>';

}else{*/
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
//print_r($widget_instance_contents1 );exit;
$widget_contents = array();
foreach ($widget_instance_contents as $key => $value) {
foreach ($widget_instance_contents1 as $key1 => $value1) {
if($value['content_id']==$value1['content_id']){
$widget_contents[] = array_merge($value, $value1);
}
}
}

$i =1;
if(count($widget_contents)>0)
{
foreach($widget_contents as $get_content)
{
// getting content details 
$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$custom_title        = "";
$custom_summary      = "";
$manual_image_path   ="";
if($content['RenderingMode'] == "manual")
{
$custom_title   = $get_content['CustomTitle'];
$custom_summary = $get_content['CustomSummary'];
}
/*if($content['RenderingMode'] == "manual")
{
if($get_content['custom_image_path'] != '')
{
$original_image_path = $get_content['custom_image_path'];
$manual_image_path   = $get_content['custom_image_path'];
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
//$SourceURL = $content['widget_img_phy_path'];
$show_image="";

if ($original_image_path!='' && getimagesize(image_url . imagelibrary_image_path .$original_image_path))
{
$imagedetails = getimagesize(image_url . imagelibrary_image_path.$original_image_path);
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
$show_image = image_url. imagelibrary_image_path . $Image600X300;
}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
}*/
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';

$content_url = $get_content['url'];
$param = $content['page_param'];
$live_article_url = $domain_name.$content_url."?pm=".$param;

if( $custom_title == '')
{
$custom_title = $get_content['title'];
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
// Assign summary block starts here
if( $custom_summary == '' && $content['RenderingMode'] == "auto")
{
$custom_summary =  $get_content['summary_html'];
}
$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag
//  summary block endss here


if($i == 1)
{
$show_simple_tab .= '<div class="'.$add_sub_class.'">';
$show_simple_tab .='<a href="'.$live_article_url.'" class="article_click" > 
<figure> 
<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"> 
</figure></a>';

$show_simple_tab .=' <figcaption><h4>'.$display_title.'</h4>';

if($is_summary_required== 1)
$show_simple_tab.='<p class="summary">'.$summary.'</p>';

}

if($i == count($widget_contents))
{

$show_simple_tab .='<div class="arrow-grey"><a  href="'.$widget_section_url.'"><div class="arrow-span"> </div><div class="arrow-rightnew"></div></a></div>';
$show_simple_tab .=' </figcaption> </div> </div>';
}
// display title and summary block ends here					
//Widget design code block 1 starts here																
//Widget design code block 1 starts here			
$i =$i+1;							  
}
}else {
$show_simple_tab .='</div>';
}
}
else
{
if($view_mode=="adminview")
{

$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
$show_simple_tab .='</div>';
}
else {
$show_simple_tab .='</div>';
}
}				


// content list iteration block ends here
//$show_simple_tab .= '</div>';
$j++;
}
}
elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
// Adding content Block ends here


$show_simple_tab .='</div></div></div></div></div>';
echo $show_simple_tab;
?>
