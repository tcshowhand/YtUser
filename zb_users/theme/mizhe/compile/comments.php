<?php if ($socialcomment) { ?>
<?php  echo $socialcomment;  ?>
<?php }else{  ?>
<div class="content">
	<div class="comment">
		<div class="commenttitle">
			<h4>共有 <?php  echo $article->CommNums;  ?> 人评论</h4>
		</div>
		<div class="commentcon">
			<?php  include $this->GetTemplate('commentpost');  ?>
			<label id="AjaxCommentBegin"></label>
			<?php  foreach ( $comments as $key => $comment) { ?> 
			<?php  include $this->GetTemplate('comment');  ?>
			<?php  }   ?>
			<div class="pagebar commentpagebar">
			<?php  include $this->GetTemplate('pagebar');  ?>
			</div>
			<label id="AjaxCommentEnd"></label>
		</div>
	</div>
</div>
<?php } ?>