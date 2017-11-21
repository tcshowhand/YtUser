<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->CheckValidCode(GetVars('verifycode','POST'),'Nameedit')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}
if(GetVars('name','POST') != GetVars('rename','POST')){
    $zbp->ShowError('两次账户输入不一致！');die();
}
if(!$zbp->ValidToken(GetVars('token','POST'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
if(strlen(GetVars('name','POST'))<$zbp->option['ZC_USERNAME_MIN']||strlen(GetVars('name','POST'))>$zbp->option['ZC_USERNAME_MAX']){
	$zbp->ShowError('用户名不能过长或过短.');die();
}
if(!CheckRegExp(GetVars('name','POST'),'[username]')){
	$zbp->ShowError('用户名只能包含字母数字._和中文.');die();
}
if(isset($zbp->membersbyname[GetVars('name','POST')])){
	$zbp->ShowError('用户名已存在');die();
}
$m=$zbp->membersbyname[$zbp->user->Name];
$m->Name = GetVars('name','POST');
$m->Save();
echo '修改成功！';die();
?>