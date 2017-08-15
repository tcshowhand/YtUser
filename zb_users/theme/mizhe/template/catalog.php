{template:header}
<body class="{$type}">
	<div class="sidenav">
		{$zbp->Config('mizhe')->PostFLOATNAV}
	</div>
	<div class="wrapper">
		{template:navbar}
		<div class="box">
			<div class="banner">{$zbp->Config('mizhe')->PostCATALOGADS}</div>
			{if $type=='category'&&$page=='1'}
			<div class="tuan">
				<div class="tuancon">
					<div class="tuantitle"><h3>热荐专区</h3></div>
					<ul>
						{foreach Getlist(6,$category.ID,null,null,null,null) as $related}
						<li>
							<div class="tuanimg">
								{if $related.IsTop}
								<em class="hot"></em>
								{/if}
								{php}
								  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
								  $content = $related->Content;
								  preg_match_all($pattern,$content,$matchContent);
								  if(isset($matchContent[1][0]))
								  $temp=$matchContent[1][0];
								  else
								  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
								  {/php}
								<a href="{$related.Url}"><img src="{$temp}" alt="" /></a>
								<div class="tuanname"><a href="{$related.Url}">{php}$intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Title,'[nohtml]'),16)));{/php}{$intro}</a></div>
							</div>
							<div class="tuansale">
								{if $related.Metas.proprice} <span class="tuanprice">￥<i>{$related.Metas.proprice}</i></span> {else}<span class="noprice">暂无报价 {/if}</span>
								<span class="tuaninfo"><p>{php}if ($related->Metas->proprice && $related->Metas->promarket) {echo mizhe_zhekou($related->Metas->proprice,$related->Metas->promarket).'折';}else{echo '';}{/php}</p><del>{if $related.Metas.promarket} ￥{$related.Metas.promarket} {else}  {/if}</del></span>
								<span class="tuannum">{$related.ViewNums}人已开抢</span>
							</div>
						</li>
						{/foreach}
					</ul>
				</div>
				<div class="tuanside">
					<div class="tuansidetop"><h3>最热单品榜 TOP5</h3></div>
					<div class="tuansidecon">
						<ul>
							{foreach GetList(5,0) as $article}
							<li>
								{php}
								  $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
								  $content = $article->Content;
								  preg_match_all($pattern,$content,$matchContent);
								  if(isset($matchContent[1][0]))
								  $temp=$matchContent[1][0];
								  else
								  $temp="{$host}zb_users/theme/{$theme}/style/images/proimg.jpg";
								  {/php}
								<div class="tuansideimg"><a href="{$article.Url}"><img src="{$temp}" alt="" /></a></div>
								<div class="tuansideinfo">
									<p><a href="{$article.Url}">{php}$intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Title,'[nohtml]'),16)));{/php}{$intro}</a></p>
									<p>{if $article.Metas.proprice} ￥{$article.Metas.proprice} {else}暂无报价 {/if}</p>
								</div>
							</li>
							{/foreach}
						</ul>
					</div>
				</div>
			</div>
			{/if}

			<div class="tuanmain">
				<ul>
					{if count($articles)>0}
					{foreach $articles as $article}
						{if !$article.IsTop}
						{template:post-catalog}
						{/if}
					{/foreach}
					{/if}
				</ul>
			</div>
			<div class="pagebar">{template:pagebar}<span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>

{template:cfooter}