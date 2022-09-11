<?php
$widget_bg_color = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	= "";
$is_home = $content['is_home_page'];
//$widget_section_url = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url = $content['widget_section_url'];

$domain_name =  base_url();
$view_mode           = $content['mode'];
$tab_sections	     = $content['widget_values']->widgettab;

if($content['RenderingMode'] == "manual")
{
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);
}else{
$widget_instancemainsection	= $content['widget_values']->widgettab;
}
	 //print_r($content['widget_values']);exit;          

$show_simple_tab = "";
$show_simple_tab .='<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10 ">';
                                                   
if($widget_custom_title!='')
{	
    $show_simple_tab    .='<figure class="bg-left"></figure>';				
	if($content['widget_title_link'] == 1)
	{
	$show_simple_tab.=	' <figure class="bg-center1"><a href="'.$widget_section_url.'">'.$widget_custom_title.'</a></figure>';
	}
	else
	{
	$show_simple_tab.=	' <figure class="bg-center1">  '.$widget_custom_title.' </figure>';
	}
	$show_simple_tab .=' <figure class="bg-right"> </figure>';
}
 // echo 'hh'; exit;                                                 
$show_simple_tab .='<div id="parentHorizontalTab'.$widget_instance_id.'">';

$show_simple_tab .='<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job-tab">
<ul class="resp-tabs-list hor_1 ">';
			
			$instance_id = "";
			$widget_main_section_id = "";
			
			if($content['RenderingMode'] == "manual")
			{
				   $l=1;
				foreach($widget_instancemainsection as $get_section)
				{
				$add_attr = ($l>1)?'id="tnpsc'.$get_section['WidgetInstanceMainSection_id'].'"': '';
				$show_simple_tab .= ' <li '.$add_attr.'> '.$get_section['CustomTitle'].'</li> ';
				$l++;
				}
				
			}
			else
			{
				$l=1;
				foreach($widget_instancemainsection as $get_section)
				{
				$add_attr = ($l>1)?'id="tnpsc'.$get_section['cdata-categoryId'].'"': '';
				$show_simple_tab .= ' <li '.$add_attr.'> '.$get_section['cdata-customTitle'].'</li> ';
				$l++;
				}
			}
			
			
$show_simple_tab .='</ul>              
					</div>
					</div> ';
					
					 
			$show_simple_tab .='<div class="resp-tabs-container hor_1 job-exam  " '.$widget_bg_color.'>';
			
	$j = 0;						  
	foreach($widget_instancemainsection as $get_section)
	{	
	
	if($j==0){
			if($content['RenderingMode'] == "manual")
			{
			$content_type = $content['content_type_id'];  // auto article content type
			$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($get_section['WidgetInstance_id'], $get_section['WidgetInstanceMainSection_id'],$content['mode'],$content['show_max_article']); 						
			}
			else
			{
			$content_type = $content['content_type_id'];  // auto article content type
			$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($content['show_max_article'], $get_section['cdata-categoryId'] , $content_type ,  $content['mode']);
			}
			
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
		$widget_contents = array();
			foreach ($widget_instance_contents as $key => $value) {
				foreach ($widget_instance_contents1 as $key1 => $value1) {
					if($value['content_id']==$value1['content_id']){
					   $widget_contents[] = array_merge($value, $value1);
					}
				}
			}
			
$i =1;
$show_simple_tab .='<div>
					<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<div class="outline job-sub-tab">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
					<ul class="lead-list"  >';
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content)
	{
		$custom_title        = "";
		$custom_summary      = "";  
		$summary             = "";
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
		/*if( $custom_summary == '' && $content['RenderingMode'] == "auto")
		{
		$custom_summary =  $get_content['summary_html'];
		}
		$summary  = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_summary);  //to remove first<p> and last</p>  tag	 */
		//  summary block endss here
		
		// Assign summary block - creating links for  article summary
		
		
		if($i<=count($widget_contents))
		{
		$show_simple_tab.='<li>
		<div><i class="fa fa-angle-right"></i></div>
		<p>'.$display_title.'</p>
		</li>';
		
		}
		$i =$i+1;							  
		}
   }
	
	$show_simple_tab .='</ul>  
				 </div>
				 </div>
				 </div>
				 </div>
				 </div>'; 													
 }
  elseif($view_mode=="adminview")
  {
		$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
  }else{
        $show_simple_tab .='<div class="margin-bottom-10"></div>';
  }
}
else
   {
	   if($content['RenderingMode'] == "manual"){
			$show_simple_tab .='<div id="tnpsc_'.$get_section['WidgetInstanceMainSection_id'].'_'.$widget_instance_id.'">
			<div class="cssload-container" id="add_article_process_img'.$get_section['WidgetInstanceMainSection_id'].'" style="display:none;"><div class="cssload-zenith"></div></div>
<div class=" ajaxStatus ajaxFailed noDisplay" style="display: none;">Failed to load the content...</div></div>';
			}else{
			$show_simple_tab .='<div id="tnpsc_'.$get_section['cdata-categoryId'].'_'.$widget_instance_id.'">
			<div class="cssload-container" id="add_article_process_img'.$get_section['cdata-categoryId'].'" style="display:none;"><div class="cssload-zenith"></div></div>
<div class=" ajaxStatus ajaxFailed noDisplay" style="display: none;">Failed to load the content...</div></div>';
			}
   }
		 
	$j++;
 }
						 
  echo $show_simple_tab .=' </div>
						   </div>
						   </div>
						   </div>';
													
?>

<script type="text/javascript">
$(document).ready(function() {
//Horizontal Tab

$('#parentHorizontalTab<?php echo $widget_instance_id; ?>').easyResponsiveTabs({activate: function(event, tab) {
	
	var id= $(this).attr('id');
	//console.log(id);
	var tnpsc_id = id.substring(5);
	console.log(tnpsc_id);
	$('#add_article_process_img'+tnpsc_id).css('display','block');
	if($(this).attr('id'))
	{
		$.ajax({
			url:'<?php echo base_url(); ?>user/commonwidget/tnpsc_content',
			method:'post',
			data:{section_id:tnpsc_id, widgetinstanceid:'<?php echo $widget_instance_id; ?>',mode: '<?php echo $content['mode'];?>', 'rendermode' : '<?php echo $content['RenderingMode'];?>', is_home : '<?php echo $is_home;?>', max_article : '<?php echo $content['show_max_article'];?>', summary_option: '<?php echo $is_summary_required;?>',param : '<?php echo $content['page_param'];?>'},
			beforeSend	: function() {				
								},
								success: function(result)
								{
									$('#'+id).removeAttr('id');
									   $('#tnpsc_'+tnpsc_id+'_<?php echo $widget_instance_id; ?>').html(result).hide().fadeIn({ duration: 2000 });
								}
			
			
			})
	
        }
	
	
	
	
	
	},

});
});
</script> 



