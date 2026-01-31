{* Template Name: 购买列表*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">我的订单</h2>
        <div class="pd15">
            <table class="tx-table">
                <tr class="bgh" style="text-align: left">
                    <th style="width:20%;">订单号</th>
                    <th style="width:10%;">商品类型</th>
                    <th style="width:40%;">商品名称</th>
                    <th style="width:20%;">下单时间</th>
                    <th style="width:10%;">付款状态</th>
                </tr>
                {if count($articles)>0}
                {foreach $articles as $key=>$article}
                <tr>
                    <td>{$article.OrderID}</td>
                    <td>{if $article.isphysical}实物商品{else}虚拟物品{/if}</td>
                    <td>{if $article.Url}<a target="_blank" href="{$article.Url}">{$article.Title}</a>{else}{$article.Title}{/if}</td>
                    <td>{$article.PostTime}</td>
                    <td>{if $article.State}
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
                        {if $article.PayUrl}<a href="{$article.PayUrl}">待支付</a>{else}待支付{/if}
                        
                        {/if}
                    </td>
                </tr>
                {/foreach}
                {else}
                <tr>
                    <td colspan="5" class="ta-c pd20">您暂时没有订单</td>
                </tr>
                {/if}
            </table>
        </div>
    </div> 
    <div class="pagebar mb15">
        {template:t_pagebar}
    </div> 
</div>
{template:t_footer}
