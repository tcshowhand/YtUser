<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin($dm_tools['name'])) {$zbp->ShowError(48);die();}

if($_GET['type'] == "delthumb"){
	dm_tools_deleteDir($blogpath.'thumbs/');
	$zbp->SetHint('good','缩略图缓存已被清理');
	Redirect('set.php');
}
?>