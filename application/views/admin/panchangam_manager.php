<?php $script_url = image_url; ?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
<!--<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">-->
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<link href="<?php echo $script_url; ?>css/admin/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
<!-- tool tip begins-->
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.style-my-tooltips.js"></script>
<script>
  jQuery.noConflict();
  (function($){
   $(document).ready(function(){
    $("[title]").style_my_tooltips({ 
     tip_follows_cursor:false, //boolean
     tip_delay_time:700, //milliseconds
     tip_fade_speed:500 //milliseconds
    });
    //dynamically added elements demo function
    $("a[rel='add new element']").click(function(e){
     e.preventDefault();
     $(this).attr("title","Add another element").parent().after("<p title='New paragraph title'>This is a new paragraph! Hover to see the title.</p>");
    });
   });
  })(jQuery);
 </script>
<!-- tool tip ends -->

<script src="<?php echo $script_url; ?>js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/bootstrap/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.validate.min.js"></script>

<!--calendar begind-->
<link href="<?php echo $script_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<?php /*?><script src="<?php echo base_url(); ?>js/jquery.js"></script><?php */?>
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.datetimepicker.js"></script>
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
 
jQuery("#date_timepicker_start").change(function(){
if (jQuery('#date_timepicker_end').val()=="") {
jQuery('#date_timepicker_end').val(jQuery('#date_timepicker_start').val());
}
});
jQuery("#date_timepicker_end").change(function(){
if (jQuery('#date_timepicker_start').val()=="") {
jQuery('#date_timepicker_start').val(jQuery('#date_timepicker_end').val());
}
});
});



function delete_poll(value)
{
	var r = confirm("Are you sure want to delete this Poll Question?");
	if(r)
	{
		window.location = "<?php echo base_url(); ?>dmcpan/panchangam_manager/delete_data/"+value;
	}		
}
</script>

<!--calendar ends-->

<script type="text/javascript">   
function delete_panchangam_value(id)
{
	 var confirm_box = confirm("Are you sure want to delete the panchangam details?");
	 if(confirm_box == true)
	 {
		 window.location = "<?php echo base_url(); ?>dmcpan/panchangam_manager/delete_data/"+id;
	 }
}

</script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $script_url; ?>js/w2ui-fields-1.0.min.js"></script>
<link href="<?php echo $script_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs">Dashboard > <?php echo $title; ?></div>
				<h2><?php echo $title; ?></h2>
			</div>
			<?php if(($this->session->flashdata("success"))) { ?>
			<div id="flash_msg_id" class="FloatLeft SessionSuccess"><?php echo $this->session->flashdata("success");?></div>
			<?php } ?>
			<?php if(($this->session->flashdata("error"))) { ?>
			<div id="flash_msg_id" class="FloatLeft SessionError"><?php echo $this->session->flashdata("error");?></div>
			<?php } ?>
			<div id="activatedmessage" class="FloatLeft SessionSuccess" style="display:none">Activated Successfully.</div>
			<div id="deactivatedmessage" class="FloatLeft SessionSuccess" style="display:none">Deactivated Successfully.</div>
			<div id="deletedmessage" class="FloatLeft SessionSuccess" style="display:none ">Deleted Successfully.</div>
			<?php $data['Menu_id'] = get_menu_details_by_menu_name('Panchangam'); ?>
			<?php if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD".$data['Menu_id']) == '1') { ?>
			<p class="FloatRight SaveBackTop"><a href="<?php echo base_url();?>dmcpan/panchangam_manager/add_panchangam" class="btn-primary btn"><i class="fa fa-file-text-o"></i> &nbsp;Add New</a></p>
			<?php } ?>
		</div>
		<div class="Overflow DropDownWrapper">
			<!--<div class="container">
				<div class="row AskPrabuCheckBoxWrapper">
					<ul class="AskPrabuCheckBox FloatLeft">
						<li id="checkin_checkout_div">
							<p class="CalendarWrapper" >
								<label class="include_label HeadTopAuto"  for="search_based_date">Search Based on Date Range</label>
								<input type="text" placeholder="Start Date" id="date_timepicker_start" value="">
								<input type="text" placeholder="End Date" id="date_timepicker_end" value="">
							</p>
						</li>
					</ul>
				</div>
			</div>-->
			<div class="FloatLeft TableColumn"> 
				
				<!--<div class="FloatLeft w2ui-field">
					<select id="article_status" class="controls">
						<option value="">Status: All</option>
					</select>	
				</div>-->
				
				<!--<div class="FloatLeft w2ui-field">
					<select id="search_by" class="controls">
						<option value="">Search By: All</option>
						<option value="date">Scheduled date</option>
						<option value="created_by" >Created By</option>
					</select>
				</div>-->
				<!--<div class="FloatLeft TableColumnSearch">
					<input type="search" placeholder="Search" class="SearchInput" id="search_text" >
				</div>-->
				<!--<i class="fa fa-search FloatLeft" id="article_search_id"></i>-->
				
				<p class="CalendarWrapper" >
					<label class="include_label HeadTopAuto"  for="search_based_date">Search Based on Scheduled Date Range</label>
					<input type="text" placeholder="Start Date" id="date_timepicker_start" value="">
					<input type="text" placeholder="End Date" id="date_timepicker_end" value="">
							
					<button class="btn btn-primary" type="button" id="article_search_id">Search</button>
					<button class="btn btn-primary" type="button" id="clear_search">Clear Search</button>
				</p>
							
				<p id="srch_error" style="clear: left; color:#F00"></p>
			</div>
			
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
					<tr> 
						<!--<th>ID</th>-->
						<th>Scheduled Date</th>
						<th>Submitted By</th>
						<th>Created On</th>
						<!--<th>Status</th>-->
						<?php if((defined("USERACCESS_DELETE".$data['Menu_id']) && constant("USERACCESS_DELETE".$data['Menu_id']) == '1') || (defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == '1' )) { ?>
						<th>Action</th>
						<?php } ?>
					</tr>
				</thead>
			</table>
		</div>
		<script type="text/javascript">

