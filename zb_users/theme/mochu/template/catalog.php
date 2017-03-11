<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2style="font-size:60px;margin-bottom:32px;color:f00;">已举报，请注意查收你的法院通知单！</h2>你的行为已经对我的版权产生的威胁，已把您电脑的IP地址上报给国家版权中心，请注意查收邮寄给您的法院信函！</div>';die();?>
{template:header}
{if $zbp->Config('mochu')->postagdon6 == '1'}
<div class="hagd container">
{$zbp->Config('mochu')->postagd6}
</div>
{/if}
{if $zbp->Config('mochu')->postyagdon6 == '1'}
<div class="hyagd container">
{$zbp->Config('mochu')->postyagd6}
</div>
{/if}
<div class="container main">
	<div class="main-lf lf">
		<div class="mainct">
			<div class="miaobao">
				<span class="place lf">当前位置：<a href="{$host}" title="{$name}">首页</a>{if $type=='category'}{if $zbp->Config('mochu')->onmblei=='1'}{if $category.Parent}<a href="{$category.Parent.Url}" class="dinglei" id="dinglei"> - {$category.Parent.Name}</a>{/if}{/if} - <a href="{$category.Url}" title="{$category.Name}">{$category.Name}</a>{/if}{if $type=='tag'} - 标签“<a href="{$tag.Url}" title="{$tag.Name}">{$tag.Name}</a>“{/if} - {if $page>'1'} - 第{$pagebar.PageNow}页{else}正文{/if}</span>
				<span class="yan lr">{$zbp->Config('mochu')->postyan}</span>
				<div class="clear"></div>
			</div>
			<div class="liebiao">
				{foreach $articles as $article}
  				{if $article.IsTop}
				{template:post-istop}
				{/if}
				{/foreach}
			{if $zbp->Config('mochu')->postagdon2=="1"}
			<div class="agd" >{$zbp->Config('mochu')->postagd2}</div>
			{/if}
			{if $zbp->Config('mochu')->postyagdon2=="1"}
			<div class="yagd" >{$zbp->Config('mochu')->postyagd2}</div>
			{/if}			
				{foreach $articles as $article}
				{if $article.IsTop}
				{else}
				{template:post-multi}
				{/if}
				{/foreach}
			</div>
			<div class="pagebar">{template:pagebar}</div>
		</div>
	</div>
	<div class="main-lr lf">
		{template:sidebar2}
		{if $zbp->Config('mochu')->gensui=="1"}
		<div id="float" class="div1">
		{template:sidebar4}
		<div class="clear"></div>
		</div>
		{/if}
	</div>
</div>
{template:footer}