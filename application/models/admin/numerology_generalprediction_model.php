<?php 
class numerology_generalPrediction_model extends CI_Model
{

	public function get_generalPredictions()  
	{	
		$class_obj = new general_predictions;
		return $class_obj->get_generalPredictions();
	}
	
	public function get_number_list()  
	{	
		$this->db->reconnect();
		$result =  $this->db->query('CALL get_number_Ids()')->result_array();
		return $result;
	}
	
	public function get_general_predictions($section_id = '')  
	{	
		$this->db->reconnect();
		$result =  $this->db->query("CALL get_numerology_GeneralPredictionBySectionId('".$section_id."')")->row_array();
		return $result;
	}
	
	public function manipulate($user_id)
	{
		$class_obj = new manipulate_general_predictions;
		return $class_obj->insert_update($user_id);
	}
	
	public function check_alreadyExists()
	{
		$number_id = trim($this->input->post('number_id'));
		$prediction_id = trim($this->input->post('prediction_id'));
		//error_log("CALL check_astroGeneralPrediction_exists('".$number_id."','".$prediction_id."')");
		$check_data = $this->db->query("CALL check_numerologyGeneralPrediction_exists('".$number_id."','".$prediction_id."')");
		return $check_data->num_rows();
	}
	
}


class general_predictions extends numerology_generalPrediction_model
{
	public function get_generalPredictions()
	{
		extract($_POST);
		
		$Field = $order[0]['column'];
		$order = $order[0]['dir'];

		switch ($Field)
			{
			case 0:
				$order_field = 'Sectionname';
				break;
			case 1:
				$order_field = 'Username';
				break;
			case 2:
				$order_field = 'modified_on';
				break;
			default:
			$order_field = 'modified_on';
			}
		
		$this->db->reconnect();
		$Total_rows = $this->db->query('CALL get_numerology_GeneralPrediction("","","","")')->num_rows();
		
		$this->db->reconnect();
		
		if($from_date != '')  {
		$check_in_date 	= new DateTime($from_date);
		$from_date = $check_in_date->format('Y-m-d');
		}
		
		if($to_date != '')  {
		$check_out_date = new DateTime($to_date);
		$to_date = $check_out_date->format('Y-m-d');
		}
		
		$generalPrediction_values =  $this->db->query('CALL get_numerology_GeneralPrediction(" ORDER BY '.$order_field.' '.$order.' LIMIT '.$start.', '.$length.'","'.$from_date.'","'.$to_date.'","'.$number_id.'")')->result_array();

		$this->db->reconnect();

		$recordsFiltered =  $this->db->query('CALL get_numerology_GeneralPrediction("","'.$from_date.'","'.$to_date.'","'.$number_id.'")')->num_rows();
		$data['draw'] = $draw;
		$data["recordsTotal"] = $Total_rows;
  		$data["recordsFiltered"] = $recordsFiltered ;
		$data['data'] = array();
		$Count = 0;
		
		$Menu_id = get_menu_details_by_menu_name('General Prediction');
		
		foreach($generalPrediction_values as $general_prediction) {
			
			$subdata = array();
	
			$subdata[] = $general_prediction['Sectionname'];
			$subdata[] = $general_prediction['Username'];
			$subdata[] =  date("d-m-Y H:i:s",strtotime($general_prediction['modified_on']));
		
			
			$set_rights = "";
			
			if(defined("USERACCESS_EDIT".$Menu_id) && constant("USERACCESS_EDIT".$Menu_id) == '1'){
				$set_rights .= '<div class="buttonHolder"><a class="button heart tooltip-3"  href="'.base_url().'dmcpan/numerology_general_prediction/update_general_predictions/'.urlencode(base64_encode($general_prediction['section_id'])).'" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a>';
			} else { $set_rights.="";			}
			
			if(defined("USERACCESS_DELETE".$Menu_id) && constant("USERACCESS_DELETE".$Menu_id) == '1')			{
			//$set_rights .= '<a class="button heart tooltip-3" href="#" data-toggle="tooltip" onclick="delete_generalPrediction('.$general_prediction['prediction_id'].')" title="Move to Trash"  id=""> <i class="fa fa-trash-o"></i> </a></div>'; 
			$set_rights.="";
			}else {	$set_rights.=""; }
	   
	   		
			$subdata[] = $set_rights;
			$data['data'][$Count] = $subdata;
			$Count++;
		}
		
		
		echo json_encode($data);
		exit;
		
	}
}

class manipulate_general_predictions extends numerology_generalPrediction_model 
{
	public function insert_update($user_id)
	{
		extract($_POST);
		/*
		if($prediction_date != '')  {
			$Date = strtotime($prediction_date);
			$Date = date('Y-m-d', $Date);
		}*/
		
		
		if($hidden_id == "")
		{
			$this->db->trans_begin();
			$this->db->reconnect();				
			
			$this->db->query("CALL numerology_generalPrediction_insert('".$number_id."', '".$txtPredictionDetails."','".$user_id."','".date('Y-m-d H:i:s')."','".$user_id."','".date('Y-m-d H:i:s')."')");
			
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while inserting. Please try again");
				redirect('dmcpan/numerology_general_prediction');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Inserted Successfully');
				redirect('dmcpan/numerology_general_prediction');
			}
		}
		else
		{
			$this->db->trans_begin();
			$this->db->reconnect();
		
			$this->db->query("CALL numerology_generalPrediction_update('".$number_id."','".$txtPredictionDetails."','".$user_id."','".date('Y-m-d H:i:s')."','".$user_id."','".date('Y-m-d H:i:s')."', '".$hidden_id."')");
			
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while updating. Please try again");
				redirect('dmcpan/numerology_general_prediction');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Updated Successfully');
				redirect('dmcpan/numerology_general_prediction');
			}
		
		}
	
	}


}

?>