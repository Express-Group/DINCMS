<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Numerology_monthly_prediction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/numerology_monthlyPrediction_model');
	}
	
	public function index()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Monthly Prediction');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Numerology - Monthly Predictions';
			$data['template'] 	= 'numerology_monthly_predictions';
			$data['number_lists'] = $this->get_number_list();
			$data['language']    = "english";
			$this->load->view('admin_template',$data);
			
		}
		else 
		{ 
			redirect('dmcpan/common/access_permission/numerology_monthly_prediction');		
		}
	}
	
	public function tamil()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Numerology Monthly Tamil');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Numerology - Tamil Monthly Predictions';
			$data['template'] 	= 'numerology_monthly_predictions';
			$data['number_lists'] = $this->get_number_list();
			$data['language']    = "tamil";
			$this->load->view('admin_template',$data);
			}
		else 
		{ 
			redirect(folder_name.'/common/access_permission/numerology_monthly_prediction/tamil');		
		}
	}
	
	public function create_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Monthly Prediction');	
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') 
		{
			$data['title']		= 'Create Monthly Predictions';
			$data['template'] 	= 'numerology_monthly_prediction_form';
			$data['language']   = 'english'; 
			$data['number_lists'] = $this->get_number_list();
			$this->load->view('admin_template',$data);
		}
		else
		{
			redirect('dmcpan/common/access_permission/add_monthly_predictions');		
		}
	}
	
	public function create_tamil_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Numerology Monthly Tamil');	
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') 
		{
			$data['title']		= 'Create Tamil Monthly Predictions';
			$data['template'] 	= 'numerology_monthly_prediction_form';
			$data['language']   = 'tamil'; 
			$data['number_lists'] = $this->get_number_list();
			$this->load->view('admin_template',$data);
		}
		else
		{
			redirect(folder_name.'/common/access_permission/add_monthly_predictions?lang=tamil');		
		}
	}
	
	public function update_monthly_predictions()
	{
		$language = $this->input->get('lang');
		$menu_name  = ($language!='tamil') ? 'Monthly Prediction': 'Numerology Monthly Tamil';
		$data['Menu_id'] = get_menu_details_by_menu_name($menu_name);
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1') 
		{			
			$raasi_id = base64_decode(urldecode($this->uri->segment(4))); 
			$data['number_lists'] = $this->get_number_list();
			$data['fetch_values'] = $this->numerology_monthlyPrediction_model->get_monthly_predictions($raasi_id);
			$data['title']		= 'Edit '.$language.' Monthly Predictions';
			$data['template'] 	= 'numerology_monthly_prediction_form';
			$data['language']   = $language; 
			$this->load->view('admin_template',$data);
		}
		else 
		{
			redirect(folder_name.'/common/access_permission/edit_monthly_predictions');		
		}
		
	}
	
	public function add_monthly_predictions() //func for inerting values
	{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtPredictionDetails','Monthly Predicitons', 'trim|required');			
			$this->form_validation->set_rules('number_id','Number List','trim|required|strip_tags|xss_clean');
			$language = $this->input->get('lang');
			if($this->form_validation->run() == FALSE)
			{
				if($language=="tamil"){$this->create_tamil_page();}else{$this->create_page();}
			}
			else
			{
				$language = $this->input->post('language');
				 if($language=="tamil"){
				$this->numerology_monthlyPrediction_model->tamil_prediction_manipulate(USERID);
				 }else{
				$this->numerology_monthlyPrediction_model->manipulate(USERID);	 
				 }
			}
	}
	
	public function get_numerology_monthlypredictions(){
		$this->numerology_monthlyPrediction_model->get_numerology_monthlypredictions();	
	}
	
	public function get_number_list(){
		return $this->numerology_monthlyPrediction_model->get_number_list();	
	}

	public function check_alreadyExists()
	{
		$rows = $this->numerology_monthlyPrediction_model->check_alreadyExists();
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
		$date_format = date('Y-m-d',strtotime($selected_date));
		$start_date =  $this->firstOfMonth($date_format);
		$end_date = $this->lastOfMonth($date_format);
		echo $end_date;
	}
	
	public function firstOfMonth($date) {
		return date("d-m-Y", strtotime($date));
	}
	
	public function lastOfMonth($date) {
		return date("d-m-Y", strtotime('-1 second',strtotime('+1 month',strtotime($date))));
	}
	
}

?>