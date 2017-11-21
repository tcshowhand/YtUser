<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

    if($zbp->user->Level<4){
        $zbp->ShowError('特殊会员不能使用此功能');die();
    }

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
	$ytuser = new Ytuser();
	$array = $ytuser->YtInfoByField('Uid',$zbp->user->ID);
	if($array){
	    $Vipendtime=$ytuser->Vipendtime;
	}else{
	    $ytuser = new Ytuser();
	    $ytuser->Uid=$zbp->user->ID;
        $ytuser->Oid="0";
        $ytuser->Save();
        $Vipendtime=0;
	}
    if($Vipendtime==0){$Vipendtime=time();}
    $addtiem=86400*(int)$reg->Level;
    $ytuser->Vipendtime=$Vipendtime+$addtiem;
    $ytuser->Save();
    $keyvalue=array();
    $keyvalue['mem_Level']=4;
    $sql = $zbp->db->sql->Update($zbp->table['Member'],$keyvalue,array(array('=','mem_ID',$zbp->user->ID)));
    $zbp->db->Update($sql);
    echo '恭喜您充值成功！';

?>