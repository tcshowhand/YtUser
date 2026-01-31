{* Template Name: 密码找回*}
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
            {if $zbp->Config('YtUser')->sms_on==1}
            <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_resetpwdto}" method="post" novalidate="novalidate">
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobile" class="tx-input" id="js-mobile-input" placeholder="手机号码" data-required="on"><i>手机号码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="captcha" class="tx-input"  placeholder="验证码" id="captcha" data-required="on">{$article.captcha}</p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="text" name="mobilecode" class="tx-input"><i><a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="{$zbp->Config('YtUser')->api_code}" daty-type="register" data-init-second-left="60">获取手机验证码</a></i></p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="password" name="password" class="tx-input"><i>新密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input required="required" type="password" name="repassword" class="tx-input"><i>确认密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><input type="submit" value="重置密码" class="js-ajax-submit tx-btn tx-btn-big bg-black"></p></li>
            </form>
            {else}
            <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_mailto}" method="post" novalidate="novalidate">
                <li class="col-24 col-m-24"><p><input type="text" id="edtname" name="name" class="tx-input" /><i>账号(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input type="email" id="edtemail" name="email" class="tx-input"/><i>邮箱(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input type="text" id="edtverifycode" name="verifycode" placeholder="验证码" class="tx-input">{$article.verifycode}</p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" id="loginbtnPost" name="loginbtnPost"  class="js-ajax-submit tx-btn tx-btn-big bg-black">登录</button></p></li>
                <li class="col-12 col-m-12"><p class="f-12 f-gray">*提交后记得去查看邮件</p></li>
            </form>
            {/if}
            <li class="col-12 col-m-12"><p class="ta-r">已有账户？<a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}">去登陆</a></p></li>
            </ul>
            {if $zbp->Config('YtUser')->login_kon}
            <div class="tx-social ta-c">
                <p><span>社交账号登录</span></p>
                {if $zbp->Config('YtUser')->login_qqon}
                <a href="{$zbp->Config('YtUser')->api_qqbin}" class="qq-login"><i class="iconfont icon-qq2"></i></a>
                {/if}
                {if $zbp->Config('YtUser')->login_wxon}
                {if YtUser_is_wechat()}
                <a href="{$host}zb_users/plugin/TCWeChatAPI/weixin.php" class="qq-login"><i class="iconfont icon-weixin"></i></a>
                {/if}
                {/if}
            </div>
            {/if}
        </div>
        <script src="{$host}zb_users/plugin/YtUser/template/js/txcstx.js" type="text/javascript"></script>
        {$footer}
    </body>
</html>