<?php 
class panchangam_model extends CI_Model
{
	public function update_schedule_status()
	{
		
	}
	public function insrt_panchangam($user_id)
	{	
		//die();
		$object = new panchangam_subclass();
		return $object->insrt_panchangam($user_id);
	}
	public function panchangam_datatable()
	{
		$class_obj = new panchangam_datatable_subclass;
		return $class_obj->panchangam_datatable();
	}
	
	public function select_panchangam($panchangam_id)
	{
		$class_obj = new panchangam;
		return $class_obj->select_panchangam($panchangam_id);
	}
	
	public function delete_panchangam($panchangam_id)
	{
		$class_obj = new panchangam;
		return $class_obj->delete_panchangam($panchangam_id);
	}
	
	public function check_date_exists()
	{
		$schedule_date = trim($this->input->post('schedule_date'));
		
		$Date = strtotime($schedule_date);
			$schedule_date = date('Y-m-d', $Date);
			
		$hidden_id = trim($this->input->post('hidden_id'));
		$check_date = $this->db->query("CALL check_panchangamDate_exists('".$schedule_date."', '".$hidden_id."')");
		return $check_date->num_rows();
	}
	public function checkscheduled_date()
	{
		$class_obj = new panchangam;
		return $class_obj->checkscheduled_date();
		
	}
}

class panchangam extends panchangam_model
{
	public function select_panchangam($panchangam_id)
	{
		$this->db->reconnect();
		$fetch_values = $this->db->query("CALL select_panchangam('".$panchangam_id."')");
		return $fetch_values;
	}
	public function delete_panchangam($panchangam_id)
	{
		$this->db->reconnect();
		$fetch_values = $this->db->query("CALL delete_panchangam('".$panchangam_id."')");
		$affected_rows = $this->db->affected_rows();
		if($fetch_values == true)
		{
			$this->session->set_flashdata('success', 'Deleted successfully');
			redirect(base_url().'dmcpan/panchangam_manager');
		}
		else
		{
			$this->session->set_flashdata('error', "Problem while deleting. Please try again");
			redirect('dmcpan/panchangam_manager');		
		}
	}
	public function checkscheduled_date()
	{
		$date=$this->input->post('schd_date');
		//$date_format=date('Y-m-d',strtotime($date));
		$id=$this->input->post('panchangamid');
		$this->db->reconnect();
		//error_log("CALL check_panchangamDate_exists('".$date."','".$id."')");
		$status = $this->db->query("CALL check_panchangamDate_exists('".$date."','".$id."')");
		$affected_rows = $status->num_rows();	
		return $affected_rows;	
	}
}
class panchangam_subclass extends panchangam_model
{
	public function insrt_panchangam($user_id)
	{
		extract($_POST);
		
		//echo $txtScheduleDate;exit;
		
		$currentdate=date('d-m-Y');
		$today = $currentdate;
		$yesterday = date('d-m-Y', strtotime($today . " - 1 day"));
		//echo $yesterday;

		//echo date('d.m.Y',strtotime("-1 days"));exit;
		/*if(trim($txtScheduleDate) == trim($currentdate))
		{
			$set_status = "A";
		}
		elseif(trim($txtScheduleDate) == trim($yesterday)) 
		{
			$set_status = "I";
		}
		else
		{
			$set_status = "S";
		}*/
			
		
		if($txtScheduleDate != '')  {
			$Date = strtotime($txtScheduleDate);
			$Date = date('Y-m-d', $Date);
		}
			
		//echo $Date;exit;	
				
		if($panchangam_id == "")
		{	
			$this->db->trans_begin();
			$this->db->reconnect();				
			
			$query = $this->db->query("CALL panchangam_insert('".$Date."','".$txtTamilday."','".$txtTamilyearandmonth."', '".$txtNallaNeramKalai."','".$txtNallaNeramMalai."','".$txtRaaguKaalam."','".$txtYemmakandam."','".$txtKuligai."','".$txtThithi."','".$txtChandrashtam."', '".$txtPanjangamDetails."', '".$txtMesham."', '".$txtRishabam."', '".$txtMidunam."', '".$txtKadagam."', '".$txtSimham."', '".$txtKanni."', '".$txtThulaam."', '".$txtViruchigam."', '".$txtDhanasu."', '".$txtMagaram."', '".$txtKumbham."', '".$txtMeenam."','".$user_id."','".date('Y-m-d H:i:s')."','".$user_id."','".date('Y-m-d H:i:s')."', '".$txtNatchatram."')");
			
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while inserting. Please try again");
				redirect('dmcpan/panchangam_manager');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Inserted Successfully');
				redirect('dmcpan/panchangam_manager');
			}
		}
		else
		{
			$this->db->trans_begin();
			$this->db->reconnect();
			$query = $this->db->query("CALL panchangam_update('".$Date."','".$txtTamilday."','".$txtTamilyearandmonth."', '".$txtNallaNeramKalai."','".$txtNallaNeramMalai."','".$txtRaaguKaalam."','".$txtYemmakandam."','".$txtKuligai."','".$txtThithi."','".$txtChandrashtam."', '".$txtPanjangamDetails."', '".$txtMesham."', '".$txtRishabam."', '".$txtMidunam."', '".$txtKadagam."', '".$txtSimham."', '".$txtKanni."', '".$txtThulaam."', '".$txtViruchigam."', '".$txtDhanasu."', '".$txtMagaram."', '".$txtKumbham."', '".$txtMeenam."', '".$user_id."','".date('Y-m-d H:i:s')."', '".$panchangam_id."', '".$txtNatchatram."')");
			
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while updating. Please try again");
				redirect('dmcpan/panchangam_manager');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Updated Successfully');
				redirect('dmcpan/panchangam_manager');
			}		
		}
	}
}

