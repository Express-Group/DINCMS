<?php 
$css_path 		= base_url()."css/FrontEnd/";
$js_path 		= base_url()."js/FrontEnd/";
?>
<script src="<?php echo $js_path; ?>js/breakingNews.js"></script>
<link rel="stylesheet" href="<?php echo $css_path; ?>css/breakingNews.css" type="text/css">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php 
			$view_mode = $content['mode'];
			$param = $content['page_param'];
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
					$live_article_url = $domain_name.$content_url."?pm=".$param;					
					$news_content = '<a  href="'.$live_article_url.'" class="article_click"  >'.$news_title.'</a>';
				}
				else
				{
					$news_content = $news_title;
				}
				
				$news .=  '<li>'.$news_content.'</li>';
			}		

			?>
    <div class="breakingNews line bn-bordernone bn-red" id="bn1">
      <div class="bn-title breaking" style="width: auto;">
        <h2 style="display: inline-block;">சுடச்சுட</h2>
        <span class="arrow-right-break"></span></div>
      <ul>
        <?php echo $news; ?>
      </ul>
      <div class="bn-navi"> <span></span> <span></span> </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() { 
setInterval(function(){
        $(".breaking").toggleClass("blinking");
		$(".arrow-right-break").toggleClass("blinking-arrow");
     },500);
   });
   $(window).load(function(e) {
        $("#bn1").breakingNews({
			effect		:"slide-h",
			autoplay	:true,
			timer		:<?php if($scroll_speed['breakingNews_scrollSpeed'] != "" && $scroll_speed['breakingNews_scrollSpeed'] != 0) { echo $scroll_speed['breakingNews_scrollSpeed']*1000; } else { echo 3000; } ?>,
			color		:"red"
		});
			});
</script>

