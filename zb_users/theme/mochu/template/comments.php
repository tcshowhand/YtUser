<div class="pinglunnr">
{template:commentpost}
<br />
{if $socialcomment}
{$socialcomment}
{else}
<label id="AjaxCommentBegin"></label>
{foreach $comments as $key => $comment}
{template:comment}
{/foreach}
<div class="pagebar commentpagebar">
{template:pagebar}
</div>
<label id="AjaxCommentEnd"></label>
{/if}</div>