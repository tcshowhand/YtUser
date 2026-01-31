<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
$verifycode=trim($_POST['verifycode']);
if(!$zbp->CheckValidCode($verifycode,'Changepassword')){
    ytuser_error('验证码错误，请重新输入.');die();
}
if(GetVars('newpassword','POST') != GetVars('repassword','POST')){
    ytuser_error('两次密码输入不一致！');die();
}
if(!$zbp->ValidToken(GetVars('token','POST'))){ytuser_error('权限不足，请联系网站管理员！');die();}
$newpassword=trim($_POST['newpassword']);
if($zbp->user->Password!='0e681aa506fc191c5f2fa9be6abddd01'){
    $password=trim($_POST['password']);
    if($zbp->user->Password!=md5(md5($password).$zbp->user->Guid)){
        ytuser_error('原密码错误！');die();
    }
}

$m = $zbp->GetMemberByName($zbp->user->Name);
$m->Password = md5(md5($newpassword) .$zbp->user->Guid);
$m->Save();
ytuser_success('修改成功！');
die();
?>