<?php

class tag_master extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$CI = &get_instance();
		$this->load->database();
		$this->live_db = $CI->load->database('live_db' , TRUE);
		$this->archive_db = $CI->load->database('archive_db' , TRUE);
	}
	
	public function index(){
		$this->load->library("pagination");
		$search = [];
		$search['status'] = 1;
		if($this->input->get('q')!=''){
			if(is_numeric($this->input->get('q'))){
				$search['tag_id'] =$this->input->get('q');
			}else{
				$search['tag_name LIKE'] = '%'.trim($this->input->get('q')).'%';
			}
		}
		$total_rows = $this->db->select('tag_id')->where($search)->from('tag_master')->get();
		$data['total_rows'] = $total_rows->num_rows;
		$row = ($this->input->get('per_page')!='')? $this->input->get('per_page') : 0;
		$config = array('base_url' => base_url("dmcpan/tag_master") , 'total_rows' => $data['total_rows'] , 'per_page' => 20 , 'page_nubmer' => true , 'page_query_string' => true , 'use_page_numbers' => true , 'reuse_query_string' => true , 'suffix' => '&q='.$this->input->get('q'));
		$this->pagination->initialize($config);
		$data["links"] = $this->pagination->create_links();
		$data['title'] = 'Tag Master';
		$data['template'] = 'tag_master_view';
		$records = $this->db->select('tag_id , tag_name , status')->where($search)->get('tag_master' , $config["per_page"] , $row);
		$data['data'] = $records->result();
		$this->load->view('admin_template',$data);
	}
	
	public function get_details(){
		$response = [];
		$tagId = $this->input->post('id');
		$yearRange = range(2009 ,date('Y'),1);
		$tag = 'IE'.$tagId.'IE';
		$response['count'] = 0;
		$data['archiveArticles'] = $data['archiveGallery'] = $data['archiveVideo'] = [];
		$data['liveArticle'] = $this->db->query("SELECT content_id , title , status ,url FROM articlemaster WHERE Tags LIKE '%".$tag."%'")->result_array();
		$data['liveGallery'] = $this->db->query("SELECT content_id , title , status ,url FROM gallerymaster WHERE Tags LIKE '%".$tag."%'")->result_array();
		$data['liveVideo'] = $this->db->query("SELECT content_id , title , status ,url FROM videomaster WHERE Tags LIKE '%".$tag."%'")->result_array();
		for($i=0;$i<count($yearRange);$i++):
			if($this->archive_db->table_exists('article_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , title , status ,url FROM article_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				if(count($temp) > 0){
					$data['archiveArticles']  = array_merge($data['archiveArticles'] , $temp);
				}
			}
			if($this->archive_db->table_exists('gallery_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , title , status ,url FROM gallery_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				if(count($temp) > 0){
					$data['archiveGallery']  = array_merge($data['archiveGallery'] , $temp);
				}
			}
			if($this->archive_db->table_exists('video_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , title , status ,url FROM video_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				if(count($temp) > 0){
					$data['archiveVideo']  = array_merge($data['archiveVideo'] , $temp);
				}
			}
		endfor;
		$template = '';
		$template .= '<table class="table">';
		$template .= '<thead>';
		$template .= '<tr><th>CONTENT ID</th><th>TITLE</th><th>STATUS</th><th>URL</th></tr>';
		$template .= '</thead>';
		$template .= '<tbody>';
		if(count($data['liveArticle']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">LIVE ARTICES</th></tr>';
			$template .= $this->set_table($data['liveArticle']);
			$response['count'] += count($data['liveArticle']);
		}
		if(count($data['liveGallery']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">LIVE GALLERY</th></tr>';
			$template .= $this->set_table($data['liveGallery']);
			$response['count'] += count($data['liveGallery']);
		}
		if(count($data['liveVideo']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">LIVE VIDEO</th></tr>';
			$template .= $this->set_table($data['liveVideo']);
			$response['count'] += count($data['liveVideo']);
		}
		if(count($data['archiveArticles']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">ARCHIVE ARTICES</th></tr>';
			$template .= $this->set_table($data['archiveArticles']);
			$response['count'] += count($data['archiveArticles']);
		}
		if(count($data['archiveGallery']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">ARCHIVE GALLERY</th></tr>';
			$template .= $this->set_table($data['archiveGallery']);
			$response['count'] += count($data['archiveGallery']);
		}
		if(count($data['archiveVideo']) > 0){
			$template .= '<tr><th style="background:#eee;" colspan="4" class="text-center">ARCHIVE VIDEO</th></tr>';
			$template .= $this->set_table($data['archiveVideo']);
			$response['count'] += count($data['archiveVideo']);
		}
		$template .= '</tbody>';
		$template .= '</table>';
		
		$response['data'] = $data;
		$response['table'] = $template;
		echo json_encode($response);
	}
	
	public function set_table($articles){
		$data='';
		foreach($articles as $feed){
			$data .= '<tr>';
			$data .= '<td>'.$feed['content_id'].'</td>';
			$data .= '<td>'.$feed['title'].'</td>';
			$data .= '<td>'.$feed['status'].'</td>';
			$data .= '<td><a target="_BLANK" href="'.BASEURL.$feed['url'].'"><i class="fa fa-link" aria-hidden="true"></i></a></td>';
			$data .= '</tr>';
		}
		return $data;
	}
	
	public function remove_tag(){
		$id = $this->input->post('id');
		$yearRange = range(2009 ,date('Y'),1);
		$tagDetails = $this->db->select('tag_name')->from('tag_master')->where('tag_id',$id)->get();
		$tagDetails = $tagDetails->row_array();
		$tagName = $tagDetails['tag_name'];
		$tag = 'IE'.$id.'IE';
		$tables = ['articlemaster' , 'gallerymaster' , 'videomaster'];
		$tablesLive = ['article' , 'gallery' , 'video'];
		for($j=0;$j<count($tables);$j++){
			$liveArticle = $this->db->query("SELECT content_id ,Tags FROM ".$tables[$j]." WHERE Tags LIKE '%".$tag."%'")->result_array();
			foreach($liveArticle as $feed){
				$oldTag = explode(',' , $feed['Tags']);
				$newTag = array_diff($oldTag , [$tag]);
				$this->db->where('content_id' , $feed['content_id']);
				$this->db->update($tables[$j] , ['Tags' => implode(',' , $newTag)]);
				$liveRecord = $this->live_db->query("SELECT content_id , tags FROM ".$tablesLive[$j]." WHERE content_id='".$feed['content_id']."'")->row_array();
				if(count($liveRecord) > 0){
					$oldLiveTag = explode(',' , $liveRecord['tags']);
					$newLiveTag = array_diff($oldLiveTag , [$tagName]);
					if(count($oldLiveTag) ==count($newLiveTag)){
						$newLiveTag = array_diff($oldLiveTag , [' '.$tagName]);	
					}
					$this->live_db->where('content_id' , $feed['content_id']);
					$this->live_db->update($tablesLive[$j] , ['tags' => implode(',' , $newLiveTag)]);
				}
			}					
		}
		for($i=0;$i<count($yearRange);$i++):
			if($this->archive_db->table_exists('article_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , tag_ids , tags FROM article_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				foreach($temp as $feed){
					$oldTag = explode(',' , $feed['tag_ids']);
					$newTag = array_diff($oldTag , [$tag]);
					$oldLiveTag = explode(',' , $feed['tags']);
					$newLiveTag = array_diff($oldLiveTag , [$tagName]);
					if(count($oldLiveTag) ==count($newLiveTag)){
						$newLiveTag = array_diff($oldLiveTag , [' '.$tagName]);	
					}
					$this->archive_db->save_queries = TRUE;
					$this->archive_db->where('content_id' , $feed['content_id']);
					$this->archive_db->update('article_'.$yearRange[$i] , ['tags' => implode(',' , $newLiveTag) , 'tag_ids' => implode(',' , $newTag) ]);
				}
			}
			if($this->archive_db->table_exists('gallery_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , tag_ids , tags FROM gallery_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				foreach($temp as $feed){
					$oldTag = explode(',' , $feed['tag_ids']);
					$newTag = array_diff($oldTag , [$tag]);
					$oldLiveTag = explode(',' , $feed['tags']);
					$newLiveTag = array_diff($oldLiveTag , [$tagName]);
					if(count($oldLiveTag) ==count($newLiveTag)){
						$newLiveTag = array_diff($oldLiveTag , [' '.$tagName]);	
					}
					$this->archive_db->where('content_id' , $feed['content_id']);
					$this->archive_db->update('gallery_'.$yearRange[$i] , ['tags' => implode(',' , $newLiveTag) , 'tag_ids' => implode(',' , $newTag) ]);
				}
			}
			
			if($this->archive_db->table_exists('video_'.$yearRange[$i])){
				$temp = $this->archive_db->query("SELECT content_id , tag_ids , tags FROM video_".$yearRange[$i]." WHERE tag_ids LIKE '%".$tag."%'")->result_array();
				foreach($temp as $feed){
					$oldTag = explode(',' , $feed['tag_ids']);
					$newTag = array_diff($oldTag , [$tag]);
					$oldLiveTag = explode(',' , $feed['tags']);
					$newLiveTag = array_diff($oldLiveTag , [$tagName]);
					if(count($oldLiveTag) ==count($newLiveTag)){
						$newLiveTag = array_diff($oldLiveTag , [' '.$tagName]);	
					}
					$this->archive_db->where('content_id' , $feed['content_id']);
					$this->archive_db->update('video_'.$yearRange[$i] , ['tags' => implode(',' , $newLiveTag) , 'tag_ids' => implode(',' , $newTag) ]);
				}
			}
		endfor;
		$this->db->where('tag_id' , $id);
		echo $this->db->delete('tag_master');
	}

public function add_tag()
	{
		$template = "";
		//$template .= "<h1> Add Tags </h1>";
		$template .= '<div class="input-group input-group-sm mb-3">';
		$template .= '<div class="input-group-prepend">';
		$template .= '<span class="input-group-text" id="inputGroup-sizing-sm">Tag </span> </div>';
		$template .= '<input type="text" name="tag_name" id ="tag_name" > </div>';

		//$template .="<div class=\"input-group input-group-lg\">";
		//$template .="<div class=\"input-group-prepend\">";
		// $template .="<span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Small</span>";
		//$template .="</div>";
		//$template .="<input type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-default\">";
		//$template .="</div>";


		//$template .="<form>";
		//$template .="<div class=\"form-group\">";
    //$template .="<label for=\"exampleInputEmail1\">Email address</label>";
   // $template .="<input type=\"email\" class=\"form-control\" id=\"exampleInputEmail1\" aria-describedby=\"emailHelp\">";
    //$template .="<small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>";
	// $template .="</div>";
		
		//$template .= '<div>';
		//$template .= '<input type="text" name="tag_name" id="tag_name">';
		//$template .= '</div>';
		//$response['table'] = $template;
		echo $template;

	}


public function save_tag()
	{
		$txtTags = $this->input->post('id');
		$this->db->insert('tag_master',['tag_name' =>@$txtTags ,'status' => 1 , 'created_by' =>USERID ,'modified_by' =>USERID]);
		$isert_id=$this->db->insert_id();

		echo $isert_id;

	}
}
?> 