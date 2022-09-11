<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Election_master extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$CI = &get_instance();
		$this->live_db = $CI->load->database('live_db' ,TRUE);
	}
	
	public function index(){
		$data['Menu_id'] = get_menu_details_by_menu_name('Election Master');
		if(defined("USERACCESS_VIEW".$data['Menu_id']) && constant("USERACCESS_VIEW".$data['Menu_id']) == 1){
			$this->load->library('pagination');
			$data['title'] = 'Election manager';
			$data['template'] 	= 'election_manager';
			$search = '';
			$config['suffix'] ='';
			if(trim($this->input->get('query'))!=''){
				$search .=" AND constituency_name LIKE '%".trim($this->input->get('query'))."%'";
				$config['suffix'] .='&query='.trim($this->input->get('query'));
			}
			if(trim($this->input->get('status'))!=''){
				$search .=" AND status = '".trim($this->input->get('status'))."'";
				$config['suffix'] .='&status='.trim($this->input->get('status'));
			}
			$page = ($this->input->get('per_page')!='') ? $this->input->get('per_page') : 0;
			$totalRows = $this->live_db->query("SELECT eid FROM election_master WHERE eid!='' ".$search."")->num_rows;
			$config['base_url'] = base_url(folder_name.'/election_master');
			$config['total_rows'] = $totalRows;
			$config['per_page'] = 50;
			$config['num_links'] = 2;
			$config['page_query_string'] = TRUE;
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['data'] = $this->live_db->query("SELECT eid , constituency_name , status FROM election_master WHERE eid!='' ".$search." ORDER BY constituency_name ASC LIMIT ".$page." , ".$config['per_page']."")->result();
			$this->load->view('admin_template',$data);
		}else{
			redirect(folder_name.'/common/access_permission/election_master');
		}
	}
	
	public function add(){
		$data1['Menu_id'] = get_menu_details_by_menu_name('Election Master');
		if(defined("USERACCESS_VIEW".$data1['Menu_id']) && constant("USERACCESS_VIEW".$data1['Menu_id']) == 1){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('constituency_name', 'தொகுதியின் பெயர்', 'required|trim');
			/* $this->form_validation->set_rules('total_votes', 'மொத்த வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('voted_count', 'பதிவு செய்யப்பட்ட வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('total_votes1', 'மொத்த வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('voted_count1', 'பதிவு செய்யப்பட்ட வாக்குகள்', 'required|trim'); */
			
			if ($this->form_validation->run() == FALSE){
                $data1['title'] = 'Add Election manager';
				$data1['template'] 	= 'addelection_manager';
				$this->load->view('admin_template',$data1);
            }else{
				$this->load->library('upload');
				$data['constituency_name'] = trim($this->input->post('constituency_name'));
				$data['total_votes1'] = trim($this->input->post('total_votes'));
				$data['voted_count1'] = trim($this->input->post('voted_count'));
				$data['candidate_name1'] = trim($this->input->post('candidate_name'));
				$data['party1'] = trim($this->input->post('party'));
				$data['about_candidate1'] = trim($this->input->post('about_candidate'));
				$data['vote1'] = trim($this->input->post('vote'));
				$data['candidate_name2'] = trim($this->input->post('candidate_name2'));
				$data['party2'] = trim($this->input->post('party2'));
				$data['about_candidate2'] = trim($this->input->post('about_candidate2'));
				$data['vote2'] = trim($this->input->post('vote2'));
				$data['total_votes3'] = trim($this->input->post('total_votes1'));
				$data['voted_count3'] = trim($this->input->post('voted_count1'));
				$data['candidate_name3'] = trim($this->input->post('candidate_name1'));
				$data['party3'] = trim($this->input->post('party1'));
				$data['about_candidate3'] = trim($this->input->post('about_candidate1'));
				$data['vote3'] = trim($this->input->post('vote1'));
				$data['candidate_name4'] = trim($this->input->post('candidate_name12'));
				$data['party4'] = trim($this->input->post('party12'));
				$data['about_candidate4'] = trim($this->input->post('about_candidate12'));
				$data['vote4'] = trim($this->input->post('vote12'));
				$config['upload_path'] = destination_base_path.'images/electionmaster/';
				$config['allowed_types'] ='*';
				$this->upload->initialize($config);
				if(!empty($_FILES['party_image']['name'])){
					if($this->upload->do_upload('party_image')){
						$img1 = $this->upload->data();
						$data['party_image1'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image']['name'])){
					if($this->upload->do_upload('candidate_image')){
						$img1 = $this->upload->data();
						$data['candidate_image1'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image2']['name'])){
					if($this->upload->do_upload('party_image2')){
						$img1 = $this->upload->data();
						$data['party_image2'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image2']['name'])){
					if($this->upload->do_upload('candidate_image2')){
						$img1 = $this->upload->data();
						$data['candidate_image2'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image1']['name'])){
					if($this->upload->do_upload('party_image1')){
						$img1 = $this->upload->data();
						$data['party_image3'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image1']['name'])){
					if($this->upload->do_upload('candidate_image1')){
						$img1 = $this->upload->data();
						$data['candidate_image3'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image12']['name'])){
					if($this->upload->do_upload('party_image12')){
						$img1 = $this->upload->data();
						$data['party_image4'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image12']['name'])){
					if($this->upload->do_upload('candidate_image12')){
						$img1 = $this->upload->data();
						$data['candidate_image4'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['constituency_image']['name'])){
					if($this->upload->do_upload('constituency_image')){
						$img1 = $this->upload->data();
						$data['constituency_image'] = $img1['file_name'];
					}
				}
				$data['created_by'] = $data['modified_by'] = $this->session->userdata('userID');
				$data['modified_on'] = date('Y-m-d H:i:s');
				$result = $this->live_db->insert('election_master' , $data);
				if($result==1){
					redirect(folder_name.'/election_master');
				}
				
			}
			
		}else{
			redirect(folder_name.'/common/access_permission/election_master');
		}
	}
	
	public function edit($eid){
		$data1['Menu_id'] = get_menu_details_by_menu_name('Election Master');
		if(defined("USERACCESS_VIEW".$data1['Menu_id']) && constant("USERACCESS_VIEW".$data1['Menu_id']) == 1){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('constituency_name', 'தொகுதியின் பெயர்', 'required|trim');
			/* $this->form_validation->set_rules('total_votes', 'மொத்த வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('voted_count', 'பதிவு செய்யப்பட்ட வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('total_votes1', 'மொத்த வாக்குகள்', 'required|trim');
			$this->form_validation->set_rules('voted_count1', 'பதிவு செய்யப்பட்ட வாக்குகள்', 'required|trim'); */
			
			if ($this->form_validation->run() == FALSE){
                $data1['title'] = 'Edit Election manager';
				$data1['template'] 	= 'editelection_manager';
				$data1['data'] 	= $this->live_db->query("SELECT * FROM election_master WHERE eid='".$eid."'")->row_array();
				$this->load->view('admin_template',$data1);
            }else{
				$this->load->library('upload');
				$data['constituency_name'] = trim($this->input->post('constituency_name'));
				$data['total_votes1'] = trim($this->input->post('total_votes'));
				$data['voted_count1'] = trim($this->input->post('voted_count'));
				$data['candidate_name1'] = trim($this->input->post('candidate_name'));
				$data['party1'] = trim($this->input->post('party'));
				$data['about_candidate1'] = trim($this->input->post('about_candidate'));
				$data['vote1'] = trim($this->input->post('vote'));
				$data['candidate_name2'] = trim($this->input->post('candidate_name2'));
				$data['party2'] = trim($this->input->post('party2'));
				$data['about_candidate2'] = trim($this->input->post('about_candidate2'));
				$data['vote2'] = trim($this->input->post('vote2'));
				$data['total_votes3'] = trim($this->input->post('total_votes1'));
				$data['voted_count3'] = trim($this->input->post('voted_count1'));
				$data['candidate_name3'] = trim($this->input->post('candidate_name1'));
				$data['party3'] = trim($this->input->post('party1'));
				$data['about_candidate3'] = trim($this->input->post('about_candidate1'));
				$data['vote3'] = trim($this->input->post('vote1'));
				$data['candidate_name4'] = trim($this->input->post('candidate_name12'));
				$data['party4'] = trim($this->input->post('party12'));
				$data['about_candidate4'] = trim($this->input->post('about_candidate12'));
				$data['vote4'] = trim($this->input->post('vote12'));
				$config['upload_path'] = destination_base_path.'images/electionmaster/';
				$config['allowed_types'] ='*';
				$this->upload->initialize($config);
				if(!empty($_FILES['party_image']['name'])){
					if($this->upload->do_upload('party_image')){
						$img1 = $this->upload->data();
						$data['party_image1'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image']['name'])){
					if($this->upload->do_upload('candidate_image')){
						$img1 = $this->upload->data();
						$data['candidate_image1'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image2']['name'])){
					if($this->upload->do_upload('party_image2')){
						$img1 = $this->upload->data();
						$data['party_image2'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image2']['name'])){
					if($this->upload->do_upload('candidate_image2')){
						$img1 = $this->upload->data();
						$data['candidate_image2'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image1']['name'])){
					if($this->upload->do_upload('party_image1')){
						$img1 = $this->upload->data();
						$data['party_image3'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image1']['name'])){
					if($this->upload->do_upload('candidate_image1')){
						$img1 = $this->upload->data();
						$data['candidate_image3'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['party_image12']['name'])){
					if($this->upload->do_upload('party_image12')){
						$img1 = $this->upload->data();
						$data['party_image4'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['candidate_image12']['name'])){
					if($this->upload->do_upload('candidate_image12')){
						$img1 = $this->upload->data();
						$data['candidate_image4'] = $img1['file_name'];
					}
				}
				if(!empty($_FILES['constituency_image']['name'])){
					if($this->upload->do_upload('constituency_image')){
						$img1 = $this->upload->data();
						$data['constituency_image'] = $img1['file_name'];
					}
				}
				$data['modified_by'] = $this->session->userdata('userID');
				$data['modified_on'] = date('Y-m-d H:i:s');
				$this->live_db->where('eid' , $eid);
				$result = $this->live_db->update('election_master' , $data);
				if($result==1){
					redirect(folder_name.'/election_master');
				} 
				
			}
			
		}else{
			redirect(folder_name.'/common/access_permission/election_master');
		}
	}
	
	public function status($eid){
		$this->live_db->where('eid' , $eid);
		$result = $this->live_db->update('election_master' , ['status' => $this->input->get('status')]);
		if($result==1){
			redirect(folder_name.'/election_master');
		}
	}
}
?>