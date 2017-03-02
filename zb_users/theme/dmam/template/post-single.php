{* Template Name:文章页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
	<div class="dm-container {$article->Metas->post_nosidebar?'am-u-lg-12':'am-u-lg-8'}">
		<ol class="am-breadcrumb">
		<li><a href="{$host}"><i class="am-icon-home"></i> 首页</a></li>
		{php}
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
		{/php}
		<li class="am-active">{$article.Title}</li>
		</ol>

		<article class="dm-post am-article article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">

		  <header class="am-article-hd">
			<h1 class="am-article-title">{$article.Title}</h1>
				<p class="dm-meta am-article-meta">
					<span class="am-icon-th"> 分类：<a href="{$article.Category.Url}" rel="category tag">{$article.Category.Name}</a></span>
						{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：
						{if $article->Metas->post_author_url}
							<a href="{$article->Metas->post_author_url}" target="_blank" rel="external nofollow">{$article->Metas->post_author}</a>
						{else}
							{$article->Metas->post_author}
						{/if}
						</span>{/if}
					<span class="am-icon-eye"> 阅读：({$article.ViewNums})</span>
					<span class="am-icon-comment-o"> 评论：({$article.CommNums})</span>
				</p>
		  </header>
		  <section class="am-article-bd">
		   {if $zbp->Config('dmam')->article_intro && trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),80))}
		   <p class="am-article-lead">{trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),80))}</p>
		   {/if}
		  {$article.Content}

		  </section>
			{if count($article.Tags)}
			<h4 class="dm-article-tags am-icon-tag"> 标签: {foreach $article.Tags as $tag}<a href="{$tag.Url}">{$tag.Name}</a>{/foreach}</h4>
			{/if}
			{if $zbp->Config('dmam')->article_copy ==1}
			<div class="dm-article-copyright"><span>{$article.Author.StaticName}</span><time>发布于：{$article.Time('Y年m月d日')}</time></div>
			{else}
			{/if}
{php}
$dm_social = array();
$dm_social_n = '';
if ($zbp->Config('dmam')->article_prise)$dm_social['prise'] = true;
if ($zbp->Config('dmam')->article_share)$dm_social['share'] = true;
if ($zbp->Config('dmam')->pics_skm)$dm_social['skm'] = true;
$dm_social_n = count($dm_social);
{/php}
<ul class="dm-article-social am-avg-sm-{$dm_social_n}">
<!-- <li><a href="javascript:;" class="fav_button am-icon-star-o"> 收藏</a></li> -->
{if $zbp->Config('dmam')->article_prise}<li>{dmam_prise_html($article->ID)}</li>{/if}
{if $zbp->Config('dmam')->article_share}<li><a href="javascript: void(0)" class="am-icon-share-square-o" data-am-toggle="share"> 分享</a></li>{/if}
{if $zbp->Config('dmam')->pics_skm}<li><a href="javascript:void(0)" class="skm_button am-icon-rmb" data-am-modal="{target: '#skm-modal', closeViaDimmer: true, width: 200}" data-pic="{$zbp->Config('dmam')->pics_skm}"> 赏一个</a></li>{/if}

</ul>
		<nav class="article-nav">
		{if $article.Prev}<span class="article-nav-prev">上一篇</br><a href="{$article.Prev.Url}" rel="prev">{$article.Prev.Title}</a></span>{/if}
		{if $article.Next}<span class="article-nav-next">下一篇</br><a href="{$article.Next.Url}" rel="next">{$article.Next.Title}</a></span>{/if}
		</nav>
		</article>
		{if $zbp->Config('dmam')->article_relevant}
		{template:b_isrelated}
		{/if}
		{if !$article.IsLock}
		{template:comments}
		{/if}

	</div>
	{if !$article->Metas->post_nosidebar}
	<aside class="dm-sider am-u-lg-4">
	{if !$zbp->Config('dmam')->pjax}
		{template:sidebar3}
		{else}
		{template:sidebar}
	{/if}
	</aside>
	{/if}