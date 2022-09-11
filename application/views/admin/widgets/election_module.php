<?php
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
?>
<style>
@import url('https://fonts.googleapis.com/css?family=Meera+Inimai');
.election_module{
	background:#fff9eb;
	float:left;
	margin-top:1%;
	padding:5px;
	width:100%;
	border: 1px solid #e4e4e4;
}
.election_module_col{
	padding:0;
}
.election_module_col img:nth-of-type(1){ box-shadow: 1px 1px 1px 1px #a29b9b;}
.split-25,.split-75{float:left;}
.split-25{width:25%;}
.split-75{width:75%;padding-left: 6px;}
.split-75 h5{font-size: 10.5px !important;margin: 0 !important;color:#ff6c00 !important;font-family: 'Meera Inimai', sans-serif;}
.split-75 h4{margin: 0 !important;margin-top: 3px !important;font-size: 12px !important;font-weight: bold !important;color:#000 !important;font-family: 'Meera Inimai', sans-serif;}
.split-75 h4 span{font-weight: normal !important; font-size: 12px !important;color: #808080 !important;font-family: 'Meera Inimai', sans-serif;}
.el_blink{	animation: blink 1s infinite; }
@keyframes blink{
	0%{opacity: 1;}
	75%{opacity: 1;}
	76%{ opacity: 0;}
	100%{opacity: 0;}
}
</style>
<div class="top-title"><h4 style="margin:0;"><i class="fa fa-backward"></i> <p  class="el_blink" style="margin:0;font-size: 13px;color: #0d0ad0!important;"> ஆர்.கே. நகர் தொகுதி இடைத்தேர்தல் வாக்கு எண்ணிக்கை நிலவரம்</p> <i class="fa fa-forward"></i></h4></div>
<div class="election_module section_<?php echo $widget_instance_id; ?>">
	<span class="text-center" style="float:left;width:100%;"><i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></span>
</div>
<script>

function elec_response(){
setTimeout(function(){
$.ajax({
	type:'post',
	cache:false,
	url:'<?php echo BASEURL ?>user/commonwidget/fetchelectionmodule',
	data:{'widgetinstance':'<?php echo $widget_instance_id; ?>'},
	dataType:'html',
	success:function(result){
		$('.section_<?php echo $widget_instance_id; ?>').html(result);
		elec_response();
	}
});

}, 4000);
}
elec_response();
</script>
