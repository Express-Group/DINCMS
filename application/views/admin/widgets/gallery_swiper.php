<?php
$widget_custom_title = $content['widget_title'];
$ContentID = (int) $widget_custom_title;
$BaseUrl = base_url();
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db',true);
$galleryDetails = $this->live_db->select('content_id,title,url')->from('gallery')->where(['status'=>'P','content_id'=>$ContentID])->get();
if($galleryDetails->num_rows()==1):
$GalleryMainDetails = $galleryDetails->result();
$Title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $GalleryMainDetails[0]->title);
$ArticleUrl = $BaseUrl.$GalleryMainDetails[0]->url;
$IconUrl =image_url.'images/FrontEnd/images/galicon.png';
$GalleryImageDetails = $this->live_db->query("SELECT gallery_image_path,gallery_image_title,gallery_image_alt FROM gallery_related_images WHERE content_id='".$ContentID."' ORDER BY display_order ASC")->result();
?>
<h4><strong><a href="<?php echo $ArticleUrl; ?>"><?php echo $Title;  ?></a></strong></h4>
<div class="swiper-container" style="margin-bottom:3%;">
	<div class="swiper-wrapper">
		<?php foreach($GalleryImageDetails as $ImageDetails):
				if($ImageDetails->gallery_image_path!=''){
					$image = image_url . imagelibrary_image_path . str_replace("original", "w600X390", $ImageDetails->gallery_image_path);
				}else{
					$image = image_url . imagelibrary_image_path . 'logo/nie_logo_600X390.jpg';
				}
				echo '<div class="swiper-slide" style="position:relative"><a href="'.$ArticleUrl.'"><img src="'.$image.'" class="img-responsive"></a>';
				echo '<p style="float: left;position: absolute;top: 7px;color: #fff;font-size: 16px;left: 2%;"><img src="'.$IconUrl.'" style="width: 43px;"></p>';
				echo '</div>';
			endforeach;
		?>
					 
	</div>
	<div class="swiper-pagination"></div>
	<div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
						
<script>
	var swiper = new Swiper('.swiper-container', {
		effect: 'cube',
		grabCursor: true,
		autoHeight: true,
		cubeEffect: {
			shadow: true,
			slideShadows: true,
			shadowOffset: 20,
			shadowScale: 0.94,
		},
		autoplay: {
			delay: 4000,
			disableOnInteraction: true,
		},
		pagination: {
			el: '.swiper-pagination',
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});
</script>
			
<?php endif; ?>