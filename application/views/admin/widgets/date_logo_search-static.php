<div class="row">
<div class="MobileInput">  <form class="" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="mobileSearchForm" method="get" role="form">
<input type="text" placeholder="தேடல்" name="search_term" id="mobile_srch_term" value="<?php echo @$_GET['search_term'];?>"/> <a href="javascript:void(0);" id="mobile_search"><img src="<?php echo image_url; ?>static/search-mob.png" /></a></form></div>

<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
$is_home            = $content['is_home_page'];
$view_mode          = $content['mode'];
$header_details = $this->widget_model->select_setting($view_mode);
?>
    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 brand-logo">
    <div class="top-gap margin-top-10">
      <figure class="part-logo"><img src="<?php echo image_url; ?>static/group.jpg" /></figure>
        <div class="loc" id="current_time">
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
	echo date('h:i:s A ').'- IST'.' </br>'.'<span>'.$day_in_tamil.'</span>'.' </br>'.date('d')." <span>".$month_in_tamil."</span> ".date('Y');
			    ?>
                </p>
          
      </div>
    </div>
    </div>
<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6">
    <div class="logo_pad ">
    <div class="main_logo">
      <a href="<?php echo base_url()?>"><img src="<?php echo image_url."/static/dm-logo1.jpg"?>" /></a> 

<?php echo '<p id="mobile_date">'.date('d')." <span>".$month_in_tamil."</span> ".date('Y').'</p>';
?></div>
    </div>
  </div>
<div class=" col-lg-4 col-md-4 col-sm-6 col-xs-6">
<ul class="MobileNav">
                   
                   <li class="MobileSearch"><a class="SearchHide" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                   <li class="MobileShare dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span><i class="fa fa-share-alt" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i></span></a><ul class="dropdown-menu">
          <li><a href="<?php echo $header_details['facebook_url'];?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="<?php echo $header_details['google_plus_url'];?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
          <li><a href="<?php echo $header_details['twitter_url'];?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
          <li><a href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></i></a></li>
          
        </ul></li>
                  </ul>
<div class="large-screen-search">
                   <div class="search1">
          <form class="navbar-form formb" action="<?php echo base_url(); ?>topic"  name="SimpleSearchForm" id="SimpleSearchForm" method="get" role="form">
            <div class="input-group">
              <input type="text" class="form-control tbox" placeholder="தேடல்" name="search_term" id="srch-term" value="<?php echo @$_GET['search_term'];?>">
              <div class="input-group-btn">
                <input type="hidden" class="form-control tbox"  name="home_search" value="H" id="home_search">
                <button class="btn btn-default btn-bac" id="search-submit" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
          <label id="error_throw"></label>
        </div>
                   <div class="social_icons SocialCenter"><span> <a class="android" href="https://play.google.com/store/apps/details?id=com.dinamani.news&hl=en" target="_blank"><i class="fa fa-android" aria-hidden="true"></i></a> <a class="apple" href="https://itunes.apple.com/in/app/dinamani-news-official/id986248960?mt=8" target="_blank" ><i class="fa fa-apple" aria-hidden="true"></i></a></span> <a class="fb" href="<?php echo $header_details['facebook_url'];?>" target="_blank"><i class="fa fa-facebook"></i></a> <a class="google" href="<?php echo $header_details['google_plus_url'];?>" target="_blank"><i class="fa fa-google-plus"></i></a> <a class="twit" href="<?php echo $header_details['twitter_url'];?>" target="_blank"><i class="fa fa-twitter"></i></a> <a class="rss" href="<?php echo $header_details['rss_url'];?>" target="_blank"><i class="fa fa-rss"></i></a> </div>
        </div>
      </div>
</div>