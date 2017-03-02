{* Template Name:最近文章模块 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{foreach $articles as $article}
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
<li>
	<a {dmam_isblank(true)} href="{$article.Url}">
	{if $article.Metas.post_style != "txt" && $img_cover}
	<p class="sidepost-hd"><img {dmam_islasy('',$img_cover)}></p>
	{/if}
	<p class="sidepost-bd">{$article.Title}<small>发布于 {$article.Time('m月d日 H:i')}</small></p>
	</a>
</li>
{/foreach}

