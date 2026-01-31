{* Template Name:密码重置 *}
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
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <div class="pd15">
            <form class="js-ajax-form"  action="{$host}zb_users/plugin/YtUser/common/articletop.php?id={$aid}" method="post" novalidate="novalidate">
            <ul class="tx-form-li row">
                <li class="col-24 col-m-24"><p><input type="text" id="edtaccount" value="{$title}" class="tx-input" disabled/><i>置顶文章</i></p></li>
                <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}">
                <li class="col-24 col-m-24"><p><input type="text" id="edtnewpassword" name="day" value="1" placeholder="置顶天数" class="tx-input"><i>置顶天数(*)</i></p></li>
                <li class="col-24 col-m-24"><p>置顶一天需要 {$zbp->Config('YtUser')->topprice} 积分</p></li>
                <li class="col-24 col-m-24"><p>剩余积分：{$zbp->user->Price}</p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" data-success="finish" class="js-ajax-submit tx-btn tx-btn-big bg-black">提交</button></p></li>
            </ul>
            </form>
        </div>
    </div> 
</div>
</div>
</div>
<script src="{$host}zb_users/plugin/YtUser/template/js/txcstx.js" type="text/javascript"></script>
{$footer}
<script>
function confirm() {
    $('.js-ajax-submit').click();
}
function finish(){
    parent.location.reload()
    var _index = $(window.parent.document).find('.layui-layer').last().attr('times');
    parent.layer.close(_index);
}
</script>
</body>
</html>