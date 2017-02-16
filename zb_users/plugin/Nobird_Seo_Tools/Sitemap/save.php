<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}


if($_GET['type'] == 'add' ){
	global $zbp;
	
	if(!$_POST["Url"]){
		$zbp->SetHint('bad','链接不能为空');
		Redirect('./coustom.php');
		exit();
	}
	if(!stristr($_POST["Url"],$zbp->host)){
		$zbp->SetHint('bad','添加的链接必须是本站站内链接！');
		Redirect('./coustom.php');
		exit();
	}

	$editid=GetVars('editid', 'POST');
	$keyword=new nobird_seo_tools_sitemap_coustom();
	$keyword->LoadinfoByID($editid);
	$keyword->Title=GetVars('Title', 'POST');
	$keyword->Url=GetVars('Url', 'POST');
	$keyword->Lastmod=strtotime(GetVars('Lastmod', 'POST'));
	$keyword->Changefreq=GetVars('Changefreq', 'POST');
	$keyword->Priority=GetVars('Priority', 'POST');
	$keyword->AppID='Nobird_Seo_Tools';
	$keyword->AddTime=time();
	$keyword->Save();



	$zbp->SetHint('good','保存成功');
	Redirect('./coustom.php');
}

if($_GET['type'] == 'del' ){
	global $zbp;
	$id=GetVars('id', 'GET');
	$keyword=new nobird_seo_tools_sitemap_coustom();
	$keyword->LoadinfoByID($id);
	$keyword->Del();
	$zbp->SetHint('good','删除成功');
	Redirect('./coustom.php');
}

?>