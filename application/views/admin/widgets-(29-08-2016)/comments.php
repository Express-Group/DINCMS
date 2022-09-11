<?php
$content_id      = $content['content_id'];
$content_from    = $content['content_from'];
$content_type_id = $content['content_type'];
if($content_id!=''){
$content_det     = $content['detail_content'][0];
$allow_comments  = ($content_from=="preview")? $content_det['Allowcomments'] : $content_det['allow_comments'];
if($allow_comments == 1) { ?>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ArticleDetail">
    <div class="ArticleComments">
      <?php 	
		$article_comments = $this->comment_model->get_comments_by_article_id($content_id); 
		$comments_count = ($article_comments['count']>0)? '('.$article_comments['count'].')': '' ;
		?>
      <h4 class="ArticleHead comment_head">உங்கள் கருத்துகள்<span id="comments_count"><?php echo $comments_count;?></span></h4>
      <div class="CommentForm"> 
        <form action="<?php echo base_url(); ?>user/commonwidget/post_comment" method="post" name="comment_form" id="comment_form">
          <textarea placeholder="கருத்தைப் பதிவு செய்ய..."  name="article_comment" id="article_comment" style="resize: vertical; overflow: auto;"></textarea>
          <!--<div class="social_icons FloatLeft"> <a href="#" class="fb"><i class="fa fa-facebook"></i></a> <a href="#" class="google"><i class="fa fa-google-plus"></i></a> <a href="#" class="twit"><i class="fa fa-twitter"></i></a>  </div>-->
          <div class="post">
            <input type="text" placeholder="பெயர்" name="name" class="form-control tb">
            <input type="text" placeholder="மின்னஞ்சல்" name="email" class="form-control tb">
            <input type="hidden" id="content_id" class="content_id" name="content_id" value="<?php echo $content_id;?>" />
            <input type="hidden" id="content_type_id" class="content_type_id" name="content_type_id" value="<?php echo $content_type_id;?>" />
            <input type="hidden" id="comment_id" class="comment_id" name="comment_id" value="" />
            <input type="submit" value="அனுப்புங்கள்" class="submit_post" name="submit">
          </div>
        </form>
        <span id="comment_validate" class="WidthFloat_L margin-0" style="color:red;"></span>
        <div class="CloseReply" style="display:none;"><i class="fa fa-times-circle"></i></div>
      </div>
    
    </div>
     <?php $comments = $article_comments['view_comments'];
	if($comments!=''){
	?>
    <div id="show_comments">
      <?php echo $comments;?> 
    </div>
   <?php } ?>
      <div class="common-border"><span></span><span></span></div>
  </div>
    
</div>
<?php } 
}
?>