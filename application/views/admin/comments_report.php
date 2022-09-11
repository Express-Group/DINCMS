<link href="<?php echo base_url(); ?>css/admin/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link href="<?php echo base_url(); ?>css/admin/bootstrap.min.css" rel="stylesheet" >
<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/w2ui-fields-1.0.min.css"><?php */?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap/bootstrap-hover-dropdown.min.js"></script>	
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap/bootstrap.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.datetimepicker.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.style-my-tooltips.js"></script>-->
<script>
function get_date(input) {
if(input == '') {
return false;
}	else {
// Split the date, divider is '/'
var parts = input.match(/(\d+)/g);
return parts[2]+'/'+parts[1]+'/'+parts[0];
} 
}

jQuery(function(){
 jQuery('#date_timepicker_start').datetimepicker({
  format:'d-m-Y',
  onShow:function(ct){
   this.setOptions({
	   maxDate:get_date($('#date_timepicker_end').val())?get_date($('#date_timepicker_end').val()):false,
   })
  },
  timepicker:false
 });
 jQuery('#date_timepicker_end').datetimepicker({
  format:'d-m-Y',
  onShow:function(ct){
   this.setOptions({
	   minDate:get_date($('#date_timepicker_start').val())?get_date($('#date_timepicker_start').val()):false,
   })
  },
  timepicker:false
 });
});

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/w2ui-fields-1.0.min.js"></script>-->
<link href="<?php echo base_url(); ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/w2ui-fields-1.0.min.css">-->

<script>
$(document).ready(function() 
{
	$("#search_based_check").change(function()
   {
    if(this.checked) 
     {
     $("#checkin_checkout_div").show();
    } 
    else 
    {
		$("#date_timepicker_start").val('');
     $("#date_timepicker_end").val('');
     $("#checkin_checkout_div").hide();
    }
    $("#checkin_id").val('');
        $("#checkout_id").val('');
   });
	
	
	
});

