<style>

</style>
<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$view_mode = $content['mode'];
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h5 class="din-title"><a>பஞ்சாங்கம் / இன்றைய ராசி பலன்கள்</a></h5>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 panchangam-container">
		<p class="text-center"><i class="fa fa-refresh fa-spin"></i></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(e){
		$.ajax({
			url : '<?php echo BASEURL; ?>user/commonwidget/getPanchangamDetails',
			method : 'POST',
			dataType : 'HTML',
			success : function(result){ 
				$('.panchangam-container').html(result);
			},
			error: function(err ,errcode){
				console.log(errcode);
			}						
		});
	});
</script>