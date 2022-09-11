<link rel="stylesheet" href="<?php echo image_url; ?>css/FrontEnd/css/breakingNews.css" type="text/css">
<div class="row mobile-ad">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php /*?><?php 
			$view_mode = $content['mode'];
			$param = $content['close_param'];
			$breaking_news = $this->widget_model->get_widget_breakingNews_content($view_mode);
			
			$scroll_speed = $this->widget_model->select_setting($view_mode);
			$news = "";
			$domain_name =  base_url();
			foreach($breaking_news as $news_content)
			{
				$news_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $news_content['Title']);   //to remove first<p> and last</p>  tag
				if($news_content['Content_ID'] != '')
				{
					$content_type = 1;
					$is_home = 'n';
					if($view_mode=='live'){
					$content_details = $this->widget_model->get_contentdetails_from_database($news_content['Content_ID'], $content_type,$is_home, $view_mode);					
					$content_url = $content_details[0]['url'];
					}else{
					$content_url = $news_content['url'];
					}
					$live_article_url = $domain_name.$content_url.$param;					
					$news_content = '<a  href="'.$live_article_url.'" class="article_click"  >'.$news_title.'</a>';
				}
				else
				{
					$news_content = $news_title;
				}
				
				$news .=  '<li>'.$news_content.'</li>';
			}		

			?><?php */?>
    <div class="breakingNews line bn-bordernone bn-red" id="bn1">
      <div class="bn-title breaking">
        <h2>சுடச்சுட</h2>
        <span class="arrow-right-break"></span></div>
      <div class="top-breaking" id="breaking_news">
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() { 
setInterval(function(){
        $(".breaking").toggleClass("blinking");
		$(".arrow-right-break").toggleClass("blinking-arrow");
     },500);

		 $.ajax({
			url			: '<?php echo base_url(); ?>user/commonwidget/get_breaking_news_content',
			method		: 'get',
			dataType    : 'json',
			data		: { type: "1", param: '<?php echo $content['close_param'];?>',mode:'<?php echo $content['mode'];?>', is_home: '<?php echo $content['is_home_page'];?>',},
			beforeSend	: function() {				
			},
			success		: function(result){ 
			console.log(result);
			if(result.news.trim()!='no_news'){
				   $(".line").css("visibility", "visible");
				   $(".line").fadeIn();
				   $('#breaking_news').html(result.news).hide().fadeIn({ duration: 1000 });
				    $('.top-breaking').slick({       
					        dots: false,
							infinite: true,
							speed: 1000,
							autoplaySpeed: parseInt(result.scroll_amount),
							slidesToShow: 1,
							autoplay: true,
					        arrows: true,
							slidesToScroll: 1
						});
					$('.slick-prev').addClass('fa fa-chevron-left');
					$('.slick-next').addClass('fa fa-chevron-right');	
			}else{
			 $(".line").css("visibility", "hidden");
			}
				   }			
		});
			});
</script>

