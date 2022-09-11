<?php 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_instance_id	 	= $content['widget_values']['data-widgetinstanceid'];
$view_mode              = $content['mode'];
$widget_instance_details= $this->widget_model->getWidgetInstance('', '','', '', $widget_instance_id, $content['mode']);
$widget_position = $content['widget_position'];	 
$height = ($widget_instance_details['AdvertisementScript']=='')? 430 : $widget_instance_details['AdvertisementScript'];
// widget config block ends
?>
<style>
	.container1 ul, .container1 ul li {margin: 0;list-style: none;clear:both;width:100%;color:#000;padding: 0 2px 0;margin-bottom:4%;}
	.container1 {width:100%;height: <?php echo $height; ?>px;line-height: 18px; border-radius:0px; overflow: Hidden;color:#fff; padding: 2px 0;}
	 .container1:hover{overflow-y:scroll;}
	.date-color{font-size: 13px;color: #000;float:left;width:18.4%;font-weight:bold;text-align:center;}
	.content-color{float:left;width:81.6%;} 

	.container1::-webkit-scrollbar {width: 12px;}
 .container1::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); border-radius: 10px;}
 .container1::-webkit-scrollbar-thumb {border-radius: 10px; -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);}
 .container1 ul{background:#f2f2f2;float:left;}
 .container1 ul li{background:#fff;margin: 7px 6px 7px;width: 96%;padding: 2%;box-shadow: 1px 1px 1px #00000052;float:left;}
 .date-color a{float: left;width: 100%;font-size: 15px;margin-top: 4px;color: #1DA1F2;}
</style>

<div style="float:left;display:block;"><figure class="bg-left"></figure><figure class="bg-center1"><?php ($widget_instance_details['CustomTitle']=='')? print 'Highlights' : print $widget_instance_details['CustomTitle']; ?></figure><figure class="bg-right"></figure></div>
<div class="container1 scroll-static-<?php echo $widget_instance_id ?>">
	
</div>
<script type="text/javascript" src="<?php print image_url.'js/FrontEnd/js/jQuery.scrollText.js' ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				type:'post',
				cache:false,
				url:'<?php print BASEURL ?>user/scroll_data/render_news',
				success:function(result){
					$('.container1').html(result);
						 $(".container1").scrollText({
							'duration': 1500,
							'ulheight': $('.scroll-static-<?php echo $widget_instance_id ?>').find('ul').eq(0).height()
						}); 
				}
			
			});
			$(document).on('click','.custom_social',function(){
				var url= encodeURIComponent("<?php echo BASEURL.uri_string();?>");
				var text=encodeURIComponent($(this).parents('.date-color').next('.content-color').text());
				$(".fb_share").attr("href", "https://www.facebook.com/sharer/sharer.php?u="+url+'&title='+text);
				$(".twitter_share").attr("href", "https://twitter.com/intent/tweet?text="+ url+'  '+ text+'via @DINAMANI');
			});
		});
		 
	</script>

