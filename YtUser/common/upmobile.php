<?php
require '../../../../zb_system/function/c_system_base.php'; 	
$zbp->Load();  
if (!$zbp->CheckPlugin('YtUser')) {die();}

if (YtUser_check_mobile($zbp->user->Name)) {
    Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Binding);die();
}

$mobile = trim(GetVars('mobile', 'POST'));
$code = trim(GetVars('mobilecode', 'POST'));
if (($zbp->GetMemberByName($mobile)->ID)) {
    ytuser_error('手机号已存在.');
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


$mem = $zbp->GetMemberByID($zbp->user->ID);
$mem->Name=$mobile;
$mem->Save();
ytuser_success("恭喜您绑定成功,请用手机号重新登录.!");die();
?>