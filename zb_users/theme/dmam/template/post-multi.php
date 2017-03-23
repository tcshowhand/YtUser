{* Template Name:自定义列表 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{php}
$img_cover = '';
$img_cover = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
if ($zbp->CheckPlugin('dm_tools')) {
	dm_tools_thumb::getPics($article,400,250,4);
	if ($article->dm_tools_thumb_COUNT>0){
		$img_cover = $article->dm_tools_thumb[0];
		if ($article->Metas->post_style_order && $article->Metas->post_style_order > 1 && !strpos($article->Metas->post_style_order,',')){
		$img_cover = $article->dm_tools_thumb[$article->Metas->post_style_order-1];
		}
	}
	$img_cover = $article->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($article->Metas->thumbnail,400,250,4):$img_cover;
}
{/php}
{if $article.Metas.post_style == "txt"}
<article class="dm-multi dm-multi-0 article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
		<div class="dm-multi-content am-u-sm-12">
		<h2 class="am-article-title"><a href="{$article.Url}">{$article.Title}</a></h2>
		<p class="dm-multi-intro">{dmam_txt($article,$zbp->Config('dmam')->kgintro,140,'...')}</p>
		<p class="dm-meta">
		{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：{$article->Metas->post_author}</span>{/if}
		<span class="am-icon-eye"> 热度：{$article.ViewNums} ℃</span>
		<span class="am-icon-comment-o"> 评论：{$article.CommNums} 次</span>
		<time class="am-icon-clock-o"> {dmam_NewTime($article.Time())}</time>
		</p>
		</div>
</article>
{elseif $article.Metas.post_style == "pic"}
<article class="dm-multi dm-multi-1 article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
{if $img_cover}
		<div class="dm-multi-img am-u-sm-4">
		<a href="{$article.Url}">
		<img {dmam_islasy('',$img_cover)} alt="{$article.Title}">
		</a>
		</div>
{/if}
		<div class="dm-multi-content am-u-sm-8">
		<h2 class="am-article-title"><a href="{$article.Url}">{$article.Title}</a></h2>
		<p class="dm-multi-intro">{dmam_txt($article,$zbp->Config('dmam')->kgintro,100,'...')}</p>
		<p class="dm-meta">
		{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：{$article->Metas->post_author}</span>{/if}
		<span class="am-icon-eye"> 热度：{$article.ViewNums} ℃</span>
		<span class="am-icon-comment-o"> 评论：{$article.CommNums} 次</span>
		<time class="am-icon-clock-o"> {dmam_NewTime($article.Time())}</time>
		</p>
		</div>
</article>
{elseif $article.Metas.post_style == "video"}
<article class="dm-multi dm-multi-v article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
{if $img_cover}
	<div class="dm-multi-img am-u-sm-4">
	<a href="{$article.Url}">
	<img {dmam_islasy('',$img_cover)} alt="{$article.Title}">
	</a>
	<a class="onimg" href="{$article.Url}">
	<img src="{$host}zb_users/theme/{$theme}/style/images/z.png" alt="{$article.Title}">
	</a>
	</div>
{/if}
	<div class="dm-multi-content am-u-sm-8">
	<h2 class="am-article-title"><a href="{$article.Url}">{$article.Title}</a></h2>
	<p class="dm-multi-intro">{dmam_txt($article,$zbp->Config('dmam')->kgintro,120,'...')}</p>
	<p class="dm-meta">
	{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：{$article->Metas->post_author}</span>{/if}
	<span class="am-icon-eye"> 热度：{$article.ViewNums} ℃</span>
	<span class="am-icon-comment-o"> 评论：{$article.CommNums} 次</span>
	<time class="am-icon-clock-o"> {dmam_NewTime($article.Time())}</time>
	</p>
	</div>
</article>
{elseif $article.Metas.post_style == "pro"}
<article class="dm-multi dm-multi-1 article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
{if $img_cover}
		<div class="dm-multi-img am-u-sm-4">
		<a href="{$article.Url}">
		<img {dmam_islasy('',$img_cover)} alt="{$article.Title}">
		</a>
		</div>
{/if}
		<div class="dm-multi-content am-u-sm-8">
		<h2 class="am-article-title"><a href="{$article.Url}">{$article.Title}</a></h2>
		<ul class="dm-multi-list">
		{dmam_multi_pro($article.Metas.post_ispro_ids)}
		</ul>
				<p class="dm-meta">
		{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：{$article->Metas->post_author}</span>{/if}
		<span class="am-icon-eye"> 热度：{$article.ViewNums} ℃</span>
		<span class="am-icon-comment-o"> 评论：{$article.CommNums} 次</span>
		<time class="am-icon-clock-o"> {dmam_NewTime($article.Time())}</time>
		</p>
		</div>
</article>
{elseif $article.Metas.post_style == "pics"}
<article class="dm-multi dm-multi-s article-{$article.ID} cate-{$article.Category.ID} auth-{$article.Author.ID}">
<h2 class="am-article-title"><a href="{$article.Url}">{$article.Title}</a></h2>
{if $article->dm_tools_thumb_COUNT>=3}
<ul class="dm-multi-imgs am-avg-sm-3 am-u-sm-12">
{php}
$img_orders = array(1,2,3);
$img_orders = strpos($article->Metas->post_style_order,',')?explode(',',$article->Metas->post_style_order):$img_orders;
foreach ($img_orders as $img_order){
	echo '<li><a href="'.$article->Url.'"><img '.dmam_islasy('',$article->dm_tools_thumb[$img_order-1]).' alt="'.$article->Title.'" /></a></li>';
}
{/php}
</ul>
{/if}
		<div class="dm-multi-content am-u-sm-12">
		<p class="dm-multi-intro">{dmam_txt($article,$zbp->Config('dmam')->kgintro,40,'...')}</p>
		<p class="dm-meta">
		{if $article->Metas->post_author}<span class="am-icon-globe"> 来源：{$article->Metas->post_author}</span>{/if}
		<span class="am-icon-eye"> 热度：{$article.ViewNums} ℃</span>
		<span class="am-icon-comment-o"> 评论：{$article.CommNums} 次</span>
		<time class="am-icon-clock-o"> {dmam_NewTime($article.Time())}</time>
		</p>
		</div>
</article>
{else}
{template:post-multi-auto}
{/if}