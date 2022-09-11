<?php
class dynamic_table_model extends CI_model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$CI = &get_instance();
		$this->live_db = $CI->load->database('live_db' , TRUE);
	}
	
	public function GetTable(){
		$Data=$this->db->query("CALL gettablemaster()")->result();
		return $Data;
	}
	
	public function add_table($tablename,$total){
		$this->db->insert('tablemaster',array('table_name'=>$tablename,'total'=>$total));
		return $this->db->insert_id();
	}
	public function add_parameter_details($Data,$tid,$total){
		$this->db->where('tid',$tid);
		return $this->db->update('tablemaster',array('table_properties'=>$Data,"total"=>$total));
	}
	public function preview_data($tid){
		return $this->db->query("SELECT table_name,table_properties,total FROM tablemaster WHERE tid='".$tid."' AND status='0'")->result();
	}
	
	public function table_delete($tid){
		$this->db->where('tid',$tid);
		return $this->db->delete('tablemaster');
	}
	
	public function tablename($tid,$tablename){
		$this->db->where('tid',$tid);
		return $this->db->update('tablemaster',array('table_name'=>$tablename));
	}
	
	public function electiontable($title='' , $list='' , $type=1){
		if($type==1){
			$this->live_db->where('lid' , 1);
			return $this->live_db->update('election_table' , ['title' => $title , 'list' => $list , 'modified_on' => date('Y-m-d H:i:s') , 'modified_by' => $this->session->userdata('userID')]);
		}else{
			return $this->live_db->select('*')->from('election_table')->where('lid' , 1)->get()->row_array();
		}
	}
}
?>