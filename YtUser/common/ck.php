<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
ytuser_tCheckIsRefererValid();
if(!$zbp->user->ID){
    ytuser_error('请先登录',$zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
}
$id=(int) GetVars('LogID', 'POST');

if($id){
    $zz=new Ytuser();
    $zz->LoadInfoByField('Uid',$zbp->user->ID);
    $day=strtotime(date('Y-m-d 00:00:00'));
    if($zbp->user->Level==4 && $zz->vip==0){
        $endtime=(int)$zz->Vipendtime;
        if($endtime==2147483647){
            $zz->vip==4;
        }else{
            $end=$endtime-time();
            if($end>=31104000){
                $zz->vip==3;
            }elseif($end>=7776000){
                $zz->vip==2;
            }else{
                $zz->vip==1;
            }
        }
    }
    if($zbp->user->Level>4){
        $zz->vip==0;
    }
    if($zz->Ctime > $day){
        if($zz->vip==0){
            if($zz->Cnum>= $zbp->Config('YtUser')->downloadzsum){
                ytuser_error('今日次数不足！');die();
            }
        }
        if($zz->vip==1){
            if($zz->Cnum>=$zbp->Config('YtUser')->downloadsumy){
                ytuser_error('今日次数不足！');die();
            }
        }
        if($zz->vip==2){
            if($zz->Cnum>=$zbp->Config('YtUser')->downloadsumj){
                ytuser_error('今日次数不足！');die();
            }
        }
        if($zz->vip==3){
            if($zz->Cnum>=$zbp->Config('YtUser')->downloadsumn){
                ytuser_error('今日次数不足！');die();
            }
        }
        if($zz->vip==4){
            if($zz->Cnum>=$zbp->Config('YtUser')->downloadsumz){
                ytuser_error('今日次数不足！');die();
            }
        }
        $zz->Cnum=$zz->Cnum+1;
        $zz->Save();
    }else{
        $zz->Cnum=1;
        $zz->Ctime=time();
        $zz->Save();
    }
    $log=new ytuser_ck();
    $log->LoadInfoByField('Uid',$zbp->user->ID);
    $log->Pid=$id;
    $log->Uid=$zbp->user->ID;
    $log->Time=strtotime(date('Y-m-d 00:00:00'));
    $log->Save();
    ytuser_success("查看成功，等待刷新!");
    die();
}else{
    echo "非法错误!";die();
}