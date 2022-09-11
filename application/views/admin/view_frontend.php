<?php
$css_path 		= static_url."css/FrontEnd/";
$js_path 		= static_url."js/FrontEnd/";
$images_path	= static_url."images/FrontEnd/";
$settings = $this->widget_model->select_setting($viewmode);
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
$MobileUrl = "https://m.dinamani.com/";
if(count($section_details) > 0){
$index            = ($section_details['Noindexed']=='1')? 'NOINDEX' : 'INDEX';
$follow           = ($section_details['Nofollow'] == '1') ? 'NOFOLLOW' : 'FOLLOW';
$Canonicalurl     = (strtolower($section_details['URLSectionStructure'])=='home')? $MobileUrl : $MobileUrl.$section_details['URLSectionStructure'];//($section_details['Canonicalurl']!='') ? $section_details['Canonicalurl'] : '';
$CanonicalurlOrginal     = (strtolower($section_details['URLSectionStructure'])=='home')? BASEURL : BASEURL.$section_details['URLSectionStructure'];
$meta_title       = $section_details['MetaTitle'];
$meta_description = $section_details['MetaDescription'];
$meta_keywords    = $section_details['MetaKeyword'];
$section_name     = $section_details['Sectionname'];
$section_img_path = ($section_details['BGImage_path']!='')? image_url.$section_details['BGImage_path']: '';
}else{
	$index            = "";
	$follow           = "";
	$Canonicalurl     = "";
	$meta_title       = "";
	$meta_description = "";
	$meta_keywords    = "";
	$section_name     = "";
	$section_img_path = "";
	$CanonicalurlOrginal="";
}

$page_variable = $this->input->get('per_page');
if($page_variable!='')
{
 if($this->uri->segment(1)!='topic'){
 $per_page = $settings['subsection_otherstories_count_perpage'];
 }else
 {
 $page_variable = $this->input->get('per_page');
 $per_page      = 15;
 }
 $page_variable = ($page_variable/$per_page)+1;
}

$background_image = ($section_img_path!='')? 'style="background:url('.$section_img_path.') left;"' : "";
?>
<?php
    //$ExpireTime = 600; // seconds (= 10 mins)
    $ExpireTime = 240; // seconds (= 4 mins)
	$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	$this->output->set_header("Cache-Control: cache, must-revalidate");
	$this->output->set_header("Cache-Control: max-age=".$ExpireTime);
	$this->output->set_header("Pragma: cache");
?>
<!DOCTYPE HTML>
<html lang="ta">
 <head>
 <meta name="google-site-verification" content="ybWmewWrrASLVdqZYucf1_qAG3vV2gpo-wJAAlSt4Ec" />
 <!--Bing verification-->

