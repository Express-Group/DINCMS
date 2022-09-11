<style>
	.panchangam-heading { background: #ffcb05; text-align: center; color: #fff;}
	.panchangam-heading p{margin: 0; padding: 1rem 0; font-weight: 700;}
	.panchangam-heading p span:first-child{font-size: 2.2rem;}
	.panchangam-heading p span:last-child{color: #9b0706; font-size: 1.1rem;}
	
	.panchangam-footer{display: block; border: 2px solid #ffcb05; border-bottom: none; border-top: none; background: #fff; overflow: unset;}
	.panchangam-footer table{border-color: #ffcb05; border-top: none;  border-left: none; width: 100%;}
	.panchangam-footer td{padding: 0;}
	.panchangam-footer p span { color: #9b0707; font-weight: 700;}
	.panchangam-footer p{font-weight: bold; margin: 0; font-size: 1.1rem; padding: 1rem; color: #000;}
	
	.panchangam-content { padding: 0.1rem 1rem; border: 2px solid #ffcb05; border-top: none; background: #00988c;}
	.panchangam-content .col-lg-2{padding-right: 0; padding-left: 10px;}
	.panchangam-content .zodiac-item img{border-radius: 50%; margin-right: 3px;width: 30px; float: left;}
	.panchangam-content .zodiac-item p{margin: 0; padding: 1rem 0; font-size: 11px; font-weight: 700; color: #ffcb05;}
	
	@media (max-width: 767px){
		.panchangam-heading p span:first-child{font-size: 1.6rem;}
		.panchangam-heading p span:last-child{font-size: 1rem !important;}
		.panchangam-content .zodiac-item p{font-weight: unset;}
		.panchangam-footer p{padding: 0.5rem; font-size: 1rem;}
	}
	
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
			url : '<?php echo base_url(); ?>user/commonwidget/getPanchangamDetails',
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