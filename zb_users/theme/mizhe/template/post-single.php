<div class="single cate{$article.Category.ID} auth{$article.Author.ID}">
	<div class="program">
		<div class="proname">
			<h2><span>今日特卖：</span>{$article.Title}</h2>
		</div>
		<div class="probox">
			<div class="prodetail">
				{if $article.Metas.proprice} <div class="proprice"><span>￥<i>{$article.Metas.proprice}</i></span><a href="{if $article.Metas.prourl} {$article.Metas.prourl} {else}javascript: {/if}" target="_blank" class="now">去抢购</a>{else}<div class="proready"><span class="noprice">暂无报价</span><a href="{if $article.Metas.prourl} {$article.Metas.prourl} {else}javascript: {/if}" target="_blank" class="ready">即将开始</a> {/if}</div>
				<div class="proinfo">
					<span><em>原价</em>{if $article.Metas.promarket} <del>￥{$article.Metas.promarket}</del>{else}暂无  {/if}</span>
					<span><em>折扣</em><i>{php}if ($article->Metas->proprice && $article->Metas->promarket) {echo mizhe_zhekou($article->Metas->proprice,$article->Metas->promarket).'折';}else{echo '暂无';}{/php}</i></span>
					<span><em>节省</em><i>{php}if ($article->Metas->proprice && $article->Metas->promarket) {echo '￥'.mizhe_sheng($article->Metas->proprice,$article->Metas->promarket);}else{echo '暂无';}{/php}</i></span>
				</div>
				<div class="pronum">已有<i>{$article.ViewNums}</i>人在抢购该商品</div>
				<div class="protime">
					<p>离抢购结束还剩:</p>
					<span class="settime" endTime="{$article.Metas.protime}"></span>
				</div>
				<div class="protags"></div>
			</div>
			{php}
			  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
			  $content = $article->Content;
			  preg_match_all($pattern,$content,$matchContent);
			  if(isset($matchContent[1][0]))
			  $temp=$matchContent[1][0];
			  else
			  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
			{/php}
			<div class="proimg"><a href="{if $article.Metas.prourl} {$article.Metas.prourl} {else}javascript: {/if}" target="_blank"><img src="{$temp}" alt="{$article.Title}" /></a></div>
		</div>
		<div class="protags">
			<span class="protaglist">{foreach $article.Tags as $tag}<a href="{$tag.Url}">{$tag.Name}</a>{/foreach}</span>
			<span class="proshare">
				{$zbp->Config('mizhe')->PostSHARE}
			</span>
		</div>
	</div>
	<div class="singlebanner">{$zbp->Config('mizhe')->PostSINGLEADS}</div>
	<div class="content">
		<div class="articlecon">
			<i class="seller"></i>
			<em>掌柜说</em>
			{$article.Content}
		</div>
	</div>
	<div class="content">
		<div class="contitle"><h3>猜你喜欢</h3><a href="{$article.Category.Url}">更多推荐»</a></div>
		<div class="conbox">
			<ul>
				{foreach GetList(15,$category.ID) as $more}
				<li>
					{php}
					  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
					  $content = $more->Content;
					  preg_match_all($pattern,$content,$matchContent);
					  if(isset($matchContent[1][0]))
					  $temp=$matchContent[1][0];
					  else
					  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
					{/php}
					<div class="conimg"><a href="{$more.Url}"><img src="{$temp}" alt="" /></a></div>
					<div class="conname"><a href="{$more.Url}">{$more.Title}</a></div>
					<div class="condetail"><em>{if $more.Metas.proprice}￥<i>{$more.Metas.proprice}</i> {else}暂无报价 {/if}</em>{if $more.Metas.promarket} <del>￥{$more.Metas.promarket}</del> {else}　 {/if}</div>
				</li>
				{/foreach}
			</ul>
		</div>
	</div>

	{if !$article.IsLock}
	{template:comments}
	{/if}
</div>