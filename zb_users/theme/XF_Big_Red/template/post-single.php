<?php echo'
	<meta charset="UTF-8">
	<div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Theme ID: XF_Big_Red</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author: 小锋博客</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author URI: Www.SongHaiFeng.Com</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author QQ: 284204003</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author Email: 284204003@qq.com</h2>
	</div>
';die();?>
<div class="hclc">
	<article>
		<h1>{$article.Title}</h1>
		<div class="contInfo">
			<div class="floatL">
				<span id="pubtime_baidu">{$article.Time('Y/m/d')}</span>
				<span id="source_baidu">栏目：<a href="{$article.Category.Url}">{$article.Category.Name}</a></span>
			</div>
			<div class="floatR">
				<style type="text/css">.bshare-custom{font-size:12px!important;}.bshare-custom a{margin:0 3px!important;line-height:16px;}#bsLogoList li{padding-left:0;background:none;}.b-drag{border-radius:0!important;}.b-drag-arrow{left:0!important;}</style>
				<div class="bshare-custom">
					<div class="bsPromo bsPromo2"></div>
					<span>TAG：</span> {if $article.Tags}{foreach $article.Tags as $tag}<a href="{$tag.Url}" title="{$tag.Name}" class="label bg-primary">{$tag.Name}</a>{/foreach}{else}本文暂时没有添加标签{/if}
				</div>
			</div>
		</div>
		<div class="content">{$article.Content}</div>
		<div class="copyright">
			<p>本文标题：{$article.Title}</p>
			<p class="url">本文链接：{$article.Url}</p>
			<p>本文声明：除注明转载/出处外，均为本站原创或翻译，转载请务必注明出处。</p>
		</div>
		<div class="prev-next">
			<ul>
				<li class="prev">上一篇：{if $article.Prev}<a href="{$article.Prev.Url}" title="{$article.Prev.Title}">{$article.Prev.Title}</a>{else}已是最新文章{/if}</li>
				<li class="next">下一篇：{if $article.Next}<a href="{$article.Next.Url}" title="{$article.Next.Title}">{$article.Next.Title}</a>{else}已是最新文章{/if}</li>
			</ul>
		</div>
	</article>
	{if !$article.IsLock}
		{template:comments}
	{/if}
</div>