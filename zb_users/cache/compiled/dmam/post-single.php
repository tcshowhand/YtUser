<?php  /* Template Name:文章页面 */  ?> 

	<div class="dm-container <?php  echo $article->Metas->post_nosidebar?'am-u-lg-12':'am-u-lg-8';  ?>">
		<ol class="am-breadcrumb">
		<li><a href="<?php  echo $host;  ?>"><i class="am-icon-home"></i> 首页</a></li>
		<?php 
		$html='';
		function navcate($id){
		global $html;
		$cate = new Category;
		$cate->LoadInfoByID($id);
		$html ='<li><a href="' .$cate->Url.'" title="查看' .$cate->Name. '中的全部文章">' .$cate->Name. '</a></li>'.$html;
		if(($cate->ParentID)>0){navcate($cate->ParentID);}
		}
		navcate($article->Category->ID);
		global $html;
		echo $html;
		 ?>
		<li class="am-active"><?php  echo $article->Title;  ?></li>
		</ol>

		<article class="dm-post am-article article-<?php  echo $article->ID;  ?> cate-<?php  echo $article->Category->ID;  ?> auth-<?php  echo $article->Author->ID;  ?>">

		  <header class="am-article-hd">
			<h1 class="am-article-title"><?php  echo $article->Title;  ?></h1>
				<p class="dm-meta am-article-meta">
					<span class="am-icon-th"> 分类：<a href="<?php  echo $article->Category->Url;  ?>" rel="category tag"><?php  echo $article->Category->Name;  ?></a></span>
						<?php if ($article->Metas->post_author) { ?><span class="am-icon-globe"> 来源：
						<?php if ($article->Metas->post_author_url) { ?>
							<a href="<?php  echo $article->Metas->post_author_url;  ?>" target="_blank" rel="external nofollow"><?php  echo $article->Metas->post_author;  ?></a>
						<?php }else{  ?>
							<?php  echo $article->Metas->post_author;  ?>
						<?php } ?>
						</span><?php } ?>
					<span class="am-icon-eye"> 阅读：(<?php  echo $article->ViewNums;  ?>)</span>
					<span class="am-icon-comment-o"> 评论：(<?php  echo $article->CommNums;  ?>)</span>
				</p>
		  </header>
		  <section class="am-article-bd">
		   <?php if (!GetVars('pagenum', 'GET') && $zbp->Config('dmam')->article_intro && trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),80))) { ?>
		   <p class="am-article-lead"><?php  echo trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),80));  ?></p>
		   <?php } ?>
		<?php  echo $article->Content;  ?>
		  </section>
			<?php if (count($article->Tags)) { ?>
			<h4 class="dm-article-tags am-icon-tag"> 标签: <?php  foreach ( $article->Tags as $tag) { ?><a href="<?php  echo $tag->Url;  ?>"><?php  echo $tag->Name;  ?></a><?php }   ?></h4>
			<?php } ?>
			<?php if ($zbp->Config('dmam')->article_copy ==1) { ?>
			<div class="dm-article-copyright"><span><?php  echo $article->Author->StaticName;  ?></span><time>发布于：<?php  echo $article->Time('Y年m月d日');  ?></time></div>
			<?php }else{  ?>
			<?php } ?>
<?php 
$dm_social = array();
$dm_social_n = '';
if ($zbp->Config('dmam')->article_prise)$dm_social['prise'] = true;
if ($zbp->Config('dmam')->article_share)$dm_social['share'] = true;
if ($zbp->Config('dmam')->pics_skm)$dm_social['skm'] = true;
$dm_social_n = count($dm_social);
 ?>
<ul class="dm-article-social am-avg-sm-<?php  echo $dm_social_n;  ?>">
<!-- <li><a href="javascript:;" class="fav_button am-icon-star-o"> 收藏</a></li> -->
<?php if ($zbp->Config('dmam')->article_prise) { ?><li><?php  echo dmam_prise_html($article->ID);  ?></li><?php } ?>
<?php if ($zbp->Config('dmam')->article_share) { ?><li><a href="javascript: void(0)" class="am-icon-share-square-o" data-am-toggle="share"> 分享</a></li><?php } ?>
<?php if ($zbp->Config('dmam')->pics_skm) { ?><li><a href="javascript:void(0)" class="skm_button am-icon-rmb" data-am-modal="{target: '#skm-modal', closeViaDimmer: true, width: 200}" data-pic="<?php  echo $zbp->Config('dmam')->pics_skm;  ?>"> 赏一个</a></li><?php } ?>

</ul>
		<nav class="article-nav">
		<?php if ($article->Prev) { ?><span class="article-nav-prev">上一篇</br><a href="<?php  echo $article->Prev->Url;  ?>" rel="prev"><?php  echo $article->Prev->Title;  ?></a></span><?php } ?>
		<?php if ($article->Next) { ?><span class="article-nav-next">下一篇</br><a href="<?php  echo $article->Next->Url;  ?>" rel="next"><?php  echo $article->Next->Title;  ?></a></span><?php } ?>
		</nav>
		</article>
		<?php if ($zbp->Config('dmam')->article_relevant) { ?>
		<?php  include $this->GetTemplate('b_isrelated');  ?>
		<?php } ?>
		<?php if (!$article->IsLock) { ?>
		<?php  include $this->GetTemplate('comments');  ?>
		<?php } ?>

	</div>
	<?php if (!$article->Metas->post_nosidebar) { ?>
	<aside class="dm-sider am-u-lg-4">
	<?php if (!$zbp->Config('dmam')->pjax) { ?>
		<?php  include $this->GetTemplate('sidebar3');  ?>
		<?php }else{  ?>
		<?php  include $this->GetTemplate('sidebar');  ?>
	<?php } ?>
	</aside>
	<?php } ?>