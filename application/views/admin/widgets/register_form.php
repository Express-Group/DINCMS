<style>
.din-form sup{top: 0;font-size: 14px !important;color: red;}
.form-error{margin-top: 3px;margin-bottom: 0;color: red;}
.uform-title{text-align:center;margin-top:2%;font-size:16px;font-weight: bold !important;color: #0087ff !important;}
.uform-title1{text-align:center;margin-top:2%;font-size:14px;font-weight: bold !important;color: #ff5703 !important;}
.uform{background: #ededed;padding: 4%;margin-top: 3%;}
</style>
<div class="uform">
<h5 class="uform-title" style="color:red !important;font-size:17px;">சென்னையின் சமையல் ராணி</h5>
<h5 class="uform-title">தினமணி இணையதளம் நடத்தும் பிரம்மாண்ட சமையல் போட்டி - 2018</h5>
<h5 class="uform-title1">பதிவுப் படிவம்</h5>
<h5 class="uform-title1">(பெண்கள் மட்டும்)</h5>
<div class="form-group din-form" style="margin-top:2%;">
	<label>பெயர் <sup>*</sup></label>
	<input type="text" name="uname" class="form-control">
	<p style="display:none;" class="form-error"></p>
</div>
<div class="form-group din-form">
	<label>மின்னஞ்சல் முகவரி <sup>*</sup></label>
	<input type="email" name="email" class="form-control">
	<p style="display:none;" class="form-error"></p>
</div>
<div class="form-group din-form">
	<label>வயது  <sup>*</sup></label>
	<select class="form-control" name="age">
		<option value="">Please Select age</option>
		<?php
			for($i=18;$i<51;$i++):
				echo '<option value="'.$i.'">'.$i.'</option>';
			endfor;
		?>
	</select>
	<p style="display:none;" class="form-error"></p>
</div>
<div class="form-group din-form">
	<label>தொலைபேசி / கைபேசி <sup>*</sup></label>
	<input type="number" name="phnumber" class="form-control">
	<p style="display:none;" class="form-error"></p>
</div>
<div class="form-group din-form">
	<label>முகவரி   (சென்னை மட்டும்)<sup>*</sup></label>
	<textarea name="location" class="form-control"></textarea>
	<p style="display:none;" class="form-error"></p>
</div>
<div class="form-group din-form">
	<label>சமையல் போட்டிகளில் கலந்துகொண்ட முன்அனுபவம் <sup>*</sup></label>
	<div class="radio-inline"><label><input type="radio" name="experience" value="1">ஆம்</label></div>
	<div class="radio-inline"><label><input type="radio" name="experience" value="0">இல்லை</label></div>
	<p style="display:none;" class="form-error exp"></p>
</div>
<div class="form-group text-center din-form">
	<button class="btn btn-primary" id="user_form">Done</button>
</div>
<script>
	$(document).ready(function(){
		$('#user_form').on('click',function(e){
			var uname = $('input[name="uname"]').val();
			var email = $('input[name="email"]').val();
			var age = $('select[name="age"]').val();
			var phnumber = $('input[name="phnumber"]').val();
			var location = $('textarea[name="location"]').val();
			var experience = $('input[name="experience"]:checked').val();
			var namematch = /^[a-zA-Z\s]+$/;
			var emailpattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
			var uerror = false;
			if($.trim(uname)=='' || namematch.test(uname)==false){
				$('input[name="uname"]').next('.form-error').html('Enter valid name').show();
				uerror  =true;
			}else{
				$('input[name="uname"]').next('.form-error').html('').hide();
			}
			if($.trim(email)=='' || !emailpattern.test(email)){
				$('input[name="email"]').next('.form-error').html('Enter valid Email address').show();
				uerror  =true;
			}else{
				$('input[name="email"]').next('.form-error').html('').hide();
			}
			if($.trim(age)=='' || age== undefined){
				$('select[name="age"]').next('.form-error').html('Select valid age').show();
				uerror  =true;
			}else{
				$('select[name="age"]').next('.form-error').html('').hide();
			}
			if($.trim(phnumber)=='' || $.isNumeric(phnumber)==false){
				$('input[name="phnumber"]').next('.form-error').html('Enter valid phone number').show();
				uerror  =true;
			}else{
				$('input[name="phnumber"]').next('.form-error').html('').hide();
			}
			if($.trim(location)==''){
				$('textarea[name="location"]').next('.form-error').html('Enter valid Location').show();
				uerror  =true;
			}else{
				$('textarea[name="location"]').next('.form-error').html('').hide();
			}
			if($.trim(experience)=='' || $('input[name="experience"]').is(':checked')==false){
				$('.exp').html('check valid experience').show();
				uerror  =true;
			}else{
				$('.exp').html('').hide();
			}

			if(uerror==false){
				$.ajax({
					type:'post',
					cache:false,
					url:'<?php echo base_url()?>user/commonwidget/register_form',
					data:{uname:uname , email : email , age:age , phnumber:phnumber, location:location , experience : experience},
					success:function(result){
						if(result==2){
							alert('you have already registered');
						}else if(result==1){
							alert('successfully registered');
							$('input[name="uname"]').val('');
							$('input[name="email"]').val('');
							$('select[name="age"]').val('');
							$('input[name="phnumber"]').val('');
							$('textarea[name="location"]').val('');
						}else{
							alert('something went wrong.please try again');
						}
					},
					error:function(err,errcode){
						console.log('Error');
					}
				})
			}
		});
	});
</script>
</div>