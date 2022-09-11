<?php
$style 		= str_replace(["style='background-color:" ,";'"] ,"" ,$content['widget_bg_color']);
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$view_mode 			= $content['mode'];
?>
<div class="row" id="section_content_check_<?php echo $widget_instance_id;?>" style="display:none;">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div id="parentHorizontalTab<?php echo $widget_instance_id;?>">
<div class="most-read-content">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ul class="resp-tabs-list hor_1 most-read-li">
<li id="most_read_tab">அதிகம் </br>படிக்கப்பட்டவை</li>
<li id="most_email_tab">அதிகம் </br>பகிரப்பட்டவை </li>
<!--<li id="most_commented_tab">அதிகம் </br>விமரிசிக்கப்பட்டவை</li>-->
</ul>
</div>
</div>
<div class="resp-tabs-container hor_1 cinema-tab">
<div>
<div class="row">
<article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ul class="lead-list more-read" id="most_read">
</ul>
<article>
</div>
</div>
<div>
<div class="row">
<article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ul class="lead-list more-read" id="most_email">
</ul>
<article>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
<?php if($style==2): ?>
if(screen.width > 800 || document.documentElement.clientWidth > 800) {
	document.getElementById("section_content_check_<?php echo $widget_instance_id?>").parentNode.parentNode.parentNode.removeChild(document.getElementById("section_content_check_<?php echo $widget_instance_id?>").parentNode.parentNode);
}else{
	document.getElementById("section_content_check_<?php echo $widget_instance_id?>").style.display ="block";
}
<?php else: ?>
if(screen.width < 800 || document.documentElement.clientWidth < 800) {
	document.getElementById("section_content_check_<?php echo $widget_instance_id?>").parentNode.parentNode.parentNode.removeChild(document.getElementById("section_content_check_<?php echo $widget_instance_id?>").parentNode.parentNode);
}else{
	document.getElementById("section_content_check_<?php echo $widget_instance_id?>").style.display ="block";
}
<?php endif; ?>
</script>
<script type="text/javascript">

var most_article = function(){
var most_type = '';
var most_name = '';

obj = {};

obj.Init = function(most_type){
most_name = most_type;
}

obj.Start = function(){
document.getElementById(most_name).innerHTML = '<div class="cssload-container" id="add_article_process_imgtest" style="display:block;"><div class="cssload-zenith"></div></div>';
}

obj.FillMostRead = function() {
$.ajax({
url			: '<?php echo base_url(); ?>user/commonwidget/get_most_read_content',
method		: 'get',
data		: { type: most_name, param: '<?php echo $content['close_param'];?>',mode:'<?php echo $view_mode;?>'},
success		: function(result){ 
$('#'+most_name).html(result).hide().fadeIn({ duration: 2000 });
},
error: function (error) {			
document.getElementById(most_name).innerHTML = 'Failed to load the content...';
}
});
}	


return obj;

};


var most_read = most_article();
var most_email = most_article();

most_read.Init('most_read');
most_read.Start();
most_read.FillMostRead();

$(document).ready(function() {
$('#parentHorizontalTab<?php echo $widget_instance_id;?>').easyResponsiveTabs({ activate: function(event, tab){
//alert('tab');

//accordion load
var list =$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-tab-item').attr('aria-controls');
var accord=$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion').attr('aria-controls');
//console.log(accord);
var itemCount = 0;
$( "#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-tab-item" ).each(function() {
if(list==accord){
var idattr = $(this).attr('id');
var category_attr = $(this).attr('data-contentype');
$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('id',idattr);
$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('data-contentype',category_attr);
}
itemCount++;
});

if ($(this).attr('id') == 'most_read_tab'){
most_read.Init('most_read');
most_read.Start();
most_read.FillMostRead();
}
if ($(this).attr('id') == 'most_email_tab'){ // most_email_tab //most_commented_tab
most_email.Init('most_email');  //most_email //most_comments
most_email.Start();
most_email.FillMostRead();
}
},

});
});
</script>
