<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if(!$zbp->user->ID){
	$zbp->ShowError('请登录账户');
	header('Location: ' . $zbp->host .'?Login');
	die();
}
		$LogID=trim($_POST['LogID']);
		$post=GetPost((int)$LogID);

$sql=$zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=','buy_LogID',(int)$LogID),array('=','buy_AuthorID',$zbp->user->ID)),null,1,null);
$array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);
$num=count($array);
if($num==0){
		$r = new Base($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo']);
		$r->OrderID=GetGuid();
		$r->LogID=$post->ID;
		$r->AuthorID=$zbp->user->ID;
		$r->Title=$post->Title;
		$r->State=0;
		$r->PostTime=time();
		$r->IP=GetGuestIP();
		$r->Save();
		echo '下单成功';
}else{
	foreach ($array as $key => $reg) {
		if($reg->State){
			$zbp->ShowError('请不要重复下单');die();
		}else{
			echo '您已下过订单，请去付款';
		}
	}
}
?>