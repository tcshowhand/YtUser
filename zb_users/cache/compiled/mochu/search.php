
<?php  include $this->GetTemplate('header');  ?>
<?php if ($zbp->Config('mochu')->postagdon6 == '1') { ?>
<div class="hagd container">
<?php  echo $zbp->Config('mochu')->postagd6;  ?>
</div>
<?php } ?>
<?php if ($zbp->Config('mochu')->postyagdon6 == '1') { ?>
<div class="hyagd container">
<?php  echo $zbp->Config('mochu')->postyagd6;  ?>
</div>
<?php } ?>
<div class="container main">
	<div class="main-lf lf">
		<div class="mainct">
			<div class="miaobao">
				<h4 class="place lf">当前位置：<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">首页</a> - <?php  echo $title;  ?> - 正文</h4>
				<h4 class="yan lr"><?php  echo $zbp->Config('mochu')->postyan;  ?></h4>
				<div class="clear"></div>
			</div>
			<div class="liebiao">
				<?php  foreach ( $articles as $article) { ?>			
				<?php  include $this->GetTemplate('post-multi');  ?>			
				<?php }   ?>
			</div>
			<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?></div>
		</div>
	</div>
	<div class="main-lr lf">
		<?php  include $this->GetTemplate('sidebar2');  ?>
		<?php if ($zbp->Config('mochu')->gensui=="1") { ?>
		<div id="float" class="div1">
		<?php  include $this->GetTemplate('sidebar4');  ?>
		<div class="clear"></div>
		</div>
		<?php } ?>
	</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>