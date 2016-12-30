<?php
require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

$action=GetVars('act','GET');

if($action=="verify"){
}else{
    if($zbp->user->ID==0){Redirect($zbp->host);}
}

foreach ($GLOBALS['Filter_Plugin_Cmd_Begin'] as $fpname => &$fpsignal) {$fpname();}

if(!$zbp->CheckRights($action)){$zbp->ShowError(6,__FILE__,__LINE__);die();}

switch ($action) {
    case 'verify':
    if (VerifyLogin()) {
        if ($zbp->user->ID > 0 && GetVars('redirect', 'COOKIE')) {
            Redirect(GetVars('redirect', 'COOKIE'));
        }
        Redirect($zbp->host);
    } else {
        Redirect($zbp->host);
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
        $_POST['meta_Tel']=TransferHTML($_POST['meta_Tel'], '[noscript]');
        $_POST['meta_Add']=TransferHTML($_POST['meta_Add'], '[noscript]');
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