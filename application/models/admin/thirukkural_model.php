<?php
class Thirukkural_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function datatable_thirukkural()
	{
		$set_object = new thirukkural_list;
		$set_object->datatable_thirukkural();
	}
	function addthirukkuraldetails($userid)
	{
		$set_object = new kuraldetails;
		return $set_object->addthirukkuraldetails($userid);
	}
	function editkuraldetails($input_role_id)
	{
		$set_object = new getkural_details;
		return $set_object->editkuraldetails($input_role_id);
	}
	function thirukkural_check()
	{
		$set_object = new getkural_details;
		return $set_object->thirukkural_check();
		
	}
	
}
class thirukkural_list extends Thirukkural_model
{
	
	public function datatable_thirukkural()
	{
		
		extract($_POST);
		
		$Field = $order[0]['column'];
		$order = $order[0]['dir'];
		
		switch($Field)
		{
			
			case 0:
				$order_field = 't1.MainTitle';
				break;
			case 1:
				$order_field = 't2.Username';
				break;
			case 2:
				$order_field = 't1.Createdon';
				break;
			case 3:
				$order_field = 't1.Status';
				break;
			default:
				$order_field = 't1.MainTitle';
		}
		
		$this->db->reconnect();

		$Total_rows = $this->db->query('CALL thirukkural_datatable("","","","","' . $filterby . '","")')->num_rows();
		
		$this->db->reconnect();
		
		if($from_date != '')
		{
			$check_in_date = new DateTime($from_date);
			$from_date     = $check_in_date->format('Y-m-d');
		}
		
		if($to_date != '')
		{
			$check_out_date = new DateTime($to_date);
			$to_date        = $check_out_date->format('Y-m-d');
		}
		$searchtxt= htmlspecialchars(trim($searchtxt));
		$searchtxt = addslashes(str_replace("'", "&#039;", $searchtxt));
		
		$thirukkural_manager = $this->db->query('CALL thirukkural_datatable(" ORDER BY ' . $order_field . ' ' . $order . ' LIMIT ' . $start . ', ' . $length . '","' . $from_date . '","' . $to_date . '","' . $searchtxt . '","' . $filterby . '","' . $status . '")')->result_array();
		
		$this->db->reconnect();
		
		$recordsFiltered         = $this->db->query('CALL thirukkural_datatable("","' . $from_date . '","' . $to_date . '","' . $searchtxt . '","' . $filterby . '","' . $status . '")')->num_rows();
		$data['draw']            = $draw;
		$data["recordsTotal"]    = $Total_rows;
		$data["recordsFiltered"] = $recordsFiltered;
		$data['data']            = array();
		$Count                   = 0;
		
		
		$data['Menu_id'] = get_menu_details_by_menu_name('Thirukkural');
		foreach($thirukkural_manager as $thirukkural)
		{
			$subdata = array();
			/*if(strlen($thirukkural['First_line']) > 30)
			{
				$subdata[] = '<p class="tooltip_cursor"  title="' . $thirukkural['First_line'] . $thirukkural['Second_line'] . '">' . mb_substr($thirukkural['First_line'].' '.$thirukkural['Second_line'], 0, 20) . '...' . '</p>';
			}
			else
			{*/
				$subdata[] = '<p class="tooltip_cursor thirukkural_title"  title="'.$thirukkural['First_line'] . $thirukkural['Second_line'].'">' .$thirukkural['First_line'].' '.$thirukkural['Second_line'].'</p>';
			//}
			
			
			
			
			//$subdata[] = $thirukkural['First_line'];
			$subdata[] = $thirukkural['Username'];
			$subdata[] = date("d-m-Y H:i:s", strtotime($thirukkural['Createdon']));
			if($thirukkural['Status'] == 1)
				$subdata[] = '<td><i title="Active" class="fa fa-check"></i></td>';
			else
				$subdata[] = '<td><i title="Inactive" class="fa fa-times"></i></td>';
			
			
			
			$set_rights = "";
			if(defined("USERACCESS_EDIT" . $data['Menu_id']) && constant("USERACCESS_EDIT" . $data['Menu_id']) == 1)
			{
				$set_rights .= '<div><a class="button tick" href="' . base_url() . 'dmcpan/thirukkural_manager/edit_details/' . $thirukkural['Thirukkural_id'] . '" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a></div>';
			}
			else
			{
				$set_rights .= "";
			}
			$subdata[] = $set_rights;
			
			
			
			/* if(defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == 1){
			$subdata[] ='<a class="button tick" href="'.base_url().'admin/thirukkural_manager/edit_details/'.$thirukkural['Thirukkural_id'].'" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a>'; 
			
			}
			else 
			{ 
			$set_rights.="";
			}*/
			
			
			
			
			
			
			$data['data'][$Count] = $subdata;
			$Count++;
		}
		
		if($recordsFiltered == 0)
		{
			
		}
		
		echo json_encode($data);
		exit;
		
	}
}
class kuraldetails extends Thirukkural_model
{
	public function addthirukkuraldetails($userid) //fn to list datatable details
	{
		$hdn_kural_id = $this->input->post('txthiddenid');
		$maintitle    = htmlspecialchars(trim($this->input->post('txtMainTitle')));
		$maintitle = addslashes(str_replace("'", "&#039;", $maintitle));
		
		$secondline   = htmlspecialchars(trim($this->input->post('txtMainTitle1')));
		$secondline = addslashes(str_replace("'", "&#039;", $secondline));
		
		//$meaning      = trim($this->input->post('txtMeaning'));
		
		$meaning   = htmlspecialchars(trim($this->input->post('txtMeaning')));
		$meaning = addslashes(str_replace("'", "&#039;", $meaning));
		
		$series       = trim($this->input->post('txtSeries'));
		//$section      = $this->input->post('txtSection');
		$section   = htmlspecialchars(trim($this->input->post('txtSection')));
		$section = addslashes(str_replace("'", "&#039;", $section));
		$fontsize      = $this->input->post('kural_font');
		$status       = $this->input->post('status');
		//$add_advertisement=$this->input->post('chkAdvertisement');
		date_default_timezone_set('Asia/Calcutta');
		$createdon  = date("Y-m-d:H:i:s");
		$modifiedon = date("Y-m-d:H:i:s");
		
		$full_text = $maintitle.' '.$secondline;
		
		$this->db->trans_begin();
		
		if($hdn_kural_id == "")
		{
			if($status == 1)
			{
				$this->db->reconnect();
				$kural_insert_pro = $this->db->query("CALL thirukkural_statusupdate('" . $hdn_kural_id . "')");
				$this->db->reconnect();
				$kural_insert_pro = $this->db->query("CALL thirukkural_insert('" . $maintitle . "','" . $meaning . "','" . $series . "','" . $section . "','" . $status . "','" . $userid . "','" . $createdon . "','" . $secondline . "', '".$fontsize."', '".$full_text."')");
			}
			else
			{
				$this->db->reconnect();
				$kural_insert_pro = $this->db->query("CALL thirukkural_insert('" . $maintitle . "','" . $meaning . "','" . $series . "','" . $section . "','" . $status . "','" . $userid . "','" . $createdon . "','" . $secondline . "', '".$fontsize."', '".$full_text."')");
				
			}
			
			$success_msg =  'Thirukkural details added successfully';
			$fail_msg = "Problem while updating. Please try again";
		}
		else
		{
			if($status == 1)
			{
				$this->db->reconnect();
				$kural_insert_pro = $this->db->query("CALL thirukkural_statusupdate('" . $hdn_kural_id . "')");
				$this->db->reconnect();
				$role_insert_pro = $this->db->query("CALL thirukkural_update('" . $maintitle . "','" . $meaning . "','" . $series . "','" . $section . "','" . $status . "','" . $userid . "','" . $modifiedon . "','" . $hdn_kural_id . "','" . $secondline . "', '".$fontsize."', '".$full_text."')");
			}
			else
			{
				$this->db->reconnect();
				$role_insert_pro = $this->db->query("CALL thirukkural_update('" . $maintitle . "','" . $meaning . "','" . $series . "','" . $section . "','" . $status . "','" . $userid . "','" . $modifiedon . "','" . $hdn_kural_id . "','" . $secondline . "', '".$fontsize."', '".$full_text."')");
				
			}
			
			$success_msg =  'Thirukkural details updated successfully';
			$fail_msg = "Problem while updating. Please try again";
		}
		
		if($this->db->trans_status() == FALSE)
		{
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', $fail_msg);
			redirect(base_url().'dmcpan/thirukkural_manager');
		}
		else
		{
			$this->db->trans_commit();
			$this->session->set_flashdata('success', $success_msg);
			 redirect(base_url().'dmcpan/thirukkural_manager');
		}
		
	}
	
	
}

class getkural_details extends Thirukkural_model
{
	public function editkuraldetails($input_kural_id)
	{
		$this->db->reconnect();
		$section_edit = $this->db->query("CALL thirukkural_editdetails('" . $input_kural_id . "')");
		return $section_edit->result_array();
	}
	public function thirukkural_check()
	{
		//$thirukkural = $this->input->post('title');
		//$secondline = $this->input->post('secondline');
		
		$thirukkural    = htmlspecialchars(trim($this->input->post('title')));
		$thirukkural = addslashes(str_replace("'", "&#039;", $thirukkural));
		
		$secondline   = htmlspecialchars(trim($this->input->post('secondline')));
		$secondline = addslashes(str_replace("'", "&#039;", $secondline));
		
		
		$kuralid     = $this->input->post('kural_id');
		$this->db->reconnect();
		$dpt_name = $this->db->query("CALL check_thirukkural('" . $thirukkural . "','" . $kuralid . "' ,'" . $secondline . "')");
		return $dpt_name->num_rows();
		
	}
}

?>