<?php
ob_start();
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
if (!$zbp->CheckPlugin('IMAGE')) {$zbp->ShowError(48);die();}
$IMAGE=IMAGE::createBean();
ob_end_clean();
$IMAGE->output();

?>