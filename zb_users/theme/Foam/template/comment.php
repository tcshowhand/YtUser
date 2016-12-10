<div class="msg" id="cmt{$comment.ID}">
<div class="msgtxt">
<div class="msgtxtbogy">
<div class="msgname"><a href="{$comment.Author.HomePage}" rel="nofollow" target="_blank">{$comment.Author.Name}</a>&nbsp;&nbsp;<span>{$comment.Time()}&nbsp;<a href="#comments" onclick="RevertComment('{$comment.ID}')">回复该留言</a></span></div>
<div class="msgarticle">{$comment.Content}
{foreach $comment.Comments as $comment}
{template:comment}
{/foreach}</div>
</div>
</div>
<div class="msgimg"><a href="{$comment.Author.HomePage}" rel="nofollow" target="_blank"><img class="avatar" src="{$comment.Author.Avatar}" alt="" width="32" /></a></div>
</div>