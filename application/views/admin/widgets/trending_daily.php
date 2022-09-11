<?php
$widget_bg_color 		= $content['widget_bg_color'];
$widget_instance_id	 	= $content['widget_values']['data-widgetinstanceid'];
$view_mode              = $content['mode'];
$is_home                = $content['is_home_page'];	
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 trending-today<?php echo $widget_instance_id; ?>">
		<div class="trending-daily">
		</div>
	</div>
</div>
<script>
$(document).ready(function(e){
	$.ajax({
		type:'get'
	});
	 $.get("<?php echo BASEURL; ?>user/commonwidget/trending_tags", function(data, status){
		 $('.trending-daily').html(data);
	});
});
</script>