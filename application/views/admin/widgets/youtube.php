<?php
$view_mode = $content['mode'];
$header_details = $this->widget_model->select_setting($view_mode);
$youtubejson = $header_details['youtube_json'];
if($youtubejson!=''){
	$youtubejson = json_decode(base64_decode($youtubejson) , true);
}else{
	$youtubejson  = [];
}
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5 class="din-title"><a target="_BLANK" href="https://www.youtube.com/channel/UC3jcdpf8dWtljex9PyhSM6w/videos"> தினமணி யுடியூப் சேனல்</a></h5>
	</div>
</div>
<?php if(count($youtubejson) > 0): ?>
<!--<h5 class="youtube-title"><span>செய்திகள் சில வரிகளில்</span></h5>-->
<div class="youtube-slider">
<?php
$dummyImage= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
$row = 1;
foreach($youtubejson as $get_content):
	$Image = $get_content['medium_thumbnails']['url'];
	$title = (mb_strlen($get_content['title']) > 42) ? mb_substr($get_content['title'] , 0 ,39).'...' : $get_content['title'];
	if($row==1){
	echo '<div class="col-xs-12 col-sm-12 col-md-4 col-xl-4 col-xl-4">';
	}
	echo '<div class="slider-wrapper">';
	echo '<div class="slider-inner-wrapper">';
	echo '<a href="https://www.youtube.com/watch?v='.$get_content['videoid'].'" target="_BLANK"><img data-src="'.$Image.'" class="img-responsive"><img src="'.image_url.'images/FrontEnd/images/yt_logo.png" class="img-responsive"></a>';
	echo '</div>';
	echo '<p><a href="https://www.youtube.com/watch?v='.$get_content['videoid'].'" target="_BLANK">'.$title.'</a></p>';
	echo '</div>';
	if($row==2){
	echo '</div>';
	$row = 1;
	}else{
		$row++;
	}
endforeach;
if($row!=1){
echo '</div>';	
}
?>
</div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".youtube-slider").slick({dots:!1,infinite:!0,speed:500,slidesToShow:3,slidesToScroll:1,autoplay:true,arrow:true,prevArrow: '<button class="slider-prev"><img src="<?php echo image_url; ?>images/FrontEnd/images/left.png" /></i></button>',nextArrow: '<button class="slider-next"><img src="<?php echo image_url; ?>images/FrontEnd/images/right.png" /></i></button>',responsive:[{breakpoint:768,settings:{slidesToShow:1}}]})});
</script>