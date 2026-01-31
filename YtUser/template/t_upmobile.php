{* Template Name:绑定手机号 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">绑定手机号</h2>
        <div class="pd15">
            <form class="js-ajax-form"  action="{$zbp->Config('YtUser')->api_upmobile}" method="post" novalidate="novalidate">
            <ul class="tx-form-li row">
                <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}">
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobile" class="tx-input" id="js-mobile-input" placeholder="手机号码" data-required="on"><i>手机号码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="captcha" class="tx-input"  placeholder="验证码" id="captcha" data-required="on">{$article.captcha}</p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobilecode" class="tx-input"><i><a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="{$zbp->Config('YtUser')->api_code}" daty-type="register" data-init-second-left="60">获取手机验证码</a></i></p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" class="js-ajax-submit tx-btn tx-btn-big bg-black">提交</button></p></li>
            </ul>
            </form>
        </div>
    </div> 
</div>
{template:t_footer}