{* Template Name: 购买列表*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
ID--交易类型--订单编号--标题--交易日期--状态<BR>

{foreach $articles as $key=>$article}

{$article.ID}
{if $article.isphysical}实物商品{else}虚拟物品{/if}
{$article.OrderID}
<a target="_blank" href="{$article.Url}">{$article.Title}</a>
{$article.PostTime}
{if $article.State}
    已支付
    {if $article.isphysical}
        {if $article.Express}
            已发货<a target="_blank" href="https://www.kuaidi100.com/chaxun?nu={$article.Express}">{$article.Express}</a>
        {else}
            未发货
        {/if}
    {else}
        虚拟商品
    {/if}
{else}
    <a href="{$host}{$zbp->Config('YtUser')->YtUser_buy}/{$article.LogID}">待支付</a>
{/if}

{/foreach}
{template:t_pagebar}
{template:t_footer}
