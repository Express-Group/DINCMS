<?php $script_url = image_url; ?>
<span class="css_and_js_files">
<link href="<?php echo $script_url; ?>css/admin/prabu-styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css" type="text/css">
<!--<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
--><link href="<?php echo $script_url; ?>css/admin/jquery_panchangam-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<link href="<?php echo $script_url; ?>includes/ckeditor/contents.css" rel="stylesheet" type="text/css" id="contents_css"  />
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>includes/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.remodal.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/panchangam.js"></script>

</span>
<span class="previewcontainer">
<script src="<?php echo $script_url; ?>js/FrontEnd/js/easyResponsiveTabs.js"></script>
</span>

<style>
label.error {
	color:#F00;
	display: block;
}
#mandatory
{
	color:red;	
}
</style>
<script type="text/javascript"> var base_url = '<?php echo base_url(); ?>'; </script>
<script>
$(document).ready(function()
{
	CKEDITOR.replace( 'txtPanjangamDetails',
    {
        toolbar : [ { name: 'basicstyles', items: [ 'Bold', 'Italic', 'TextColor','FontSize' ] } ]
		
    });	
	
	
});
</script>


<div class="Container">
	<div class="BodyWhiteBG">
		<?php
		if(($this->session->flashdata("success"))) { ?>
			<div id="flash_msg_id" class="FloatLeft SessionSuccess"><?php echo $this->session->flashdata("success");?></div>
		<?php } ?>
		<?php if($this->session->flashdata("success_delete")) { ?>
			<div class="FloatLeft SessionSuccess" id="flash_msg_id"><?php echo $this->session->flashdata("success_delete");?></div>
		<?php } ?>
		<?php if(($this->session->flashdata("error"))) { ?>
			<div id="flash_msg_id" class="FloatLeft SessionError"><?php echo $this->session->flashdata("error");?></div>
		<?php } ?>
		<form name="panjangam_form" id="panjangam_form" action="<?php echo base_url(); ?>dmcpan/panchangam_manager/add_panchangam" method="post" enctype="multipart/form-data">
			<div class="BodyHeadBg Overflow clear">
				<div class="FloatLeft BreadCrumbsWrapper">
					<div class="breadcrumbs">Dashboard > <?php echo $title; ?></div>
					<h2 class="FloatLeft"><?php echo $title; ?></h2>
				</div>
				<!--<div class="FloatLeft Error">Error Message</div>-->
				<p class="FloatRight save-back save_margin article_save"> <a class="FloatLeft back-top" href="<?php echo base_url(); ?>dmcpan/panchangam_manager"><i class="fa fa-reply fa-2x"></i></a> <a class="back-top FloatLeft top_iborder" href="#" data-remodal-target="preview_article_popup" title="Preview" id="preview_id" ><i class="fa fa-desktop i_extra"></i></a>
					<button class="btn-primary btn" type="button" name="btnPanchangam" id="btnPanchangam"><i class="fa fa-file-text-o"></i> &nbsp;Save</button>
				</p>
			</div>
			
			<div class="panchangam-time">
				<div class="section_content  ">
					<div class="section_form">
					
						<div class="panchangam-editor VideoCk">
							
							<div class=" rasi-top panchangam-sec1">
							    <div class="panchangam-date1">
									<div class="qns">
										<label class="question">தேதி<span id="mandatory">*</span></label>
									</div>
									<div class="ans panchangam-date">
										<div id="datetimepicker1" class="input-append date panchangam-kalam">
											<?php if(isset($fetch_values['Panchangam_date']) && $fetch_values['Panchangam_date'] != "")
											 { $schedule_date = strtotime($fetch_values['Panchangam_date']);
												$schedule_date = date('d-m-Y', $schedule_date);
											 } ?>
											<input data-format="dd-MM-yyyy " type="text" tabindex="1" onkeyup="toUnicode(this)" name="txtScheduleDate" id="txtScheduleDate" class="txtScheduleDate" value="<?php if(isset($fetch_values['Panchangam_date']) && $fetch_values['Panchangam_date'] != "") { echo $schedule_date;} echo set_value('txtScheduleDate'); ?>" />
											 </div>
										<p id="date_error" style="color:#F00"></p>
									</div>
								</div>
								
								<div class="panchangam-left">
								
									<div class="qnsans">
										<div class="qns">
											<label class="question">(கிழமை)<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<textarea name="txtTamilday" id="txtTamilday" tabindex="2" maxlength="15" onkeyup="toUnicode(this);" ><?php if(isset($fetch_values['Tamilday']) && $fetch_values['Tamilday'] != "") echo $fetch_values['Tamilday']; ?></textarea>
											<input type="hidden" name="panchangam_id" id="panchangam_id" value="<?php if(isset($fetch_values['Panchangam_id']) && $fetch_values['Panchangam_id'] != "") { echo $fetch_values['Panchangam_id'];} echo set_value('panchangam_id'); ?>" />											
										</div>
										<!--<div id="textCounter" style="font:15px Arial;">20 Characters limit</div>-->
									</div>
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">நல்ல நேரம் - காலை<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="4" onkeyup="toUnicode(this)" name="txtNallaNeramKalai" id="txtNallaNeramKalai" value="<?php if(isset($fetch_values['NallaNeramKalai']) && $fetch_values['NallaNeramKalai'] != "") { echo $fetch_values['NallaNeramKalai'];} echo set_value('txtNallaNeramKalai'); ?>">
										</div>
									</div>
									
									
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">ராகு காலம்<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="6" onkeyup="toUnicode(this)" name="txtRaaguKaalam" id="txtRaaguKaalam" value="<?php if(isset($fetch_values['RaaguKaalam']) && $fetch_values['RaaguKaalam'] != "") { echo $fetch_values['RaaguKaalam'];} echo set_value('txtRaaguKaalam'); ?>">
										</div>
									</div>
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">குளிகை<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="8" onkeyup="toUnicode(this)" name="txtKuligai" id="txtKuligai" value="<?php if(isset($fetch_values['Kuligai']) && $fetch_values['Kuligai'] != "") { echo $fetch_values['Kuligai'];} echo set_value('Kuligai'); ?>">
										</div>
									</div>
									
									<div class="qnsans">
									<div class="qns">
										<label class="question">சந்திராஷ்டமம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<textarea name="txtChandrashtam" id="txtChandrashtam" tabindex="10" onkeyup="toUnicode(this)"><?php if(isset($fetch_values['Chandrashtam']) && $fetch_values['Chandrashtam'] != "") echo $fetch_values['Chandrashtam']; ?></textarea>
									</div>
								</div>
								
								</div>
								
								<div class="panchangam-right">
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">தமிழ் ஆண்டு மற்றும் மாதம்<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<textarea name="txtTamilyearandmonth" id="txtTamilyearandmonth" tabindex="3" onkeyup="toUnicode(this)"><?php if(isset($fetch_values['Tamilyearandmonth']) && $fetch_values['Tamilyearandmonth'] != "") echo $fetch_values['Tamilyearandmonth']; ?></textarea>
										</div>
									</div>
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">நல்ல நேரம் - மாலை<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="5" onkeyup="toUnicode(this)" name="txtNallaNeramMalai" id="txtNallaNeramMalai" value="<?php if(isset($fetch_values['NallaNeramMalai']) && $fetch_values['NallaNeramMalai'] != "") { echo $fetch_values['NallaNeramMalai'];} echo set_value('txtNallaNeramMalai'); ?>">
										</div>
									</div>
									
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">எமகண்டம் <span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="7" onkeyup="toUnicode(this)" name="txtYemmakandam" id="txtYemmakandam" value="<?php if(isset($fetch_values['Yemmakandam']) && $fetch_values['Yemmakandam'] != "") { echo $fetch_values['Yemmakandam'];} echo set_value('txtYemmakandam'); ?>">
										</div>
									</div>
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">திதி<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<textarea name="txtThithi" id="txtThithi" tabindex="9" onkeyup="toUnicode(this)" rows="3" cols="3"><?php if(isset($fetch_values['Thithi']) && $fetch_values['Thithi'] != "") echo $fetch_values['Thithi']; ?></textarea>
										</div>
									</div>
									
									<div class="qnsans">
										<div class="qns">
											<label class="question">நட்சத்திரம்<span id="mandatory">*</span></label>
										</div>
										<div class="ans">
											<input type="text" class="tb_style box-shad" tabindex="5" onkeyup="toUnicode(this)" name="txtNatchatram" id="txtNatchatram" value="<?php if(isset($fetch_values['Natchatram']) && $fetch_values['Natchatram'] != "") { echo $fetch_values['Natchatram'];} echo set_value('Natchatram'); ?>">
										</div>
									</div>
								
								</div>
								
								
								<div class="panchangam-section1">
								<h4 class="ColorTheme">பஞ்சாங்கம் (விரிவாக்கம்)<span id="mandatory">*</span></h4>
								<textarea class="ckeditor" name="txtPanjangamDetails" tabindex="11" onkeyup="toUnicode(this)" id="txtPanjangamDetails"><?php if(isset($fetch_values['Panchangam_id']) && $fetch_values['Panchangam_id'] != "") echo $fetch_values['PanchangamDetails']; ?></textarea>
								
								<p id="panchangamdetails_error" style="color:#F00"></p>
							</div>
						
							
							</div>
							
						</div>
						
						<div class="panchangam-sec2">							
							
							<div class="panchangam-sec1">
								<div class="section_seo_head"><h4>ராசிபலன்</h4></div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">மேஷம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="12" onkeyup="toUnicode(this)" name="txtMesham" id="txtMesham" value="<?php if(isset($fetch_values['MeshamRasiPalan']) && $fetch_values['MeshamRasiPalan'] != "") { echo $fetch_values['MeshamRasiPalan'];} echo set_value('txtMesham'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">ரிஷபம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="13" onkeyup="toUnicode(this)" name="txtRishabam" id="txtRishabam" value="<?php if(isset($fetch_values['RishabamRasiPalan']) && $fetch_values['RishabamRasiPalan'] != "") { echo $fetch_values['RishabamRasiPalan'];} echo set_value('txtRishabam'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">மிதுனம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="14" onkeyup="toUnicode(this)" name="txtMidunam" id="txtMidunam" value="<?php if(isset($fetch_values['MidhunamRasiPalan']) && $fetch_values['MidhunamRasiPalan'] != "") { echo $fetch_values['MidhunamRasiPalan'];} echo set_value('txtMidunam'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">கடகம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="15" onkeyup="toUnicode(this)" name="txtKadagam" id="txtKadagam" value="<?php if(isset($fetch_values['KadahamRasiPalan']) && $fetch_values['KadahamRasiPalan'] != "") { echo $fetch_values['KadahamRasiPalan'];} echo set_value('txtKadagam'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">சிம்மம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="16" onkeyup="toUnicode(this)" name="txtSimham" id="txtSimham" value="<?php if(isset($fetch_values['SimamRasiPalan']) && $fetch_values['SimamRasiPalan'] != "") { echo $fetch_values['SimamRasiPalan'];} echo set_value('txtSimham'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">கன்னி<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="17" onkeyup="toUnicode(this)" name="txtKanni" id="txtKanni" value="<?php if(isset($fetch_values['KanniRasiPalan']) && $fetch_values['KanniRasiPalan'] != "") { echo $fetch_values['KanniRasiPalan'];} echo set_value('txtKanni'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">துலாம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="18" onkeyup="toUnicode(this)" name="txtThulaam" id="txtThulaam" value="<?php if(isset($fetch_values['ThulamRasiPalan']) && $fetch_values['ThulamRasiPalan'] != "") { echo $fetch_values['ThulamRasiPalan'];} echo set_value('txtThulaam'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">விருச்சிகம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="19" onkeyup="toUnicode(this)" name="txtViruchigam" id="txtViruchigam" value="<?php if(isset($fetch_values['ViruchagammRasiPalan']) && $fetch_values['ViruchagammRasiPalan'] != "") { echo $fetch_values['ViruchagammRasiPalan'];} echo set_value('txtViruchigam'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">தனுசு<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="20" onkeyup="toUnicode(this)" name="txtDhanasu" id="txtDhanasu" value="<?php if(isset($fetch_values['DanushuRasiPalan']) && $fetch_values['DanushuRasiPalan'] != "") { echo $fetch_values['DanushuRasiPalan'];} echo set_value('txtDhanasu'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">மகரம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="21" onkeyup="toUnicode(this)" name="txtMagaram" id="txtMagaram" value="<?php if(isset($fetch_values['MagaramRasiPalan']) && $fetch_values['MagaramRasiPalan'] != "") { echo $fetch_values['MagaramRasiPalan'];} echo set_value('txtMagaram'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">கும்பம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="22" onkeyup="toUnicode(this)" name="txtKumbham" id="txtKumbham" value="<?php if(isset($fetch_values['KumbamRasiPalan']) && $fetch_values['KumbamRasiPalan'] != "") { echo $fetch_values['KumbamRasiPalan'];} echo set_value('txtKumbham'); ?>">
									</div>
								</div>
								<div class="qnsans">
									<div class="qns">
										<label class="question">மீனம்<span id="mandatory">*</span></label>
									</div>
									<div class="ans">
										<input type="text" class="tb_style box-shad" tabindex="23" onkeyup="toUnicode(this)" name="txtMeenam" id="txtMeenam" value="<?php if(isset($fetch_values['MenamRasiPalan']) && $fetch_values['MenamRasiPalan'] != "") { echo $fetch_values['MenamRasiPalan'];} echo set_value('txtMeenam'); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
        <div class="remodal" id="preview_article_popup" data-remodal-id="preview_article_popup" data-remodal-options="hashTracking: false" style="position:relative;">
      <div id="preview_article_popup_loading"> </div>
      <div id="preview_article_popup_container"  class="container" style="display:none;"> </div>
    </div>
	</div>
</div>
<!--<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script> 
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script> 
<script type="text/javascript">
  $(function() {
	  $('#datetimepicker1').datepicker({
       language: 'en',
	   pickTime: false,
	   //minDate: dateToday,
	  // minDate: new Date(),
	   
     });
	//$( "#datetimepicker1" ).datepicker({ minDate: 0});

  });
</script> -->

    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	 <script language="javascript">
	 var base_url = '<?php	 echo site_url(); ?>'; 
        $(document).ready(function () {
            $("#txtScheduleDate").datepicker({
                minDate: 0,
				dateFormat: 'dd-mm-yy'
            });
			<?php //if(isset($fetch_values['Panchangam_date']) && $fetch_values['Panchangam_date'] != "") {  ?>
			$("#txtScheduleDate").change(function(){
            var $filledTextboxes = $("input[type=text], textarea").not('.txtScheduleDate').filter(function(){
			   return $.trim($(this).val()) != "";
			});
			if($filledTextboxes.size()!= 0){
			 if (confirm("Are you sure want to change date.\n clicking Ok will loss of Form data!\n clicking Cancel changes date only !") == true) {
			$("#panjangam_form").closest('form').find("input[type=text], textarea").not('.txtScheduleDate').val("");
			CKEDITOR.instances.txtPanjangamDetails.setData('');
			} 
			}
			});
			<?php //} ?>
			 $(".ui-icon").addClass("fa fa-chevron-right");
             $(".ui-icon").addClass("fa fa-chevron-left");
			// toUnicode(this);
			 
			 $('#parentHorizontalTab').easyResponsiveTabs();
			 // BELOW CONTENT EXPLAINS ABOUT THIRUKKURAL PREVIEW 
				$("#preview_id").click(function() {
			
			$("#preview_article_popup_container").hide();
			$("#preview_article_popup_loading").hide();
			
			
			$("#preview_article_popup_loading").html('<img style="width:40px; height:40px;" src="'+base_url+'images/admin/loadingroundimage.gif">')
			$('.remodal-close').hide();
			$("#preview_article_popup_loading").show();
			            
			
			var formData = {
            'txtScheduleDate'        : $('input[name=txtScheduleDate]').val(),
            'txtTamilyearandmonth'   : $('textarea[name=txtTamilyearandmonth]').val(),
            'txtTamilday'            : $('textarea#txtTamilday').val(),
			'txtNallaNeramKalai'     : $('input[name=txtNallaNeramKalai]').val(),
			'txtNallaNeramMalai'     : $('input[name=txtNallaNeramMalai]').val(),
			'txtRaaguKaalam'         : $('input[name=txtRaaguKaalam]').val(),
			'txtYemmakandam'         : $('input[name=txtYemmakandam]').val(),
			'txtKuligai'             : $('input[name=txtKuligai]').val(),
			'txtThithi'              : $('textarea[name=txtThithi]').val(),
			'txtChandrashtam'        : $('textarea[name=txtChandrashtam]').val(),
			
			'txtMesham'              : $('input[name=txtMesham]').val(),
            'txtRishabam'            : $('input[name=txtRishabam]').val(),
			'txtMidunam'             : $('input[name=txtMidunam]').val(),
			'txtKadagam'             : $('input[name=txtKadagam]').val(),
			'txtSimham'              : $('input[name=txtSimham]').val(),
			'txtKanni'               : $('input[name=txtKanni]').val(),
			'txtThulaam'             : $('input[name=txtThulaam]').val(),
			'txtViruchigam'          : $('input[name=txtViruchigam]').val(),
			'txtDhanasu'             : $('input[name=txtDhanasu]').val(),
			'txtMagaram'             : $('input[name=txtMagaram]').val(),
			'txtKumbham'             : $('input[name=txtKumbham]').val(),
			'txtMeenam'              : $('input[name=txtMeenam]').val(),
             };
			$.ajax({
			url: base_url+folder_name+"/panchangam_manager/get_panchangam_preview_popup",
			type: "POST",             // Type of request to be send, called as method
			data:  formData,
			dataType: "HTML",
			async: false, 
			success: function(data)   // A function to be called if request succeeds
			{
				
		setTimeout(function(){
			
		//$('link[rel=stylesheet][href~="'+base_url+'css/admin/dashboard-style.css"]').remove();
		$("#contents_css").remove();

		$(".previewcontainer").append($('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/style.css" type="text/css">')); 
		$(".previewcontainer").append($('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/media.css" type="text/css">'));
		$(".previewcontainer").append($('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/slick.css" type="text/css">'));
	
	},1000);
	
	setTimeout(function(){
		$('.remodal-close').show();
	$("#preview_article_popup_container").html(data);	

	$("#preview_article_popup_loading").hide();
	$("#preview_article_popup_container").show();
	

		},1000);
		
		
			},
		});
	
			}); 
	
$(document).on('close', '#preview_article_popup', function () {  
		$(".css_and_js_files").append($('<link rel="stylesheet" href="'+base_url+'includes/ckeditor/contents.css" type="text/css"  id="contents_css">'));  
		$('link[rel=stylesheet][href~="'+base_url+'css/FrontEnd/css/style.css"]').remove();
		$('link[rel=stylesheet][href~="'+base_url+'css/FrontEnd/css/media.css"]').remove();
}); 

	
			 
        });
    </script>