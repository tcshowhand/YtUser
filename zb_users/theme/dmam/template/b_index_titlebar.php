{* Template Name:列表标题 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{if $type == 'index'}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-clock-o"> 最近更新</div>
  <nav class="am-titlebar-nav">
  {$zbp->Config('dmam')->index_titlebar_nav}
  </nav>
</div>
{elseif $type=='category'}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-folder-open-o"> {$category.Name}</div>
	{if isset($pagebar->PageAll)||isset($pagebar->PageNow)}
	  <nav class="am-titlebar-nav">共{$pagebar.PageAll}页，当前第{$pagebar.PageNow}页</nav>
	{else}
	  <nav class="am-titlebar-nav">没有内容</nav>
	{/if}
</div>
{elseif $type=='search'}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-search"> "{if isset($searchq)}{$searchq}{/if}" 的搜索结果</div>
	{if isset($pagebar->PageAll)||isset($pagebar->PageNow)}
	  <nav class="am-titlebar-nav">共{$pagebar.PageAll}页，当前第{$pagebar.PageNow}页</nav>
	{else}
	  <nav class="am-titlebar-nav">没有内容</nav>
	{/if}
</div>
{elseif $type=='tag'}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-tag"> Tag "{$tag.Name}" 相关内容</div>
	{if isset($pagebar->PageAll)||isset($pagebar->PageNow)}
	  <nav class="am-titlebar-nav">共{$pagebar.PageAll}页，当前第{$pagebar.PageNow}页</nav>
	{else}
	  <nav class="am-titlebar-nav">没有内容</nav>
	{/if}
</div>
{elseif $type=='date'}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-calendar"> Date-{$title}</div>
	{if isset($pagebar->PageAll)||isset($pagebar->PageNow)}
	  <nav class="am-titlebar-nav">共{$pagebar.PageAll}页，当前第{$pagebar.PageNow}页</nav>
	{else}
	  <nav class="am-titlebar-nav">没有内容</nav>
	{/if}
</div>
{else}
<div class="am-titlebar am-titlebar-multi">
  <div class="am-titlebar-title am-icon-square-o"> {$type}</div>
	{if isset($pagebar->PageAll)||isset($pagebar->PageNow)}
	  <nav class="am-titlebar-nav">共{$pagebar.PageAll}页，当前第{$pagebar.PageNow}页</nav>
	{else}
	  <nav class="am-titlebar-nav">没有内容</nav>
	{/if}
</div>
{/if}