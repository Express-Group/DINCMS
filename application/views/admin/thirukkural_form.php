<?php $script_url = image_url; ?>
<span class="css_and_js_files">
<link href="<?php echo $script_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/additional-methods.min.js"></script>
<link href="<?php echo $script_url; ?>includes/ckeditor/contents.css" rel="stylesheet" type="text/css"  id="contents_css"  />
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.remodal.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>includes/ckeditor/ckeditor.js"></script>
</span>
<span class="previewcontainer">

</span>
<style>
.error {
	color:#F00!important;
}
.mandatory {
	color:#F00;
}
</style>
<?php
if(isset($kuraleditdetails))
{
foreach($kuraleditdetails as $data)
{
	$kural_id=$data['Thirukkural_id'];
	$firstline = $data['First_line'];
	$secondline = $data['Second_line'];
	$meaning=$data['Meaning'];
	$series=$data['Series'];
	$section=$data['Section'];
	$fontsize=$data['thirukkural_font'];
	$status=$data['Status'];
	
}
}

 ?>
<script>
var base_url = '<?php	 echo site_url(); ?>'; 
$(document).ready(function()
{
	/*CKEDITOR.replace( 'txtMainTitle',
    {
        toolbar : [ { name: 'basicstyles', items: [ 'Bold', 'Italic', 'TextColor' ] } ]
		
    });	*/
	 
	$("#thirukkuralform").validate({
		rules: {			
			txtMainTitle: 
			{ 
				required: true,
			},
			txtMainTitle1: 
			{ 
				required: true,
			},
			txtMeaning:
			{
				required: true,
				
			},
			txtSeries:
			{
				required: true,
				number:true,
			},
			txtSection:
			{
				required: true,
			},
			
			
		},
		messages: {
			/*txtdisplayname:{
				required: "Please enter the display name",
				 },*/
				 txtMainTitle:{
				required: "Please enter title",
					 },
				txtMainTitle1:{
				required: "Please enter title",
					 },
				txtMeaning:
				{
				 required:"Please enter meaning",
    			},
				txtSeries:
			{
				required: "Please enter series",
				number:"Please enter a valid number",
			},
				txtSection:"Please enter section",
				
			
				
			
			
		},
		
	
		
	});
		
		
		$("#btnSaveTop").click(function() 
		{
			if($("#thirukkuralform").valid())
			{
				var MainTitle=$('#txtMainTitle').val();
				var secondline=$('#txtMainTitle1').val();
				var kuralid=$('#txthiddenid').val();
				
					$.ajax({
					type: "POST",
					data: {"title":MainTitle,"kural_id":kuralid, "secondline":secondline},
					url:"<?php echo base_url(); ?>dmcpan/thirukkural_manager/check_thirukkural",
					success: function(result)
					{
						if(result == "Thirukkural already exists")
						{
							$('#exist_msg').html('Thirukkural already exists');
							return false;
						}
						else
						{
							$('#exist_msg').html('');
							<?php
							  if(isset($kural_id))
							  {
							  ?>
							  	if($('input[name=status]:checked').val()=="I" )
									 var r = confirm("Are you sure you want to deactivate the status?");	
								else
							 	 	var r = confirm("Are you sure you want to update thirukkural details?");
							  <?php } else {?>
							  var r = confirm("Are you sure you want to add thirukkural details?");
							  
							  <?php }?>
							  
							  if(r==true)
							  {
								  $("#thirukkuralform").submit();
							  }
							  else
							  {
								  return false;
							  }
							
						}
					}
				
		
			
				});
			}
				
		});
		
		// BELOW CONTENT EXPLAINS ABOUT THIRUKKURAL PREVIEW 
				$("#preview_id").click(function() {
			
			$("#preview_article_popup_container").hide();
			$("#preview_article_popup_loading").hide();
			
			
			$("#preview_article_popup_loading").html('<img style="width:40px; height:40px;" src="'+base_url+'images/admin/loadingroundimage.gif">')
			$('.remodal-close').hide();
			$("#preview_article_popup_loading").show();
			
			var series =$("#txtSeries").val();
			var athigaram = $('#txtSection').text();
			var body_text = encodeURIComponent($("#txtMeaning").text());
			var kurral_line1 = $("#txtMainTitle").val();
			var kurral_line2 = $('#txtMainTitle1').val();
			var kural_font   = $('#kural_font').val();
             
			
			var postdata = {"body_text" :body_text,"series": series,"athigaram":athigaram,"kurral_line1":kurral_line1, "kurral_line2": kurral_line2, "kural_font": kural_font,};
			$.ajax({
			url: base_url+folder_name+"/thirukkural_manager/get_thirukkural_preview_popup",
			type: "POST",             // Type of request to be send, called as method
			data:  postdata,
			dataType: "HTML",
			async: false, 
			success: function(data)   // A function to be called if request succeeds
			{
				
		setTimeout(function(){
			
		//$('link[rel=stylesheet][href~="'+base_url+'css/admin/dashboard-style.css"]').remove();
		$("#contents_css").remove();

		$(".previewcontainer").append($('<link rel="stylesheet" href="'+base_url+'css/FrontEnd/css/style.css" type="text/css">')); 
		//$(".previewcontainer").append($("<script type='text/javascript' src='"+base_url+folder_name+"js/article-pagination.js'>"));
	
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
}); 

		
		
		
 });
</script>

<div class="Container">
  <div class="BodyWhiteBG" >
    <form action="<?php echo base_url()."dmcpan/thirukkural_manager/addthirukkuraldetails";?>"  name="thirukkuralform" id="thirukkuralform" method="post" enctype="multipart/form-data" >
      <div class="BodyHeadBg Overflow clear">
        <?php if(isset($kural_id) ){?>
        <div class="FloatLeft BreadCrumbsWrapper PollResult">
          <div class="breadcrumbs">Dashboard > Edit Thirukkural</div>
          <h2 class="FloatLeft">Edit Thirukkural</h2>
        </div>
        <?php } else {?>
        <div class="FloatLeft BreadCrumbsWrapper PollResult">
          <div class="breadcrumbs">Dashboard > Add Thirukkural</div>
          <h2 class="FloatLeft">Add Thirukkural</h2>
        </div>
        <?php }?>
        <div class="FloatLeft Error" id="emailerror_exist" style="display:none"></div>
        <p class="FloatRight save-back save_margin article_save"> <a href="<?php echo base_url()."dmcpan/thirukkural_manager";?>" class="FloatLeft back-top"><i class="fa fa-reply fa-2x"></i></a> <a class="back-top FloatLeft top_iborder" href="#" data-remodal-target="preview_article_popup" title="Preview" id="preview_id" ><i class="fa fa-desktop i_extra"></i></a>
          <button type="button" id="btnSaveTop" class="btn-primary btn"  ><i class="fa fa-file-text-o"></i> &nbsp;Save</button>
        </p>
      </div>
      <div class="tabs Overflow" style="margin-top:10%;">
        <div class="kural">
          <div class="content">
            <div class="columnist1">
              <div class="kural-title">
                <p class="Biogrpaphy">
                  <label class="biography" id="biographys">Main Title1(குறள்)<span class="mandatory">*</span></label>
                </p>
                <input type="hidden" name="txthiddenid" id="txthiddenid" value="<?php if(isset($kural_id)){ echo $kural_id;}?>" />
                <p>
                  <input type="text"  name="txtMainTitle" id="txtMainTitle" value="<?php if(isset($firstline)){ echo $firstline;}else{echo set_value('txtMainTitle');}?>" />
                </p>
              </div>
              <div class="kural-title">
                <p class="Biogrpaphy">
                  <label class="biography" id="biographys">Main Title2(குறள்)<span class="mandatory">*</span></label>
                </p>
                <p>
                  <input type="text"  name="txtMainTitle1"  id="txtMainTitle1" value="<?php if(isset($secondline)){ echo $secondline;}else{echo set_value('txtMainTitle');}?>"/>
                </p>
                <p id="exist_msg" class="mandatory"></p>
              </div>
              <div class="kural-title">
                <p class="Biogrpaphy">
                  <label class="biography" id="biographys">Meaning(பொருள்)<span class="mandatory">*</span></label>
                </p>
                <p class="TextAreaWidth">
                  <textarea maxlength="255" id="txtMeaning" name="txtMeaning" class="biography1 box-shad box-shad1"><?php if(isset($meaning)){ echo $meaning;}else{echo set_value('txtMeaning');}?>
</textarea>
                </p>
              </div>
            </div>
            <div class="kural-left">
              <div class="kural-left-content">
                <p>
                  <label class="txtdisplayname" id="name">Series(எண்)</label>
                  <span class="mandatory">*</span></p>
                <p class="kural-box">
                  <input id="txtSeries" class="box-shad box-shad1" name="txtSeries" type="text" maxlength="50" value="<?php if(isset($series)){ echo $series;}else{echo set_value('txtSeries');}?>" >
                </p>
              </div>
              <div class="kural-left-content kural-sec">
                <p class="Biogrpaphy">
                  <label class="biography" id="biographys">Section(அதிகாரம்)<span class="mandatory">*</span></label>
                </p>
                <p class="TextAreaWidth">
                  <textarea maxlength="255" id="txtSection" name="txtSection" class="biography1 box-shad box-shad1"><?php if(isset($section)){ echo $section;}else{echo set_value('txtSection');}?>
</textarea>
                </p>
              </div>
              <div class="kural-left-content">
                <p>
                  <label class="txtdisplayname" id="name">Thirukural Font Size (திருக்குறள் எழுத்துரு அளவு்)</label>
                  <span class="mandatory">*</span></p>
                <p class="kural-box">
                  <input id="kural_font" class="box-shad box-shad1" name="kural_font" type="number" min="9" max="12" value="<?php if(isset($fontsize)){ echo ($fontsize==0)? 9: $fontsize;}else{echo set_value('kural_font',9);}?>" >
                </p>
              </div>
              <div class="kural-left-content">
                <div class="tab">
                  <p>
                    <label class="txtdisplayname" id="name">Status</label>
                  </p>
                  <div class="switch switch-blue">
                    <input type="radio" id="status1" name="status" checked="checked"   class="switch-input"  value="1" <?php if(isset($status)){ if($status=='1'){?>checked='checked'<?php }}else{echo set_radio('status','1');}?> >
                    <label for="status1" class="tab-12 switch-label switch-label-off">Active</label>
                    <input type="radio" id="status2" name="status"  class="switch-input" value="0" <?php if(isset($status)){ if($status=='0'){?>checked='checked'<?php }}else{echo set_radio('status','0');}?>  >
                    <label for="status2" class="tab-12 switch-label switch-label-on">Inactive</label>
                    <span class="switch-selection"></span> </div>
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
