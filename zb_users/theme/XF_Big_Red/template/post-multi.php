<?php echo'
	<meta charset="UTF-8">
	<div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Theme ID: XF_Big_Red</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author: 小锋博客</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author URI: Www.SongHaiFeng.Com</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author QQ: 284204003</h2>
		<h2 style="font-size:28px;margin-bottom:32px;color:000;">Author Email: 284204003@qq.com</h2>
	</div>
';die();?>
{php}IMAGE::getPics($article,160,120,3){/php}
{php}
$temp=mt_rand(1,5);
$temp=$zbp->host."zb_users/theme/$theme/style/rand/$temp.jpg";
{/php}
<div class="feed_tegao long" data-href="{$article.Url}">
    <h4><a href="{$article.Url}" target="_blank">{$article.Title}</a></h4>
    <p class="picture">
		<a href="{$article.Url}" target="_blank">
			{if $article->IMAGE_COUNT>0}
				<img src="{$article.IMAGE[0]}" title="{$article.Title}" alt="{$article.Title}" />
			{else}
				<img src="{$temp}" title="{$article.Title}" alt="{$article.Title}" />
			{/if}
		</a>
	</p>
	{php}$description = trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),78)).'...';{/php}
    <p class="summary">{$description}<a href="{$article.Url}" class="more" target="_blank">[详情]</a></p>
    <div class="infos">
        <span class="time">{$article.Time('Y-m-d')}</span>
    </div>
</div>
