<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class panchangam_manager extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/panchangam_model');
	}
	
	public function check_date()
	{
		$date_exists = $this->panchangam_model->check_date_exists();
		if($date_exists > 0)
		{
			echo "exists";
			return FALSE;
		}	
		else
		{
			echo "success";
			return TRUE;
		}
	}
	
	public function index()
	{
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Panchangam');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == '1') 
		{
			
			$data['title']		= 'Panchangam';
			$data['template'] 	= 'panchangam_manager';
			$this->load->view('admin_template',$data);
			
		}
		else 
		{ 
			redirect('dmcpan/common/access_permission/panchangam_manager');		
		}
	}
	
	public function update_panchangam()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Panchangam');
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1') 
		{
			
		$panchangam_id = base64_decode(urldecode($this->uri->segment(4))); 
		$data['fetch_values'] = $this->panchangam_model->select_panchangam($panchangam_id)->row_array();
		$data['title']		= 'Edit Panchangam';
		$data['template'] 	= 'panchangam';
		$this->load->view('admin_template',$data);
		
		}		else { redirect('dmcpan/common/access_permission/edit_panchangam');		}
		
	}
	public function create_page()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Panchangam');
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD". $data['Menu_id']) == '1') {
			$data['title']		= 'Create Panchangam';
			$data['template'] 	= 'panchangam';
			$this->load->view('admin_template',$data);
		} else {			redirect('dmcpan/common/access_permission/add_panchangam');		}
	}
	public function add_panchangam() //func for inerting values
	{
			$this->load->library('form_validation');
			
			
			/*$this->form_validation->set_rules('txtPanjangamMainHome','Panchangam', 'trim|required');
			$this->form_validation->set_rules('txtPanjangamMainSection','Panchangam', 'trim|required');*/
						
			$this->form_validation->set_rules('txtTamilday','Panchangam', 'trim|required|max_length[15]');
			$this->form_validation->set_rules('txtTamilyearandmonth','Panchangam', 'trim|required');			
			$this->form_validation->set_rules('txtScheduleDate','Date', 'trim|required');
			$this->form_validation->set_rules('txtNallaNeramKalai','NallaneramKalai', 'trim|required');
			$this->form_validation->set_rules('txtNallaNeramMalai','NallaneramMalai', 'trim|required');
			$this->form_validation->set_rules('txtRaaguKaalam','RaaguKaalam', 'trim|required');
			$this->form_validation->set_rules('txtYemmakandam','Yemmakandam', 'trim|required');
			$this->form_validation->set_rules('txtKuligai','Kuligai', 'trim|required');
			$this->form_validation->set_rules('txtThithi','Thithi', 'trim|required');
			$this->form_validation->set_rules('txtChandrashtam','Chandrashtam', 'trim|required');
			$this->form_validation->set_rules('txtPanjangamDetails','Panchangam', 'trim|required');
			$this->form_validation->set_rules('txtNatchatram','Natchatram', 'trim|required');
			
			$this->form_validation->set_rules('txtRishabam','Rishabam', 'trim|required');
			$this->form_validation->set_rules('txtMesham','Mesham', 'trim|required');
			$this->form_validation->set_rules('txtMidunam','Midunam', 'trim|required');
			$this->form_validation->set_rules('txtKadagam','Kadagam', 'trim|required');
			$this->form_validation->set_rules('txtSimham','Simham', 'trim|required');
			$this->form_validation->set_rules('txtKanni','Kanni', 'trim|required');
			$this->form_validation->set_rules('txtThulaam','Thulam', 'trim|required');
			$this->form_validation->set_rules('txtViruchigam','Viruchigam', 'trim|required');
			$this->form_validation->set_rules('txtDhanasu','Dhanasu', 'trim|required');
			$this->form_validation->set_rules('txtMagaram','Magaram', 'trim|required');
			$this->form_validation->set_rules('txtKumbham','Kumbam', 'trim|required');
			$this->form_validation->set_rules('txtMeenam','Meenam', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->create_page();
			}
			else
			{
				$this->panchangam_model->insrt_panchangam(USERID);
			}
	}
	
	public function panchangam_datatable()
	{
		$this->panchangam_model->panchangam_datatable();
	}
	public function delete_data()
	{
		$panchangam_ID = $this->uri->segment(4);
		$this->panchangam_model->delete_panchangam($panchangam_ID);
	}
	public function check_scheduled_date()
	{
		$schd_date= $this->panchangam_model->checkscheduled_date();
		if($schd_date > 0)
		{
			echo "exists";
			//return FALSE;
		}	
		else
		{
			//return TRUE;
		}
	}
	public function get_panchangam_preview_popup()
	{
				//extract();
		/*$data['tamil_year_month']			= urldecode($tamil_year_month);
		$data['tamil_day']			        = $tamil_day;
		$data['nalla_neram_kalai']			= $nalla_neram_kalai;
		$data['nalla_neram_malai']			= $nalla_neram_malai;
		$data['raagu_kaalam']		        = $raagu_kaalam;
		$data['yemmakandam']		        = $yemmakandam;
		$data['kuligai']		            = $kuligai;
		$data['thithi']		                = $thithi;*/
		$data['post_data'] = $_POST;
		
		echo $this->load->view('admin/panchangam_preview_popup',$data);

	}
}

?>