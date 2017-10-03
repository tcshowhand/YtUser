<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
$verifycode=trim($_POST['verifycode']);
if(!$zbp->CheckValidCode($verifycode,'Changepassword')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}
if(GetVars('newpassword','POST') != GetVars('repassword','POST')){
    $zbp->ShowError('两次密码输入不一致！');die();
}
if(!$zbp->ValidToken(GetVars('token','POST'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
$newpassword=trim($_POST['newpassword']);

if($zbp->user->Password!='0e681aa506fc191c5f2fa9be6abddd01'){
    $password=trim($_POST['password']);
    if($zbp->user->Password!=md5(md5($password).$zbp->user->Guid)){
        $zbp->ShowError('原密码错误！');die();
    }
}
    $m=$zbp->membersbyname[$zbp->user->Name];
    $m->Password = md5(md5($newpassword) .$zbp->user->Guid);
    $m->Save();
    echo '修改成功！';die();
?>