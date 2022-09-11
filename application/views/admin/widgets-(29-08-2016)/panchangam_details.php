<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$this->db->reconnect(); 
$panchangam_manager =  $this->db->query('CALL get_panchangamFP()')->result_array();
foreach($panchangam_manager as $panchangam)
{
	//$panchangamdetails=$panchangam['PanchangamDetails'];
	
	$tamil_day = $panchangam['Tamilday'];
	$tamil_year_month =  $panchangam['Tamilyearandmonth'];
	$nalla_nearm_kalai = $panchangam['NallaNeramKalai'];
	$nalla_nearm_malai = $panchangam['NallaNeramMalai'];
	$raagu_kaalam = $panchangam['RaaguKaalam'];
	$yemmakandam = $panchangam['Yemmakandam'];
	$kuligai = $panchangam['Kuligai'];
	$thithi = $panchangam['Thithi'];
	$chandrashtam = $panchangam['Chandrashtam'];
	$panchangam_details = $panchangam['PanchangamDetails'];
	$Thithi = $panchangam['Thithi'];
	$Natchatram = $panchangam['Natchatram'];
	
	$mesham = $panchangam['MeshamRasiPalan'];
	$rishabam = $panchangam['RishabamRasiPalan'];
	$midhunam = $panchangam['MidhunamRasiPalan'];
	$kadagam = $panchangam['KadahamRasiPalan'];
	$simmam = $panchangam['SimamRasiPalan'];
	$kanni = $panchangam['KanniRasiPalan'];
	$thulam = $panchangam['ThulamRasiPalan'];
	$viruchigam = $panchangam['ViruchagammRasiPalan'];
	$danusu = $panchangam['DanushuRasiPalan'];
	$magaram = $panchangam['MagaramRasiPalan'];
	$kumbam = $panchangam['KumbamRasiPalan'];
	$meenam = $panchangam['MenamRasiPalan'];
	$scheduleddate = $panchangam['Panchangam_date'];
	$current_date = date('d',strtotime($scheduleddate));
	$current_year = date('Y',strtotime($scheduleddate));
	$current_month = date('F',strtotime($scheduleddate));
	//$month_tamil = tamil_month($current_month);
}


?>

<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="margin-top">
         <fiugre class="bg-left"></fiugre>
         <fiugre class="bg-center1">பஞ்சாங்கம்</fiugre>
         <fiugre class="bg-right"></fiugre>
        </div>
        </div>
        </div>
        <div class="panchangam-lead">
        
         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rasipalan">
        <h4><?php echo $tamil_day; ?> </h4>
        <h1><?php echo $current_date; ?> </h1>
        <p class="varudam"><?php echo $tamil_year_month; ?></p>
         <p>நல்ல நேரம்</p>
         <p><span class="color-red">காலை </span><?php echo $nalla_nearm_kalai; ?>&nbsp;&nbsp;<span class="color-red"> மாலை </span><?php echo $nalla_nearm_malai; ?></p>
        <p>ராகு காலம்</p>
        <p><?php echo $raagu_kaalam; ?></p>
        <p>எம கண்டம்</p>
        <p><?php echo $yemmakandam; ?></p>
         <p>குளிகை</p> 
        <p> <?php echo $kuligai; ?></p>
		<p>திதி</p> 
        <p> <?php echo $Thithi; ?></p>		
		<p>நட்சத்திரம்</p> 
        <p> <?php echo $Natchatram; ?></p>
        <p>சந்திராஷ்டமம்</p> 
        <p> <?php echo $chandrashtam; ?></p>
       
         </div>
        
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 towel-rasi">
          <h4>இன்றைய ராசிபலன்</h4>
          <table>
          <tr>
          <td class="rasi-color">மேஷம்</td>
          <td>-</td>
          <td><?php echo $mesham; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">ரிஷபம்</td>
          <td>-</td>
          <td><?php echo $rishabam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">மிதுனம்</td>
          <td>-</td>
          <td><?php echo $midhunam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">கடகம்</td>
          <td>-</td>
          <td><?php echo $kadagam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">சிம்மம்</td>
          <td>-</td>
          <td><?php echo $simmam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">கன்னி</td>
          <td>-</td>
          <td><?php echo $kanni; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">துலாம்</td>
          <td>-</td>
          <td><?php echo $thulam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">விருச்சிகம்</td>
          <td>-</td>
          <td><?php echo $viruchigam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">தனுசு</td>
          <td>-</td>
          <td><?php echo $danusu; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">மகரம்</td>
          <td>-</td>
          <td><?php echo $magaram; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">கும்பம்</td>
          <td>-</td>
          <td><?php echo $kumbam; ?></td>
          </tr>
          <tr>
          <td class="rasi-color">மீனம்</td>
          <td>-</td>
          <td><?php echo $meenam; ?></td>
          </tr>
          </table>
          </div>
         </div>
         <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
          <div class="panchagam-next">
       <div class="panchagam-para">
       <?php echo $panchangam_details; ?>
       </div>
       </div>
       <div class="common-border"><span></span><span></span></div>
       </div>
         </div>
        </div>
      </div>