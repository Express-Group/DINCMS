<?php
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
$domain_name            =  base_url();
$view_mode              = $content['mode'];

$show_simple_tab        = "";
$show_simple_tab       .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">';

if($widget_custom_title!='')
{

if($content['widget_title_link'] == 1)
{
	$show_simple_tab .='<h5 class="din-title"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></h5>';
}
else
{
	$show_simple_tab .='<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
}

}



$show_simple_tab .='<div class="cen-photo"><div id="parentHorizontalTab'.$widget_instance_id.'">';

$h = 1;
$show_simple_tab_li ='<ul class="resp-tabs-list hor_1_'.$widget_instance_id.' tab-hide">';
 foreach($widget_instancemainsection as $get_section_li)
	{
	$lid = ($h==2) ? 'id="cinema-trigger1'.$widget_instance_id.'"': 'id="default_trigger1'.$widget_instance_id.'"';
	
	$show_simple_tab_li .='<li '.$lid.'>'.$get_section_li['CustomTitle'].'</li>';
	$h++;
	}

$show_simple_tab_li .='</ul>';	
$j = 1;

foreach($widget_instancemainsection as $get_section)
{
	$content_type = $content['content_type_id'];  // manual article content type
	$widget_contents =array();
	if($content['RenderingMode'] == "manual") {
	
		$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($get_section['WidgetInstance_id'], $get_section['WidgetInstanceMainSection_id'],$content['mode'],$content['show_max_article']); 	

				if (function_exists('array_column'))  { 
			     $get_content_ids = array_column($widget_instance_contents, 'content_id'); 
				} else {
			     $get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
				}
		         $get_content_ids = implode("," ,$get_content_ids);

				if($get_content_ids!='') {
					$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
					$widget_contents = array();
						foreach ($widget_instance_contents as $key => $value) 
						{
							foreach ($widget_instance_contents1 as $key1 => $value1)
							 {
								if($value['content_id']==$value1['content_id'])
								{
								   $widget_contents[] = array_merge($value, $value1);
								}
							 }
						}
					}
		
	} else {
	
//	$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['Section_ID'] , $content_type ,  $content['mode']);

	if($view_mode=="live"){
		$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$get_section['Section_ID'] , $content_type ,  $content['mode'], $is_home);
	}else{
		$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['Section_ID'], $content_type ,  $content['mode'], $is_home);
		if (function_exists('array_column')) {
			$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
		} else {
			$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
		}
		$get_content_ids = implode("," ,$get_content_ids); 
		if($get_content_ids!='') {
			$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);
			foreach ($widget_instance_contents as $key => $value) {
				foreach ($widget_instance_contents1 as $key1 => $value1) {
					if($value['content_id']==$value1['content_id']){
						$widget_contents[] = array_merge($value, $value1);
					}
				}
			}
		 }
	}

	}
	//echo '<pre>'; print_r($widget_instance_contents);
	
	if($j == 1){
	$show_simple_tab .= $show_simple_tab_li;
	}
	$show_simple_tab .='<div class="resp-tabs-container hor_1_'.$widget_instance_id.'">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	
	<div class="custom-slider-container-class">
	<div id="slider1_container'.$widget_instance_id.'_'.$j.'" class="jssor-slide cinema-slides-wrapper cinema-slides-left" >';
	$show_simple_tab .='<div u="slides" class="cinema-slides" id="cinema_slides_id_'.$widget_instance_id.'_'.$j.'">';

	$gallery_id      = @$widget_contents[0]['content_id'];	
	$gallery_details = $this->widget_model->get_gallery_image_data($gallery_id, $view_mode);
	$gallery_url     = $this->widget_model->get_contentdetails_from_database($gallery_id, $content_type, $is_home, $view_mode);	
	$content_url     = @$gallery_url[0]['url'];
	$param           = $content['close_param'];
	$live_article_url = $domain_name.$content_url.$param;

	krsort($gallery_details);
	foreach($gallery_details as $gallery_list){
		$original_image_path  = $gallery_list['ImagePhysicalPath'];
		$imagealt             = $gallery_list['ImageCaption'];	
		$imagetitle           = $gallery_list['ImageAlt'];	
	
		if($original_image_path != '' && get_image_source($original_image_path, 1))
		{			
			$Image600X390   = "";
			$Image600X390 	= str_replace("original","w600X390", $original_image_path);
		
			if ($Image600X390 != '' && get_image_source($Image600X390, 1))
			{
				$show_image = image_url. imagelibrary_image_path . $Image600X390;
			}
			else {			
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
		
		}
		else {			
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		}
	
		$show_simple_tab .= '<div>';
		$show_simple_tab .= '<a href="'.$live_article_url.'"><img u="image" src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
		$show_simple_tab .= '<img u="thumb" src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'">';
		$show_simple_tab .= '</div>';

}

	$show_simple_tab.= '</div>';
	
	$show_simple_tab.= '<div u="thumbnavigator" class="jssort02" > 
	<div u="slides" style="cursor: default;">
	<div u="prototype" class="p">
	<div class=w>
	<div u="thumbnailtemplate" class="t"></div>
	</div>
	<div class=c></div>
	</div>
	</div>
	</div>
	</div>
	</div>';
	
	
	$show_simple_tab.= ' <div class="cen-nail">
	<div id="feature" class="slick-slide-container">
	<div id="effect-1" class="effects clearfix">
	<div class="photo-single photo-sec-next" id="singleplay6_'.$widget_instance_id.'">';	
		$i =1;	
		$m=0;
	

$i=1;

if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{	
		$custom_title        = "";
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$Image600X390        = "";
		$custom_title        = "";
		$custom_summary      ="";
		if($content['RenderingMode'] == "manual")
		{
			if($get_content['custom_image_path'] != '')
			{
			$original_image_path = $get_content['custom_image_path'];
			$imagealt            = $get_content['custom_image_title'];	
			$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title        = stripslashes($get_content['CustomTitle']);
		}	
			if($original_image_path =="")                         // from cms imagemaster table    
			{
			$original_image_path  = $get_content['ImagePhysicalPath'];
			$imagealt             = $get_content['ImageCaption'];	
			$imagetitle           = $get_content['ImageAlt'];	
			}
		$show_image="";

		if($original_image_path !='')
			{
			$Image600X300  = str_replace("original","w600X300", $original_image_path);
			if ($Image600X300 != '' && get_image_source($Image600X300, 1))
			{
			$show_image = image_url. imagelibrary_image_path . $Image600X300;
			}
			else
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}
			else {
			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
			}
	
			if( $custom_title == '')
			{
			$custom_title = $get_content['title'];
			}	
			
			$custom_title =  preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $custom_title);
		    $SourceURL    = "";
		$show_simple_tab.= '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">';
		if(($m == 0) || ($m == count($widget_contents))){
			$exp_id_tab1 = ($j == 1 && $i == 1) ? 'id = "default_trigger'.$widget_instance_id.'"' : '';
			$exp_id_tab2 = ($j == 2 && $i == 1) ? 'id = "cinema-trigger'.$widget_instance_id.'"' : '';			
			$show_simple_tab.= '<div class="img tab'.$widget_instance_id.'_'.$j.'_'.$i.'"  data-attr="'.$get_content['content_id'].'" data-url="'.$SourceURL.'" >';
		}else{
			$t = $m-1;
			$exp_id_tab1 = '';
			$exp_id_tab2 = '';
			$show_simple_tab.= '<div class="img tab'.$widget_instance_id.'_'.$j.'_'.$i.'" data-attr="'.$get_content['content_id'].'" data-url="'.$SourceURL.'" rel="'.$t.'">';
		}
		$show_simple_tab .='<figure><img src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></figure>';
		$exp_id = ( $j == 1 ) ? $exp_id_tab1: $exp_id_tab2 ;
		$show_simple_tab.= '<figcaption>'.$custom_title.'</figcaption>
		<div class="overlay"></div>
		</div>
		</div>';
		
		$i =$i+1;	
		$m++;
		}
//}
	}
		
		$show_simple_tab.= '</div>
		</div>
		</div>
		</div>';
		
		
		
		$show_simple_tab.= '</div></div>';

	
