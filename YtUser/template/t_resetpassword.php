{* Template Name: 重置密码*}
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
            <div class="login-avatar bg-black"><i class="iconfont icon-unlock"></i></div>
            <ul class="tx-form-li row">
                {if $article.username && $article.hash}
                <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_resetpassword}" method="post" novalidate="novalidate">
                <input type="hidden" value="{$article.username}" id="edtUserName" name="username">
                <input type="hidden" value="{$article.hash}" id="edtHash" name="hash"/>
                <li class="col-24 col-m-24"><p><input type="text" id="edtname" placeholder="{$article.username}" class="tx-input" disabled/><i>账号(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input type="password" id="edtpassword" name="password" class="tx-input"/><i>设置新密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input type="password" id="edtrepassword" name="repassword" class="tx-input"/><i>确认新密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input type="text" id="edtverifycode" name="verifycode" placeholder="验证码" class="tx-input">{$article.verifycode}</p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><input type="submit" value="提交" class="js-ajax-submit tx-btn tx-btn-big bg-black"></p></li>
                <li class="col-12 col-m-12"><p class="f-12 f-gray">*重置后，请妥善保管好您的新密码</p></li>
                <li class="col-12 col-m-12"><p class="ta-r"><a href="{$host}?Login" class="f-12 f-gray">去登录</a></p></li>
                </form>
                {else}
                <li class="col-24 col-m-24"><p><i class="iconfont icon-tishi"></i> 验证信息已经过期，请重新发送验证邮件，并点击邮件充值密码链接</p></li>
                {/if}
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

