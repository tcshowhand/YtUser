{* Template Name: 积分充值*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white pd15 mb15">
        <h2 class="f-22 mb10">账户余额：{$zbp->user->Price}</h2>
        <p>{$zbp.Config('YtUser').integral_text}</p>
    </div>
    <div class="tx-box bg-white mb15">
        <div class="txuser-tab-hd">
            <ul>
                <li class="tx-on">充值卡充值</li>
                {if $zbp->Config('YtUser')->payment=='1'}<li>支付宝在线充值</li>{/if}
            </ul>
        </div>
        <div class="txuser-tab-bd">
            <div class="pd15" style="display:block">
                <ul class="tx-form-li row">
                <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_integral}" method="post" novalidate="novalidate">
                    <input type="hidden" name="csrfToken" value="{$zbp->GetCSRFToken()}">
                    <li class="col-24 col-m-24"><p><input required="required" type="text" name="invitecode" class="tx-input"><i>充值卡号(*)</i></p></li>
                    <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input"  placeholder="验证码">{$article.verifycode}</p></li>
                    <li class="col-24 col-m-24"><p class="tx-input-full"><input type="submit" value="提交" class="js-ajax-submit tx-btn tx-btn-big bg-black"></p></li>
                </form>
                </ul>
            </div>
            {if $zbp->Config('YtUser')->payment=='1'}
            <div class="pd15">
                <form class="ytarticleedt" action="{$zbp->Config('YtUser')->api_zfbbuy}" method="post" novalidate="novalidate">
                    <input type="hidden" name="LogID" id="LogID" value="0" />
                    <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />
                    <ul class="tx-form-li clearfix mb15">
                        <li class="fl mr10"><input name="vipstate" type="radio" value="5" data-labelauty="100积分({$zbp->Config('YtUser')->pricetemp5}RMB)" checked></li>
                        <li class="fl mr10"><input name="vipstate" type="radio" value="6" data-labelauty="200积分({$zbp->Config('YtUser')->pricetemp6}RMB)"></li>
                        <li class="fl mr10"><input name="vipstate" type="radio" value="7" data-labelauty="300积分({$zbp->Config('YtUser')->pricetemp7}RMB)"></li>
                    </ul>
                    <p><button id="btnPost" class="tx-btn tx-btn-big bg-black">确定</button></p>    
                </form>
            </div>
            {/if}
        </div>
    </div> 
</div>
<script>
    $(function(){
        $(':input').labelauty();
    });
</script>
{template:t_footer}

