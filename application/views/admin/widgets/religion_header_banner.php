<?php 
/*
Finame 		: 	religion_header_banner
Created On 	: 	19-10-2015
Purpose for	:	Display the religion_header_banner
*/

$domain_name =  base_url();

$show_simple_tab = "";
$show_simple_tab	.='<div class="row">';
$show_simple_tab	.='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
$show_simple_tab	.='<div class="religion-banner">';
$show_simple_tab	.='<img src="'.static_url.'images/FrontEnd/images/aanmeegam.jpg" />';
//$show_simple_tab	.='<img src="'.$domain_name.'images/FrontEnd/images/religion2.jpg" />';

$show_simple_tab	.='</div>'; // End for legion banner 
$show_simple_tab	.='</div>'; // End for col-lg-12
$show_simple_tab	.='</div>'; // End for row


echo $show_simple_tab;
?>