</script>
</head><body>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft BreadCrumbsWrapper ">
				<div class="breadcrumbs">Dashboard > <?php echo $title; ?></div>
				<h2><?php echo $title.$Sectionname; ?></h2>
			</div>
			<p class="FloatRight SaveBackTop remoda1-bg">
				<?php if($get_sectionid != "")  { ?>
				<a class="FloatLeft back-top" title="Go Back" href="<?php echo base_url().folder_name;?>/comments_ageing_report/"><i class="fa fa-reply fa-2x"></i></a>
				<?php } ?>
				<a href="#" id="export_excel" target="_blank" type="button" class="btn-primary btn"><i class="fa fa-plus-circle"></i>Export to CSV</a></p>
		</div>
		<div class="Overflow DropDownWrapper">
			<div class="container" <?php if($get_sectionid == "")  { ?> style="display:none" <?php } ?>>
				<div id="" class="row AskPrabuCheckBoxWrapper">
					<ul class="AskPrabuCheckBox FloatLeft">
						<!--<li class="has-pretty-child">
							<div class="clearfix prettycheckbox labelright  red">
								<input type="checkbox" id="search_based_check"  class="myClass" value="yes" name="answer">
								<a class=" " href="#"></a>
								<label for="search_based_check">Search Based on Date Range</label>
							</div>
							<a href="#" class=""></a> </li>-->
						<li>
							<p class="CalendarWrapper"  id="checkin_checkout_div">
								<label for="search_based_check">Search Based on Date Range</label>
								<input type="text" value="" id="date_timepicker_start" placeholder="Start Date">
								<input type="text" value="" id="date_timepicker_end" placeholder="End Date">
							</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="FloatLeft Module02" >
				<?php /*?><div class="FloatLeft w2ui-field" <?php if($get_sectionid == "")  { ?> style="display:none" <?php } ?> >
					<label>Section</label>
					<select id="ddsection" class="controls">
					<option value="">All</option>
						<?php if(isset($section_mapping)) { 
				 foreach($section_mapping as $mapping) {   
				$condition = $mapping['Sectionname'] != 'Galleries' && $mapping['Sectionname'] != 'Videos' && $mapping['Sectionname'] != 'Audios' &&  $mapping['Sectionname'] != 'Resources';
				 if($condition) {
				 ?>
						<option id="MainSectionOption" style="color:#933;font-size:18px;" <?php if($mapping['Section_landing'] == 1 && $mapping['Sectionname'] != 'Columns' && $mapping['Sectionname'] != 'Magazine' && $mapping['Sectionname'] != 'The Sunday Standard' && $mapping['Sectionname'] != 'Editorials' ) { ?> disabled='disabled' <?php } ?> class="blog_option" <?php if(set_value("ddMainSection") == $mapping['Section_id'] || (isset($get_article_details['content_id']) && $get_article_details['Section_id'] == $mapping['Section_id'] )) echo  "selected";  ?> sectoin_data="<?php echo @$mapping['Sectionname']; ?>" rel="<?php echo @$mapping['LinkedToColumnist']; ?>"  value="<?php echo $mapping['Section_id']; ?>" url_structure="<?php echo ucwords(str_replace("-"," ",str_replace("/"," > ",trim($mapping['URLSectionStructure'])))); ?>"><?php echo strip_tags($mapping['Sectionname']); ?></option>
						<?php if(!(empty($mapping['sub_section'])) ) { ?>
						<?php foreach($mapping['sub_section'] as $sub_mapping) { ?>
						<option  id="MainSectionOption" <?php if(set_value("ddMainSection") == $sub_mapping['Section_id']  || (isset($get_article_details['content_id']) && $get_article_details['Section_id'] == $sub_mapping['Section_id'] )) echo  "selected"; ?>  sectoin_data="<?php echo @$mapping['Sectionname']; ?>"  rel="<?php echo @$sub_mapping['LinkedToColumnist']; ?>" value="<?php echo $sub_mapping['Section_id']; ?>" url_structure="<?php echo ucwords(str_replace("-"," ",str_replace("/"," > ",trim($sub_mapping['URLSectionStructure'])))); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strip_tags($sub_mapping['Sectionname']); ?></option>
						<?php if(!(empty($sub_mapping['sub_sub_section']))) { ?>
						<?php foreach($sub_mapping['sub_sub_section'] as $sub_sub_mapping) { ?>
						<option id="MainSectionOption" <?php if($sub_sub_mapping['Section_landing'] == 1) { ?> disabled='disabled' <?php } ?>  <?php if(set_value("ddMainSection") == $sub_sub_mapping['Section_id']  || (isset($get_article_details['content_id']) && $get_article_details['Section_id'] == $sub_sub_mapping['Section_id'] )) echo  "selected"; ?>  rel="<?php echo @$sub_sub_mapping['LinkedToColumnist']; ?>" value="<?php echo $sub_sub_mapping['Section_id']; ?>"  sectoin_data="<?php echo @$mapping['Sectionname']; ?>" url_structure="<?php echo ucwords(str_replace("-"," ",str_replace("/"," > ",trim($sub_sub_mapping['URLSectionStructure'])))); ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strip_tags($sub_sub_mapping['Sectionname']); ?></option>
						<?php } } ?>
						<?php  } } ?>
						<?php  } }  }?>
					</select>
				</div><?php */?>
				<div class="FloatLeft w2ui-field" >
					<label>Status</label>
					<select id="ddStatus" name="ddStatus" class="controls">
						<option value="">All</option>
						<?php if($get_sectionid != "")  { ?>
						<option value="P">Published</option>
						<option value="U">Unpublished</option>
						<?php  } else {?>
						<option value="1">Active</option>
						<option value="0">Inactive</option>
						<?php } ?>
					</select>
				</div>
				<button class="btn btn-primary" type="button" id="article_search">Search</button>
				<button class="btn btn-primary" type="button" id="clear_search">Clear Search</button>
			</div>
			<p id="srch_error" class="CheckError" style=" padding-right: 631px !important;"></p>
			<div id="container_datatable" class="display"  style="width:100%; float:left; ">
				<div id="work_list" class="display">
					<div class="role-dpt">
						<table id="example" class="display comments_report" cellspacing="0" width="100%">
							<thead>
								<?php if($get_sectionid != "")  { ?>
								<tr>
									<th>Title</th>
									<th>Status</th>
									<th>1 Day < </th>
									<th>3 Day < </th>
									<th>5 Day < </th>
									<th>30 Day < </th>
									<th>More than 30 Days</th>
									<th>Total</th>
								</tr>
								<?php  } else {?>
								<tr>
									<th>Section name</th>
									<th>Parent section</th>
									<th>Status</th>
									<th>1 Day < </th>
									<th>3 Day < </th>
									<th>5 Day < </th>
									<th>30 Day < </th>
									<th>More than 30 Days</th>
									<th>Total</th>
								</tr>
								<?php } ?>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<script>
