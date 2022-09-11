<?php

class specialwidget extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$CI = &get_instance();
		$this->live_db = $CI->load->database('live_db' , TRUE);
	}
	
	public function corona(){
		
		$data = [];
		$data['active_case_india' ] = $this->input->post('active_case_india');
		$data['deaths_case_india' ] = $this->input->post('deaths_case_india');
		$data['re_case_india' ] = $this->input->post('re_case_india');
		$data['active_case_world' ] = $this->input->post('active_case_world');
		$data['deaths_case_world' ] = $this->input->post('deaths_case_world');
		$data['re_case_world' ] = $this->input->post('re_case_world');
		$data['active_case_tamilnadu' ] = $this->input->post('active_case_tamilnadu');
		$data['deaths_case_tamilnadu' ] = $this->input->post('deaths_case_tamilnadu');
		$data['re_case_tamilnadu' ] = $this->input->post('re_case_tamilnadu');
		$data['url' ] = $this->input->post('re_url');
		$data = json_encode($data);
		$filepath =  FCPATH.'application/views/specialwidget/corona.widget';
		file_put_contents($filepath , $data);
		$post_data = array('file_name' => 'corona.widget','file_contents'=> $data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, BASEURLTEMP.'user/commonwidget/special_widget_put');
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$result=curl_exec ($ch);
		curl_close ($ch);
		echo 1;
	}
	
	public function corona_table(){
		$data = [];
		$data['country' ] = $this->input->post('country');
		$data['active_cases' ] = $this->input->post('active_cases');
		$data['deaths' ] = $this->input->post('deaths');
		$data['recovered' ] = $this->input->post('recovered');
		$data['countrydata' ] = $this->input->post('countrydata');
		$data['active_casesdata' ] = $this->input->post('active_casesdata');
		$data['deathsdata' ] = $this->input->post('deathsdata');
		$data['recovereddata' ] = $this->input->post('recovereddata');
		$data = json_encode($data);
		$filepath =  FCPATH.'application/views/specialwidget/coronatable.widget';
		file_put_contents($filepath , $data);
		$post_data = array('file_name' => 'coronatable.widget','file_contents'=> $data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, BASEURLTEMP.'user/commonwidget/special_widget_put');
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$result=curl_exec ($ch);
		curl_close ($ch);
		echo 1;
	}
	
	public function get_corona(){
		$filepath =  FCPATH.'application/views/specialwidget/corona.widget';
		echo file_get_contents($filepath);
	}
	
	public function get_coronatable(){
		$filepath =  FCPATH.'application/views/specialwidget/coronatable.widget';
		$data = json_decode(file_get_contents($filepath),true);
		$response = [];
		$response['country'] = $data['country'];
		$response['active_cases'] = $data['active_cases'];
		$response['deaths'] = $data['deaths'];
		$response['recovered'] = $data['recovered'];
		$response['ipnuts'] = '';
		for($i=0;$i<count($data['countrydata']);$i++){
			$id = rand()+$i;
			$response['ipnuts'] .='<tr class="tr-'.$id.'">';
			$response['ipnuts'] .='<td><input type="text" value="'.$data['countrydata'][$i].'"></td>';
			$response['ipnuts'] .='<td><input type="text" value="'.$data['active_casesdata'][$i].'"></td>';
			$response['ipnuts'] .='<td><input type="text" value="'.$data['deathsdata'][$i].'"></td>';
			$response['ipnuts'] .='<td><input type="text" value="'.$data['recovereddata'][$i].'"></td>';
			$response['ipnuts'] .='<td><button class="btn btn-primary" onclick="remove_tr('.$id.')">X</button></td>';
			$response['ipnuts'] .='</tr>';
		}
		echo json_encode($response);
	}
	
	public function save_revision(){
		$author_name = $this->input->post('author');
		$description = $this->input->post('description');
		$rid = $this->input->post('rid');
		if($rid!=''){
			$this->live_db->where('rid' , $rid);
			echo $this->live_db->update('revision' , ['author_name' => $author_name , 'description' => $description  , 'modified_by' => USERID , 'modified_on' => date('Y-m-d H:i:s')]);
		}else{
			echo $this->live_db->insert('revision' , ['author_name' => $author_name , 'description' => $description , 'created_by' =>USERID , 'modified_by' => USERID , 'modified_on' => date('Y-m-d H:i:s'), 'year' => date('Y')]);
		}
		
	}
	public function get_revision(){
		$template = '';
		$revision = $this->live_db->query("SELECT rid , author_name , description FROM revision WHERE status=1 ORDER BY rid desc")->result();
		foreach($revision as $result){
			$template .= '<div style="margin-bottom: 2%;border-bottom: 1px solid #eee;padding-bottom: 2%;" class="records" data-rid="'.$result->rid.'" data-author="'.$result->author_name.'" data-description="'.$result->description.'">';
			$template .= '<p style="color:blue;">'.$result->author_name.'</p>';
			$template .= '<p>'.$result->description.'</p>';
			$template .= '<button type="button" class="btn btn-primary edit_revision"><i class="fa fa-pencil"></i></button>';
			$template .= '</div>';
		}
		echo $template;
	}
} 
?>