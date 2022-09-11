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
$tab_sections	     = $content['widget_values']->widgettab;

// widget config block ends
//getting tab list for hte widget
if($content['RenderingMode'] == "manual")
{
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
}else{
$widget_instancemainsection	= $content['widget_values']->widgettab;
}// Code block A - this code block is needed for creating simple tab widget. Do not delete
$domain_name        =  base_url();
$show_simple_tab    = "";
$show_simple_tab .='<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div '.$widget_bg_color.'>
								<div class="accordion">
									<div class="panel-group" id="accordion1_'.$widget_instance_id.'">';
								
										if(count($widget_instancemainsection)>0) {
											$j = 0;
											foreach($widget_instancemainsection as $get_section){
												
																					
												if($content['RenderingMode'] == "manual") {
													$content_type = $content['content_type_id'];
													$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , $get_section['WidgetInstanceMainSection_id'] ,$content['mode'],$content['show_max_article']); 						
												} else {
												
													$content_type = $content['content_type_id'];  // auto article content type
													$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['cdata-categoryId'] , $content_type ,  $content['mode']);
												}
												//getting content block ends here
												//Widget code block - code required for simple tab structure creation. Do not delete
												//Widget code block Starts here
												
												if($j==0){
													$add_class='panel-heading';	
													$href = 'collapse_'.$widget_instance_id.'_'.$j;													
												}else{
													$add_class='panel-heading collapsed';
													$href = 'collapse_'.$widget_instance_id.'_'.$j;														
												}
												
												$show_simple_tab .='<div class="panel panel-default">
																	<div class="'.$add_class.'" data-toggle="collapse" data-parent="#accordion1_'.$widget_instance_id.'" href="#'.$href.'"><h4 class="panel-title">
																	<a class="accordion-toggle" >';
																	
												if($content['RenderingMode'] == "manual") {
													$show_simple_tab.=$get_section['CustomTitle'];
												} else {
													$show_simple_tab.=$get_section['cdata-customTitle'];
												}
																	
												$show_simple_tab.=	'<i class="fa fa fa-chevron-up pull-right"></i>
																	<i class="fa fa fa-chevron-down pull-right"></i>
																	</a>
																	</h4>
																	</div>';
																	
												if (function_exists('array_column'))  {					
													$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
												} else {
												   $get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
												}														
												
												$get_content_ids = implode("," ,$get_content_ids);
										
												if($get_content_ids!='') {
													
													$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
														
														$widget_contents = array();
															foreach ($widget_instance_contents as $key => $value) {
															   foreach ($widget_instance_contents1 as $key1 => $value1) {
																			if($value['content_id']==$value1['content_id']){
																			$widget_contents[] = array_merge($value, $value1);
																			}
																	   }
																  }	
																  
													$i =1;
															
													if(count($widget_contents)>0)
													{
															foreach($widget_contents as $get_content)
															{
																
																// getting content details 
																											
																$custom_title        = "";
																$custom_summary      = "";
																if($content['RenderingMode'] == "manual")
																{
																	
																$custom_title   = $get_content['CustomTitle'];
																$custom_summary = $get_content['CustomSummary'];
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
																/*if( $custom_summary == '')
																{
																$custom_summary =  $get_content['summary_html'];
																}
																$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary); */

																// end //
																//  Assign article links block ends hers
																
																if($i == 1) {
																	
																	if($j==0){
																		$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse in">';
																	}
																	else{
																		$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse">';
																	}
																	$show_simple_tab .= '<div class="panel-body ">';
																	$show_simple_tab .='<ul class="lead-list">';
																	$show_simple_tab .='<li>';
																	$show_simple_tab .='<div><i class="fa fa-angle-right"></i></div>';
																	$show_simple_tab .='<p>'.$display_title.'</p>';
																	$show_simple_tab .='</li>';
																} else {
																																	
																	//$show_simple_tab .= '<div class="panel-body ">';
																	//$show_simple_tab .='<ul class="lead-list">';
																	$show_simple_tab .='<li>';
																	$show_simple_tab .='<div><i class="fa fa-angle-right"></i></div>';
																	$show_simple_tab .='<p>'.$display_title.'</p>';
																	$show_simple_tab .='</li>';
																}
																if($i == count($widget_instance_contents)) {
																	if($j==1){
																		$show_simple_tab .= '</ul>';
																	}																
																	$show_simple_tab .='</div></div>';
																}
																
																
																// display title and summary block ends here					
																//Widget design code block 1 starts here																
																//Widget design code block 1 starts here	
																
															$i =$i+1;	
															}
														$show_simple_tab .='</div>';															
													}
		
												} else {
													if($view_mode=="adminview") {
														if($j==0){
															$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse in">';
														}
														else{
															$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse">';
														}
														$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
														$show_simple_tab .='</div></div>';
													} else {
														if($j==0){
															$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse in">';
														} else{
															$show_simple_tab .= '<div id="'.$href.'" class="panel-collapse collapse">';
														}
														$show_simple_tab .='</div></div>';
													}
												}
												$j++;
												
											}											
										} elseif($view_mode=="adminview") {	
											$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
										}
								
	
$show_simple_tab .= "</div>
						</div>
							</div>
								</div>
									</div>";
								
echo $show_simple_tab; 			
?>