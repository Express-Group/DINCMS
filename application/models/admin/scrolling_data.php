<?php
Class scrolling_data extends CI_Model{

	public function __construct(){
		parent::__construct();
		
		$this->load->database();
	}
	
	public function fetch_scrolling_data(){
		$content=$this->db->query("SELECT sid,content,created_on ,title,image FROM scrolling_newsmaster WHERE status=1 ORDER BY created_on ASC")->result();
		return $content;
	}
	
	public function fetch_highlights_data(){
		$content=$this->db->query("SELECT hid,content,created_on FROM highligts_newsmaster WHERE status=1 ORDER BY created_on ASC")->result();
		return $content;
	}
	
	public function save_scrolling_data($data ,$table='scrolling_newsmaster'){
		return $this->db->insert($table,$data);
		
	}
	
	public function save_edit_scrolling_data($data,$sid ,$type=1){
		if($type==1){
			$this->db->where('sid',$sid);
			return $this->db->update('scrolling_newsmaster',$data);
		}else{
			$this->db->where('hid',$sid);
			return $this->db->update('highligts_newsmaster',$data);
		}
		
	}
	
	public function delete_data($sid ,$type=1){
		if($type==1){
			$this->db->where('sid',$sid);
			return $this->db->delete('scrolling_newsmaster');
		}else{
			$this->db->where('hid',$sid);
			return $this->db->delete('highligts_newsmaster');
		}
		
	}
	
	public function fetch_edit_news_data($sid ,$type=1){
		if($type==1){
			return $this->db->query("SELECT * FROM scrolling_newsmaster WHERE sid='".$sid."'")->result();	
		}else{
			return $this->db->query("SELECT * FROM highligts_newsmaster WHERE hid='".$sid."'")->result();	
		}	
	}

}
?>