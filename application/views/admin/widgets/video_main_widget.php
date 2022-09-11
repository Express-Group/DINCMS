<style>
	.video_widget_title{ float:left;width:100%; padding :1% 1% 0;}
	.video_widget_title span{ font-size:23px; float:left;font-weight: bold; border-bottom: 1px solid #fff; border-bottom-width: 3px;margin-top: 5px;}
	.video_widget_title span a{float: left; color: #fa9000 !important; text-transform: uppercase; padding-bottom: 3px;}
    .video_widget_title .pull-right ul li {float: left; padding:5px 12px ;font-size: 13px;cursor:pointer; font-weight: bold;}
	.video_widget_title .pull-right ul li a , .video_widget_title .pull-right ul li a:hover { color: #fff !important; text-transform:uppercase;}
	.video-first-content{ position: absolute; bottom: 0;  padding: 0 2%;background:linear-gradient(to bottom,transparent 0,rgba(0,0,0,1) 80%);width:100%}
	.video-first-content h4 a{font-size: 17px;font-weight: bold;color: #fff !important;}
	.video-first-content p.summary{font-size: 12px;}
	.video-second-content{float: left;width: 100%;padding: 2% 2% 2%; background:#052962;}
    .video-second-content:hover{background:rgb(47, 47, 47); }
	.title_head {float: left;width: 100%;}
	.title_head .col-md-5{height: 360px; overflow-y: scroll;float: left;overflow-x: hidden;}
	.video-second-content h5{margin:0;}
	.video-second-content h5 a{color:#fff !important;font-weight:bold !important;font-size:12px;}
	.video-second-content h5:first-child a , .video-first-content h5:first-child a{color:#ffe500 !important;font-weight:bold !important;}
	.video-first-content .summary{color:#fff;}
	.title_head .col-md-5::-webkit-scrollbar{width: 5px;}
	.title_head .col-md-5::-webkit-scrollbar-track{background: #052962;}
	.title_head .col-md-5::-webkit-scrollbar-thumb {background: #fa9000;}
	@media only screen and (min-width: 1551px){
		.title_head .col-md-5{height: 429px;}	
	}
	@media only screen and (max-width: 768px){
		.video_widget_title .pull-right ul{display:none;}
		.video_widget_title .pull-right select{display:block !important;}
		.title_head .col-md-5{height: auto !important;padding:0;}
		.video-first-content{position:relative;}
		.video-second-content .col-md-4 ,.video-second-content .col-md-8{padding:0;}
		.video-second-content h5 a{font-size:21px;}
	}
</style>
<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article         = $content['show_max_article'];
$render_mode         = $content['RenderingMode'];
$content_type = $content['content_type_id'];
$section_id = $content['sectionID'];
// widget config ends..
$baseUrl = $domain_name = base_url();
$CI = &get_instance();
$this->live_db = $this->load->database('live_db', TRUE);
$show_simple_tab = "";
$widget_custom_title = ($widget_custom_title !="") ? $widget_custom_title : 'Videos'; 
if(strtolower($widget_custom_title)!='none'){
	$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
	if($content['widget_title_link'] == 1){
		$show_simple_tab.='<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
	}else{
		$show_simple_tab.='<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
	}
	$show_simple_tab .='</div></div>';
}
$show_simple_tab .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-15"><div class="allvideo"  style="background-color:#052962;float: left;">';

$sub_section_valid='';
if($render_mode == "manual"){
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id, " ", $view_mode, $max_article);
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 
	$widget_contents = array();
	if($get_content_ids!=''){
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}	
}else{
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
if(count($widget_contents)>0){
	$count=1;
	$show_simple_tab.='<div class="title_head">';
	foreach($widget_contents as $get_content){
		$custom_title = $original_image_path =  $imagealt = $imagetitle  = $Image600X390 = $custom_summary = "";
		if($render_mode == "manual"){
			if($get_content['custom_image_path'] != ''){
				$original_image_path = $get_content['custom_image_path'];
				$imagealt            = $get_content['custom_image_title'];	
				$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title            = stripslashes($get_content['CustomTitle']);
			$custom_summary = $get_content['CustomSummary'];
		}
		
		if($original_image_path ==""){
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt             = $get_content['ImageCaption'];	
			$imagetitle           = $get_content['ImageAlt'];	
		}
		$show_image= $show_image1 = "";
		$dummy_image	 = image_url.imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		$dummy_image1	 = image_url.imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';

		if($original_image_path !=''){
			$Image600X390  = str_replace("original","w600X390", @$original_image_path);								
			$Image600X300  = str_replace("original","w600X300", @$original_image_path);								
			if(get_image_source($Image600X390, 1) && $Image600X390 != ''){
				$show_image = image_url. imagelibrary_image_path . $Image600X390;
				$show_image1 = image_url. imagelibrary_image_path . $Image600X300;
			}else{
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				$show_image1	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}
		}else{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			$show_image1	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
		}
		
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name. $content_url.$param;
		$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
		if( $custom_summary == '' && $render_mode=="auto"){
			$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary); 
		$articleSectionId = $get_content['section_id'];
		$sectionDetails = $this->live_db->query("CALL get_section_by_id('".$articleSectionId."')")->row_array();
		if($count==1){
			$show_simple_tab .='<div class="col-md-7 col-sm-7"><div class="row" style="position:relative;">';
			$show_simple_tab .='<a href="'.$live_article_url.'"><img src='.$dummy_image1.' data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" class="img-responsive"></a>';
            $show_simple_tab .='<div class="video-first-content">'; 
		    $show_simple_tab .='<h5><a href='.$baseUrl.$sectionDetails['URLSectionStructure'].' class="link_title" >'.$sectionDetails['Sectionname'].'</a></h5>';
		    $show_simple_tab .='<h4><a href='.$live_article_url.' class="link_title" >'.$display_title.'</a></h4>';
			$show_simple_tab .='<p class="summary">'.$summary.'</p>';                 
            $show_simple_tab .='</div></div></div>';
		}else{
			if($count==2){
				$show_simple_tab .='<div class="col-md-5 col-sm-5 padding-right-0">';
			}
			$show_simple_tab.='<div class="video-second-content">';
			$show_simple_tab.='<div class="col-md-4 col-sm-4 col-xs-4 padding-left-0"><div class="row">';
			$show_simple_tab.='<a href='.$live_article_url.' target="_blank"><img src='.$dummy_image.' data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" class="img-responsive"></a>';
			$show_simple_tab.=' </div></div>';
			
			$show_simple_tab.='<div class="col-md-8 col-sm-8 padding-right-0">';
			$show_simple_tab.='<h5><a href='.$baseUrl.$sectionDetails['URLSectionStructure'].' target="_blank">'.$sectionDetails['Sectionname'].'</h5><h5><a href='.$live_article_url.'>'.$display_title.'</a></h5>';
			$show_simple_tab.='</div></div>';
		}
		
		if($count==count($widget_contents)){
			$show_simple_tab .='</div>';
		}
		
		
	 $count++;
	}
	$show_simple_tab.='</div>';
	
}
$show_simple_tab .='</div></div></div>';
echo $show_simple_tab;
?>
