<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

?>