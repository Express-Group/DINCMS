<?php
$widget_bg_color     = $content['widget_bg_color'];
$param = $content['page_param'];
$widget_id = $content['widget_values']['data-widgetpageid'];
$url = base_url();
$result =  $this->db->query('CALL get_number_Ids()')->result_array();

?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="rasipalan-side" <?php echo $widget_bg_color ; ?>>
			<h4><p>எண் ஜோதிடம்: </p><p> பிறந்த தேதி பலன்கள்</p></h4>
			<articel class="good-time">
				<ul>
				<?php if(isset($result[0]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[0]['URLSectionStructure']; ?>" title="One">
						<p><span>1</span></p>
						<p>பிறந்த தேதி</p>
						<p>1, 10, 19, 28</p>
						<p>என்றால்...</p>
						</a>
					</li>
				<?php } ?>
				<?php if(isset($result[1]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[1]['URLSectionStructure']; ?>" title="Two">
						<p><span>2</span></p>
						<p>பிறந்த தேதி</p>
						<p> 2, 11, 20, 29</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[2]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[2]['URLSectionStructure']; ?>" title="Three">
						<p><span>3</span></p>
						<p>பிறந்த தேதி</p>
						<p> 3, 12, 21, 30</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[3]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[3]['URLSectionStructure']; ?>" title="Four">
						<p><span>4</span></p>
						<p>பிறந்த தேதி</p>
						<p> 4, 13, 22, 31</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[4]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[4]['URLSectionStructure']; ?>" title="Five">
						<p><span>5</span></p>
						<p>பிறந்த தேதி</p>
						<p> 5, 14, 23</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[5]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[5]['URLSectionStructure']; ?>" title="Six">
						<p><span>6</span></p>
						<p>பிறந்த தேதி</p>
						<p> 6, 15, 24</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[6]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[6]['URLSectionStructure']; ?>" title="Seven">
						<p><span>7</span></p>
						<p>பிறந்த தேதி</p>
						<p> 7, 16, 25</p>
						<p>என்றால்...</p>
						</a>
					</li>
					<?php } ?>
					<?php if(isset($result[7]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[7]['URLSectionStructure']; ?>" title="Eight">
						<p><span>8</span></p>
						<p>பிறந்த தேதி</p>
						<p> 8, 17, 26</p>
						<p>என்றால்...</p>
						</a>
					</li>
										<?php } ?>
					<?php if(isset($result[8]['URLSectionStructure'])) { ?>
					<li>
						<a href="<?php echo $url.$result[8]['URLSectionStructure']; ?>" title="Nine">
						<p><span>9</span></p>
						<p>பிறந்த தேதி</p>
						<p> 9, 18, 27</p>
						<p>என்றால்...</p>
						</a>
					</li>				
					<?php } ?>
				</ul>
			</articel>		
		</div>		
	</div>
</div>