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
<input type="hidden" id="post_id" value="{$article.ID}">
{if $socialcomment}
	{$socialcomment}
{else}
	{if $article.CommNums>0}
		<ul class="msg msghead">
			<li class="tbname">评论列表:</li>
		</ul>
	{else}
		<ul class="msg msghead">
			<li class="tbname">暂无评论</li>
		</ul>
	{/if}
	<label id="AjaxCommentBegin"></label>
	{foreach $comments as $key => $comment}
		{template:comment}
	{/foreach}
	<div class="pagebar commentpagebar">
		<ul>{template:pagebar}</ul>
	</div>
	<label id="AjaxCommentEnd"></label>
	{template:commentpost}
{/if}