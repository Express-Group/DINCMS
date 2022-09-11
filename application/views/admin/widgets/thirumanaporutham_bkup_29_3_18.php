<style>
<!--.thirumanaporutham-container{width:100%;float:left;background:url('<?php echo image_url.'images/FrontEnd/images/Matchmaker-bg.jpg'; ?>');background-size:cover;border-radius: 5px;}-->
.thirumanaporutham-container{width:100%;float:left;background:url('http://www.powerpointhintergrund.com/download/wedding-backgrounds-for-powerpoint-free-powerpoint-templates-valentine--9498');background-size:cover;border-radius: 5px;}
.thirumanaporutham-inner-container{width: 94%;float: left;margin: 3%;background: #ffffffa8;border-radius: 5px;padding: 1%;}
.thirumanaporutham-title{color: #e40f23 !important;font-weight: 700 !important;font-size: 19px;text-align: center;padding-bottom: 6px;text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;}
.thirumanaporutham-50{width:50%;float:left;padding: 1%;}
.thirumanaporutham-100{width:100%;float:left;padding: 1%;}
.thirumanaporutham-50 p.text-center{font-weight: 700;font-size: 14px;text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;}
.border-right-true{border-right:1px solid #fff;}
.form-inputs,.form-inputs label{width:100%;float:left;}
.form-inputs-text{width: 61%;padding: 2%;border: 1px solid #999da0;border-radius: 6px;background: #ffffff96;}
.label-padd{width:35% !important;padding-top: 9px;color: #136e9e;text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;}
.form-inputs{margin-bottom:10px;}
.porutham-btn{background: linear-gradient(to bottom,#ee7919 0,rgb(237, 39, 36) 80%);padding: 7px;border: none;    color: #FFF;border-radius: 5px;font-weight: bold;outline: none;width:50%;}
.form-inputs-text option{font-weight:bold;}
.form-inputs p{display:none;margin-bottom: 0;margin-top: 3px;text-align: center;color: #e40f23;padding-left: 13px;}
.otp-input{width: 54%;margin: 0 22% 0;}
.thirumana-prutham-table{border-collapse: collapse;width: 100%;text-align:center;}
.thirumana-prutham-table th, .thirumana-prutham-table td{padding: 8px;text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;font-weight: 700;color: #136e9e;}
.thirumana-prutham-table th{text-align:center !important;color:#000;}
.thirumanaporutham-success-list{float: left;width: 50%;margin-top: 2%;}
.thirumanaporutham-success-list .success{float: left;width: 100%;}
.thirumanaporutham-success-list .success, .thirumanaporutham-success-list .failure{float: left;width: 100%;}
.thirumanaporutham-success-list .success span:nth-child(1){width: 70%;float: left;padding: 3%;background: #ffffffa3; border: 1px solid #4CAF50;font-weight: 700;}
.thirumanaporutham-success-list .success span:nth-child(2){width: 27%;float: left;padding: 3%;background: #4caf5091;border: 1px solid #4caf5091;color: #fff;text-align:center;}
.thirumanaporutham-success-list .failure span:nth-child(1){width: 70%;float: left;padding: 3%;background: #ffffffa3; border: 1px solid #f4433699;font-weight: 700;}
.thirumanaporutham-success-list .failure span:nth-child(2){width: 27%;float: left;padding: 3%;background: #f4433699;border: 1px solid #f4433699;color: #fff;text-align:center;}
.mudivukal{float: left;width: 100%;padding: 1%;text-align: center;font-size: 17px;margin: 2% 0 2%;font-weight: 700;color: #136e9e;}
</style>
<?php
$widget_bg_color        = $content['widget_bg_color']; 
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$view_mode              = $content['mode'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();
$rasipalan_list = ['மேஷம்','ரிஷபம்','மிதுனம்','கடகம்','சிம்மம்','கன்னி','துலாம்','விருச்சிகம்','தனுசு','மகரம்','கும்பம்','மீனம்'];
if(!isset($_GET['from']) && !isset($_GET['type']) && count($_GET)==0){ ?>
<div class="thirumanaporutham-container">
	<div class="thirumanaporutham-inner-container">
		<h5 class="thirumanaporutham-title"><span>திருமண பொருத்தம்</span></h5>
		<div class="thirumanaporutham-50">
			<p class="text-center">மணப்பெண்</p>
			<div class="form-inputs">
				<label class="label-padd">பெயர்</label>
				<input type="text" id="f_name" class="form-inputs-text">
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">பிறந்த தேதி</label>
				<input type="text" id="f_dob" readonly="readonly" class="form-inputs-text">
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">ராசி</label>
				<select id="f_rasipalan" class="form-inputs-text rasipalan">
					<option value="">Please select any one</option>
				<?php
					for($i=0;$i<count($rasipalan_list);$i++){
						echo "<option value='".$rasipalan_list[$i]."'>".$rasipalan_list[$i]."</option>";
					}
				?>
				</select>
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">நட்சத்திரம்</label>
				<select id="f_sub_rasipalan" class="form-inputs-text">
				</select>
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">மின்னஞ்சல் முகவரி</label>
				<input type="email" id="email"  class="form-inputs-text">
				<p></p>
			</div>
		</div>
		<div class="thirumanaporutham-50">
			<p class="text-center">மணமகன்</p>
			<div class="form-inputs">
				<label class="label-padd">பெயர்</label>
				<input type="text" id="m_name" class="form-inputs-text">
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">பிறந்த தேதி</label>
				<input type="text" id="m_dob" readonly="readonly" class="form-inputs-text">
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">ராசி</label>
				<select id="m_rasipalan" class="form-inputs-text rasipalan">
					<option value="">Please select any one</option>
				<?php
					for($i=0;$i<count($rasipalan_list);$i++){
						echo "<option value='".$rasipalan_list[$i]."'>".$rasipalan_list[$i]."</option>";
					}
				?>
				</select>
				<p></p>
			</div>
			<div class="form-inputs">
				<label class="label-padd">நட்சத்திரம்</label>
				<select id="m_sub_rasipalan" class="form-inputs-text">
				</select>
				<p></p>
			</div>
			<div class="form-inputs text-center">
				<button class="porutham-btn">பொருத்தம்</button>
			</div>
		</div>
		
	</div>
</div>
<script>
$(document).ready(function(){
	var currenturl = "<?php echo base_url().'testing' ?>";
	var dpOptions = {
        format: 'dd-mm-yyyy',
		endDate: '+0d',
        autoclose: true
     };
	 $("#f_dob").datepicker(dpOptions);
	 $("#m_dob").datepicker(dpOptions);
	$('.rasipalan').on('change',function(e){
		var rasipalan = $(this).val().trim();
		var rasipalan_id = $(this).attr('id');
		if(rasipalan!='' && rasipalan!=undefined && rasipalan!=null){
			$.ajax({
				type:'post',
				cache:false,
				data:{'rasipalan':rasipalan},
				url:'<?php echo base_url() ?>user/rasipalan_controller/rasipalan?from=page&type=rasipalan',
				success:function(result){ 
					if(result!=0){
						if(rasipalan_id=='f_rasipalan'){
							$('#f_sub_rasipalan').html(result);
						}else{
							$('#m_sub_rasipalan').html(result);
						}
					}
				},
				error:function(errno,errmsg){
					console.log(errmsg);
				}
			
			
			});
		}
	});
	$('.porutham-btn').on('click',function(){
		var error =false;
		var email_filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		var f_name  = $('#f_name').val().trim();
		var m_name  = $('#m_name').val().trim();
		var f_dob  = $('#f_dob').val().trim();
		var m_dob  = $('#m_dob').val().trim();
		var f_rasipalan  = $('#f_rasipalan').val().trim();
		var m_rasipalan  = $('#m_rasipalan').val().trim();
		var f_sub_rasipalan  = $('#f_sub_rasipalan').val();
		var m_sub_rasipalan  = $('#m_sub_rasipalan').val();
		var email = $('#email').val();
		
		if(f_name=='' || f_name==undefined){
			error = true;
			$('#f_name').next('p').html('Enter valid name').show();
			return false;
		}else{
			$('#f_name').next('p').html('').hide();
		}
		
		if(m_name=='' || m_name==undefined){
			error = true;
			$('#m_name').next('p').html('Enter valid name').show();
			return false;
		}else{
			$('#m_name').next('p').html('').hide();
		}
		
		if(f_dob=='' || f_dob==undefined){
			error = true;
			$('#f_dob').next('p').html('Enter valid DOB').show();
			return false;
		}else{
			$('#f_dob').next('p').html('').hide();
		}
		
		if(m_dob=='' || m_dob==undefined){
			error = true;
			$('#m_dob').next('p').html('Enter valid DOB').show();
			return false;
		}else{
			$('#m_dob').next('p').html('').hide();
		}
		
		if(f_rasipalan=='' || f_rasipalan==undefined){
			error = true;
			$('#f_rasipalan').next('p').html('Select valid one').show();
			return false;
		}else{
			$('#f_rasipalan').next('p').html('').hide();
		}
		
		if(m_rasipalan=='' || m_rasipalan==undefined){
			error = true;
			$('#m_rasipalan').next('p').html('Select valid one').show();
			return false;
		}else{
			$('#m_rasipalan').next('p').html('').hide();
		}
		
		if(f_sub_rasipalan=='' || f_sub_rasipalan==undefined){
			error = true;
			$('#f_sub_rasipalan').next('p').html('Select valid one').show();
			return false;
		}else{
			$('#f_sub_rasipalan').next('p').html('').hide();
		}
		if(m_sub_rasipalan=='' || m_sub_rasipalan==undefined){
			error = true;
			$('#m_sub_rasipalan').next('p').html('Select valid one').show();
			return false;
		}else{
			$('#m_sub_rasipalan').next('p').html('').hide();
		}
		if(email=='' || email==undefined || email_filter.test(email)==false){
			error = true;
			$('#email').next('p').html('Enter valid email address').show();
			return false;
		}else{
			$('#email').next('p').html('').hide();
		}
		
		if(error==false){
			$.ajax({
				type:'post',
				cache:false,
				data:{'fname':f_name,'mname':m_name,'fdob':f_dob,'mdob':m_dob,'frasipalan':f_rasipalan,'mrasipalan':m_rasipalan,'fsubrasipalan':f_sub_rasipalan,'msubrasipalan':m_sub_rasipalan,'email':email},
				url:'<?php echo base_url() ?>user/rasipalan_controller/update_rasi_details?from=page&type=urup',
				success:function(result){ 
					if(result==1){
						 var ccx = Math.floor((Math.random() * 10000000) + 1);
						window.location.href = currenturl+'?from=page&type=otp&cx='+ccx;
					}else{
						alert('Something went wrong..please try again');
					}
				},
				error:function(errno,errmsg){
					console.log(errmsg);
				}
			
			});
			
		}
		
	});

});
</script>
<?php }?>
<?php if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='otp' && $_GET['from']=='page'){
	session_start();
	if($_SESSION['rasi_uid']==""){
		redirect('/testing', 301);
	}
	$rasi_uid = $_SESSION['rasi_uid'];
	unset($_SESSION['rasi_uid']); 
	session_destroy();
 ?>
<div class="thirumanaporutham-container">
	<div class="thirumanaporutham-inner-container">
		<h5 class="thirumanaporutham-title"><span>OTP has been sent to your email address</span></h5>
		<div class="thirumanaporutham-100">
			<div class="form-inputs otp-input">
				<label class="label-padd">Enter Your OTP</label>
				<input type="text" id="otp" class="form-inputs-text">
				<p></p>
			</div>
			<div class="form-inputs otp-input margin-top-10">
				<button id="otp_submit" class="porutham-btn" style="width:auto;">Submit</button>
				<button id="resend_otp" class="porutham-btn" style="width:auto;">Resend OTP</button>
			</div>
		</div>	
	</div>
</div>
<script>
$(document).ready(function(){
    var currenturl = "<?php echo base_url().'testing' ?>";
	var rasi ="<?php echo $rasi_uid ?>";
	$('#otp_submit').on('click',function(){
		var otp = $('#otp').val().trim();
		if(otp!='' && otp!=undefined && otp.length <9){
			$('#otp').next('p').hide().html('');
			$.ajax({
				type:'post',
				cache:false,
				data:{'rasi':rasi,'otp':otp},
				url:'<?php echo base_url() ?>user/rasipalan_controller/otp_verification?from=page&type=otp_verify',
				success:function(result){
					if(result==1){
						var ccx = Math.floor((Math.random() * 10000000) + 1);
						window.location.href = currenturl+'?from=page&type=result&cd='+ccx;
					}else{
						$('#otp').next('p').show().html('Please enter valid OTP');
					}
				}
			});
		}else{
			$('#otp').next('p').show().html('Please enter valid OTP');
		}
		
	});
	$('#resend_otp').on('click',function(){
		$.ajax({
			type:'post',
			cache:false,
			data:{'rasi':rasi},
			url:'<?php echo base_url() ?>user/rasipalan_controller/resend_otp?from=page&type=resend_otp',
			success:function(result){
				if(result==1){
					alert('OTP has been sent to your email address.');
				}else{
					alert('Something went wrong.please try again');
				}
			}
		});
	
	});

});
</script>

<?php } ?>

<?php if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='result' && $_GET['from']=='page'){
session_start();
$tmid = $_SESSION['tmid'];	
$otp_verified = $_SESSION['opt_verified'];
if($tmid=='' && $otp_verified!=1){
	redirect('/testing', 301);
}
unset($_SESSION['tmid']); 
unset($_SESSION['opt_verified']); 
session_destroy();
?>
<div class="thirumanaporutham-container">
	<div class="thirumanaporutham-inner-container">
		<h5 class="thirumanaporutham-title"><span>திருமண பொருத்தம் முடிவுகள்</span></h5>
		<div class="thirumanaporutham-100">
		 <?php
			function __getstatus($code){
				if($code=='1'){
					$type = "உத்தமம்";
				}elseif($code=='0'){
					$type = "அதமம்";
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
					return "உத்தமம்";
				}else{
					return "அதமம்";
				}
			}
			$CI = &get_instance();
			$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db',TRUE);
			$getRasiUserDetails = $this->thirumanaporutham_db->query("SELECT manapen_peyar,manamagam_peyar,manapen_dob,manamagan_dob,manapen_rasi,manamagan_rasi,manapen_nachatiram,manamagan_nachatiram,email,otp_verified FROM thirumanaporutham_master WHERE tmid='".$tmid."'");
			if($getRasiUserDetails->num_rows()==1){
				$getRasiUserDetails = $getRasiUserDetails->result();
				if($getRasiUserDetails[0]->otp_verified==1){
					$template = '<table class="thirumana-prutham-table"><thead>';
					$template .='<tr><th>மணப்பெண்</th><th>மணமகன்</th>';
					$template .= '</thead><tbody>';
					$template .='<tr><td>பெயர் : '.$getRasiUserDetails[0]->manapen_peyar.'</td><td>பெயர் : '.$getRasiUserDetails[0]->manamagam_peyar.'</td>';
					$template .='<tr><td>பிறந்த தேதி : '.$getRasiUserDetails[0]->manapen_dob.'</td><td>பிறந்த தேதி : '.$getRasiUserDetails[0]->manamagan_dob.'</td>';
					$template .='<tr><td>ராசி : '.$getRasiUserDetails[0]->manapen_rasi.'</td><td>ராசி : '.$getRasiUserDetails[0]->manamagan_rasi.'</td>';
					$template .='<tr><td>நட்சத்திரம் : '.$getRasiUserDetails[0]->manapen_nachatiram.'</td><td>நட்சத்திரம் : '.$getRasiUserDetails[0]->manamagan_nachatiram.'</td>';
					$template .= '</tbody></table>';
					$GetRasiDetails = $this->thirumanaporutham_db->query("SELECT * FROM astro_marriage_match WHERE female_star='".$getRasiUserDetails[0]->manapen_nachatiram."' AND male_star='".$getRasiUserDetails[0]->manamagan_nachatiram."' LIMIT 1")->result();
					
					if(__getstatus($GetRasiDetails[0]->dinam)=="2"){
						echo $response = __patham($GetRasiDetails[0]->dinam, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>தினப்பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->dinam=="1")?"success" : "failure").'"><span>தினப்பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->dinam).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->ganam)==2){
						$response = __patham($GetRasiDetails[0]->ganam, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>கணப்பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->ganam=="1")?"success" : "failure").'"><span>கணப்பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->ganam).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->mahendhram)==2){
						$response = __patham($GetRasiDetails[0]->mahendhram, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>மகேந்திரப்பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->mahendhram=="1")?"success" : "failure").'"><span>மகேந்திரப்பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->mahendhram).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->stree_deergam)==2){
						$response = __patham($GetRasiDetails[0]->stree_deergam, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>ஸ்திரி பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->stree_deergam=="1")?"success" : "failure").'"><span>ஸ்திரி பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->stree_deergam).'</span></p></div>';
					}
					if(__getstatus($GetRasiDetails[0]->yoni)=="2"){
						$response = __patham($GetRasiDetails[0]->yoni, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>யோனி பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->yoni=="1")?"success" : "failure").'"><span>யோனி பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->yoni).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->rasi)==2){
						$response = __patham($GetRasiDetails[0]->rasi, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>ராசி பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->rasi=="1")?"success" : "failure").'"><span>ராசி பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->rasi).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->rasi_athipathi)==2){
						$response = __patham($GetRasiDetails[0]->rasi_athipathi, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>ராசி அதிபதி பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->rasi_athipathi=="1")?"success" : "failure").'"><span>ராசி அதிபதி பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->rasi_athipathi).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->vasiyam)==2){
						$response = __patham($GetRasiDetails[0]->vasiyam, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>வசிய பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->vasiyam=="1")?"success" : "failure").'"><span>வசிய பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->vasiyam).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->rajju)==2){
						$response = __patham($GetRasiDetails[0]->rajju, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>ரஜ்ஜிப்பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->rajju=="1")?"success" : "failure").'"><span>ரஜ்ஜிப்பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->rajju).'</span></p></div>';
					}
					
					if(__getstatus($GetRasiDetails[0]->vetha)==2){
						$response = __patham($GetRasiDetails[0]->vetha, $getRasiUserDetails[0]->manamagan_rasi, $getRasiUserDetails[0]->manamagan_nachatiram);
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($response=="உத்தமம்")?"success" : "failure").'"><span>வேதைப்பொருத்தம்</span><span>'.$response.'</span></p></div>';
						$response='';
					}else{
						$template .='<div class="thirumanaporutham-success-list"><p class="'.(($GetRasiDetails[0]->vetha=="1")?"success" : "failure").'"><span>வேதைப்பொருத்தம்</span><span>'.__getstatus($GetRasiDetails[0]->vetha).'</span></p></div>';
					}
					
					$template .='<div class="mudivukal">';
					$template .='<span>முடிவுகள்  : '.$GetRasiDetails[0]->over_all.'/10</span>';
					$template .='<p style="margin-top: 1%;">'.(((int) $GetRasiDetails[0]->over_all >=7)? 'பொருத்தம்' : 'பொருத்தமில்லை').'</p>';
					$template .='</div>';
					echo $template;
				}else{
					redirect('/testing', 301);
				}
			
			}else{
				redirect('/testing', 301);
			}
			
		 ?>
		</div>
	</div>
</div>

<?php } ?>