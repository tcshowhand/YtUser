
<div class="con" id="cmt<?php  echo $comment->ID;  ?>">
	<div class="conimg"><img src="<?php  echo $comment->Author->Avatar;  ?>" alt="<?php  echo $comment->Author->StaticName;  ?>" /></div>    
    <div class="conhr">
    <span class="lf"><?php  echo $comment->FloorID;  ?>楼&nbsp;&nbsp;<a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" target="_blank"><?php  echo $comment->Author->StaticName;  ?><?php if($comment->Author->Name == $article->Author->Name ) {echo '[楼主]';
    } ?>  </a></span>
    <span class="lr"><a href="#reply" onclick="zbp.comment.reply('<?php  echo $comment->ID;  ?>')">@Ta</a></span></div>
	<div class="contime" ><?php  echo $comment->Time();  ?> </div>
    <p class="conp"><?php  echo $comment->Content;  ?><i class="revertcomment"></i></p>
<div class="clrar"></div>
</div>
<div class="con2">
<?php  foreach ( $comment->Comments as $comment) { ?>
<?php  include $this->GetTemplate('comment2');  ?>
<?php }   ?>
</div>