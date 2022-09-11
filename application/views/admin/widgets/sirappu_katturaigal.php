<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
// widget config block ends
//getting tab list for hte widget
// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name        =  base_url();
$show_simple_tab    = "";
$show_simple_tab .='<div class="row">
<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
<div '.$widget_bg_color.'>
<div class="cartoon Sirappu-katturaigal">
<div class="row">
<div class="right-padding">';

$show_simple_tab .='<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12 cart">';


$show_simple_tab.=	'<div class="box-botton box-button3 font-size-11">';
$show_simple_tab.='<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
$show_simple_tab.=	'</div>';


//Widget code block ends here
$content_type = $content['content_type_id'];
$widget_contents = array();
// content list iteration block - Looping through content list and adding it the list
// content list iteration block starts here
if($content['RenderingMode'] == "manual") {
$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , "" ,$content['mode'], $content['show_max_article']); 	

if (function_exists('array_column'))  {
$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
} else {
$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
}
$get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='') {
$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
//print_r($widget_instance_contents1 );exit;
foreach ($widget_instance_contents as $key => $value) {
foreach ($widget_instance_contents1 as $key1 => $value1) {
if($value['content_id']==$value1['content_id']){
$widget_contents[] = array_merge($value, $value1);
}
}
}
}
					
} else {
//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);

if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
	}else{
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],  $content['sectionID'], $content_type ,  $content['mode'], $is_home);
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
foreach($widget_contents as $get_content)
{
// getting content details 
$custom_title        = "";
$custom_summary      = "";
if($content['RenderingMode'] == "manual")
{

$custom_title   = $get_content['CustomTitle'];
$custom_summary = $get_content['CustomSummary'];
}

$content_url = $get_content['url'];
$param = $content['close_param'];
$live_article_url = $domain_name.$content_url.$param;

if( $custom_title == '')
{
$custom_title = $get_content['title'];
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	

if($i == 1)
{
$show_simple_tab .= '<div class="box-one box-one3 box-color2">';
$show_simple_tab .='<ul class="lead-list box">';
$show_simple_tab .='<li>
<div><i class="fa fa-angle-right"></i></div>';
$show_simple_tab .='<p>'.$display_title.'</p>';
$show_simple_tab .='</li>';
}
else
{
$show_simple_tab .='<li>
<div><i class="fa fa-angle-right"></i></div>';
$show_simple_tab .='<p>'.$display_title.'</p>';
$show_simple_tab .='</li>';
} 

if($i == count($widget_contents))
{
$show_simple_tab .= '</ul>';
$show_simple_tab .='<div class="arrow-grey medai"><a href="'.$widget_section_url.'"><div class="arrow-span"> </div>
<div class="arrow-rightnew"></div>
</a></div>';

$show_simple_tab .=' </div></div>';
}
// display title and summary block ends here					
//Widget design code block 1 starts here																
//Widget design code block 1 starts here			
$i =$i+1;							  
}
/*}
else {
$show_simple_tab .='</div>';
} */
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

$show_simple_tab .='<div id="features"><div class="col-lg-6 col-md-12 col-sm-6 col-xs-12   child-wrold cart ">
<div class="box-botton child-button font-size padding-6">அனைத்துப் பதிப்புகள்</div>
<div class="box-one child-box all-story">
<div class="slider single-item ">
<div>
<h4><a  href="'.base_url().'all-editions/edition-chennai">சென்னை</a></h4>
<ul class="box-li area-li">
<li><a href="'.base_url().'all-editions/edition-chennai/chennai"><i class="fa fa-caret-right fa-lg"></i> சென்னை</a></li>
<li><a href="'.base_url().'all-editions/edition-chennai/thiruvallur"><i class="fa fa-caret-right fa-lg"></i>  திருவள்ளூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-chennai/kanchipuram"><i class="fa fa-caret-right fa-lg"></i>  காஞ்சிபுரம்</a></li>
<li><a href="'.base_url().'all-editions/edition-chennai/vellore"><i class="fa fa-caret-right fa-lg"></i> வேலூர்</a></li>
<li><a href="'.base_url().'all-editions/edition-chennai/tiruvannamalai"><i class="fa fa-caret-right fa-lg"></i> திருவண்ணாமலை</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-trichy">திருச்சி</a></h4>
<ul class="box-li area-li2">
<li><a href="'.base_url().'all-editions/edition-trichy/trichy"><i class="fa fa-caret-right fa-lg"></i>  திருச்சி</a></li>
<li><a href="'.base_url().'all-editions/edition-trichy/ariyalur"><i class="fa fa-caret-right fa-lg"></i> அரியலூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-trichy/karur"><i class="fa fa-caret-right fa-lg"></i>  கரூர்</a></li>
<li><a href="'.base_url().'all-editions/edition-trichy/pudukottai"><i class="fa fa-caret-right fa-lg"></i>  புதுக்கோட்டை</a></li>
<li><a href="'.base_url().'all-editions/edition-trichy/tanjore"><i class="fa fa-caret-right fa-lg"></i> தஞ்சாவூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-trichy/perambalur"><i class="fa fa-caret-right fa-lg"></i>  பெரம்பலூர்</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-madurai">மதுரை</a></h4>
<ul class="box-li area-li3">
<li><a href="'.base_url().'all-editions/edition-madurai/madurai"><i class="fa fa-caret-right fa-lg"></i> மதுரை</a></li>
<li><a href="'.base_url().'all-editions/edition-madurai/dindigul"><i class="fa fa-caret-right fa-lg"></i>  திண்டுக்கல்</a></li>
<li> <a href="'.base_url().'all-editions/edition-madurai/theni"><i class="fa fa-caret-right fa-lg"></i>  தேனி</a></li>
<li><a href="'.base_url().'all-editions/edition-madurai/sivagangai"><i class="fa fa-caret-right fa-lg"></i>சிவகங்கை</a></li>
<li><a href="'.base_url().'all-editions/edition-madurai/virudhnagar"><i class="fa fa-caret-right fa-lg"></i>  விருதுநகர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-madurai/ramanathapuram"><i class="fa fa-caret-right fa-lg"></i>  ராமநாதபுரம்</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-coimbatore">கோயம்புத்தூர்</a></h4>
<ul class="box-li area-li4">
<li><a href="'.base_url().'all-editions/edition-coimbatore/coimbatore"><i class="fa fa-caret-right fa-lg"></i>கோயம்புத்தூர்</a></li>
<li><a href="'.base_url().'all-editions/edition-coimbatore/tiruppur"><i class="fa fa-caret-right fa-lg"></i>  திருப்பூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-coimbatore/erode"><i class="fa fa-caret-right fa-lg"></i>  ஈரோடு</a></li>
<li><a href="'.base_url().'all-editions/edition-coimbatore/nilgiris"><i class="fa fa-caret-right fa-lg"></i>நீலகிரி</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-thirunelveli">திருநெல்வேலி</a></h4>
<ul class="box-li area-li5">
<li><a href="'.base_url().'all-editions/edition-thirunelveli/thirunelveli"><i class="fa fa-caret-right fa-lg"></i>திருநெல்வேலி</a></li>
<li><a href="'.base_url().'all-editions/edition-thirunelveli/tuticorin"><i class="fa fa-caret-right fa-lg"></i> தூத்துக்குடி</a></li>
<li> <a href="'.base_url().'all-editions/edition-thirunelveli/kanyakumari"><i class="fa fa-caret-right fa-lg"></i> கன்னியாகுமரி</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-dharmapuri">தருமபுரி</a></h4>
<ul class="box-li area-li6">
<li><a href="'.base_url().'all-editions/edition-dharmapuri/dharmapuri"><i class="fa fa-caret-right fa-lg"></i>தருமபுரி</a></li>
<li><a href="'.base_url().'all-editions/edition-dharmapuri/namakkal"><i class="fa fa-caret-right fa-lg"></i> நாமக்கல்</a></li>
<li> <a href="'.base_url().'all-editions/edition-dharmapuri/krishnagiri"><i class="fa fa-caret-right fa-lg"></i> கிருஷ்ணகிரி</a></li>
<li><a href="'.base_url().'all-editions/edition-dharmapuri/salem"><i class="fa fa-caret-right fa-lg"></i> சேலம்</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-villupuram">விழுப்புரம்</a></h4>
<ul class="box-li area-li7">
<li><a href="'.base_url().'all-editions/edition-villupuram/villupuram"><i class="fa fa-caret-right fa-lg"></i>விழுப்புரம்</a></li>
<li><a href="'.base_url().'all-editions/edition-villupuram/cuddalore"><i class="fa fa-caret-right fa-lg"></i> கடலூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-villupuram/puducherry"><i class="fa fa-caret-right fa-lg"></i> புதுச்சேரி</a></li>
</ul>
</div>
<div>
<h4><a href="'.base_url().'all-editions/edition-nagapattinam">நாகப்பட்டினம்</a></h4>
<ul class="box-li area-li7">
<li><a href="'.base_url().'all-editions/edition-nagapattinam/nagapattinam"><i class="fa fa-caret-right fa-lg"></i>நாகப்பட்டினம் </a></li>
<li> <a href="'.base_url().'all-editions/edition-nagapattinam/thiruvarur"><i class="fa fa-caret-right fa-lg"></i>  திருவாரூர்</a></li>
<li> <a href="'.base_url().'all-editions/edition-nagapattinam/karaikal"><i class="fa fa-caret-right fa-lg"></i> காரைக்கால்</a></li>
</ul>
</div>
<div>
<ul class="box-li area-li8">
<li><a href="'.base_url().'all-editions/edition-bangalore"><i class="fa fa-caret-right fa-lg"></i>பெங்களூரு </a></li>
<li><a href="'.base_url().'all-editions/edition-new-delhi"><i class="fa fa-caret-right fa-lg"></i>புதுதில்லி </a></li>
</ul>
</div>
</div>
</div>
</div></div>';

$show_simple_tab .='</div></div></div></div></div></div>';
echo $show_simple_tab;
?>