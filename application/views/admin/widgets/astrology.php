<?php

$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];

$param = $content['page_param']; //parent id of rasi palangal
//echo 'hfhfhfhfh';exit;

$monthNum = date ("m"); 
$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));
//echo $monthName;
//$raasi_month = $this->db->query("select * from rasi_monthly_predictions where section_id='".$param."' ")->result_array();
//print_r($raasi_month);exit;
$SectionDetails = get_section_by_id($param);
//print_r($SectionDetails);exit;

if(isset($SectionDetails)) {
$rasi_id = $SectionDetails['Section_id'];
$rasi_name = $SectionDetails['Sectionname'];
}

if(isset($rasi_id) && $rasi_id != '') {
	//echo 'aa';exit;
	
	switch($rasi_name) {
		case 'மேஷம்':
			$ClassName = "rasi_mesham";
		break;
		case 'ரிஷபம்':
			$ClassName = "rasi_rishabam";
		break;
		case 'தனுசு':
			$ClassName = "rasi_dhanusu";
		break;
		case 'கடகம்':
			$ClassName = "rasi_kadagam";
		break;
		case 'கன்னி':
		$ClassName = "rasi_kanni";
		break;
		case 'கும்பம்':
			$ClassName = "rasi_kumbam";
		break;
		case 'மகரம்':
			$ClassName = "rasi_magaram";
		break;
		case 'மிதுனம்':
			$ClassName = "rasi_midhunam";
		break;
		case 'சிம்மம்':
			$ClassName = "rasi_simmam";
		break;
		case 'துலாம்':
			$ClassName = "rasi_thulam";
		break;
		case 'விருச்சிகம்':
			$ClassName = "rasi_viruchigam";
		break;
		case 'மீனம்':
			$ClassName = "rasi_menam";
		break;
		default:
			$ClassName = "rasi_mesham";
		break;
	}
	
	
$astrology_results = astrology_list(@$rasi_id,$monthName);
//print_r($astrology_results);exit;

?>
<div class="rasi-full">
  <h4 class="rasi-title"><?php echo @$rasi_name; ?></h4>
  <div class="common-rasi"> 
  	<div class="rasi-cover">
       <span class="rais-img <?php echo $ClassName; ?>"></span>
    </div>
    <!--<p>20 March – 19 April</p>-->
   <?php echo $astrology_results['general_details']; ?>
  </div>
</div>
  
<div class="custom_predictions">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading custom_heading">
                <h4 class="rasi-title rasi-custom" style="text-align: left;" type="today">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">இன்று</a>
                   
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                	<div class="accordion_content">
                     <?php echo $astrology_results['daily_details']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading custom_heading">
                <h4 class="rasi-title rasi-custom"  style="text-align: left;" type="weekly">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">இந்த வாரம்</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                	<div class="accordion_content">
                    <?php echo $astrology_results['weekly_details']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading custom_heading">
                <h4 class="rasi-title rasi-custom"  style="text-align: left;" type="monthly">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">இந்த மாதம்</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                	<div class="accordion_content">
					 <?php echo $astrology_results['monthly_details']; ?>
                	 <?php echo $astrology_results['tamil_monthly_details']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading custom_heading">
                <h4 class="rasi-title rasi-custom"  style="text-align: left;" type="yearly">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">இந்த ஆண்டு</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                	<div class="accordion_content">
                     <?php echo $astrology_results['yearly_details']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>
<?php } ?>

<script>

$('.rasi-title').on('click',function(){
	var type=$(this).attr('type');
	window.history.pushState("","",'?qe='+type);
});
$(document).ready(function(){
	var query = "<?php print $_GET['qe'] ?>";
	if(query!=''){
		
		$('.rasi-title').each(function(index){
			if($(this).attr('type')==query){
				
				$(this).find('a').trigger('click');
			}
			
		});
	}
	
});
</script>
