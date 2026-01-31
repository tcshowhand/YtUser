<?php
require_once '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
if ($zbp->VerifyCSRFToken(GetVars('csrfToken' , 'POST'), 'login', 'minute') == false) {
    ytuser_error('验证码错误，请重新输入.');die();
}
if($zbp->Config('YtUser')->xyon==2){
    $agreed = trim(GetVars('agreed', 'POST'));
    if (!$agreed) {
        ytuser_error('请阅读并同意《用户注册协议》！');
        die();
    }
}

if ($zbp->Config('YtUser')->login_verifycode) {
    $verifycode = trim(GetVars('verifycode', 'POST'));
    if (!$zbp->CheckValidCode($verifycode, 'User')) {
        ytuser_error('验证码错误，请重新输入.');
        die();
    }
}

$username = trim(GetVars('username', 'POST'));
$password = md5(trim(GetVars('password', 'POST')));
if (isset($_POST['strSaveDate']))
    $_POST['savedate'] = $_POST['strSaveDate'];
$m = null;
if ($zbp->Verify_MD5($username, $password, $m)) {
    $zbp->user = $m;
    $sd = $zbp->Config('YtUser')->loginsd;
    $sd = ($sd < 1) ? 1 : $sd;
    $sdt = (time() + 3600 * 24 * $sd);
    SetLoginCookie($m, (int) $sdt);
    ytuser_success('登录成功！');
    die();
} else {
    ytuser_error('账户或密码错误！');
    die();
}