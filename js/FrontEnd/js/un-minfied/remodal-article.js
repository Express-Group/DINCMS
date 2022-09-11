$(function() {
	
	$(window).scroll(function(){
	/* when reaching the element with id "keywordline" we want to show the slidebox. Let's get the distance from the top to the element */
	var distanceTop = $('#keywordline').offset().top - $(window).height();
	if ($(window).scrollTop() > distanceTop)
	{
	if (document.getElementById('topover').style.display != 'block')
	{	$('#slidebox').animate({'left':'0px'},800);
	}
	else
	{
	document.getElementById('topover').style.visibility = 'visible';
	}
	}	else {
	document.getElementById('topover').style.visibility = 'hidden';
	$('#slidebox').stop(true).animate({'left':'-530px'},700);	}
	});
	$(document).on('click', '#slidebox .slide-close', function()
   {   //$('#slidebox .slide-close').click(function(){
	$('#slidebox').stop(true).animate({'left':'-530px'},10);	document.getElementById('topover').style.display = 'block';
	document.getElementById('topover').style.visibility = 'visible';
	document.getElementById('topover').onclick = function()
	{
	document.getElementById('topover').style.display = 'none';
	$('#slidebox').animate({'left':'0px'},800);
	}
	});
   

if(content_type_id==1){	
	 /************************************* Article Type Start *******************************************/
	$('.AticleImg').click(function () {
    $(".AticleImg").toggleClass('open_image');
	ga('send', {
	  hitType: 'pageview',
	  page: location.pathname
	});
	});
			
    $('#incfont').click(function() {
        $('.ArticleDetailContent p').css("font-size", function() {
   var curSize = parseInt($(this).css('font-size')) + 1 ;
   if(curSize<=25){
            return curSize;
   }
   else{ return $(this).css('font-size','25px'); }
        });
    });
  $('#decfont').click(function() {
        $('.ArticleDetailContent p').css("font-size", function() {
            var curSize = parseInt($(this).css('font-size')) - 1 ;
   if(curSize>=12){
            return curSize;
   }
   else{ return $(this).css('font-size','12px'); }
        });
    });
 $('#resetMe').click(function(){
  $('.ArticleDetailContent p').css('font-size','14px');
 });
 $('#print_article').click(function(){
	 printDiv('.printthis');
 });
 //$("iframe").width('100%');
 //$("table").width('100%');
              /************************************* Article Type End *******************************************/
}
else if(content_type_id==3){
             /***************************************** Gallery Type Start **************************************/
  var gallery_url = content_url.split('.html');
localStorage.setItem("galleryurl", gallery_url[0]);
//localStorage.removeItem("galleryurl");
console.log(localStorage.getItem("galleryurl"));
var parseGalleryurl = localStorage.getItem("galleryurl");
$('.slick-next').click(function(){
var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
console.log(currentSlide);
var index = currentSlide+1;
$('#gallery_pagination').twbsPagination("show", currentSlide+1);
if(content_from=="live"){
	window.history.pushState('', '', parseGalleryurl+'--'+index+'.html');
	hit_page_views();
	}
});
$('.slick-prev').click(function(){
var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
console.log(currentSlide);
if(currentSlide==0){
$('#gallery_pagination').twbsPagination("show", currentSlide+1);
}else{
$('#gallery_pagination').twbsPagination("show", currentSlide+1);
}
var index = currentSlide+1;
if(content_from=="live"){
window.history.pushState('', '', parseGalleryurl+'--'+index+'.html');
hit_page_views();
}
});
var clicked = false;
$("#auto-play").click(function(){
$('html, body').animate({scrollTop:$('#content_head').offset().top-20}, 'slow');
if (clicked) {
$(this).find('i').attr("title", "ஓட விடு");
$(this).find('i').toggleClass('fa-play fa-pause');
$('.GalleryDetailSlide').slick('slickPause');
$('.GalleryDetailSlide').unbind('beforeChange');
clicked = false;
}
else {
$(this).find('i').attr("title", "நிறுத்து");
$(this).find('i').toggleClass('fa-play fa-pause');
$('.GalleryDetailSlide').slick('slickPlay', true);
$('.GalleryDetailSlide').on('beforeChange', function(event, slick, currentSlide, nextSlide){
console.log(nextSlide+1);
$('#gallery_pagination').twbsPagination("show", nextSlide+1);
var index = nextSlide+1;
if(content_from=="live"){
window.history.pushState('', '', parseGalleryurl+'--'+index+'.html');
hit_page_views();
}
});
clicked = true;
}
});
$('.GalleryDetailSlide').on('swipe', function(event, slick, direction){
console.log(direction);
console.log(slick);
if(direction=='left'){
var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
console.log(currentSlide);
$('#gallery_pagination').twbsPagination("show", currentSlide+1); 
}else if(direction=='right'){
var currentSlide = $('.GalleryDetailSlide').slick('slickCurrentSlide');
console.log(currentSlide);
if(currentSlide==0){
$('#gallery_pagination').twbsPagination("show", currentSlide+1);
}else{
$('#gallery_pagination').twbsPagination("show", currentSlide+1);
} 
}
var index = currentSlide+1;
if(content_from=="live"){
window.history.pushState('', '', parseGalleryurl+'--'+index+'.html');
hit_page_views();
}
});	
 $('#gallery_pagination').twbsPagination({
        totalPages: TotalIndex,
		startPage: parseInt(currentimageIndex),
        visiblePages: 5,
		initiateStartPageClick: false,
		loop: true,
        onPageClick: function (event, page) {
          $('.GalleryDetailSlide').slick('slickGoTo', page-1);
				  if(content_from=="live"){
				  window.history.pushState('', '', parseGalleryurl+'--'+page+'.html');
			   hit_page_views();
             }
        }
    });	
                            /************************ Gallery Type End ********************/
}
							/************* Common Script All content type *******************/
     date_time('current_time');
   
    setTimeout(function(){ update_hits(); }, 3000);   //call recent article after 3 seconds
  
    $("[data-toggle=popover]").popover({
	 html: true, 
	 content: function() {
			  return $('.popover-content').html();
			}
	});
	
	$('#popoverId').popover({
	 html: true, 
	 title: 'Share via Email',
	 content: function() {
			  return $('.popover-content').html();
			}
	});
	$('#popoverId').click(function (e) {
	e.stopPropagation();
	});
	$(document).click(function (e) {
	if (($('.popover').has(e.target).length == 0) || $(e.target).is('.close')) {
	$('#popoverId').popover('hide');
	}
	});
	  $("#search-submit").click(function() {
		 var term = $('#srch-term').val();
		// var re = /^[ A-Za-z0-9_@.,#&+-:;'"/]*$/;
		if (term.trim().length==0) {
		$("#srch-term").addClass("error");
		$("#error_throw").addClass("error").text("தேடும் சொல்லை சொற்களை உள்ளிடவும்").show();
		return false;
		}
		/*else if(!re.test(term))
		{
		$("#srch-term").addClass("error");
		$("#error_throw").addClass("error").text("Please enter alphanumeric search keyword(s)").show();
		return false;
		}*/
		else {
		if(term.trim().length > 200)
		{
		$("#srch-term").addClass("error");
		$("#error_throw").text("200 க்கும் மேற்பட்ட எழுத்துக்கள் உள்ளிட முடியாது!").show();
		return false;
		}
			return true; 
		}
    }); 
$("#srch-term").keyup(function() {
        $("#error_throw").text(""), $("#srch-term").removeClass("error"), $("#error_throw").removeClass("error");
    });

	  $("#mobile_search").click(function() {
	 var term = $('#mobile_srch_term').val();
    // var re = /^[ A-Za-z0-9_@.,#&+-:;'"/]*$/;
	if (term.trim().length==0) {
		$("#mobile_srch_term").addClass("error");
		alert("தேடும் சொல்லை சொற்களை உள்ளிடவும்");
		return false;
		}
		/*else if(!re.test(term))
		{
		$("#srch-term").addClass("error");
		$("#error_throw").addClass("error").text("Please enter alphanumeric search keyword(s)").show();
		return false;
		}*/
		else {
		if(term.trim().length > 200)
		{
		$("#mobile_srch_term").addClass("error");
		alert("200 க்கும் மேற்பட்ட எழுத்துக்கள் உள்ளிட முடியாது!");
		return false;
		}
			$( "#mobileSearchForm" ).submit();
		}
});

      $(".MobileSearch .SearchHide").click(function(){
	  $(".MobileInput").toggle();
	  $(".SearchHide").toggleClass("SearchFade")
	 });
	   
$('#comment_form').submit(function(event) {
	var error_free=true;
	var name = $('input[name=name]').val();
	var email = $('input[name=email]').val();
	var comment = $('textarea#article_comment').val();
	if(name==''){
	$('input[name=name]').addClass('error');
    $('#comment_validate').text('உங்கள் பெயரை உள்ளிடவும்');
	}else if(email=='')
	{
	$('input[name=email]').addClass('error');
	$('#comment_validate').text('உங்கள் மின்னஞ்சல் முகவரியை உள்ளிடவும்');
	}
	else if(email!='')
	{
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var is_email=re.test(email);
	if(!is_email){
	$('input[name=email]').addClass('error');
	$('#comment_validate').text('சரியான மின்னஞ்சல் முகவரியை உள்ளிடவும்');
	}else if(comment==''){
	$('#article_comment').addClass('error');
	$('#comment_validate').text('தயவு செய்து உங்கள் கருத்துக்களை உள்ளிடவும்');
	}
	else{
	 var url = base_url+'user/commonwidget/post_comment';
	 var formData = {
            'name'              : $('input[name=name]').val(),
            'email'             : $('input[name=email]').val(),
            'comment'           : $('textarea#article_comment').val(),
			'content_id'        : $('input[name=content_id]').val(),
			'section_id'        : $('input[name=section_id]').val(),
			'comment_id'        : $('input[name=comment_id]').val(),
			'content_type_id'   : $('input[name=content_type_id]').val(),
			'article_title'     : $('#content_head').text(),
        };
	     $.ajax({
			url			: url,
			method		: 'post',
			data		: formData,
			beforeSend	: function() {				
				 $('#comment_validate').wrapInner('<img style="width:15px"  src="'+base_url+'images/FrontEnd/images/ajax-loader.gif" >');
			},
			success		: function(result){ 
			console.log(result);
				   $('.CloseReply').hide();
				   $('#comment_validate').css('color', 'green').text('உங்கள் கருத்து வெற்றிகரமாக சேர்க்கப்பட்டது ... ஒப்புதலுக்காக காத்திருக்கிறது');
				   $('.comment_head').after($('.CommentForm'));
				   setTimeout(function(){ 
				   $('#comment_validate').text('').css('color', 'red');
				   }, 5000);
				    $('form[name="comment_form"]')[0].reset();							
				   }			
		});
	}
	}
		event.preventDefault();
	 });
	 $("textarea,input").keyup(function(){
        $("input,textarea").removeClass("error");
		$('#comment_validate').text('');
    });
	
    //var live_url = content_url;
	var live_url = window.location.href.split('?')[0];
	$('.csbuttons').cSButtons({total : "#total","url" 	: live_url,});
	
	
	$('.section-content').append($('.NextArticle'));
	$('.NextArticle').show();
    $('.section-content').append($('.Social_Fonts'));
	$('.Social_Fonts').show();
	
    //$('.remodal .SectionContainer').append('<a href="javascript:;" class="remodal-close Close_Openmodal"></a>');
   
	$('.reply').click(function(){
		//$(this).closest('.ArticlePosts').after($('.CommentForm'));
		$(this).closest('li').after($('.CommentForm'));
		$('.CommentForm').addClass('ReplyForm');
		$('#comment_id').val($(this).attr('data-comment-id'));
		$('.CloseReply').show();
	});
  $('.CloseReply').click(function(){
	   $('.comment_head').after($('.CommentForm'));
	   $('.CommentForm').removeClass('ReplyForm');
	   $('#comment_id').val('');
	   $('.CloseReply').hide();
  });
  $('img[data-src]').lazyLoadXT();
  
  	 $("#submit_newsletter").click(function() {
		 subscribe_newsletter();
	 });
	 $('#newsletter_form').submit(function(e){
		 subscribe_newsletter();
		e.preventDefault(); // Prevent the original submit
	});
	function subscribe_newsletter()
	 {
	  x = document.newsletter_form, email_address = x.email_newsletter.value;
	 if(email_address.trim().length){
	   var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var is_email=re.test(email_address);
	if(is_email){
	  		var formData = {
			'email_newsletter'   : $('[name=email_newsletter]').val(),
        };
		$.ajax({
			url			: base_url+'user/commonwidget/subscribe_newsletter',
			method		: 'post',
			data		: formData,
			beforeSend	: function() {				
			},
			success		: function(result){
			$("#news_error_throw").text(result); $("#news_error_throw").css({"color":"green","float": "left", "width":"233px"});	
			setTimeout(function(){$("#email-newsletter").val('');$("#news_error_throw").text(''); $("#news_error_throw").removeAttr("style");	},2000);
			},
		});
      }else
	  {
		$("#email-newsletter").addClass("error");
		$("#news_error_throw").css("color","red").text("சரியான மின்னஞ்சல் முகவரியை வழங்கவும்").show();
	  }
	 }else
	 {
		$("#email-newsletter").addClass("error");
		$("#news_error_throw").css("color","red").text("மின்னஞ்சல் முகவரியை வழங்கவும்").show();
	 }
	 $("#email-newsletter").keyup(function() {
        $("#news_error_throw").text(""); $("#email-newsletter").removeClass("error");
    });
	 }
  
});

