<?php /*$set_uset_id = $this->session->userdata('userID'); 
if($set_uset_id == "")
{
	redirect('admin/user_login');
}*/
?>


<style>
.MainTitle{
	 font-size: 40px;
    text-align: center;
	height:500px;
	}
.MainTitle p:first-child{
	padding-top:200px;
	}
.MainTitle p{
	line-height:50px;
	font-family:Arial, Helvetica, sans-serif;
	}
	.modal-dialog{
	z-index: 99999;
	margin-top: 7% !important;
}
#conrona_virus .form-group , #conrona_table .form-group , #revision_table .form-group{width:100% !important;}
#conrona_virus .form-control , #conrona_table .form-control , #revision_table .form-control{border: 1px solid #eee !important;}
#co_table_dy input[type="text"]{width:100%;}
</style>
<link href="<?php echo image_url ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<script type="text/javascript" src="<?php echo image_url ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/bootstrap/bootstrap.min.js"></script>
<div class="MainTitle">
<div class="menus-custom text-center" style="float: left;width: 100%; margin-top: 8%;">
<!--<button class="btn-primary btn" style="font-size: 16px !important; margin-left: 2%;" id="c_virus">Coronavirus</button>
<button class="btn-primary btn" style="font-size: 16px !important;" id="ct_virus">Coronavirus Table</button>-->
<button class="btn-primary btn" style="font-size: 16px !important;" id="revision">Revision 2020</button>
</div>
<p>Welcome</p>
<p>To</p>
<p>Dinamani</p>
<p>CMS System</p>
<br/>
<p>Version : 1.0</p>
</div>

<div id="conrona_virus" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CORONA VIRUS</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label>Active case in india <sup>*</sup></label>
			<input type="number" class="form-control" id="active_case_india">
		</div>
		<div class="form-group">
			<label>Deaths in india <sup>*</sup></label>
			<input type="number" class="form-control" id="deaths_case_india">
		</div>
		<div class="form-group">
			<label>Recovered case in india <sup>*</sup></label>
			<input type="number" class="form-control" id="re_case_india">
		</div>
		<div class="form-group">
			<label>Active case in World <sup>*</sup></label>
			<input type="number" class="form-control" id="active_case_world">
		</div>
		<div class="form-group">
			<label>Deaths in World <sup>*</sup></label>
			<input type="number" class="form-control" id="deaths_case_world">
		</div>
		<div class="form-group">
			<label>Recovered case in World <sup>*</sup></label>
			<input type="number" class="form-control" id="re_case_world">
		</div>
		<div class="form-group">
			<label>Active case in Tamilnadu <sup>*</sup></label>
			<input type="number" class="form-control" id="active_case_tamilnadu">
		</div>
		<div class="form-group">
			<label>Deaths in Tamilnadu <sup>*</sup></label>
			<input type="number" class="form-control" id="deaths_case_tamilnadu">
		</div>
		<div class="form-group">
			<label>Recovered case in Tamilnadu <sup>*</sup></label>
			<input type="number" class="form-control" id="re_case_tamilnadu">
		</div>
		<div class="form-group">
			<label>Landing Url <sup>*</sup></label>
			<input type="text" class="form-control" id="re_url">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="save_corona()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="conrona_table" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CORONA VIRUS TABLE</h4>
      </div>
      <div class="modal-body">
			<table class="table table-bordered" id="co_table_dy">
				<thead>
					<tr class="text-center">
						<td><label> <input type="checkbox" id="country"> Hide</label></td>
						<td><label> <input type="checkbox" id="active_cases"> Hide</label></td>
						<td><label> <input type="checkbox" id="deaths"> Hide</label></td>
						<td><label> <input type="checkbox" id="recovered"> Hide</label></td>
						<td>-</td>
					</tr>
					<tr class="text-center">
						<td>நாடு</td>
						<td>பாதிப்பு</td>
						<td>உயிரிழப்பு</td>
						<td>மீட்கப்பட்டது</td>
						<td>-</td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="add_field">Add Field</button>
        <button type="button" class="btn btn-primary" onclick="save_corona_table()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="revision_table" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">REVISION 2020</h4>
      </div>
      <div class="modal-body">
		<div style="padding: 2%;border-radius: 5px;border: 1px solid #eee;">
			<div class="form-group">
				<label>Author Name <sup>*</sup></label>
				<input type="text" name="author_name" class="form-control">
			</div>
			<div class="form-group">
				<label>Description <sup>*</sup></label>
				<textarea name="description" class="form-control"></textarea>
			</div>
			<div class="form-group text-right">
				 <input type="hidden" name="rid" value="">
				 <button type="button" class="btn btn-primary" id="save_revision">Save</button>
			</div>
		</div>
		<div id="revision_content" style="padding:2%;border-radius: 5px;border: 1px solid #eee;margin-top:2%;">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
