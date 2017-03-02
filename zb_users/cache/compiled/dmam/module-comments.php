<?php  /* Template Name:最新评论模块 */  ?>

<?php 
	$i = $zbp->modulesbyfilename['comments']->MaxLi;
    if ($i == 0)$i = 6;
    $comments = $zbp->GetCommentList(
	array('*'), 
	array(array('=','comm_IsChecking',0),array('not in','comm_Email',explode('|',$zbp->Config('dmam')->notinemail))), 
	array('comm_PostTime' => 'DESC'), 
	array($i), 
	null); 
 ?>
<?php  foreach ( $comments as $comment) { ?>
<?php 
$email = $comment->Author->Email?$comment->Author->Email:'';
 ?>
<li>
<a href="<?php  echo $comment->Post->Url;  ?>#cmt-<?php  echo $comment->ID;  ?>" title="<?php  echo $comment->Author->StaticName;  ?> @ <?php  echo $comment->Time('m月d日 H:i');  ?> 评论了《<?php  echo $comment->Post->Title;  ?>》">
<img <?php  echo dmam_islasy('avatar',$comment->Author->Avatar);  ?> class="avatar">
<p class="sidecom-hd"><?php  echo $comment->Author->StaticName;  ?> <time><?php  echo $comment->Time('m月d日 H:i');  ?></time> 说:</p>
<p class="sidecom-bd">"<?php  echo TransferHTML($comment->Content, '[noenter]');  ?>"</p>
</a>
</li>
<?php }   ?>
