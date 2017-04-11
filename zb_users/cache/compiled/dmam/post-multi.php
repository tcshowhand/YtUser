<?php  /* Template Name:自定义列表 */  ?>

<?php 
$img_cover = '';
$img_cover = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
if ($zbp->CheckPlugin('dm_tools')) {
	dm_tools_thumb::getPics($article,400,250,4);
	if ($article->dm_tools_thumb_COUNT>0){
		$img_cover = $article->dm_tools_thumb[0];
		if ($article->Metas->post_style_order && $article->Metas->post_style_order > 1 && !strpos($article->Metas->post_style_order,',')){
		$img_cover = $article->dm_tools_thumb[$article->Metas->post_style_order-1];
		}
	}
	$img_cover = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,400,250,4):$img_cover;
}
 ?>
<?php if ($article->Metas->post_style == "txt") { ?>
<article class="dm-multi dm-multi-0 article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
		<div class="dm-multi-content am-u-sm-12">
		<h2 class="am-article-title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
		<p class="dm-multi-intro"><?php  echo dmam_txt($article,$zbp->Config('dmam')->kgintro,140,'...');  ?></p>
		<p class="dm-meta">
		<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：<?php  echo $article->Metas->post_author;  ?></span><?php } ?>
		<span class="am-icon-eye"> 热度：<?php  echo $article->ViewNums;  ?> ℃</span>
		<span class="am-icon-comment-o"> 评论：<?php  echo $article->CommNums;  ?> 次</span>
		<time class="am-icon-clock-o"> <?php  echo dmam_NewTime($article->Time());  ?></time>
		</p>
		</div>
</article>
<?php }elseif($article->Metas->post_style == "pic") {  ?>
<article class="dm-multi dm-multi-1 article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
<?php if ($img_cover) { ?>
		<div class="dm-multi-img am-u-sm-4">
		<a href="<?php  echo $article->Url;  ?>">
		<img <?php  echo dmam_islasy('',$img_cover);  ?> alt="<?php  echo $article->Title;  ?>">
		</a>
		</div>
<?php } ?>
		<div class="dm-multi-content am-u-sm-8">
		<h2 class="am-article-title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
		<p class="dm-multi-intro"><?php  echo dmam_txt($article,$zbp->Config('dmam')->kgintro,100,'...');  ?></p>
		<p class="dm-meta">
		<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：<?php  echo $article->Metas->post_author;  ?></span><?php } ?>
		<span class="am-icon-eye"> 热度：<?php  echo $article->ViewNums;  ?> ℃</span>
		<span class="am-icon-comment-o"> 评论：<?php  echo $article->CommNums;  ?> 次</span>
		<time class="am-icon-clock-o"> <?php  echo dmam_NewTime($article->Time());  ?></time>
		</p>
		</div>
</article>
<?php }elseif($article->Metas->post_style == "video") {  ?>
<article class="dm-multi dm-multi-v article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
<?php if ($img_cover) { ?>
	<div class="dm-multi-img am-u-sm-4">
	<a href="<?php  echo $article->Url;  ?>">
	<img <?php  echo dmam_islasy('',$img_cover);  ?> alt="<?php  echo $article->Title;  ?>">
	</a>
	<a class="onimg" href="<?php  echo $article->Url;  ?>">
	<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/z.png" alt="<?php  echo $article->Title;  ?>">
	</a>
	</div>
<?php } ?>
	<div class="dm-multi-content am-u-sm-8">
	<h2 class="am-article-title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
	<p class="dm-multi-intro"><?php  echo dmam_txt($article,$zbp->Config('dmam')->kgintro,120,'...');  ?></p>
	<p class="dm-meta">
	<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：<?php  echo $article->Metas->post_author;  ?></span><?php } ?>
	<span class="am-icon-eye"> 热度：<?php  echo $article->ViewNums;  ?> ℃</span>
	<span class="am-icon-comment-o"> 评论：<?php  echo $article->CommNums;  ?> 次</span>
	<time class="am-icon-clock-o"> <?php  echo dmam_NewTime($article->Time());  ?></time>
	</p>
	</div>
</article>
<?php }elseif($article->Metas->post_style == "pro") {  ?>
<article class="dm-multi dm-multi-1 article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
<?php if ($img_cover) { ?>
		<div class="dm-multi-img am-u-sm-4">
		<a href="<?php  echo $article->Url;  ?>">
		<img <?php  echo dmam_islasy('',$img_cover);  ?> alt="<?php  echo $article->Title;  ?>">
		</a>
		</div>
<?php } ?>
		<div class="dm-multi-content am-u-sm-8">
		<h2 class="am-article-title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
		<ul class="dm-multi-list">
		<?php  echo dmam_multi_pro($article->Metas->post_ispro_ids);  ?>
		</ul>
				<p class="dm-meta">
		<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：<?php  echo $article->Metas->post_author;  ?></span><?php } ?>
		<span class="am-icon-eye"> 热度：<?php  echo $article->ViewNums;  ?> ℃</span>
		<span class="am-icon-comment-o"> 评论：<?php  echo $article->CommNums;  ?> 次</span>
		<time class="am-icon-clock-o"> <?php  echo dmam_NewTime($article->Time());  ?></time>
		</p>
		</div>
</article>
<?php }elseif($article->Metas->post_style == "pics") {  ?>
<article class="dm-multi dm-multi-s article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">
<h2 class="am-article-title"><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></h2>
<?php if ($article->dm_tools_thumb_COUNT>=3) { ?>
<ul class="dm-multi-imgs am-avg-sm-3 am-u-sm-12">
<?php 
$img_orders = array(1,2,3);
$img_orders = strpos($article->Metas->post_style_order,',')?explode(',',$article->Metas->post_style_order):$img_orders;
foreach ($img_orders as $img_order){
	echo '<li><a href="'.$article->Url.'"><img '.dmam_islasy('',$article->dm_tools_thumb[$img_order-1]).' alt="'.$article->Title.'" /></a></li>';
}
 ?>
</ul>
<?php } ?>
		<div class="dm-multi-content am-u-sm-12">
		<p class="dm-multi-intro"><?php  echo dmam_txt($article,$zbp->Config('dmam')->kgintro,40,'...');  ?></p>
		<p class="dm-meta">
		<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：<?php  echo $article->Metas->post_author;  ?></span><?php } ?>
		<span class="am-icon-eye"> 热度：<?php  echo $article->ViewNums;  ?> ℃</span>
		<span class="am-icon-comment-o"> 评论：<?php  echo $article->CommNums;  ?> 次</span>
		<time class="am-icon-clock-o"> <?php  echo dmam_NewTime($article->Time());  ?></time>
		</p>
		</div>
</article>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-multi-auto');  ?>
<?php } ?>