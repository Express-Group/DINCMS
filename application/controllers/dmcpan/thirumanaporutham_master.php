<?php
class thirumanaporutham_master extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$CI = &get_instance();
		$this->thirumanaporutham_db = $CI->load->database('thirumanaporutham_db' , TRUE);
	}
	
	public function index(){
		$date  =($this->input->get('date')!='') ? $this->input->get('date') : date('Y-m-d');
		$row = (isset($_GET['per_page']) && $_GET['per_page']!='') ? $_GET['per_page'] : 0;
		$data = array();
		$data['title'] = 'Thirumanaporutham - Dinamani';
		$data['template'] = 'thirumaporutham_view';
		$startDate = $date.' 00:00:00';
		$endDate = $date.' 23:59:59';
		$totalRows = $this->thirumanaporutham_db->query("SELECT tmid FROM thirumanaporutham_master WHERE created_on BETWEEN '".$startDate."' AND '".$endDate."'")->num_rows();
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().folder_name.'/thirumanaporutham_master';
		$config['total_rows'] = $totalRows;
		$data['total_rows'] = $totalRows;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		$config['suffix'] = '&date='.$date;
		$config['first_url'] = base_url().folder_name.'/thirumanaporutham_master?date='.$date;
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		//end..
		//fetching records
		$data['records'] = $this->thirumanaporutham_db->query("SELECT tmid, manapen_peyar, manamagam_peyar, email, otp_verified , email_status , result_status, created_on FROM thirumanaporutham_master WHERE created_on BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY created_on DESC LIMIT ".$row." , ".$config['per_page']."")->result();
		$this->load->view('admin_template',$data);
	}
	
	public function view_data($tmid){
		$tmid = urldecode(base64_decode($tmid));
		if($tmid!=''){
			$data['title'] = 'Thirumanaporutham - Dinamani';
			$data['template'] = 'thirumaporutham_result_view';
			$data['records'] = $this->thirumanaporutham_db->query("SELECT tmid, manapen_peyar, manamagam_peyar, manapen_dob, manamagan_dob, manapen_rasi, manamagan_rasi, manapen_nachatiram, manamagan_nachatiram ,  email, otp , otp_verified , email_status , result_status, created_on FROM thirumanaporutham_master WHERE tmid='".$tmid."'")->result();
			$this->load->view('admin_template',$data);
		}else{
			
			echo 'Invalid parameter passed';
		}
	}
	
	public function download(){
		$date  =($this->input->get('date')!='') ? $this->input->get('date') : date('Y-m-d');
		$startDate = $date.' 00:00:00';
		$endDate = $date.' 23:59:59';
		$records = $this->thirumanaporutham_db->query("SELECT tmid, manapen_peyar, manamagam_peyar, email, created_on FROM thirumanaporutham_master WHERE created_on BETWEEN '".$startDate."' AND '".$endDate."' ORDER BY created_on DESC ")->result();
		$filename = "filename=details_".date('his').".xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-disposition: attachment; " .$filename."");
		echo 'Id' . "\t" . 'Manapen Name' . "\t" . 'Manapen Name' . "\t" . 'Email' . "\t" . 'Created on' . "\n";
		foreach($records as $data):
			echo $data->tmid . "\t" . $data->manapen_peyar . "\t" . $data->manamagam_peyar . "\t" . $data->email . "\t". $data->created_on . "\n";
		endforeach;
		
		
	}
	
	
}
?>