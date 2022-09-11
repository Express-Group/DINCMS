<?php
Class scrolling_news extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/scrolling_data');
		$this->load->helper('url');
	}
	
	public function index(){

		$data['content']=$this->scrolling_data->fetch_scrolling_data();
		$this->load->view('admin/common/header');
		$this->load->view('admin/scrolling',$data);
		$this->load->view('admin/common/footer');
	
	}
	
	public function save_news(){
		$img = '';
		$news=$this->input->post('scroll_text');
		$title=$this->input->post('headline');
		$this->load->library('upload');
		$config['upload_path']          = source_base_path.'uploads/scroll_news/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('simage')){
			$data =$this->upload->display_errors();
			print_r($data);
			exit;
		}else{
			$data = $this->upload->data();
			$img = $data['file_name'];
		}
		$data = ['status' => 1 , 'content' => $news , 'title' => $title  , 'image' => $img];
		$t =  $this->scrolling_data->save_scrolling_data($data);
		if($t==1){
			redirect('/dmcpan/scrolling_news');
		}
	}
	
	public function save_edit_news(){
		$img = '';
		$news=$this->input->post('scroll_text1');
		$title=$this->input->post('headline1');
		$sid=$this->input->post('edit_new_id');
		$this->load->library('upload');
		$config['upload_path']          = source_base_path.'uploads/scroll_news/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$this->upload->initialize($config);
		if($_FILES["simage1"]["tmp_name"]!=''){
			if ( ! $this->upload->do_upload('simage1')){
				$data =$this->upload->display_errors();
				print_r($data);
				exit;
			}else{
				$data = $this->upload->data();
				$img = $data['file_name'];
			}
		}
		$data = ['status' => 1 , 'content' => $news , 'title' => $title];
		if($img!=''){
			$data['image'] = $img;
		}
		$t =  $this->scrolling_data->save_edit_scrolling_data($data,$sid);
		if($t==1){
			redirect('/dmcpan/scrolling_news');
		}
	
	}
	
	public function delete_news(){
		$sid=$this->input->post('sid');
		echo $this->scrolling_data->delete_data($sid);
	}
	
	public function render_news(){
		$rendered=$this->scrolling_data->fetch_scrolling_data();
		$Template='<ul>';
		foreach($rendered as $data){
			$date=explode(' ',$data->created_on);
			$date=explode(':',$date[1]);
			$date=$date[0].':'.$date[1];
			$Template .='<li><span class="date-color">'.$date.' :</span> <span class="content-color">'.$data->content.'</span></li>';
		}
		$Template .='</ul>';
		echo $Template;
	
	}
	
	public function upload_image(){
		$this->load->library('upload');
		$config['upload_path']          = source_base_path.'uploads/scroll_news/';
		$config['allowed_types']        = 'gif|jpg|png';
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('file'))
		{
			$data =$this->upload->display_errors();
		}
		else
		{
			$data = $this->upload->data();
		}
		echo json_encode($data);
	}
	
	public function fetch_edit_news(){
		$response = [];
		$response['response'] = 0;
		$response['content']='';
		$result = $this->scrolling_data->fetch_edit_news_data($this->input->post('sid'));
		if(count($result) > 0){
			$response['response'] = 1;
			$response['content'] = $result[0]->content;
			$response['headline'] = $result[0]->title;
			$response['image'] = $result[0]->image;
		}
		echo json_encode($response);
	}
	
	public function highligths(){

		$data['content']=$this->scrolling_data->fetch_highlights_data();
		$this->load->view('admin/common/header');
		$this->load->view('admin/highlights',$data);
		$this->load->view('admin/common/footer');
	
	}
	
	public function save_highlights(){
		$news=$this->input->post('scroll_text');
		$data = ['status' => 1 , 'content' => $news ,];
		$t =  $this->scrolling_data->save_scrolling_data($data ,'highligts_newsmaster');
		if($t==1){
			redirect('/dmcpan/scrolling_news/highligths');
		}
	}
	
	public function fetch_highlights(){
		$response = [];
		$response['response'] = 0;
		$response['content']='';
		$result = $this->scrolling_data->fetch_edit_news_data($this->input->post('sid') ,2);
		if(count($result) > 0){
			$response['response'] = 1;
			$response['content'] = $result[0]->content;
		}
		echo json_encode($response);
	}
	
	public function save_edit_highlights(){
		$news=$this->input->post('scroll_text1');
		$sid=$this->input->post('edit_new_id');
		$data = ['status' => 1 , 'content' => $news ,];

		$t =  $this->scrolling_data->save_edit_scrolling_data($data,$sid ,2);
		if($t==1){
			redirect('/dmcpan/scrolling_news/highligths');
		}
	}
	
	public function delete_highlights(){
		$sid=$this->input->post('sid');
		echo $this->scrolling_data->delete_data($sid ,2);
	}


}
?>