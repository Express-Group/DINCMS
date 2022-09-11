<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Numerology_weekly_prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/numerology_weeklyPrediction_model');
	}
	
	public function index()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Weekly Prediction');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Numerology - Weekly Predictions';
			$data['template'] 	= 'numerology_weekly_predictions';
			$data['number_lists'] = $this->get_number_list();
			//$data['results'] = 
			$this->load->view('admin_template',$data);
			
		}
		else 
		{ 
			redirect('dmcpan/common/access_permission/numerology_weekly_prediction');		
		}
	}
	
	public function create_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Weekly Prediction');	
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') 
		{
			$data['title']		= 'Create Weekly Predictions';
			$data['template'] 	= 'numerology_weekly_prediction_form';
			$data['number_lists'] = $this->get_number_list();
			$this->load->view('admin_template',$data);
		}
		else
		{
			redirect('dmcpan/common/access_permission/add_weekly_predictions');		
		}
	}
	
	public function update_weekly_predictions()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Weekly Prediction');
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1') 
		{			
			$raasi_id = base64_decode(urldecode($this->uri->segment(4))); 
			$data['number_lists'] = $this->get_number_list();
			$data['fetch_values'] = $this->numerology_weeklyPrediction_model->get_weekly_predictions($raasi_id);
			$data['title']		= 'Edit Weekly Predictions';
			$data['template'] 	= 'numerology_weekly_prediction_form';
			$this->load->view('admin_template',$data);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/edit_weekly_predictions');		
		}
		
	}
	
	public function add_weekly_predictions() //func for inerting values
	{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtPredictionDetails','Weekly Predicitons', 'trim|required');			
			$this->form_validation->set_rules('number_id','Number List','trim|required|strip_tags|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->create_page();
			}
			else
			{
				$this->numerology_weeklyPrediction_model->manipulate(USERID);
			}
	}
	
	public function get_numerology_weeklypredictions(){
		$this->numerology_weeklyPrediction_model->get_numerology_weeklypredictions();	
	}
	
	public function get_number_list(){
		return $this->numerology_weeklyPrediction_model->get_number_list();	
	}

	public function check_alreadyExists()
	{
		$rows = $this->numerology_weeklyPrediction_model->check_alreadyExists();
		if($rows > 0)
		{
			echo "exists";
			//return FALSE;
		}	
		else
		{
			//return TRUE;
		}
	}
	
	public function change_dateFormat()
	{
	 $selected_date = $this->input->post('selected_date');
	 $curr_date = strtotime($selected_date);
	 $end_date = strtotime("+6 day", $curr_date);
	 $to_date = date('d-m-Y', $end_date);
	 echo $to_date;
	}
}

?>