<?php
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$page_section_id 		= $content['page_param'];
$is_home 				= $content['is_home_page'];
$is_summary_required 	= $content['widget_values']['cdata-showSummary'];
$widget_section_url 	= $content['widget_section_url'];
$view_mode            	= $content['mode'];
$show_simple_tab        = "";
 
$widget_auto_count = $this->widget_model->select_setting($view_mode);
$max_article = '';

//$article_count       	= 15;
$article_count          = $widget_auto_count['subsection_otherstories_count_perpage'];
$domain_name 			=  base_url();
$section_details        = $this->widget_model->get_sectionDetails($page_section_id, $view_mode);
$section_id             = $section_details['Section_id'];
$section_url_structure  = $section_details['URLSectionStructure'];
$split_section          = explode("/", $section_url_structure);
$finished_stories       = (count($split_section)>2) ? $split_section[1]: '';

$author_id              = '';
$content_type           = 1;
$linked_to_columnist    = $section_details['AuthorID'];
	
$show_simple_tab       .=  '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
$show_simple_tab       .=  '<h4 class="text-align-center font-size-16">'. $section_details['Sectionname'].'</h4>';
					 

if($finished_stories=="junction-finished-serials"){
	$start_limit = ($this->input->get('per_page') != '')?$this->input->get('per_page'):0;
	$datafrom                = date('Y');
	$widget_instance_contents = $this->widget_model->get_search_result_data("publish_start_date", "Asc", $start_limit, $article_count, "", "", "", "section", $section_id, $content_type, "", $datafrom);
	$widget_instance_contents_pagination = $this->widget_model->get_search_result_data("publish_start_date", "Desc", "", "", "", "", "", "section", $section_id, $content_type, "", $datafrom); //publish_start_date last_updated_on
	//echo $this->db->last_query();
	//print_r($widget_instance_contents_pagination);exit;
	$story_year = $widget_instance_contents['year'];
	$query_string_segment = "&story_year=".$story_year;
	$finshed = true;
	$TotalCount             = count($widget_instance_contents_pagination['Search_result']);
}else{
	$widget_instance_contents_pagination = $this->widget_model->get_all_available_articles_auto_totalcount($max_article, $page_section_id , $content_type ,  $view_mode);
	$query_string_segment = "";
	$TotalCount             = count($widget_instance_contents_pagination);
	$finshed = false;
}
$this->load->library('pagination');


$config['total_rows']           = $TotalCount; 
$config['per_page']             = $article_count; 
$config['custom_num_links']     = 5;
$config['page_query_string']    = TRUE;
$config['enable_query_strings'] = TRUE;
$config['use_page_numbers']     = TRUE;
//$config['suffix']               = $query_string_segment;
$config['cur_tag_open']         = "<a href='javascript:void(0);' class='active'>";
$config['cur_tag_close']        = "</a>";

$page_num                       = $config['use_page_numbers'];
$article_limit = ($this->input->get('per_page') != '')?$this->input->get('per_page'):0;

$start       = $article_limit; 
$page_number = $this->input->get('per_page')/$config['per_page'] + 1 ;
$limit       = $article_count;
$config['use_page_numbers'] = TRUE;
//$offset = $this->uri->segment(4);
$this->pagination->initialize($config); 
//$PaginationLink = $this->pagination->create_links();
$PaginationLink = $this->pagination->custom_create_links();
$archive = '';
if(!$finshed){
$load_more_url = $domain_name.'topic/?sid='.$content['page_param'].'&cid=1';
$widget_instance_contents = $this->widget_model->get_all_available_articles_auto_page($max_article,$page_section_id  , $content_type ,  $view_mode, $start,$limit,$page_number,$TotalCount);  
$author_id = $section_details['AuthorID'];

$author_image = "";
$imagealt = "";
$imagetitle  = "";
//$topicname = $this->widget_model->gettopic_name();

if (function_exists('array_column')) 
				{
			$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
				}else
				{
			$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
				}
		$get_content_ids = implode("," ,$get_content_ids);
		if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		$widget_contents = array();
			foreach ($widget_instance_contents as $key => $value) 
			{
				foreach ($widget_instance_contents1 as $key1 => $value1) 
				{
					if($value['content_id']==$value1['content_id'])
					{
					   $widget_contents[] = array_merge($value, $value1);
					}
				}
			}
	}
	$year            = date('Y'); 
}else{
	$widget_contents = $widget_instance_contents['Search_result'];
	$result_year            = $widget_instance_contents['year'];
	$year            = ($result_year==date('Y'))? $result_year-1 : $result_year;
	$load_more_url   = $domain_name.'topic?search_term=&searchby=H&ctype=1&stype=1&datafrom='.$year.'&sid='.$content['page_param'];
}
$i=1;
$last_content_id = @$widget_contents[count($widget_contents)-1]['content_id'];
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		    $original_image_path = "";
		 	$imagealt            = "";
			$imagetitle          = "";
			$custom_title        = "";
			$custom_summary      = "";
			
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
		// Assign summary block starts here
		if( $custom_summary == '')
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	
		//  summary block endss here
	      if($finshed){
          $lastpublishedon = $this->widget_model->time2string($get_content['publish_start_date'])." ago";
		  }else{
           $lastpublishedon = date('d-m-Y',strtotime($get_content['publish_start_date']));
		  }
          //$post_time= $this->widget_model->time2string($time); 
 
        if($i===1)
		{
		$show_simple_tab.=  '<ul class="Story-List">';
		}
		
		 $show_simple_tab.=  '<li> <i class="fa fa-angle-right"></i><div> <h4>'.$display_title.'</h4>';
          if($is_summary_required== 1)
			{
			$show_simple_tab.='<p class="summary">'.$summary.'</p>';
			}
      //$show_simple_tab.='<time>'.$post_time.' ago</time>
      $show_simple_tab.='<time> '.($lastpublishedon).'</time>';
	  $show_simple_tab.='</div>';
      $show_simple_tab.=  ' </li>';
	    if($i===count($widget_contents))
			{
			$show_simple_tab.=  '</ul>';
			}

	    if((($TotalCount < $article_count) && ($i == count($widget_contents)) ) || ($last_content_id == $get_content['content_id']))
		{
			$archieve_count = $this->widget_model->check_archieve_content_exist_by_section($section_id, "article", $year);
			if($archieve_count>0)
		  $archive .= '<a class="load_more_archive" href="'.$load_more_url.'">மேலும்</a>';
		}
	
	$i++;
	
    }
  }
elseif($view_mode=="adminview")
{
		
 $show_simple_tab.= '<div class="margin-bottom-10">'.no_articles.'</div>';
		
}
 $show_simple_tab.= '<div class="pagina">'.$PaginationLink.$archive.'</div><div class="common-border"><span></span><span></span></div>';
 $show_simple_tab.=  '</div>';
  echo $show_simple_tab.= '</div>';    
					
?>