$('#revision').on('click' , function(){
	get_revision();
	$("#revision_table").modal({backdrop: "static"});
});
$(document).on('click' , '.edit_revision' ,function(){
	var rid = $(this).parent().data('rid');
	var author = $(this).parent().data('author');
	var description = $(this).parent().data('description');
	$('input[name="author_name"]').val(author);
	$('textarea[name="description"]').val(description);
	$('input[name="rid"]').val(rid);
	 alert('scroll to top');
});
$('#save_revision').on('click' , function(e){
	var author = $('input[name="author_name"]').val().trim();
	var description = $('textarea[name="description"]').val().trim();
	var rid = $('input[name="rid"]').val().trim();
	if(author!='' && description!=''){
		$.ajax({
			type:'post',
			cache:false,
			url : '<?php echo base_url(folder_name) ?>/specialwidget/save_revision',
			data : {'author' : author , 'description' : description , 'rid' : rid},
			success:function(res){
				if(res=='1'){
					$('input[name="author_name"]').val('');
					$('textarea[name="description"]').val('');
					$('input[name="rid"]').val('');
					get_revision();
				}else{
					alert('Something went wrong..please try again');
				}
			},
			error:function(err , errcode){
				alert('404');
			}
		});
	}else{
		alert('Please fil the required fields');
	}
});
$('#c_virus').on('click' , function(){
	$.ajax({
			type:'post',
			cache:false,
			url : '<?php echo base_url(folder_name) ?>/specialwidget/get_corona',
			dataType:'json',
			success:function(res){
				$('#active_case_india').val(res.active_case_india);
				$('#deaths_case_india').val(res.deaths_case_india);
				$('#re_case_india').val(res.re_case_india);
				$('#active_case_world').val(res.active_case_world);
				$('#deaths_case_world').val(res.deaths_case_world);
				$('#re_case_world').val(res.re_case_world);
				$('#active_case_tamilnadu').val(res.active_case_tamilnadu);
				$('#deaths_case_tamilnadu').val(res.deaths_case_tamilnadu);
				$('#re_case_tamilnadu').val(res.re_case_tamilnadu);
				$('#re_url').val(res.url);
				$("#conrona_virus").modal({backdrop: "static"});
			},
			error:function(err , errcode){
				alert('404');
			}
		});
});
$('#ct_virus').on('click' , function(e){
	$.ajax({
			type:'post',
			cache:false,
			url : '<?php echo base_url(folder_name) ?>/specialwidget/get_coronatable',
			dataType:'json',
			success:function(res){
				$('#country').prop('checked' , false);
				$('#active_cases').prop('checked' , false);
				$('#deaths').prop('checked' , false);
				$('#recovered').prop('checked' , false);
				if(res.country=='1'){
					$('#country').prop('checked' , true);
				}
				if(res.active_cases=='1'){
					$('#active_cases').prop('checked' , true);
				}
				if(res.deaths=='1'){
					$('#deaths').prop('checked' , true);
				}
				if(res.recovered=='1'){
					$('#recovered').prop('checked' , true);
				}
				
				$('#co_table_dy').find('tbody').html(res.ipnuts);
				$("#conrona_table").modal({backdrop: "static"});
			},
			error:function(err , errcode){
				alert('404');
			}
		});
	$("#conrona_table").modal({backdrop: "static"});
});
$('#add_field').on('click' , function(e){
	var count = (Math.floor(Math.random() * 100000000) + 1) + $($('#co_table_dy').find('tbody')).find('tr').length;
	var template = '<tr class="tr-'+count+'">';
	template += '<td><input type="text"></td>';
	template += '<td><input type="text"></td>';
	template += '<td><input type="text"></td>';
	template += '<td><input type="text"></td>';
	template += '<td><button class="btn btn-primary" onclick="remove_tr('+count+')">X</button></td>';
	template += '</tr>';
	$('#co_table_dy').find('tbody').append(template);
});

