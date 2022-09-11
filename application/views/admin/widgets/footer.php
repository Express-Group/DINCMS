<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer1">
  <div class="col-lg-1 col-md-1 col-xs-12">
   <!-- <figure class="nie"><a href="#"><img src="<?php echo static_url; ?>images/FrontEnd/images/group.jpg" /></a></figure>-->
  </div>
  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
    <div class="news"><a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <h3 class="foot_head">NEWS LETTER</h3>
      <div class="newsbox">
        <form class="navbar-form news_form" id="newsletter_form" name="newsletter_form" role="search" action="<?php echo base_url(); ?>user/common_widget/subscribe_newsletter">
          <div class="input-group">
            <input type="text" class="form-control ntb"  placeholder="மின்னஞ்சல்" name="email_newsletter" id="email-newsletter" disabled>
            <div class="input-group-btn">
              <button class="btn btn-default btn-back" id="submit_newsletter" type="button" disabled><i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
        
      </div>
      <span id="news_error_throw"></span> 
    </div>
  </div>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <?php 
//$view_mode               = $content['mode'];
/*//$social_urls = $this->widget_model->select_setting($view_mode); 
$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';*/

$facebook_url		=	"https://www.facebook.com/DinamaniDaily";
$google_plus		=	"https://plus.google.com/116307064799770204456/";
$twitter_url		=	"https://twitter.com/DinamaniDaily";
$rss_url			=	"https://www.dinamani.com/rss/";
?>
    <div class="follow">
      <h3 class="foot_head">FOLLOW US</h3>
      <div class="footer_social"> <a class="fb" href="<?php echo $facebook_url;?>" rel="nofollow"><i class="fa fa-facebook"></i></a> <a class="twit" href="<?php echo $twitter_url;?>" rel="nofollow"><i class="fa fa-twitter"></i></a> <a class="instagram" href="https://www.instagram.com/dinamanidaily/" rel="nofollow"><i class="fa fa-instagram"></i></a> <a class="youtube" href="https://www.youtube.com/channel/UC3jcdpf8dWtljex9PyhSM6w" rel="nofollow"><i class="fa fa-youtube"></i></a><a class="rss" href="<?php echo $rss_url;?>"><i class="fa fa-rss"></i></a> </div>
    </div>
  </div>
</div>
<?php 
/*$widget_bg_color 		= $content['widget_bg_color'];
$widget_custom_title 	= $content['widget_title'];
$widget_instance_id 	= $content['widget_values']['data-widgetinstanceid'];
$main_sction_id 		= "";
$page_type 				= 'section';*/
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer2bac">
  <div class="footer2">
     <p>Copyright - dinamani.com <?php echo date('Y'); ?></p>
   <!-- <p> <a class="AllTopic" href="<?php echo base_url(); ?>"><?php echo "முகப்பு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Sports"; ?>"><?php echo "விளையாட்டு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Cinema"; ?>"><?php echo "சினிமா"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Junction"; ?>"><?php echo "ஜங்ஷன்"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."job"; ?>"><?php echo "வேலைவாய்ப்பு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Religion"; ?>"><?php echo "ஆன்மிகம்"; ?> </a></p>-->
   <p> <a class="AllTopic" href="http://www.newindianexpress.com/" rel="nofollow" target="_blank">The New Indian Express | </a> <a class="AllTopic" href="http://www.kannadaprabha.com" rel="nofollow" target="_blank">Kannada Prabha | </a>  <a class="AllTopic" href="http://www.samakalikamalayalam.com/" rel="nofollow" target="_blank">Samakalika Malayalam | </a><a class="AllTopic" href="http://www.indulgexpress.com" rel="nofollow" target="_blank">Indulgexpress  | </a>  <a class="AllTopic" href="http://www.edexlive.com" rel="nofollow" target="_blank">Edex Live  | </a> <a class="AllTopic" href="http://www.cinemaexpress.com" rel="nofollow" target="_blank">Cinema Express | </a> <a class="AllTopic" href="http://www.eventxpress.com" rel="nofollow" target="_blank">Event Xpress  </a></p>
    <p> <a class="AllTopic" href="<?php echo base_url()."Contact-Us"; ?>"><?php echo "Contact Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."About-Us"; ?>"><?php echo "About Us"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Privacy-Policy"; ?>"><?php echo "Privacy Policy"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Terms-of-Use"; ?>"><?php echo "Terms of Use"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Advertise-With-Us"; ?>"><?php echo "Advertise With Us"; ?> </a></p>
	
	<p> <a class="AllTopic" href="<?php echo base_url(); ?>"><?php echo "முகப்பு"; ?> | </a>  <a class="AllTopic" href="<?php echo base_url().'latest-news'; ?>">தற்போதைய செய்திகள் | </a> <a class="AllTopic" href="<?php echo base_url()."Sports"; ?>"><?php echo "விளையாட்டு"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."health"; ?>"><?php echo "மருத்துவம்"; ?> | </a> <a class="AllTopic" href="<?php echo base_url()."Cinema"; ?>"><?php echo "சினிமா"; ?> |  </a> <a class="AllTopic" href="<?php echo base_url()."lifestyle"; ?>"><?php echo "லைஃப்ஸ்டைல்"; ?> </a></p>
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