<meta name="msvalidate.01" content="73E7ECB1B4AC5960CE3CB0737FE92945" />
 <!--Bing verification-->
 <!--youtube verification-->
 <meta name="google-site-verification" content="hobc9QxGqSbp-IRmxtItisR3JwpJ2z6keutHDcMZC_s" />
 <!--youtube verification ends-->
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <?php if(strtolower($section_name)=="home" || strtolower($section_name)=="முகப்பு"){ ?>
	<meta http-equiv="Cache-control" content="max-age=360, public">  
  <?php }else{ ?>
	<meta http-equiv="Cache-control" content="max-age=480, public">  
  <?php } ?>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
 <!-- for-mobile-apps -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="title" content="<?php echo strip_tags($meta_title);?>" />
 <meta name="description" content="<?php echo $meta_description;?>">
 <meta name="keywords" content="<?php echo $meta_keywords;?>">
 <meta name="news_keywords" content="<?php echo $meta_keywords;?>">
 <meta name="msvalidate.01" content="E3846DEF0DE4D18E294A6521B2CEBBD2" />
 <link rel="canonical" href="<?php echo $CanonicalurlOrginal;?>" />
  <meta property="fb:pages" content="144731995537638" />
 <meta property="og:type" content="website" />
 <meta property="og:title" content="<?php echo strip_tags($meta_title);?>"/>
 <meta property="og:image" content="<?php echo $section_img_path;?>"/>
 <meta property="og:site_name" content="Dinamani"/>
 <meta property="og:description" content="<?php echo $meta_description;?>"/>
 <meta name="twitter:site" content="Dinamani" />
 <meta name="twitter:title" content="<?php echo strip_tags($meta_title);?>" />
 <meta name="twitter:description" content="<?php echo $meta_description;?>" />
 <meta name="twitter:image" content="<?php echo $section_img_path;?>" />
 <meta name="robots" content="<?php echo $index;?>, <?php echo $follow;?>">
 <!--<title><?php echo $section_name;?>- Dinamani<?php echo ($page_variable!='')? "- page".$page_variable: "";?></title>-->
 <title><?php echo strip_tags($meta_title); ?><?php echo ($page_variable!='')? "- page".$page_variable: "";?></title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ if (window.scrollY == 0) window.scrollTo(0,1); }; </script>
 <link rel="shortcut icon" href="<?php echo $images_path; ?>images/favicon.ico" type="image/x-icon" />
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/font-awesome.min.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/bootstrap.min.css" type="text/css">
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/style_latest.css?v=13.0" type="text/css" /> 
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/media.css?v=1.4" type="text/css">
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/custom_widget.css" type="text/css">
 <!--<link rel="stylesheet" href="<?php echo $css_path; ?>css/swiper.min.css" type="text/css">-->
 <!--<script src="<?php echo $js_path; ?>js/swiper.min.js" type="text/javascript"></script>-->
 <!--<script async src="//static.chartbeat.com/js/chartbeat_mab.js"></script>-->
 <script src="<?php echo $js_path; ?>js/jquery.js" type="text/javascript"></script>
 <!--<script src="<?php echo $js_path; ?>js/jquery.lazyloadxt.js"></script>-->
 <!--<script src="<?php echo $js_path; ?>js/jquery-ui.js"></script>-->
 <script src="<?php echo $js_path; ?>js/bootstrap.min.js" type="text/javascript"></script>


 <script src="<?php echo $js_path; ?>js/turn.min.js" type='text/javascript' ></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>css/slick.css?v=1.2"/>
 <script type="text/javascript" src="<?php echo $js_path; ?>js/slick.js"></script>
 <script type="text/javascript" src="<?php echo $js_path; ?>js/scripts.js"></script>
 <script src="<?php echo $js_path; ?>js/easyResponsiveTabs.js"></script>
 <script type="text/javascript">
 	  $(function () {	
	  <?php if(isset($html_header)&& $html_header==true){ 
	  $section_id = $section_details['Section_id'];
	  $parent_section_id = $section_details['ParentSectionID'];
	  $mode = $content['mode'];
	  ?>
	  $('.navbar-nav li').removeClass('active');
      if ($('#tab<?php echo $section_id;?>').length) {
	  $('#tab<?php echo $section_id;?>').addClass('active');
	  }else if ($('#tab<?php echo $parent_section_id;?>').length) {
	     $('#tab<?php echo $parent_section_id;?>').addClass('active');
	    }
	  $.ajax({
	  url			: '<?php echo base_url(); ?>user/commonwidget/get_breadcrumb',
	  method		: 'post',
	  dataType: 'html',
	  data : {section:'<?php echo $section_id;?>', mode: '<?php echo $mode;?>'},
	  success:function(response){
	  $("#bcrum_section").html(response);
	  }
	  });
	 
	 <?php } ?>
		$('.photo-single').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
		responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2
      }
    }
	]
      });
	 $('.slick-prev').addClass('fa fa-chevron-left');
     $('.slick-next').addClass('fa fa-chevron-right');
	 $('.bn-navi span').addClass('fa fa-chevron-left');
     $('.bn-navi span:last-child').addClass('fa fa-chevron-right');
	 $(".line").css("display", "block");	
    });
 </script>


<!-- Start Advertisement Script -->
<?php
if(SHOWADS):
	echo urldecode(@$header_ad_script);
	if(strtolower($section_name)=="home" || strtolower($section_name)=="முகப்பு"){
	echo rawurldecode(stripslashes($settings['home_header_script']));
	}else{
	echo rawurldecode(stripslashes($settings['section_header_script']));
	}
endif;
?>
<!-- End Advertisement Script -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-2311935-31"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-2311935-31');
</script>

<!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "16833363" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="https://sb.scorecardresearch.com/p?c1=2&c2=16833363&cv=2.0&cj=1" />
</noscript>
<!-- End comScore Tag -->
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "WebSite", 
  "name" : "Dinamani",
  "url" : "<?php echo BASEURL ?>",
  "potentialAction" : {
    "@type" : "SearchAction",
    "target" : "<?php echo BASEURL; ?>topic?term={search_term}&request=ALL&search=short",
    "query-input" : "required name=search_term"
  }                     
}
</script>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Organization",
  "name" : "Dinamani",
  "url" : "<?php echo BASEURL ?>",
  "sameAs" : [
    "https://www.facebook.com/DinamaniDaily",
    "https://twitter.com/DinamaniDaily",
	"https://en.wikipedia.org/wiki/Dinamani",
    "https://www.youtube.com/channel/UC3jcdpf8dWtljex9PyhSM6w"
  ]
}
</script>
<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '1969965129788704'); 
	fbq('track', 'PageView');
	</script>
	<noscript>
	<img height="1" width="1" 
	src="https://www.facebook.com/tr?id=1969965129788704&ev=PageView&noscript=1"/>
	</noscript>
