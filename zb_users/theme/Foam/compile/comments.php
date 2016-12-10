<?php if ($socialcomment) { ?>
<?php  echo $socialcomment;  ?>
<?php }else{  ?>

<div class="post">
<?php if ($article->CommNums==0) { ?>
	<div class="postname"><h3>暂无评论</h3></div>
<?php }else{  ?>
	<div class="postname"><h3><?php  echo $article->CommNums;  ?>条评论</h3></div>
<?php } ?>
	<div class="postcon">
<label id="AjaxCommentBegin"></label>
<?php  foreach ( $comments as $key => $comment) { ?> 
<?php  include $this->GetTemplate('comment');  ?>
<?php  }   ?>
<div class="pagebar commentpagebar"><?php  include $this->GetTemplate('pagebar');  ?></div>
<label id="AjaxCommentEnd"></label>
	</div>
</div>

<?php  include $this->GetTemplate('commentpost');  ?>

<?php } ?>