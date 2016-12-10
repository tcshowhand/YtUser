<div class="single">
	<div class="program">
		<div class="proname"><h2><?php  echo $article->Title;  ?></h2></div>
		<div class="pagecon">
			<?php  echo $article->Content;  ?>
		</div>
	</div>
	<div class="singlebanner"><?php  echo $zbp->Config('mizhe')->PostSINGLEADS;  ?></div>
	

	<?php if (!$article->IsLock) { ?>
	<?php  include $this->GetTemplate('comments');  ?>
	<?php } ?>
</div>