function date_time(id)
	{
		// Display the time in 24 or 12 hour time?
	    // 0 = 24, 1 = 12
	     var my12_hour = 1;
		date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('ஜனவரி', 'பிப்ரவரி', 'மார்ச்', 'ஏப்ரல்', 'மே', 'ஜூன்', 'ஜூலை', 'ஆகஸ்ட்', 'செப்டம்பர்', 'அக்டோபர்', 'நவம்பர்', 'டிசம்பர்');
        d = date.getDate();
        day = date.getDay();
        days = new Array('ஞாயிற்றுக்கிழமை', 'திங்கள்கிழமை', 'செவ்வாய்க்கிழமை', 'புதன்கிழமை', 'வியாழக்கிழமை', 'வெள்ளிக்கிழமை', 'சனிக்கிழமை');
        h = date.getHours();
		// Set up the hours for either 24 or 12 hour display:
		if (my12_hour) {
			dn = "AM";
			if (h > 12) { dn = "PM"; h = h - 12; }
			if (h == 0) { h = 12; }
		} else {
			dn = "";
		}
		if(d<10)
        {
                d = "0"+d;
        }
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
		result = '';
		result += '<p class="date font-arial">';
        result += ''+h+':'+m+':'+s+ ' ' +dn+ '</br>';
		result += '<span>'+days[day]+' </span></br>';
		result += ''+d+' <span>'+months[month]+'</span> '+year+' </p>';
		if(document.getElementById(id)) {
        document.getElementById(id).innerHTML = result;
		document.getElementById("mobile_date").innerHTML = ''+d+' <span>'+months[month]+'</span> '+year;
		}
        setTimeout('date_time("'+id+'");','1000');
        return true;
	}
