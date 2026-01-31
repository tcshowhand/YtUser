{* Template Name: 消费日志*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">我的消费记录</h2>
        <div class="pd15">
            <table class="tx-table">
                <tr class="bgh" style="text-align: left">
                    <th style="width:10%;">ID</th>
                    <th style="width:60%;text-align: left">商品名称</th>
                    <th style="width:30%;">下单时间</th>
                </tr>
                {if count($articles)>0}
                {foreach $articles as $key=>$article}
                <tr>
                    <td>{$key+1}</td>
                    <td style="text-align: left">{if $article.Url}<a target="_blank" href="{$article.Url}">{$article.Title}</a>{else}{$article.Title}{/if}</td>
                    <td>{$article.Time('Y-m-d H:i:s')}</td>
                </tr>
                {/foreach}
                {else}
                <tr>
                    <td colspan="5" class="ta-c pd20">您暂时没有消费</td>
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