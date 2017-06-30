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

	if(GetVars('reset','POST')=='ept'){
		YtUser_EmptyCode();
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=upgrade');
}

if($_GET['type'] == 'recharge' ){
	global $zbp;

	if(GetVars('reset','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
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

if($_GET['type'] == 'testing' ){
	global $zbp;
    $usertable=YtUser_ReplacePre($tysuer_Table);
    $s = 'ALTER TABLE ' . $usertable . ' ADD COLUMN tc_Vipendtime int(11) NOT NULL DEFAULT \'0\';';
	$zbp->db->QueryMulit($s);
	$zbp->SetHint('good','修复成功');
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

function YtUser_Price_EmptyCode(){
	global $zbp;
	$sql = $zbp->db->sql->Delete($GLOBALS['typrepaid_Table'],null);
	$zbp->db->Delete($sql);
}


?>