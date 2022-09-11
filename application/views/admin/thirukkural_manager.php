<?php $script_url = image_url; ?>
<link rel="stylesheet" href="<?php echo $script_url; ?>css/admin/bootstrap.min.css" type="text/css">
<link href="<?php echo $script_url; ?>css/admin/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />

<link href="<?php echo $script_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.style-my-tooltips.js"></script>

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




<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<?php /*?><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/w2ui-fields-1.0.min.css"><?php */?>



<script type="text/javascript" src="<?php echo $script_url;?>js/moment-with-locales.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/bootstrap/bootstrap-hover-dropdown.min.js"></script>	
<script type="text/javascript" src="<?php echo $script_url;?>js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.datetimepicker.js"></script>
     
<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.style-my-tooltips.js"></script>

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



<script type="text/javascript" src="<?php echo $script_url;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $script_url;?>js/w2ui-fields-1.0.min.js"></script>
<link href="<?php echo $script_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $script_url; ?>css/admin/w2ui-fields-1.0.min.css">







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



</head>
<body>

<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft BreadCrumbsWrapper ">
				<div class="breadcrumbs">Dashboard > Thirukkural</div>
 					<h2>Thirukkural Manager</h2>
			</div>
         <?php $data['Menu_id'] = get_menu_details_by_menu_name('Thirukkural');
		if(defined("USERACCESS_ADD".$data['Menu_id']) && constant("USERACCESS_ADD".$data['Menu_id']) == 1) 
		{ ?>
             <p class="FloatRight SaveBackTop remoda1-bg"><a href="<?php echo base_url();?>dmcpan/thirukkural_manager/view_addform" type="button" class="btn-primary btn"><i class="fa fa-plus-circle"></i>Add New</a></p>
            <?php }?>
            
		</div>
			<div class="Overflow DropDownWrapper">
            <?php 
if($this->session->flashdata("success"))
{     
?>
 <div class="FloatLeft SessionSuccess" id="flash_msg_id"><?php echo $this->session->flashdata("success");?></div>
<?php
}
?> 
<?php 
if($this->session->flashdata("success_delete"))
{     
?>
 <div class="FloatLeft SessionSuccess" id="flash_msg_id"><?php echo $this->session->flashdata("success_delete");?></div>
<?php
}
?> 
<?php 
if($this->session->flashdata("fail_delete"))
{     
?>
 <div class="FloatLeft SessionSuccess" id="flash_msg_id"><?php echo $this->session->flashdata("fail_delete");?></div>
<?php
}
?> 
  				<div class="container">
    				<div id="" class="row AskPrabuCheckBoxWrapper">
            			<ul class="AskPrabuCheckBox FloatLeft">
                        
                        
        					<!--<li class="has-pretty-child">
                            <div class="clearfix prettycheckbox labelright  red"><input type="checkbox" id="search_based_check"  class="myClass" value="yes" name="answer"><a class=" " href="#"></a>
<label for="search_based_check">Search Based on Date Range</label></div><a href="#" class=""></a>
    						</li>-->
    
     
       <li>
<p class="CalendarWrapper"  id="checkin_checkout_div"><label class="include_label HeadTopAuto"  for="search_based_date">Search Based on Date Range</label>
<input type="text" value="" id="date_timepicker_start" placeholder="Start Date"><input type="text" value="" id="date_timepicker_end" placeholder="End Date"></p>
 </li>
           
            
                    	</ul>
    			</div>
			</div>

<div class="FloatLeft Module02">
<div class="FloatLeft w2ui-field">
<select id="ddFilterBy" name="ddFilterBy" placeholder="Sort By: All" class="controls">
<!--<option value="">- Status -</option>-->
<option value="1">Search By- All</option>
<option value="2">Title</option>
<option value="3">Created By</option>

</select>
</div>

<div class="FloatLeft w2ui-field">
<select id="ddStatus" name="ddStatus" class="controls">
<!--<option value="">- Status -</option>-->
<option value="">Status- All</option>
<option value="1">Active</option>
<option value="0">In active</option>
</select>
</div>
			
<P class="FloatLeft"><input type="search" placeholder="Search" class="SearchInput" name="txtSearch" id="txtSearch"></P>

<button class="btn btn-primary" type="button" id="thirukkural_search">Search</button>
<button class="btn btn-primary" type="button" id="clear_search">Clear Search</button>
</div>




 <p id="srch_error" style="clear: left; color:#F00;margin:0"></p>





