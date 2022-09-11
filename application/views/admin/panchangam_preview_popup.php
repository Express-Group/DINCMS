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
</style>



<?php
extract($_POST);
			$tamil_day         = $txtTamilday;
			$tamil_year_month  =  $txtTamilyearandmonth;
			$nalla_nearm_kalai = $txtNallaNeramKalai;
			$nalla_nearm_malai = $txtNallaNeramMalai;
			$raagu_kaalam      = $txtRaaguKaalam;
			$yemmakandam       = $txtYemmakandam;
			$kuligai           = $txtKuligai;
			$thithi            = $txtThithi;
			$chandrashtam      = $txtChandrashtam;
			
			$mesham            = $txtMesham;
			$rishabam          = $txtRishabam;
			$midhunam          = $txtMidunam;
			$kadagam           = $txtKadagam;
			$simmam            = $txtSimham;
			$kanni             = $txtKanni;
			$thulam            = $txtThulaam;
			$viruchigam        = $txtViruchigam;
			$danusu            = $txtDhanasu;
			$magaram           = $txtMagaram;
			$kumbam            = $txtKumbham;
			$meenam            = $txtMeenam;
			
			$scheduleddate     = $txtScheduleDate;
			$current_date      = date('d',strtotime($scheduleddate));
			$current_year      = date('Y',strtotime($scheduleddate));
			$current_month     = date('F',strtotime($scheduleddate));
			$month_tamil       = tamil_month($current_month);
?>
<section>

<div class="container SectionContainer ">	
<div class="row">
<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-left: 295px; margin-top: 10px;">
<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="parentHorizontalTab" style="margin-bottom-15">
            <div class="rasi-content">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <ul class="resp-tabs-list hor_1 ">
                    <li id="panchangam_tab">பஞ்சாங்கம்</li>
                    <li id="rasipalangal_tab">இன்றைய ராசி பலன்கள்</li>
                  </ul>
                </div>
              </div>
              <div class="resp-tabs-container hor_1 cinema-tab">
                <div id="panchangam">
                <div class="row">
                    <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                      <div class="rasi-gap">
                        <div class="col-lg-4  col-md-4 col-sm-6 col-xs-4  date">
                          <div class="tamil-date">
                            <h1><?php echo @$current_date; ?></h1>
                            <h4><?php echo $month_tamil.' '.$current_year; ?></h4><br/>
                          <p><?php echo @$tamil_year_month; ?></p>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-8  rasi1">
                  			 <h4 style="color:#064877 !important;"><?php echo @$tamil_day; ?></h4>
							 <p class="rasi-time color-red">நல்ல நேரம்</p>
							 <table>
                            <tr>
                            <td><span>காலை</span></td>
                            <td>:</td>
                            <td><?php echo @$nalla_nearm_kalai; ?></td>
                            </tr>
                            <tr>
                            <td><span>மதியம்</span></td>
                            <td>:</td>
                            <td><?php echo @$nalla_nearm_malai; ?></td>
                            </tr>
                            <tr>
                            <td><span class="color-red">ராகு காலம்</span></td>
                            <td>:</td>
                            <td><?php echo @$raagu_kaalam; ?></td>
                            </tr>
                            <tr>
                            <td><span class="color-red">எம கண்டம்</span></td>
                            <td>:</td>
                            <td><?php echo @$yemmakandam; ?></td>
                            </tr>
                            <tr>
                            <td><span class="color-red">குளிகை</span></td>
                            <td>:</td>
                            <td><?php echo @$kuligai; ?></td>
                            </tr>
                            </table>
                     <p class="thithi"><span class="color-red">திதி: </span><?php echo @$thithi; ?></p>
							
							
                       </div>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
                <div id="rasi_palangal">
                <div class="row">
                    <article  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rasi-icon">
                     <div class="right-rasi">
                     <ul>
                    <li>மேஷம்: <span><?php echo @$mesham; ?></span></li>
                    <li>ரிஷபம்: <span><?php echo @$rishabam; ?></span></li>
                    <li>மிதுனம்: <span><?php echo @$midhunam; ?></span></li>
                    <li>கடகம்: <span><?php echo @$kadagam; ?></span></li>
                    <li>சிம்மம்: <span><?php echo @$simmam; ?></span></li>
                    <li>கன்னி: <span><?php echo @$kanni; ?></span></li>
                     </ul>
                     </div>
                       <div class="left-rasi">
                    <ul>
                    <li>துலாம்: <span><?php echo @$thulam; ?></span></li>
                    <li>விருச்சிகம்: <span><?php echo @$viruchigam; ?></span></li>
                    <li>தனுசு: <span><?php echo  @$danusu; ?></span></li>
                    <li>மகரம்: <span><?php echo @$magaram; ?></span></li>
                    <li>கும்பம்: <span><?php echo @$kumbam; ?></span></li>
                    <li> மீனம்: <span><?php echo @$meenam; ?></span></li>
                    </ul>
                     </div>
                    </article>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        	
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!--		<img src="<?php echo base_url().'images/FrontEnd/images/add_300_250-small.jpg'; ?>"/>
		<img src="<?php echo base_url().'images/FrontEnd/images/most-read.jpg'; ?>"/>
		<img src="<?php echo base_url().'images/FrontEnd/images/facebook-twitter.jpg'; ?>"/>
-->	</div>
	</div>
</div>


</div>
</div>
</section>	
<script>
$(document).ready(function() {
	$('#parentHorizontalTab').easyResponsiveTabs();
});
</script>