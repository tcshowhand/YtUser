<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
if(!$zbp->user->ID){ ytuser_error('请先登录');die();}
$id=(int) GetVars('id', 'GET');
$day=(int) GetVars('day', 'POST');
if($day<1) $day=1;
if($id){
    $ytuser = new Ytuser();
    $ytuser->LoadInfoByField('Uid',$zbp->user->ID);
    $zc=(int)$zbp->Config('YtUser')->topprice;
    $price=$zc*$day;
    if($ytuser->Price - $price < 0){     	   			
        ytuser_error('积分不够，请充值.');die();
    }
    $log=new Post();
    $log->LoadinfoByID($id);
    if($log->Metas->topendtime){
        $log->Metas->topendtime=(int)$log->Metas->topendtime+(86400*$day);
    }else{
        $log->Metas->topendtime=time()+(86400*$day);
    }
    $log->IsTop=1;
    $log->Save();
    $title="购买置顶".$day."天，消费".$price."积分";
    YtUser_add_coin($zbp->user->ID,0,-$price,$title,3);
    ytuser_success("置顶成功!!!");die();
}else{
    ytuser_error("非法错误");
    die();
}