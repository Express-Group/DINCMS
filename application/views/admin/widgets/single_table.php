<style>
.table-tn{border: 1px solid #143b5a;}
.table-tn thead tr:first-child{background: #143b5a;color: #fff;}
.table-tn thead tr:last-child{background: #6fa6d1;color: #143b5a;}
.table-tn>tbody>tr>td, .table-tn>tbody>tr>th, .table-tn>tfoot>tr>td, .table-tn>tfoot>tr>th, .table-tn>thead>tr>td, .table-tn>thead>tr>th , .table-tn>thead>tr>th{border-top: none;border-bottom: none;}
.table-tn tbody .first-tr{font-weight:700;}
.table-tn tbody .second-tr:nth-child(even){background: #f2f2f2;}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 single-table">
		
	</div>
</div>
<script>
$(document).ready(function(e){
	$.ajax({
		type:'post',
		cache:false,
		url:'<?php echo BASEURL; ?>user/commonwidget/single_table',
		data:{ 'type' : '1'},
		success:function(result){
			$('.single-table').html(result);
		},
		error:function(err, errmsg){
			console.log(err);
			console.log(errmsg);
		}
	});
});
</script>