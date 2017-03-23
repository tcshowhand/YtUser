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
{if (!$module.IsHideTitle)&&($module.Name)}
    <div class="ap {$module.HtmlID}">
        <div class="apt" style="height: 26px;">
            <p class="entit"><span>{$module.Name}</span></p>
        </div>
        <div class="apc">
            <ul class="ulist">
				{$module.Content}
            </ul>
        </div>
    </div>
{else}
	{$module.Content}
{/if}