<?php

#注册插件
RegisterPlugin("******","ActivePlugin_z_hide");

function ActivePlugin_z_hide() {
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','z_hide_html');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response3', 'z_hide_Edit');
}
function z_hide_html(&$template){
	global $zbp;
	$PID=$template->GetTags('article')->ID;
	$content=$template->GetTags('article')->Content;
	$template->GetTags('article')->Content=z_hide_str($content,$PID);
}
function InstallPlugin_z_hide() {}

function UninstallPlugin_z_hide() {
	global $zbp;
	$zbp->DelConfig('z_hide');
}

function z_hide_Edit(){
global $zbp;	
   	echo '<a href="javascript:void(0);" onclick="add_z_hide_lv();">[登陆可见]</a>';
	echo '<a href="javascript:void(0);" onclick="add_z_hide_cv();">[回复可见]</a>';
}