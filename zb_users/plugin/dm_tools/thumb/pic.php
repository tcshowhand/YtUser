<?php
ob_start();
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
if (!$zbp->CheckPlugin($dm_tools['name'])) {$zbp->ShowError(48);die();}
$dm_tools_thumb = dm_tools_thumb::createBean();
ob_end_clean();
$dm_tools_thumb->output();

?>