{if $socialcomment}
{$socialcomment}
{else}
<div class="content">
	<div class="comment">
		<div class="commenttitle">
			<h4>共有 {$article.CommNums} 人评论</h4>
		</div>
		<div class="commentcon">
			{template:commentpost}
			<label id="AjaxCommentBegin"></label>
			{foreach $comments as $key => $comment}
			{template:comment}
			{/foreach}
			<div class="pagebar commentpagebar">
			{template:pagebar}
			</div>
			<label id="AjaxCommentEnd"></label>
		</div>
	</div>
</div>
{/if}