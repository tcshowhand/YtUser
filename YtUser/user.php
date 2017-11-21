<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
    if(!$zbp->user->ID){
	    $zbp->ShowError('请登录账户');
	    header('Location: ' . $zbp->host .$zbp->Config('YtUser')->YtUser_Login);
	    die();
    }
?>