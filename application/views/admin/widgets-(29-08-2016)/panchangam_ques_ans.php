<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$widget_section_url  = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$domain_name         =  base_url();
$view_mode           = $content['mode'];
$show_simple_tab     = "";

if($content['widget_values']['cdata-widgetCategory'] != '') {
	$section_id = (string)$content['widget_values']['cdata-widgetCategory'];
	$section_details = $this->widget_model->get_section_by_id($section_id);
	$widget_section_url = $domain_name .$section_details ['URLSectionStructure'];
	$SectionName 		= $section_details ['Sectionname'];
} else {
	$widget_section_url = '';
	$SectionName 		= '';
}

$show_simple_tab .='<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  ';
						
						if($widget_custom_title!='')
{     
							$show_simple_tab .='<figure class="bg-left"></figure>
							<figure class="bg-center1">';
								
							if($widget_custom_title!='')
							 {
								if($content['RenderingMode'] == "manual") 
								{
									$show_simple_tab.='<a href="'.$widget_section_url.'">'.$widget_custom_title.'</a>';
								} 
								else 
								{
									if($content['widget_values']['cdata-customTitle'] != '') 
									{
										$show_simple_tab.='<a href="'.$widget_section_url.'">'.$content['widget_values']['cdata-customTitle'].'</a>';
									}
									 else 
									{
										$show_simple_tab.='<a href="'.$widget_section_url.'">'.$SectionName.'</a>';
									}
								}
							 } 
							else
							 {
									$show_simple_tab.='<a href="'.$widget_section_url.'">'.$SectionName.'</a>';
							 }
							
							$show_simple_tab.='</figure><figure class="bg-right"></figure> ';
}

							$content_type = $content['content_type_id'];		
								
							if($content['RenderingMode'] == "manual") 	{
								
								$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $content['show_max_article']); 						
							} else {
								$content_type = $content['content_type_id'];  // auto article content type
								$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);
							}
							
							$show_simple_tab .='<ul class="panchangam-kelvi" '.$widget_bg_color.'>';
							
							if (function_exists('array_column'))  {
								$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
							}else {
								$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
							}
							$get_content_ids = implode("," ,$get_content_ids);
							if($get_content_ids!='') {
								
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
								$i =1;
								
								
								
								if(count($widget_contents)>0)
								{
									foreach($widget_contents as $get_content)
									{
										$custom_title        = "";
										$custom_summary      = "";
										if($content['RenderingMode'] == "manual")
										{
										$custom_title   = $get_content['CustomTitle'];
										$custom_summary = @$get_content['CustomSummary'];
										}
										$content_url = $get_content['url'];
										$param = $content['page_param'];
										$live_article_url = $domain_name.$content_url."?pm=".$param;
										if( $custom_title == '')
										{
										$custom_title = @$get_content['title'];
										}	
										$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
										$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
										
										if( $custom_summary == '' && $content['RenderingMode'] == "auto") {
											$custom_summary =  @$get_content['summary_html'];
										} 
										$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);
										//  Assign article links block ends hers
																					
												
										 $show_simple_tab .='<li class="odd">'.$display_title.'</li>
										 <li class="even"><p>'.$summary.'</p></li>';
										
										$i =$i+1;							  
									}
								}
								
							} elseif($view_mode=="adminview") {
								$show_simple_tab .='<li class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</li></ul>';
								
							} else {
								$show_simple_tab .='</ul>';
							}                                                
	
							
$show_simple_tab .='</div>
						</div>';
						
echo $show_simple_tab;	
?> 