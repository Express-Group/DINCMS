<?php
$readwhereQStr ='';
if(count($_GET) > 0){
	$readwhereQStr ='?'.$this->input->server('QUERY_STRING');
}
$css_path 		= static_url."css/FrontEnd/";
$js_path 		= static_url."js/FrontEnd/";
$images_path	= static_url."images/FrontEnd/";
///if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
$content_id      = @$content['content_id'];
$content_from    = @$content['content_from'];
$content_type_id = @$content['content_type'];
$viewmode        = @$content['mode'];
$settings = $this->widget_model->select_setting($viewmode);
//$page_det = $this->widget_model->widget_article_content_by_id($content_id, $content_type_id);
$page_det        = $article_details;
$page_det        = $page_det[0];

$Image600X390    = "";
$Image600X390 	 = ($content_type_id==1)? $page_det['article_page_image_path']: (($content_type_id==3)? $page_det['first_image_path']: (($content_type_id==4)? $page_det['video_image_path']: $page_det['audio_image_path']));
if ($Image600X390 != '' && getimagesize(getimagesize . imagelibrary_image_path . $Image600X390))
	{
	$imagedetails = getimagesize(getimagesize . imagelibrary_image_path.$Image600X390);
	$imagewidth   = $imagedetails[0];
	$imageheight  = $imagedetails[1];
	
	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $Image600X390;
	}
	else
	{				
		$Image600X390 	= str_replace("original","w600X390", $Image600X390);
	}
	$image_path='';
		$image_path = image_url. imagelibrary_image_path . $Image600X390;
	}
else
{
	$image_path	= image_url. imagelibrary_image_path.'logo/dinamani_logo_600X390.jpg';
	$image_caption='';	
}

$content = strip_tags($page_det['summary_html']);
$current_url = explode('?', Current_url());
$share_url= base_url().$page_det['url'];//$current_url[0];
$index= ($page_det['no_indexed']==1)? 'NOINDEX' : 'INDEX';
$follow= ($page_det['no_follow'] == 1) ? 'NOFOLLOW' : 'FOLLOW';
$Canonicalurl= $share_url;//($page_det['canonical_url']!='') ? $page_det['canonical_url'] : '';
$meta_title = $page_det['meta_Title'];
$metadescription = $page_det['meta_description'];
$meta_description = (trim($metadescription)=='')? $content: $page_det['meta_description'];
//$meta_description = $page_det['meta_description'];
$tags = count($page_det['tags'])? $page_det['tags'] : '';

$query_string = ($_SERVER['QUERY_STRING']!='') ? "?".$_SERVER['QUERY_STRING'] : "";
$pubDate = date_format(date_create($page_det['publish_start_date']),"Y-m-dTH:i:s+05:30");
$LastUpDate = date_format(date_create($page_det['last_updated_on']),"Y-m-dTH:i:s+05:30");
?>
<?php
    $ExpireTime = ($content_from=="live") ? 600 : 86400; // seconds (= 10 mins)
	$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	$this->output->set_header("Cache-Control: cache, must-revalidate");
	$this->output->set_header("Cache-Control: max-age=".$ExpireTime);
	$this->output->set_header("Pragma: cache");
