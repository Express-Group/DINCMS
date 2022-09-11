<?php
$css_path 		= static_url."css/FrontEnd/";
$js_path 		= static_url."js/FrontEnd/";
$images_path	= static_url."images/FrontEnd/";
//if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
if(count($section_details) > 0){
$index            = ($section_details['Noindexed']=='1')? 'NOINDEX' : 'INDEX';
$follow           = ($section_details['Nofollow'] == '1') ? 'NOFOLLOW' : 'FOLLOW';
$Canonicalurl     = (strtolower($section_details['URLSectionStructure'])=='home')? base_url() : base_url().$section_details['URLSectionStructure'];//($section_details['Canonicalurl']!='') ? $section_details['Canonicalurl'] : '';
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
}

$page_variable = $this->input->get('per_page');
if($page_variable!='')
{
 if($this->uri->segment(1)!='topic'){
 $settings = $this->widget_model->select_setting($viewmode);
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
    $ExpireTime = 600; // seconds (= 10 mins)
	$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	$this->output->set_header("Cache-Control: cache, must-revalidate");
	$this->output->set_header("Cache-Control: max-age=".$ExpireTime);
	$this->output->set_header("Pragma: cache");
?>
<!DOCTYPE HTML>
<html>
 <head>
 <link rel="alternate" href="<?php echo rtrim(current_url(), "/");?>" hreflang="ta"/>
 <meta name="google-site-verification" content="ybWmewWrrASLVdqZYucf1_qAG3vV2gpo-wJAAlSt4Ec" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <?php if(strtolower($section_name)=="home" || strtolower($section_name)=="முகப்பு"){ ?>
	<meta http-equiv="Cache-control" content="max-age=360, public">  
  <?php }else{ ?>
	<meta http-equiv="Cache-control" content="max-age=480, public">  
  <?php } ?>
 <!-- for-mobile-apps -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="title" content="<?php echo strip_tags($meta_title);?>" />
 <meta name="description" content="<?php echo $meta_description;?>">
 <meta name="keywords" content="<?php echo $meta_keywords;?>">
 <meta name="news_keywords" content="<?php echo $meta_keywords;?>">
 <meta name="msvalidate.01" content="E3846DEF0DE4D18E294A6521B2CEBBD2" />
 <link rel="canonical" href="<?php echo $Canonicalurl;?>" />
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
 <title><?php echo $section_name;?>- Dinamani<?php echo ($page_variable!='')? "- page".$page_variable: "";?></title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ if (window.scrollY == 0) window.scrollTo(0,1); }; </script>
 <link rel="shortcut icon" href="<?php echo $images_path; ?>images/favicon.ico" type="image/x-icon" />
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/font-awesome.min.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/bootstrap.min.css" type="text/css">
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/style.css" type="text/css" />
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/media.css" type="text/css">
 <script src="<?php echo $js_path; ?>js/jquery.js" type="text/javascript"></script>
 <script src="<?php echo $js_path; ?>js/jquery.lazyloadxt.js"></script>
 <script src="<?php echo $js_path; ?>js/jquery-ui.js"></script>
 <script src="<?php echo $js_path; ?>js/bootstrap.min.js" type="text/javascript"></script>


 <script src="<?php echo $js_path; ?>js/turn.min.js" type='text/javascript' ></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $css_path; ?>css/slick.css"/>
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
 <?php echo urldecode(@$header_ad_script); ?>
 <!-- End Advertisement Script -->
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
<?php if($this->uri->segment(1)=='dmcpan' || $this->uri->segment(1)=='topic'){ ?>
 <link rel="stylesheet" href="<?php echo $css_path; ?>css/datepicker.css" type="text/css">
<script src="<?php echo $js_path; ?>js/bootstrap-datepicker.js" type="text/javascript"></script>
<?php } ?>

<script type="text/javascript">
 var base_url = "<?php echo base_url(); ?>";
 var css_url  = "<?php echo $css_path; ?>";
</script>
<script type="text/javascript" src="<?php echo $js_path; ?>js/custom.js"></script>
<?php if($this->uri->segment(1)!='topic'){ ?>
<script type="text/javascript" src="<?php echo $js_path; ?>js/cinema-slide.js"></script> 
<script type="text/javascript" src="<?php echo $js_path; ?>js/jssor.js"></script> 
<script type="text/javascript" src="<?php echo $js_path; ?>js/jssor.slider.js"></script>
<?php } ?>
<?php 
	if($viewmode != "" && $viewmode == "live")
	{
	?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-2311935-31', 'auto');
ga('send', 'pageview');
</script>
<?php	
	}
?>
<script src="<?php echo $js_path; ?>js/postscribe.min.js"></script>
</html>