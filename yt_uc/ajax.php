<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('yt_uc')) {$zbp->ShowError(48);die();}
require './function.php';
header('Content-Type: application/json');
switch (GetVars('action', 'GET')) {
	case 'load':
		echo json_encode(yt_uc_loadFile(GetVars('filename', 'GET')));
		break;
	case 'save':
		echo json_encode(yt_uc_saveFile(GetVars('filename', 'GET'), GetVars('content', 'POST')));
		break;
	default:
		break;
}

function yt_uc_loadFile($fileName) {
	global $plugin_Path;
	global $extensionToyt_uc;
	$fileName = str_replace('..', '', $fileName);
	$return = array(
		'aceMode' => 'plain_text',
		'content' => '',
		'size' => 0,
	);
	$filePath = $plugin_Path . $fileName;
	$extName = pathinfo($filePath, PATHINFO_EXTENSION);
	if (isset($extensionToyt_uc[$extName])) {
		$return['aceMode'] = $extensionToyt_uc[$extName];
	}
	if (is_file($filePath)) {
		$return['content'] = file_get_contents($filePath);
		$return['size'] = strlen($return['content']);
	}
	return $return;

}

function yt_uc_saveFile($fileName, $content) {

	global $plugin_Path;
	global $extensionToyt_uc;
	global $zbp;
	$return = array(
		'size' => 0,
	);
	$fileName = str_replace('..', '', $fileName);
	$filePath = $plugin_Path . $fileName;
	$extName = pathinfo($filePath, PATHINFO_EXTENSION);

	if (isset($extensionToyt_uc[$extName]) && is_file($filePath)) {
		file_put_contents($filePath, $content);
		$return['size'] = strlen($content);
	}
	return $return;

}