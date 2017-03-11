
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
				<span class="place lf">当前位置：<a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>">首页</a><?php if ($type=='category') { ?><?php if ($zbp->Config('mochu')->onmblei=='1') { ?><?php if ($category->Parent) { ?><a href="<?php  echo $category->Parent->Url;  ?>" class="dinglei" id="dinglei"> - <?php  echo $category->Parent->Name;  ?></a><?php } ?><?php } ?> - <a href="<?php  echo $category->Url;  ?>" title="<?php  echo $category->Name;  ?>"><?php  echo $category->Name;  ?></a><?php } ?><?php if ($type=='tag') { ?> - 标签“<a href="<?php  echo $tag->Url;  ?>" title="<?php  echo $tag->Name;  ?>"><?php  echo $tag->Name;  ?></a>“<?php } ?> - <?php if ($page>'1') { ?> - 第<?php  echo $pagebar->PageNow;  ?>页<?php }else{  ?>正文<?php } ?></span>
				<span class="yan lr"><?php  echo $zbp->Config('mochu')->postyan;  ?></span>
				<div class="clear"></div>
			</div>
			<div class="liebiao">
				<?php  foreach ( $articles as $article) { ?>
  				<?php if ($article->IsTop) { ?>
				<?php  include $this->GetTemplate('post-istop');  ?>
				<?php } ?>
				<?php }   ?>
			<?php if ($zbp->Config('mochu')->postagdon2=="1") { ?>
			<div class="agd" ><?php  echo $zbp->Config('mochu')->postagd2;  ?></div>
			<?php } ?>
			<?php if ($zbp->Config('mochu')->postyagdon2=="1") { ?>
			<div class="yagd" ><?php  echo $zbp->Config('mochu')->postyagd2;  ?></div>
			<?php } ?>			
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