$j++;
	
}

//die();
$show_simple_tab.= '</div>';
if($content['widget_title_link'] == 1)
{
			$show_simple_tab.= '<div class="arrow">
				<a href="'.$widget_section_url.'">மேலும் <i class="fa fa-arrow-right" style=" color: #071c47;"></i></a>
			</div>';
}
		$show_simple_tab.= '</div>';



$show_simple_tab.= '</div></div>';
echo $show_simple_tab;
?>


 
<!--hover--> 
<script type="text/javascript">
$(document).ready(function(){
	$(".img").click(function(e){		
	$(".overlay").removeClass("gallery-hover");	
    if (!$(".img .overlay").hasClass("gallery-hover")) {
    $(this).children('.overlay').addClass("gallery-hover");
		}
});
});
</script> 
<!--hover end-->

<!--drop-down-->
<script type="text/javascript">
//parentHorizontalTab(<?php echo $widget_instance_id; ?>,'slider')	
$('#parentHorizontalTab<?php echo $widget_instance_id; ?>').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion
	width: 'auto', //auto or any width like 600px
	fit: true, // 100% fit in a container
	tabidentify: 'hor_1_<?php echo $widget_instance_id; ?>', // The tab groups identifier
	enableHash : false,
	activate: function(event) { // Callback function if tab is switched
	console.log('switched');
	$('.photo-single').slick('setPosition');
	var $tab = $(this);
	var $info = $('#nested-tabInfo');
	var $name = $('span', $info);
	$name.text($tab.text());
	$info.show();
	} 
});

