<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if(GetVars('type','GET') == 'certifi' ){

	if(GetVars('id','GET')<1){
		$zbp->SetHint('good','参数错误');
		Redirect('./certifi.php');
	}else{
		$ytuser = new Ytuser();
		$ytuser->YtInfoByField('Uid',(int)GetVars('id','GET'));
	}

    if(GetVars('act','GET') == 'edit' ){
		$ytuser->Isidcard=2;
	}
	if(GetVars('act','GET') == 'del' ){
		$ytuser->Isidcard=3;
		$ytuser->Name='';
		$ytuser->Idcard='';
	}
	$ytuser->Save();
	$zbp->SetHint('good','修改成功');
	Redirect('./certifi.php');
}

if(GetVars('type','GET') == 'setcertifi' ){
    $zbp->Config('YtUser')->Oncertif = GetVars('Oncertif','POST');
    $zbp->Config('YtUser')->certifititle = GetVars('certifititle','POST');
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./certifi.php');
}

if(GetVars('type','GET') == 'base' ){
    $zbp->Config('YtUser')->appid = GetVars('appid','POST');
    $zbp->Config('YtUser')->appkey = GetVars('appkey','POST');
    $zbp->Config('YtUser')->readme_text = GetVars('readme_text','POST');
    $zbp->Config('YtUser')->integral_text = GetVars('integral_text','POST');
    $zbp->Config('YtUser')->vipdis = GetVars('vipdis','POST');
    $zbp->Config('YtUser')->payment = GetVars('payment','POST');
    $zbp->Config('YtUser')->open_reg = GetVars('open_reg','POST');
	$zbp->Config('YtUser')->regneedemail = GetVars('regneedemail','POST');
	$zbp->Config('YtUser')->regipdate = GetVars('regipdate','POST');
	$zbp->Config('YtUser')->login_verifycode = GetVars('login_verifycode','POST');
    $zbp->Config('YtUser')->login_user = GetVars('login_user','POST');
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./base.php');
}

