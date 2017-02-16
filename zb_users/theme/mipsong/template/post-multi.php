<li class="cate{$article.Category.ID} auth{$article.Author.ID}">
	<div class="timg">
		{php}
		  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		  $content = $article->Content;
		  preg_match_all($pattern,$content,$matchContent);
		  if(isset($matchContent[1][0]))
		  $temp=$matchContent[1][0];
		  else
		  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
		{/php}
		<a href="{$article.Url}" title="{$article.Title}"><img src="{$temp}" alt="{$article.Title}" /></a>
		<div class="tinfo"><a href="{$article.Url}" title="{$article.Title}">{$article.Title}</a></div>
	</div>
	<div class="tsale">
		{if $article.Metas.proprice} <span class="tprice">￥<i>{$article.Metas.proprice}</i></span> {else}<span class="noprice">暂无报价</span> {/if}
		<span class="tother"><p>
{php}
	if ($article->Metas->proprice && $article->Metas->promarket) {
		echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';
	}else{
		echo '';
	}
{/php}
			</p><del>{if $article.Metas.promarket} ￥{$article.Metas.promarket} {else}  {/if}</del></span>
		<a href="{$article.Url}" class="tbtn"></a>
	</div>
</li>