<link href="<?php echo image_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<link href="<?php echo image_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo image_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style>
.pager a , .pager strong{background: #007caa;color: #fff;padding: 6px 12px 6px;margin-right: 10px;border: 1px solid #007caa;}
.pager strong{background:#fff;color:#007caa;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> > <a href="#"><?php echo $title; ?></a></div>
				<h2><?php echo $title; ?></h2>
			</div> 
			 <p class="FloatRight SaveBackTop"><a href="<?php echo base_url(folder_name) ?>/election_master/add" class="btn-primary btn"><i class="fa fa-plus-circle"></i> &nbsp;Add constituency</a></p>
		</div>
		<div class="Overflow DropDownWrapper">
			<div class="container">
				<form method="get">
				<div class="FloatLeft TableColumn">
					<div class="FloatLeft w2ui-field">
						<select name="status" class="controls">
							<option value="">Please select any one</option>
							<option value="1" selected>Active</option>
							<option value="0" >Inactive</option>
						</select>	
					</div>
					<div class="FloatLeft TableColumnSearch">
						<input type="search" placeholder="Search constituency" class="SearchInput" name="query" value="<?php echo $this->input->get('query'); ?>">
					</div>
					<button class="btn btn-primary" type="submit" id="article_search_id">Search</button>
					<button onclick="window.location.href='<?php echo base_url(folder_name);?>/election_master'" class="btn btn-primary" type="button">Clear Search</button>
				</div>
				</form>
				
				<table id="example" class="display" cellspacing="0" width="100%" style="margin-top: 1%;">
					<thead>
						<tr>
							<th>SL NO</th>
							<th>CONSTITUENCY NAME</th>
							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						foreach($data as $result){
							echo '<tr>';
							echo '<td>'.$i.'</td>';
							echo '<td>'.$result->constituency_name.'</td>';
							echo '<td>';
							if($result->status==1){
								echo '<span class="label label-success">Active</span>';
							}else{
								echo '<span class="label label-danger">Inactive</span>';
							}
							echo '</td>';
							echo '<td>';
							echo '<a class="btn btn-primary" href="'.base_url(folder_name).'/election_master/edit/'.$result->eid.'"><i class="fa fa-pencil"></i></a>';
							if($result->status==1){
								echo '<a style="margin-left:5px;" class="btn btn-primary" href="'.base_url(folder_name).'/election_master/status/'.$result->eid.'?status=0"><i style="color:#fff;" class="fa fa-times"></i></a>';
							}else{
								echo '<a style="margin-left:5px;" class="btn btn-primary" href="'.base_url(folder_name).'/election_master/status/'.$result->eid.'?status=1"><i style="color:#fff;" class="fa fa-check"></i></a>';
							}
							echo '</td>';
							echo '</tr>';
							$i++;
						}
						?>
					</tbody>
				</table>
				<div class="pager">
				<?php echo $pagination;	?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/bootstrap.min.js"></script>
<script type="text/javascript">
$('#example').dataTable({ "bPaginate": false  , "bSort" : false});
</script>