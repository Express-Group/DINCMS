<style>
.top-gap{float:left;width: 100%;}
.loc{width: 100%; margin-left: 0; margin-top: 0px;}
.loc .date{text-align: center;}
.social_icons{float: left;width: 100%;text-align: center;margin-top: 0px;}
.social_icons span , .social_icons a{float: none;display: inline-table;}
.part-logo{float: right;margin-top: 10px;width: 73%;text-align: center;}
.part-logo img{width: 63px;float: unset;}
.search1 .navbar-form{margin: 0;}
.loc .date span{display: block;margin-bottom: 12px;font-size: 14px;}
.social_icons .ap{background-color: #999;padding: 8px 10px 3px;}
.social_icons .ad{background-color: #a4c639;padding: 8px 10px 3px;}
.social_icons .ex{background-color: #f9905d;padding: 8px 8px 3px;}
.main_logo img {width:100%;}
@media only screen and (min-width: 1551px){
	.part-logo{
		width: 59%;
	}
	.part-logo img{
		width: 92px;
	}
	.loc .date span{
		margin-bottom: 15px;
		font-size: 15px;
	}
}

</style>
<div class="row logo-mobile">
<div class="MobileInput">  
<form class="" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="mobileSearchForm" method="get" role="form">
<input type="text" placeholder="தேடல்" name="search_term" id="mobile_srch_term" value="<?php echo @$_GET['search_term'];?>"/> <a href="javascript:void(0);" id="mobile_search"><img data-src="<?php echo static_url; ?>images/FrontEnd/images/lazy.png" src="<?php echo static_url; ?>images/FrontEnd/images/search-mob.png" /></a></form>

</div>

<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$is_home            = $content['is_home_page'];
$view_mode          = $content['mode'];
$header_details = $this->widget_model->select_setting($view_mode);
?> 
    
<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6">
    <div class="logo_pad ">
    <div class="main_logo">
      <?php 
echo '<a href="'.base_url().'">
<img src="'.image_url.'images/FrontEnd/images/lazy_logo.png" data-src="'.image_url.'images/FrontEnd/images/site_logo.webp" alt="logo"></a>';
echo '<p id="mobile_date">'.date('d')." <span>".$month_in_tamil."</span> ".date('Y').'</p>';
?></div>
    </div>
</div>
<div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 brand-logo">
    <div class="top-gap margin-top-10">
        <div class="loc" id="current_time1">
          <p class="date font-arial">
				<?php 
				$day = date('l');
				switch ($day) {
					case "Monday":
						$day_in_tamil = "திங்கள்கிழமை";
						break;
					case "Tuesday":
						$day_in_tamil = "செவ்வாய்க்கிழமை";
						break;
					case "Wednesday":
						$day_in_tamil = "புதன்கிழமை";
						break;
					case "Thursday":
						$day_in_tamil = "வியாழக்கிழமை";
						break;
					case "Friday":
						$day_in_tamil = "வெள்ளிக்கிழமை";
						break;
					case "Saturday":
						$day_in_tamil = "சனிக்கிழமை";
						break;
					default:
						$day_in_tamil = "ஞாயிற்றுக்கிழமை";
				}
				$month = date('F');
				$month_in_tamil = tamil_month($month);
            //echo date('h:i A ').'- IST'.', </br>'.$day_in_tamil.' </br>'.str_replace(date('F'), $month_in_tamil, date(' d  F Y '));
	//echo date('h:i:s A ').' &nbsp;&nbsp;'.'<span>'.$day_in_tamil.'</span>'.' &nbsp;&nbsp;'.date('d')." <span>".$month_in_tamil."</span> ".date('Y');

				echo '<span>&nbsp;&nbsp; '.date('d').' '.$month_in_tamil.' '.date('Y').'</span><span> '.$day_in_tamil.' '.date('h:i:s A ').' </span>';
			    ?>
                </p>
          
      </div>
    </div>
	<div class="social_icons SocialCenter">
			
			<a class="ex" href="https://chrome.google.com/webstore/detail/dinamani/bmfjebccakihjjjjogecichpabmjieak" rel="nofollow" target="_blank"><i class="fa fa-newspaper-o"></i></a> 
			<!--<a class="ad" href="https://play.google.com/store/apps/details?id=com.dinamani.news&hl=en" rel="nofollow" target="_blank"><i class="fa fa fa-android"></i></a> -->
			<a class="ap" href="https://www.instagram.com/dinamanidaily/" rel="nofollow" target="_blank"><i class="fa fa-instagram"></i></a> 
			<a class="fb" href="<?php echo $header_details['facebook_url'];?>" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a> 
			<a class="twit" href="<?php echo $header_details['twitter_url'];?>" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a> 
			<a class="rss" href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></a> </div>
</div>
<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6">
	<?php if($this->uri->segment(1)=='specialpage') :?>
	<style>
	.part-logo img{width: 160px;}
	</style>
	<figure class="part-logo"><img src="<?php echo static_url; ?>special_page/ucbrowser.png" /></figure>
	<?php else: ?>
	<figure class="part-logo"><img alt="group_logo" src="<?php echo static_url; ?>images/FrontEnd/images/group_lazy.png" data-src="<?php echo static_url; ?>images/FrontEnd/images/group.webp" /></figure>
	<?php endif; ?>
<ul class="MobileNav">
                   
                   <li class="MobileSearch"><a class="SearchHide" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                   <li class="MobileShare dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><i class="fa fa-share-alt" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i></span></a><ul class="dropdown-menu">
          <li><a href="<?php echo $header_details['facebook_url'];?>" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo $header_details['twitter_url'];?>" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li><a href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></i></a></li>
          <li><a href="https://chrome.google.com/webstore/detail/dinamani/bmfjebccakihjjjjogecichpabmjieak" target="_blank"><i class="fa fa-newspaper-o"></i></i></a></li>
          
        </ul></li>
                  </ul>
<div class="large-screen-search">
                   <div class="search1">
          <form class="navbar-form formb hide-search-custom" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="SimpleSearchForm" method="get" role="form">
            <div class="input-group">
              <input type="text" class="form-control tbox" placeholder="தேடல்" name="search_term" id="srch-term" value="<?php echo @$_GET['search_term'];?>">
              <div class="input-group-btn">
                <input type="hidden" class="form-control tbox"  name="home_search" value="H" id="home_search">
                <button class="btn btn-default btn-bac" id="search-submit" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
			<label id="error_throw"></label>
          </form>
		  
			<script type="text/javascript">
			$(document).ready(function() {
				$('#SimpleSearchForm').submit(function(e){
					e.preventDefault();
					if($('#srch-term').val().trim()==''){
						$('#error_throw').html('Please provide search keyword(s)').addClass('error');
						$('#srch-term').addClass('error');
					}else{
						$('#error_throw').html('').removeClass('error');
						$('#srch-term').removeClass('error');
						window.location.href=base_url+'topic?term='+$('#srch-term').val()+'&request=ALL&search=short';
					}
					
					
				});
				$('#mobileSearchForm').submit(function(e){
					e.preventDefault();
					if($('#mobile_srch_term').val().trim()==''){
						$('#mobile_srch_term').addClass('error');
					}else{
						$('#mobile_srch_term').removeClass('error');
						window.location.href=base_url+'topic?term='+$('#mobile_srch_term').val()+'&request=ALL&search=short'; 
					}
					
					
				});
			});
		</script>
		 
          
        </div>
                   
        </div>
      </div>
</div>