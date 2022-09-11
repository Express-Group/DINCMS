<?php
class rasipalan_controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	public function rasipalan(){
		$rasipalan_list = ['மேஷம்','மீனம்','ரிஷபம்','மிதுனம்','கடகம்','சிம்மம்','கன்னி','துலாம்','விருச்சிகம்','தனுசு','மகரம்','கும்பம்'];
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
		if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='rasipalan' && $_GET['from']=='page'){
			if($_POST['rasipalan']!='' && in_array($_POST['rasipalan'],$rasipalan_list)){
				$rasi = $_POST['rasipalan'];
				$template ='<option value="">Please select any one</option>';
				for($i=0;$i<count($rasipalan_sub_list[$rasi]);$i++){
					$template .='<option value="'.$rasipalan_sub_list[$rasi][$i].'">'.$rasipalan_sub_list[$rasi.'_ta'][$i].'</option>';
				}
				echo $template;
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	
	}
	
	public function update_rasi_details(){
		if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='urup' && $_GET['from']=='page'){
			if(count($_POST)==9){
				if(isset($_POST['fname']) && isset($_POST['mname']) &&  isset($_POST['fdob']) &&  isset($_POST['mdob']) &&  isset($_POST['frasipalan']) &&  isset($_POST['mrasipalan']) &&  isset($_POST['fsubrasipalan']) &&  isset($_POST['msubrasipalan']) &&  isset($_POST['email']) && $_POST['fname']!='' &&  $_POST['mname']!='' &&  $_POST['fdob']!=''  &&  $_POST['mdob']!='' &&  $_POST['frasipalan']!='' &&  $_POST['mrasipalan']!='' &&  $_POST['fsubrasipalan']!='' &&  $_POST['msubrasipalan']!='' && $_POST['email']!=''){
					$CI = &get_instance();
					$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db',TRUE);
					//$otp = $this->generateRandomString().rand(1000,10000).$this->generateRandomString();
					$otp = rand(1000,10000);
					$data = ['manapen_peyar'=>$_POST['fname'], 'manamagam_peyar'=>$_POST['mname'],'manapen_dob'=>$_POST['fdob'],'manamagan_dob' => $_POST['mdob'],'manapen_rasi' => $_POST['frasipalan'],'manamagan_rasi' => $_POST['mrasipalan'],'manapen_nachatiram' => $_POST['fsubrasipalan'],'manamagan_nachatiram' => $_POST['msubrasipalan'], 'email' =>$_POST['email'],'otp'=> $otp];
					$this->thirumanaporutham_db->insert('thirumanaporutham_master',$data);
					$lastInsertedId = $this->thirumanaporutham_db->insert_id();
					if($lastInsertedId!=0 && $lastInsertedId!=null){
						session_start();
						$_SESSION['rasi_uid'] = $lastInsertedId;
						$this->sent_otp($_POST['email'],$otp,$lastInsertedId);
						echo 1;
					}else{
						echo 0;
					}
				}else{
				
					echo 0;
				}
			
			
			}else{
			
				echo 0;
			}
		
		}else{
			echo 0;
		}
	
	}
	
	public function otp_verification(){
		if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='otp_verify' && $_GET['from']=='page'){
			$rasiid =$_POST['rasi'];
			$otp =$_POST['otp'];
			if(is_numeric($rasiid) && $rasiid!='' && $otp!=''){
				$CI = &get_instance();
				$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db',TRUE);
				$response = $this->thirumanaporutham_db->query("SELECT tmid, otp FROM thirumanaporutham_master WHERE tmid='".$rasiid."' AND otp='".$otp."' AND otp_verified='0'");
				if($response->num_rows()==1){
					$this->thirumanaporutham_db->query("UPDATE  thirumanaporutham_master SET otp_verified='1' WHERE tmid='".$rasiid."' AND otp='".$otp."'");
					session_start();
					$_SESSION['tmid'] = $rasiid;
					$_SESSION['opt_verified'] = 1;
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	
	}
	
	public function resend_otp(){
		if(isset($_GET['from']) && isset($_GET['type']) && $_GET['type']=='resend_otp' && $_GET['from']=='page'){
			$rasiid =$_POST['rasi'];
			if(is_numeric($rasiid) && $rasiid!=''){
				$CI = &get_instance();
				$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db',TRUE);
				//$otp = $this->generateRandomString().rand(1000,10000).$this->generateRandomString();
				$otp = rand(1000,10000);
				$GetRasiDetails =  $this->thirumanaporutham_db->query("SELECT email FROM thirumanaporutham_master WHERE tmid='".$rasiid."'")->result();
				$this->sent_otp(@$GetRasiDetails[0]->email,$otp,$rasiid);
				echo $this->thirumanaporutham_db->query("UPDATE  thirumanaporutham_master SET otp_verified='0', otp='".$otp."' WHERE tmid='".$rasiid."'");
			}else{
				echo 0;
			}
		}else{
			echo 0;
		}
	
	}
	
	public function generateRandomString($length = 2) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function sent_otp($email_address, $otp,$rasiid){
		$CI = &get_instance();
		$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db',TRUE);
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = '\r\n';
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from('admin@dinamani.com', 'dinamani.com');
		$this->email->to($email_address);
		$this->email->subject('one time password - dinamani.com');
		$message = 'Dear Dinamni Reader,<br><br>';
		$message .= 'Welcome to www.dinamani.com <br><br>';
		$message .= 'Your E-mail OTP to view your astrology prediction is <b>'.$otp.'</b> <br><br>';
		$message .= 'This is a system generated e-mail and please do not reply. <br><br>';
		$message .= 'Regards, <br>';
		$message .= 'Dinamani Astrology Team, <br>';
		$message .= 'www.dinamani.com <br>';
		$this->email->message($message);
		if($this->email->send()){
			$emailSend =1;
		}else{
			$emailSend =0;
		}
		$this->thirumanaporutham_db->where('tmid',$rasiid);
		$this->thirumanaporutham_db->update('thirumanaporutham_master',['email_status' => $emailSend]);
	}
	
	public function mailer(){
		$otp = rand(10,1000);


		$headers  = "Reply-To:<dinamani@dinamani.com>\r\n"; 
		$headers .= "Return-Path:<dinamani@dinamani.com>\r\n";
		$headers .= "From:<dinamani@dinamani.com>\r\n"; 

		$headers .= "Organization: www.dinamani.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

		mail("pandiaraj.m@gmail.com", "Message", "Testing subject.", $headers); 

		

		/*
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = '\r\n';
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from('admin@dinamani.com', 'dinamani.com');
		$this->email->to((@$_GET['q']!='')? @$_GET['q']:'pandiaraj.m@gmail.com');
		$this->email->subject('one time password - dinamani.com');
		$message = 'Dear Dinamni Reader,<br><br>';
		$message .= 'Welcome to www.dinamani.com <br><br>';
		$message .= 'Your E-mail OTP to view your astrology prediction is <b>'.$otp.'</b> <br><br>';
		$message .= 'This is a system generated e-mail and please do not reply. <br><br>';
		$message .= 'Regards, <br>';
		$message .= 'Dinamani Astrology Team, <br>';
		$message .= 'www.dinamani.com <br>';
		$this->email->message($message);
		if($this->email->send()){
			echo 'send';
		}else{
			echo 'not send';
		}

		*/
	}


}
?>