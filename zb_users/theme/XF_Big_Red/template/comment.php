<?php echo'
	<meta charset="UTF-8">
	<div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Theme ID: XF_Big_Red</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author: 小锋博客</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author URI: Www.SongHaiFeng.Com</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author QQ: 284204003</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author Email: 284204003@qq.com</h2>
	</div>
';die();?>
<ul class="msg" id="cmt{$comment.ID}">
	<li class="msgname"><img class="avatar" src="{$comment.Author.Avatar}" alt="" width="32"/><span class="commentname"><a href="{$comment.Author.HomePage}" rel="nofollow" target="_blank">{$comment.Author.StaticName}</a></span><small>&nbsp;发布于&nbsp;{$comment.Time()}&nbsp;&nbsp;<span class="revertcomment rc"><a href="#comment" onclick="zbp.comment.reply('{$comment.ID}')">回复该评论</a></span></small></li>
	<li class="msgarticle">
			{if $comment.ParentID!=0}
				{php}
					$newc=$zbp->GetCommentByID($comment->ParentID);
					$atid=$newc->ID;
					$atname=$newc->Name;
				{/php}
				<a href="#comment-{$atid}" class="comment_at" >@{$atname}</a>
				{$comment.Content}
				<label id="AjaxComment{$comment.ID}"></label>
			{else}
				{$comment.Content}
			{/if}
{foreach $comment.Comments as $comment}
{template:comment}
{/foreach}
	</li>
</ul>