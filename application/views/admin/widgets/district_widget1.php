<style>
.district-title{background: #052962;padding: 5px 5px 5px;font-size: 16px;font-weight: 700 !important;float: left;width: 100%; color: #fff !important;margin: 0;}
.district-title select{display: inline-block;width: auto;float: right;height: 24px;padding: 3px 9px;}
.district-content-<?php echo $content['widget_values']['data-widgetinstanceid'] ?>{width: 100%;float: left;padding: 5px;background: #eeeeee78;padding-top: 10px;}
.district-content-<?php echo $content['widget_values']['data-widgetinstanceid'] ?> .WidthFloat_L .col-lg-3{padding: 0 5px 0 3px;}
.district-content-<?php echo $content['widget_values']['data-widgetinstanceid'] ?> .WidthFloat_L .col-lg-3 img{border-radius:8px;}
.district-content-<?php echo $content['widget_values']['data-widgetinstanceid'] ?> .WidthFloat_L .subtopic1{font-weight: bold !important;margin: 5px 0 5px;font-size: 11px !important;}
</style>
<?php
$widget_bg_color         = $content['widget_bg_color'];
$widget_custom_title     = $content['widget_title'];
$widget_instance_id      =  $content['widget_values']['data-widgetinstanceid'];
$widget_section_url      = $content['widget_section_url'];
$is_home                 = $content['is_home_page'];
$main_sction_id 	     = "";
$is_summary_required     = $content['widget_values']['cdata-showSummary'];
$domain_name             =  base_url();
$view_mode               = $content['mode'];
$show_simple_tab         = "";
$domain_name =  base_url();
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
$show_simple_tab .= '<div class="row"><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">';
$show_simple_tab .= '<h5 class="district-title"><span>'.$widget_custom_title.'</span>';
$show_simple_tab .= '<select class="form-control district-list">';
$m=0;
foreach($widget_instancemainsection as $sectionList):
$tab_id  = 	($content['RenderingMode'] == "manual") ? $sectionList['WidgetInstanceMainSection_id'] : $sectionList['Section_ID'];
$show_simple_tab .= '<option '.(($m==0)? ' selected ' : '').' widget-instance-id="'.$sectionList['WidgetInstance_id'].'" widget-instance-main-id="'.$sectionList['WidgetInstanceMainSection_id'].'" value="'.$tab_id.'" widget-section-url="'.$sectionList['URLSectionStructure'].'">'.$sectionList['CustomTitle'].'</option>';
$m++;
endforeach;
$show_simple_tab .= '</select>';
$show_simple_tab .= '</h5>';
$show_simple_tab .= '<div class="district-content-'.$widget_instance_id.' margin-bottom-10">';
$j=0;
foreach($widget_instancemainsection as $get_section){
	if($j==0){
		$widget_contents = array();
		if($content['RenderingMode'] == "manual"){
			$content_type = $content['content_type_id'];
			$widget_instance_contents = $this->widget_model->get_widgetInstancearticles_rendering($get_section['WidgetInstance_id'], $get_section['WidgetInstanceMainSection_id'],$view_mode,$content['show_max_article'] );
			if (function_exists('array_column')){
				$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
			}else{
				$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
			}
			$get_content_ids = implode("," ,$get_content_ids);
			if($get_content_ids!=''){
				$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
				$widget_contents = array();
				foreach($widget_instance_contents as $key => $value){
					foreach($widget_instance_contents1 as $key1 => $value1){
						if($value['content_id']==$value1['content_id']){
							$widget_contents[] = array_merge($value, $value1);
						}
					}
				}
			}
		}else{
			$content_type = $content['content_type_id'];
			if($view_mode=="live"){
				$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$get_section['Section_ID'] , $content_type ,  $content['mode'], 'z');
			}else{
				$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['Section_ID'] , $content_type ,  $content['mode'], $is_home);
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
			}
		}
		$i=1;
		$count = 1;
		if(count($widget_contents)>0){
			$sectionURL='';
			foreach($widget_contents as $get_content){
				$original_image_path = "";
				$imagealt            = "";
				$imagetitle          = "";
				$custom_title        = "";
				$custom_summary      = "";  
				$summary      = "";
				if($content['RenderingMode'] == "manual"){
					if($get_content['custom_image_path'] != ''){
						$original_image_path = $get_content['custom_image_path'];
						$imagealt            = $get_content['custom_image_title'];	
						$imagetitle          = $get_content['custom_image_alt'];												
					}
					$custom_title   = $get_content['CustomTitle'];
					$custom_summary = $get_content['CustomSummary'];
				}
				if($original_image_path ==""){
					$original_image_path  = $get_content['ImagePhysicalPath'];
					$imagealt             = $get_content['ImageCaption'];	
					$imagetitle           = $get_content['ImageAlt'];	
				}
				$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
				if($original_image_path !='' && get_image_source($original_image_path, 1)){
					$imagedetails = get_image_source($original_image_path, 2);
					$imagewidth = $imagedetails[0];
					$imageheight = $imagedetails[1];
					if ($imageheight > $imagewidth){
						$Image600X300 	= $original_image_path;
					}else{				
						$Image600X300 	= str_replace("original","w600X300", $original_image_path);
					}
					if ($Image600X300 != '' && get_image_source($Image600X300, 1)){
						$show_image = image_url. imagelibrary_image_path . $Image600X300;
					}					
				}
				$content_url = $get_content['url'];
				$sectionURL = $domain_name.$get_section['URLSectionStructure'];
				$param = $content['close_param'];
				$live_article_url = $domain_name. $content_url.$param;	
				$display_title = ( $custom_title != '') ? $custom_title : ( ($get_content['title'] != '') ? stripslashes($get_content['title']) : '' ) ;
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
				$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
				if($custom_summary == '' && $content['RenderingMode'] == "auto"){
					$custom_summary =  $get_content['summary_html'];
				}
				$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
				if($count <= 6){
					if($count==1){
					$show_simple_tab.= '<div class="WidthFloat_L">'; 
					}
					$show_simple_tab.= '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">';
					$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click"><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>';
					$show_simple_tab .='<h4 class="subtopic1">'.$display_title.'</h4>';
					if($is_summary_required== 1){
						$show_simple_tab.='<p class="summary">'.$summary.'</p>';
					}
					$show_simple_tab.= '</div>';
					if($count==6 ){
						$show_simple_tab.=  '</div>';
						$count=0;
		
					}
					if($i == count($widget_contents)){
						if($i%6!=0){
							$show_simple_tab .='</div>';
						}
						$show_simple_tab.= '<div class="WidthFloat_L">';
						$show_simple_tab.= '<a style="margin-top: 4px;" class="vivasayam-arrow" href="'.$sectionURL.'"> மேலும் <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
						$show_simple_tab .='</div>';
					}
					$count ++;	
				}
				$i =$i+1;
			}
			
		}
	}
	$j++;
}
$show_simple_tab .= '</div>';
$show_simple_tab .= '</div></div>';
echo $show_simple_tab;
?>
<script>
$(document).ready(function(){
	$('.district-list').on('change',function(e){
		var tab_id = $(this).val();
		if(tab_id!='' && tab_id!=undefined){
			$.ajax({
				method:'post',
				url: '<?php echo base_url(); ?>user/commonwidget/get_district_content',
				data:{'tab_id' :tab_id  ,'renderMode' : '<?php echo $content["RenderingMode"] ?>' ,'contentType' : '<?php echo $content["content_type_id"] ?>' ,'maxArticle' : '<?php echo $content["show_max_article"] ?>' , 'widgetInstanceID' : $(this).find('option:selected').attr('widget-instance-id') , 'widgetInstanceMainID' : $(this).find('option:selected').attr('widget-instance-main-id') , 'mode' : '<?php echo $content["mode"] ?>' , 'isHome' : '<?php echo $content["is_home_page"] ?>' ,'summaryRequired' : '<?php echo $is_summary_required ?>'},
				beforeSend:function() {				
					$('.district-content-<?php echo $widget_instance_id ?>').addClass('text-center').html('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i>');
				},
				success:function(result){
					if(result!=''){
						$('.district-content-<?php echo $widget_instance_id ?>').removeClass('text-center').html(result);
					}
				},
				error:function(err,errcode){
					
				}
			})
		}
	});
	userLocation();
});
function userLocation(){
	if (window.navigator.geolocation){
		navigator.geolocation.getCurrentPosition(function(position){
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;
			var latlng = new google.maps.LatLng(lat, lng);
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({'latLng': latlng}, function(results, status){
				if(status == google.maps.GeocoderStatus.OK){
					if(results[1]){
						for(var i=0;i<results.length;i++){
							if(results[i].types[0] === "locality"){
								var city = results[i].address_components[0].short_name;
								if(city!= ''){
									city = (city=='புது தில்லி') ? 'புதுதில்லி' : city;
									city = (city=='பெங்களுரு') ? 'பெங்களூரு' : city;
									$('.district-list').find('option').each(function(index){
										var listcity = $(this).text();
										if(listcity==city){
											var districtId = $(this).attr('value');
											$('.district-list').val(districtId).trigger('change');
										}
									});
								}
							}
						}
					}
				}
			});
		},
		function(){ 
		});
	}
}
</script>