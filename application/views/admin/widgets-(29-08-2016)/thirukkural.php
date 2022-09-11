<?php 
$view_mode           = $content['mode'];
$thirukkural_manager =  $this->db->query('CALL get_thirukkuralFP()')->result_array();
foreach($thirukkural_manager as $thirukkural)
{
	$firstline=strip_tags($thirukkural['First_line']);
	$secondline=$thirukkural['Second_line'];
	$meaning=$thirukkural['Meaning'];
	$series=$thirukkural['Series'];
	$section=$thirukkural['Section'];
	$fontsize=$thirukkural['thirukkural_font'];
}
?>
<style>
.kural-mean p{font-size: <?php echo $fontsize;?>px;}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
		<div class="side-gap">
			<div class="box-botton kural-button ">திருக்குறள்</div>
			<div class="box-one kural-box pull-left ">
            <articel class="kural-dis">
             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<h5 class="pull-left">எண்<span><?php echo $series ?> </span></h5>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <figure class="kural-img"><img src="<?php echo base_url(); ?>/images/FrontEnd/images/kural.jpg" /></figure>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<h5 class="pull-right">அதிகாரம்<span><?php echo $section; ?></span></h5>
                </div>
			</articel>
				<?php if(isset($firstline)) { ?>
				<articel>
					
					<figcaption class="kural-mean">
						<p><?php echo $firstline; ?>
						<p><?php echo $secondline; ?> 
					</figcaption>
				</articel>
				<articel class="kural-dis">
					<h4 class="porul">பொருள்</h4>
					<p><?php echo $meaning; ?></p>
				</articel>
				<?php } else {
				  if($view_mode == "adminview") {  ?>
				<div class="margin-bottom-10">Please add the thirukkural in CMS</div>
				<?php } } ?>
			</div>
		</div>
	</div>
</div>
