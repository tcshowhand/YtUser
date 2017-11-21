<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

    if(!$zbp->user->ID){
	    $zbp->ShowError('请登录账户');
	    header('Location: ' . $zbp->host .$zbp->Config('YtUser')->YtUser_Login);
	    die();
    }
    $LogID=trim($_POST['LogID']);
    $post=GetPost((int)$LogID);
    $userbuy=new YtuserBuy();
    $array = $userbuy->YtInfoByField('LogID',$LogID);
    if($array){
        if($userbuy->State){
            $zbp->ShowError('请不要重复下单');die();
        }else{
            echo '您已下过订单，请去付款';
        }
    }else{
        $userbuy->OrderID=GetGuid();
        $userbuy->LogID=$post->ID;
        $userbuy->AuthorID=$zbp->user->ID;
        $userbuy->Title=$post->Title;
        $userbuy->State=0;
        $userbuy->PostTime=time();
        $userbuy->IP=GetGuestIP();
        $userbuy->Save();
        echo '下单成功';
    }
?>