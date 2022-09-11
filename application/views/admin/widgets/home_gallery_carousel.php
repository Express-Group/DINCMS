<style>
@charset "UTF-8";.partialViewSlider-outerwrapper{position:relative}.partialViewSlider-outerwrapper.partialViewSlider-outsideControls{padding:0 6%}.partialViewSlider-wrapper{overflow:hidden;font-size:0;position:relative}.partialViewSlider-outerwrapper ul{margin:0;padding:0;list-style:none;transition-property:transform;transition-duration:0ms;transition-timing-function:ease-out}.partialViewSlider-outerwrapper ul>li{display:inline-block;position:relative;font-size:1rem;transition-property:all;transition-duration:0ms;transition-timing-function:ease-out;position:relative}.partialViewSlider-wrapper.partialViewSlider-perspective ul>li{-webkit-transform:scale(0.8);transform:scale(0.8);opacity:.4}.partialViewSlider-wrapper.partialViewSlider-perspective ul>li.active{-webkit-transform:scale(1);transform:scale(1);opacity:1}.partialViewSlider-wrapper ul>li>img{width:100%;display:block}.partialViewSlider-backdrop{position:absolute;height:100%;top:0;background:rgba(0,0,0,0.5)}.partialViewSlider-backdrop.partialViewSlider-right{right:0}.partialViewSlider-nav{position:absolute;top:50%;color:#FFF !important;font-size:3rem;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.partialViewSlider-prev{left:0%}.partialViewSlider-next{right:0%}.partialViewSlider-outsideControls .partialViewSlider-nav,.partialViewSlider-neighborControls .partialViewSlider-nav{color:#CCC}.partialViewSlider-outsideControls .partialViewSlider-prev{left:1%}.partialViewSlider-outsideControls .partialViewSlider-next{right:1%}.partialViewSlider-neighborControls .partialViewSlider-prev{left:-5%}.partialViewSlider-neighborControls .partialViewSlider-next{right:-5%}.partialViewSlider-dots{display:inline-block;position:absolute;bottom:20px;left:50%;transform:translate(-50%)}.partialViewSlider-dots li a{position:relative;display:inline-block;width:7px;height:7px;margin:0 5px}.partialViewSlider-dots li a:before{position:absolute;content:'';width:100%;height:100%;border:1px solid #FFF;border-radius:50%;transition:all .25s ease-out}.partialViewSlider-dots li.active a:before{background:#FFF}.partialViewSlider-outerwrapper ul>li i{font-size: 18px;color: #fff;background: red;border-radius: 50%;padding: 16px;position: absolute;z-index: 99;top: 14px;right: 14px;opacity: 0.9;text-shadow: none}.partialViewSlider-outerwrapper ul>li div{position: absolute;bottom: 0px;background: linear-gradient(to bottom,transparent 0,#000000c9 80%);width: 100%;padding: 36px 27px 34px}.partialViewSlider-outerwrapper ul>li div a{color:#fff;font-size:20px;line-height: 1.5}
@media only screen and (max-width: 767px){.partialViewSlider-outerwrapper ul>li div a{font-size: 15px;}.partialViewSlider-outerwrapper ul>li div{padding:29px 19px 13px;}.partialViewSlider-outerwrapper ul>li i{font-size: 12px;padding:10px;}}

</style>
<script type="text/javascript">
(function($,window,doucment,undefined){const pluginName='partialViewSlider',defaults={width:55,controls:true,controlsPosition:'inside',backdrop:true,dots:false,auto:true,transitionSpeed:400,delay:4000,pauseOnHover:true,keyboard:true,perspective:false,items:{"0":1},prevHtml:'<i class="fa fa-chevron-left" aria-hidden="true"></i>',nextHtml:'<i class="fa fa-chevron-right" aria-hidden="true"></i>',onLoad:function(){},onSlideEnd:function(){}};function Plugin(element,options){this.element=element;this.options=$.extend({},defaults,options);this._defaults=defaults;this._name=pluginName;this.init();}
function calculateNumbers(self){const el=$(self.element),windowWidth=$(window).width();for(let i in self.options.items){if(windowWidth>parseInt(i)){self.numSlidesDisplayed=self.options.items[i];}}
if(self.numSlidesDisplayed>1){self.numClones=self.numSlidesDisplayed;}else{self.numClones=2;}
el.find('.partialViewSlider-clone').remove();self.slides=el.find('li');self.numSlides=self.slides.length,self.wrapperWidth=$(self.wrapper).width();if(self.numSlidesDisplayed>1){self.slideWidth=self.wrapperWidth/self.numSlidesDisplayed,self.sideWidth=0;}else{self.slideWidth=self.wrapperWidth*(self.options.width)/100,self.sideWidth=self.wrapperWidth*((100-self.options.width)/2)/100;}
self.firstMovement=self.currentPosition=-(self.slideWidth*self.numClones-self.sideWidth);}
function firstMovement(self,recalculate=0){let el=$(self.element);const first_slide=self.slides.slice(0,self.numClones),last_slide=self.slides.slice(-self.numClones);el.prepend(last_slide.clone().addClass('partialViewSlider-clone'));el.append(first_slide.clone().addClass('partialViewSlider-clone'));el.width((self.numSlides+self.numClones*2)*self.slideWidth);el.find('li').outerWidth(self.slideWidth);el.siblings('.partialViewSlider-backdrop').css('width',self.sideWidth);if(self.numSlidesDisplayed==1&&self.options.perspective){$(self.wrapper).addClass('partialViewSlider-perspective');}else{$(self.wrapper).removeClass('partialViewSlider-perspective');}
if(recalculate){moveSlider(self,self.index+1);}else{self.index=0;el.css({'-webkit-transform':'translateX('+(self.firstMovement)+'px)','transform':'translateX('+(self.firstMovement)+'px)'});$(self.slides[0]).addClass('active').siblings().removeClass('active');if(self.options.dots)
$(self.dots[0]).addClass('active').siblings().removeClass('active');setTimeout(function(){el.css('transition-duration',self.options.transitionSpeed+'ms');$(self.slides).css('transition-duration',self.options.transitionSpeed+'ms');},20);}}
function moveSlider(self,direction){let el=$(self.element),isMoving=true;if(direction=='forward'){self.index++;self.currentPosition-=self.slideWidth;}else if(direction=='backward'){self.index--;self.currentPosition+=self.slideWidth;}else{const index=parseInt(direction);if(index<=self.numSlides&&index>0){self.index=index-1;self.currentPosition=self.firstMovement-(self.index*self.slideWidth);}}
$(self.slides[self.index]).addClass('active').siblings().removeClass('active');if(self.options.dots)
$(self.dots[self.index]).addClass('active').siblings().removeClass('active');el.css({'-webkit-transform':'translateX('+self.currentPosition+'px)','transform':'translateX('+self.currentPosition+'px)'});setTimeout(function(){let loop;if(self.index>self.numSlides-1){self.index=0;self.currentPosition=self.firstMovement;loop=true;}else if(self.index<0){self.index=self.numSlides-1;self.currentPosition-=self.numSlides*self.slideWidth;loop=true}else{loop=false;}
if(loop){$(self.slides).css('transition-duration','0ms');$(self.slides[self.index+2]).addClass('active').siblings().removeClass('active');if(self.options.dots)
$(self.dots[self.index]).addClass('active').siblings().removeClass('active');el.css({'transition-duration':'0ms','-webkit-transform':'translateX('+self.currentPosition+'px)','transform':'translateX('+self.currentPosition+'px)'});setTimeout(function(){el.css('transition-duration',self.options.transitionSpeed+'ms');$(self.slides).css('transition-duration',self.options.transitionSpeed+'ms');},20);}
self.options.onSlideEnd.call(self.element);},self.options.transitionSpeed);}
let xDown=null;let yDown=null;function getTouches(evt){return evt.touches||evt.originalEvent.touches;}
function handleTouchStart(evt){xDown=getTouches(evt)[0].clientX;yDown=getTouches(evt)[0].clientY;};function handleTouchMove(evt,self){if(!xDown||!yDown){return;}
var xUp=getTouches(evt)[0].clientX;var yUp=getTouches(evt)[0].clientY;var xDiff=xDown-xUp;var yDiff=yDown-yUp;if(Math.abs(xDiff)>Math.abs(yDiff)){if(xDiff<0){moveSlider(self,'backward');}else{moveSlider(self,'forward');}}
xDown=null;yDown=null;};$.extend(Plugin.prototype,{init:function(){let windowWidth=$(window).width();let self,el;self=this;el=$(this.element);el.wrap('<div class="partialViewSlider-outerwrapper"><div class="partialViewSlider-wrapper"></div></div>');this.outerWrapper=el.closest('.partialViewSlider-outerwrapper'),this.wrapper=el.closest('.partialViewSlider-wrapper');calculateNumbers(this);if(this.options.controlsPosition=='outside'){$(this.outerWrapper).addClass('partialViewSlider-outsideControls');}else if(this.options.controlsPosition=='neighbors'){$(this.outerWrapper).addClass('partialViewSlider-neighborControls');}
if(this.options.controls){$(this.outerWrapper).append('<a href="#" class="partialViewSlider-nav partialViewSlider-prev">'+this.options.prevHtml+'</a>');$(this.outerWrapper).append('<a href="#" class="partialViewSlider-nav partialViewSlider-next">'+this.options.nextHtml+'</a>');$(this.outerWrapper).on('click','.partialViewSlider-next',(e)=>{e.preventDefault();this.next();});$(this.outerWrapper).on('click','.partialViewSlider-prev',(e)=>{e.preventDefault();this.prev();});}
if(this.options.backdrop){$(this.wrapper).append('<div class="partialViewSlider-backdrop"></div>');$(this.wrapper).append('<div class="partialViewSlider-backdrop partialViewSlider-right"></div>');}
if(this.options.dots){var dotsHtml='<ul class="partialViewSlider-dots">';for(var i=0;i<this.numSlides;i++){dotsHtml+='<li><a href="#"></a></li>';}
dotsHtml+='</ul>';$(this.outerWrapper).append(dotsHtml);self.dots=this.dots=$(this.outerWrapper).find('.partialViewSlider-dots li');$(this.outerWrapper).on('click','.partialViewSlider-dots li',(e)=>{e.preventDefault();var index=$(self.dots).index(this);moveSlider(self,index+1);});}
firstMovement(this);if(this.options.auto){this.play();if(this.options.pauseOnHover){$(this.wrapper).on('mouseenter',function(){self.pause();});$(this.wrapper).on('mouseleave',function(){self.play();});}}
if(this.options.keyboard){$(document).on('keyup',(e)=>{if(!$(':focus').is('input, textarea')){if(e.keyCode===37){self.prev();}else if(e.keyCode===39){self.next();}}});}
let resize;$(window).on('resize orientationchange',()=>{clearTimeout(resize);resize=setTimeout(function(){calculateNumbers(self);firstMovement(self,1);},500);});document.addEventListener('touchstart',handleTouchStart,{passive:true});document.addEventListener('touchmove',function(event){handleTouchMove(event,self);},{passive:true});this.options.onLoad.call(el);},prev:function(){moveSlider(this,'backward');},next:function(){moveSlider(this,'forward');},play:function(){var self=this;clearInterval(this.looper);this.looper=setInterval(function(){self.next();},self.options.delay);},pause:function(){clearInterval(this.looper);},goToSlide:function(index){moveSlider(this,index);}});$.fn[pluginName]=function(options){var plugin;this.each(function(){plugin=$.data(this,'plugin_'+pluginName);if(!plugin){plugin=new Plugin(this,options);$.data(this,'plugin_'+pluginName,plugin);}});return plugin;}}(jQuery,window,document));
</script>
<?php
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary']; 
$view_mode              = $content['mode'];
$domain_name            =  base_url();
$render_mode         = $content['RenderingMode'];
$content_type = $content['content_type_id'];
if($content['RenderingMode'] == "manual"){
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']);
		
	if (function_exists('array_column')){ 
		$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	}else{
		$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
	}
	$get_content_ids = implode("," ,$get_content_ids);
	if($get_content_ids!=''){
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach($widget_instance_contents as $key => $value){
			foreach($widget_instance_contents1 as $key1 => $value1){
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}					
}else{
	if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
	}else{
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID']  , $content_type ,  $content['mode'], $is_home);
		if(function_exists('array_column')){
			$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
		}else{
			$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
		}
		$get_content_ids = implode("," ,$get_content_ids); 
		if($get_content_ids!=''){
			$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);
			foreach($widget_instance_contents as $key => $value){
				foreach($widget_instance_contents1 as $key1 => $value1){
					if($value['content_id']==$value1['content_id']){
						$widget_contents[] = array_merge($value, $value1);
					}
				}
			}
		}
	}	
}
	
	
	
$show_simple_tab = "";
$show_simple_tab .= '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
if(count($widget_contents)>0){
	$show_simple_tab .= '<ul id="partial-view">';
	foreach($widget_contents as $get_content){
		$content_url = $get_content['url'];
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$get_content['title']);
		$live_article_url = $domain_name.$content_url.$param;
		$title = ($gallery['gallery_image_title']!='') ? $gallery['gallery_image_title'] :  $display_title;
		if($render_mode == "manual"){
			$content_type = $get_content['content_type_id'];  // from widgetinstancecontent table
			$content_details = $this->widget_model->get_contentdetails_from_database($get_content['content_id'], $content_type, $is_home, $view_mode);
			$sectionname = $content_details[0]['section_name'];
		}else{
			$content_type = $content['content_type_id'];  // from xml
			$sectionname ='';
		}
		$original_image_path="";
		if($original_image_path =="" && $render_mode =="manual"){
			$original_image_path  = $content_details[0]['ImagePhysicalPath'];
			$imagealt             = $content_details[0]['ImageCaption'];	
			$imagetitle           = $content_details[0]['ImageAlt'];	
		}else if($original_image_path =="" && $render_mode =="auto"){
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt             = $get_content['ImageCaption'];	
			$imagetitle           = $get_content['ImageAlt'];	
		}
		if($original_image_path !='' &&  get_image_source($original_image_path, 1)){
			$imagedetails =  get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];				
			if ($imageheight > $imagewidth){
				$Image600X300 	= str_replace("original","w600X390", $original_image_path);
			}else{
				$Image600X300  = str_replace("original","w600X390", $original_image_path);
			}
			if ($Image600X300 != '' && get_image_source($Image600X300, 1)){
				$show_image = image_url. imagelibrary_image_path . $Image600X300;
				$is_image = true;
			}else{
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		}else{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			$is_image = false;
		}
		$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		$show_simple_tab .= '<li>';
		$show_simple_tab .= '<a href="'.$live_article_url.'"><img src="'.$show_image.'" data-src="'.$show_image.'"></a>';
		$show_simple_tab .= '<div><a href="'.$live_article_url.'">'.$title.'</a></div>';
		$show_simple_tab .= '<i class="fa fa fa-camera" aria-hidden="true"></i>';
		$show_simple_tab .= '</li>';
	}
	$show_simple_tab .= '</ul>';
}

$show_simple_tab .= '</div></div>';
echo $show_simple_tab;
?>
<script>
$(document).ready(function(){
	if(screen.width < 800 || document.documentElement.clientWidth < 800) {
		var partialView = $('#partial-view').partialViewSlider({width:100});
	}else{
		var partialView = $('#partial-view').partialViewSlider({width:60});
	}
	$('#partial-view').show();
});
</script>