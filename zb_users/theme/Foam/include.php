<?php

RegisterPlugin("Foam","ActivePlugin_Foam");

function ActivePlugin_Foam(){
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','Foam_AddMenu');
}

function Foam_AddMenu(&$m){
	global $zbp;
	array_unshift($m, MakeTopMenu("root",'泡沫主题配置',$zbp->host . "zb_users/theme/Foam/main.php","","topmenu_Foam"));
}

function InstallPlugin_Foam(){
	global $zbp;
	//配置初始化
	if(!$zbp->Config('Foam')->HasKey('Version')){
		$zbp->Config('Foam')->Version='1.0';
		$zbp->SaveConfig('Foam');
	}
}

function UninstallPlugin_Foam(){
	global $zbp;
	//$zbp->DelConfig('Foam');
}
?>