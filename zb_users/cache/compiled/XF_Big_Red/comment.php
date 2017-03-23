
<ul class="msg" id="cmt<?php  echo $comment->ID;  ?>">
	<li class="msgname"><img class="avatar" src="<?php  echo $comment->Author->Avatar;  ?>" alt="" width="32"/><span class="commentname"><a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" target="_blank"><?php  echo $comment->Author->StaticName;  ?></a></span><small>&nbsp;发布于&nbsp;<?php  echo $comment->Time();  ?>&nbsp;&nbsp;<span class="revertcomment rc"><a href="#comment" onclick="zbp.comment.reply('<?php  echo $comment->ID;  ?>')">回复该评论</a></span></small></li>
	<li class="msgarticle">
			<?php if ($comment->ParentID!=0) { ?>
				<?php 
					$newc=$zbp->GetCommentByID($comment->ParentID);
					$atid=$newc->ID;
					$atname=$newc->Name;
				 ?>
				<a href="#comment-<?php  echo $atid;  ?>" class="comment_at" >@<?php  echo $atname;  ?></a>
				<?php  echo $comment->Content;  ?>
				<label id="AjaxComment<?php  echo $comment->ID;  ?>"></label>
			<?php }else{  ?>
				<?php  echo $comment->Content;  ?>
			<?php } ?>
<?php  foreach ( $comment->Comments as $comment) { ?>
<?php  include $this->GetTemplate('comment');  ?>
<?php }   ?>
	</li>
</ul>