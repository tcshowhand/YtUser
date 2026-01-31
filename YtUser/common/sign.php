<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}

if(!$zbp->user->ID){
    Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
}

$ver=new YtVerification();
$array=$ver->YtTypeCount(1);
if($array){
    $todayStartTime = strtotime(date("Y-m-d"));
    if ($ver->Expire <= $todayStartTime) {
        $ver->Count = 1;
        $ver->Expire=time();
    } else {
        $ver->Count=$ver->Count+1;
    }
    if($ver->Count > 1){
        ytuser_error("今天已经签到!!!");die();
        die();
    }
    $ver->Send=time();
}else{
    $ver->Uid=$zbp->user->ID;
    $ver->Count=1;
    $ver->Send=time();
    $ver->Expire=time();
    $ver->IP=GetGuestIP();
    $ver->Type=1;
}
$ver->Save();
$sign=(int)$zbp->Config('YtUser')->sign;

$title="签到获得".$sign."积分";
YtUser_add_coin($zbp->user->ID,0,$sign,$title,3);
ytuser_success("签到成功!");die();
?>