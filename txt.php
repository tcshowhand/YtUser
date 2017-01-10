<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';


$zbp->Load();


$domain = $zbp->host;
$userinfo = Network::Create();
$userinfo->open('GET',"https://manage.gentie.163.com/key?url=".$domain);
$userinfo->send();
$userinfo = json_decode($userinfo->responseText,true);

print_r($userinfo);



?>