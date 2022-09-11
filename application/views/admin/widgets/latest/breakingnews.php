<?php
$widgetInstanceId  =  $content['widget_values']['data-widgetinstanceid'];
?>
<div class="breaking-news">
	<div class="breaking-title"><h2><b class="trans">உடனுக்கு உடன் </b><b class="trans">செய்திகள் </b></h2><span></span></div>
	<div class="ui-newsticker"><ul class="marquee-with-options"></ul></div>
	</div>
</div>
<script type="text/javascript" src="<?php echo image_url; ?>js/FrontEnd/js/jquery.marquee.min.js"></script>
<script>
$(document).ready(function(){
	
	$.ajax({

		type:"post",
		cache:false,
		url:"<?php echo BASEURL ?>user/commonwidget/get_breaking_news_contents",
		data : { type: "1", param: '<?php echo $content['close_param'];?>',mode:'<?php echo $content['mode'];?>', is_home: '<?php echo $content['is_home_page'];?>'},
		success:function(result){
			$('.ui-newsticker').find('ul').html(result).promise().done(function(){
				$('.marquee-with-options').marquee({
					speed: 40,
					delayBeforeStart: 0,
					direction: 'left',
					duplicated: true,
					pauseOnHover: true
				});
			});
			
		},
		error:function(errcode,errstatus){
			//alert('erro');
			}
	
	});
});
var a = $('.trans');
a = Array.prototype.slice.call(a);

var timings = {
  easing: 'ease-in-out',
  iterations: Infinity,
  direction: 'alternate',
  fill: 'both'
}

a.forEach(function(el, i, ra) {
  timings.delay = i  * 2000;
  
  timings.duration = 5000;
  el.animate([
    {transform: 'rotateX(180deg)'},
    {transform:'rotateX(-180deg)'}
  ], timings);
  
  timings.duration = 2000;
  el.animate([
    {opacity: 1},
    {opacity: 0}
  ], timings);
  
  timings.duration = 2000;
 
});
</script>