function mail_form_validate() {
	var error_free=true;
	var name = $('.popover input[name=sender_name]').val();
	var share_email = $('.popover input[name=share_email]').val();
	var refer_email = $('.popover input[name=refer_email]').val();
	
	if(name==''){
	$('.popover input[name=sender_name]').addClass('error');
	var error_free=false;
	}
	else if(share_email==''){
	$('.popover input[name=share_email]').addClass('error');
	var error_free=false;
	}else if(share_email!=''){
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var is_email=re.test(share_email);
	if(!is_email){
	$('.popover input[name=share_email]').addClass('error');
	var error_free=false;
	}
	else if(refer_email==''){
	$('.popover input[name=refer_email]').addClass('error');
	var error_free=false;
	}else if(refer_email!=''){
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var is_email=re.test(refer_email);
	if(!is_email){
	$('.popover input[name=refer_email]').addClass('error');
	var error_free=false;
	}else{
		var formData = {
			'content_id'        : $('input[name=content_id]').val(),
			'section_id'        : $('input[name=section_id]').val(),
			'content_type_id'   : $('input[name=content_type_id]').val(),
            'name'              : $('.popover input[name=sender_name]').val(),
            'share_email'       : $('.popover input[name=share_email]').val(),
            'refer_email'       : $('.popover input[name=refer_email]').val(),
			'share_content'     : $('#content_head').text(),
			'message'           : $('.popover textarea[name=message]').val(),
			'share_url'         : content_url,
        };
		$.ajax({
			url			: base_url+'user/commonwidget/share_article_via_email',
			method		: 'post',
			data		: formData,
			beforeSend	: function() {				
			$('.popover-title').html('Share Via Email <span><img style="width:15px"  src="'+base_url+'images/FrontEnd/images/ajax-loader.gif" ></span>');
			},
			success		: function(result){
			$('.popover-title').html('Share Via Email');
			$('.popover  #message').after('<span id="share_success" style="color:green;">Mail sent</span>');
            $('form[name="mail_share"]')[0].reset();
			setTimeout(function(){ $('#share_success').hide();$(".popover").removeClass('mail_sharing_open'); }, 5000);
			var mail_share_count= $(".PrintSocial .csbuttons-count:eq(3)").text();
				   if(mail_share_count == ''){
					   var mail_share_count= 0;
				   }else{
				    var mail_share_count = mail_share_count.replace(/[\(\)-]/g, "");
				   }
			$(".PrintSocial .csbuttons-count:eq(3)").text((parseInt(mail_share_count)+1));
			}
			});
		return false;
	}
	}
	}
	
	$("textarea,input").keyup(function(){
        $("input,textarea").removeClass("error");
    });
	   
}

