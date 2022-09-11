<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Numerology_general_prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/numerology_generalPrediction_model');
	}
	
	public function index()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('General Prediction');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Numerology - General Predictions';
			$data['template'] 	= 'numerology_general_predictions';
			$data['number_lists'] = $this->get_number_list();
			//$data['results'] = 
			$this->load->view('admin_template',$data);
			
		}
		else 
		{ 
			redirect('dmcpan/common/access_permission/numerology_general_predictions');		
		}
	}
	
	public function create_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('General Prediction');	
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') 
		{
			$data['title']		= 'Create General Predictions';
			$data['template'] 	= 'numerology_general_prediction_form';
			$data['number_lists'] = $this->get_number_list();
			$this->load->view('admin_template',$data);
		}
		else
		{
			redirect('dmcpan/common/access_permission/add_general_predictions');		
		}
	}
	
	public function update_general_predictions()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('General Prediction');
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1') 
		{			
			$number_id = base64_decode(urldecode($this->uri->segment(4))); 
			$data['number_lists'] = $this->get_number_list();
			$data['fetch_values'] = $this->numerology_generalPrediction_model->get_general_predictions($number_id);
			$data['title']		= 'Edit General Predictions';
			$data['template'] 	= 'numerology_general_prediction_form';
			$this->load->view('admin_template',$data);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/edit_general_predictions');		
		}
		
	}
	
	public function add_general_predictions() //func for inerting values
	{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtPredictionDetails','General Predicitons', 'trim|required');			
			$this->form_validation->set_rules('number_id','Number List','trim|required|strip_tags|xss_clean');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->create_page();
			}
			else
			{
				$this->numerology_generalPrediction_model->manipulate(USERID);
			}
	}
	
	public function get_general_predictions(){
		$this->numerology_generalPrediction_model->get_generalPredictions();	
	}
	
	public function get_number_list(){
		return $this->numerology_generalPrediction_model->get_number_list();	
	}

	public function check_alreadyExists()
	{
		$rows = $this->numerology_generalPrediction_model->check_alreadyExists();
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