function remove_tr(id){
	$('.tr-'+id).remove();
}

function save_corona_table(){
	var country = 0;
	var active_cases = 0;
	var deaths = 0;
	var recovered = 0;
	if($("#country").is(":checked")){ country = 1; }
	if($("#active_cases").is(":checked")){ active_cases = 1; }
	if($("#deaths").is(":checked")){ deaths = 1; }
	if($("#recovered").is(":checked")){ recovered = 1; }
	var countrydata = [];
	var active_casesdata = [];
	var deathsdata = [];
	var recovereddata = [];
	$($('#co_table_dy').find('tbody')).find('tr').each(function(index){
		//alert($($(this).find('td').eq(0)).find('input').val());
		countrydata.push($($(this).find('td').eq(0)).find('input').val());
		active_casesdata.push($($(this).find('td').eq(1)).find('input').val());
		deathsdata.push($($(this).find('td').eq(2)).find('input').val());
		recovereddata.push($($(this).find('td').eq(3)).find('input').val());
	});
	$.ajax({
			type:'post',
			cache:false,
			url : '<?php echo base_url(folder_name) ?>/specialwidget/corona_table',
			data:{'country' : country , 'active_cases' : active_cases ,'deaths' : deaths , 'recovered' : recovered , 'countrydata' : countrydata , 'active_casesdata' : active_casesdata , 'deathsdata' :deathsdata ,  'recovereddata' :recovereddata},
			success:function(res){
				if(res==1){
					toastr.success('table updated successfully');
					$("#conrona_table").modal("toggle");
				}else{
					toastr.error('something went wrong..please try again');
				}
			},
			error:function(err , errcode){
				alert('404');
			}
		});
}
function save_corona(){
	toastr.remove();
	var active_case_india = $('#active_case_india').val();
	var deaths_case_india = $('#deaths_case_india').val();
	var re_case_india = $('#re_case_india').val();
	var active_case_world = $('#active_case_world').val();
	var deaths_case_world = $('#deaths_case_world').val();
	var re_case_world = $('#re_case_world').val();
	var active_case_tamilnadu = $('#active_case_tamilnadu').val();
	var deaths_case_tamilnadu = $('#deaths_case_tamilnadu').val();
	var re_case_tamilnadu = $('#re_case_tamilnadu').val();
	var re_url = $('#re_url').val();
	if(active_case_india!='' && deaths_case_india!='' && re_case_india!='' && active_case_world!='' && deaths_case_world!='' && re_case_world!='' && re_url!='' && active_case_tamilnadu!='' && deaths_case_tamilnadu!='' && re_case_tamilnadu!=''){
		$.ajax({
			type:'post',
			cache:false,
			url : '<?php echo base_url(folder_name) ?>/specialwidget/corona',
			data:{'active_case_india' : active_case_india , 'deaths_case_india' : deaths_case_india ,'re_case_india' : re_case_india , 'active_case_world' : active_case_world , 'deaths_case_world' : deaths_case_world , 're_case_world' : re_case_world , 're_url' :re_url, 'active_case_tamilnadu' : active_case_tamilnadu , 'deaths_case_tamilnadu' : deaths_case_tamilnadu , 're_case_tamilnadu' :re_case_tamilnadu},
			success:function(res){
				if(res==1){
					toastr.success('Details updated successfully');
					$("#conrona_virus").modal("toggle");
				}else{
					toastr.error('something went wrong..please try again');
				}
			},
			error:function(err , errcode){
				alert('404');
			}
		});
	}else{
		toastr.error('Enter valid details');
	}
}

function get_revision(){
	$.get("<?php echo base_url(folder_name) ?>/specialwidget/get_revision", function(data, status){
		$('#revision_content').html(data);
  });
}
</script>