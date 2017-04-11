<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'base' ){
    $zbp->Config('YtUser')->dsurl = $_POST['dsurl'];
    $zbp->Config('YtUser')->readme_text=$_POST['readme_text'];
    $zbp->Config('YtUser')->integral_text=$_POST['integral_text'];
    $zbp->Config('YtUser')->vipdis=$_POST['vipdis'];
    $zbp->Config('YtUser')->payment=$_POST['payment'];
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=base');
}

if($_GET['type'] == 'upgrade' ){

	if(GetVars('reset','POST')=='add'){
		YtUser_CreateCode(10);
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
	
    if(GetVars('reset','POST')=='Priceadd'){
		YtUser_Price_CreateCode(10);
	}
	
	if(GetVars('reset','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
	}

	if(GetVars('reset','POST')=='Priceept'){
		YtUser_Price_EmptyCode();
	}

	$zbp->SetHint('good','幻灯保存成功');
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


function YtUser_CreateCode($n){
	global $zbp;
	for ($i=0; $i < 10; $i++) { 
		$r = new Base($GLOBALS['tyactivate_Table'],$GLOBALS['tyactivate_DataInfo']);
		$r->InviteCode=GetGuid();
		$r->Level=4;
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


function YtUser_Price_CreateCode($n){
	global $zbp;
	for ($i=0; $i < 10; $i++) { 
		$r = new Base($GLOBALS['typrepaid_Table'],$GLOBALS['typrepaid_DataInfo']);
		$r->InviteCode=GetGuid();
		$r->Price=100;
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