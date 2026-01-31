{* Template Name: 用户登录*}
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
        <script src="{$host}zb_system/script/md5.js?173040"></script>
        <script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
        <style> body{color:#{$zbp->Config('YtUser')->color7};}a{color:#{$zbp->Config('YtUser')->color8};}a:hover{color:#{$zbp->Config('YtUser')->color4};}.bg-black{background-color:#{$zbp->Config('YtUser')->color1};}.tx-login-bg{background:url({if $zbp->Config('YtUser')->bg}{$zbp->Config('YtUser')->bg}{else}{$host}zb_users/plugin/YtUser/template/img/bg.jpg{/if}) no-repeat 0 0;background-size: cover;}</style>
        {$header}
    </head>
    <body class="tx-login-bg">
        <div class="tx-login-box">
            <div class="login-avatar bg-black"><i class="iconfont icon-wode"></i></div>
            <ul class="tx-form-li row">   
            <form class="js-ajax-form" action="{$zbp->Config('YtUser')->api_login}" method="post" novalidate="novalidate">
                <input type="hidden" name="csrfToken" value="{$zbp->GetCSRFToken('login', 'minute')}">
                <li class="col-24 col-m-24"><p><input type="text" id="edtUserName" name="username" class="tx-input"><i>账号(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input type="password" id="edtPassWord" name="password" class="tx-input"><i>密码(*)</i></p></li>
                {if $zbp.Config('YtUser').login_verifycode}
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input" placeholder="验证码">{$article.verifycode}</p></li>
                {/if}
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" id="loginbtnPost" name="loginbtnPost"  class="js-ajax-submit tx-btn tx-btn-big bg-black">登录</button></p></li>
                {if $zbp->Config('YtUser')->xyon==2}
                <li class="col-24 col-m-24"><p class="f-12 ta-r"><input class="reg-checkbox-input" type="checkbox" name="agreed" {if $zbp->Config('YtUser')->dxyon}checked{/if}>阅读并同意<a href="{$zbp->Config('YtUser')->xyurl}">《用户及隐私协议》</a></p></li>
                {/if}
                <li class="col-12 col-m-12"><p><a href="{$host}{$zbp->Config('YtUser')->YtUser_Register}" class="f-12 f-gray">新用户注册</a></p></li>
                <li class="col-12 col-m-12"><p class="ta-r"><a href="{$host}{$zbp->Config('YtUser')->YtUser_Resetpwd}" class="f-12 f-gray">忘记密码</a></p></li>
            </form>
            </ul>
            {if $zbp->Config('YtUser')->login_kon}
            <div class="tx-social ta-c">
                <p><span>社交账号登录</span></p>
                {if $zbp->Config('YtUser')->login_qqon}
                <a href="{$zbp->Config('YtUser')->api_qqbin}" class="qq-login"><i class="iconfont icon-qq2"></i></a>
                {/if}
                {if $zbp->Config('YtUser')->login_wxon}
                <a class="qq-login" href="javascript:;" id="btnWechatLogin"><i class="iconfont icon-weixin"></i></a>
                {/if}
            </div>
            {/if}
            
            <!-- 微信扫码登录容器 -->
            <div id="wx_qr_modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
                <div style="background:#fff; padding:20px; border-radius:50px; text-align:center; position:relative;">
                    <span id="close_wx_qr" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:24px;">&times;</span>
                    <h3>微信扫码登录</h3>
                    <div id="wx_qrcode_img_div" style="margin:20px 0; min-width: 200px; min-height: 200px; display: flex; justify-content: center; align-items: center;">
                        <span style="color: #999;">加载中...</span>
                    </div>
                    <p>请使用微信扫描二维码关注公众号登录</p>
                </div>
            </div>

            <script>
            $(function(){
                var timer = null;
                var scene_id = 0;

                $('#btnWechatLogin').click(function(){
                    $('#wx_qr_modal').css('display', 'flex');
                    if(scene_id == 0) {
                        getQrCode();
                    }
                });

                $('#close_wx_qr').click(function(){
                    $('#wx_qr_modal').hide();
                    if(timer) clearInterval(timer);
                });

                function getQrCode() {
                    $.getJSON('{$host}zb_users/plugin/YtUser/login_official.php?act=get_qrcode', function(res){
                        if(res.status == 1) {
                            $('#wx_qrcode_img_div').html('<img src="'+res.qrcode_url+'" style="width:200px;height:200px;">');
                            scene_id = res.scene_id;
                            // 开始轮询
                            timer = setInterval(checkLogin, 2000);
                        } else {
                            $('#wx_qrcode_img_div').text(res.msg);
                        }
                    });
                }

                function checkLogin() {
                    if(!scene_id) return;
                    $.getJSON('{$host}zb_users/plugin/YtUser/login_official.php?act=check_login', {scene_id: scene_id}, function(res){
                        if(res.status == 1) {
                            window.location.reload();
                        }
                    });
                }
            });
            </script>

            </div>
            {/if}
        </div>
        <script src="{$host}zb_users/plugin/YtUser/template/js/txcstx.js" type="text/javascript"></script>
        {$footer}
    </body>
</html>