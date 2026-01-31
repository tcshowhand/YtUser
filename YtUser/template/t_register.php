{* Template Name: 账号注册*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <title>{$title}-{$name}</title>
        <meta http-equiv="Content-Language" content="zh-CN">
        <link rel="stylesheet" rev="stylesheet" href="{$host}zb_users/plugin/YtUser/template/css/fonts/iconfont.css" type="text/css" media="all">
        <link rel="stylesheet" rev="stylesheet" href="{$host}zb_users/plugin/YtUser/template/css/txcstx.css" type="text/css" media="all">
        <script src="{$host}zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
        <script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
        <style> body{color:#{$zbp->Config('YtUser')->color7};}a{color:#{$zbp->Config('YtUser')->color8};}a:hover{color:#{$zbp->Config('YtUser')->color4};}.bg-black{background-color:#{$zbp->Config('YtUser')->color1};}.tx-login-bg{background:url({if $zbp->Config('YtUser')->bg}{$zbp->Config('YtUser')->bg}{else}{$host}zb_users/plugin/YtUser/template/img/bg.jpg{/if}) no-repeat 0 0;background-size: cover;}</style>
        {$header}
    </head>
    <body class="tx-login-bg">
        <div class="tx-login-box">
            <div class="login-avatar bg-black"><i class="iconfont icon-friendadd"></i></div>
            <ul class="tx-form-li row">
            <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_register}" method="post" novalidate="novalidate">
                <input type="hidden" name="csrfToken" value="{$zbp->GetCSRFToken('register', 'minute')}">
                {if $zbp->Config('YtUser')->sms_on==1}
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobile" class="tx-input" id="js-mobile-input" placeholder="手机号码" data-required="on"><i>手机号码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="captcha" class="tx-input"  placeholder="验证码" id="captcha" data-required="on">{$article.captcha}</p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobilecode" class="tx-input"><i><a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="{$zbp->Config('YtUser')->api_code}" daty-type="register" data-init-second-left="60">获取手机验证码</a>
                </i></p></li>
                {elseif $zbp->Config('YtUser')->sms_on==2}
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="name" class="tx-input"><i>账号(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="email" class="tx-input" id="js-mobile-input" placeholder="邮箱" data-required="on"><i>邮箱(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="captcha" class="tx-input"  placeholder="验证码" id="captcha" data-required="on">{$article.captcha}</p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobilecode" class="tx-input"><i><a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="{$zbp->Config('YtUser')->api_code}" daty-type="register" data-init-second-left="60">获取邮箱验证码</a>
                </i></p></li>
                {else}
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="name" class="tx-input"><i>账号(*)</i></p></li>
                {/if}
                <li class="col-24 col-m-24"><p><input required="required" type="password" name="password" class="tx-input"><i>密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="password" name="repassword" class="tx-input"><i>确认密码(*)</i></p></li>
                {if $zbp->Config('YtUser')->regneedemail==1 && $zbp->Config('YtUser')->sms_on!=2}
                <li class="col-24 col-m-24"><p><input type="text" name="email" class="tx-input"><i>邮箱</i></p></li>
                {/if}
                {if $zbp->Config('YtUser')->inv_twoon==1}
                <li class="col-24 col-m-24"><p><input type="text" name="invitecode" class="tx-input"><i>邀请码</i></p>
                <p style="text-align: center;"><a href="{$zbp->Config('YtUser')->inv_twoonurl}" target="_blank" class="sendcode">点击获取邀请码</a></p>
                </li>
                {/if}
                {if empty($zbp->Config('YtUser')->sms_on)}
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input"  placeholder="验证码">{$article.verifycode}</p></li>
                {/if}
                {if !empty($zbp->Config('YtUser')->limit_zcdirz1)}
                {php}$list = json_decode($zbp->Config('YtUser')->limit_zcdirz1,true);$list2 = json_decode($zbp->Config('YtUser')->limit_zcdirz2,true);{/php}
                {foreach $list as $key=>$add}
                    <li class="col-24 col-m-24"><p><input type="text" name="meta_{$list2[$key]}" value="" class="tx-input"><i>{$add}</i></p></li>
                {/foreach}
                {/if}
                <li class="col-24 col-m-24"><p class="tx-input-full"><input type="submit" value="提交" class="js-ajax-submit tx-btn tx-btn-big bg-black"></p></li>
                {if $zbp->Config('YtUser')->xyon}
                <li class="col-24 col-m-24"><p class="f-12 ta-r"><input class="reg-checkbox-input" type="checkbox" name="agreed" {if $zbp->Config('YtUser')->zxyon}checked{/if}>阅读并同意<a href="{$zbp->Config('YtUser')->xyurl}">《用户及隐私协议》</a></p></li>
                {/if}
                <li class="col-12 col-m-12"><p class="f-12 f-gray">已有账户？<a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}">去登陆</a></p></li>
                <li class="col-12 col-m-12"><p class="ta-r"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Resetpwd}" class="f-12 f-gray">忘记密码</a></p></li>
            </form>
            </ul>
            {if $zbp->Config('YtUser')->appid}
            <div class="tx-social ta-c">
                <p><span>社交账号登录</span></p>
                <a href="{$zbp->Config('YtUser')->api_qqbin}" class="qq-login"><i class="iconfont icon-qq2"></i></a>
            </div>
            {/if}
        </div>
        <script src="{$host}zb_users/plugin/YtUser/template/js/txcstx.js" type="text/javascript"></script>
        {$footer}
    </body>
</html>