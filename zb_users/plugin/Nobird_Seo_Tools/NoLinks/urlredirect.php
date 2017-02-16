<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$url = GetVars('url','GET');
if (!$url){
$url=$zbp->host;
}else{
$url = Nobird_unlock_url($url,$zbp->Config('Nobird_NoLinks')->NoLinkskey);
}
echo $url;
if (!CheckRegExp($url, '[homepage]')) {
$url=$zbp->host;
}

Redirect($url);

//解密函数
function Nobird_unlock_url($url,$key='Nobird'){
	$url = urldecode(base64_decode($url));
   
    return trim($url,$key);
}
