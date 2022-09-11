$(function() {
	date_time('current_time');
	
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
	  
	$("#srch-term").keyup(function() {
        $("#error_throw").text(""), $("#srch-term").removeClass("error"),$("#error_throw").removeClass("error");
    });
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
		$("#news_error_throw").css("color","red").text("தயவு செய்து மின்னஞ்சல் முகவரியை வழங்கவும்").show();
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