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
                      <li>ஃபேஸ்புக்</li>
                      <li>ட்விட்டர்</li>
                    </ul>
                  </div>
                </div>
                <div class="resp-tabs-container hor_1 cinema-tab">
                  <div>
                    <div class="row">
                      <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cinema-list">
                        <iframe width="300px" height="1000px" frameborder="0" name="f1b9f1fda8f74ee" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" style="border: medium none; visibility: visible; width: 300px; height: 214px;" src="http://www.facebook.com/plugins/page.php?app_id=&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FxRlIuTsSMoE.js%3Fversion%3D41%23cb%3Df2bd6b7d518239%26domain%3Dwww.dinamani.com%26origin%3Dhttp%253A%252F%252Fwww.dinamani.com%252Ff70ab0fe453e16%26relation%3Dparent.parent&amp;container_width=300&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FDinamaniDaily&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false&amp;width=300" class=""></iframe>
                      </article>
                    </div>
                  </div>
                  <div>
                    <div class="row">
                      <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cinema-list">
                        <div class="widget code html widget-editable viziwyg-section-228 inpage-widget-2910944" > <a class="twitter-timeline" href="https://twitter.com/DINAMANI" data-widget-id="619110901862436864">Tweets by @DINAMANI</a> 
                          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
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
		$info.show();
		}
	});
});
</script>
