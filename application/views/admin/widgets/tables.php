<style>
.dynamic-table-rendered-container{
	padding:0;
	display:flex;
	width: 100%;
    flex-wrap: nowrap;
    justify-content: space-around; 
}
.dynamic-table-width{
	float:left;
	margin-top:0px;
	font-size:11px;
	}
	
.common-table-election>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .common-table-election>thead>tr>th{border:none !important;}
.table-header-wrapper{
	background:#143b5a;
	color:#fff; 
}

.common-table-election{
	margin-bottom:10px;
	border: 1px solid #143b5a;
}
.table-header-wrapper-second{
	 	color:#fff; 
	 text-align:right;
}
.table-header-title{
	background: #6fa6d1;
    color: #143b5a;
    font-weight: 700; 
}

.table-body-content:nth-child(even) {
  background: #f2f2f2;
}
.table-body-content:nth-child(odd) {
  background: #fff;
}
.common-table-election tr td:nth-child(2), .common-table-election tr td:nth-child(3), .common-table-election tr td:last-child{ text-align:center;font-size:11px;    padding: 8px 2px 1px 4px !important; }
@media only screen and (min-width: 1551px){
	.dynamic-table-width{font-size: 14px;} 
}
@media (max-width:479px){
.dynamic-table-width{ width:100%;margin-top:7px; }
.dynamic-table-rendered-container{display:block;}
}

@media (max-width:768px) and (min-width:480px){
.dynamic-table-width{ width:49%;margin-top:7px; }
}

@media (max-width:991px) and (min-width:768px){
.dynamic-table-width{ width:30%;margin-top:7px; }

}

@media (max-width:1199px) and (min-width:992px){
.dynamic-table-width{ width:20%;margin-top:7px; }
}
.span_bg{ margin:0; padding:0; position:absolute; z-index:99;float:left; width:100%; height:100%; opacity:0.4;top: 38px;left: 62px; }
</style>

<?php
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color        = $content['widget_bg_color'];
$widget_custom_title    = $content['widget_title'];
$widget_instance_id     = $content['widget_values']['data-widgetinstanceid'];
$widgetsectionid        = $content['sectionID'];
$main_sction_id 	    = "";
$widget_section_url     = $content['widget_section_url'];
$is_home                = $content['is_home_page'];
$view_mode              = $content['mode'];
$domain_name            =  base_url();
$show_simple_tab        = "";
$max_article            = $content['show_max_article'];
$render_mode            = $content['RenderingMode'];
$pageSection = $content['page_param'];
/*----widgetbconfig ends here------*/
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db' , TRUE);
$SectionDetails = $this->live_db->query("CALL get_section_by_id('".$pageSection."')")->row_array();
$Template .='<div class="col-md-12 dynamic-table-rendered-container"><span class="col-md-12 text-center" style="font-size: 22px;"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i></span>';
$Template .='</div>';
echo $Template;
?>
<script>
$(document).ready(function(){
	$.ajax({
		type:'post',
		cache:false,
		url:'<?php print BASEURL ?>user/commonwidget/GetDynamicTables',
		data:{'section' : '<?php echo (trim(@$SectionDetails['Sectionname'])!='') ? trim(str_replace(' Elections','',@$SectionDetails['Sectionname'])) : '' ?>'},
		success:function(result){
			$('.dynamic-table-rendered-container').html(result);
		}
	});

});
/* setInterval(function(){
console.log(1);
$.ajax({
		type:'post',
		cache:false,
		url:'<?php print HOMEURL ?>user/commonwidget/GetDynamicTables',
		success:function(result){
			$('.dynamic-table-rendered-container').html(result);
		}
	});
},15000); */
</script>