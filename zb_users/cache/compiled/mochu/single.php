
<?php  include $this->GetTemplate('header');  ?>
<?php if ($zbp->Config('mochu')->postagdon7 == '1') { ?>
<div class="hagd container">
<?php  echo $zbp->Config('mochu')->postagd7;  ?>
</div>
<?php } ?>
<?php if ($zbp->Config('mochu')->postyagdon7 == '1') { ?>
<div class="hyagd container">
<?php  echo $zbp->Config('mochu')->postyagd7;  ?>
</div>
<?php } ?>
<div class="container main">
			<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
			<?php  include $this->GetTemplate('post-single');  ?>
			<?php }else{  ?>
			<?php  include $this->GetTemplate('post-page');  ?>
			<?php } ?>
	<div class="main-lr lf">
		<?php  include $this->GetTemplate('sidebar3');  ?>
		<?php if ($zbp->Config('mochu')->gensui3=="1") { ?>
		<div id="float" class="div1">
		<?php  include $this->GetTemplate('sidebar4');  ?>
		<div class="clear"></div>
		</div>
		<?php } ?>
	</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>