$(document).ready(function() {
	$('#example').dataTable( 
{
} );
	
	comments_datatable();
	
	$('#txtSearch').keypress(function (e) {
		if($.trim($('#txtSearch').val()) != '') {
		 var key = e.which;
		 if(key == 13)  {
			 comments_datatable();
		  }  
		}
	});
	
	$("#clear_search").click(function() {
		//$("#ddsection").val('');
		$("#ddStatus").val('');
		$("#date_timepicker_start").val('');
		$("#date_timepicker_end").val('');
		
		comments_datatable();
	});

	});
	
		
	function comments_datatable() {
	
	var section_id = "";	
	<?php if($get_sectionid != "")  { ?>
	var section_id = <?php echo $get_sectionid; ?>;	
	<?php  } ?>
	
	var content_type = "";	
	<?php if($content_type != "")  { ?>
	var content_type = <?php echo $content_type; ?>;	
	<?php  } ?>
	
	var fromdate=$( "#date_timepicker_start").val();
	var todate=$( "#date_timepicker_end").val();
	var status=$( "#ddStatus" ).val();
	
	
    $('#example').dataTable( {
		
        "processing": true,
        "bServerSide": true,
		 "bDestroy": true,
		 "autoWidth": false,
		  "searching": false,
		"iDisplayLength": 50,
		
				oLanguage: {
        sProcessing: "<img src='<?php echo base_url(); ?>images/admin/loadingroundimage.gif' style='width:40px; height:40px;'>"
    },

		"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [1, 2, 3, 4, 5, 6, 7] }
       ],	
		
		"fnDrawCallback":function(oSettings )
		{
			   $("html, body").animate({ scrollTop: 0 }, "slow");
			 
   			 if($('span a.paginate_button').length <= 1) {
			 $("#example_paginate").hide();
		   } else {
			 $("#example_paginate").show();
		   }
		   if($(this).find('tbody tr').text()== "No matching records found")
		   {
			  $(oSettings.nTHead).hide(); 
			  $('.dataTables_info').hide();
			  $("#example_length").hide();
			   $("#example").find('tbody tr')
    .append($('<td class="BackArrow"><a href="<?php  echo base_url().folder_name; ?>/comments_ageing_report" data-toggle="tooltip" title="Back to list"><i class="fa fa-reply fa-2x"></i></a></td>'));
		   }
		   else
		   {
			   $(oSettings.nTHead).show(); 
		   }
		  
		},
		
		"ajax": {
            "url": "<?php echo base_url().folder_name; ?>/comments_ageing_report/comments_datatable",
			"type" : "POST",
			//"data" : { "from_date" : fromdate, "to_date" : todate, "cntent_type" : cntent_type, "status":status, "section_id":section_id },
	 		"data"	: function(d) {
						d.from_date= fromdate;
						d.to_date= todate;
						d.status=status;
						d.content_type=content_type;
						d.sectionid= section_id;
						d.archieve_total_count =  $(".archieve_total_count").val();
						d.archieve_previous_count =  $(".archieve_previous_count").val();
					},
		
		/*success:function(data)
		{
       
      	 	alert(data);
    	}*/
			
		 },
    } );
		
	}
		
	

</script> 
			<script>
$(document).ready(function()
{
	
		$('body').keypress(function (e) {
			
			if(e.which == 13) {
				$("#article_search").click();
			}
			
		});
	
	
	$("#article_search").click(function()
 	{
    	comments_datatable();
 	});
	
	$("#export_excel").click(function()
	{
		var section_id = "";	
		<?php if($get_sectionid != "")  { ?>
		var section_id = <?php echo $get_sectionid; ?>;	
		<?php  } ?>
		
		var content_type = "";	
		<?php if($content_type != "")  { ?>
		var content_type = <?php echo $content_type; ?>;	
		<?php  } ?>
		
		var from_date=$( "#date_timepicker_start").val();
		var to_date=$( "#date_timepicker_end").val();
		
		//alert(content_type);
		$(this).attr("href", "<?php echo base_url().folder_name;?>/comments_ageing_report/article_excel?section_id="+section_id+"&type="+content_type+"&from="+from_date+"&to="+to_date+"");
	});
});
</script> 
		</div>
	</div>
</div>
</body>
</html>