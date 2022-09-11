
<?php
$widget_bg_color 		= $content['widget_bg_color'];
$widget_instance_id	 	= $content['widget_values']['data-widgetinstanceid'];
$view_mode              = $content['mode'];
$widget_instance_details= $this->widget_model->getWidgetInstance('', '','', '', $widget_instance_id, $content['mode']);		
?>
<style>
.s-margin-bottom-<?php echo $widget_instance_id; ?>{margin-bottom: 10px!important;}
</style>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 s-margin-bottom-<?php echo $widget_instance_id; ?>">
    <div class="ad_script_<?php echo $widget_instance_id;?>" id="ad_script_<?php echo $widget_instance_id;?>"  <?php //echo $widget_bg_color;  ?> style="text-align:center;">
      <?php echo $widget_instance_details['AdvertisementScript']; ?>
    </div>
  </div>
</div>