$(document).ready(function(){
  gallery_call();
});
/*$(document).ajaxComplete(function(){
  gallery_call();
});*/

function gallery_call(){
	
	 var jssor_slider1 = null;
	$("div.img").unbind('click');	
	$("div.img").on('click', function(e){
		var _SlideshowTransitions = [
            //Rotate HFork in
            {$Duration: 1200, x: 1, y: 2, $Cols: 2, $Zoom: 11, $Rotate: 1, $Assembly: 2049, $ChessMode: { $Column: 19 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseOutQuad, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} }
            ];

            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 600,                                //Specifies default duration (swipe) for slide in milliseconds

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                },

                $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                },

                $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $AutoCenter:1,                                  //Auto center thumbnail items in the thumbnail navigator container, 0: None, 1: Horizontal, 2: Vertical, 3: Both, default value is 3 
					$Loop : 0,                                      //Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1 
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $Lanes: 2,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 14,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 12,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                             //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 156,                          //[Optional] The offset position to park thumbnail
                    $Orientation: 2                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                }
            };
	
	
		var $elem = $(e.target);
		
		var base_url = "<?php echo base_url(); ?>";
		var $slideContainer = $elem.parents("div.resp-tabs-container").find("div.custom-slider-container-class");
		var jssorId = $elem.parents("div.resp-tabs-container").find("div.jssor-slide").attr("id");
		var cinema_slides_id = $elem.parents("div.resp-tabs-container").find("div.cinema-slides").attr("id");
		var gallery_id = $elem.parents("div.img").attr("data-attr");
		var source_url = $elem.parents("div.img").attr("data-url");
		var img_str = gallery_images(gallery_id,source_url);
		
		var thumnailPostion = $elem.parents("div.resp-tabs-container").find("div.jssor-slide").hasClass("cinema-slides-right") ? "cinema-slides-right" : "cinema-slides-left";
		var str = ' <div id="' + jssorId + '" class="jssor-slide cinema-slides-wrapper '+thumnailPostion +'" ><div u="slides" class="cinema-slides" id="'+cinema_slides_id+'">'+img_str+'</div>'+
                      '<div u="thumbnavigator" class="jssort02" style="right: 0px; bottom: 0px;">'+
                        '<div u="slides" style="cursor: default;">'+
                          '<div u="prototype" class="p">'+
                            '<div class=w>'+
                              '<div u="thumbnailtemplate" class="t"></div>'+
                            '</div>'+
                            '<div class=c></div>'+
                          '</div>'+
                        '</div>'+
						'</div>'+
                      '</div>';		
					
		$("#" + jssorId).remove();
		console.log("slideContainer : ",$slideContainer);
		$slideContainer.html(str);
		var jssor_slider1 = new $JssorSlider$(jssorId, options);	
		
		function ScaleSlider() {
			var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
			if (parentWidth)
				jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 960), 300));
			else
				window.setTimeout(ScaleSlider, 30);
	}
		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
			
	});

}
function gallery_images(gallery_id,source_url)
		{ 
			var response;
			var content_id =  gallery_id;
			//alert(gallery_id);
			var base_url = "<?php echo base_url(); ?>";
			$.ajax({
			url: base_url+"user/commonwidget/get_image_gallery_list",
			type: "POST",
			data: {"content_id":content_id, "view_mode":'<?php echo $view_mode;?>', "param": '<?php echo $content['close_param'];?>',},
			dataType : "html",
			async : false	
			}).done(function(result){
			response = result;
			});
			return response;
		} 
/*$(window).resize(function(){
   console.log('resize called');
   var width = $(window).width();
   if(width >= 320 && width <= 480){
		$('#singleplay6_<?php echo $widget_instance_id; ?>').removeClass('photo-single').addClass('photo-single-mob');
	    //$('#singleplay7').removeClass('photo-single').addClass('photo-single-mob2');
   }
   else{
   }
}).resize();*/

</script>


</body>

