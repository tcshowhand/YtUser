<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

require 'nbseo_batch.php';
$module = GetVars('module', 'GET');
$module = (isset($nbseo_batch->modules[$module]) ? $nbseo_batch->modules[$module] : NULL);
if (!$module) {
	exit(json_encode(array("err" => "no this module")));
}

$func = GetVars('function', 'POST');
$param = GetVars('param', 'POST');
$class = $nbseo_batch->load_module($module['id']);
$class->$func($param);
ob_clean();
echo '[';
echo implode(',', $class->output_json);
echo ']';