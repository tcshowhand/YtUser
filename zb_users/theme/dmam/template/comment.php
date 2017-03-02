{* Template Name:单个评论 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{if $zbp->CheckPlugin('CommentUA')}{$comment.CommentUA_GetUserAgent()}{/if}
<li id="cmt-{$comment.ID}" class="am-comment">
	<a class="avatar_a" href="{$comment.Author.HomePage}"><img {dmam_islasy("avatar",$comment.Author.Avatar)} class="am-comment-avatar">{if $comment.Author.Email == $zbp.members[1].Email}<i class="bb am-icon-gavel"></i>{/if}</a>
	<div class="am-comment-main">
		<header class="am-comment-hd">
			<div class="am-comment-meta">
			{if $zbp->CheckPlugin('Rating')}{Rating_get_author_class($comment.Author.Email)}{/if}<a href="{$comment.Author.HomePage}" class="am-comment-author">{$comment.Author.StaticName}</a> 评论于 <time>{$comment.Time()}</time>
			</div>
			<div class="am-comment-actions">
			<a class="dm-reply" href="javascript:;" onclick="zbp.comment.reply('{$comment.ID}')"><i class="am-icon-reply"></i></a>
			<a rel="nofollow" id="cancel-reply" href="javascript:;" onclick="CancelReply('{$comment.ID}')"><i class="am-icon-close"></i></a>
			</div>
		</header>
		<div class="am-comment-bd">
			<p>{$comment.Content}</p>
		</div>
		<footer class="am-comment-footer">
		{if $zbp->CheckPlugin('CommentUA')}<div class="dm-CommentUA">{$comment.CommentUA['all_16']}</div>{/if}
		<!--<div class="am-comment-actions">
		
		 <a href=""><i class="am-icon-thumbs-up"></i></a> <a href=""><i class="am-icon-thumbs-down"></i></a> 
		</div>-->
		</footer>
	</div>
	<label id="cmt-label-{$comment.ID}"></label>
	<ul class="am-comments-list cmt-children">
	{foreach $comment.Comments as $comment}
	{template:comment}
	{/foreach}
	</ul>
</li>
