{* Template Name: 个人资料 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>

{template:t_header}
<div class="col-19 col-m-24">
    <div class="user-information">
        <ul class="row">
            <li class="col-6 col-m-12 mb15"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Upgrade}" class="bg-cyan"><i class="iconfont icon-crown"></i>   {if $user.Level < 5}VIP会员{else}普通会员{/if}</a></li>
            <li class="col-6 col-m-12 mb15"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Integral}" class="bg-blue"><i class="iconfont icon-recharge"></i> 余额 {$zbp->user->Price} </a></li>
            <li class="col-6 col-m-12 mb15"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Articlelist}" class="bg-orange"><i class="iconfont icon-copy"></i> 文章 {$zbp->user->Articles}</a></li>
            <li class="col-6 col-m-12 mb15"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Commentlist}" class="bg-green"><i class="iconfont icon-liuyan"></i> 评论 {$zbp->user->Comments}</a></li>
        </ul>
    </div>
    <div class="row">

        {if $zbp->Config('YtUser')->homeids}
        {foreach (explode(',', $zbp->Config('YtUser')->homeids)) as $cid}
        <div class="col-12 col-m-24 mb15">
            <div class="tx-box bg-white">
                <h2 class="tx-title">{$zbp->GetCategoryByID($cid)->Name}</h2>
                <ul class="ul-32 pd15-4">
                    {php}
                    $w=array();
                    $w['count']=8;
                    $w['cate']=$cid;
                    $w['has_subcate']=1;
                    $array=GetList($w);
                    {/php}
                    {foreach $array as $newlist}
                    <li><span class="fr f-gray1 ml10">{$newlist.Time('m-d')}</span>[{$newlist.Category.Name}]  <a href="{$newlist.Url}" title="{$newlist.Title}">{$newlist.Title}</a></li>
                    {/foreach}
                </ul>
            </div>
        </div>
        {/foreach}
        {/if}

    </div>
</div>
{template:t_footer}
