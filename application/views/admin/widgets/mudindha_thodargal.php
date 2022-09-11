<?php
$widget_bg_color     = $content['widget_bg_color'];
$widget_custom_title = $content['widget_title'];
$widget_instance_id  = $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 	 = "";
$is_home             = $content['is_home_page'];
$widget_section_url  = $content['widget_section_url'];
$is_summary_required = $content['widget_values']['cdata-showSummary'];
$widget_section_url  = $content['widget_section_url'];
$view_mode           = $content['mode'];
$domain_name         =  base_url();
$show_simple_tab     = "";

//$widget_auto_count = $this->widget_model->select_setting($view_mode);
//$article_count       = $widget_auto_count['subsection_otherstories_count_perpage'];
$load_more_url = $domain_name.'topic/?sid='.$content['page_param'].'&cid=1';
$widget_instancemainsection	= $this->widget_model->get_widget_mainsection_config_rendering('', $widget_instance_id, $content['mode']);


$show_simple_tab       .='<div class="row">';


$show_simple_tab       .=' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  margin-top-10">';
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
$show_simple_tab       .='</div>';


 $show_simple_tab       .='<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
	$i=1;
	foreach($widget_instancemainsection as $get_section)
	{
		$imagealt            = "";
		$imagetitle          = "";
		$author_image        = "";
		$author_name        = "";
		$section_id      = $get_section['Section_ID'];
		$section_details = $this->widget_model->get_sectionDetails($section_id, $view_mode); 
		$author_id       = $section_details['AuthorID'];
		$author_det      = $this->widget_model->get_author($author_id);	
		$author_url      = $domain_name.$section_details['URLSectionStructure'];
		$section_name    = $section_details['Sectionname'];
	if(count($author_det)>0)
	{
			$author_name = $author_det[0]['AuthorName'];
			
			$author_image = "";
			$imagealt = "";
			$imagetitle  = "";
			$image_id  = $author_det[0]['image_id'] ;
			
			$image_path=$author_det[0]['image_path'] ;
			if($image_path !='')
			{
			$author_image  = $author_det[0]['image_path']; 
			$imagealt             = $author_det[0]['image_alt'];	
			$imagetitle           = $author_det[0]['image_caption'];
	       }	
    }




if($author_image  !='')
{
	if (getimagesize(image_url_no . $author_image ) && $author_image  != '')
	{	
		 $show_image = image_url. $author_image ;
	}
	else
	{
	$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
	}
}
else
{
$show_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';
}
$dummy_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_150X150.jpg';	
		$param = $content['page_param'];

		//  Assign article links block ends hers
		if($i==1 || $i%2==1)
		{
			$show_simple_tab.='<div class="clear_both">';
		}
			$show_simple_tab   .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
	   $show_simple_tab   .='<ul class="old-junction">';
	
	$show_simple_tab   .='<li>
            <figure><a href="'.$author_url.'" > <img  src="'.$show_image.'"  title = "'.$imagetitle.'" alt = "'.$imagealt.'"></a>
              <figcaption>
                <h4>'.$author_name.'</h4>
                <p><a href="'.$author_url.'" >'.$section_name.'</a></p>
              </figcaption>
            </figure>
          </li>';  //<p> '.$display_title.'</p>
		  
	$show_simple_tab   .='</ul>
                          </div>';
						  	
						  if($i==count($widget_instancemainsection)|| $i%2==0)
						  {
							  $show_simple_tab  .='</div>';
						  }
		  
		$i =$i+1;
		 }
		
	if($view_mode=="adminview" && count($widget_instancemainsection)< 0)
{
$show_simple_tab .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">';
$show_simple_tab .='<div class="margin-bottom-10" '.$widget_bg_color.'>'.no_articles.'</div>';
$show_simple_tab .='</div>';

}	

	echo $show_simple_tab       .='</div></div></div>';
	

?>
