<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

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
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=base');
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
	Redirect('./main.php?act=upgrade');
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
            Redirect('./main.php?act=buy');
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
            Redirect('./main.php?act=buy');
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
        Redirect('./main.php?act=buy');
	}
	}else{
		if($reset == 'delall'){
			$sql = $zbp->db->sql->Delete($YtUser_buy_Table,array('>','buy_ID',0));
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"全部订单已清除");
            Redirect('./main.php?act=buy');
		}elseif($reset == 'delnopay'){
			$sql = $zbp->db->sql->Delete($YtUser_buy_Table,array(array('>','buy_ID',0),array('<','buy_State',1)));
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"未付款订单已清除");
            Redirect('./main.php?act=buy');
		}else{
	    $zbp->SetHint('good',"用户ID不存在");
        Redirect('./main.php?act=buy');
		}

	}
}
if(GetVars('type','GET') == 'setidvip' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
		$add = GetVars('Price','POST');
		$sql = $zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$uid)),null,null,null);
		$array = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
		if (!isset($array[0])){
			$DataArr = array(
				'tc_uid'    => $uid,
				'tc_oid'    => 0,
			);
			$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
			$array = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
		}
		if(GetVars('reseta','POST')=='getvip'){
			if ($array[0]->Vipendtime){
			$price = $array[0]->Vipendtime;
			$price = date("Y-m-d H:i:s",$price);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP到期时间 $price");
			}else{
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已过期");
			}
			Redirect('./main.php?act=upgrade');
		}elseif(GetVars('reseta','POST')=='delidvip'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>time()),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已设置为过期");
			Redirect('./main.php?act=upgrade');
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
				$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>time()),array('=','tc_uid',$uid));
				$zbp->db->Update($sql);
				
				$zbp->SetHint('good',$key."，用户ID:$uid 当前VIP已设置为过期");
			}
			$zbp->SetHint('good',count($array)+1 .'，所有用户VIP都已设置为过期');
			Redirect('./main.php?act=upgrade');
		}else{
			$sql = $zbp->db->sql->Update($zbp->table['Member'],array('mem_Level'=>4),array(array('=','mem_ID',$uid),array('>','mem_Level',4)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 用户 Level 升级成功");
			
			$add = ($array[0]->Vipendtime?$array[0]->Vipendtime:time()) + 86400*(int)$add;
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>$add),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$add = date("Y-m-d H:i:s",$add);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP 到期时间 $add");
			Redirect('./main.php?act=upgrade');
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
	Redirect('./main.php?act=recharge');
}
if(GetVars('type','GET') == 'setidjf' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
		$add = GetVars('Price','POST');
		$sql = $zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$uid)),null,null,null);
		$array = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
		if (!isset($array[0])){
			$DataArr = array(
				'tc_uid'    => $uid,
				'tc_oid'    => 0,
			);
			$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
			$array = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql);
		}
		if(GetVars('resetc','POST')=='getjf'){
			$Price = $array[0]->Price;
			$zbp->SetHint('good',"用户ID: $uid 积分 $Price");
			Redirect('./main.php?act=recharge');
		}elseif(GetVars('resetc','POST')=='delidjf'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Price'=>0),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 当前积分已清零");
			Redirect('./main.php?act=recharge');
		}elseif(GetVars('resetc','POST')=='delalljf'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Price'=>0),array(array('>','tc_uid',0)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good','所有用户积分都已清零');
			Redirect('./main.php?act=recharge');
		}else{
			$add = $array[0]->Price + $add;
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Price'=>$add),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 充值 $add 积分成功");
			$zbp->SetHint('good',"用户ID: $uid 当前积分 $add");
			Redirect('./main.php?act=recharge');
		}
	}
}

if(GetVars('type','GET') == 'testing' ){
	global $zbp;
   
	YtUser_DB_ADD(YtUser_ReplacePre($tysuer_Table),"tc_Vipendtime","int(11) NOT NULL DEFAULT 0",true);

	YtUser_DB_ADD(YtUser_ReplacePre($YtUser_buy_Table),"buy_Pay","int(11) NOT NULL",true);
	
	YtUser_DB_ADD(YtUser_ReplacePre($YtUser_buy_Table),"buy_Express","TEXT NOT NULL",true);
	
	Redirect('./main.php?act=testing');
}
if(GetVars('type','GET') == 'ccccc' ){
	global $zbp;
	$sql = $zbp->db->sql->Select($zbp->table['Category'],array('cate_ID'),null,null,null,null);
	$array = $zbp->db->Query($sql);
	$cat = '';
	foreach ($array as $arr){
		$cat .= $arr['cate_ID'].' | ';
	}
	//var_dump($array);
	file_put_contents($zbp->usersdir . 'cache/ids.txt', $cat);
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