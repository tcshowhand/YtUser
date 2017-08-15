<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';
$zbp->Load();


        $sql=$zbp->db->sql->Select($GLOBALS['tysuer_Table'],'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
        $array=$zbp->GetListCustom($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'],$sql);
        $num=count($array);
        if($num==0){
            $zbp->user->Price=0;
            $zbp->user->Vipendtime=0;
            $zbp->user->Oid="";
        }else{
            $reg=$array[0];
            $zbp->user->Price=$reg->Price;
            $zbp->user->Vipendtime=$reg->Vipendtime;
            $zbp->user->Oid=$reg->Oid;
        }
        if($Vipendtime<time() && $zbp->user->Level==4){
            $keyvalue=array();
            $keyvalue['mem_Level']=5;
            $sql = $zbp->db->sql->Update($zbp->table['Member'],$keyvalue,array(array('=','mem_ID',$zbp->user->ID)));
            $zbp->db->Update($sql);
            $zbp->user->Vip=0;
        }else{
            $zbp->user->Vip=1;
        }



    $sql = $zbp->db->sql->Select($zbp->table['Member'],array('mem_Name,mem_PostTime'),array('=','mem_IP',GetGuestIP()),null,null,null);
    $array = $zbp->GetListType('Member', $sql);
    foreach ($array as $arr){
		if ( date('Y-m-d',$arr->PostTime) == date('Y-m-d',time()) ){
			$zbp->ShowError('当前IP地址：'.GetGuestIP().' 今天已经注册过啦!已注册的用户名：'.$arr->Name);die();
		}
	}



?>