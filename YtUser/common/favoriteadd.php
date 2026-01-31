<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->user->ID){
    ytuser_error('请登录账户');die();
}else{                  
    $pid = GetVars('LogID', 'POST');
    $type = (int)GetVars('type', 'POST');
    if($type==1){
        $name="点赞";
    }else{
        $name="收藏";
    }
    if(!$pid){
        ytuser_error($name.'失败');die();
    }
    $w=array();
    $w['Pid']=$pid;
    $w['Uid']=$zbp->user->ID;
    $w['Type']=$type;
    $favorite = new YtFavorite;
    $favorite->LoadInfoByFields($w);
    if ($favorite->ID) {
        ytuser_error('您已'.$name.'过啦.');die();
    }
    $favorite->Uid=$zbp->user->ID;
    $favorite->Pid=(int)$pid;
    $favorite->Time=time();
    $favorite->Type=$type;
    $favorite->Save();
    ytuser_success($name.'成功！');die();
}