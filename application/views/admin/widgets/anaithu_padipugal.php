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
$tab_sections	     = $content['widget_values']->widgettab;

// widget config block ends
//getting tab list for hte widget
/// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name        =  base_url();
$show_simple_tab    = "";
$show_simple_tab .='<div class="row">
						<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
						<div '.$widget_bg_color.'>
							<div class="cartoon">
								<div class="row">
									<div class="right-padding">';
				
$show_simple_tab .='<div id="features"><div class="col-lg-6 col-md-12 col-sm-6 col-xs-12   child-wrold cart ">
<div class="box-botton child-button font-size padding-6">அனைத்துப் பதிப்புகள்</div>
<div class="box-one child-box all-story bx1">
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
<li><a href="'.base_url().'all-editions/edition-madurai/virudhunagar"><i class="fa fa-caret-right fa-lg"></i>  விருதுநகர்</a></li>
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

$content_type = $content['content_type_id'];
$widget_contents = array();			
			
if($content['RenderingMode'] == "manual")
{

$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , "" ,$content['mode'], $content['show_max_article']); 	


// content list iteration block - Looping through content list and adding it the list
// content list iteration block starts here

if (function_exists('array_column'))  {
$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
}
else {
$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
}

$get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='') {

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
					
}
else
{
//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);

	if($view_mode=="live"){
				$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
				
		}else{
			  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
		
			if (function_exists('array_column')) {
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			} else{
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
//getting content block ends here
//Widget code block - code required for simple tab structure creation. Do not delete
//Widget code block Starts here

$show_simple_tab .='<div class="col-lg-6 col-md-12 col-sm-6 col-xs-12    week-pair cart">';
$show_simple_tab.=	'<div class="box-botton child-button">';
$show_simple_tab.='<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
$show_simple_tab.=	'</div>';


//Widget code block ends here

if(count($widget_contents)>0)
{
$i =1;

$show_simple_tab.=	'<div class="box-one pair-box all-story bx1">
                    <div class="slider pair-auto ">';               

foreach($widget_contents as $get_content) {

$original_image_path = "";
$imagealt            = "";
$imagetitle          = "";
$custom_title        = "";
$custom_summary      = "";
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
if($original_image_path =="")                                                // from cms || live table    
{
$original_image_path  = $get_content['ImagePhysicalPath'];
$imagealt             = $get_content['ImageCaption'];	
$imagetitle           = $get_content['ImageAlt'];	
}
$show_image="";	


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
$show_image = image_url. imagelibrary_image_path . $Image600X300;
}	
else 
{
$show_image	= image_url. imagelibrary_image_path.'logo/custom120x180.jpg';
}
$dummy_image	= image_url. imagelibrary_image_path.'logo/custom120x180.jpg';



$content_url = $get_content['url']; 
$param = $content['close_param'];
$vara_ithaigal = array(0=>'weekly-supplements/dinamani-kathir', 1=> 'weekly-supplements/tamilmani', 2=> 'weekly-supplements/siruvarmani', 3=> 'weekly-supplements/vellimani', 4=>'weekly-supplements/magalirmani', 5 => 'weekly-supplements/ilaignarmani');
$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;
$section_url = (($get_seperation_count==2)? $url_array[1] : $url_array[0]."/".$url_array[1]."/".$url_array[2]);
$matches = preg_grep('/'.$section_url.'/', $vara_ithaigal); 
$keys    = array_values($matches); 
$live_article_url = $domain_name.$keys[0];

if( $custom_title == '')
{
$custom_title = $get_content['title'];
}	
$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
// Assign summary block starts here
/*	if( $custom_summary == '')
{
$custom_summary =  $get_content['summary_html'];
}
$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	*/
//  summary block endss here

$show_simple_tab .= '<div><figure class="ithal-date"><a  href="'.$live_article_url.'"> <img src="'.$dummy_image.'"  title = "'.$imagetitle.'" data-src="'.$show_image.'" alt = "'.$imagealt.'"> <time>'.date('d.m.Y',strtotime(@$get_content['publish_start_date'])).'</time></a> </figure></div>';


if($i == count($widget_contents))
{
$show_simple_tab .= '</div></div></div>';
}
// display title and summary block ends here					
//Widget design code block 1 starts here																
//Widget design code block 1 starts here			
$i =$i+1;	

}
/*}else
{
$show_simple_tab .='</div>';
} */
}else {
if($view_mode=="adminview") {
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
$show_simple_tab .='</div>';
} else {
$show_simple_tab .='</div>';
}
}
						

$show_simple_tab .='</div></div></div></div></div></div>';
echo $show_simple_tab;
							

?>
<script>
$('.pair-auto').slick({
        dots: true,
        infinite: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
  arrows: false
      });
</script>