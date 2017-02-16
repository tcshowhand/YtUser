<?php
function Nobird_AppCheck_SendMsg($zbphost,$id,$buy,$err){
  global $zbp;
  
$postdata = array(
		'USER_HOST'=>$zbphost,
		'APPID'=>$id,
		'BUY'=>$buy,
		'ERR'=>$err,
		'UA'=>GetGuestAgent(),
		'IP'=>GetGuestIP(),
		'AppCentreUserName'=>$zbp->Config('AppCentre')->username);
	$http_post = Network::Create();

	$http_post->open('POST',"http://www.birdol.com/zb_users/plugin/MyAPI/collect_msg/index.php");
	$http_post->setRequestHeader('Referer',substr($zbp->host,0,-1) . $zbp->currenturl);
	$http_post->send($postdata);

}

