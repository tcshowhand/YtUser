{if $socialcomment}
{$socialcomment}
{else}

<div class="post">
{if $article.CommNums==0}
	<div class="postname"><h3>暂无评论</h3></div>
{else}
	<div class="postname"><h3>{$article.CommNums}条评论</h3></div>
{/if}
	<div class="postcon">
<label id="AjaxCommentBegin"></label>
{foreach $comments as $key => $comment}
{template:comment}
{/foreach}
<div class="pagebar commentpagebar">{template:pagebar}</div>
<label id="AjaxCommentEnd"></label>
	</div>
</div>

{template:commentpost}

{/if}