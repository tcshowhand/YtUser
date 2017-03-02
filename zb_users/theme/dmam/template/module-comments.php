{* Template Name:最新评论模块 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{php}
	$i = $zbp->modulesbyfilename['comments']->MaxLi;
    if ($i == 0)$i = 6;
    $comments = $zbp->GetCommentList(
	array('*'), 
	array(array('=','comm_IsChecking',0),array('not in','comm_Email',explode('|',$zbp->Config('dmam')->notinemail))), 
	array('comm_PostTime' => 'DESC'), 
	array($i), 
	null); 
{/php}
{foreach $comments as $comment}
{php}
$email = $comment->Author->Email?$comment->Author->Email:'';
{/php}
<li>
<a href="{$comment.Post.Url}#cmt-{$comment.ID}" title="{$comment.Author.StaticName} @ {$comment.Time('m月d日 H:i')} 评论了《{$comment->Post->Title}》">
<img {dmam_islasy('avatar',$comment.Author.Avatar)} class="avatar">
<p class="sidecom-hd">{$comment.Author.StaticName} <time>{$comment.Time('m月d日 H:i')}</time> 说:</p>
<p class="sidecom-bd">"{TransferHTML($comment->Content, '[noenter]')}"</p>
</a>
</li>
{/foreach}
