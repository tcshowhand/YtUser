
<input type="hidden" id="post_id" value="<?php  echo $article->ID;  ?>">
<?php if ($socialcomment) { ?>
	<?php  echo $socialcomment;  ?>
<?php }else{  ?>
	<?php if ($article->CommNums>0) { ?>
		<ul class="msg msghead">
			<li class="tbname">评论列表:</li>
		</ul>
	<?php }else{  ?>
		<ul class="msg msghead">
			<li class="tbname">暂无评论</li>
		</ul>
	<?php } ?>
	<label id="AjaxCommentBegin"></label>
	<?php  foreach ( $comments as $key => $comment) { ?>
		<?php  include $this->GetTemplate('comment');  ?>
	<?php }   ?>
	<div class="pagebar commentpagebar">
		<ul><?php  include $this->GetTemplate('pagebar');  ?></ul>
	</div>
	<label id="AjaxCommentEnd"></label>
	<?php  include $this->GetTemplate('commentpost');  ?>
<?php } ?>