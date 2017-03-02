<label id="cmt<?php  echo $comment->ID;  ?>"></label><?php  /* Template Name:单个评论 */  ?>

<?php if ($zbp->CheckPlugin('CommentUA')) { ?><?php  echo $comment->CommentUA_GetUserAgent();  ?><?php } ?>
<li id="cmt-<?php  echo $comment->ID;  ?>" class="am-comment">
	<a class="avatar_a" href="<?php  echo $comment->Author->HomePage;  ?>"><img <?php  echo dmam_islasy("avatar",$comment->Author->Avatar);  ?> class="am-comment-avatar"><?php if ($comment->Author->Email == $zbp->members[1]->Email) { ?><i class="bb am-icon-gavel"></i><?php } ?></a>
	<div class="am-comment-main">
		<header class="am-comment-hd">
			<div class="am-comment-meta">
			<?php if ($zbp->CheckPlugin('Rating')) { ?><?php  echo Rating_get_author_class($comment->Author->Email);  ?><?php } ?><a href="<?php  echo $comment->Author->HomePage;  ?>" class="am-comment-author"><?php  echo $comment->Author->StaticName;  ?></a> 评论于 <time><?php  echo $comment->Time();  ?></time>
			</div>
			<div class="am-comment-actions">
			<a class="dm-reply" href="javascript:;" onclick="zbp.comment.reply('<?php  echo $comment->ID;  ?>')"><i class="am-icon-reply"></i></a>
			<a rel="nofollow" id="cancel-reply" href="javascript:;" onclick="CancelReply('<?php  echo $comment->ID;  ?>')"><i class="am-icon-close"></i></a>
			</div>
		</header>
		<div class="am-comment-bd">
			<p><?php  echo $comment->Content;  ?></p>
		</div>
		<footer class="am-comment-footer">
		<?php if ($zbp->CheckPlugin('CommentUA')) { ?><div class="dm-CommentUA"><?php  echo $comment->CommentUA['all_16'];  ?></div><?php } ?>
		<!--<div class="am-comment-actions">
		
		 <a href=""><i class="am-icon-thumbs-up"></i></a> <a href=""><i class="am-icon-thumbs-down"></i></a> 
		</div>-->
		</footer>
	</div>
	<label id="cmt-label-<?php  echo $comment->ID;  ?>"></label>
	<ul class="am-comments-list cmt-children">
	<?php  foreach ( $comment->Comments as $comment) { ?>
	<?php  include $this->GetTemplate('comment');  ?>
	<?php }   ?>
	</ul>
</li>
