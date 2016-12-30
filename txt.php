<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';


$zbp->Load();


$aaa = '%pre%zcenter_member';
$sql=array(1,2);
$array=$zbp->GetListCustomByArray($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'],$sql);
$aaaa=YtUser_ReplacePre($aaa);

print_r($aaaa);



?>