if(GetVars('type','GET') == 'upgrade' ){

	if(GetVars('resetb','POST')=='add'){
        $Number = GetVars('Number','POST');
        $Price = GetVars('Price','POST');
        YtUser_CreateCode($Number,$Price);
	}
	
	if(GetVars('resetb','POST')=='del'){
		YtUser_DelUsedCode();
	}
	if(GetVars('resetb','POST')=='deln'){
		YtUser_DelUsedCoden();
	}
	if(GetVars('resetb','POST')=='ept'){
		YtUser_EmptyCode();
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./viplist.php');
}

if(GetVars('type','GET') == 'setorder' ){
	global $zbp;
	$orderid = GetVars('inputorderid','POST');
	$uid = GetVars('userid','POST');
	$pid = GetVars('postid','POST');
	$reset = GetVars('resete','POST');
	$pay = GetVarsByDefault('pay','POST',0);
	$state = GetVars('state','POST');
	$express = GetVars('express','POST');
	$postt = $zbp->GetPostByID($pid);
	
	if (isset($zbp->members[$uid])){
	$sql=$zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=','buy_LogID',$pid),array('=','buy_AuthorID',$uid)),null,null,null);
	$array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);
	$count = count($array);
	if ($count){
		if ($reset == 'delid'){
			if ($orderid){
				$where = array('=','buy_OrderID',$orderid);
			}else{
				$where = array(
				array('=','buy_AuthorID',$uid),
				array('=','buy_LogID',$pid)
				);
			}
			$sql= $zbp->db->sql->Delete($YtUser_buy_Table,$where);
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"已删除");
            Redirect('./buy.php');
		}else{
			$keyvalue=array(
			'buy_State' => $state,
			'buy_Express' => $express,
			'buy_Pay' => $pay
			);
			if ($orderid){
				$where = array('=','buy_OrderID',$orderid);
			}else{
				$where = array(array('=','buy_AuthorID',$uid),array('=','buy_LogID',$pid));
			}
			$sql = $zbp->db->sql->Update($YtUser_buy_Table,$keyvalue,$where);
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"订单状态已更新");
            Redirect('./buy.php');
		}
	}else{
		$dataa = array( 
			'buy_LogID' => $pid,
			'buy_State' => $state,
			'buy_Pay' => $pay,
			'buy_Express' => $express,
			'buy_OrderID' => $orderid?$orderid:GetGuid(),
			'buy_AuthorID' => $uid,
			'buy_Title' => $postt->ID?$postt->Title:'不存在的商品 LogID='.$pid,
			'buy_PostTime' => time(),
			'buy_IP' => GetGuestIP()
		);
		
		$sql_in = $zbp->db->sql->Insert($YtUser_buy_Table,$dataa);
		//var_dump($sql_in);
		$zbp->db->Insert($sql_in);
		$zbp->SetHint('good',"订单已添加");
        Redirect('./buy.php');
	}
	}else{
		if($reset == 'delall'){
			$sql = $zbp->db->sql->Delete($YtUser_buy_Table,array('>','buy_ID',0));
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"全部订单已清除");
            Redirect('./buy.php');
		}elseif($reset == 'delnopay'){
			$sql = $zbp->db->sql->Delete($YtUser_buy_Table,array(array('>','buy_ID',0),array('<','buy_State',1)));
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"未付款订单已清除");
            Redirect('./buy.php');
		}else{
	    $zbp->SetHint('good',"用户ID不存在");
        Redirect('./buy.php');
		}

	}
}
if(GetVars('type','GET') == 'setidvip' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
		$add = GetVars('Price','POST');
        $ytuser = new Ytuser();
        $array=$ytuser->YtInfoByField('Uid',$uid);
        if(!$array){
            $ytuser = new Ytuser();
            $ytuser->Uid=$uid;
            $ytuser->Oid=0;
            $ytuser->Save();
        }
		if(GetVars('reseta','POST')=='getvip'){
			if ($ytuser->Vipendtime){
			$time = $ytuser->Vipendtime;
			$time = date("Y-m-d H:i:s",$time);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP到期时间 $time");
			}else{
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已过期");
			}
			Redirect('./viplist.php');
		}elseif(GetVars('reseta','POST')=='delidvip'){
            $ytuser->Vipendtime=time();
            $ytuser->Save();
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已设置为过期");
			Redirect('./viplist.php');
		}elseif(GetVars('reseta','POST')=='delallvip'){
			$sql = $zbp->db->sql->Select($tysuer_Table,'*',array('>','tc_Vipendtime',0),null,null,null);
			$array = $zbp->db->Query($sql);
			foreach ($array as $key=>$arrr){
				$key = $key+1;
				$uid = $arrr['tc_uid'];
				if (isset($zbp->members[$uid])){
				$sql = $zbp->db->sql->Update($zbp->table['Member'],array('mem_Level'=>5),array(array('=','mem_ID',$uid),array('=','mem_Level',4)));
				$zbp->db->Update($sql);
				}
                $ytuser = new Ytuser();
                $ytuser->YtInfoByField('Uid',$uid);
                $ytuser->Vipendtime=time();
                $ytuser->Save();
				$zbp->SetHint('good',$key."，用户ID:$uid 当前VIP已设置为过期");
			}
			$zbp->SetHint('good',count($array)+1 .'，所有用户VIP都已设置为过期');
			Redirect('./viplist.php');
		}else{
			$sql = $zbp->db->sql->Update($zbp->table['Member'],array('mem_Level'=>4),array(array('=','mem_ID',$uid),array('>','mem_Level',4)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 用户 Level 升级成功");
			$YtConsume = new YtConsume();
			$YtConsume->Uid=$uid;
			$YtConsume->Pid=0;
			$YtConsume->Time=time();
			$YtConsume->Money=0;
			$YtConsume->Type=1;
			$YtConsume->Title="管理员赠送".(int)$add."天VIP";
			$YtConsume->Save();
			$add = ($ytuser->Vipendtime?$ytuser->Vipendtime:time()) + 86400*(int)$add;
			$ytuser->Vipendtime=$add;
			$ytuser->Save();
			$add = date("Y-m-d H:i:s",$add);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP 到期时间 $add");
			$YtConsume = new YtConsume();
			Redirect('./viplist.php');
		}
	}
}
if(GetVars('type','GET') == 'recharge' ){
	global $zbp;

	if(GetVars('resetd','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
	}
	if(GetVars('resetd','POST')=='Pricedeln'){
		YtUser_Price_DelnoUsedCode();
	}
	if(GetVars('resetd','POST')=='Priceept'){
		YtUser_Price_EmptyCode();
	}

    if(GetVars('resetd','POST')=='generate'){
        $Number = $_POST['Number'];
        $Price = $_POST['Price'];
        YtUser_Price_CreateCode($Number,$Price);
	}
	$zbp->SetHint('good','设置成功');
	Redirect('./recharge.php');
}
if(GetVars('type','GET') == 'setidjf' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
        
		$add = GetVars('Price','POST');
        $ytuser = new Ytuser();
        $array=$ytuser->YtInfoByField('Uid',$uid);
        if(!$array){
            $ytuser = new Ytuser();
            $ytuser->Uid=$uid;
            $ytuser->Oid=0;
            $ytuser->Save();
        }
		if(GetVars('resetc','POST')=='getjf'){
			$Price = $ytuser->Price;
			$zbp->SetHint('good',"用户ID: $uid 积分 $Price");
			Redirect('./recharge.php');
		}elseif(GetVars('resetc','POST')=='delidjf'){
            $ytuser->Price=0;
            $ytuser->Save();
			$zbp->SetHint('good',"用户ID: $uid 当前积分已清零");
			Redirect('./recharge.php');
		}elseif(GetVars('resetc','POST')=='delalljf'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Price'=>0),array(array('>','tc_uid',0)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good','所有用户积分都已清零');
			Redirect('./recharge.php');
		}else{
			$ytuser->Price=$ytuser->Price+$add;
			$ytuser->Save();
			$zbp->SetHint('good',"用户ID: $uid 充值 $add 积分成功");
			$YtConsume = new YtConsume();
			$YtConsume->Uid=$uid;
			$YtConsume->Pid=0;
			$YtConsume->Time=time();
			$YtConsume->Money=0;
			$YtConsume->Type=1;
			$YtConsume->Title="管理员赠送".(int)$add."积分";
			$YtConsume->Save();
			$zbp->SetHint('good',"用户ID: $uid 当前积分 $ytuser->Price");
			Redirect('./recharge.php');
		}
	}else{
	    $zbp->SetHint('good',"用户ID错误");
        Redirect('./recharge.php');
	}
}

