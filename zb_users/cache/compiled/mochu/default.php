
<?php  include $this->GetTemplate('header');  ?><?php if ($zbp->Config('mochu')->postagdon5 == '1') { ?><div class="hagd container">
<?php  echo $zbp->Config('mochu')->postagd5;  ?></div><?php } ?>
<?php if ($zbp->Config('mochu')->postyagdon5 == '1') { ?><div class="hyagd container">
<?php  echo $zbp->Config('mochu')->postyagd5;  ?></div><?php } ?>
<div class="container main">
	<div class="main-lf lf">
		<div class="mainct">
			<div class="miaobao">
			<div class="postt"> <div class="noticet"> <ul><li></li><li><?php  echo $zbp->Config('mochu')->postgao;  ?></li></ul></div></div>
			</div>
			<?php if ($zbp->Config('mochu')->onhuandeng=="1" ) { ?>
			<?php  include $this->GetTemplate('mochu_huandeng');  ?>
			<?php } ?>
			<div class="liebiao">
				<?php  foreach ( $articles as $article) { ?>
  				<?php if ($article->IsTop) { ?>
				<?php  include $this->GetTemplate('post-istop');  ?>
				<?php } ?>
				<?php }   ?>
<?php if ($zbp->Config('mochu')->postagdon=="1") { ?><div class="agd" ><?php  echo $zbp->Config('mochu')->postagd;  ?></div><?php } ?>
<?php if ($zbp->Config('mochu')->postyagdon=="1") { ?><div class="yagd" ><?php  echo $zbp->Config('mochu')->postyagd;  ?></div><?php } ?>
			    <?php  foreach ( $articles as $article) { ?>
				<?php if ($article->IsTop) { ?>
				<?php }else{  ?>
				<?php  include $this->GetTemplate('post-multi');  ?>
				<?php } ?>
				<?php }   ?>
			</div>
			<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?></div>
		</div>
	</div>
<div class="main-lr lf">
		<?php  include $this->GetTemplate('sidebar');  ?>
<?php if ($zbp->Config('mochu')->gensui=="1") { ?>
<div id="float" class="div1">
<?php  include $this->GetTemplate('sidebar4');  ?>
<div class="clear"></div>
</div><?php } ?></div>
<div class="clear"></div></div>
<?php  include $this->GetTemplate('footer');  ?>