{* Template Name:dm_uc 购买列表*}
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