?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="alternate" href="<?php echo Current_url().$query_string;?>" hreflang="ta"/>
<meta name="google-site-verification" content="ybWmewWrrASLVdqZYucf1_qAG3vV2gpo-wJAAlSt4Ec" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="max-age=600, public">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="<?php echo strip_tags($meta_title);?>" />
<meta name="description" content="<?php echo $meta_description;?>">
<meta name="keywords" content="<?php echo ($seotags!='') ? $seotags : $tags; ?>">
<meta name="news_keywords" content="<?php echo ($seotags!='') ? $seotags : $tags; ?>">
<meta name="msvalidate.01" content="E3846DEF0DE4D18E294A6521B2CEBBD2" />
<link rel="canonical" href="<?php echo $Canonicalurl;?>" />
<meta name="robots" content="<?php echo $index;?>, <?php echo $follow;?>">
<meta property="og:url" content="<?php echo $share_url;?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php echo strip_tags($page_det['title']);?>"/>
<meta property="og:image" content="<?php echo $image_path;?>"/>
<meta property="og:image:width" content="450"/>
<meta property="og:image:height" content="298"/>
<meta property="og:site_name" content="Dinamani"/>
<meta property="og:description" content="<?php echo $content;?>"/>
<meta name="twitter:card" content="<?php echo $content;?>" />
<meta name="twitter:site" content="Dinamani" />
<meta name="twitter:title" content="<?php echo strip_tags($page_det['title']);?>" />
<meta name="twitter:description" content="<?php echo $content;?>" />
<meta name="twitter:image" content="<?php echo $image_path;?>" />
<title><?php echo strip_tags($meta_title);?>- Dinamani</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ if (window.scrollY == 0) window.scrollTo(0,1); }; </script>
<link rel="shortcut icon" href="<?php echo $images_path; ?>images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $css_path; ?>css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/style_latest.css?v=6.8" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/media.css" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/slick.css?v=1.1" type="text/css">
<script src="<?php echo $js_path; ?>js/jquery.js" type="text/javascript"></script>
<script src="<?php echo $js_path; ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $js_path; ?>js/jquery.lazyloadxt.js"></script>
<script type="text/javascript" src="<?php echo $js_path; ?>js/slick.js"></script>
<script type="text/javascript" src="<?php echo $js_path; ?>js/scripts.js"></script>
<script type="text/javascript" src="<?php echo $js_path; ?>js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
$(document).ready(function () {
<!--replace slick preview as arrow-->
$('.slick-prev').addClass('fa fa-chevron-left');
$('.slick-next').addClass('fa fa-chevron-right');
<?php if(isset($html_header)&& $html_header==true){ 
$section_id              = $page_det['section_id'];
$parent_section_id       = $page_det['parent_section_id'];
$grand_parent_section_id = $page_det['grant_section_id'];
?>
$('.navbar-nav li').removeClass('active');
if ($('#tab<?php echo $section_id;?>').length) {
$('#tab<?php echo $section_id;?>').addClass('active');
}else if ($('#tab<?php echo $parent_section_id;?>').length) {
$('#tab<?php echo $parent_section_id;?>').addClass('active');
}else{
$('#tab<?php echo $grand_parent_section_id;?>').addClass('active');
}
<?php } ?>	
});
</script>
<!-- Start Advertisement Script -->
<?php echo urldecode($header_ad_script); ?>
<?php echo urldecode(stripslashes($settings['article_header_script'])); ?>
<!-- End Advertisement Script -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-2311935-31"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-2311935-31');
</script>
<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "WebSite", 
  "name" : "Dinamani",
  "url" : "<?php echo BASEURL ?>",
  "potentialAction" : {
    "@type" : "SearchAction",
    "target" : "<?php echo BASEURL ?>?s={search_term}",
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
    "https://twitter.com/DINAMANI",
    "https://plus.google.com/116307064799770204456/"
  ]
}
</script>
<?php
$schematitle = strip_tags($page_det['title']);
mb_internal_encoding("UTF-8");
$schematitle = (count($schematitle) >= 110) ? $schematitle : mb_substr($schematitle , 0 , 107).'...';
?>
<script type="application/ld+json">
{
	"@context":"http:\/\/schema.org",
	"@type":"NewsArticle",
	"mainEntityOfPage":{
		"@type":"WebPage",
		"@id":"<?php echo $share_url ?>"
	},
	"headline":"<?php echo $schematitle; ?>",
	"description":"<?php echo strip_tags($page_det['summary_html']); ?>",
	<?php if($content_type_id==1): ?>
	"articleBody":"<?php echo htmlentities(strip_tags($page_det['article_page_content_html'])); ?>",
	<?php endif; ?>
	"articleSection" : "<?php echo $page_det['section_name'] ?>",
	<?php if($content_type_id==1): ?>
	"wordCount" : "<?php echo strlen(strip_tags($page_det['article_page_content_html'])); ?>",
	<?php endif; ?>
	"datePublished":"<?php echo $pubDate ?>",
	"dateModified":"<?php echo $LastUpDate ?>",
	"publisher":{
		"@type":"Organization",
		"name":"Dinamani",
		"logo":{
			"@type":"ImageObject",
			"url":"<?php echo image_url ?>images/FrontEnd/images/dmlogo1.jpg",
			"width":"268",
			"height":"108"
			}
	},
	"author":{
		"@type":"Person",
		"name":"<?php echo ($page_det['author_name']!='') ? $page_det['author_name'] : $page_det['agency_name']; ?>"
	},
	"image":{
		"@type":"ImageObject",
		"url":"<?php echo $image_path ?>",
		"width":"600",
		"height":"390"
	}
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
<script> window._izq = window._izq || []; window._izq.push(["init"]); </script>
<script src="https://cdn.izooto.com/scripts/e7f237858e2dad46b12f94ded1efbfba84726cdf.js"></script>
</head>
<?php
$content_url = $page_det['url'];

$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;

$sectionURL = ($get_seperation_count==1)? $url_array[0] : (($get_seperation_count==2)? $url_array[0]."/".$url_array[1] : $url_array[0]."/".$url_array[1]."/".$url_array[2]);
$section_url = base_url().$sectionURL."/";
/*if($content_from=="live"){
$section_url =  $section_url; 
}*/
?>
<body class="article_body" itemscope itemtype="<?php echo $section_url;?>">
<!--<div class="remodal-main-overlay"> </div>
<div class="CenterMargin CenterMarginBg"> </div>-->

<style>

.cssload-container-article img{
position: absolute;
    right:0;
    top: 0;
    width: 70px;
}
.cssload-container-article .cssload-zenith {
    height: 70px;
    width: 70px;
}
.cssload-container-article figure{ 
    left: 50%;
    position: fixed;
    top: 50%;
}
.modal-backdrop{
	opacity:0 !important;
	display:none;
}


.article_body header{position: unset;}
.article_body .main-menu{margin-left: 0;}
@media only screen and (max-width: 1550px) and (min-width: 1297px){ .main-menu { width: 950px !important; } }
@media only screen and (min-width: 1551px){ .main-menu { width: 1140px !important; } }
@media only screen and (max-width: 1296px) and (min-width: 1200px){ .main-menu { width: 1140px !important;} } 
@media only screen and (max-width: 1199px) and (min-width: 992px){ .main-menu { width: 949px !important; } }
.NextArticle{display:none !important;}
.PrintSocial{left: 16.5%;}
</style>
<div class="cssload-container cssload-container-article" id="load_spinner">
  <figure> <img src="<?php echo $images_path; ?>images/loader-Dn.png" />
    <div class="cssload-zenith"></div>
  </figure>
</div>
<!--<div class="container side-bar-overlay">
  <div class="left-trans"></div>
  <div class="right-trans"></div>
</div>-->
<?php //echo $header; ?>
<!--<div class="wait" id="load_spinner">
   <i class="wait-spinner wait-spin centerZone"></i>
  </div>-->
<!--<div class="remodal" data-remodal-id="article" data-remodal-options="hashTracking: false, closeOnOutsideClick: false" role="dialog"  id="openmodal" style="position:relative;"> <?php //echo  $header.$body .$footer; ?> </div>-->
<?php echo  $header.$body .$footer; ?>
<?php 
if(isset($_GET['pm'])!=0 && is_numeric($_GET['pm'])){
$section_details = $this->widget_model->get_section_by_id($_GET['pm']); //live db
$close_url       = (count($section_details)>0)? base_url().$section_details['URLSectionStructure']: "home";
}else{
$close_url ="home";
}

?>
<!--<script src="<?php echo $js_path; ?>js/remodal_custom.min.js" type="text/javascript"></script>
--> 
<script src="<?php echo $js_path; ?>js/jquery.csbuttons.js" type="text/javascript"></script> 
<script src="<?php echo $js_path; ?>js/remodal.js" type="text/javascript"></script>
<?php if($content_type_id==1){ ?>
<!--<script src="<?php //echo $js_path; ?>js/article-pagination.js" type="text/javascript"></script>-->
<?php } ?>
<?php if($content_type_id==1 || $content_type_id==3){ ?>
<script src="<?php echo $js_path; ?>js/jquery.twbsPagination.min.js" type="text/javascript"></script>
<?php } ?>
<script>
var close_url = "<?php echo $close_url;?>";
$( document ).ready(function() {
	 $('#load_spinner').hide();
/*$("html, body").animate({
	scrollTop: 0
});*/
//$('html').addClass('loading_time');
/* var inst = $('[data-remodal-id=article]').remodal();
inst.open(); */
 //$('[data-remodal-id=article]').remodal();

/* $(document).on('opened', '.remodal', function () {
  console.log('Modal is opened');
   $('.SectionContainer').append('<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>');
 $('.CenterMarginBg').hide();
  $('#load_spinner').hide();
  $('.side-bar-overlay').show();
   $('.menu').affix({
	offset: {
	top: $('header').height()
	}
	});	
	$('.remodal-close').affix({
	offset: {
	top: $('header').height()
	}
	});
}); */

   $(document).on('closed', '.remodal', function () {	
	<?php /*?><?php if($close_url =='home'){ ?>
	window.location.href = '<?php echo base_url();?>';
    <?php } else {	?>
	window.location.href = '<?php echo $close_url;?>';
	 <?php }?><?php */?>

	 var bck = localStorage.getItem("callback_section");
	 if(bck =='null'||bck ==null)
	   {
		window.location.href ="http://www.dinamani.com/";
	   }
	 else
	   {
	 window.location.href = localStorage.getItem("callback_section");
	   }
//	 window.location.href = (localStorage.getItem("callback_url")!="null")? localStorage.getItem("callback_url"): window.location.origin;
   });

/* $('.remodal-main-overlay:not(.container)').click(function(){
inst.close();
}); */
  $('.LeftArrow').click(function(){
  //inst.close();
  $('#load_spinner').show();
 });
  $('.RightArrow').click(function(){
  //inst.close();
  $('#load_spinner').show();
 });
});
</script> 
<?php 
	if($viewmode == "live")
	{
	?>

<?php	
	}
?>
<script src="<?php echo $js_path; ?>js/postscribe.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $('#storyContent').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("#storyContent").on("contextmenu",function(e){
        return false;
    });
});
</script>

<!-- Javascript tag  -->
<!-- begin ZEDO for channel:  slider1 , publisher: default , Ad Dimension: Slider 1x1 - 1 x 1 -->
<script language="JavaScript">
var zflag_nid="791"; var zflag_cid="1330"; var zflag_sid="0"; var zflag_width="1"; var zflag_height="1"; var zflag_sz="94"; 
</script>
<script language="JavaScript" src="https://tt3.zedo.com/jsc/tt3/fo.js"></script>
<!-- end ZEDO for channel:  slider1 , publisher: default , Ad Dimension: Slider 1x1 - 1 x 1 -->

<!-- Javascript tag  -->
<!-- begin ZEDO for channel:  slider2 , publisher: default , Ad Dimension: Slider 1x1 - 1 x 1 -->
<script language="JavaScript">
var zflag_nid="791"; var zflag_cid="1331"; var zflag_sid="0"; var zflag_width="1"; var zflag_height="1"; var zflag_sz="94"; 
</script>
<script language="JavaScript" src="https://tt3.zedo.com/jsc/tt3/fo.js"></script>
<!-- end ZEDO for channel:  slider2 , publisher: default , Ad Dimension: Slider 1x1 - 1 x 1 -->

</body>
</html>
