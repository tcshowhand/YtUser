{* Template Name: 我的评论*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-list-post tx-box bg-white mb15">
        <h2 class="tx-title">我发表的评论</h2>
        {if count($articles)>0}
        <ul>
            {foreach $articles as $key=>$article}
            <li>
                <p class="mb5">评论于：{$article.Time('Y年m月d日 h:i:s')} <a href="{$article.Url}" target="_blank">{$article.Title}</a></p>
                <h3><i class="iconfont icon-yinyong1"></i> {$article.Intro}</h3>
            </li>
            {/foreach}
        </ul>
        {else}
        <div class="ta-c pd20">暂时没有发表评论</div>
        {/if}
    </div>
    
    {if count($articles)>0}
    <div class="pagebar mb10">
        {template:t_pagebar}
    </div> 
    {/if}
</div>
{template:t_footer}
