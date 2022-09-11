<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Numerology_daily_prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/numerology_dailyPrediction_model');
	}
	
	public function index()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Daily Prediction');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Numerology - Daily Predictions';
			$data['template'] 	= 'numerology_daily_predictions';
			$data['number_lists'] = $this->get_number_list();
			//$data['results'] = 
			$this->load->view('admin_template',$data);
			
		}
		else 
		{ 
			redirect('dmcpan/common/access_permission/numerology_daily_prediction');		
		}
	}
	
	public function create_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Daily Prediction');	
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') 
		{
			$data['title']		= 'Create Daily Predictions';
			$data['template'] 	= 'numerology_daily_prediction_form';
			$data['number_lists'] = $this->get_number_list();
			$this->load->view('admin_template',$data);
		}
		else
		{
			redirect('dmcpan/common/access_permission/add_daily_predictions');		
		}
	}
	
	public function update_daily_predictions()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Daily Prediction');
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1') 
		{			
			$raasi_id = base64_decode(urldecode($this->uri->segment(4))); 
			$data['number_lists'] = $this->get_number_list();
			$data['fetch_values'] = $this->numerology_dailyPrediction_model->get_daily_predictions($raasi_id);
			$data['title']		= 'Edit Daily Predictions';
			$data['template'] 	= 'numerology_daily_prediction_form';
			$this->load->view('admin_template',$data);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/edit_daily_predictions');		
		}
		
	}
	
	public function add_daily_predictions() //func for inerting values
	{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtPredictionDetails','Daily Predicitons', 'trim|required');			
			$this->form_validation->set_rules('number_id','Number List','trim|required|strip_tags|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->create_page();
			}
			else
			{
				$this->numerology_dailyPrediction_model->manipulate(USERID);
			}
	}
	
	public function get_numerology_dailypredictions(){
		$this->numerology_dailyPrediction_model->get_numerology_dailypredictions();	
	}
	
	public function get_number_list(){
		return $this->numerology_dailyPrediction_model->get_number_list();	
	}

	public function check_alreadyExists()
	{
		$rows = $this->numerology_dailyPrediction_model->check_alreadyExists();
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
}

?>