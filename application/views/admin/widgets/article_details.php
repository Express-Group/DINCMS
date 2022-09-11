<style>
@media (min-width: 320px) and  (max-width: 991px){
	.insta_link a { font-size: 10px !important;}
	.insta_link img { margin:3px;}
	.insta_link { line-height: 8px !important;text-align: center !important;}
}
.insta_link { display:block;}
.ArticleDetail-title{width: 146.5%;}
.SectionContainer > .row >.col-lg-4{margin-top: 16.2%;}
.title-container{float:left;width:100%;background:#012061;padding: <?php echo ($content['content_type']=='1') ? '10px 10px 6%' : '10px 10px 3%'; ?>;position:relative;}
.title-container h6{margin:0 0 15px;} 
.title-container .b-link ,.title-container .b-link a{color:#fff;}
.title-container .published_on{float: right;color: #fff;border-bottom: 1px solid #bb0504;}
.title-container .published_on span{color:yellow;}
.AticleImg{margin-left: 10px;margin-top: -30px;border: 4px solid #fff;}
.csbuttons-count{display:none;}
.Social_Fonts1{position: absolute;right: 1%;bottom: 4%;}
.Share_Icons{margin-right: 6px;}
.Share_Icons .fa_social{border: 2px solid #fff;}

@media (max-width: 767px){
	.ArticleDetail-title{width:100%;}
	.title-container .b-link{width:100%;}
	.title-container .published_on{float: left;margin: 10px 0 16px;}
	.AticleImg{margin-left: 0;margin-top: 0;border: none;}
	.ArticleHead{font-size: 18px!important;width: 100%;float: left;line-height: 30px !important;}
	.Social_Fonts1{position: relative;float: left;margin-top: 10px;}
	.title-container{padding: 10px 10px 4%;}
}
</style>
<article class="WidthFloat_L printthis">
<?php
					$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
				    $content_id         = $content['content_id'];
					$content_type_id    = $content['content_type'];
					$view_mode          = $content['mode'];
					if($content_id!=''){
										 
					if($content['content_from'] =="live"){
					//$content_details = $this->widget_model->widget_article_content_by_id($content_id, $content_type_id, ""); from live
					$content_details = $content['detail_content'];   // from Template Controller
					}else if($content['content_from']=="archive"){
		            $content_details = $content['detail_content'];
					}
					$content_det= $content_details[0];
					
					$section_id = $content_det['section_id'];
					
					//print_r($content_det);exit;
					$domain_name =  base_url();
					$article_url = $domain_name.$content_det['url'];
					$section_details = $this->widget_model->get_sectionDetails($section_id, $view_mode);
					// Code added for Advertismnet 
					//to get section_mapping_id
					$MultiSectionMapping=$this->widget_model->GetSectionMappingId(@$section_id,@$content_type_id,@$content_id);
					$MultiSectionMapping=[];
					
					if($MultiSectionMapping!=0){		
					
						if(in_array("334", $MultiSectionMapping) || in_array("480", $MultiSectionMapping) || in_array("556", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=69&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("386", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=70&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("388", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=71&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("389", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=72&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("335", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=73&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("387", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=74&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("401", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=75&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("333", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=76&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("339", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=77&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("502", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=78&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("341", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->						
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=79&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("615", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->			
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=80&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("541", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=18&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("478", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=68&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("471", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=19&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
						if(in_array("474", $MultiSectionMapping)){
							?>
							<!-- Begin ZEDO -->
							<img src="http://d7.zedo.com/img/bh.gif?n=791&g=20&a=81&s=1&l=1&t=r&f=1" width="1" height="1" border="0" >
							<!-- end ZEDO   -->
							<?php
						}
					}
					
					$home_section_name = 'முகப்பு';
					$child_section_name = $section_details['Sectionname'];
					$child_section_name1 = $section_details['URLSectionStructure'];
					$url_structure       = $section_details['URLSectionStructure'];
					$sub_section_name = 'முகப்பு';
					if($section_details['IsSubSection'] =='1'&& $section_details['ParentSectionID']!=''&& $section_details['ParentSectionID']!=0 ){
					$sub_section = $this->widget_model->get_sectionDetails($section_details['ParentSectionID'], $view_mode);
					$sub_section_name = ($sub_section['Sectionname']!='')? $sub_section['Sectionname'] : '' ;
					$sub_section_name1= $sub_section['URLSectionStructure'];
					 if($sub_section['IsSubSection'] =='1'&& $sub_section['ParentSectionID']!=''&& $sub_section['ParentSectionID']!=0 ){
					$grand_sub_section = $this->widget_model->get_sectionDetails($sub_section['ParentSectionID'], $view_mode);
					$grand_parent_section_name = $grand_sub_section['Sectionname'];
					$grand_parent_section_name1 = $grand_sub_section['URLSectionStructure'];
					$section_link = '<a href="'.$domain_name.'">'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$grand_parent_section_name1.'">'.$grand_parent_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$sub_section_name1.'">'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href="'.$domain_name.$child_section_name1.'">'.$child_section_name.'</a>';
					}else{
					$section_link = '<a href='.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$sub_section_name1.' >'.$sub_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}
					}elseif(strtolower($child_section_name) != "முகப்பு"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a> <i class="fa fa-angle-right"></i> <a href='.$domain_name.$child_section_name1.' >'.$child_section_name.'</a>';
					}elseif(strtolower($child_section_name) == "முகப்பு" || strtolower($child_section_name) == "home"){
					$section_link = '<a href= '.$domain_name.' >'.$home_section_name.'</a>';
					}
					if($MultiSectionMapping!=0):
						if(in_array("759", $MultiSectionMapping)){
							$section_link .= '<a style="float:right;text;font-size:12px;color: #cd1a13 !important;" href= '.$domain_name.'sports/asian-games-2018 >ஆசிய விளையாட்டு 2018</a>';
						}
					endif;
				 // echo '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
				 /*  echo '<div class="bcrums" style="margin-top:0;"> 
				   '.$section_link.'  </div>
				  </div>
				  </div>'; */
				  ?>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetail-title">
  <div class="title-container">
  <h6><span class="b-link"><?php echo $section_link; ?></span><span class="published_on">Published On : <span><?php echo date('dS  F Y h:i A' , strtotime($content_det['publish_start_date'])); ?></span></span></h6>
    <?php 		
					//////  For Article title  ////		
					$content_title = $content_det['title'];
					if( $content_title != '')
					{
						//$content_title = stripslashes(preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $content_title));
						$content_title = stripslashes(strip_tags($content_title, '</p>'));
					}
					else
					{
						$content_title = '';
					}
                    $content_url = '';
					$page_index_number = ''; 
					if($content_type_id ==1){	
					$linked_to_columnist = $content_det['author_name'];
					if($linked_to_columnist!=''){
					$author_name = $content_det['author_name'];
					}else{
					$author_name = $content_det['agency_name'];
					}
					}else{
					$author_name = $content_det['agency_name'];
					}
					
				   $published_date = date('dS  F Y h:i A' , strtotime($content_det['publish_start_date']));
				   $last_updated_date  = date('dS  F Y h:i A' , strtotime($content_det['last_updated_on']));
				   $allow_social_btn= 1; //$content_det['allow_social_button'];
				   $allow_comments= $content_det['allow_comments'];
				
				   $email_shared = 0; //$content_det['emailed'];
				   if ($email_shared > 999 && $email_shared <= 999999) {
					$email_shared = round($email_shared / 1000, 1).'K';
				   } else if ($email_shared > 999999) {
				   $email_shared = round($email_shared / 1000000, 1).'M';
				   } else {
					$email_shared = $email_shared;
				   }
				   $publish_start_date = $content_det['publish_start_date'];
					?>
    <h1 class="ArticleHead" id="content_head" itemprop="name"><?php echo $content_title;?></h1>
    <!--<div class="vuukle-powerbar"></div>-->
    <?php if($allow_social_btn==1) { ?>
    <div class="Social_Fonts1 FixedOptions1">
      <div class="PrintSocial1">  <span class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="twitter" data-txt="<?php echo strip_tags($content_title);?>" data-via="Dinamani" data-count="false"><i class="fa fa-twitter fa_social"></i></a></span> <span  class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="facebook" data-count="false"><i class="fa fa-facebook fa_social"></i></a></span> <span style="display:none;" class="Share_Icons"><a href="javascript:;" class="csbuttons" data-type="google" data-lang="ta" data-count="false"><i class="fa fa-google-plus fa_social"></i></a></span> <span class="Share_Icons PositionRelative"><i class="fa fa-envelope-o fa_social" id="popoverId"></i><span style="display:none" class="csbuttons-count"><?php echo $email_shared;?></span></span>
	  <!--<span  class="Share_Icons">
			<a class="whatsapp" data-txt="<?php echo strip_tags($content_title);?>" data-lang="ta" data-link="<?php echo $article_url; ?>"  data-count="false">
			<i class="fa fa-whatsapp fa_social"></i></a>
	  </span>-->
        <div id="popover-content" class="popover_mail_form fade right in ">
          <div class="arrow"></div>
          <h3 class="popover-title">Share Via Email</h3>
          <div class="popover-content">
            <form class="form-inline Mail_Tooltip" action="<?php echo base_url(); ?>user/commonwidget/share_article_via_email" name="mail_share" method="post" id="mail_share" role="form">
              <div class="form-group">
                <input type="text" placeholder="Name" name="sender_name" id="name" class="form-control">
                <input type="text" placeholder="Your Mail" name="share_email" id="share_email" class="form-control">
                <input type="text" placeholder="Friends's Mail" name="refer_email" id="refer_email" class="form-control">
                <textarea placeholder="Type your Message" class="form-control" name="message" id="message"></textarea>
                <input type="hidden"  class="content_id" name="content_id" value="<?php echo $content_id;?>" />
                <input type="hidden"  class="section_id" name="section_id" value="<?php echo $section_id;?>" />
                <input type="hidden"  class="article_created_on" name="article_created_on" value="<?php echo $publish_start_date;?>" />
                <input type="hidden"  class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
                <input type="reset" value="Reset" class="submit_to_email submit_post">
                <!--<input type="submit" value="share" class="submit_to_email submit_post" name="submit">-->
                <input type="button" value="Share" id="share_submit" class="submit_to_email submit_post" onclick="mail_form_validate();" name="submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php  } ?>
  </div>
  </div>
</div>
<?php
	  
	/* ------------------------------------- Article content Type --------------------------------------------*/	
				  
	if($content_type_id=='1'){
	
	$article_body_text =  stripslashes($content_det['article_page_content_html']);	
	
	//$Image600X390=$content_det['article_page_image_path'];
	$Image600X390      = str_replace(' ', "%20", $content_det['article_page_image_path']);
	$smallsizeimage  = false;
	if ($Image600X390 != '' && get_image_source($Image600X390, 1))
	{
	$imagedetails = get_image_source($Image600X390, 2);
	$imagewidth = $imagedetails[0];
	$imageheight = $imagedetails[1];
	//$smallsizeimage = ($imagewidth > 300)? false : true;
	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	else
	{				
		//$Image600X390 	= str_replace("original","w600X390", $content_det['article_page_image_path']);
		$Image600X390 	= $content_det['article_page_image_path'];
	}
	$image_path='';
	
		$image_path = image_url. imagelibrary_image_path . $Image600X390;
		
	}
	else{
	$image_path='';
	$image_caption='';	
	}
	$show_image = ($image_path != '') ? $image_path : "no_image";
	$image_caption= $content_det['article_page_image_title'];
	$image_alt =  $content_det['article_page_image_alt'];
	$content_url       = base_url().$content_det['url'];
	$page_index_number = ($content_det['allow_pagination']==1)? $content['image_number'] : "no_pagination";
	?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail ArticleDetailContent">
  <div id="content" class="content" itemprop="description">
    <?php if($show_image!='no_image'){ ?>
    <figure class="AticleImg <?php if($smallsizeimage==false){ echo 'open_image'; } ?>" <?php if($smallsizeimage==true){ echo 'style="pointer-events:none;"'; } ?>>
      <?php if($smallsizeimage==false){ ?><div class="image-Zoomin"><i class="fa fa-search-plus"></i><i class="fa fa-search-minus"></i></div> <?php } ?>
      <img src="<?php echo $show_image;?>" title="<?php echo $image_caption;?>" alt="<?php echo $image_alt;?>" itemprop="image">
      <?php if($image_caption!=""){ ?>
      <p class="AticleImgBottom"><?php echo strip_tags($image_caption);?></p>
      <?php } ?>
    </figure>
    <?php } ?>
    <div id="storyContent">
    <?php echo $article_body_text; ?>
	<style>.morefrom{width: 100%;float: left;margin:2% 0 2%;} .morefrom a{font-weight:bold;color: #ff0e03;} .morefrom span{float:left;font-size: 13px;}</style><div class="morefrom"><span><a target="_BLANK" href="https://play.google.com/store/apps/details?id=com.dinamani.news&hl=en">மேலும் செய்திகளை உடனுக்குடன் படிக்க, தினமணி மொபைல் ஆப்-ஐ இங்கே கிளிக் செய்து தரவிறக்கம் செய்துகொள்ளுங்கள்!</a></span></div>
    </div>
	<div id="paginationpager" class="pagination">
	 </div>
	 <?php
		if (strpos($article_body_text, '{pagination-pagination}') !== false){ ?>
			<script src="<?php echo image_url; ?>js/FrontEnd/js/jquery.bootpag.min.js" type="text/javascript"></script>
			<script src="<?php echo image_url; ?>js/FrontEnd/js/custom-pagination.js" type="text/javascript"></script>
			<script>
			$('#storyContent').pager("<?php print $content_url ?>",{splitcontent:'{pagination-pagination}',pagerelement:'paginationpager',elementtype:'id', scrolltop :0});
			</script>
		<?php }
	 ?>
	 <?php
	//if($content_det['allow_pagination']==0):
	 ?>
		<!--<script src="<?php echo image_url; ?>js/FrontEnd/js/jquery.bootpag.min.js" type="text/javascript"></script>
		<script src="<?php echo image_url; ?>js/FrontEnd/js/custom-pagination.js" type="text/javascript"></script>
		<script>
	$('#storyContent').pager("<?php print $content_url ?>",{splitcontent:'{pagination-pagination}',pagerelement:'paginationpager',elementtype:'id', scrolltop :0});
	</script>-->
	<?php //endif; ?>
	<?php
		//if($content_det['allow_pagination']==1):
		?>
		<script src="<?php echo image_url; ?>js/FrontEnd/js/article-pagination.js" type="text/javascript"></script>
		<?php
		//endif;
	?>
    </div>
  <?php 
	  if($content['content_from']=="live"){
	 $Related_article_content = $this->widget_model->get_related_article_by_contentid($content_id, $content['content_from']);
	 if(count($Related_article_content)>0){
	 ?>
     <div id="RelatedArticle" style="display:none;">
  <ul class="RelatedArticle" >
    <div class="RelatedArt">தொடர்புடைய செய்திகள்</div>
    <?php foreach ($Related_article_content as $get_article){
		$relatedarticle_title = strip_tags($get_article['related_articletitle']);
		$related_url          = $get_article['related_articleurl'];
		$param                = $content['close_param'];
		$domain_name          =  base_url();
		$related_article_url  = $domain_name.$related_url.$param;
		?>
    <li><a href="<?php echo $related_article_url;?>"  class="article_click" target="_blank"><i class="fa fa-angle-right"></i><?php echo $relatedarticle_title;?></a></li>
    <?php  } ?>
    </ul></div>
  <?php } ?>
  <?php }elseif($content['content_from']=="archive"){
	 $live_query_string 	    = explode("/",$this->uri->uri_string());
	 $year                      = $live_query_string[count($live_query_string)-4];
	 $table                     = "relatedcontent_".$year;
	 $Related_article_content = $this->widget_model->get_related_article_from_archieve($content_id, $table);
	 if(count($Related_article_content)>0){
	 ?>
     <div id="RelatedArticle" style="display:none;">
  <ul class="RelatedArticle">
    <div class="RelatedArt">Related Article</div>
    <?php foreach ($Related_article_content as $get_article){
		$relatedarticle_title = strip_tags($get_article['related_articletitle']);
		$related_url          = $get_article['related_articleurl'];
		$param                = $content['close_param'];
		$domain_name          =  base_url();
		$related_article_url  = $domain_name.$related_url.$param;
		?>
    <li><a href="<?php echo $related_article_url;?>"  class="article_click" target="_blank"><i class="fa fa-angle-right"></i><?php echo $relatedarticle_title;?></a></li>
    <?php  }  ?>
	  </ul></div>
	<?php }?>
  <?php }
	  ?>
  <!--<div class="pagination pagina">
    <ul>
      <li><a href="javascript:;" id="prev" class="prevnext element-disabled">« Previous</a></li>
      <li><a href="javascript:;" id="next" class="prevnext">Next »</a></li>
    </ul>
    <br />
  </div>-->
  <div class="text-center">
  <ul class="article_pagination" id="article_pagination">
    </ul></div>
  <div id="keywordline"></div>
  
   <?php $LiveCount=$this->widget_model->GetLiveNewsCount($content_id,$section_id); if($LiveCount!=0): ?>
  <!--start of code-->
  <div class="livenow-content">
		<input type="hidden" value="<?php print $image_path; ?>" id="livenow_article_img">
		<div class="livenow_loader"><a><span class="livenow-flash">Live Updates</span><img class="loader-img-livenow"  src="<?php print BASEURL ?>images/live_now_loader.gif" alt="" style="width:18px; height:18px;display:none;" /></a></div>
		<input type="hidden" value="<?php print $content_id ?>" id="article_id">
		<div class="livenow-content1">
		</div>
	</div>
		
	<script>

	var loaderid=0;
	function load(){
		//$('.livenow-flash').html('Live Updating...').show();
		$('.loader-img-livenow').show();
		var image_name=$('#livenow_article_img').val();
		$.ajax({
			type        : 'post',
			url			: '<?php echo base_url(); ?>user/commonwidget/getLivenowContentStatic',
			cache       : false,
			data		: {'article_id':<?php print $content_id ?>  ,'article_url':'<?php print $article_url ?>'  , 'image_url': image_name},
			success     : function(result){
							if(result!=''){
								$('.livenow-content1').html(result);
							}
			},
			error       :function(code,status){
						//alert(status);
			}
		});
		$('.livenow-flash').html('LIVE Updates');
		$('.loader-img-livenow').hide(700);
		clearInterval(loaderid);
		loaderid = setInterval('load()',30000);
	}
	load();
	
		$(document).on("click",'.whatsapp1', function(e) {
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			var article = ($(this).attr("data-txt").trim()=='')? $('.ArticleHead').text() : $(this).attr("data-txt");
			var weburl = $(this).attr("data-link");
			var whats_app_message = article +" - "+encodeURIComponent(weburl);
			var whatsapp_url = "whatsapp://send?text="+whats_app_message;
			window.location.href= whatsapp_url;
							
        } else{
			var article = ($(this).attr("data-txt").trim()=='')? $('.ArticleHead').text() : $(this).attr("data-txt");
			var weburl = $(this).attr("data-link");
        }
    });


	 
</script>
<?php endif; ?>
	<!--end of code-->
</div>
<?php }
	/* ------------------------------------- Gallery content Type --------------------------------------------*/	
else if($content_type_id=='3'){ 
$get_gallery_images	 = $content_details;
$image_number        = $content['image_number'];
$content_url         = base_url().$content_details[0]['url'];
$page_index_number   = $content['image_number'];
$gallery_description = $content_det['summary_html'];
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 features Detail-play">
  <div class="gallery-single-item" style="width:100% !important">
  
    <?php
	$gallerycount = count($get_gallery_images);
	$g=1;
	foreach($get_gallery_images as $gallery_image){ 
				  
                  $gallery_caption = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $gallery_image['gallery_image_title']);
				  $gallery_alt =  $gallery_image['gallery_image_alt'];
				  //$Image600X390= $gallery_image['gallery_image_path'];
				  $Image600X390 = str_replace(' ', "%20", $gallery_image['gallery_image_path']);
				  if (get_image_source($Image600X390, 1) && $Image600X390 != '')
					{
				  $imagedetails = get_image_source($Image600X390, 2);
					$imagewidth = $imagedetails[0];
                    $imageheight = $imagedetails[1];
					if ($imageheight > $imagewidth) // vertical image
					{
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:100%"';
					}else if($imagewidth > 600 && $imagewidth < 700) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:70%"'; 
					}
					else if($imagewidth < 600) // minimum width image
					{				
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = 'style="width:60%"'; //'class="gallery_minimum_pixel"';
					}else  // normal image
					{				
						//$Image600X390 	= str_replace("original","w600X390", $gallery_image['gallery_image_path']);
						$Image600X390 	= $gallery_image['gallery_image_path'];
						$is_verticle    = '';
					}
						$show_gallery_image = image_url. imagelibrary_image_path . $Image600X390;
					}else{
						$show_gallery_image	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
						$is_verticle        = '';
					}
					$dynamicUrl = str_replace('.html' , '--'.$g.'.html' , $content_details[0]['url']);
                  ?>
    <div class="item gallery-item" rel="/<?php echo $dynamicUrl; ?>">
      <figure class="PositionRelative"> <img src="<?php echo $show_gallery_image;?>" title="<?php echo $gallery_caption;?>" alt="<?php echo $gallery_alt;?>" <?php echo $is_verticle;?> <?php if($gallery_caption==""){ echo ' class="no-gal-cap" ';  }?>>
       <?php if($gallery_caption!=""){ ?>
        <div class="TransLarge Font14"><?php echo $gallery_caption;?></div>
         <?php } ?>
		<span class="gallery-counts"><b><?php echo $g; ?></b><span> / <?php echo $gallerycount; ?></span></span> 
		<div class="gallerysocial-icon">
			<img rel="facebook"  src="<?php echo image_url.'images/FrontEnd/images/social-article/gallery-facebook.png' ?>">
			<img rel="twitter"  src="<?php echo image_url.'images/FrontEnd/images/social-article/gallery-twitter-squared.png' ?>">
		</div>
      </figure>
    </div>
    <?php 
				$g++;	 } ?>
   </div>
    <p class="Gallery_description_summary"> <?php echo strip_tags($gallery_description);?></p>
  <?php if(count($get_gallery_images)> 1){ ?>
  <div class="text-center">
    <ul class="gallery_pagination" id="gallery_pagination">
    </ul>
  </div>
  <?php } ?>
  <style>.morefrom{width: 100%;float: left;margin:2% 0 2%;} .morefrom a{font-weight:bold;color: #ff0e03;} .morefrom span{float:left;font-size: 13px;}</style><div class="morefrom"><span><a target="_BLANK" href="https://play.google.com/store/apps/details?id=com.dinamani.news&hl=en">மேலும் செய்திகளை உடனுக்குடன் படிக்க, தினமணி மொபைல் ஆப்-ஐ இங்கே கிளிக் செய்து தரவிறக்கம் செய்துகொள்ளுங்கள்!</a></span></div>
    <script>
	var galleryContent = $('.gallery-item');
	var firstContent = $(galleryContent).eq(0).attr('rel');
	var currentUrl = firstContent;
	var isbackScoll = false;
	var previousScroll = 0;
	$(document).scroll(function () {
		var currentPosition = $(this).scrollTop();
		$(galleryContent).each(function(index){
			var top	= window.pageYOffset;
			var distance = top - $(this).offset().top + 50;
			var hash  = $(this).attr('rel');
			if (distance < 20 && distance > -20 && currentUrl != hash){
				currentUrl = hash;
				history.replaceState({}, '', currentUrl);
				ga('set', {location: '<?php echo str_replace('.com/','.com',BASEURL); ?>'+hash, page: hash});
				ga("send", "pageview");

			}
			if(distance > 250 && distance < 400 && currentHash != hash){
				currentUrl = hash;
				history.replaceState({}, '', currentUrl);
				ga('set', {location: '<?php echo str_replace('.com/','.com',BASEURL); ?>'+hash, page: hash});
				ga("send", "pageview");
			}
		});
	});
	$('.gallerysocial-icon img').on('click' ,function(e){
		var rel = $(this).attr('rel');
		if(rel=='pinterest'){
			var url = encodeURI($(this).attr('data-url'));
			var imageUrl = encodeURI($(this).attr('data-imageurl'));
			var description = $(this).attr('data-description');
			var pin = window.open("https://in.pinterest.com/pin/create/button/?url="+url+"&media="+imageUrl+"&description="+description, "", "width=670,height=340"); 
		}else{
			$('a[data-type="'+rel+'"]').trigger('click');
		}
		
	});
 </script>
	<script>
var currentimageIndex = "<?php echo (($image_number)> count($get_gallery_images))? 1: $image_number;  ?>";
var TotalIndex = "<?php echo (count($get_gallery_images));  ?>";
$( document ).ready(function() {
$('html').addClass('gallery_video_remodal');
<?php if(($image_number) > 1 ){ ?>
 $('.GalleryDetailSlide').slick('slickGoTo', <?php echo $image_number-1;?>);
<?php } ?>
});
</script>
  <div id="keywordline"></div>
</div>
<?php 
							}
						/* ------------------------------------- Video content Type --------------------------------------------*/	
							else if($content_type_id=='4')
							{    
							 $video_scipt       = htmlspecialchars_decode($content_det['video_script']);
							 $video_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
						?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="videodetail" style="text-align: center;">
  <div class="video_detail_skin">
    <?php if($content_det['video_site']=='ventunovideo'){ 
	//$video_scipt = trim(stripslashes($video_scipt),'"');
	?>
    <object width="630" height="441" id="ventuno_player_0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
      <param name="movie" value="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>"/>
      <param name="allowscriptaccess" value="always"/>
      <param name="allowFullScreen" value="true"/>
      <param name="wmode" value="transparent"/>
      <embed src="http://cfplayer.ventunotech.com/player/vtn_player_2.swf?vID==<?php echo $video_scipt;?>" width="630" height="441" 
wmode="transparent" allownetworking="all" allowscriptaccess="always" allowfullscreen="true"></embed>
    </object>
    <?php }else{
		echo $video_scipt;
	}
		 ?>
    <p> <?php echo $video_description;?></p>
    </div>
  </div>
  <div id="keywordline"></div>
  <style>.morefrom{width: 100%;float: left;margin:2% 0 2%;} .morefrom a{font-weight:bold;color: #ff0e03;} .morefrom span{float:left;font-size: 13px;}</style><div class="morefrom"><span><a target="_BLANK" href="https://play.google.com/store/apps/details?id=com.dinamani.news&hl=en">மேலும் செய்திகளை உடனுக்குடன் படிக்க, தினமணி மொபைல் ஆப்-ஐ இங்கே கிளிக் செய்து தரவிறக்கம் செய்துகொள்ளுங்கள்!</a></span></div>
</div>
<script>
						 $( document ).ready(function() {
						 $('html').addClass('gallery_video_remodal');
						});
						</script>
<?php 
							}
					/* ------------------------------------- Audio content Type --------------------------------------------*/	
							else 
							{ 
							 $audio_path       = image_url. audio_source_path.$content_det['audio_path'];
							 $audio_description = $content_det['summary_html'];
							 $content_url       = base_url().$content_det['url'];
							?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="GalleryDetail">
      <audio class="margin-left-10 margin-top-5" controls="" src="<?php echo $audio_path;?>"> </audio>
      <p> <?php echo $audio_description;?></p>
    </div>
    <div id="keywordline"></div>
  </div>
  <?php	}
}?>
  <?php 
			  $article_tags= $content_det['tags'];
              $get_tags =array();
			  if($article_tags!='')
			  $get_tags=  explode(",", $article_tags);
			  if(count($get_tags)>0){
			   ?>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
    <div class="tags">
      <div> <span>TAGS</span> </div>
      <?php foreach($get_tags as $tag){
		             if($tag!=''){
				     $tag_title = join( "_",( explode(" ", trim($tag) ) ) );
		             $tag_url_title = preg_replace('[,]', '', $tag_title); 
					 

							$tag_link = base_url().'topic/'.urlencode($tag_title); 
                            echo '<a href="'.$tag_link.'">'.$tag.'</a>';
					     } 
                            } ?>
    </div>
  </div>
  <?php }  ?>
</div>
</article>
<div class="NextArticle FixedOptions" style="display:none;">
  <?php
					//$time1 = microtime(true);
					$prev_article = $this->widget_model->get_section_previous_article($content['content_id'], $content_det['section_id'],$content_type_id);
					$next_article = $this->widget_model->get_section_next_article($content['content_id'], $content_det['section_id'],$content_type_id);
										
//$time2 = microtime(true);
//echo "script execution time: ".($time2-$time1); //value in seconds				

					//print_r($select_section_prev_article);exit;
					?>
  <?php if(count($prev_article)> 0){
					$prev_content_id = $prev_article['content_id'];
					$prev_section_id = $prev_article['section_id'];
					$param = $content['close_param'];
					$prev_string_value = $domain_name.$prev_article['url'].$param;
	                 ?>
  <a class="prev_article_click LeftArrow" href="<?php echo $prev_string_value;?>" title="<?php echo strip_tags($prev_article['title']);?>"><i class="fa fa-chevron-left"></i></a>
  <?php } ?>
  <?php if(count($next_article)> 0){
					$next_content_id = $next_article['content_id'];
					$next_section_id = $next_article['section_id'];
					$param = $content['close_param'];
					$next_string_value = $domain_name.$next_article['url'].$param;
					?>
  <a class="next_article_click RightArrow" href="<?php echo $next_string_value;?>" title="<?php echo strip_tags($next_article['title']);?>"><i class="fa fa-chevron-right"></i></a>
  <?php } ?>
</div>
<!--style overwriting editor body content-->
<style>
.ArticleDetailContent li{float: none; list-style: inherit;}
.ArticleDetailContent blockquote {
    padding-left: 20px !important;
    padding-right: 8px !important;
    border-left-width: 5px;
    border-color: #ccc;
    font-style: italic;
	margin:10px 0 !important;
	padding: 12px 16px !important;
	font-size:13px !important;
}
.ArticleDetailContent blockquote p{font-size:13px !important;text-align:center;}
@media screen and ( max-width: 768px){
 audio { width:100%;}
}
</style>
<script type="text/javascript">
            $(document).ready(function() {
                $('.whatsapp').on("click", function(e) {
                    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

                        var article = $(this).attr("data-txt");
                        var weburl = $(this).attr("data-link");
                        var whats_app_message = article +" - "+weburl;
                        var whatsapp_url = "whatsapp://send?text="+whats_app_message;
                        window.location.href= whatsapp_url;
						//alert(whatsapp_url);
                    }/* else{
                        alert('you are not using mobile device.');
                    } */
                });
            });
        </script>
<script type="text/javascript">
	var base_url        = "<?php echo base_url(); ?>";
	var content_id      = "<?php echo $content_id; ?>";
	var content_type_id = "<?php echo $content_type_id; ?>";
	var page_Indexid    = "<?php echo $page_index_number; ?>";
	var section_id      = "<?php echo $section_id; ?>";
	//location.reload(true);
	var content_url     = "<?php echo urldecode($content_url); ?>";
	var page_param      = "<?php echo $content['page_param']; ?>";
	var content_from    = "<?php echo $content['content_from']; ?>";
	var section_structure    = "<?php echo $url_structure; ?>";
	$(document).ready(function(e){
		var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
		var title_height = $('.title-container').outerHeight();
		if(!isMobile){
			$('.SectionContainer > .row >.col-lg-4').css('margin-top',title_height -15);
		}
	});
</script>
<div class="recent_news">
<div id="topover" class="slide-open" style="visibility: hidden;">
  <p>O<br>
    P<br>
    E<br>
    N</p>
</div>
</div>
<script src="<?php echo static_url; ?>js/FrontEnd/js/remodal-article.js"></script>

<?php //echo "open me";exit;?>


