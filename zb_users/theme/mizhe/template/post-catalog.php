<li>
	<div class="tuanmainimg">
		{if $article.IsTop}
		<em class="hot"></em>
		{/if}
		{php}
		  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		  $content = $article->Content;
		  preg_match_all($pattern,$content,$matchContent);
		  if(isset($matchContent[1][0]))
		  $temp=$matchContent[1][0];
		  else
		  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
		{/php}
		<a href="{$article.Url}"><img src="{$temp}" alt="{$article.Title}" /></a>
		<div class="tuanmainname"><a href="{$article.Url}">{$article.Title}</a></div>
	</div>
	<div class="tuanmainsale">
		{if $article.Metas.proprice} <span class="tuanmainprice">￥<i>{$article.Metas.proprice}</i></span> {else}<span class="noprice">暂无报价</span> {/if}
		<span class="tuanmaininfo"><del>{if $article.Metas.promarket} ￥{$article.Metas.promarket} {else}  {/if}</del><p>{php}if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '';}{/php}</p></span>
		<span class="tuanmainnum">{$article.ViewNums}人已开抢</span>
	</div>
</li>