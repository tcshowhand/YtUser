<li>
	<div class="postname"><a href="{$article.Url}" title="{$article.Title}">{$article.Title}</a></div>
	<div class="postimg">
		{if $article.catalogIsTop}
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
		<a href="{$article.Url}" title="{$article.Title}" alt="{$article.Title}"><img src="{$temp}" alt="" /></a>
		<div class="postunder"></div>
		<div class="postinfo"><span>{php}if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '';}{/php} <del>{if $article.Metas.promarket} 原价:￥{$article.Metas.promarket} {else}  {/if}</del></span><i>{$article.ViewNums}人已开抢</i></div>
	</div>
	<div class="postsale">
		<div class="postprice">{if $article.Metas.proprice} ￥<i>{$article.Metas.proprice}</i> {else}暂无报价 {/if}</div>
		<div class="postbtn"><a href="{$article.Url}"></a></div>
	</div>
	<div class="posttags">
		{foreach $article.Tags as $tag}<a href="{$tag.Url}">{$tag.Name}</a>{/foreach}
	</div>
</li>