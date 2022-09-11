
<style>
.news-list-breaking{display: inline; font-size: 17px; color:red;}
.news-list-breaking img{width:auto;padding-top: 2px;}
.news-list-breaking p{display: inline;padding:0 8px 0;font-weight: bold;}
.breaking-updated{background:#f3f3f3;padding: 6px 0 4px;float: left;width: 90%;}
.breaking-label{width: 10%;float: left;padding: 6px 0 6px;background: #fb1100;text-align: center;color: #fff;font-weight:bold;}
.label-breaking{background: #FF9800;}
</style>
<link rel="stylesheet" href="<?php echo image_url; ?>css/FrontEnd/css/breakingNews.css" type="text/css">
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	  <div class="breaking-label"><span>சுடச்சுட</span></div>
      <marquee class="top-breaking breaking-updated" id="breaking_news_updated" behavior="scroll" scrollamount="10" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
      </marquee>
  </div>
</div>
<script>
document.getElementById('breaking_news_updated').stop();
setInterval(function(){
	$('.breaking-label').toggleClass('label-breaking');
},1000);
$(document).ready(function() {
		 $.ajax({
			url			: '<?php echo base_url(); ?>user/commonwidget/get_breaking_news_content',
			method		: 'get',
			dataType    : 'json',
			data		: { type: "1", param: '<?php echo $content['close_param'];?>',mode:'<?php echo $content['mode'];?>', is_home: '<?php echo $content['is_home_page'];?>',},
			beforeSend	: function() {				
			},
			success		: function(result){ 
			//alert(result.news);
			if(result.news.trim()!='no_news'){
				   $(".line").css("visibility", "visible");
				   $(".line").fadeIn();
				   var response = '<div class="bk">'+result.news+'</div>';
				   var template ='<ul class="beaking-news-marquee">';
				   
				   $(response).find('div').each(function(index){
					template +='<li class="news-list-breaking"><span class="dn-logo"><img src="<?php echo image_url ?>images/FrontEnd/images/favicon.ico" alt="BREAKING-NEWS"></span>'+$(this).html()+'</li>';
				   });
				   template +='</ul>';
				   $('#breaking_news_updated').html(template);
				   document.getElementById('breaking_news_updated').start();
			}else{
			 $(".line").css("visibility", "hidden");
			}
				   }			
		});
			});
</script>




