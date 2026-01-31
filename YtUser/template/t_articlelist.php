{* Template Name: 文章列表*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-list-post tx-box bg-white mb15">
        <h2 class="tx-title">我发布的文章</h2>
        {if count($articles)>0}
        <ul>
            {foreach $articles as $article}
            <li>
                <h3 class="mb5"><a href="{$article.Url}" target="_blank"><i class="iconfont icon-text"></i> {$article.Title}</a></h3>
                <p><span class="mr10">发布于：{$article.Time()}</span> <span class="mr10">{$article.ViewNums}次浏览</span> {$article.CommNums}个评论</p>
                {if $article->Status==0 && $zbp->Config('YtUser')->topprice > 0}
                <p><a class="user_articletop" href="javascript:parent.openIframeLayer('{$host}?Articletop&id={$article->ID}','置顶',{area:['600px','298px']});">我要置顶</a>{if $article.IsTop}(结束时间：{date('m月d日H点', $article->Metas->topendtime)}) {/if}</p>
                {/if}
            </li>
            {/foreach}
        </ul>
        {else}
        <div class="ta-c pd20">暂时没有发布文章</div>
        {/if}
    </div>

    {if count($articles)>0}
    <div class="pagebar mb10">
        {template:t_pagebar}
    </div> 
    {/if}
</div>
{template:t_footer}