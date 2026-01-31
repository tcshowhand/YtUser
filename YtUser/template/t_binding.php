{* Template Name: 账号绑定 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">第三方账号绑定</h2>
        <div class="pd15 ta-c">
            {if $article.BindingQQ}
            <h3 class="f-16"><i class="iconfont icon-tishi"></i> 此账户已绑定过QQ</h3>
            {else}
            <h3 class="f-16"><i class="iconfont icon-qq2"></i> <a target="_blank" href="{$zbp->Config('YtUser')->api_qqbin}">绑定QQ</a></h3>
            {/if}
            {if $zbp->Config('YtUser')->sms_on==1}
            <hr>
            {if $article.mobile}
            <h3 class="f-16"><i class="iconfont icon-tishi"></i> 此账户已绑定过手机号</h3>
            {else}
            <h3 class="f-16"><i class="iconfont"></i> <a href="{$host}{$zbp->Config('YtUser')->YtUser_Upmobile}">绑定手机号</a></h3>
            {/if}
            {/if}
        </div>
    </div> 
</div>
{template:t_footer}