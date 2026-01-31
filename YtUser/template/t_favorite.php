{* Template Name: 我的收藏*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-list-post tx-box bg-white mb15">
        <h2 class="tx-title">我收藏的文章</h2>
        {if count($articles)>0}
        <ul>
            {foreach $articles as $key=>$article}
            <li>
                <h3 class="mb5"><a href="{$article.Url}" target="_blank"><i class="iconfont icon-biaoxing"></i> {$article.Title}</a></h3>
                <span class="mr10">收藏于：{$article.Time()}</span> 
                <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_favoritedel}" method="post" novalidate="novalidate">
                <input type="hidden" name="LogID" value="{$article.Pid}">
                <input type="hidden" name="type" value="0">
                <button type="submit" class="js-ajax-submit ytecn_input_a">取消收藏</button>
                </form>
                </p>
            </li>
            {/foreach}
        </ul>
        {else}
        <div class="ta-c pd20">暂时没有收藏的内容</div>
        {/if}
    </div>

    {if count($articles)>0}
    <div class="pagebar mb10">
        {template:t_pagebar}
    </div> 
    {/if}
</div>
{template:t_footer}
