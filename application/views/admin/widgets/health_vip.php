<?php 
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	=  $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= $content['sectionID'];
$main_sction_id 	    = "";
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$domain_name            =  base_url();
$view_mode              = $content['mode'];
$show_simple_tab        = "";
$show_simple_tab .='<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " > 
							<div class=" vip" '.$widget_bg_color.'>
								<div class="box-botton kural-button ">';
									if($widget_custom_title!='') {	
										$show_simple_tab.=	'<a href="'.$widget_section_url.'"  >'.$widget_custom_title.'</a>';
									} else {
										$show_simple_tab.=	$widget_custom_title;
									}
									$show_simple_tab .= '</div>';
										
									$content_type = $content['content_type_id'];
									$widget_contents = array();
									
									if($content['RenderingMode'] == "manual") {	
										$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'],$content['show_max_article']); 		

									if (function_exists('array_column')) {
										$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
									} else {
										$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
									}
									$get_content_ids = implode("," ,$get_content_ids);
									if($get_content_ids!='') {
										$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
										$widget_contents = array();
										
										foreach ($widget_instance_contents as $key => $value) {
													foreach ($widget_instance_contents1 as $key1 => $value1) 	{
														if($value['content_id']==$value1['content_id']) {
														   $widget_contents[] = array_merge($value, $value1);
														}
													}
												}
									}
										
									} else {
										//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $content['sectionID'] , $content_type ,  $content['mode']);
										
										if($view_mode=="live"){
											$widget_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],$content['sectionID'] , $content_type ,  $content['mode'], $is_home);
									  }else{
										  $widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'],  $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
									
										if (function_exists('array_column')) 
										{
											$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
										}
										else
										{
											$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
										}
										$get_content_ids = implode("," ,$get_content_ids); 
										if($get_content_ids!='')
										{
											$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);
											foreach ($widget_instance_contents as $key => $value) {
												foreach ($widget_instance_contents1 as $key1 => $value1) {
													if($value['content_id']==$value1['content_id']){
														$widget_contents[] = array_merge($value, $value1);
													}
												}
											}
										 }
									  }
										
									}

									$i =1;
									if(count($widget_contents)>0)
									{
										
										foreach($widget_contents as $get_content)
										{
											$original_image_path = "";
											$imagealt            = "";
											$imagetitle          = "";
											$custom_title        = "";
											$custom_summary      = "";
											if($content['RenderingMode'] == "manual") {
												
												if($get_content['custom_image_path'] != '') {
													$original_image_path = $get_content['custom_image_path'];
													$imagealt            = $get_content['custom_image_title'];	
													$imagetitle          = $get_content['custom_image_alt'];
												}
												$custom_title   = $get_content['CustomTitle'];
												$custom_summary = $get_content['CustomSummary'];
											}
											if($original_image_path =="")                                                // from cms || live table    
											{
											$original_image_path  = $get_content['ImagePhysicalPath'];
											$imagealt             = $get_content['ImageCaption'];	
											$imagetitle           = $get_content['ImageAlt'];	
											}
											$show_image="";
											if($i==1)
											{
												if ($original_image_path!='' && get_image_source($original_image_path, 1))
												{
												$imagedetails = get_image_source($original_image_path, 2);
												$imagewidth = $imagedetails[0];
												$imageheight = $imagedetails[1];	
												
													if ($imageheight > $imagewidth)
													{
													$Image600X390 	= $original_image_path;
													}
													else
													{				
													$Image600X390 	= str_replace("original","w600X300", $original_image_path);
													}
													
													$show_image = image_url. imagelibrary_image_path . $Image600X390;
												}	
												else 
												{
												$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
												}
												$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
											
											$content_url = $get_content['url'];
											$param = $content['close_param'];
											$live_article_url = $domain_name.$content_url.$param;
											
											if( $custom_title == '') {
											$custom_title = $get_content['title'];
											}	
											$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
											$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';	
											// Assign summary block starts here
											if( $custom_summary == '' && $content['RenderingMode'] == "auto")
											{
											$custom_summary =  $get_content['summary_html'];
											}
											$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	
											//  summary block endss here
											
											$show_simple_tab .='<div class="box-one kural-box  "><articel><figure>';
											
														
											$show_simple_tab .='<img  src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'" />
																</figure>';
																
																
											$show_simple_tab .='<figcaption>'; 
																	
											$show_simple_tab .='<h4>'.$display_title.'</h4>';
											
											if($is_summary_required== 1)
												$show_simple_tab .= '<p>'.$summary.'</p>';
											
											$show_simple_tab .= '</figcaption></articel></div>';
																		
											}				
												$i =$i+1;	
										}
									//}
							
							} else {
								if($view_mode=="adminview") {	   
							   $show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div>';
								}
							}
            
										/*
													$url_structure = $content['url_structure'];
													$section_landing =  "0,".$content['sectionID'].", 'section', this, '".$url_structure."'";
													if($content['widget_title_link'] == 1)
													{
														$show_simple_tab.=	'<div class="box-botton kural-button "><a href="#" onclick="call_url('.$section_landing.')"  >'.$widget_custom_title.'</a></div>';
													}
													else
													{
														$show_simple_tab.=	'<div class="box-botton kural-button ">'.$widget_custom_title.'</div>';
													}
													$show_simple_tab.= '<div class="box-one kural-box ">';
													
													$j = 0;
													// Adding content Block starts here
													foreach($widget_instancemainsection as $get_section)
													{													
														//getting content block - getting content list based on rendering mode
														//getting content block starts here . Do not change anything
														if($content['RenderingMode'] == "manual")
														{
																$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($get_section['WidgetInstance_id'], $get_section['WidgetInstanceMainSection_id'],$content['mode']); 						
														}
														else
														{
															$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $widget_instancemainsection[$j]['Section_ID'], $content['mode']);
														
														}
														//print_r($widget_instance_contents);exit;
														//getting content block ends here
														//Widget code block - code required for simple tab structure creation. Do not delete
														//Widget code block Starts here
														// content list iteration block - Looping through content list and adding it the list
														// content list iteration block starts here
														$i =1;
														
														foreach($widget_instance_contents as $get_content)
														{
															// getting content details 
															$content_type = @$get_content['content_type_id'];
															$content_details = $this->widget_model->get_contentdetails_from_live_database($get_content['content_id'], $content_type,$is_home);	
															$original_image_path = "";
															$imagealt ="";
															$imagetitle="";
															/*if($content['RenderingMode'] == "manual")
															{
																if(@$get_content['custom_image_path'] != '')
																{
																	$original_image_path = $get_content['custom_image_path'];
																	$imagealt = $get_content['custom_image_title'];	
																	$imagetitle= $get_content['custom_image_alt'];												
																}
															}*

															if(@$original_image_path =='')
															{
																
																if(@$content_details[0]['section_page_image_path'] !='')
																{
																	$original_image_path = @$content_details[0]['section_page_image_path'];
																	$imagealt = @$content_details[0]['section_page_image_alt'];	
																	$imagetitle= @$content_details[0]['section_page_image_title'];
																}
																elseif (@$content_details[0]['article_page_image_path'] !='')
																{
																	$original_image_path = @$content_details[0]['article_page_image_path'];
																	$imagealt = @$content_details[0]['article_page_image_alt'];	
																	$imagetitle= @$content_details[0]['article_page_image_title'];
																}
																/*if($is_home=='y' && @$content_details[0]['home_page_image_path'] !='')
																{
																	$original_image_path = @$content_details[0]['home_page_image_path'];
																	$imagealt = @$content_details[0]['home_page_image_alt'];	
																	$imagetitle= @$content_details[0]['home_page_image_title'];
																}
																elseif (@$content_details[0]['article_page_image_path'] !='')
																{
																	$original_image_path = @$content_details[0]['article_page_image_path'];
																	$imagealt = @$content_details[0]['article_page_image_alt'];	
																	$imagetitle= @$content_details[0]['article_page_image_title'];
																}*
															}
															//$SourceURL = $content['widget_img_phy_path'];
															$show_image="";
																if($original_image_path !='')
																{
																	  $Image600X300  = str_replace("original","w600X300", @$original_image_path);
																		if (getimagesize(image_url . imagelibrary_image_path . $Image600X300) && $Image600X300 != '')
																		{
																			$show_image = image_url. imagelibrary_image_path . $Image600X300;
																		}
																		else {
																			$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
																		}
																		$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
																}
																else
																{
																	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
																	$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X300.jpg';
																}
																
																if(@$content_details[0]['grant_parent_section_name']!='' &&  @$content_details[0]['parent_section_name']!='')
																{
																	 $url_section_value = join( "-",( explode(" ",$content_details[0]['grant_parent_section_name'] ) ) )."/".join( "-",( explode(" ",$content_details[0]['parent_section_name'] ) ) )."/".join( "-",( explode(" ",$content_details[0]['section_name'] ) ) ); 
																}
																else if(@$content_details[0]['parent_section_name'] != '')
																{
																 $url_section_value = join( "-",( explode(" ",@$content_details[0]['parent_section_name'] ) ) )."/".join( "-",( explode(" ",@$content_details[0]['section_name'] ) ) ); 
																}
																else
																{
																	$url_section_value = join( "-",( explode(" ",@$content_details[0]['section_name'] ) ) ); 
																}
																$contentID = @$get_content['content_id'];
																$section_ID = @$content_details[0]['Section_id'];
																$contentTypeID = @$get_content['content_type_id'];
																																
																$string_value = $contentID.",".$section_ID.", 'article', this, '".$url_structure."'";
																
																$content_url_title = join( "-",( explode(" ",@$content_details[0]['url_title']) ) );
																
																$content_url_title = preg_replace('/[^A-Za-z0-9\-]/', '', $content_url_title);
																$param = @$content['close_param'];
 																$live_string_value = $domain_name.$url_section_value."/". $content_url_title."-". $contentID.$param;
															
																$custom_title = @$get_content['CustomTitle'];
																if( $custom_title != '')
																{																	
																	$display_title = $custom_title;
																}
																else
																{
																	$display_title = @$content_details[0]['title'];
																}	
																$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$display_title);
																$display_title = '<a  href="'.$live_string_value.'" class="article_click" >'.$display_title.'</a>';
															//  Assign article links block ends hers
															
															// Assign summary block - creating links for  article summary
																// Assign summary block starts here
															$custom_summary = $get_content['CustomSummary'];
																if( $custom_summary != '')
																{
																	$summary =  $custom_summary;
																}
																else
																{
																	$summary =  @$content_details[0]['summary_html'];
																}
																$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$summary);
																// Assign summary block starts here
																
																// display title and summary block starts here
																//print_r($from_contents_table[0]);exit;
																/*$add_active =($i==1) ? 'active' : '';	
																if($i==1){
																$show_simple_tab .='<div class="slider single-item">';
                                                                }*
																
																
															$show_simple_tab .='<articel><figure>';
														   	$last_publish = @$content_details[0]['publish_on'];
															$publish_date =date('d-m-Y', strtotime($last_publish));
															$custom_imagealt = '';
															$custom_imagetitle= '';
															if($content['RenderingMode'] == "manual")
															{
																/*if($get_content['Image'] != '')
																{
																	$custom_article_image = $get_content['Image'] ;
																}
																if($custom_article_image=='')
																	$custom_article_image	= image_url. imagelibrary_image_path.'logo/custom120x180.jpg';*
																
																if(@$get_content['custom_image_path'] != '')
																{
																	$custom_article_image = $get_content['custom_image_path'];
																	$custom_imagealt = $get_content['custom_image_title'];	
																	$custom_imagetitle= $get_content['custom_image_alt'];												
																}
																else {
																	$custom_article_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_100X65.jpg';
																}
															}
															else
															{
															$custom_article_image	= base_url().'images/FrontEnd/images/dinamani logo/dinamani_logo_100X65.jpg';
															}
															
														   $show_simple_tab .='<img  src="'.$show_image.'" title = "'.$show_image.'" alt = "'.$show_image.'" />
														 	</figure>
															<figcaption>'; 
																	
																		$show_simple_tab .='<h4>'.$display_title.'</h4>';
																		//if($is_summary_required=='y'){
																		 $show_simple_tab .= '<p>'.$summary.'</p>';
																		//}
																		 $show_simple_tab .= '</figcaption>
                                                                                             </articel>';
																
																// display title and summary block ends here					
																//Widget design code block 1 starts here																
															//Widget design code block 1 starts here			
															$i =$i+1;							  
														}
														 
														// content list iteration block ends here
														$j++;
													}
													
													// Adding content Block ends here
													$show_simple_tab .='</div>*/
$show_simple_tab .='</div>
						</div>
							</div>';
echo $show_simple_tab;
?>
