<?php
RegisterPlugin("yt_uc","ActivePlugin_yt_uc");
if($zbp->Config('yt_uc')->tpl_action == 1){
DefinePluginFilter('Filter_Plugin_YtUser_Dmuc');
}
function ActivePlugin_yt_uc() {
	global $zbp;
	if($zbp->Config('yt_uc')->tpl_action == 1){
	Add_Filter_Plugin('Filter_Plugin_YtUser_Dmuc','yt_uc_YtUser_Dmuc');
	}
	Add_Filter_Plugin('Filter_Plugin_Index_Begin','yt_uc_Index_Begin');
}

function yt_uc_YtUser_Dmuc(&$ytuser_templates,&$ytuser_theme) {
global $zbp;
	$ytuser_templates=array("t_header","t_certifi","t_articleedt", "t_articlelist", "t_binding", "t_buy", "t_changepassword", "t_commentlist", "t_consume", "t_favorite", "t_footer", "t_integral", "t_login", "t_nameedit", "t_pagebar", "t_paylist", "t_register", "t_resetpassword", "t_resetpwd","t_upgrade", "t_user");
	$ytuser_theme='yt_uc';
}

function yt_uc_Index_Begin() {
	global $zbp;
$zbp->Config('yt_uc')->tpl_Css = 'dreamweaver';
$zbp->Config('yt_uc')->tpl_action = 0;
$zbp->SaveConfig('yt_uc');
}

function InstallPlugin_yt_uc() {
	global $zbp;
}

function UninstallPlugin_yt_uc() {
	global $zbp;
	$zbp->DelConfig('yt_uc');
}