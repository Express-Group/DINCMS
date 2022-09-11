<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$view_mode = $content['mode'];
?>
<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="parentHorizontalTab<?php echo $widget_instance_id;?>">
            <div class="rasi-content">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <ul class="resp-tabs-list hor_1 ">
                    <li id="panchangam_tab">பஞ்சாங்கம்</li>
                    <li id="rasipalangal_tab">இன்றைய<br />ராசி பலன்கள்</li>
                  </ul>
                </div>
              </div>
              <div class="resp-tabs-container hor_1 cinema-tab">
			  
                <div id="panchangam">
                </div>
                <div id="rasi_palangal">
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
		
		
		
<script>


var AjaxCall = function(){
			var tab = '';
			var TabName = '';
			var CheckCount = true
			
			obj = {};
			
			obj.Init = function(tab) {
				TabName = tab; 
				
			};
			obj.Start = function() {
				document.getElementById(TabName).innerHTML = '<div class="cssload-container" id="add_article_process_imgtest" style="display:block;"><div class="cssload-zenith"></div></div>';
			}
			obj.CallController = function(){
				
					$.ajax({
						url			: '<?php echo base_url(); ?>user/commonwidget/get_panchangam_content',
						method		: 'POST',
						data		: { tab_type: TabName},
						Format		: 'HTML',
						success		: function(result){ 
							 document.getElementById(TabName).innerHTML = result;
							 CheckCount = false;
						},
						error: function (error) {
							 document.getElementById(TabName).innerHTML = '<div class=" ajaxStatus ajaxFailed noDisplay" style="display: none;">Failed to load the content...</div>';
							  CheckCount = true;
						}						
					});
					
			};
			obj.CheckContent = function() {
				return CheckCount;
			};
			
			return obj;
};


var RasiPalangal 	= AjaxCall();
var Panchangam 		= AjaxCall();

Panchangam.Init("panchangam");

if(Panchangam.CheckContent()) {
	Panchangam.Start();
	Panchangam.CallController();
}


$(document).ready(function() {
	
	
	
	$('#parentHorizontalTab<?php echo $widget_instance_id;?>').easyResponsiveTabs({ activate: function(event, tab){
		
		//accordion load
var list =$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-tab-item').attr('aria-controls');
var accord=$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion').attr('aria-controls');
//console.log(accord);
var itemCount = 0;
$( "#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-tab-item" ).each(function() {
if(list==accord){
	var idattr = $(this).attr('id');
	//var idat= trim(_tab);
	//var ida = idattr.replace('_tab',"");
	//console.log(idattr);
	//console.log(ida);
	 var category_attr = $(this).attr('data-contentype');
    $('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('id',idattr);
	$('#parentHorizontalTab<?php echo $widget_instance_id; ?> .resp-accordion:eq(' + itemCount + ')').attr('data-contentype',category_attr);
}
 itemCount++;
});
    //end -accordion load
		
		if ($(this).attr('id') == 'rasipalangal_tab'){
									//alert('rasipalangal_tab');
									RasiPalangal.Init("rasi_palangal");
									
									if(RasiPalangal.CheckContent()) 
									{
									RasiPalangal.Start();
									RasiPalangal.CallController();
									}
		                       }
				if ($(this).attr('id') == 'panchangam_tab'){
									//alert('panchangam_tab');
									RasiPalangal.Init("rasi_palangal");
									
									if(RasiPalangal.CheckContent()) 
									{
									RasiPalangal.Start();
									RasiPalangal.CallController();
									}
		                       }
		
		
		
	},
	
	});


});
</script>