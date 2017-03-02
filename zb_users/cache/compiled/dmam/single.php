<?php  /* Template Name:文章和页面 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
	<?php  include $this->GetTemplate('post-single');  ?>
<?php }else{  ?>
	<?php  include $this->GetTemplate('post-page');  ?>
<?php } ?>
<?php  include $this->GetTemplate('footer');  ?>