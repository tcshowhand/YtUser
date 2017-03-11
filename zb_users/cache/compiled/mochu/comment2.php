
<div class="con" id="cmt<?php  echo $comment->ID;  ?>">
	<div class="conimg"><img src="<?php  echo $comment->Author->Avatar;  ?>" alt="<?php  echo $comment->Author->StaticName;  ?>" /></div>    
    <div class="conhr">
    <span class="lf"><a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" target="_blank"><?php  echo $comment->Author->StaticName;  ?>
    <?php if($comment->Author->Name == $article->Author->Name ){echo '[楼主]';} ?>    
    </a></span>
    <span class="lr conhrhui"><a href="#reply" onclick="zbp.comment.reply('<?php  echo $comment->ID;  ?>')">@Ta</a></span></div>
	<div class="contime" ><?php  echo $comment->Time();  ?> </div>    
	<p class="conp"><span class="conpspan"><?php  $a=$comment->ParentID;  ?><?php $coname = '';
$ar =  $zbp->GetCommentList(array('*'), array( array('=','comm_ID',$a)),'','1','');
if(empty($ar)){$coname = '无名氏';}
else{
foreach ($ar as $re){
$coname = $re->Name;
}
if($coname == $article->Author->Name){
$coname = $article->Author->StaticName;
$coname = "$coname{楼主}";
}}echo "@$coname"; ?></span>：<?php  echo $comment->Content;  ?><i class="revertcomment"></i></p>
<div class="clrar"></div>
</div>
<?php  foreach ( $comment->Comments as $comment) { ?>
<?php  include $this->GetTemplate('comment2');  ?>
<?php }   ?>