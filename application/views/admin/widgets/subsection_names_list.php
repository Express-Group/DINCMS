<?php
$page_type='section';
$widget_instance_id  =  $content['widget_values']['data-widgetinstanceid'];
$view_mode           = $content['mode'];
$get_widget_instance =  $this->widget_model->getWidgetInstance('', '','', '', $widget_instance_id, $content['mode']);
$page_section_id     = @$get_widget_instance['Pagesection_id'];
$domain_name         =  base_url();

if(@$page_section_id!="")
{
		$sectionname = $this->widget_model->get_sectionDetails($page_section_id, $view_mode); 
		if($sectionname['ParentSectionID'] == 0)
		{
			$get_result = $this->widget_model->get_section_menudisplay($page_section_id);
			$section_name = $sectionname['Sectionname'];
			$MainSectionPageURL = $domain_name.$sectionname['URLSectionStructure'];

		}
		else
		{
			$get_result = $this->widget_model->get_section_menudisplay($sectionname['ParentSectionID']);
			$parent_section = $this->widget_model->get_parent_sectionmane($page_section_id,$view_mode );	
			$section_name = $parent_section['Sectionname'];
			$MainSectionPageURL = $domain_name.$parent_section['URLSectionStructure'];
		}
		
		$parent_sectionname = "";
		if(count(@$parent_section)>0)
		{
			$parent_sectionname = $parent_section['Sectionname'];

		}
		if(@$parent_section['ParentSectionID'] != 0)
		{
			$special_parent_section 	= $this->widget_model->get_sectionDetails($parent_section['ParentSectionID'], $view_mode);	
			//echo $this->db->last_query();
		}
		
		if(@$special_parent_section['Sectionname'] != '')
		{
		 $url_section_value = join( "-",( explode(" ",$special_parent_section['Sectionname'] ) ) )."/".join( "-",( explode(" ",$parent_sectionname ) ) )."/".join( "-",( explode(" ",$sectionname['Sectionname'] ) ) ); 

		}																
		else if($parent_sectionname != '')
		{
		 $url_section_value = join( "-",( explode(" ",$parent_sectionname ) )  ); 

		}
		else
		{
		 $url_section_value = join( "-",( explode(" ",$sectionname['Sectionname'] ) ) ); 																 
		}
		 		
		
		?>
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="SubSections_list">
		<ul>
		<li class="topic"><a href="<?php echo $MainSectionPageURL  ?>" ><?php echo $section_name;  ?></a></li>
		<?php
		
		
		
		foreach($get_result as $section)
		{
			 $name=$section['Sectionname'];
			 $id=$section['Section_id'];
			 
			 $parent_section = $this->widget_model->get_parent_sectionmane($section['Section_id'],$view_mode );	
			 $parent_sectionname = "";
			if(count($parent_section)>0) {
				$parent_sectionname = $parent_section['Sectionname'].'/';
			}
			if(@$parent_section['ParentSectionID'] != 0) {
				$special_parent_section 	= $this->widget_model->get_sectionDetails($parent_section['ParentSectionID'], $view_mode);	
			}
			 
			$SubSectionPageURL = $domain_name.$section['URLSectionStructure'];
			
			?>
		<li class ="<?php if($page_section_id==$section['Section_id']){ echo "active";}?> <?php if(($page_section_id!=$section['Section_id'] )&&($name == "முடிந்த தொடர்கள்")){ echo "mudintha_thodargal";}?>"><a href="<?php echo $SubSectionPageURL?>"><p><?php echo $name; ?></p></a></li>
			 
	<?php  } } ?>
		</ul>
		</div>
		</div>
		</div>