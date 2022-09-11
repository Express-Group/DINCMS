<!DOCTYPE html>
<?php
$natchathiram = ['Aswini','Anusham','Avittam','Ayilayam','Barani','Chithirai','Hastham','Kiruthikai','Makam','Kettai','Mirugasirisham','Moolam','Pooradam','Pooram','Pooratathi','Poosam','Punarpoosam','Revathi','Rohini','Sathayam','Swathi','Thiruvathirai','Thiruvonam','Uthiram','Uthiradam','Uthiratathi','Visakam'];
$natchathiram_ta = ['அசுவினி','அனுஷம்','அவிட்டம்','ஆயில்யம்','பரணி','சித்திரை','அஸ்தம்','கார்த்திகை','மகம்','கேட்டை','மிருகசீரிடம்','மூலம்','பூராடம்','பூரம்','பூரட்டாதி','பூசம்','புனர்பூசம்','ரேவதி','ரோகிணி','சதயம்','சுவாதி','திருவாதிரை','திருவோணம்','உத்திரம்','உத்திராடம்','உத்திரட்டாதி','விசாகம்'];
$rasipalan_list_ta = ['மேஷம்','மீனம்','ரிஷபம்','மிதுனம்','கடகம்','சிம்மம்','கன்னி','துலாம்','விருச்சிகம்','தனுசு','மகரம்','கும்பம்'];
$rasipalan_list = ['மேஷம்','மீனம்','ரிஷபம்','மிதுனம்','கடகம்','சிம்மம்','கன்னி','துலாம்','விருச்சிகம்','தனுசு','மகரம்','கும்பம்'];
if(@$_GET['lan']=='en'){
	$natchathiram_ta =$natchathiram;
}
?>
<link href="https://fonts.googleapis.com/css?family=Pavanam" rel="stylesheet">
<style>
body,html{font-family: 'Pavanam', sans-serif !important;}
p{ width: 23%;border: 1px solid #eee;font-size: 16px;display: block;margin: 0;border-bottom: none;padding:8px;}
p::last-child{border-bottom: 1px solid #eee !important;}
</style>
<form action="" method="post">
	<label>மணப்பெண் ராசி</label>
	<select name="pen_rasi1" required>
		<option value="">--SELECT--</option>
		<?php
		for($i=0;$i<count($rasipalan_list);$i++){
			echo '<option value="'.$rasipalan_list[$i].'" '.(($rasipalan_list[$i]==$_POST['pen_rasi1'])? ' selected ' : '').'>'.$rasipalan_list_ta[$i].'</option>';
		}
		?>
	</select><br><br>
	<label>மணமகன் ராசி</label>
	<select name="aan_rasi1" required>
		<option value="">--SELECT--</option>
		<?php
		for($i=0;$i<count($rasipalan_list);$i++){
			echo '<option value="'.$rasipalan_list[$i].'" '.(($rasipalan_list[$i]==$_POST['aan_rasi1'])? ' selected ' : '').'>'.$rasipalan_list_ta[$i].'</option>';
		}
		?>
	</select><br><br>
	<label>மணப்பெண் நட்சத்திரம்</label>
	<select name="pen_rasi" required>
		<option value="">--SELECT--</option>
		<?php
		for($i=0;$i<count($natchathiram);$i++){
			echo '<option value="'.$natchathiram[$i].'" '.(($natchathiram[$i]==$_POST['pen_rasi'])? ' selected ' : '').'>'.$natchathiram_ta[$i].'</option>';
		}
		?>
	</select><br><br>
	<label>மணமகன் நட்சத்திரம்</label>
	<select name="aan_rasi" required>
		<option value="">--SELECT--</option>
		<?php
		for($i=0;$i<count($natchathiram);$i++){
			echo '<option value="'.$natchathiram[$i].'" '.(($natchathiram[$i]==$_POST['aan_rasi'])? ' selected ' : '').' >'.$natchathiram_ta[$i].'</option>';
		}
		?>
	</select><br><br>
	<input type="submit" name="submit" value="submit">
</form>
<?php
	if(isset($_POST['submit'])){
		$connection = new mysqli("localhost","root","Enpl@456","dm_astrology_predictions");
		if ($connection->connect_errno) {
			echo "Failed to connect to MySQL: " . $connection->connect_error;
			exit;
		}
		if(isset($_POST['aan_rasi']) && isset($_POST['pen_rasi']) && $_POST['pen_rasi']!='' && $_POST['aan_rasi']!=''){
			$query = "SELECT * FROM astro_marriage_match WHERE female_star='".$_POST['pen_rasi']."' AND male_star='".$_POST['aan_rasi']."'";
			$response = $connection->query($query);
			if($response->num_rows > 1){
				echo 'more than one record fetched';
			}else if($response->num_rows==0){
				echo 'no records found';
			}else if($response->num_rows==1){
				$data = $response->fetch_assoc();
				echo '<br><b>நட்சத்திரம் முடிவுகள் </b><br><br>';
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
				
				function __getRasi($data,$rasiname,$natchatiramname){
					$explodedata = explode('|',$data);
					$intvalue  = explode('-',$explodedata[1]);
					$intvalue1  =$intvalue[0];
				    $finalvalue  = $intvalue[1];
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
					
					if($rsvalue==$intvalue1){
						return $finalvalue;
					}else{
						return "";
					}
				
				}
				
				echo '<p>தினப்பொருத்தம் : '.__getstatus($data['dinam']).' / '.$data['dinam'].'</p>';
				echo '<p>கணப்பொருத்தம் : '.__getstatus($data['ganam']).' / '.$data['ganam'].'</p>';
				echo '<p>மகேந்திரப்பொருத்தம் : '.__getstatus($data['mahendhram']).' / '.$data['mahendhram'].'</p>';
				echo '<p>ஸ்திரி பொருத்தம் : '.__getstatus($data['stree_deergam']).' / '.$data['stree_deergam'].'</p>';
				echo '<p>யோனி பொருத்தம் : '.__getstatus($data['yoni']).' / '.$data['yoni'].'</p>';
				if(__getstatus($data['rasi'])==2){
					$response3 =  __getRasi($data['rasi'],$_POST['aan_rasi1'],$_POST['aan_rasi']);
				
					echo '<p>ராசி பொருத்தம் : '.$response3.' / '.$data['rasi'].'</p>';
				}else{
					echo '<p>ராசி பொருத்தம் : '.__getstatus($data['rasi']).' / '.$data['rasi'].'</p>';
				}
				
				
				if(__getstatus($data['rasi_athipathi'])==2){
					$response3 =  __getRasi($data['rasi_athipathi'],$_POST['aan_rasi1'],$_POST['aan_rasi']);
				
					echo '<p>ராசி பொருத்தம் : '.$response3.' / '.$data['rasi_athipathi'].'</p>';
				}else{
					echo '<p>ராசி பொருத்தம் : '.__getstatus($data['rasi_athipathi']).' / '.$data['rasi_athipathi'].'</p>';
				}
				echo '<p>வசிய பொருத்தம் : '.__getstatus($data['vasiyam']).' / '.$data['vasiyam'].'</p>';
				echo '<p>ரஜ்ஜிப்பொருத்தம் : '.__getstatus($data['rajju']).' / '.$data['rajju'].'</p>';
				echo '<p>வேதைப்பொருத்தம் : '.__getstatus($data['vetha']).' / '.$data['vetha'].'</p>';
				echo '<p>முடிவுகள் : '.$data['over_all'].'</p>';
				foreach($data as $key=>$value){
					echo '<p style="color:green;">'.$key.' => '.$value.'</p>';
				}
			}
			
		}else{
			echo 'Invalid parameter passed || parameter null || parameter empty';
		
		}
	
	}
?>