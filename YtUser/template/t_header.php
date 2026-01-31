{* Template Name: 顶部*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <title>{$title}-{$name}</title>
        <meta http-equiv="Content-Language" content="zh-CN" />
        <link rel="stylesheet" rev="stylesheet" href="{$host}zb_users/plugin/YtUser/template/css/fonts/iconfont.css" type="text/css" media="all" />
        <link rel="stylesheet" rev="stylesheet" href="{$host}zb_users/plugin/YtUser/template/css/txcstx.css" type="text/css" media="all" />
        <script src="{$host}zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
        <script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
        <script src="{$host}zb_users/plugin/YtUser/template/js/jquery-labelauty.js" type="text/javascript"></script>
        <style>
            body{background-color:#{$zbp->Config('YtUser')->color6};color:#{$zbp->Config('YtUser')->color7};}
            a{color:#{$zbp->Config('YtUser')->color8};}a:hover{color:#{$zbp->Config('YtUser')->color4};}
            .bg-black,.side-menu-box li a,.user-information li a:hover,.side-menu-box li a:after,.txuser-tab-hd li.tx-on{background-color:#{$zbp->Config('YtUser')->color1};}
            .txuser-tab-hd li.tx-on::before{border-color:#{$zbp->Config('YtUser')->color1};}
            .side-menu-box li a:hover,.side-menu-box li.on a{background-color:#{$zbp->Config('YtUser')->color2};}
            .bg-white,.tx-login ul,.tx-login-on>a:after,.tx-title{background-color:#{$zbp->Config('YtUser')->color5};}
            .tx-login>a{border-color:#{$zbp->Config('YtUser')->color5};}
            .tx-top,.tx-login ul,.tx-login ul li:last-child a,.tx-login-on>a,.pagebar li a,.pagebar li span,.tx-title,.footer,.txuser-tab-hd{border-color:#{$zbp->Config('YtUser')->color3};}
            .pagebar li a:hover,.pagebar li.active span,.side-menu-box li.on a:before,input.labelauty:checked + label,input.labelauty:checked:not([disabled]) + label:hover{background-color:#{$zbp->Config('YtUser')->color4};}
            .pagebar li a:hover,.pagebar li.active span{border-color:#{$zbp->Config('YtUser')->color4};}
        </style>
        {$header}
    </head>
    <body>
        <div class="tx-top mb15 bg-white">
            <div class="wide">
                <div class="mobile-menu-trigger fl"><i class="iconfont icon-caidan"></i></div>
                <div class="mobile-menu-mask"></div>
                <div class="tx-logo fl"><a href="{$host}" target="_blank"><img src="{if $zbp->Config('YtUser')->logo}{$zbp->Config('YtUser')->logo}{else}{$host}zb_users/plugin/YtUser/template/img/logo.png{/if}" alt="{$name}"></a></div>
                <div id="tx-header-scroll" class="fl">
                    <i class="iconfont icon-notification"></i>
                    <ul class="tx-notice ul-30">
                        {$zbp->Config('YtUser')->notice}
                    </ul>
                </div>
                <div class="tx-login fr">
                    {template:t_user_menu}
                </div>
            </div>
        </div>
        
            <div class="wide">
                <div class="row">
                    <div class="col-5 t_op">
                        {template:t_top}
                    </div>