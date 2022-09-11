<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="<?php echo base_url(); ?>css/admin/prabu-styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/admin/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/w2ui-fields-1.0.min.css">
<link href="<?php echo base_url(); ?>includes/ckeditor/contents.css" rel="stylesheet" type="text/css" />

 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.11.3.min.js" type="text/javascript">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>includes/ckeditor/ckeditor.js"></script>


<!--ck editor links-->
<style>

.btn-primary btn input[type=submit]
  {
   display:none;
  }
  .mandatory
  {
	  color:#F00;
  }
</style>



<script>
$(document).ready(function()
{
CKEDITOR.replace( 'txtCkeditor',
    {
        toolbar : [ { name: 'basicstyles', items: [ 'Bold', 'Italic', 'TextColor','FontSize' ] } ]
    });	
});


function validate()
{
	var editor_val = CKEDITOR.instances.txtCkeditor.document.getBody().getChild(0).getText() ;
	
	//alert(editor_val);
	if ($.trim(editor_val) == '') 
	{
		$("#error_txtCkeditor").html("Please enter the answer");
		$("#txtCkeditor").focus();
		return false;
	}
	else
	{
		$("#error_txtCkeditor").html('');
	}
	
	var x = confirm("Are you sure you want to save the answers?");
	if(x==true)
	{
		document.askprabhu_reply.submit();
	}
	else
	{
		return false;
	}
}


		
function ck_width()
{
	$("#cke_editor1").css({"width": "99%"});
}

</script>


</head>

<body onLoad="ck_width()">

	<div class="Container">
		<div class="BodyWhiteBG">
        
        <?php if(isset($userdetails)) { 
						foreach($userdetails as $details) {
						?>
							<form method="post" name="askprabhu_reply" id="askprabhu_reply" action="<?php echo base_url(); ?>dmcpan/askprabhu/call_update_class/<?php echo $details->Question_id; ?>" enctype="multipart/form-data" onSubmit="return validate();"> 
        
			<div class="BodyHeadBg Overflow clear">
				<div class="FloatLeft">
					<div class="breadcrumbs">Dashboard > Ask Prabu Reply</div>
 						<h2>Ask Prabu Reply</h2>
				</div>
					<div class="save_poll FloatRight">
					<div class="FloatRight">
                        
                        
 						
                            <p class="FloatLeft save-back SaveBackTop">
 								<a href="<?php echo base_url(); ?>dmcpan/askprabhu" data-toggle="tooltip01"  data-original-title="dfgdgdg" class="FloatLeft back-top"><i class="fa fa-reply fa-2x"></i></a>
 							<button class="btn-primary btn" type="submit"><i class="fa fa-file-text-o"></i> &nbsp;Save</button></p>
                            
                            
                            
					</div>
                    
                    
                    
					</div>
			</div>

            <div class="poll_content">
                <div class="ask_prabhu">
                    <div class="ask_prabhu1">
                        <p>Author</p>
                    </div>
                    <div class="ask_prabhu2">
                        <div class="ask_prabhu2a">
                            <p class="ask_bold">Nick Name</p>
                        </div>
                        <div class="ask_prabhu2b">
                            <p><?php echo $details->UserName; ?></p>
                        </div>
                
                        <div class="ask_prabhu2a">
                            <p class="ask_bold">Email</p>
                        </div>
                        <div class="ask_prabhu2b">
                            <p><?php echo $details->EmailID; ?></p>
                        </div>
                
                        <div class="ask_prabhu2a">
                            <p class="ask_bold">Submitted on</p>
                        </div>
                        <div class="ask_prabhu2b">
                            <p><?php echo $details->SubmittedOn; ?></p>
                        </div>
                        <div class="ask_prabhu2a">
                            <p class="ask_bold">Sent from IP address</p>
                        </div>
                        <div class="ask_prabhu2b">
                            <p><?php echo $details->IPAddress; ?></p>
                        </div>
                    </div>
                    <div class="ask_prabhu1">
                        <p>User Question</p>
                    </div>
                    <div class="ask_prabhu2">
                        <p class="ask_bold"><?php echo $details->Questiontext; ?></p>
                    </div>
                    <div class="ask_prabhu1">
                        <p>Reply</p>
                    </div>
                    <div class="ask_prabhu2">
                        <textarea class="ckeditor" name="txtCkeditor" id="txtCkeditor" ><?php echo ($details->AnswerInHTML); ?></textarea>
						<p id="error_txtCkeditor" class="mandatory"></p>	
                    </div>
                    <p><?php echo form_error('txtCkeditor');?></p>
                    
            <?php $status_detail = $details->Status;?>
                    <div class="ask_prabhu1 Status">
                        <p>Status</p>
                    </div>
            
                    <div class="FloatLeft TableColumn ask_prabhu2">  
                        <div class="FloatLeft">
            <!--<div class="w2ui-label"> List: </div>-->
                            <div class="w2ui-field">
                               
                                   <select id="ddStatus" name="ddStatus" class="controls">
                                   <option value="2" <?php if($status_detail == "2") { ?> selected="selected" <?php } ?> >Pending</option>
                                   <option value="1" <?php if($status_detail == "1") { ?> selected="selected" <?php } ?> >Approved</option>
                                   <option value="3"  <?php if($status_detail == "3") { ?> selected="selected" <?php } ?>>Rejected</option>
                                   </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
            
                	<div class="save_poll">
                   <!-- <div class="FloatRight">
                        <p class="FloatLeft save-back">
                        <a class="FloatLeft back-top" href="<?php echo base_url(); ?>admin/askprabhu"><i class="fa fa-reply fa-2x"></i></a>
                            <button class="btn-primary btn" type="submit" ><i class="fa fa-file-text-o"></i> &nbsp;Save</button></p>
                    </div>-->
                </div>
                
                
               
            </div>
            
             </form> 
            
		</div>                            
	</div>
                  
   
 
                                
<?php  } } ?>



