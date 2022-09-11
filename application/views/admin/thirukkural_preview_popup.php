<style>
#preview_article_popup_container .SectionContainer{
	padding: 0 13px !important;
}
@media only screen and (max-width: 1550px) and (min-width: 1297px){
 .container, .remodal.main-menu {
    width: 980px;
}
}
#preview_article_popup{
	display: block;

}
.remodal-overlay {
    background-color: #000 !important;
}
.remodal-overlay:after{
display:inline;
}
#preview_article_popup .pagination{
background:none;
box-shadow:none;
width:auto;
margin: 0 !important;
padding-right: 0;
}
#preview_article_popup .SectionContainer{
	overflow:hidden;
}
#preview_article_popup .page{
	background:#fff !important;
	color:#000 !important;
	font-weight:normal;
}
#preview_article_popup .article_pagination{
	width:80%;
    
}
#preview_article_popup #auto-play .fa-pause{
	margin:0;
}
#preview_article_popup #auto-play i{
	
	font-size:12px;
}
#preview_article_popup .remodal-close{
	top:0;
}

@media only screen and (max-width: 1550px) and (min-width: 1297px){
#preview_article_popup .remodal-close{
	right:-166px;
}
#preview_article_popup{
	display: block;
    background: none;
    box-shadow: none;
    width: 866px;
    margin: auto 150px;

}
}
#preview_article_popup .VideoScriptContent, #preview_article_popup .AudioContent{
	margin-bottom:30px;
}
#preview_article_popup .play-pause-icon {
    background: #fff none repeat scroll 0 0;
    border: 2px solid #ccc;
    border-radius: 100%;
    height: 27px;
    padding: 5px 0;
    position: absolute;
    right: 24px;
    top: 10px;
    width: 28px;
    z-index: 999;
}
#preview_article_popup p {
	line-height:18px; 
}
#preview_article_popup .page{
padding:0;
margin:0;
}
#preview_article_popup .pagination a{
	font-size:12px;
			float: left;
	padding: 6px 10px;	
}

#preview_article_popup iframe, #preview_article_popup audio {
	margin:10px 0;
}

#preview_article_popup li{
	float: none; list-style: initial;
	margin-left: 16px;
}

#preview_article_popup blockquote {
     padding-left: 20px !important;
    padding-right: 8px !important;
    border-left-width: 5px;
    border-color: #ccc;
    font-style: italic;
	margin:10px 0 !important;
 padding: 12px 16px !important;
 font-size:13px !important;
}
#preview_article_popup  blockquote p{font-size:13px; !important;text-align:center; }
#preview_article_popup li a{ float:none}
.kural-mean p{font-size: <?php echo $kural_font;?>px;}
</style>



<?php
?>
<section>

<div class="container SectionContainer ">	
<div class="row">

<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-left: 295px;">
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">
		<div class="side-gap">
			<div class="box-botton kural-button ">திருக்குறள்</div>
			<div class="box-one kural-box pull-left ">
            <articel class="kural-dis">
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<h5 class="pull-left">எண்: <span><?php echo $kural_series; ?> </span></h5>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <figure class="kural-img"><img src="<?php echo base_url(); ?>/images/FrontEnd/images/kural.jpg"></figure>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<h5 class="pull-right">அதிகாரம்: <span><?php echo $kural_athikaram; ?></span></h5>
                </div>
			</articel>
								<articel>
					
					<figcaption class="kural-mean">
						<p><?php echo $kural_line1; ?></p>
                        <p><?php echo $kural_line2; ?></p>
                    </figcaption>
				</articel>
				<articel class="kural-dis">
					<h4 class="porul">பொருள்</h4>
					<p><?php echo $kural_meaning; ?></p>
				</articel>
							</div>
		</div>
	</div>
</div>	
<!--<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<img src="<?php echo base_url().'images/FrontEnd/images/add_300_250-small.jpg'; ?>"/>
		<img src="<?php echo base_url().'images/FrontEnd/images/most-read.jpg'; ?>"/>
		<img src="<?php echo base_url().'images/FrontEnd/images/facebook-twitter.jpg'; ?>"/>
	</div>
	</div>-->
</div>


</div>
</div>
</section>	