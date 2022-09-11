<?php
$widget_instance_id =  $content['widget_values']['data-widgetinstanceid'];
?>
<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="parentHorizontalTab<?php echo $widget_instance_id;?>">
            <div class="social-content">
              <div class="flow">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="resp-tabs-list hor_1 Fb-Twitter">
                      <li id="fb">ஃபேஸ்புக்</li>
                      <li id="tweet">ட்விட்டர்</li>
                    </ul>
                  </div>
                </div>
                <div class="resp-tabs-container hor_1 cinema-tab">
                  <div>
                    <div class="row">
                      <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cinema-list">                         
                <!-- <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDinamaniDaily&tabs&width=300&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="300" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>-->
				 
				 <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDinamaniDaily&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=2107495602843323" width="340" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                 
                      </article>                 
                      </div>
                  </div>
                  <div>
                    <div class="row">
                      <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cinema-list">
                        <div class="widget code html widget-editable viziwyg-section-228 inpage-widget-2910944" id="twitter_posts"  style="display:none;"> <a class="twitter-timeline" href="https://twitter.com/DinamaniDaily" data-widget-id="619110901862436864">Tweets by @DINAMANI</a> 
                          <script></script> 
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
          
<script>

$(document).ready(function() {
	$('#parentHorizontalTab<?php echo $widget_instance_id;?>').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion
		width: 'auto', //auto or any width like 600px
		fit: true, // 100% fit in a container
		tabidentify: 'hor_1', // The tab groups identifier
		enableHash : false,
		activate: function(event) { // Callback function if tab is switched
		var $tab = $(this);
		var $info = $('#nested-tabInfo');
		var $name = $('span', $info);
		$name.text($tab.text());
		//$info.show();
		var id = $tab.attr('id');
        if(id=='tweet'){
	$('#twitter_posts').show();
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		}
		}
	});
});
</script>
