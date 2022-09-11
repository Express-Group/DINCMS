<?php 
class numerology_dailyPrediction_model extends CI_Model
{

	public function get_numerology_dailypredictions()  
	{	
		$class_obj = new daily_predictions;
		return $class_obj->get_dailyPredictions();
	}
	
	public function get_number_list()  
	{	
		$this->db->reconnect();
		$result =  $this->db->query('CALL get_number_Ids()')->result_array();
		return $result;
	}
	
	public function get_daily_predictions($prediction_id = '')  
	{	
		$this->db->reconnect();
		$result =  $this->db->query("CALL get_numerology_dailyPredictionById('".$prediction_id."')")->row_array();
		return $result;
	}
	
	public function manipulate($user_id)
	{
		$class_obj = new manipulate_daily_predictions;
		return $class_obj->insert_update($user_id);
	}
	
	public function check_alreadyExists()
	{
		$number_id = trim($this->input->post('number_id'));
		$prediction_id = trim($this->input->post('prediction_id'));
		$date=$this->input->post('schd_date');
		$date_format = date('Y-m-d',strtotime($date));
		//error_log("CALL check_numerologyDailyPrediction_exists('".$raasi_id."', '".$date_format."', '".$prediction_id."')");
		$check_data = $this->db->query("CALL check_numerologyDailyPrediction_exists('".$number_id."', '".$date_format."', '".$prediction_id."')");
		return $check_data->num_rows();
	}
	
}


class daily_predictions extends numerology_dailyPrediction_model
{
	public function get_dailyPredictions()
	{
		extract($_POST);
		
		$Field = $order[0]['column'];
		$order = $order[0]['dir'];

		switch ($Field)
			{
			case 0:
				$order_field = 'prediction_date';
				break;
			case 1:
				$order_field = 'Sectionname';
				break;
			case 2:
				$order_field = 'Username';
				break;
			case 3:
				$order_field = 'modified_on';
				break;
			default:
			$order_field = 'prediction_date';
			}
		
		$this->db->reconnect();
		$Total_rows = $this->db->query('CALL get_numerology_DailyPrediction("","","","")')->num_rows();
		
		$this->db->reconnect();
		
		if($from_date != '')  {
		$check_in_date 	= new DateTime($from_date);
		$from_date = $check_in_date->format('Y-m-d');
		}
		
		if($to_date != '')  {
		$check_out_date = new DateTime($to_date);
		$to_date = $check_out_date->format('Y-m-d');
		}
		
		$dailyPrediction_values =  $this->db->query('CALL get_numerology_DailyPrediction(" ORDER BY '.$order_field.' '.$order.' LIMIT '.$start.', '.$length.'","'.$from_date.'","'.$to_date.'","'.$number_id.'")')->result_array();

		$this->db->reconnect();

		$recordsFiltered =  $this->db->query('CALL get_numerology_DailyPrediction("","'.$from_date.'","'.$to_date.'","'.$number_id.'")')->num_rows();
		$data['draw'] = $draw;
		$data["recordsTotal"] = $Total_rows;
  		$data["recordsFiltered"] = $recordsFiltered ;
		$data['data'] = array();
		$Count = 0;
		
		$Menu_id = get_menu_details_by_menu_name('Daily Prediction');
		
		foreach($dailyPrediction_values as $daily_prediction) {
			
			$subdata = array();
		
			$subdata[] = date("d-m-Y",strtotime($daily_prediction['prediction_date']));
			$subdata[] = $daily_prediction['Sectionname'];
			$subdata[] = $daily_prediction['Username'];
			$subdata[] =  date("d-m-Y H:i:s",strtotime($daily_prediction['modified_on']));
		
			
			$set_rights = "";
			
			if(defined("USERACCESS_EDIT".$Menu_id) && constant("USERACCESS_EDIT".$Menu_id) == '1'){
				$set_rights .= '<div class="buttonHolder"><a class="button heart tooltip-3"  href="'.base_url().'dmcpan/numerology_daily_prediction/update_daily_predictions/'.urlencode(base64_encode($daily_prediction['prediction_id'])).'" data-toggle="tooltip" title="Edit"> <i class="fa fa-pencil" ></i> </a>';
			} else { $set_rights.="";			}
			
			if(defined("USERACCESS_DELETE".$Menu_id) && constant("USERACCESS_DELETE".$Menu_id) == '1')			{
			//$set_rights .= '<a class="button heart tooltip-3" href="#" data-toggle="tooltip" onclick="delete_dailyPrediction('.$daily_prediction['prediction_id'].')" title="Move to Trash"  id=""> <i class="fa fa-trash-o"></i> </a></div>'; 
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

class manipulate_daily_predictions extends numerology_dailyPrediction_model 
{
	public function delete_last($raasi_name,$dat)
    {  
	   // print_r($_POST);exit;
	   $query = $this->db->query("CALL delete_last_record ('".$raasi_name."', '".$dat."','sel','numerology_daily_predictions')")->result_array();
	
		$created_on = array();
		foreach( $query  as $content_val)
		{
			$created_on[] = $content_val['prediction_date'];
		}
	//	print_r($created_on);
	   $datt = end($created_on);
		 
		 $query1 = $this->db->query("CALL delete_last_record ('".$raasi_name."', '".$datt."','del','numerology_daily_predictions')");
		

    }
	public function insert_update($user_id)
	{
		extract($_POST);
		
		if($prediction_date != '')  {
			$Date = strtotime($prediction_date);
			$Date = date('Y-m-d', $Date);
		}
		
		
		if($hidden_id == "")
		{
			$raasi_name=$number_id;
			$dat =date('Y-m-d'); 
			$this->delete_last($raasi_name,$dat);
			$this->db->trans_begin();
			$this->db->reconnect();				
			
			$this->db->query("CALL numerology_dailyPrediction_insert('".$number_id."', '".$Date."', '".$txtPredictionDetails."','".$user_id."','".date('Y-m-d H:i:s')."','".$user_id."','".date('Y-m-d H:i:s')."')");
			
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while inserting. Please try again");
				redirect('dmcpan/numerology_daily_prediction');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Inserted Successfully');
				redirect('dmcpan/numerology_daily_prediction');
			}
		}
		else
		{
			$this->db->trans_begin();
			$this->db->reconnect();
		
			$this->db->query("CALL numerology_dailyPrediction_update('".$number_id."', '".$Date."','".$txtPredictionDetails."','".$user_id."','".date('Y-m-d H:i:s')."','".$user_id."','".date('Y-m-d H:i:s')."', '".$hidden_id."')");
						
			if($this->db->trans_status() == FALSE)
			{
				$this->db->trans_rollback();
				$this->session->set_flashdata('error', "Problem while updating. Please try again");
				redirect('dmcpan/numerology_daily_prediction');
			}
			else
			{
				$this->db->trans_commit();
				$this->session->set_flashdata('success', 'Updated Successfully');
				redirect('dmcpan/numerology_daily_prediction');
			}
		
		}
	
	}


}

?>