{* Template Name:文章和页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:header}
{template:b_nav_top}
{if $article.Type==ZC_POST_TYPE_ARTICLE}
	{template:post-single}
{else}
	{template:post-page}
{/if}
{template:footer}