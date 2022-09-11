<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article         = $content['show_max_article'];
$mainSection = (int) $content['widget_values']['cdata-widgetCategory'];
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db' , true);
$subSection = [];
if($mainSection!=''){
	$subSection = $this->live_db->select('Section_id, URLSectionStructure, Sectionname')->from('sectionmaster')->where(['Status' => 1 , 'ParentSectionID' => $mainSection])->order_by('DisplayOrder' , 'ASC')->get()->result();
}

$show_simple_tab  = "";
$show_simple_tab .='<div class="row">';
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
if($widget_custom_title!=''){
$show_simple_tab .='<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
}
$show_simple_tab .='<div class="ws-slider margin-bottom-15">';
foreach($subSection as $section){
	$style="#00974c";
	$show_simple_tab .='<div class="ws-slider-item">';
	if($section->Sectionname=='இளைஞர்மணி'){
		$show_simple_tab .='<h5 style="border-top:3px solid #ec8b23;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/01.png"  src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#ec8b23";
	}else if($section->Sectionname=='தினமணி கதிர்'){
		$show_simple_tab .='<h5 style="border-top:3px solid #ef1c26;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/02.png" src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#ef1c26";
	}else if($section->Sectionname=='தினமணி கொண்டாட்டம்'){
		$show_simple_tab .='<h5 style="border-top:3px solid #6dc4e1;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/03.png" src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#6dc4e1";
	}else if($section->Sectionname=='மகளிர்மணி'){
		$show_simple_tab .='<h5 style="border-top:3px solid #233a80;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/04.png"  src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#233a80";
	}else if($section->Sectionname=='சிறுவர்மணி'){
		$show_simple_tab .='<h5 style="border-top:3px solid #d23890;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/05.png" src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#d23890";
	}else if($section->Sectionname=='வெள்ளிமணி'){
		$show_simple_tab .='<h5 style="border-top: 3px solid #f31219;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/06.png" src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#f31219";
	}else if($section->Sectionname=='தமிழ்மணி'){
		$show_simple_tab .='<h5 style="border-top: 3px solid #00974c;"><a href="'.BASEURL.$section->URLSectionStructure.'"><img data-src="'.image_url.'images/FrontEnd/images/weekly-suplements/07.png" src="'.image_url.'images/FrontEnd/images/weekly-suplements/default.png" class="img-responsive"></a></h5>';
		$style="#00974c";
	}else{
		$show_simple_tab .='<h5><a style="color:#052962;" href="'.BASEURL.$section->URLSectionStructure.'">'.$section->Sectionname.'</a></h5>';
	}
	
	$show_simple_tab .='<div class="ws-slider-item-content">';
	$articleList = $this->live_db->query("SELECT title, url FROM article WHERE section_id='".$section->Section_id."' AND status='P' AND publish_start_date < NOW() ORDER BY publish_start_date DESC LIMIT ".$max_article."")->result_array();
	$j =1;
	foreach($articleList as $article){
		$show_simple_tab .='<a '.(($j==$max_article) ? ' style="border:none;"' : '').'href="'.BASEURL.$article['url'].'"><p>'.strip_tags($article['title']).'</p></a>';
		$j++;
	}
	$show_simple_tab .='</div>';
	$show_simple_tab .='<a style="background:'.$style.';" href="'.BASEURL.$section->URLSectionStructure.'" class="more">மேலும் <i class="fa fa-arrow-right"></i></a>';
	$show_simple_tab .='</div>';
}
$show_simple_tab .='</div>';

$show_simple_tab .='</div>';
$show_simple_tab .='</div>';
echo $show_simple_tab;
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.ws-slider-item').show();
	$(".ws-slider").slick({dots:!1,infinite:!0,speed:2500,slidesToShow:3,slidesToScroll:1,autoplay:true,arrow:true,prevArrow: '<button class="slider-prev"><img src="https://images.dinamani.com/images/FrontEnd/images/left.png" /></i></button>',nextArrow: '<button class="slider-next"><img src="https://images.dinamani.com/images/FrontEnd/images/right.png" /></i></button>',responsive:[{breakpoint:768,settings:{slidesToShow:1}}]});
	var wsArray = [];
	$('.ws-slider-item').each(function(){wsArray.push($(this).height());});
	$('.ws-slider-item').height(Math.max(...wsArray));
});
</script>