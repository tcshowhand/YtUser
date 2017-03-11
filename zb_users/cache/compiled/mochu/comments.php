<div class="pinglunnr">
<?php  include $this->GetTemplate('commentpost');  ?>
<br />
<?php if ($socialcomment) { ?>
<?php  echo $socialcomment;  ?>
<?php }else{  ?>
<label id="AjaxCommentBegin"></label>
<?php  foreach ( $comments as $key => $comment) { ?>
<?php  include $this->GetTemplate('comment');  ?>
<?php }   ?>
<div class="pagebar commentpagebar">
<?php  include $this->GetTemplate('pagebar');  ?>
</div>
<label id="AjaxCommentEnd"></label>
<?php } ?></div>