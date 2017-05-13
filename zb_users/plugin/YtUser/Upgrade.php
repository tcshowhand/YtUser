<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$invitecode=trim($_POST['invitecode']);
$verifycode=trim($_POST['verifycode']);

if(!$zbp->CheckValidCode($verifycode,'RegPage')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}

	$sql=$zbp->db->sql->Select($tyactivate_Table,'*',array(array('=','reg_InviteCode',$invitecode),array('=','reg_AuthorID',0)),null,null,null);
	$array=$zbp->GetListCustom($tyactivate_Table,$tyactivate_DataInfo,$sql);
	$num=count($array);
	if($num==0){
		$zbp->ShowError('VIP卡不存在或已被使用.');die();
	}
	$reg=$array[0];
	$keyvalue=array();
	$keyvalue['reg_AuthorID']=$zbp->user->ID;
	$sql = $zbp->db->sql->Update($tyactivate_Table,$keyvalue,array(array('=','reg_ID',$reg->ID)));
	$zbp->db->Update($sql);
    $sql=$zbp->db->sql->Select($GLOBALS['tysuer_Table'],'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
    $array=$zbp->GetListCustom($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'],$sql);
    $num=count($array);
    if($num==0){
            $DataArr = array('tc_uid'=> $zbp->user->ID,'tc_oid'=> 0,);
        	$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
        	$zbp->db->Insert($sql);
            $Vipendtime=0;
    }else{
    $rega=$array[0];
    $Vipendtime=$rega->Vipendtime;
    }
    if($Vipendtime==0){$Vipendtime=time();}
    $addtiem=86400*(int)$reg->Level;
    $keyvalue=array();
	$keyvalue['tc_Vipendtime']=$Vipendtime+$addtiem;
    $sql = $zbp->db->sql->Update($GLOBALS['tysuer_Table'],$keyvalue,array(array('=','tc_uid',$zbp->user->ID)));
    $zbp->db->Update($sql);

    echo '恭喜您充值成功！';

?>