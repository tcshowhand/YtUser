{* Template Name: 分页*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{if $pagebar}
{foreach $pagebar.buttons as $k=>$v}
{if $pagebar.PageNow==$k}
<li class="active"><span>{$k}</span></li>
{else}
<li><a href="{$v}">{$k}</a></li>
{/if}
{/foreach}
<li><span>总计{$pagebar.PageAll}页</span></li>
{/if}


