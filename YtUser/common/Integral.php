<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if(!$zbp->ValidToken(GetVars('csrfToken','POST'))){
    ytuser_error('权限不足，请联系网站管理员！');die();
}

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
$invitecode=trim($_POST['invitecode']);
$verifycode=trim($_POST['verifycode']);

if(!$zbp->CheckValidCode($verifycode,'Integral')){
    ytuser_error('验证码错误，请重新输入.');die();
}
$ytuser = new Ytuser();
$ytuser->LoadInfoByField('Uid',$zbp->user->ID);
if($ytuser->ID==0){
    $ytuser->Uid=10;
    $ytuser->Oid=0;
    $ytuser->Save();
    $price=0;
}else{
    $price=$ytuser->Price;
}

$sql=$zbp->db->sql->Select($zbp->table['ytuser_prepaid'],'*',array(array('=','tc_InviteCode',$invitecode),array('=','tc_AuthorID',0)),null,null,null);              
$array=$zbp->GetListCustom($zbp->table['ytuser_prepaid'],$zbp->datainfo['ytuser_prepaid'],$sql);
$num=count($array);
if($num==0){
    ytuser_error('充值卡不存在或已被使用.');die();
}
$reg=$array[0];
$keyvalue=array();
$keyvalue['tc_AuthorID']=$zbp->user->ID; 
$keyvalue['tc_uptime']=time();      
$sql = $zbp->db->sql->Update($zbp->table['ytuser_prepaid'],$keyvalue,array(array('=','tc_ID',$reg->ID)));    
$zbp->db->Update($sql);
$jf=(int)$reg->Price;
$title="充值卡充值".(int)$reg->Price."积分";
YtUser_add_coin($zbp->user->ID,0,$jf,$title,3);
ytuser_success('充值成功！');die();
?>