<link href="<?php echo image_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<link href="<?php echo image_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo image_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style>
.pager{float: left;width: 100%;text-align: center;margin-top: 10px;}	
.pager a , .pager strong{background: #3c8dbc;color: #fff;padding: 4px 8px 4px;   margin-right: 5px;}
.pager strong{background: #ddd;}
.modal-dialog{top:5%;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> &gt; <a href="#">Tag Manager</a></div>
				<h2>Tag Manager</h2> 	
				
			</div> 
			<p class="FloatLeft"> <h3 style="text-align: center;" id="add_tags">Add  Tag</h3> </p>
			<p class="FloatRight SaveBackTop">
				<input value="<?php echo $this->input->get('q'); ?>" id="search_box" type="text" placeholder="Enter tag ID/Name">
			</p>
		</div>
		<div class="Overflow DropDownWrapper">
			<div id="example_wrapper">
				<table id="example">
					<thead>
						<tr>
							<th>Tag Id</th>
							<th>Tag Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach($data as $tags):
						echo '<tr>';
						echo '<td>'.$tags->tag_id.'</td>';
						echo '<td>'.$tags->tag_name.'</td>';
						echo '<td><button onclick="delete_tag('.$tags->tag_id.')" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>';
						echo '</tr>';
					endforeach;
					?>
					</tbody>
				</table>
				<div class="pager">
				<?php echo $links; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="article_details" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">ARTICLE DETAILS</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" tag_id="" id="proceed" class="btn btn-primary">Proceed</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
  </div>

  <!--  Add Tag -->
<div class="modal fade" id="add_tag" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Tags </h4>
				</div>
				<div class="modal-body1">
				</div>
				<div class="modal-footer">
					<button type="button" id="add_tag_save" class="btn btn-primary">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
  </div>

  <!--  End  Tag -->
</div>
 
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo image_url; ?>js/bootstrap.min.js"></script>
<script  type="text/javascript">
$('#example').dataTable({
	"paging":   false,
	"ordering": false,
	"info":     false
});
$('#proceed').on('click' , function(e){
	var tag_id = $(this).attr('tag_id');
	$.ajax({
		type:'post',
		url:'<?php echo base_url(folder_name."/tag_master/remove_tag") ?>',
		data:{'id' : tag_id},
		success:function(result){
			if(result==1){
				location.reload();
			}
		},
		error:function(err , errcode){
			console.log(errcode);
			console.log(err.status);
			console.log(err.statusText);
		}
	});
});
$('#search_box').on('keyup' ,function(e){
	if(e.which===13){
		window.location.href = '<?php echo base_url(folder_name."/tag_master?q=") ?>'+$(this).val();
	}
})
function delete_tag($id){
	toastr.remove();
	$.ajax({
		type:'post',
		url:'<?php echo base_url(folder_name."/tag_master/get_details") ?>',
		data:{'id' : $id},
		dataType:'json',
		success:function(result){
			//alert(result.table);
			//alert(result);
			$('#article_details').find('.modal-body').html(result.table);
			if(result.count > 0){
				toastr.success(result.count+' Reords Found');
			}else{
				toastr.warning('No Reords Found');
			}
			$("#article_details").modal({backdrop: "static"});
			$('#proceed').attr('tag_id' , $id);
		},
		error:function(err , errcode){
			console.log(errcode);
			console.log(err.status);
			console.log(err.statusText);
		}
	});
}


$('#add_tags').on('click' , function(e){
	$.ajax({
		type:'post',
		url:'<?php echo base_url(folder_name."/tag_master/add_tag") ?>',
	
		success:function(result){
			
			alert(result);
			$('#add_tag').find('.modal-body1').html(result);
			$("#add_tag").modal({backdrop: "static"});
//			$('#add_tag_save').attr('tag_name' , $id);
			
		},
		error:function(err , errcode){
			console.log(errcode);
			console.log(err.status);
			console.log(err.statusText);
		}
	});
});


$('#add_tag_save').on('click' , function(e){
	var tag_name = $("#tag_name").val();	
	$.ajax({
		type:'post',
		url:'<?php echo base_url(folder_name."/tag_master/save_tag") ?>',
		data:{'id' : tag_name},
		success:function(result){		
			if(result >1){
				toastr.success('Tag Saved succesfully');
				location.reload();
			}
		},
		error:function(err , errcode){
			console.log(errcode);
			console.log(err.status);
			console.log(err.statusText);
		}
	});
});

</script>