$(document).ready(function() {

$('body').keypress(function (e) {
			
			if(e.which == 13) {
				$("#article_search_id").click();
			}
			
		});

$("#flash_msg_id").show();
$("#flash_msg_id").slideDown(function() {
    setTimeout(function() {
        $("#flash_msg_id").slideUp();
    }, 5000);
});


$('#txtSearch').keypress(function (e) {
		if($.trim($('#txtSearch').val()) != '') {
		 var key = e.which;
		 if(key == 13)  {
			 panchangam_datatable();
		  }  
		}
	});
	$("#clear_search").click(function() {
	$("#search_by").val('');
	$("#search_text").val('');
	$("#date_timepicker_start").val('');
	$("#date_timepicker_end").val('');
	//$("#ddStatus").val('');
	
	panchangam_datatable();
	});

	function panchangam_datatable() {
		
		 $("#example_length").hide();
		 
	var Search_text = $("#search_text").val();
	var SearchBy	= $("#search_by").val();
	var check_in	= $("#date_timepicker_start").val();
	var check_out   = $("#date_timepicker_end").val();
	var Status		= '';
	
    $('#example').dataTable( {
		oLanguage: {
        sProcessing: "<img src='<?php echo base_url(); ?>images/admin/loadingroundimage.gif' style='width:40px; height:40px;'>"
    },
        "processing": true,
		 "autoWidth": false,
        "bServerSide": true,
		 "bDestroy": true,
		  "searching": false,
		"iDisplayLength": 10,
		"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1 ] }
       ],
		"aaSorting": [[2,'desc']], // Default sorting for table
		"fnDrawCallback":function(oSettings){
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
			  $("#example").find('tbody tr').append($('<td class="BackArrow"><a href="<?php echo base_url(); ?>dmcpan/panchangam_manager" data-toggle="tooltip" title="Back to list"><i class="fa fa-reply fa-2x"></i></a></td>'));
			 }
			 else
			 {
			  $(oSettings.nTHead).show(); 
			 }
	 
		},
		
		"ajax": {
            "url": "<?php echo base_url(); ?>dmcpan/panchangam_manager/panchangam_datatable",
			"type" : "POST",
			"data" : {
		 "search_by" : SearchBy, "searchtxt" : Search_text, "from_date" : check_in, "to_date" : check_out}
		 }
    } );
	
	 
		
	}
			panchangam_datatable();
			
	
	
	
	$("#article_search_id").click(function()
	{
		if($('#search_by').val() != '')
		{
			if($('#search_text').val() == '')
			{
				$("#srch_error").html("Please enter text to search");
				return false;
			}
			else
			{
				panchangam_datatable();
				$("#srch_error").html("");
			}
		}
		else
		{
			panchangam_datatable();
			$("#srch_error").html("");
		}
	});
		
			//$("#checkin_checkout_div").hide();
			$("#search_based_date").change(function()
			{
				if(this.checked) 
				{
					$("#checkin_checkout_div").show();
				} 
				else 
				{
					$("#checkin_checkout_div").hide();
				}
				$("#date_timepicker_start").val('');
     			$("#date_timepicker_end").val('');
			});
			
			var pathname = "<?php echo $this->uri->segment(2); ?>"; 
			
			switch(pathname)
			{
				case "video_manager":
					var alert_name = 'video';
					break;
				case "audio_manager":	
					var alert_name = 'audio';
					break;
				case "article_manager":	
					var alert_name = 'article';
					break;
				case "image_manager":	
					var alert_name = 'image';
					break;
				case "gallery_manager":	
					var alert_name = 'gallery';
					break;
				default:
					var alert_name = '';
			}
			
			 $(document.body).on('click', '#status_change', function(event)
			 {
				var id = $(this).attr('content_id');	
				var set_status = $(this).attr('status');	
				var set_name = $(this).attr('name');			
				$.ajax({ 
				url:'<?php echo base_url()."dmcpan/panchangam_manager/changestatus";?>',
				type:"POST",
				data:{"contentid":id, "status":$(this).attr('status')},
				success: function(data) 
				{
					if(data == 'success')
					{
						if(set_status == 'U')
						{
							var publish_status = confirm("Are you sure you want to publish the "+alert_name+"  - "+set_name+"?");
							if(publish_status == true)
							{
								$("#status"+id).removeClass('fa-caret-right').addClass('fa-pause');
								$("#status"+id).parent('a').attr('status', 'P');
								$("#status"+id).parent('a').attr('title', 'Unpublish');
								
								$("#status_img"+id).removeClass('fa-times').addClass('fa-check');
								$("#img_change"+id).attr('title', 'Published');
							}
						}
						else if(set_status == 'P')
						{
							var unpublish_status = confirm("Are you sure you want to unpublish the "+alert_name+"  - "+set_name+"?");
							if(unpublish_status == true)
							{
								$("#status"+id).removeClass('fa-pause').addClass('fa-caret-right');
								$("#status_img"+id).removeClass('fa-check').addClass('fa-times');
								$("#status"+id).parent('a').attr('title', 'Publish');
								$("#status"+id).parent('a').attr('status', 'U');;
								$("#img_change"+id).attr('title', 'Unpublished');
							}
						}
					}
	   
  				}  
   });
 
				 
			 });
			
	});
	
	
	
</script> 
	</div>
</div>
