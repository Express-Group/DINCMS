<?php
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$page_section_id 		= $content['page_param'];
$is_home 				= $content['is_home_page'];
$is_summary_required 	= $content['widget_values']['cdata-showSummary'];
$widget_section_url 	= $content['widget_section_url'];
$view_mode            	= $content['mode'];
$show_simple_tab = "";
 

$widget_auto_count = $this->widget_model->select_setting($view_mode);
$max_article = '';

//$article_count       	= 15;
$article_count       = $widget_auto_count['subsection_otherstories_count_perpage'];


$domain_name 			=  base_url();

$section_details = $this->widget_model->get_section_by_id($page_section_id);
$section_id = $section_details['Section_id'];
//$section_details = $this->widget_model->get_section_by_id($page_section_id);
$author_id = '';

$content_type = 1;

$linked_to_columnist = $section_details['AuthorID'];

	
	
$show_simple_tab.=  '<div class="row">
					 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
					 $show_simple_tab.=  '<h4 class="text-align-center font-size-16">'. $section_details['Sectionname'].'</h4>  ';
					 
 
	
	$widget_instance_contents_pagination = $this->widget_model->get_all_available_articles_auto_totalcount($max_article, $page_section_id , $content_type ,  $view_mode);

$this->load->library('pagination');
$TotalCount= count($widget_instance_contents_pagination);

$config['total_rows'] = $TotalCount; 
$config['per_page'] = $article_count; 

$config['custom_num_links'] = 5;

$config['page_query_string'] = TRUE;
$config['enable_query_strings']=TRUE;

$config['use_page_numbers'] = TRUE;
$config['cur_tag_open'] = "<a href='javascript:void(0);' class='active'>";
$config['cur_tag_close'] = "</a>";

$page_num = $config['use_page_numbers'];
$article_limit = ($this->input->get('per_page') != '')?$this->input->get('per_page'):0;


$start = $article_limit; 
$page_number = $this->input->get('per_page')/$config['per_page'] + 1 ;
$limit = $article_count;
$config['use_page_numbers'] = TRUE;
//$offset = $this->uri->segment(4);
$this->pagination->initialize($config); 
//$PaginationLink = $this->pagination->create_links();
$PaginationLink = $this->pagination->custom_create_links();

$load_more_url = $domain_name.'topic/?sid='.$content['page_param'].'&cid=1';


$widget_instance_contents = $this->widget_model->get_all_available_articles_auto_page($max_article,$page_section_id  , $content_type ,  $view_mode, $start,$limit,$page_number,$TotalCount);  
$author_id = $section_details['AuthorID'];

$author_image = "";
$imagealt = "";
$imagetitle  = "";
$archive = '';

$topicname = $this->widget_model->gettopic_name();

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
			$author_name         = ""; 
			$Author_image_path   ="";
	
	if($view_mode == "adminview")
			{
				$author_id = $get_content['AuthorID']; 
				$author_name = $get_content['AuthorName'];				
			}
			else 
			{
				$author_name=$get_content['author_name'];
			}
		$content_url = $get_content['url'];
		$param = $content['page_param'];
		$live_article_url = $domain_name.$content_url."?pm=".$param;
		
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
	      $lastpublishedon = $get_content['last_updated_on'];
		  //$time = $lastpublishedon; 
 //$post_time= $this->widget_model->time2string($time); 
 



	if($i===1)
		{
		$show_simple_tab.=  '<ul class="Story-List">';
		}
		
		 $show_simple_tab.=  '<li> 
      <i class="fa fa-angle-right"></i>
      <div>
      <h4>'.$display_title.'</h4>';
     if($is_summary_required== 1)
			{
			$show_simple_tab.='<p class="summary">'.$summary.'</p>';
			}
      //$show_simple_tab.='<time>'.$post_time.' ago</time>
      $show_simple_tab.='<time> '.date('d-m-Y',strtotime($lastpublishedon)).'</time>
	                     </div>';
     
     $show_simple_tab.=  ' </li>';
		
		if($i===count($widget_contents))
			{
			$show_simple_tab.=  '</ul>';
			}

       
	    if((($TotalCount < $article_count) && ($i == count($widget_contents)) ) || ($last_content_id == $get_content['content_id']))
		{
		//echo  '<div class="col-sm-12"><p class="load_more_archive" style="margin-bottom:10px; margin-top:10px;"><a href="'.$load_more_url.'">More from Archieve</a></p></div>';
		$archive .= '<a class="load_more_archive" href="'.$load_more_url.'">மேலும்</a>';
		
		}
	
	$i++;
	
    }
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


