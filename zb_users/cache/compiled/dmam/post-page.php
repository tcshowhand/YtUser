<?php  /* Template Name:独立页面 */  ?>

<aside id="pageside" class="dm-sider am-u-lg-2"> 
<?php if ($zbp->CheckPlugin('YtUser')) { ?><?php  include $this->GetTemplate('t_user_side');  ?><?php } ?>
	<?php if ($zbp->Config('dmam')->page_navi) { ?>
		<dl>
		<dd>
		<ul class="am-nav">
		<?php  echo $zbp->Config('dmam')->page_navi;  ?>
		</ul>
		</dd>
		</dl>
	<?php } ?>
	</aside>
	<div class="dm-container <?php  echo $article->Metas->post_nosidebar?'am-u-lg-10':'am-u-lg-7';  ?>">
		<article class="dm-post am-article article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
		  <header class="am-article-hd">
			<h1 class="am-article-title"><?php  echo $article->Title;  ?></h1>
		  </header>
		  <section class="am-article-bd">
		  <?php  echo $article->Content;  ?>
			  <?php  if (isset($pagefix))echo $pagefix; ?>
		  </section>
		</article>
		<?php if (!$article->IsLock) { ?>
		<?php  include $this->GetTemplate('comments');  ?>
		<?php } ?>
	</div>
	<?php if (!$article->Metas->post_nosidebar) { ?>
		<aside class="dm-sider am-u-lg-3">
		<?php if (!$zbp->Config('dmam')->pjax) { ?>
			<?php  include $this->GetTemplate('sidebar4');  ?>
			<?php }else{  ?>
			<?php  include $this->GetTemplate('sidebar');  ?>
		<?php } ?>
		</aside>
	<?php } ?>