<?php
require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
$action=GetVars('act','GET');

if($action=="verify"){
}else{
    if($zbp->user->ID==0){Redirect($zbp->host);}
}

foreach ($GLOBALS['Filter_Plugin_Cmd_Begin'] as $fpname => &$fpsignal) {$fpname();}

if(!$zbp->CheckRights($action)){$zbp->ShowError(6,__FILE__,__LINE__);die();}

switch ($action) {
    case 'verify':
    $_POST['username']=$_POST['username'];
    $_POST['password']=$_POST['edtPassWord'];
    $_POST['savedate']=$_POST['strSaveDate'];
    if (VerifyLogin()) {
        echo '登录成功！';
    }
    break;
    case 'ArticlePst':
    	if(empty($_POST['Title']) || empty($_POST['Content'])){
    		$zbp->ShowError('骚年，不要捣乱！！！');die();
    	}
        if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
        $_POST['Status'] = 2;
		PostArticle();
		$zbp->BuildModule();
		$zbp->SaveCache();
		$zbp->SetHint('good');
		Redirect($zbp->host.'?Articlelist');
		break;
	case 'MemberPst':
		if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
		$_POST['Password'] = null;
		$_POST['PasswordRe'] = null;
        if (isset($_POST["meta_Tel"])) {
        $_POST['meta_Tel']=TransferHTML($_POST['meta_Tel'], '[noscript]');
        }
        if (isset($_POST["meta_Add"])) {
            $_POST['meta_Add']=TransferHTML($_POST['meta_Add'], '[noscript]');
        }
        $_POST['meta_buysuccess']='';
		PostMember();
		$zbp->BuildModule();
		$zbp->SaveCache();
		$zbp->SetHint('good');
		Redirect($zbp->host.'?User');
		break;
	default:
		# code...
		break;
}