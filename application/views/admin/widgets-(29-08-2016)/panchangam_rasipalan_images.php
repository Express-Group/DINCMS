<?php
$widget_bg_color     = $content['widget_bg_color'];
$param 		= $content['page_param'];
$widget_id 	= $content['widget_values']['data-widgetpageid'];
$url 		= base_url();
$result 	=  $this->db->query('CALL get_astro_Ids()')->result_array();
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="rasipalan-side" >
			<h4>ராசி பலன்கள்</h4>
			<articel  class="rasi-icon"  <?php echo $widget_bg_color ; ?>>
				<div class="rasi-12"> 
					<?php if(isset($result[0]['URLSectionStructure'])) { ?>
					<a href="<?php echo $url.$result[0]['URLSectionStructure']; ?>" title="மேஷம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-2.png" /></a> 
					<?php } ?>
					<?php if(isset($result[1]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[1]['URLSectionStructure']; ?>" title="ரிஷபம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-12.png" /></a> 
					<?php } ?>
					<?php if(isset($result[2]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[2]['URLSectionStructure']; ?>" title="மிதுனம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-5.png" /></a> 
					<?php } ?>
					<?php if(isset($result[3]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[3]['URLSectionStructure']; ?>" title="கடகம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-1.png"  /></a> 
					<?php } ?>
				</div>
				<div class="rasi-12"> 
				<?php if(isset($result[4]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[4]['URLSectionStructure']; ?>" title="சிம்மம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-4.png" /></a>
					<?php } ?>
					<?php if(isset($result[5]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[5]['URLSectionStructure']; ?>" title="கன்னி"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-10.png" /></a>
					<?php } ?>
					<?php if(isset($result[6]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[6]['URLSectionStructure']; ?>" title="துலாம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-3.png" /></a>
					<?php } ?>
					<?php if(isset($result[7]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[7]['URLSectionStructure']; ?>" title="விருச்சிகம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-7.png" /></a>
					<?php } ?>
				</div>
				<div class="rasi-12"> 
				<?php if(isset($result[8]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[8]['URLSectionStructure']; ?>" title="தனுசு"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-8.png" /></a> 
					<?php } ?>
					<?php if(isset($result[9]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[9]['URLSectionStructure']; ?>" title="மகரம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-6.png" /></a> 
					<?php } ?>
					<?php if(isset($result[10]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[10]['URLSectionStructure']; ?>" title="கும்பம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-11.png" /></a> 
					<?php } ?>
					<?php if(isset($result[11]['URLSectionStructure'])) { ?>
					<a href="<?php echo  $url.$result[11]['URLSectionStructure']; ?>" title="மீனம்"><img src="<?php echo $url; ?>images/FrontEnd/images/rasi/rasi-9.png" /></a> 
					<?php } ?>
				</div>
			</articel>
		</div>
	</div>
</div>