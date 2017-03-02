{* Template Name:分页导航 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
	{if $pagebar}
	{if $zbp->Config('dmam')->pagenav_style}
	<nav{if $type} class="nav-{$type}"{/if}>
	<ul class="dm-pagination am-pagination">
		{foreach $pagebar.buttons as $k=>$v}
			{if $k == '‹'}
			<li class="am-pagination-prev prev-page"><a href="{$v}">{$k}</a></li>
			{elseif $k == '›'}
			<li class="am-pagination-next next-page"><a href="{$v}">{$k}</a></li>
			{else}

			{/if}
		{/foreach}
	</ul>
	</nav>
	{else}
	<nav{if $type} class="nav-{$type}"{/if}>
	<ul class="dm-pagination am-pagination am-pagination-centered">
		{foreach $pagebar.buttons as $k=>$v}
		{if $pagebar.PageNow==$k}
		<li class="am-active"><span>{$k}</span></li>
		{else}
			{if $k == '‹'}
			<li class="prev-page">
			{elseif $k == '›'}
			<li class="next-page">
			{else}
			<li>
			{/if}
			<a href="{$v}">{$k}</a>
			</li>
		{/if}
		{/foreach}
		<li><span>总计{$pagebar.PageAll}页</span></li>
	</ul>
	</nav>
	{/if}
	{/if}
