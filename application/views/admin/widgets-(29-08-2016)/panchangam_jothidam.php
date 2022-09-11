<?php
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];


$domain_name        =  base_url();

$show_simple_tab    = "";
$section_id = get_sectionDetails_by_name('ஜோதிடம்');

//getting tab list for hte widget
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
$jothidam_articles 	= $this->widget_model->get_section_article_for_common_widgets($section_id, $content['mode'], 4);

// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name =  base_url();

?>
 <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <articel class="sec-read" <?php echo $widget_bg_color; ?> >
			 <h4>ஜோதிடம்</h4>
			<ul class="lead-list">
 <?php 
  //print_r($trending_now);
  //$trending_now[0]['Contentid'];
  //echo count($trending_now);exit;
  
  //echo $from_contents_table[0]['Section_id'];
  //print_r($from_contents_table);exit;

  $url_structure =  '';//$content['url_structure'];
		if(count($jothidam_articles)>0){
			  $count=1;
		foreach($jothidam_articles as $article_content) { 
		
		 $widget_instance_contents = $this->widget_model->get_contentdetails_from_database($article_content['content_id'], 1, $is_home, $view_mode);	

		$content_url = $widget_instance_contents[0]['url'];
		$param = $content['page_param'];
		$live_article_url = $domain_name.$content_url."?pm=".$param;
		 
			$display_title	= '';
			if($article_content['CustomTitle'] != '') 
				$display_title = $article_content['CustomTitle'];
			
			if($display_title == '')
				$display_title = $widget_instance_contents[0]['title'];
		
			echo '<li><div><i class="fa fa-angle-right"></i></div>
			<p><a  href="'.$live_article_url.'" >'.preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $display_title).'</a></p></li>';
			
			$count = $count+1;
		
		  }
		  }else{
			if($view_mode=="adminview") 
				echo '<li><div><i class="fa fa-angle-right"></i></div><p>'.no_articles.'</p></li>';
			
		  }?>
		</ul>
            </articel>
				</div>
					</div>
					