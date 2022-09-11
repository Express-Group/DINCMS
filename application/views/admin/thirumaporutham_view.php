<?php
if($this->input->get('date')!=''){
	$selectedDate = $this->input->get('date');
}else{
	$selectedDate = date('Y-m-d');
}
?>
<link href="<?php echo image_url ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="<?php echo image_url ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
<style>
.btn-new{padding: 11px 12px !important;}
#thirumanaporutham_table{margin-top:2%;}
.pager{float:left;width:100%;margin-top:2%;text-align:center;margin-bottom:2%;}
.pager a , .pager strong{padding: 6px 11px 6px;font-size: 15px;color: #fff;margin-right: 2px;background: #3c8dbc;border-radius: 3px;}
.pager strong{background: #a3d3e9;color: #000;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> &gt; <a href="#">Thirumanaporutham Manager</a></div>
				<h2>Thirumanaporutham Manager</h2>
			</div>
		</div>
		
		<div class="Overflow DropDownWrapper">
			<div class="FloatLeft TableColumn">
				<div class="FloatLeft TableColumnSearch">
					<input type="search" value="<?php echo $selectedDate ?>" placeholder="Search" class="SearchInput" id="search_text" readonly>
				</div>
				<button class="btn btn-primary btn-new" type="button" id="porutham_search">Search</button>
				<button class="btn btn-primary btn-new" id="clear_search">Clear Search</button>
				<button class="btn btn-primary btn-new" id="downloadfile">Download</button>
				<p style="float:right;margin-top: 12px;font-weight: bold;color: green;"> Total rows : <?php echo $total_rows; ?></p>
			</div>
			<div class="example_wrapper">
				<table id="thirumanaporutham_table">
					<thead>
						<tr>
							<th>மணமகள்  பெயர்</th>
							<th>மணமகன்  பெயர்</th>
							<th>Email Address</th>
							<th>Created On</th>
							<th>STATUS</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($records as $data):
								echo '<tr>';
								echo '<td>'.$data->manapen_peyar.'</td>';
								echo '<td>'.$data->manamagam_peyar.'</td>';
								echo '<td>'.$data->email.'</td>';
								echo '<td>'.$data->created_on.'</td>';
								if($data->otp_verified=='0'){
									echo '<td style="color:red;">OTP NOT VERIFIED</td>';
								}else if($data->result_status=='0'){
									echo '<td style="color:yellow;">RESULT NOT VIEWED</td>';
								}else{
									echo '<td style="color:green;">VIEWED RESULT</td>';
								}
								echo '<td><a style="color: #3c8dbc;" href="'.base_url().folder_name.'/thirumanaporutham_master/view_data/'.base64_encode($data->tmid).'" target="_BLANK"><i class="fa fa-eye" aria-hidden="true"></i> view</a></td>';
								echo '</tr>';
							endforeach;
						?>
					</tbody>
				</table>
				<div class="pager"><?php echo $pagination; ?></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url ?>js/jquery.datetimepicker.js"></script>
<script>
$(document).ready(function() {
    $('#thirumanaporutham_table').DataTable({
		"bPaginate": false,
		"bSort" : false,
	});
	$('#search_text').datetimepicker({
		format: 'Y-m-d',
		defaultDate : '<?php echo $selectedDate ?>'
		 
	});
	$('#porutham_search').on('click',function(e){
		var selected_date = $('#search_text').val();
		window.location.href = "<?php echo base_url() ?>"+folder_name+'/thirumanaporutham_master?date='+selected_date;
	});
	$('#clear_search').on('click',function(e){
		window.location.href = "<?php echo base_url() ?>"+folder_name+'/thirumanaporutham_master';
	});
	$('#downloadfile').on('click',function(){
		var selected_date = $('#search_text').val();
		window.location.href = "<?php echo base_url() ?>"+folder_name+'/thirumanaporutham_master/download?date='+selected_date;
	});
} );
</script>