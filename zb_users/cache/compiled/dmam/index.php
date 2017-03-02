<?php  /* Template Name:列表和首页 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
	<div class="dm-container am-u-lg-8">
<?php if ($page == '1') { ?>
	<?php if ($type == 'index') { ?><?php  include $this->GetTemplate('b_slide');  ?><?php } ?>
	<?php if (dmam_GetCount('istop')) { ?>
	<div id="istop_title" class="am-titlebar am-titlebar-multi"><div class="am-titlebar-title am-icon-bookmark-o"> 置顶推荐</div></div>
	<ul id="istop_list" class="am-gallery <?php echo dmam_istoplist('index') ?>">
		<?php  foreach ( $articles as $key=>$article) { ?>
		<?php if ($article->IsTop) { ?>
		<?php  include $this->GetTemplate('post-istop');  ?>
		<?php } ?>
		<?php }   ?>
	</ul>
	<?php } ?>
<?php } ?>

	<?php  include $this->GetTemplate('b_index_titlebar');  ?>
		<?php  foreach ( $articles as $key=>$article) { ?>
		<?php if (!$article->IsTop) { ?>
		<?php  include $this->GetTemplate('post-multi');  ?>
		<?php } ?>
		<?php }   ?>
		<?php  include $this->GetTemplate('pagebar');  ?>
	</div>
	<aside class="dm-sider am-u-lg-4">
		<?php if ($type != 'index' && $page != '1' && !$zbp->Config('dmam')->pjax) { ?>
		<?php  include $this->GetTemplate('sidebar2');  ?>
		<?php }else{  ?>
		<?php  include $this->GetTemplate('sidebar');  ?>
		<?php } ?>
	</aside>
<?php  include $this->GetTemplate('footer');  ?>