<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'base' ){
    $zbp->Config('YtUser')->appid = $_POST['appid'];
    $zbp->Config('YtUser')->appkey = $_POST['appkey'];
    $zbp->Config('YtUser')->readme_text=$_POST['readme_text'];
    $zbp->Config('YtUser')->integral_text=$_POST['integral_text'];
    $zbp->Config('YtUser')->vipdis=$_POST['vipdis'];
    $zbp->Config('YtUser')->payment=$_POST['payment'];
    $zbp->Config('YtUser')->open_reg=$_POST['open_reg'];
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=base');
}

if($_GET['type'] == 'upgrade' ){

	if(GetVars('reset','POST')=='add'){
        $Number = $_POST['Number'];
        $Price = $_POST['Price'];
        YtUser_CreateCode($Number,$Price);
	}
	
	if(GetVars('reset','POST')=='del'){
		YtUser_DelUsedCode();
	}
	if(GetVars('reset','POST')=='deln'){
		YtUser_DelUsedCoden();
	}
	if(GetVars('reset','POST')=='ept'){
		YtUser_EmptyCode();
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=upgrade');
}
if($_GET['type'] == 'setidvip' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
		$add = GetVars('Price','POST');
		$table = YtUser_ReplacePre($tysuer_Table);
		$sql = $zbp->db->sql->Select($table,'*',array(array('=','tc_uid',$uid)),null,null,null);
		$array = $zbp->GetListCustom($table,$tysuer_DataInfo,$sql);
		if (!isset($array[0])){
			$DataArr = array(
				'tc_uid'    => $uid,
				'tc_oid'    => 0,
			);
			$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
			$zbp->db->Insert($sql);
			$array = $zbp->GetListCustom($table,$tysuer_DataInfo,$sql);
		}
		if(GetVars('reset','POST')=='getvip'){
			$price = $array[0]->Vipendtime;
			$zbp->SetHint('good',"用户ID: $uid 当前VIP天数 $price");
			Redirect('./main.php?act=upgrade');
		}elseif(GetVars('reset','POST')=='delidvip'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>0),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已清零");
			Redirect('./main.php?act=upgrade');
		}elseif(GetVars('reset','POST')=='delallvip'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>0),array(array('>','tc_uid',0)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good','所有用户VIP都已清零');
			Redirect('./main.php?act=upgrade');
		}else{
			$add = $array[0]->Vipendtime + $add;
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Vipendtime'=>$add),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 充值 $add 天VIP成功");
			$zbp->SetHint('good',"用户ID: $uid 当前VIP天数 $add");
			Redirect('./main.php?act=upgrade');
		}
	}
}
if($_GET['type'] == 'recharge' ){
	global $zbp;

	if(GetVars('reset','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
	}
	if(GetVars('reset','POST')=='Pricedeln'){
		YtUser_Price_DelnoUsedCode();
	}
	if(GetVars('reset','POST')=='Priceept'){
		YtUser_Price_EmptyCode();
	}

    if(GetVars('reset','POST')=='generate'){
        $Number = $_POST['Number'];
        $Price = $_POST['Price'];
        YtUser_Price_CreateCode($Number,$Price);
	}
	$zbp->SetHint('good','设置成功');
	Redirect('./main.php?act=recharge');
}
if($_GET['type'] == 'setidjf' ){
	global $zbp;
	$uid = GetVars('UID','POST');
	if (isset($zbp->members[$uid])){
		$add = GetVars('Price','POST');
		$table = YtUser_ReplacePre($tysuer_Table);
		$sql = $zbp->db->sql->Select($table,'*',array(array('=','tc_uid',$uid)),null,null,null);
		$array = $zbp->GetListCustom($table,$tysuer_DataInfo,$sql);
		if (!isset($array[0])){
			$DataArr = array(
				'tc_uid'    => $uid,
				'tc_oid'    => 0,
			);
			$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
			$zbp->db->Insert($sql);
			$array = $zbp->GetListCustom($table,$tysuer_DataInfo,$sql);
		}
		if(GetVars('reset','POST')=='getjf'){
			$Price = $array[0]->Price;
			$zbp->SetHint('bad',"用户ID: $uid 积分 $Price");
			Redirect('./main.php?act=recharge');
		}elseif(GetVars('reset','POST')=='delidjf'){
			$sql = $zbp->db->sql->Update($tysuer_Table,array('tc_Price'=>0),array(array('=','tc_uid',$uid)));
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 当前积分已清零");
			Redirect('./main.php?act=recharge');
		}elseif(GetVars('reset','POST')=='delalljf'){
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

if($_GET['type'] == 'testing' ){
	global $zbp;
   
	YtUser_DB_ADD($tysuer_Table,"tc_Vipendtime","int(11) NOT NULL DEFAULT 0",true);

	YtUser_DB_ADD($YtUser_buy_Table,"buy_Pay","int(11) NOT NULL",true);
	Redirect('./main.php?act=testing');
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