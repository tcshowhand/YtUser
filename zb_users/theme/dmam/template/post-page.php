{* Template Name:独立页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
<aside id="pageside" class="dm-sider am-u-lg-2"> 
{if $zbp->CheckPlugin('YtUser')}{template:t_user_side}{/if}
	{if $zbp->Config('dmam')->page_navi}
		<dl>
		<dd>
		<ul class="am-nav">
		{$zbp->Config('dmam')->page_navi}
		</ul>
		</dd>
		</dl>
	{/if}
	</aside>
	<div class="dm-container {$article->Metas->post_nosidebar?'am-u-lg-10':'am-u-lg-7'}">
		<article class="dm-post am-article article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
		  <header class="am-article-hd">
			<h1 class="am-article-title">{$article.Title}</h1>
		  </header>
		  <section class="am-article-bd">
		  {$article.Content}
			  {php} if (isset($pagefix))echo $pagefix;{/php}
		  </section>
		</article>
		{if !$article.IsLock}
		{template:comments}
		{/if}
	</div>
	{if !$article->Metas->post_nosidebar}
		<aside class="dm-sider am-u-lg-3">
		{if !$zbp->Config('dmam')->pjax}
			{template:sidebar4}
			{else}
			{template:sidebar}
		{/if}
		</aside>
	{/if}