<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}


if($_GET['type'] == 'add' ){
	global $zbp;
	
	if(!$_POST["title"] or !$_POST["url"]){
		$zbp->SetHint('bad','关键字或链接不能为空');
		Redirect('./kwlink.php');
		exit();
	}
	

	$editid=GetVars('editid', 'POST');
	$keyword=new nobird_seo_tools_keyword();
	$keyword->LoadinfoByID($editid);
	$keyword->Title=GetVars('title', 'POST');
	$keyword->Url=GetVars('url', 'POST');
	$keyword->IsUsed=GetVars('IsUsed', 'POST');
	$keyword->Save();



	$zbp->SetHint('good','关键词保存成功');
	Redirect('./kwlink.php');
}

if($_GET['type'] == 'del' ){
	global $zbp;
	$id=GetVars('id', 'GET');
	$keyword=new nobird_seo_tools_keyword();
	$keyword->LoadinfoByID($id);
	$keyword->Del();
	$zbp->SetHint('good','删除成功');
	Redirect('./kwlink.php');
}

?>