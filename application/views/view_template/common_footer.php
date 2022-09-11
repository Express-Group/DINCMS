<section class="section-footer">
<footer class="container FooterContainer">
	<div class="row"><div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12  "><div class="widget-container widget-container-457"><div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 trending-today17905">
		<div class="trending-daily">
		</div>
	</div>
</div>
<script>
$(document).ready(function(e){
	$.ajax({
		type:'get'
	});
	 $.get("https://www.dinamani.com/user/commonwidget/trending_tags", function(data, status){
		 $('.trending-daily').html(data);
	});
});
</script></div></div></div><div class="row"><div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12  "><div class="widget-container widget-container-327"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer1">
  <div class="col-lg-1 col-md-1 col-xs-12">
   <!-- <figure class="nie"><a href="#"><img src="https://images.dinamani.com/images/FrontEnd/images/group.jpg" /></a></figure>-->
  </div>
  <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
    <div class="news"><a href="javascript:void(0)" class="scrollToTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <h3 class="foot_head">NEWS LETTER</h3>
      <div class="newsbox">
        <form class="navbar-form news_form" id="newsletter_form" name="newsletter_form" role="search" action="https://www.dinamani.com/user/common_widget/subscribe_newsletter">
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
        <div class="follow">
      <h3 class="foot_head">FOLLOW US</h3>
      <div class="footer_social"> <a class="fb" href="https://www.facebook.com/DinamaniDaily" rel="nofollow"><i class="fa fa-facebook"></i></a> <a class="twit" href="https://twitter.com/DinamaniDaily" rel="nofollow"><i class="fa fa-twitter"></i></a> <a class="instagram" href="https://www.instagram.com/dinamanidaily/" rel="nofollow"><i class="fa fa-instagram"></i></a> <a class="youtube" href="https://www.youtube.com/channel/UC3jcdpf8dWtljex9PyhSM6w" rel="nofollow"><i class="fa fa-youtube"></i></a><a class="rss" href="https://www.dinamani.com/rss/"><i class="fa fa-rss"></i></a> </div>
    </div>
  </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer2bac">
  <div class="footer2">
     <p>Copyright - dinamani.com 2022</p>
   <!-- <p> <a class="AllTopic" href="https://www.dinamani.com/">முகப்பு | </a> <a class="AllTopic" href="https://www.dinamani.com/Sports">விளையாட்டு | </a> <a class="AllTopic" href="https://www.dinamani.com/Cinema">சினிமா | </a> <a class="AllTopic" href="https://www.dinamani.com/Junction">ஜங்ஷன் | </a> <a class="AllTopic" href="https://www.dinamani.com/job">வேலைவாய்ப்பு | </a> <a class="AllTopic" href="https://www.dinamani.com/Religion">ஆன்மிகம் </a></p>-->
   <p> <a class="AllTopic" href="http://www.newindianexpress.com/" rel="nofollow" target="_blank">The New Indian Express | </a> <a class="AllTopic" href="http://www.kannadaprabha.com" rel="nofollow" target="_blank">Kannada Prabha | </a>  <a class="AllTopic" href="http://www.samakalikamalayalam.com/" rel="nofollow" target="_blank">Samakalika Malayalam | </a><a class="AllTopic" href="http://www.indulgexpress.com" rel="nofollow" target="_blank">Indulgexpress  | </a>  <a class="AllTopic" href="http://www.edexlive.com" rel="nofollow" target="_blank">Edex Live  | </a> <a class="AllTopic" href="http://www.cinemaexpress.com" rel="nofollow" target="_blank">Cinema Express | </a> <a class="AllTopic" href="http://www.eventxpress.com" rel="nofollow" target="_blank">Event Xpress  </a></p>
    <p> <a class="AllTopic" href="https://www.dinamani.com/Contact-Us">Contact Us | </a> <a class="AllTopic" href="https://www.dinamani.com/About-Us">About Us | </a> <a class="AllTopic" href="https://www.dinamani.com/Privacy-Policy">Privacy Policy | </a> <a class="AllTopic" href="https://www.dinamani.com/Terms-of-Use">Terms of Use | </a> <a class="AllTopic" href="https://www.dinamani.com/Advertise-With-Us">Advertise With Us </a></p>
	
	<p> <a class="AllTopic" href="https://www.dinamani.com/">முகப்பு | </a>  <a class="AllTopic" href="https://www.dinamani.com/latest-news">தற்போதைய செய்திகள் | </a> <a class="AllTopic" href="https://www.dinamani.com/Sports">விளையாட்டு | </a> <a class="AllTopic" href="https://www.dinamani.com/health">மருத்துவம் | </a> <a class="AllTopic" href="https://www.dinamani.com/Cinema">சினிமா |  </a> <a class="AllTopic" href="https://www.dinamani.com/lifestyle">லைஃப்ஸ்டைல் </a></p>
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
</div></div></div></footer>
</section>