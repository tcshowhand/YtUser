<?php

#注册插件
RegisterPlugin("ggravatar", "ActivePlugin_ggravatar");

function ActivePlugin_ggravatar() {

	Add_Filter_Plugin('Filter_Plugin_Mebmer_Avatar', 'ggravatar_Url');

}

function InstallPlugin_ggravatar() {
	global $zbp;
	$zbp->Config('ggravatar')->s = '80';
	$zbp->Config('ggravatar')->d = 'identicon';
	$zbp->Config('ggravatar')->dd = $zbp->host.'zb_users/avatar/0.png';
	$zbp->Config('ggravatar')->r = 'G';
	$zbp->Config('ggravatar')->check = false;
	$zbp->Config('ggravatar')->default_url = 'https://cdn.v2ex.com/gravatar/';
	$zbp->Config('ggravatar')->local_priority = true;
	$zbp->SaveConfig('ggravatar');
}

function UninstallPlugin_ggravatar() {
	global $zbp;
	$zbp->DelConfig('ggravatar');
}

function ggravatar_get( $email, $s = null, $d = null, $r = null, $img = null, $atts = array() ) {
	global $zbp;
	$local_rg = $zbp->host . 'zb_users/plugin/ggravatar/avatars/'.mt_rand(1,20).'.jpg';
	$local_g = $zbp->host.'zb_users/avatar/0.png';
	$urlencode_local_rg = urlencode($local_rg);
	$urlencode_local_g = urlencode($local_g);
	
	if (!$s){
		$s = '80';
		if ($zbp->Config('ggravatar')->s)$s = $zbp->Config('ggravatar')->s;
	}
	if (!$d){
		$d = 'identicon';
		if ($zbp->Config('ggravatar')->d == "local_g"){
			$d = $zbp->Config('ggravatar')->dd?$urlencode_local_rg:$urlencode_local_g;
		}elseif($zbp->Config('ggravatar')->d == "local_rg"){
			$d = $urlencode_local_rg;
		}else{
			$d = $zbp->Config('ggravatar')->d;
		}
	}
	if (!$r){
		$r = 'G';
		$r = $zbp->Config('ggravatar')->r?$zbp->Config('ggravatar')->r:$r;
	}
	
	$url = '';
	if (ggravatar_check($email)&&$zbp->Config('ggravatar')->default_url){
		$url = $zbp->Config('ggravatar')->default_url;
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
	}else{
		$url = $zbp->Config('ggravatar')->d == "local_rg"?$local_rg:$local_g;
	}
	
	if ( $img ) {
		 $url = '<img src="' . $url . '"';
		 foreach ( $atts as $key => $val ){
		 $url .= ' ' . $key . '="' . $val . '"';
		 }
		 $url .= ' />';
	}
	return $url;
}

//验证是否设置了 Gravatar 头像 而不是 Gravatar 默认的头像  这个判断过程会有点慢
function ggravatar_check($email){
	global $zbp;
	if ($zbp->Config('ggravatar')->check){
		if (!$email) return false;
		$uri = $hash = '';
		$hash = md5(strtolower(trim($email)));
		$uri = $zbp->Config('ggravatar')->default_url . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			return false;
		} else {
			return true;
		}
	}else{
		return true;
	}
}
/* $atts=array( 'alt'=>'Gravatar', 'class'=>'ggravatar' ) */

function ggravatar_Url(&$member) {
	global $zbp;
	if ($zbp->Config('ggravatar')->local_priority && $member->ID > 0) {
		if (file_exists($zbp->usersdir . 'avatar/' . $member->ID . '.png')) {
			$GLOBALS['Filter_Plugin_Mebmer_Avatar']['ggravatar_Url'] = PLUGIN_EXITSIGNAL_RETURN;
			return $zbp->host . 'zb_users/avatar/' . $member->ID . '.png';
		}
	}

	$GLOBALS['Filter_Plugin_Mebmer_Avatar']['ggravatar_Url'] = PLUGIN_EXITSIGNAL_RETURN;
	return ggravatar_get( $email=$member->Email, $s = null, $d = null, $r = null,$img = false, $atts = array());

}

?>