function hit_page_views() {
    try {
        var theUrl = document.location;
        if (typeof(ga) != undefined) {
           // ga('create', 'UA-2311935-30', 'auto');
            ga('send', 'pageview', location.pathname);
        }
    } catch (err) {}
}
function update_hits()
{
	$('.PrintSocial').css('visibility','visible').hide().fadeIn("slow");
	var formData = {
		    'update_emailed_count'        : "article",
			'content_id'        : content_id,
			'section_id'        : $('input[name=section_id]').val(),
			'content_type_id'   : content_type_id,
			'title'             : $('#content_head').text(),
			'share_url'         : content_url,
			'page_param'        : page_param,
			'content_from'      : content_from,
			'article_created'   : $('input[name=article_created_on]').val(),
			'section_structure' : section_structure,
        };
		$.ajax({
			url			: base_url+'user/commonwidget/update_hits',
			method		: 'post',
			data		: formData,
			dataType    : 'json',
			success		: function(result){
			console.log("hits updated");
			var width = $(window).width();
			if(width >= 320 && width <= 991 || (result.recent_news=="No_News")){
			   $('.recent_news').hide();
			}
			else{
			   $('#topover').after(result.recent_news);
			   //$('.section-footer').after('<section class="section-recent-news"></section>');
			   //$('.section-recent-news').html($('.recent_news'));
			   $('body').append($('.recent_news'));
			}
			$(".PrintSocial .csbuttons-count:eq(3)").text(parseInt(result.emailed));
			},
		});
}
 function printDiv(divName)
    {
                var contents = $(divName).html();
                var frame1 = $('<iframe />');
                frame1[0].name = "frame1";
                frame1.css({ "position": "absolute", "top": "-1000000px" });
                $("body").append(frame1);
                var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                frameDoc.document.open();
                //Create a new HTML document.
                frameDoc.document.write('<html><head><title>Article Page</title>');
                frameDoc.document.write('</head><body>');
                //Append the external CSS file.
				frameDoc.document.write('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/bootstrap.min.css" type="text/css" />');
				frameDoc.document.write('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/font-awesome.css" type="text/css" />');
				frameDoc.document.write('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/style.css" type="text/css" />');
				frameDoc.document.write('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/media.css" type="text/css" />');

                //Append the DIV contents.
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    frame1.remove();
                }, 500);
    }