class panchangam_datatable_subclass extends panchangam_model
{
	public function panchangam_datatable()
	{
		extract($_POST);
		
		$Field = $order[0]['column'];
		$order = $order[0]['dir'];
		
		$searchtxt = '';
		$search_by = '';
		
		switch ($Field)
			{
			case 0:
				$order_field = 'Panchangam_date';
				break;
			case 1:
				$order_field = 'Username';
				break;
			case 2:
				$order_field = 'Createdon';
				break;
			default:
			$order_field = 'Panchangam_date';
			}
		
		$this->db->reconnect();
		$Total_rows = $this->db->query('CALL panchangam_datatable("","","","","")')->num_rows();
		
		$this->db->reconnect();
		
		if($from_date != '')  {
		$check_in_date 	= new DateTime($from_date);
		$from_date = $check_in_date->format('Y-m-d');
		}
		
		if($to_date != '')  {
		$check_out_date = new DateTime($to_date);
		$to_date = $check_out_date->format('Y-m-d');
		}
		
		$panchangam_values =  $this->db->query('CALL panchangam_datatable(" ORDER BY '.$order_field.' '.$order.' LIMIT '.$start.', '.$length.'","'.$from_date.'","'.$to_date.'","'.$searchtxt.'","'.$search_by.'")')->result_array();	
		
	//	$panchangam_values =  $this->db->query('CALL panchangam_datatable("","'.$from_date.'","'.$to_date.'","'.$searchtxt.'","'.$search_by.'")')->result_array();	

		$this->db->reconnect();
		
		$recordsFiltered =  $this->db->query('CALL panchangam_datatable("","'.$from_date.'","'.$to_date.'","'.$searchtxt.'","'.$search_by.'")')->num_rows();
		$data['draw'] = $draw;
		$data["recordsTotal"] = $Total_rows;
  		$data["recordsFiltered"] = $recordsFiltered ;
		$data['data'] = array();
		$Count = 0;
		
		$Menu_id = get_menu_details_by_menu_name('Panchangam');
		
		foreach($panchangam_values as $panchangam) {
			
			$subdata = array();
	
			$subdata[] =date("d-m-Y",strtotime($panchangam['Panchangam_date']));
			$subdata[] = $panchangam['Username'];
			$subdata[] =  date("d-m-Y H:i:s",strtotime($panchangam['Createdon']));
		
			
			$set_rights = "";
			
			if(defined("USERACCESS_EDIT".$Menu_id) && constant("USERACCESS_EDIT".$Menu_id) == '1'){
				$set_rights .= '<div class="buttonHolder"><a class="button heart tooltip-3"  href="'.base_url().'dmcpan/panchangam_manager/update_panchangam/'.urlencode(base64_encode($panchangam['Panchangam_id'])).'" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a>';
			} else { $set_rights.="";			}
			
			if(defined("USERACCESS_DELETE".$Menu_id) && constant("USERACCESS_DELETE".$Menu_id) == '1')			{
			$set_rights .= '<a class="button heart tooltip-3" href="#" data-toggle="tooltip" onclick="delete_panchangam_value('.$panchangam['Panchangam_id'].')" title="Move to Trash"  id=""> <i class="fa fa-trash-o"></i> </a></div>'; 
			}else {	$set_rights.=""; }
	   
	   		
			$subdata[] = $set_rights;
			$data['data'][$Count] = $subdata;
			$Count++;
		}
		
				if($recordsFiltered == 0) {

				}
		
		echo json_encode($data);
		exit;
		
	}
}
?>