if(GetVars('type','GET') == 'testing' ){
	global $zbp;
	YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_Vipendtime","int(11) NOT NULL DEFAULT 0",true);
    YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_isidcard","int(1) NOT NULL DEFAULT 0",true);
    YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_idcard","varchar(255)",true);
    YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_name","varchar(255)",true);
    YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_tel","varchar(255)",true);
    YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_Vipendtime","int(11) NOT NULL DEFAULT 0",true);
	YtUser_DB_ADD(YtUser_ReplacePre($YtUser_buy_Table),"buy_Pay","int(11) NOT NULL",true);
	YtUser_DB_ADD(YtUser_ReplacePre($YtUser_buy_Table),"buy_Express","TEXT NOT NULL",true);
	YtUser_DB_ADD(YtUser_ReplacePre($YtConsume_Table),"cs_title","varchar(255) NOT NULL",true);
	Redirect('./testing.php');
}

if(GetVars('type','GET') == 'rewrite' ){
    $zbp->Config('YtUser')->YtUser_OnRW = GetVars('YtUser_OnRW','POST');
    $zbp->Config('YtUser')->YtUser_RWURL = GetVars('YtUser_RWURL','POST');
    if(GetVars('YtUser_OnRW','POST')){
	$zbp->Config('YtUser')->YtUser_UCenter = GetVars('YtUser_RWURL','POST').'/UCenter.html';
    $zbp->Config('YtUser')->YtUser_Login = GetVars('YtUser_RWURL','POST').'/Login.html';
	$zbp->Config('YtUser')->YtUser_Register = GetVars('YtUser_RWURL','POST').'/Register.html';
    $zbp->Config('YtUser')->YtUser_Articlelist = GetVars('YtUser_RWURL','POST').'/Articlelist';
	$zbp->Config('YtUser')->YtUser_Articlelist_page = GetVars('YtUser_RWURL','POST').'/Articlelist/page/';
	$zbp->Config('YtUser')->YtUser_Articleedt = GetVars('YtUser_RWURL','POST').'/Articleedt.html';
	$zbp->Config('YtUser')->YtUser_Integral = GetVars('YtUser_RWURL','POST').'/Integral.html';
	$zbp->Config('YtUser')->YtUser_buy = GetVars('YtUser_RWURL','POST').'/buy';
	$zbp->Config('YtUser')->YtUser_buy_ID = GetVars('YtUser_RWURL','POST').'/buy/uid/';
	$zbp->Config('YtUser')->YtUser_Upgrade = GetVars('YtUser_RWURL','POST').'/Upgrade.html';
	$zbp->Config('YtUser')->YtUser_Upgrade_vip = GetVars('YtUser_RWURL','POST').'/Upgrade.html?vip=';
	$zbp->Config('YtUser')->YtUser_Paylist = GetVars('YtUser_RWURL','POST').'/Paylist';
	$zbp->Config('YtUser')->YtUser_Paylist_page = GetVars('YtUser_RWURL','POST').'/Paylist/page/';
	$zbp->Config('YtUser')->YtUser_User = GetVars('YtUser_RWURL','POST').'/User.html';
	$zbp->Config('YtUser')->YtUser_Commentlist = GetVars('YtUser_RWURL','POST').'/Commentlist';
	$zbp->Config('YtUser')->YtUser_Commentlist_page = GetVars('YtUser_RWURL','POST').'/Commentlist/page/';
	$zbp->Config('YtUser')->YtUser_Resetpwd = GetVars('YtUser_RWURL','POST').'/Resetpwd.html';
	$zbp->Config('YtUser')->YtUser_Resetpassword = GetVars('YtUser_RWURL','POST').'/Resetpassword.html';
	$zbp->Config('YtUser')->YtUser_Nameedit = GetVars('YtUser_RWURL','POST').'/Nameedit.html';
	$zbp->Config('YtUser')->YtUser_Changepassword = GetVars('YtUser_RWURL','POST').'/Changepassword.html';
	$zbp->Config('YtUser')->YtUser_Binding = GetVars('YtUser_RWURL','POST').'/Binding.html';
	$zbp->Config('YtUser')->YtUser_Favorite = GetVars('YtUser_RWURL','POST').'/Favorite';
	$zbp->Config('YtUser')->YtUser_Favorite_page = GetVars('YtUser_RWURL','POST').'/Favorite/page/';
	$zbp->Config('YtUser')->YtUser_Consume = GetVars('YtUser_RWURL','POST').'/Consume';
	$zbp->Config('YtUser')->YtUser_Consume_page = GetVars('YtUser_RWURL','POST').'/Consume/page/';
	$zbp->Config('YtUser')->YtUser_Certifi = GetVars('YtUser_RWURL','POST').'/Certifi.html';
	}else{
	$zbp->Config('YtUser')->YtUser_UCenter = '?UCenter';
	$zbp->Config('YtUser')->YtUser_Login = '?Login';
	$zbp->Config('YtUser')->YtUser_Register = '?Register';
	$zbp->Config('YtUser')->YtUser_Articlelist = '?Articlelist';
	$zbp->Config('YtUser')->YtUser_Articlelist_page = '?Articlelist&page=';
	$zbp->Config('YtUser')->YtUser_Articleedt = '?Articleedt';
	$zbp->Config('YtUser')->YtUser_Integral = '?Integral';
	$zbp->Config('YtUser')->YtUser_buy = '?buy';
	$zbp->Config('YtUser')->YtUser_buy_ID = '?buy&uid=';
	$zbp->Config('YtUser')->YtUser_Upgrade = '?Upgrade';
	$zbp->Config('YtUser')->YtUser_Upgrade_vip = '?Upgrade&vip=';
	$zbp->Config('YtUser')->YtUser_Paylist = '?Paylist';
	$zbp->Config('YtUser')->YtUser_Paylist_page = '?Paylist&page=';
	$zbp->Config('YtUser')->YtUser_User = '?User';
	$zbp->Config('YtUser')->YtUser_Commentlist = '?Commentlist';
	$zbp->Config('YtUser')->YtUser_Commentlist_page = '?Commentlist&page=';
	$zbp->Config('YtUser')->YtUser_Resetpwd = '?Resetpwd';
	$zbp->Config('YtUser')->YtUser_Resetpassword = '?Resetpassword';
	$zbp->Config('YtUser')->YtUser_Nameedit = '?Nameedit';
	$zbp->Config('YtUser')->YtUser_Changepassword ='?Changepassword';
	$zbp->Config('YtUser')->YtUser_Binding = '?Binding';
	$zbp->Config('YtUser')->YtUser_Favorite = '?Favorite';
	$zbp->Config('YtUser')->YtUser_Favorite_page = '?Favorite&page=';
	$zbp->Config('YtUser')->YtUser_Consume = '?Consume';
	$zbp->Config('YtUser')->YtUser_Consume_page = '?Consume&page=';
	$zbp->Config('YtUser')->YtUser_Certifi = '?Certifi';
	}
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./rewrite.php');
}

