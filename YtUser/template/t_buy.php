{* Template Name:购买状态 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white pd15 mb15">
        <p>{$zbp.Config('YtUser').integral_text}</p>
    </div>
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">你的账户余额为：{$user.Price}</h2>
        <div class="pd15">
            <p class="mb15"><strong>商品名称：</strong>{$article.BuyTitle}</p>
            <p class="mb15"><strong>商品价格：</strong><span class="f-red">{$article.BuyPrice}</span></p>
            <p class="mb15"><strong>你的余额：</strong>{$user.Price}</p>
            <ul class="tx-form-li row">
                {if $article.Buypay}
                <li class="col-24 col-m-24"><h3 class="f-22"><i class="iconfont icon-tishi"></i> 已购买</h3></li>
                {else}
                <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_buypay}" method="post" novalidate="novalidate">
                    <input type="hidden" name="LogID" id="LogID" value="{$article.BuyID}">
                    <input type="hidden" name="LogUrl" id="LogUrl" value="{$article.BuyTUrl}">
                    <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />
                    <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" class="js-ajax-submit tx-btn tx-btn-big bg-black">积分支付</button></p></li>
                </form>
                    {if $zbp->Config('YtUser')->payment==1}
                    <form action="{$zbp->Config('YtUser')->api_zfbbuy}" method="post" novalidate="novalidate">
                        <input type="hidden" name="LogID" id="LogID" value="{$article.BuyID}">
                        <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />
                        <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" class="tx-btn tx-btn-big bg-black">支付宝支付</button></p></li>
                    </form>
                    {/if}
                {/if}
            </ul>
        </div>
    </div> 
</div>
{template:t_footer}