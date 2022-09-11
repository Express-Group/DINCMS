<?php
$widgetInstanceId  =  $content['widget_values']['data-widgetinstanceid'];
?>
<div class="justin_wrapper">
	<div class="justin_layer"><h3 class="justin_title">சுடச்சுட</h3></div>
	<div class="marquee_outer_layer">
		<div class="list-wrpaaer marquee-layer">
			<ul class="list-aggregate" id="marquee-horizontal-<?php echo $widgetInstanceId;?>"></ul>
		</div>
	</div>
</div>
<script>
!function(a){function b(b,e){this.element=b,this.settings=a.extend({},d,e),this._defaults=d,this._name=c,this.version="v1.0",this.$element=a(this.element),this.$wrapper=this.$element.parent(),this.$items=this.$element.children(this.settings.itemSelecter),this.next=0,this.timeoutHandle,this.intervalHandle,this.settings.enable&&this.init()}var c="marquee",d={enable:!0,direction:"vertical",itemSelecter:"li",delay:3e3,speed:1,timing:1,mouse:!0};b.prototype={init:function(){var b=this,c=0;a.each(this.$items,function(d,e){c+=parseInt(b.isHorizontal()?a(e).outerWidth():a(e).outerHeight())});var d=this.isHorizontal()?this.$element.outerWidth:this.$element.outerHeight;d>c||(this.$wrapper.css({position:"relative",overflow:"hidden"}),this.$element.css({position:"absolute",top:0,left:0}),this.$element.css(this.isHorizontal()?"width":"height","1000%"),this.cloneAllItems(),this.settings.mouse&&this.addHoverEvent(this),this.timer(this))},timer:function(a){this.timeoutHandle=setTimeout(function(){a.play(a)},this.settings.delay)},play:function(b){this.clearTimeout();for(var c=0,d=0;d<=this.next;d++)c-=parseInt(this.isHorizontal()?a(this.$items.get(this.next)).outerWidth():a(this.$items.get(this.next)).outerHeight());this.intervalHandle=setInterval(function(){b.animate(c)},this.settings.timing)},animate:function(a){var b=this.isHorizontal()?"left":"top",c=parseInt(this.$element.css(b));c>a?c-this.settings.speed<=a?this.$element.css(b,a):this.$element.css(b,c-this.settings.speed):(this.clearInterval(),this.next+1<this.$items.length?this.next++:(this.next=0,this.$element.css(b,0)),this.timer(this))},isHorizontal:function(){return"horizontal"==this.settings.direction},cloneAllItems:function(){this.$element.append(this.$items.clone())},clearTimeout:function(){clearTimeout(this.timeoutHandle)},clearInterval:function(){clearInterval(this.intervalHandle)},addHoverEvent:function(a){this.$wrapper.mouseenter(function(){a.clearInterval(),a.clearTimeout()}).mouseleave(function(){a.play(a)})}},a.fn[c]=function(d){return this.each(function(){a.data(this,"plugin_"+c)||a.data(this,"plugin_"+c,new b(this,d))})}}(jQuery,window,document);

$(document).ready(function(){
	
	$.ajax({

		type:"get",
		cache:false,
		url:"<?php echo BASEURL ?>user/commonwidget/get_breaking_news_contents",
		data : { type: "1", param: '<?php echo $content['close_param'];?>',mode:'<?php echo $content['mode'];?>', is_home: '<?php echo $content['is_home_page'];?>'},
		success:function(result){
			$('#marquee-horizontal-<?php echo $widgetInstanceId;?>').html(result);
			$('#marquee-horizontal-<?php echo $widgetInstanceId;?>').marquee({direction:'horizontal'});
		},
		error:function(errcode,errstatus){
			//alert('erro');
			}
	
	});

});

</script>