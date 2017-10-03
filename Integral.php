<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$invitecode=trim($_POST['invitecode']);
$verifycode=trim($_POST['verifycode']);

if(!$zbp->CheckValidCode($verifycode,'Integral')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}

$sql=$zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
$array=$zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
$num=count($array);
if($num==0){
            $DataArr = array(
                'tc_uid'    => $zbp->user->ID,
                'tc_oid'    => 0,
            );
        	$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
            $Price=0;
}else{
$reg=$array[0];
$Price=$reg->Price;
}
$sql=$zbp->db->sql->Select($typrepaid_Table,'*',array(array('=','tc_InviteCode',$invitecode),array('=','tc_AuthorID',0)),null,null,null);
$array=$zbp->GetListCustom($typrepaid_Table,$typrepaid_DataInfo,$sql);
$num=count($array);
if($num==0){
	$zbp->ShowError('充值卡不存在或已被使用.');die();
}
$reg=$array[0];
$keyvalue=array();
$keyvalue['tc_AuthorID']=$zbp->user->ID;
$sql = $zbp->db->sql->Update($typrepaid_Table,$keyvalue,array(array('=','tc_ID',$reg->ID)));
$zbp->db->Update($sql);

$ytuser = new Ytuser();
$ytuser->YtInfoByField('Uid',$zbp->user->ID);
$ytuser->Price=$Price+$reg->Price;
$ytuser->Save();

echo '充值成功！';

?>