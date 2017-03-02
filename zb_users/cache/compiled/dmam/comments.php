<?php  /* Template Name:评论 */  ?>

<?php if ($socialcomment) { ?>
<?php  echo $socialcomment;  ?>
<?php }else{  ?>
		<!--评论框-->
	<?php  include $this->GetTemplate('commentpost');  ?>
	<?php if ($article->CommNums>0) { ?>
		<div class="am-titlebar am-titlebar-multi">
		  <div class="am-titlebar-title am-icon-comment-o"> 留言列表</div>
		</div>
		<!--评论输出-->
		<div id="dm-comments">
		<label id="AjaxCommentBegin"></label>
		<ul class="am-comments-list">
		<?php  foreach ( $comments as $key => $comment) { ?>
		<?php  include $this->GetTemplate('comment');  ?>
		<?php }   ?>
		</ul>
		<!--评论翻页条输出-->
		<?php  include $this->GetTemplate('pagebar');  ?>
		<label id="AjaxCommentEnd"></label>
		</div>
	<?php }else{  ?>
		<p class="am-text-center">还没有留言，还不快点抢沙发？</p>
	<?php } ?>	

<?php } ?>