<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();     
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
    if($zbp->user->Level<4){
        ytuser_error('特殊会员不能使用此功能');die();
    }
    $invitecode=trim($_POST['invitecode']);
    $verifycode=trim($_POST['verifycode']);
    if(!$zbp->CheckValidCode($verifycode,'RegPage')){
        ytuser_error('验证码错误，请重新输入.');die();
    }
	$sql=$zbp->db->sql->Select($zbp->table['ytuser_activate'],'*',array(array('=','reg_InviteCode',$invitecode),array('=','reg_AuthorID',0)),null,null,null);  
	$array=$zbp->GetListCustom($zbp->table['ytuser_activate'],$zbp->datainfo['ytuser_activate'],$sql);
	$num=count($array);
	if($num==0){
        ytuser_error('VIP卡不存在或已被使用.');die();
	}
	$reg=$array[0];
	$keyvalue=array();
	$keyvalue['reg_AuthorID']=$zbp->user->ID;
	$keyvalue['reg_uptime']=time();
	$sql = $zbp->db->sql->Update($zbp->table['ytuser_activate'],$keyvalue,array(array('=','reg_ID',$reg->ID)));            
	$zbp->db->Update($sql);         
	$ytuser = new Ytuser();          
	$ytuser->LoadInfoByField('Uid',$zbp->user->ID);            
	if($ytuser->ID){
        $Vipendtime=$ytuser->Vipendtime;     
	}else{                    
        $ytuser = new Ytuser();       
        $ytuser->Uid=$zbp->user->ID;          
        $ytuser->Oid="0";
        $ytuser->Save();
        $Vipendtime=0;    
	}
    if($Vipendtime<time()){$Vipendtime=time();}
    $addtiem=86400*(int)$reg->Level;
    $ytuser->Vipendtime=$Vipendtime+$addtiem;   
    if($ytuser->Vipendtime>2147483647) $ytuser->Vipendtime=2147483647;
    $ytuser->Save();
    $keyvalue=array();
    $keyvalue['mem_Level']=4;
    $sql = $zbp->db->sql->Update($zbp->table['Member'],$keyvalue,array(array('=','mem_ID',$zbp->user->ID)));
    $zbp->db->Update($sql);

    ytuser_success('恭喜您充值成功！');die();
?>