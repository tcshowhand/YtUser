{* Template Name:列表和首页 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:header}
<body class="D_M {$type}">
{template:b_nav_top}
<section class="am-container am-g">
	<div class="dm-container am-u-lg-8">
{if $page == '1'}
	{if $type == 'index'}{template:b_slide}{/if}
	{if dmam_GetCount('istop')}
	<div id="istop_title" class="am-titlebar am-titlebar-multi">
	<h2 class="am-titlebar-title"><i class="am-icon-bookmark-o"></i> 置顶推荐</h2>
	</div>
	<ul id="istop_list" class="am-gallery {php}echo dmam_istoplist('index'){/php}">
		{foreach $articles as $key=>$article}
		{if $article.IsTop}
		{template:post-istop}
		{/if}
		{/foreach}
	</ul>
	{/if}
{/if}

	{template:b_index_titlebar}
		{foreach $articles as $key=>$article}
		{if !$article.IsTop}
		{template:post-multi}
		{/if}
		{/foreach}
		{template:pagebar}
	</div>
	<aside class="dm-sider am-u-lg-4">
		{if $type != 'index'&&!$zbp->Config('dmam')->pjax}
		{template:sidebar2}
		{else}
		{template:sidebar}
		{/if}
	</aside>
{template:footer}