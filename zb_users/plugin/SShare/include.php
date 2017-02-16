<?php
#注册插件
RegisterPlugin("SShare","ActivePlugin_SShare");

function ActivePlugin_SShare() {
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','SShare');

}
function SShare(&$template){
	global $zbp;
		$a=$template->GetTags('article');
	$a->Content .= '<center><div class="social-share"></div>
<link rel="stylesheet" href="/zb_users/plugin/SShare/dist/css/share.min.css">
<script src="/zb_users/plugin/SShare/dist/js/share.min.js"></script>';	
}
function InstallPlugin_SShare() {}
function UninstallPlugin_SShare() {}