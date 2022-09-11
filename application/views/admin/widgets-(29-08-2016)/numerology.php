<?php
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];

$param = $content['page_param']; //parent id of rasi palangal
$monthNum = date ("m"); 
$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

$SectionDetails = get_section_by_id($param);

if(isset($SectionDetails)) {
$number_id = $SectionDetails['Section_id'];
$number_name = $SectionDetails['Sectionname'];
}

if(isset($number_id) && $number_id != '') {

	$ClassName = "";
	
	switch(strtolower($number_name)) {
	case "two":
	$ClassName = "numerology_two";
	break;
	case "three":
	$ClassName = "numerology_three";
	break;
	case "four":
	$ClassName = "numerology_four";
	break;
	case "five":
	$ClassName = "numerology_five";
	break;
	case "six":
	$ClassName = "numerology_six";
	break;
	case "seven":
	$ClassName = "numerology_seven";
	break;
	case "eight":
	$ClassName = "numerology_eight";
	break;
	case "nine":
	$ClassName = "numerology_nine";
	break;
	
	}
	
$numerology_results = numerology_list($number_id,$monthName);
?>


<div class="rasi-full">
  <h4 class="rasi-title">எண் ஜோதிடம்: பிறந்த தேதி பலன்கள்</h4>
  <div class="common-rasi"> 
  	<div class="numerology-cover">
       <span class="numerology-img <?php echo $ClassName; ?>"></span>
    </div>
    <!--<p>20 March – 19 April</p>-->
   <?php echo $numerology_results['general_details']; ?>
  </div>
</div>
  <!-- Below part commented temporarily , if needed uncomment below part-->
<?php /*?>  <div class="rasi-today">
    <h4 class="rasi-title">உங்கள் எண்ணுக்கான இன்றைய பலன்கள்</h4>
    <?php echo $numerology_results['daily_details']; ?>
  </div>
  <div class="rasi-today">
    <h4 class="rasi-title">உங்கள் எண்ணுக்கான இந்த வார பலன்கள்</h4>
     <?php echo $numerology_results['weekly_details']; ?>
  </div><?php */?>
  <div class="rasi-today">
    <h4 class="rasi-title">உங்கள் எண்ணுக்கான இந்த மாத பலன்கள்</h4>
    <?php echo $numerology_results['monthly_details']; ?>
  </div>
  <div class="rasi-today">
    <h4 class="rasi-title">உங்கள் எண்ணுக்கான பொதுப் பலன்கள்</h4>
   <?php echo $numerology_results['yearly_details']; ?>
  </div>
<?php } ?>

