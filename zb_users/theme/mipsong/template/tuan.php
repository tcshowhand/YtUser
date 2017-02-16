{template:header}
<body class="{$type}">
	<div class="wrapper">
		{template:navbar}
		<div class="box">
			<div class="banner">{$zbp->Config('mizhe')->PostCATALOGADS}</div>
			{if $type=='category'&&$page=='1'}
			<div class="well">
				<div class="wellcon">
					<ul>
						{foreach Getlist(6,$category.ID,null,null,null,null) as $related}
						<li>
							<div class="wellimg">
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
							</div>
							<div class="wellsale">
								<div class="wellname"><a href="{$related.Url}">{php}$intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Title,'[nohtml]'),16)));{/php}{$intro}</a></div>
								<div class="wellinfo">
									{if $related.Metas.proprice} <span class="wellprice">￥<i>{$related.Metas.proprice}</i> {else}<span class="noprice">暂无报价 {/if} <del>{if $related.Metas.promarket} ￥{$related.Metas.promarket} {else}  {/if}</del></span>
									<span class="wellbtn"><a href="{$related.Url}"></a></span>
								</div>
							</div>
						</li>
						{/foreach}
					</ul>
				</div>
				<div class="wellside">
					<div class="wellsidetop"><h3>最热单品榜</h3></div>
					<div class="wellsidecon">
						<ul>
							{php}
							$i=1;
							{/php}
							{foreach GetList(6,0) as $article}
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
								<div class="simg"><a href="{$article.Url}"><img src="{$temp}" alt="{$article.Title}" /></a></div>
								<div class="sinfo">
									<p>No.{$i}</p>
									<p><a href="{$article.Url}">{php}$intro= preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Title,'[nohtml]'),24)));{/php}{$intro}</a></p>
								</div>
							</li>
							{php}
							$i=$i+1;
							{/php}
							{/foreach}
							
						</ul>
					</div>
				</div>
			</div>
			{/if}

			<div class="post">
				<ul>
					{if count($articles)>0}
					{foreach $articles as $article}
						{if !$article.IsTop}
						{template:post-tuan}
						{/if}
					{/foreach}
					{/if}
				</ul>
			</div>
			<div class="pagebar">{template:pagebar}<span class="pagebar-tip">下一页更多惊喜</span></div>
		</div>

{template:cfooter}