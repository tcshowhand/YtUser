{template:header}
<body class="{$type}">
	<div class="wrapper">
		{template:navbar}
		<div class="box">
			<div class="singlebox">
				{if $article.Type==ZC_POST_TYPE_ARTICLE}
				{template:post-single}
				{else}
				{template:post-page}
				{/if}
				<div class="sidebar">
					<div class="sidebox">
						<div class="sidetitle">
							<h3>大家正在买...</h3>
						</div>
						<div class="sidecon">
							<ul>
								{foreach GetList(5,$article.Category.ID) as $article}
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
									<div class="sideimg"><a href="{$article.Url}"><img src="{$temp}" alt="" /></a></div>
									<div class="sidename"><a href="{$article.Url}">{if $article.Metas.proprice}<em>￥{$article.Metas.proprice}</em> {else}暂无报价{/if}{$article.Title}</a></div>
									<div class="sidedetail"><span>{if $article.Metas.promarket}原价: <del>￥{$article.Metas.promarket}</del> {else}暂无报价 {/if}</span><a href="{$article.Url}">去抢购</a></div>
								</li>
								{/foreach}
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
{template:sfooter}