function YtUser_CreateCode($n,$p=30){
	global $zbp;
    $p=(int)$p;
    if($p<1){$p=7;}
	for ($i=0; $i < $n; $i++) { 
		$r = new Base($GLOBALS['tyactivate_Table'],$GLOBALS['tyactivate_DataInfo']);
		$r->InviteCode=GetGuid();
		$r->Level=$p;
		$r->Save();
	}
}

function YtUser_DelUsedCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['tyactivate_Table'],array(array('<>','reg_AuthorID',0)));
	$zbp->db->Delete($sql);
}
function YtUser_DelUsedCoden(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['tyactivate_Table'],array(array('=','reg_AuthorID',0)));
	$zbp->db->Delete($sql);
}

function YtUser_EmptyCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['tyactivate_Table'],null);
	$zbp->db->Delete($sql);
}


function YtUser_Price_CreateCode($n,$p=100){
	global $zbp;
    $p=(int)$p;
    if($p<1){$p=100;}
	for ($i=0; $i < $n; $i++) { 
		$r = new Base($GLOBALS['typrepaid_Table'],$GLOBALS['typrepaid_DataInfo']);
		$r->InviteCode=GetGuid();
		$r->Price=$p;
		$r->Save();
	}
}

function YtUser_Price_DelUsedCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['typrepaid_Table'],array(array('<>','tc_AuthorID',0)));
	$zbp->db->Delete($sql);
}
function YtUser_Price_DelnoUsedCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['typrepaid_Table'],array(array('=','tc_AuthorID',0)));
	$zbp->db->Delete($sql);
}
function YtUser_Price_EmptyCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['typrepaid_Table'],null);
	$zbp->db->Delete($sql);
}


?>