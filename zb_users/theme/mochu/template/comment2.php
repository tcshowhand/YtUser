<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
<div class="con" id="cmt{$comment.ID}">
	<div class="conimg"><img src="{$comment.Author.Avatar}" alt="{$comment.Author.StaticName}" /></div>    
    <div class="conhr">
    <span class="lf"><a href="{$comment.Author.HomePage}" rel="nofollow" target="_blank">{$comment.Author.StaticName}
    {php}if($comment->Author->Name == $article->Author->Name ){echo '[楼主]';}{/php}    
    </a></span>
    <span class="lr conhrhui"><a href="#reply" onclick="zbp.comment.reply('{$comment.ID}')">@Ta</a></span></div>
	<div class="contime" >{$comment.Time()} </div>    
	<p class="conp"><span class="conpspan">{$a=$comment.ParentID}{php}$coname = '';
$ar =  $zbp->GetCommentList(array('*'), array( array('=','comm_ID',$a)),'','1','');
if(empty($ar)){$coname = '无名氏';}
else{
foreach ($ar as $re){
$coname = $re->Name;
}
if($coname == $article->Author->Name){
$coname = $article->Author->StaticName;
$coname = "$coname{楼主}";
}}echo "@$coname";{/php}</span>：{$comment.Content}<i class="revertcomment"></i></p>
<div class="clrar"></div>
</div>
{foreach $comment.Comments as $comment}
{template:comment2}
{/foreach}