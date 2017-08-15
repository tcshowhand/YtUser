<?php
require 'zb_system/function/c_system_base.php';
require 'zb_system/function/c_system_admin.php';
$zbp->Load();



$arr = array( 0=>'Hello');
echo implode(" ",$arr);


$aaaa='
{
"name":"gxny2",
  "version": "1.0.0",
  "demo_url": "http://www.abc.com",
  "author": "ThinkCMF",
  "lang": "zh-cn",
  "author_url": "http://www.abc.com ",
  "keywords": "广西模板",
  "description": "广西模板"
}';
$theme   = json_decode($aaaa, true); 
print_r($theme);
?>