<!-- End Facebook Pixel Code -->
<script type="text/javascript">
	window.GUMLET_CONFIG = {
		hosts: [{
			current: "images.dinamani.com",
			gumlet: "images.dinamani.com"
		}],
		lazy_load: true
	};
	(function(){d=document;s=d.createElement("script");s.src="https://cdn.gumlet.com/gumlet.js/2.0/gumlet.min.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>
 </head>
 <body>
<?php echo $header. $body. $footer; ?> 
<!--<script src="<?php echo $js_path; ?>js/slider-custom-lazy.min.js" type="text/javascript"></script> 
-->
<!--nav fixed--> 
<script type="text/javascript">
$('.top-fix ').affix({
      offset: {
        top: $('.top-fix').height()
      }
}); 
$(document).ready(function () {
$('#tabs_1 li').mouseover( function(){
    $(this).find('a').tab('show');
  });
  $('#tabs_1 li').mouseout( function(){
    $(this).find('a').tab('hide');
  });
  $('.article_click').click(function(){localStorage.setItem("callback_url", window.location);});
  });
</script> 

<!--nav fixed end-->
<?php if($this->uri->segment(1)=='dmcpan' || $this->uri->segment(1)=='topic' || $this->uri->segment(1)=='testing'){ ?>
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/datepicker.css" type="text/css">
<script src="<?php echo $js_path; ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
<?php } ?>

<script type="text/javascript">
 var base_url = "<?php echo base_url(); ?>";
 var css_url  = "<?php echo $css_path; ?>";
</script>
<script type="text/javascript" src="<?php echo $js_path; ?>js/custom.js?v=1.2"></script>
<?php if($this->uri->segment(1)!='topic'){ ?>
<!--<script type="text/javascript" src="<?php echo $js_path; ?>js/cinema-slide.js"></script>-->
<script type="text/javascript" src="<?php echo $js_path; ?>js/jssor.js"></script> 
<script type="text/javascript" src="<?php echo $js_path; ?>js/jssor.slider.js"></script>
<?php } ?>
<?php 
	if($viewmode != "" && $viewmode == "live")
	{
	?>

<?php	
	}
?>
<!--<script src="<?php echo $js_path; ?>js/postscribe.min.js"></script>-->
<?php if(SHOWADS): ?>
<script type="text/javascript">
	var xh = new XMLHttpRequest();
	xh.open("GET", "<?php echo BASEURL; ?>user/commonwidget/geo_country", true);
	xh.send();
	xh.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		var cu_cde = ['US','EU'];
		if(cu_cde.includes(this.responseText)){
			(function (){ var s,m,n,h,v,se,lk,lk1,bk; n=false; s= decodeURIComponent(document.cookie); m = s.split(';'); for(h=0;h<m.length;h++){ if(m[h]==' cookieagree=1'){n=true;break;}}if(n==false){v = document.createElement('div');v.setAttribute('style','position: fixed;left: 0px;right: 0px;height: auto;min-height: 15px;z-index: 2147483647;background: linear-gradient(255deg,#802727 0,#ec3f3f 100%);color: rgb(255, 255, 255);line-height: 15px;padding: 8px 18px;font-size: 14px;text-align: left;bottom: 0px;opacity: 1;');v.setAttribute('id','ckgre');se = document.createElement('span');se.setAttribute('style','padding: 5px 0 5px 0;float:left;');lk =document.createElement('button');lk.setAttribute('onclick','ckagree()');lk.setAttribute('style' , 'float: right;display: block;padding: 5px 8px;min-width: 100px;margin-left: 5px;border-radius: 25px;cursor: pointer;color: rgb(0, 0, 0);background: rgb(241, 214, 0);text-align: center;border: none;font-weight: bold;outline: none;');lk.appendChild(document.createTextNode("Agree"));	se.appendChild(document.createTextNode("We use cookies to enhance your experience. By continuing to visit our site you agree to our use of cookies."));lk1 = document.createElement('a');lk1.href=document.location.protocol+"//"+document.location.hostname+"/cookies-info";lk1.setAttribute('style','text-decoration: none;color: rgb(241, 214, 0);margin-left: 5px;');lk1.setAttribute('target','_BLANK');lk1.appendChild(document.createTextNode("More info"));se.appendChild(lk1);v.appendChild(se);v.appendChild(lk);bk = document.getElementsByTagName('body')[0];bk.insertBefore(v,bk.childNodes[0]);}})();function ckagree(){ document.cookie = "cookieagree=1;path=/";$('#ckgre').hide(1000, function(){ $(this).remove();});}
		}
    }
  };
    
</script>
<?php endif; ?>
<script>
</body>
</html>
