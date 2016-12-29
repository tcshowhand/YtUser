<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if(!$zbp->user->ID){
	$zbp->ShowError('请登录账户');die();
}
$LogID=(int)trim($_POST['LogID']);
$verifycode=trim($_POST['verifycode']);
if(!$zbp->CheckValidCode($verifycode,'Ytbuypay')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}
$sql=$zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
$array=$zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
$reg=$array[0];
$Price=$reg->Price;
$articles = $zbp->GetPostByID($LogID);
if($Price-$articles->Metas->price < 0){
    $zbp->ShowError('积分不够，请充值.');
}
$keyvalue=array();
$keyvalue['buy_State']=1;
$sql = $zbp->db->sql->Update($YtUser_buy_Table,$keyvalue,array(array('=','buy_AuthorID',$zbp->user->ID),array('=','buy_LogID',$LogID)));
$zbp->db->Update($sql);
$keyvalue=array();
$keyvalue['tc_Price']=$Price-$articles->Metas->price;
$sql = $zbp->db->sql->Update($tysuer_Table,$keyvalue,array(array('=','tc_uid',$zbp->user->ID)));
$zbp->db->Update($sql);
echo '购买成功！';
?>