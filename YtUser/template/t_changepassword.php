{* Template Name:密码重置 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
<div class="col-19 col-m-24">
    <div class="tx-box bg-white mb15">
        <h2 class="tx-title">修改密码</h2>
        <div class="pd15">
            <form class="js-ajax-form"  action="{$zbp->Config('YtUser')->api_changepassword}" method="post" novalidate="novalidate">
            <ul class="tx-form-li row">
                <li class="col-24 col-m-24"><p><input type="text" id="edtaccount" value="{$user.Name}" class="tx-input" disabled/><i>用户名</i></p></li>
                <input type="hidden" name="token" id="token" value="{$zbp->GetToken()}">
                {if $user.Password != '0e681aa506fc191c5f2fa9be6abddd01'}
                <li class="col-24 col-m-24"><p><input type="password" id="edtpassword" name="password" placeholder="原密码" class="tx-input"><i>原密码(*)</i></p></li>
                {/if}
                <li class="col-24 col-m-24"><p><input type="password" id="edtnewpassword" name="newpassword" placeholder="设置一个新的密码" class="tx-input"><i>新密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p><input type="password" id="edtrepassword" name="repassword" placeholder="确认新密码" class="tx-input"><i>新密码(*)</i></p></li>
                <li class="col-24 col-m-24"><p class="input-ma"><input required="required" type="text" name="verifycode" class="tx-input"  placeholder="验证码">{$article.verifycode}</p></li>
                <li class="col-24 col-m-24"><p class="tx-input-full"><button type="submit" class="js-ajax-submit tx-btn tx-btn-big bg-black">提交</button></p></li>
            </ul>
            </form>
        </div>
    </div> 
</div>
{template:t_footer}