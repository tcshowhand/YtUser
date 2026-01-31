<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
if ($zbp->Config('YtUser')->sms_on == 1) {
    $mobile = trim(GetVars('mobile', 'POST'));
    $code = trim(GetVars('mobilecode', 'POST'));
    if ((!$zbp->GetMemberByName($mobile)->ID)) {
        ytuser_error('用户名不存在.');
        die();
    }
    $ver = new YtVerification();
    $array = $ver->YtTypeMobile(2, $mobile);
    if ($array) {
        $todayStartTime = strtotime(date("Y-m-d"));
        $time = (int)$zbp->Config('YtUser')->sms_limit;
        $enddayStartTime = time() - (60 * $time);
        if ($ver->Send > $enddayStartTime) {
            if ($code != $ver->Code) {
                ytuser_error('短信验证码不正确!!!');
                die();
            }
        } else {
            ytuser_error('短信验证码已过期!!!');
            die();
        }
    } else {
        ytuser_error('请输入短信验证码!!!');
        die();
    }
    $username = $mobile;

    $password = trim(GetVars('password', 'POST'));
    $repassword = trim(GetVars('repassword', 'POST'));
    if (strlen($password) < $zbp->option['ZC_PASSWORD_MIN'] || strlen($password) > $zbp->option['ZC_PASSWORD_MAX']) {
        ytuser_error('密码必须在' . $zbp->option['ZC_PASSWORD_MIN'] . '位-' . $zbp->option['ZC_PASSWORD_MAX'] . '位间.');
        die();
    }
    if ($password != $repassword) {
        ytuser_error('请核对密码.');
        die();
    }
    
    $m = $zbp->GetMemberByName($username);
    $m->Password = md5(md5($password) .$m->Guid);
    $m->Save();
    ytuser_success("密码已重置成功,请在登录页面登录.!",$zbp->host.$zbp->Config('YtUser')->YtUser_Login);
}


die();

