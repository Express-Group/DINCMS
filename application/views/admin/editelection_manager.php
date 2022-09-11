<link href="<?php echo image_url; ?>css/admin/bootstrap.min_3_3_4.css" rel="stylesheet" type="text/css">	
<link href="<?php echo image_url; ?>css/admin/jquery.datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo image_url; ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<style>
.form-group{width:97%}
.form-control{border: 1px solid #ccc !important;}
sup{color:red;}
p.error{margin-top:5px;color:red;}
</style>
<div class="Container">
	<div class="BodyWhiteBG">
		<div class="BodyHeadBg Overflow clear">
			<div class="FloatLeft  BreadCrumbsWrapper PollResult">
				<div class="breadcrumbs"><a href="#">Dashboard</a> > <a href="#"><?php echo $title; ?></a></div>
				<h2><?php echo $title; ?></h2>
			</div> 
			 <p class="FloatRight SaveBackTop"><a href="<?php echo base_url(folder_name) ?>/election_master/" class="btn-primary btn">Go back</a></p>
		</div>
		<div class="Overflow DropDownWrapper">
			<div class="container">
				<form method="post" action="<?php echo base_url(folder_name);?>/election_master/edit/<?php echo $data['eid']; ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h4 style="font-weight: 700 !important;color: red;" class="text-center">முந்தைய தேர்தல் விவரங்கள்</h4>
							<div class="form-group">
								<label>தொகுதியின் பெயர் </label>
								<input type="text" class="form-control" name="constituency_name" value="<?php echo $data['constituency_name']; ?>">
								<?php echo form_error('constituency_name', '<p class="error">', '</p>'); ?>
							</div>
							<div class="form-group">
								<label>மொத்த வாக்குகள் </label>
								<input type="text" class="form-control" name="total_votes" value="<?php echo $data['total_votes1']; ?>">
								<?php echo form_error('total_votes', '<p class="error">', '</p>'); ?>
							</div>
							<div class="form-group">
								<label>பதிவு செய்யப்பட்ட வாக்குகள் </label>
								<input type="text" class="form-control" name="voted_count" value="<?php echo $data['voted_count1']; ?>">
								<?php echo form_error('voted_count', '<p class="error">', '</p>'); ?>
							</div>
							<div class="form-group">
								<label>வெற்றிப் பெற்ற வேட்பாளர் பெயர் </label>
								<input type="text" class="form-control" name="candidate_name" value="<?php echo $data['candidate_name1']; ?>">
							</div>
							<div class="form-group">
								<label> வெற்றிப் பெற்ற வேட்பாளர்கட்சி </label>
								<input type="text" class="form-control" name="party" value="<?php echo $data['party1']; ?>">
							</div>
							<div class="form-group">
								<label style="width:100%;">வெற்றிப் பெற்ற வேட்பாளர் கட்சி சின்னம் (200X200)</label>
								<?php
								if($data['party_image1']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['party_image1'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="party_image">
							</div>
							<div class="form-group">
								<label>வெற்றிப் பெற்ற வேட்பாளர் பற்றி </label>
								<textarea class="form-control" name="about_candidate"><?php echo $data['about_candidate1']; ?></textarea>
							</div>
							<div class="form-group">
								<label style="width:100%;">வெற்றிப் பெற்ற வேட்பாளர் புகைப்படம் (200X200)</label>
								<?php
								if($data['candidate_image1']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['candidate_image1'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="candidate_image">
							</div>
							<div class="form-group">
								<label> வெற்றிப் பெற்ற வேட்பாளர் பெற்ற வாக்குகள் </label>
								<input type="text" class="form-control" name="vote" value="<?php echo $data['vote1']; ?>">
							</div>
							<h4 style="font-weight: 700 !important;color: red;" class="text-center">இரண்டம் இடம் </h4>
							<div class="form-group">
								<label>இரண்டம் இடம் பெற்ற வேட்பாளர் பெயர் </label>
								<input type="text" class="form-control" name="candidate_name2" value="<?php echo $data['candidate_name2']; ?>">
							</div>
							<div class="form-group">
								<label> இரண்டம் இடம் பெற்ற வேட்பாளர்கட்சி </label>
								<input type="text" class="form-control" name="party2" value="<?php echo $data['party2']; ?>">
							</div>
							<div class="form-group">
								<label style="width:100%;">இரண்டம் இடம் பெற்ற வேட்பாளர் கட்சி சின்னம் (200X200)</label>
								<?php
								if($data['party_image2']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['party_image2'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="party_image2">
							</div>
							<div class="form-group">
								<label>இரண்டம் இடம் பெற்ற வேட்பாளர் பற்றி </label>
								<textarea class="form-control" name="about_candidate2"><?php echo $data['about_candidate2']; ?></textarea>
							</div>
							<div class="form-group">
								<label style="width:100%;">இரண்டம் இடம் பெற்ற வேட்பாளர் புகைப்படம் (200X200)</label>
								<?php
								if($data['candidate_image2']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['candidate_image2'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="candidate_image2">
							</div>
							<div class="form-group">
								<label> இரண்டம் இடம் பெற்ற வேட்பாளர் பெற்ற வாக்குகள் </label>
								<input type="text" class="form-control" name="vote2" value="<?php echo $data['vote2']; ?>">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h4 style="font-weight: 700 !important;color: red;" class="text-center">தற்போதைய தேர்தல் விவரங்கள்</h4>
							<div class="form-group">
								<label style="width:100%;">தொகுதியின் புகைப்படம் </label>
								<?php
								if($data['constituency_image']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['constituency_image'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="constituency_image">
							</div>
							<div class="form-group">
								<label>மொத்த வாக்குகள் </label>
								<input type="text" class="form-control" name="total_votes1" value="<?php echo $data['total_votes3']; ?>">
								<?php echo form_error('total_votes1', '<p class="error">', '</p>'); ?>
							</div>
							<div class="form-group">
								<label>பதிவு செய்யப்பட்ட வாக்குகள் </label>
								<input type="text" class="form-control" name="voted_count1" value="<?php echo $data['voted_count3']; ?>">
								<?php echo form_error('voted_count1', '<p class="error">', '</p>'); ?>
							</div>
							<div class="form-group">
								<label>வெற்றிப் பெற்ற வேட்பாளர் பெயர் </label>
								<input type="text" class="form-control" name="candidate_name1" value="<?php echo $data['candidate_name3'];?>">
							</div>
							<div class="form-group">
								<label> வெற்றிப் பெற்ற வேட்பாளர்கட்சி </label>
								<input type="text" class="form-control" name="party1" value="<?php echo $data['party3'];?>">
							</div>
							<div class="form-group">
								<label style="width:100%;">வெற்றிப் பெற்ற வேட்பாளர் கட்சி சின்னம் (200X200)</label>
								<?php
								if($data['party_image3']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['party_image3'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="party_image1">
							</div>
							<div class="form-group">
								<label>வெற்றிப் பெற்ற வேட்பாளர் பற்றி </label>
								<textarea class="form-control" name="about_candidate1"><?php echo $data['about_candidate3'];?></textarea>
							</div>
							<div class="form-group">
								<label style="width:100%;">வெற்றிப் பெற்ற வேட்பாளர் புகைப்படம் (200X200)</label>
								<?php
								if($data['candidate_image3']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['candidate_image3'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="candidate_image1">
							</div>
							<div class="form-group">
								<label> வெற்றிப் பெற்ற வேட்பாளர் பெற்ற வாக்குகள் </label>
								<input type="text" class="form-control" name="vote1" value="<?php echo $data['vote3'];?>">
							</div>
							<h4 style="font-weight: 700 !important;color: red;" class="text-center">இரண்டம் இடம் </h4>
							<div class="form-group">
								<label>இரண்டம் இடம் பெற்ற வேட்பாளர் பெயர் </label>
								<input type="text" class="form-control" name="candidate_name12" value="<?php echo $data['candidate_name4'];?>">
							</div>
							<div class="form-group">
								<label> இரண்டம் இடம் பெற்ற வேட்பாளர்கட்சி </label>
								<input type="text" class="form-control" name="party12" value="<?php echo $data['party4'];?>">
							</div>
							<div class="form-group">
								<label style="width:100%;">இரண்டம் இடம் பெற்ற வேட்பாளர் கட்சி சின்னம் (200X200)</label>
								<?php
								if($data['party_image4']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['party_image4'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="party_image12">
							</div>
							<div class="form-group">
								<label>இரண்டம் இடம் பெற்ற வேட்பாளர் பற்றி </label>
								<textarea class="form-control" name="about_candidate12"><?php echo $data['about_candidate4'];?></textarea>
							</div>
							<div class="form-group">
								<label style="width:100%;">இரண்டம் இடம் பெற்ற வேட்பாளர் புகைப்படம் (200X200)</label>
								<?php
								if($data['candidate_image4']!=''){
									echo '<img src="'.image_url.'images/electionmaster/'.$data['candidate_image4'].'" style="width:100px;margin-bottom:10px;">';
								}
								?>
								<input type="file" class="form-control" name="candidate_image12">
							</div>
							<div class="form-group">
								<label> இரண்டம் இடம் பெற்ற வேட்பாளர் பெற்ற வாக்குகள் </label>
								<input type="text" class="form-control" name="vote12" value="<?php echo $data['vote4'];?>">
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary" name="submit">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>