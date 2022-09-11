<?php
$rasipalan_list = ['மேஷம்','ரிஷபம்','மிதுனம்','கடகம்','சிம்மம்','கன்னி','துலாம்','விருச்சிகம்','தனுசு','மகரம்','கும்பம்','மீனம்'];
$rasipalan_sub_list =[];
$rasipalan_sub_list['மேஷம்']= ['Aswini','Barani','Kiruthikai'];
$rasipalan_sub_list['மேஷம்_ta']= ['அசுவினி','பரணி','கார்த்திகை'];
$rasipalan_sub_list['மீனம்']= ['Pooratathi','Uthiratathi','Revathi'];
$rasipalan_sub_list['மீனம்_ta']= ['பூரட்டாதி','உத்திரட்டாதி','ரேவதி'];
$rasipalan_sub_list['ரிஷபம்']= ['Kiruthikai','Rohini','Mirugasirisham'];
$rasipalan_sub_list['ரிஷபம்_ta']= ['கார்த்திகை','ரோகிணி','மிருகசீரிடம்'];
$rasipalan_sub_list['மிதுனம்']= ['Mirugasirisham','Thiruvathirai','Punarpoosam'];
$rasipalan_sub_list['மிதுனம்_ta']= ['மிருகசீரிடம்','திருவாதிரை','புனர்பூசம்'];
$rasipalan_sub_list['கடகம்']= ['Punarpoosam','Poosam','Ayilayam'];
$rasipalan_sub_list['கடகம்_ta']= ['புனர்பூசம்','பூசம்','ஆயில்யம்'];
$rasipalan_sub_list['சிம்மம்']= ['Makam','Pooram','Uthiram'];
$rasipalan_sub_list['சிம்மம்_ta']= ['மகம்','பூரம்','உத்திரம்'];
$rasipalan_sub_list['கன்னி']= ['Uthiram','Hastham','Chithirai'];
$rasipalan_sub_list['கன்னி_ta']= ['உத்திரம்','அஸ்தம்','சித்திரை'];
$rasipalan_sub_list['துலாம்']= ['Chithirai','Swathi','Visakam'];
$rasipalan_sub_list['துலாம்_ta']= ['சித்திரை','சுவாதி','விசாகம்'];
$rasipalan_sub_list['விருச்சிகம்']= ['Visakam','Anusham','Kettai'];
$rasipalan_sub_list['விருச்சிகம்_ta']= ['விசாகம்','அனுஷம்','கேட்டை'];
$rasipalan_sub_list['தனுசு']= ['Moolam','Pooradam','Uthiradam'];
$rasipalan_sub_list['தனுசு_ta']= ['மூலம்','பூராடம்','உத்திராடம்'];
$rasipalan_sub_list['மகரம்']= ['Uthiradam','Thiruvonam','Avittam'];
$rasipalan_sub_list['மகரம்_ta']= ['உத்திராடம்','திருவோணம்','அவிட்டம்'];
$rasipalan_sub_list['கும்பம்']= ['Avittam','Sathayam','Pooratathi'];
$rasipalan_sub_list['கும்பம்_ta']= ['அவிட்டம்','சதயம்','பூரட்டாதி'];
function __getstatus($code){
	if($code=='1'){
		$type = "உண்டு";
	}elseif($code=='0'){
		$type = "இல்லை";
	}else{
		$type = "2";
	}
	return $type;
}
function __patham($rasivalue,$rasiname,$natchatiramname){
	$rasidetails = explode('|',$rasivalue);
	$intvalue  = explode('-',$rasidetails[1]);
	$rasi  =$intvalue[0];
	$result  =$intvalue[1];
	if($rasiname=="ரிஷபம்" && $natchatiramname=="Kiruthikai"){
		$rsvalue =  "2,3,4";
	}elseif($rasiname=="ரிஷபம்" && $natchatiramname=="Mirugasirisham"){
		$rsvalue =  "1,2";
	}elseif($rasiname=="மிதுனம்" && $natchatiramname=="Mirugasirisham"){
		$rsvalue =  "3,4";
	}elseif($rasiname=="மிதுனம்" && $natchatiramname=="Punarpoosam"){
		$rsvalue =  "1,2,3";
	}elseif($rasiname=="கடகம்" && $natchatiramname=="Punarpoosam"){
		$rsvalue =  "4";
	}elseif($rasiname=="சிம்மம்" && $natchatiramname=="Uthiram"){
		$rsvalue =  "1";
	}elseif($rasiname=="கன்னி" && $natchatiramname=="Uthiram"){
		$rsvalue =  "2,3,4";
	}elseif($rasiname=="கன்னி" && $natchatiramname=="Chithirai"){
		$rsvalue =  "1,2";
	}elseif($rasiname=="துலாம்" && $natchatiramname=="Chithirai"){
		$rsvalue =  "3,4";
	}elseif($rasiname=="துலாம்" && $natchatiramname=="Visakam"){
		$rsvalue =  "1,2,3";
	}elseif($rasiname=="விருச்சிகம்" && $natchatiramname=="Visakam"){
		$rsvalue =  "4";
	}elseif($rasiname=="தனுசு" && $natchatiramname=="Uthiram"){
		$rsvalue =  "1";
	}elseif($rasiname=="மகரம்" && $natchatiramname=="Uthiradam"){
		$rsvalue =  "2,3,4";
	}elseif($rasiname=="மகரம்" && $natchatiramname=="Avittam"){
		$rsvalue =  "1,2";
	}elseif($rasiname=="கும்பம்" && $natchatiramname=="Avittam"){
		$rsvalue =  "3,4";
	}elseif($rasiname=="கும்பம்" && $natchatiramname=="Pooratathi"){
		$rsvalue =  "1,2,3";
	}elseif($rasiname=="மீனம்" && $natchatiramname=="Pooratathi"){
		$rsvalue =  "4";
	}	
	if($rsvalue==$rasi){
		$type =  $result;
	}else{
		$type =  "";
	}
	if($type=="1"){
		return "உண்டு ";
	}else{
		return "இல்லை";
	}
}
?>
<style>
.table_view{float:left;width:50%;}
</style>
<link href="<?php echo image_url ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="<?php echo image_url ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> &gt; <a href="#">Thirumanaporutham Manager</a></div>
				<h2>Thirumanaporutham Manager</h2>
			</div>
		</div>
		
		<div class="Overflow DropDownWrapper">
			<div class="example_wrapper">
				<h5 style="font-weight: bold !important;text-align: center;color: #0569a3;font-size: 14px;margin-bottom:2%;">முடிவுகள் </h5>
				<div class="table_view">
					<?php
					$manapenrasiDetails = $this->thirumanaporutham_db->query("SELECT star , rasi , ganam , yoni , rajju , nadi , vethai , athipathi FROM nakshatra_match WHERE star_en='".$records[0]->manapen_nachatiram."' AND rasi='".$records[0]->manapen_rasi."'")->result();
					$manamaganrasiDetails = $this->thirumanaporutham_db->query("SELECT star , rasi , ganam , yoni , rajju , nadi , vethai , athipathi FROM nakshatra_match WHERE star_en='".$records[0]->manamagan_nachatiram."' AND rasi='".$records[0]->manamagan_rasi."'")->result();
					?>
					<table id="result_view">
						<thead>
							<tr>
								<th>Details</th>
								<th>மணமகள்</th>
								<th>மணமகன்</th>
							</tr>
						</thead>
						<tbody>
							<tr><td><b>Name</b></td><td><?php echo $records[0]->manapen_peyar; ?></td><td><?php echo $records[0]->manamagam_peyar; ?></td></tr>
							<tr><td><b>Date of birth</b></td><td><?php echo $records[0]->manapen_dob; ?></td><td><?php echo $records[0]->manamagan_dob; ?></td></tr>
							<tr><td><b>ராசி</b></td><td><?php echo $records[0]->manapen_rasi; ?></td><td><?php echo $records[0]->manamagan_rasi; ?></td></tr>
							<?php
								$manapenNachatiram = array_search($records[0]->manapen_nachatiram, $rasipalan_sub_list[$records[0]->manapen_rasi]);
								$manapenna = $rasipalan_sub_list[$records[0]->manapen_rasi.'_ta'][$manapenNachatiram];
								$manamaganNachatiram = array_search($records[0]->manamagan_nachatiram, $rasipalan_sub_list[$records[0]->manamagan_rasi]);
								$manamaganna = $rasipalan_sub_list[$records[0]->manamagan_rasi.'_ta'][$manamaganNachatiram];
							?>
							<tr><td><b>நட்சத்திரம்</b></td><td><?php echo $manapenna; ?></td><td><?php echo $manamaganna; ?></td></tr>
							<tr><td><b>Email</b></td><td><?php echo $records[0]->email; ?></td><td></td></tr>
							<tr><td><b>கணம்</b></td><td><?php echo $manapenrasiDetails[0]->ganam .' கணம்'; ?></td><td><?php echo $manamaganrasiDetails[0]->ganam.' கணம்'; ?></td></tr>
							<tr><td><b>யோனி</b></td><td><?php echo $manapenrasiDetails[0]->yoni; ?></td><td><?php echo $manamaganrasiDetails[0]->yoni; ?></td></tr>
							<tr><td><b>ராசி அதிபதி</b></td><td><?php echo $manapenrasiDetails[0]->athipathi; ?></td><td><?php echo $manamaganrasiDetails[0]->athipathi; ?></td></tr>
							<tr><td><b>ரஜ்ஜு</b></td><td><?php echo $manapenrasiDetails[0]->rajju; ?></td><td><?php echo $manamaganrasiDetails[0]->rajju; ?></td></tr>
							<tr><td><b>நாடி</b></td><td><?php echo $manapenrasiDetails[0]->nadi; ?></td><td><?php echo $manamaganrasiDetails[0]->nadi; ?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="table_view" style="margin: 1%;width: 48%;">
					<?php
						$GetRasiDetails = $this->thirumanaporutham_db->query("SELECT * FROM astro_marriage_match WHERE female_star='".$records[0]->manapen_nachatiram."' AND male_star='".$records[0]->manamagan_nachatiram."' LIMIT 1")->result();
						
						if(__getstatus($GetRasiDetails[0]->dinam)=="2"){
							$response = __patham($GetRasiDetails[0]->dinam, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">தினப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">தினப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->dinam).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->ganam)==2){
							$response = __patham($GetRasiDetails[0]->ganam, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">கணப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">கணப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->ganam).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->mahendhram)==2){
							$response = __patham($GetRasiDetails[0]->mahendhram, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">மகேந்திரப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">மகேந்திரப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->mahendhram).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->stree_deergam)==2){
							$response = __patham($GetRasiDetails[0]->stree_deergam, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ஸ்த்ரீதீர்க்கப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ஸ்த்ரீதீர்க்கப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->stree_deergam).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->yoni)==2){
							$response = __patham($GetRasiDetails[0]->yoni, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">யோனிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">யோனிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->yoni).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->rasi)==2){
							$response = __patham($GetRasiDetails[0]->rasi, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ராசிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ராசிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->rasi).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->rasi_athipathi)==2){
							$response = __patham($GetRasiDetails[0]->rasi_athipathi, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ராசிஅதிபதிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ராசிஅதிபதிப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->rasi_athipathi).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->vasiyam)==2){
							$response = __patham($GetRasiDetails[0]->vasiyam, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">வசிய பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">வசிய பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->vasiyam).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->rajju)==2){
							$response = __patham($GetRasiDetails[0]->rajju, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ரஜ்ஜுப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">ரஜ்ஜுப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->rajju).'</span></h4>';
						}
						
						if(__getstatus($GetRasiDetails[0]->vetha)==2){
							$response = __patham($GetRasiDetails[0]->vetha, $records[0]->manamagan_rasi, $records[0]->manamagan_nachatiram);
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">வேதைப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.$response.'</span></h4>';
						$response='';
						}else{
							echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">வேதைப் பொருத்தம் :  </span><span style="color: #3c8dbc;font-weight: bold;">'.__getstatus($GetRasiDetails[0]->vetha).'</span></h4>';
						}
						echo '<h4 style="text-align:center;margin-bottom:5px;padding-bottom: 8px;"><span style="color: #000;font-weight: bold;">'.$GetRasiDetails[0]->over_all.' </span><span style="color: #3c8dbc;font-weight: bold;">பொருத்தம் உள்ளது</span></h4>';
						echo '<div style="float:left;width:100%;margin-top:3%;text-align:center;"><button id="close_page" class="btn btn-primary">Close</button></div>';
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.datetimepicker.js"></script>
<script>
$(document).ready(function() {
	$('#result_view').DataTable({
		"bPaginate": false,
		"bSort" : false,
		"bInfo": false,
	});
	$('#close_page').on('click',function(){
		window.close();
	});
} );
</script>