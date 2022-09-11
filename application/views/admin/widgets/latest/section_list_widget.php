<?php 
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid     = $content['sectionID'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$max_article          = $content['show_max_article'];
$render_mode          = $content['RenderingMode'];
$param = $content['close_param'];
// widget config block ends
if(trim($widget_custom_title) !=''):
	$widget_custom_title = trim($widget_custom_title);
else:
	$widget_custom_title =	'தற்போதைய செய்திகள்';
endif;
if($max_article==''){ $max_article=0;}
$domain_name =  base_url();
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db',TRUE);
$this->archive_db = $CI->load->database('archive_db',TRUE);
$template = '';
$articleList=[];
$morefrom ='';
$totalcount = $max_article;
if($render_mode=='auto'){
	$article_limit = (isset($_GET['per_page']) && $_GET['per_page']!='')? $_GET['per_page'] : 0;
	if($widgetsectionid==671){
		$LastPage = $_GET['per_page'];
	}else{
		$LastPage = floor(($_GET['per_page']/10) + 1);
	}
	$queryLastPage=ceil($totalcount/10);
	$currentarchivecount=0;
	if(($LastPage==$queryLastPage && $widgetsectionid!=478) || @$_GET['archive']=='true'){
		$archivetable = @$_COOKIE[$widget_instance_id.$widgetsectionid.'_widget_archive'];
		if($archivetable!=''){
			$archiveresponse = json_decode(base64_decode($archivetable),true);
		}else{
			$arc['response'] = [];
			$year = range(2009,date('Y')-1);
			for($n=0;$n<count($year);$n++):
				$tablename = "article_".$year[$n];
				$tablemapping = "article_section_mapping_".$year[$n];
				if($this->archive_db->table_exists($tablename)){
					if($widgetsectionid!=''){
						$archivequery = "SELECT article.content_id FROM  ".$tablename." as article JOIN ".$tablemapping." as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND mapping.section_id='".$widgetsectionid."' AND article.publish_start_date <=NOW()";
					}else{
						$archivequery = "SELECT article.content_id FROM  ".$tablename." as article JOIN ".$tablemapping." as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND  mapping.section_id=article.section_id AND article.publish_start_date <=NOW() ";
					}
					if(!$this->memcached_library->get($archivequery) && $this->memcached_library->get($archivequery) == ''){
						$totalarchivearticles = $this->archive_db->query($archivequery)->num_rows();
						$this->memcached_library->add($archivequery,$totalarchivearticles);
					}else{
						$totalarchivearticles = $this->memcached_library->get($archivequery);
					}
					
					if($totalarchivearticles!=0){
						if($totalarchivearticles < $totalcount){
							$data['count'] = $totalarchivearticles;
						}else{
							//$data['count'] = $totalcount;
							$data['count'] = $totalarchivearticles;
						}
						$data['year'] = $year[$n];
						$arc['response'][] = $data;
					}
				}
			endfor;
			$archiveresponse = $arc;
			setcookie($widget_instance_id.$widgetsectionid.'_widget_archive',base64_encode(json_encode($archiveresponse)),time() + (60 * 15));
		}
		$archiveresponse = $archiveresponse['response'];
		$morefrom .='<div class="pagina" style="margin-top:2%;">';
		if(count($archiveresponse) > 0){
			$morefrom .='<div style="width: 100%;float: left;text-align: center;margin-bottom: 1%;color: #000;font-weight: bold;">More from archive : </div>';
		}
		if(@$_GET['archive']!='true' && @$_GET['year']==''){
			$morefrom .='<a class="active">Latest</a>';
		}else{
			$morefrom .='<a href="?per_page=">Latest</a>';
		}
		foreach($archiveresponse as $archiveres):
			if($archiveres['year']==@$_GET['year']){
				$morefrom .='<a class="active">'.$archiveres['year'].'</a>';
				$currentarchivecount=$archiveres['count'];
			}else{
				$morefrom .='<a href="?archive=true&year='.$archiveres['year'].'">'.$archiveres['year'].'</a>';
			}
			
		endforeach;
		$morefrom .='</div>';
	}
	if(@$_GET['archive']=='true' && @$_GET['year']!=''){
		$livecount = $currentarchivecount;
	}else{
		$livecountcookie = @$_COOKIE[$widgetsectionid.$widget_instance_id.'_widget'];
		if($livecountcookie!=''){
			$livecount = $livecountcookie;
		}else{
			if($widgetsectionid!=''){
				$countquery = "SELECT article.content_id FROM article as article JOIN article_section_mapping as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND article.publish_start_date <=NOW() AND mapping.section_id='".$widgetsectionid."' AND article.publish_start_date <=NOW()";
			}else{
				$countquery ="SELECT article.content_id FROM article as article INNER JOIN article_section_mapping as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND article.publish_start_date <=NOW() AND  mapping.section_id=article.section_id AND article.publish_start_date <=NOW()";
			}
			if(!$this->memcached_library->get($countquery) && $this->memcached_library->get($countquery) == ''){
				$livecount = $this->live_db->query($countquery)->num_rows();
				$this->memcached_library->add($countquery,$livecount);
			}else{
				$livecount = $this->memcached_library->get($countquery);
			}
			setcookie($widgetsectionid.$widget_instance_id.'_widget',$livecount,time() + (60 * 15));
		}
	}
	
	//if($livecount < $totalcount){ $totalcount = $livecount;	}
	if($totalcount > 3000){ $totalcount=3000;}
	
	$config['total_rows'] = $livecount;
	$config['per_page'] = 10; 
	$config['custom_num_links'] = 5;
	$config['page_query_string'] = TRUE;
	$config['enable_query_strings']=TRUE;
	$config['cur_tag_open'] = "<a href='javascript:void(0);' class='active'>";
	$config['cur_tag_close'] = "</a>";
	if(@$_GET['archive']=='true' && @$_GET['year']!=''){
		$config['suffix'] = '&archive=true&year='.@$_GET['year'];
	}
	$this->pagination->initialize($config);
	$PaginationLink = $this->pagination->custom_create_links();
	
	if($widgetsectionid!=''){
		if(@$_GET['archive']=='true' && @$_GET['year']!=''){
			$tblname = "article_".@$_GET['year'];
			$tblsection = "article_section_mapping_".@$_GET['year'];
			$query = "SELECT article.title, article.url, article.article_page_image_path, article.article_page_image_title, article.article_page_image_alt, article.summary_html, article.publish_start_date FROM ".$tblname." as article JOIN ".$tblsection." as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND mapping.section_id='".$widgetsectionid."' AND article.publish_start_date <=NOW() ORDER BY article.publish_start_date DESC LIMIT ".$article_limit." , ".$config['per_page']."";
		}else{
			$query = "SELECT article.title, article.url, article.article_page_image_path, article.article_page_image_title, article.article_page_image_alt, article.summary_html, article.publish_start_date FROM article as article JOIN article_section_mapping as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND article.publish_start_date <=NOW() AND mapping.section_id='".$widgetsectionid."' ORDER BY article.publish_start_date DESC LIMIT ".$article_limit." , ".$config['per_page']."";
		}
		
		
	}else{
		if(@$_GET['archive']=='true' && @$_GET['year']!=''){
			$tblname = "article_".@$_GET['year'];
			$tblsection = "article_section_mapping_".@$_GET['year'];
			$query = "SELECT article.title, article.url, article.article_page_image_path, article.article_page_image_title, article.article_page_image_alt, article.summary_html, article.publish_start_date FROM ".$tblname." as article JOIN ".$tblsection." as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND  mapping.section_id=article.section_id AND article.publish_start_date <=NOW() ORDER BY article.publish_start_date DESC LIMIT ".$article_limit." , ".$config['per_page']."";
		}else{
			$query = "SELECT article.title, article.url, article.article_page_image_path, article.article_page_image_title, article.article_page_image_alt, article.summary_html, article.publish_start_date FROM article as article JOIN article_section_mapping as mapping ON article.content_id = mapping.content_id WHERE article.status='P' AND article.publish_start_date <=NOW() AND  mapping.section_id=article.section_id ORDER BY article.publish_start_date DESC LIMIT ".$article_limit." , ".$config['per_page']."";
		}
		
	}
	if(@$_GET['archive']=='true' && @$_GET['year']!=''){
		if(!$this->memcached_library->get($query) && $this->memcached_library->get($query) == ''){
			$articleList = $this->archive_db->query($query)->result();
			$this->memcached_library->add($query,$articleList);
		}else{
			$articleList = $this->memcached_library->get($query);
		}
		
	}else{
		if(!$this->memcached_library->get($query) && $this->memcached_library->get($query) == ''){
			$articleList = $this->live_db->query($query)->result();
			$this->memcached_library->add($query,$articleList);
		}else{
			$articleList = $this->memcached_library->get($query);
		}
	}
	
	
}elseif($render_mode=='manual'){
	$article_limit = (isset($_GET['per_page']) && $_GET['per_page']!='')? $_GET['per_page'] : 0;
	$manualquery = "SELECT content_id FROM widgetinstancecontent_live WHERE WidgetInstance_id = '".$widget_instance_id."'";
	if(!$this->memcached_library->get($manualquery) && $this->memcached_library->get($manualquery) == ''){
		$livecount  = $this->live_db->query("SELECT content_id FROM widgetinstancecontent_live WHERE WidgetInstance_id = '".$widget_instance_id."'")->num_rows();
		$this->memcached_library->add($manualquery,$livecount);
	}else{
		$livecount = $this->memcached_library->get($manualquery);
	}
	if($livecount < $totalcount){  $totalcount = $livecount;}
	$config['total_rows'] = $totalcount;
	$config['per_page'] = 10; 
	$config['custom_num_links'] = 5;
	$config['page_query_string'] = TRUE;
	$config['enable_query_strings']=TRUE;
	$config['cur_tag_open'] = "<a href='javascript:void(0);' class='active'>";
	$config['cur_tag_close'] = "</a>";
	$this->pagination->initialize($config);
	$PaginationLink = $this->pagination->custom_create_links();
	$query = "SELECT content_id, CustomTitle, CustomSummary, custom_image_path, custom_image_title , custom_image_alt FROM widgetinstancecontent_live WHERE WidgetInstance_id = '".$widget_instance_id."' ORDER BY DisplayOrder ASC LIMIT ".$article_limit." , ".$config['per_page']."";
	if(!$this->memcached_library->get($query) && $this->memcached_library->get($query) == ''){
		$articleList = $this->live_db->query($query)->result();
		$this->memcached_library->add($query,$articleList);
	}else{
		$articleList = $this->memcached_library->get($query);
	}
}
$template .='<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10">';
$template .='<h5 class="din-title"><a>'.$widget_custom_title.'</a></h5>';
$count = 1;
$i =1;
if(count($articleList) > 0){
	foreach($articleList as $article):
		$show_image="";
		$imagetitle='';
		$imagealt='';
		$dummy_image  = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
		if($render_mode=='manual'){
			$manualquery1 = "SELECT title, url, article_page_image_path, article_page_image_title, article_page_image_alt, summary_html, publish_start_date FROM article WHERE content_id='".$article->content_id."'";
			if(!$this->memcached_library->get($manualquery1) && $this->memcached_library->get($manualquery1) == ''){
				$getArticleDetails =  $this->live_db->query("SELECT title, url, article_page_image_path, article_page_image_title, article_page_image_alt, summary_html, publish_start_date FROM article WHERE content_id='".$article->content_id."'")->result();
				$this->memcached_library->add($manualquery1,$getArticleDetails);
			}else{
				$getArticleDetails = $this->memcached_library->get($manualquery1);
			}
			$getArticleDetails = $getArticleDetails[0];
			$live_article_url = $domain_name.$getArticleDetails->url.$param;
			if($article->CustomTitle!=''){
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$article->CustomTitle);
			}else{
				$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$getArticleDetails->title);
			}
			$display_title = strip_tags($display_title);
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
			if($article->CustomSummary!=''){
				$custom_summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$article->CustomSummary);
			}else{
				$custom_summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$getArticleDetails->summary_html);
			}
			echo $article->custom_image_path;
			if($article->custom_image_path!=''){
				$Image600X390  = str_replace("original","w600X390", $article->custom_image_path);
				if(get_image_source($Image600X390, 1) && $Image600X390 != ''):
					$show_image = image_url. imagelibrary_image_path . $Image600X390;
				else:
					$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				endif;
			}elseif($getArticleDetails->article_page_image_path!=''){
				$Image600X390  = str_replace("original","w600X390", $getArticleDetails->article_page_image_path);
				if(get_image_source($Image600X390, 1) && $Image600X390 != ''):
					$show_image = image_url. imagelibrary_image_path . $Image600X390;
				else:
					$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				endif;
			}else{
				$show_image	  = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
			if($article->custom_image_title!=''): 
				$imagetitle= $article->custom_image_title;
			elseif($getArticleDetails->article_page_image_title!=''):
				$imagetitle= $getArticleDetails->article_page_image_title;
			endif;
			
			if($article->custom_image_alt!=''):
				$imagealt= $article->custom_image_alt;
			elseif($getArticleDetails->article_page_image_alt!=''):
				$imagealt= $getArticleDetails->article_page_image_alt;
			endif;
			$date = date('d-m-Y',strtotime($getArticleDetails->publish_start_date));
		
		}else{
			$live_article_url = $domain_name.$article->url.$param;
			$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$article->title);
			$display_title = strip_tags($display_title);
			$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
			$custom_summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$article->summary_html);
			if($article->article_page_image_path!=''){
				$Image600X390  = str_replace("original","w600X390", $article->article_page_image_path);
				if(get_image_source($Image600X390, 1) && $Image600X390 != ''):
					$show_image = image_url. imagelibrary_image_path . $Image600X390;
				else:
					$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
				endif;
			}else{
				$show_image	  = image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
			}
			if($article->article_page_image_title!=''): 
				$imagetitle= $article->article_page_image_title;
			endif;
			if($article->article_page_image_alt!=''):
				$imagealt= $article->article_page_image_alt;
			endif;
			$date = date('d-m-Y',strtotime($article->publish_start_date));
		}		
		
		$template.= '<div class="row">';
		$template.= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
		$template.= '<div class="section-list-item '.(($i==1)?'section-list-item-first' :'').'" style="position:relative;"><a  href="'.$live_article_url.'" class="article_click" ><img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a><div class="caption"><h5>'. $display_title.'</h5><p>'.$custom_summary.'</p>';
		$template.='<p class="post_time">'.$date.'</p>'; 
		$template.='</div></div></div>';
		$template.= '</div>';
		$count++;				
		$i =$i+1;	
	endforeach;
}elseif($view_mode=="adminview"){
	$template .='<div class="margin-bottom-10">'.no_articles.'</div>';
}


$template .='<div class="pagina">';
$template .= $PaginationLink.$morefrom ;
$template .='</div></div></div>';
echo $template;
?>