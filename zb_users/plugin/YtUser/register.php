<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
//先验证验证码
$verifycode=trim($_POST['verifycode']);
if(!$zbp->CheckValidCode($verifycode,'register')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}
//再验证IP今天是否已经注册
if ($zbp->Config('YtUser')->regipdate){
	$sql = $zbp->db->sql->Select($zbp->table['Member'],array('mem_Name,mem_PostTime'),array('=','mem_IP',GetGuestIP()),null,null,null);
	$array = $zbp->db->Query($sql);
	foreach ($array as $arr){
		if ( date('Y-m-d',$arr['mem_PostTime']) == date('Y-m-d',time()) ){
			$zbp->ShowError('当前IP地址：'.GetGuestIP().' 今天已经注册过啦!已注册的用户名：'.$arr["mem_Name"]);die();
		}
	}
}
//开始记录新用户
$guid=GetGuid();
$member=new Member;
$member->Guid=$guid;
$member->Level=5;
//GetVars('reset','POST')
$name=trim(GetVars('name','POST'));
if(strlen($name)<$zbp->option['ZC_USERNAME_MIN']||strlen($name)>$zbp->option['ZC_USERNAME_MAX']){
	$zbp->ShowError('用户名不能过长或过短.');die();
}
if(!CheckRegExp($name,'[username]')){
	$zbp->ShowError('用户名只能包含字母数字._和中文.');die();
}
if(isset($zbp->membersbyname[$name])){
	$zbp->ShowError('用户名已存在');die();
}
$member->Name=$name;

$password=trim(GetVars('password','POST'));
$repassword=trim(GetVars('repassword','POST'));
if(strlen($password)<$zbp->option['ZC_PASSWORD_MIN']||strlen($password)>$zbp->option['ZC_PASSWORD_MAX']){
	$zbp->ShowError('密码必须在'.$zbp->option['ZC_PASSWORD_MIN'].'位-'.$zbp->option['ZC_PASSWORD_MAX'].'位间.');die();
}
if($password!=$repassword){
	$zbp->ShowError('请核对密码.');die();
}
$member->Password=Member::GetPassWordByGuid($password,$guid);

$member->PostTime=time();
$member->IP=GetGuestIP();

$email = trim(GetVars('email','POST'));
if ($zbp->Config('YtUser')->regneedemail){
	if ($email && CheckRegExp($email,'[email]')){
		$member->Email = $email;
	}else{
		$zbp->ShowError('必须输入邮箱.');die();
	}
}else{
	if ($email && CheckRegExp($email,'[email]')){
		$member->Email = $email;
	}else{
		$member->Email = 'null@null.com';
	}
}

$homepage = trim(GetVars('homepage','POST'));
if ($homepage){
	//$homepage = $zbp->host;
	if(strlen($homepage) > $zbp->option['ZC_HOMEPAGE_MAX']){
		$zbp->ShowError('网址不能过长.');die();
	}
	if(CheckRegExp($homepage,'[homepage]')){
		$member->HomePage=$homepage;
	}
}else{
	$member->HomePage=$homepage;
}

$member->Save();
foreach ($GLOBALS['hooks']['Filter_Plugin_RegPage_RegSucceed'] as $fpname => &$fpsignal) {
    $fpname($member);
}
echo '恭喜您注册成功,请在登录页面登录.';
?>