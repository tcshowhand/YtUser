{* Template Name:评论 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{if $socialcomment}
{$socialcomment}
{else}
		<!--评论框-->
	{template:commentpost}
	{if $article.CommNums>0}
		<div class="am-titlebar am-titlebar-multi">
		  <div class="am-titlebar-title am-icon-comment-o"> 留言列表</div>
		</div>
		<!--评论输出-->
		<div id="dm-comments">
		<label id="AjaxCommentBegin"></label>
		<ul class="am-comments-list">
		{foreach $comments as $key => $comment}
		{template:comment}
		{/foreach}
		</ul>
		<!--评论翻页条输出-->
		{template:pagebar}
		<label id="AjaxCommentEnd"></label>
		</div>
	{else}
		<p class="am-text-center">还没有留言，还不快点抢沙发？</p>
	{/if}	

{/if}