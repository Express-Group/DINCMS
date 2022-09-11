<?php
$widget_bg_color        = $content['widget_bg_color']; 
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();
$header_details = $this->widget_model->select_setting($view_mode);
$youtubejson = $header_details['youtube_json'];
if($youtubejson!=''){
	$youtubejson = json_decode(base64_decode($youtubejson) , true);
}else{
	$youtubejson  = [];
}
$template='';
$template .='<div class="videowidget-first-row">';
$template .='<div class="videowidget-row">';
$template .='<h1 class="video-custom-title"><a target="_BLANK" href="https://www.youtube.com/channel/UC3jcdpf8dWtljex9PyhSM6w/videos"> <i class="fa fa-video-camera" aria-hidden="true"></i> '.$widget_custom_title.'</a><script src="https://apis.google.com/js/platform.js"></script><div style="float: right;margin-top: 4px;    margin-right: 7px;margin-bottom: -5px;"><span style="color: #fff;font-size: 13px;margin-top: 4px;float: left;padding-right: 10px;text-shadow: 1px 1px 2px #000;">எங்கள் தினமணி யுடியூப் சேனலை subscribe செய்ய இங்கே கிளிக் செய்யுங்கள்!</span><div  class="g-ytsubscribe pull-right" data-channelid="UC3jcdpf8dWtljex9PyhSM6w" data-layout="default" data-theme="default" data-count="default"></div></div></h1>'; 
$template .='</div><div class="row-fluid">';
if(count($youtubejson) > 0 ){
	$i=1;
	foreach($youtubejson as $get_content):
		if($i<9)
		{
		$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		$show_image_300 = $get_content['large_thumbnails']['url'];
		if($show_image_300!=''){
		$display_title = '<a target="_BLANK" href="https://www.youtube.com/watch?v='.$get_content['videoid'].'"><i class="fa fa-youtube-play video_iconsmall" aria-hidden="true"></i> '.$get_content['title'].'</a>';
		$template .='<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 video-col-padding-bottom"><div class="video_mask video-col-img-hover"><a href="https://www.youtube.com/watch?v='.$get_content['videoid'].'" target="_BLANK"><img src="'.$dummy_image.'" data-src="'.$show_image_300.'" alt="'.$get_content['title'].'" class="img-responsive"></a><div class="video-small-content">'.$display_title.'</div></div></div>';
		}
		}
		$i++;
	endforeach;
	$template .='</div></div>';

}

echo $template; 
?>