<div id="container_datatable" class="display"  style="width:100%; float:left; ">
	<div id="work_list" class="display">
    <div class="role-dpt">
    <table id="example" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<!--<th>User ID</th>-->
                    <th class="thirukkural_title">Title</th>
					<th>Created By</th>
					<th>Created On</th>
                    <th>Status</th>
                     <?php if((defined("USERACCESS_DELETE".$data['Menu_id']) && constant("USERACCESS_DELETE".$data['Menu_id']) == 1) || (defined("USERACCESS_EDIT".$data['Menu_id']) && constant("USERACCESS_EDIT".$data['Menu_id']) == 1)) { ?><th>Action</th><?php }?>
				</tr>
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


$('#txtSearch').keypress(function (e) {
		if($.trim($('#txtSearch').val()) != '') {
		 var key = e.which;
		 if(key == 13)  {
			 thirukkural_datatable();
		  }  
		}
	});
	$("#clear_search").click(function() {
	$("#ddFilterBy").val('1');
	$("#txtSearch").val('');
	$("#date_timepicker_start").val('');
	$("#date_timepicker_end").val('');
	$("#ddStatus").val('');
	//$("#srch_error").val('').hide();
	$("#srch_error").html('').hide();
	
	thirukkural_datatable();
	});
	
	thirukkural_datatable();

	});
	
	
	
	function thirukkural_datatable() {
		
	var fromdate=$( "#date_timepicker_start").val();
	var todate=$( "#date_timepicker_end").val();
	var filterby=$( "#ddFilterBy" ).val();
	var status=$( "#ddStatus" ).val();
	var searchbox=$( "#txtSearch").val();
	var searchondate=$("#check1:checked").val();
	
    $('#example').dataTable( {
		 
	
		
        "processing": true,
        "bServerSide": true,
		 "bDestroy": true,
		 "autoWidth": false,
		  "searching": false,
		"iDisplayLength": 10,
		"aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ -1 ] }
       ],
		"aaSorting": [[3,'desc']], 
		
		oLanguage: {
        sProcessing: "<img src='<?php echo base_url(); ?>images/admin/loadingroundimage.gif' style='width:40px; height:40px;'>"
    },

		
		
		"fnDrawCallback":function(oSettings )
		{
			   $("html, body").animate({ scrollTop: 0 }, "slow");
			 
   			//alert();
		   if($('span a.paginate_button').length <= 1) 
		   {
			 $("#example_paginate").hide();
			// $("#example_length").hide();
		   } else 
		   {
			 $("#example_paginate").show();
			 $("#example_length").show();
		   }
		   if($(this).find('tbody tr').text()== "No matching records found")
		   {
			  $(oSettings.nTHead).hide(); 
			  $('.dataTables_info').hide();
			  $("#example_length").hide();
			   $("#example").find('tbody tr')
    .append($('<td class="BackArrow"><a href="<?php  echo base_url(); ?>dmcpan/thirukkural_manager" data-toggle="tooltip" title="Back to list"><i class="fa fa-reply fa-2x"></i></a></td>'));
		   }
		   else
		   {
			   
			   $(oSettings.nTHead).show(); 
		   }
		  
		},
		
		"ajax": {
            "url": "<?php echo base_url(); ?>dmcpan/thirukkural_manager/thirukkural_datatable",
			"type" : "POST",
			"data" : {
		  "from_date" : fromdate, "to_date" : todate,"searchtxt" : searchbox, "filterby" : filterby, "searchondate": searchondate,"status":status
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
				$("#thirukkural_search").click();
			}
			
		});
	
	$("#thirukkural_search").click(function()
 	{
	// console.log('ppp');
  		if($('#ddFilterBy').val() != '1')
  		{
   			if($('#txtSearch').val() == '')
   			{
    			$("#srch_error").html("Please enter text to search").show();
    			return false;
   			}
   			else
   			{
    			thirukkural_datatable();
    			$("#srch_error").html("");
   			}
  		}
  		else
  		{
	 		$("#srch_error").html("");
   			thirukkural_datatable();
  		}
 	});
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
<?php if($this->session->flashdata('success')){  ?>
$("#flash_msg_id").show();
$("#flash_msg_id").slideDown(function() {
    setTimeout(function() {
        $("#flash_msg_id").slideUp();
    }, 5000);
});
<?php } ?>
<?php if($this->session->flashdata('success_delete')){  ?>
$("#flash_msg_id").show();
$("#flash_msg_id").slideDown(function() {
    setTimeout(function() {
        $("#flash_msg_id").slideUp();
    }, 5000);
});
<?php } ?>
<?php if($this->session->flashdata('fail_delete')){  ?>
$("#flash_msg_id").show();
$("#flash_msg_id").slideDown(function() {
    setTimeout(function() {
        $("#flash_msg_id").slideUp();
    }, 5000);
});
<?php } ?>

});
</script>
</div>                            
</div>                       
</div>
      
</body>
</html>

