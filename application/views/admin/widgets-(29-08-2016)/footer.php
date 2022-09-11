<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer1">
  <div class="col-lg-1 col-md-1 col-xs-12">
    <figure class="nie"><a href="#"><img src="<?php echo base_url(); ?>images/FrontEnd/images/group.jpg" /></a></figure>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
    <div class="news"><a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <h3 class="foot_head">NEWS LETTER</h3>
      <div class="newsbox">
        <form class="navbar-form news_form" id="newsletter_form" name="newsletter_form" role="search" action="<?php echo base_url(); ?>user/common_widget/subscribe_newsletter">
          <div class="input-group">
            <input type="text" class="form-control ntb"  placeholder="மின்னஞ்சல்" name="email_newsletter" id="email-newsletter">
            <div class="input-group-btn">
              <button class="btn btn-default btn-back" id="submit_newsletter" type="button"><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
        
      </div>
      <span id="news_error_throw"></span> 
    </div>
  </div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <?php 
$view_mode               = $content['mode'];
$social_urls = $this->widget_model->select_setting($view_mode); 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';
?>
    <div class="follow">
      <h3 class="foot_head">FOLLOW US</h3>
      <div class="footer_social"> <a class="fb" href="<?php echo $social_urls['facebook_url'];?>"><i class="fa fa-facebook"></i></a> <a class="google" href="<?php echo $social_urls['google_plus_url'];?>"><i class="fa fa-google-plus"></i></a> <a class="twit" href="<?php echo $social_urls['twitter_url'];?>"><i class="fa fa-twitter"></i></a> <a class="rss" href="<?php echo $social_urls['rss_url'];?>"><i class="fa fa-rss"></i></a> </div>
    </div>
  </div>
</div>
<?php 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer2bac">
  <div class="footer2">
    <p>Copyright - Express Network Pvt Ltd - 2016</p>
   <!-- <p> <a class="AllTopic" href="<?php echo base_url(); ?>"><?php echo "முகப்பு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Sports"; ?>"><?php echo "விளையாட்டு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Cinema"; ?>"><?php echo "சினிமா"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Junction"; ?>"><?php echo "ஜங்ஷன்"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."job"; ?>"><?php echo "வேலைவாய்ப்பு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Religion"; ?>"><?php echo "ஆன்மிகம்"; ?> </a></p>-->
    <p> <a class="AllTopic" href="<?php echo base_url()."Contact-Us"; ?>"><?php echo "Contact Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."About-Us"; ?>"><?php echo "About Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Privacy-Policy"; ?>"><?php echo "Privacy Policy"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Terms-of-Use"; ?>"><?php echo "Terms of Use"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Advertise-With-Us"; ?>"><?php echo "Advertise With Us"; ?> </a></p>
  </div>
</div>
<script>
var $ = $.noConflict();
$(document).ready(function( $ ){
    scrollToTop.init( );
});
var scrollToTop =
{
    init: function(  ){
        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });
        // Click event to scroll to top
        $('.scrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},800);
            return false;
        });
    }
};
</script>