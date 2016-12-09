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
	$zbp->ShowError('升级码不存在或已被使用.');die();
}
$reg=$array[0];
if($zbp->user->Level <= $reg->Level){
	$zbp->ShowError('升级码不适合你，请购买更高级的.');die();
}
$keyvalue=array();
$keyvalue['reg_AuthorID']=$zbp->user->ID;
$sql = $zbp->db->sql->Update($tyactivate_Table,$keyvalue,array(array('=','reg_ID',$reg->ID)));
$zbp->db->Update($sql);
$keyvalue=array();
$keyvalue['mem_Level']=$reg->Level;
$sql = $zbp->db->sql->Update($zbp->table['Member'],$keyvalue,array(array('=','mem_ID',$zbp->user->ID)));
$zbp->db->Update($sql);

echo '恭喜您升级成功！';

?>