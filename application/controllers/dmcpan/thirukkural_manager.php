<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thirukkural_manager extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url'); 
		$this->load->model('admin/thirukkural_model');
		$this->load->library('form_validation');
		$this->load->library('session'); 		
	} 
	public function index()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name("Thirukkural");
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW". $data['Menu_id']) == 1) 
		{
			$data['title']		= 'Thirukkural Manager';
			$data['template'] 	= 'thirukkural_manager';
			$this->load->view('admin_template',$data);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/thirukkural_manager');
		}
	}
	public function view_addform()
	{
		$set_object = new kural_form;
		return $set_object->view_addform();
	}
	public function addthirukkuraldetails()
	{
		$set_object = new kural_form;
		return $set_object->addthirukkuraldetails();
	}
	public function get_thirukkural_preview_popup()
	{
		$set_object = new kural_form;
		return $set_object->get_thirukkural_preview_popup();
	}
	public function thirukkural_datatable()
	{
		$set_object = new datatable;
		return $set_object->thirukkural_datatable();
	}
	public function edit_details()
	{
		$set_object=new edit_kuraldetails ;
		$set_object->edit_details();	
	}
	public function check_thirukkural()
	{
		$set_object=new thirukkural;
		$set_object->check_thirukkural();
		
	}
}
class kural_form extends Thirukkural_manager
{
	public function view_addform()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Thirukkural');
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD".$data['Menu_id']) == 1) 
		{
			$final_array['title']		= 'Thirukkural form';
			$final_array['template'] 	= 'thirukkural_form';
			$this->load->view('admin_template',$final_array);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/add_thirukkural');
		}
	}
	public function addthirukkuraldetails()
	{
			$hdn_kural_id=$this->input->post('txthiddenid');
			$this->form_validation->set_rules('txtbiography','Biography','xss_clean');
			 
			if($this->form_validation->run() == FALSE)
			{ 
				$data['title']		= 'Thirukkural Manager';
				$data['template'] 	= 'thirukkural_form';
				$this->load->view('admin_template',$data);
			}
			else
			{  
				$this->thirukkural_model->addthirukkuraldetails(USERID);
			} 
	}
	
	public function get_thirukkural_preview_popup()
    {
		extract($_POST);
		$data['kural_meaning']			= urldecode($body_text);
		$data['kural_line1']			= $kurral_line1;
		$data['kural_line2']			= $kurral_line2;
		$data['kural_series']			= $series;
		$data['kural_athikaram']		= $athigaram;
		$data['kural_font']		        = $kural_font;
		
		echo $this->load->view('admin/thirukkural_preview_popup',$data);
	}
	
}
class datatable extends Thirukkural_manager
{
	public function thirukkural_datatable()
	{
		$this->thirukkural_model->datatable_thirukkural();
	}
}
class edit_kuraldetails extends Thirukkural_manager
{
	public function edit_details()
	{
		$data['Menu_id'] = get_menu_details_by_menu_name('Thirukkural');
		if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == 1) 
		{
			$input_kural_id = $this->uri->segment(4);
			$final_array['kuraleditdetails']= $this->thirukkural_model->editkuraldetails($input_kural_id); 
			//$final_array = array_merge($rawdata,$roleeditdetails,$department);
			$final_array['title']		= 'Thirukkural form';
			$final_array['template'] 	= 'thirukkural_form';
			$this->load->view('admin_template',$final_array);
		}
		else 
		{
			redirect('dmcpan/common/access_permission/edit_thirukkural');
		}
	}
	
}
class thirukkural extends Thirukkural_manager
{
	public function check_thirukkural()
	{
		 $thirukkural_exist= $this->thirukkural_model->thirukkural_check();
		 if($thirukkural_exist > 0)
		{
			echo "Thirukkural already exists";
			return FALSE;
		}	
		else
		{
			return TRUE;
		}
		
	}
	
	
}
