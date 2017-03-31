<?php 
RegisterPlugin('SlidesExpress', 'ActivePlugin_SlidesExpress');
function ActivePlugin_SlidesExpress(){
	Add_Filter_Plugin('Filter_Plugin_Admin_LeftMenu','SlidesExpress_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','SlidesExpress_set');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','SlidesExpress_set');
}
function SlidesExpress_AddMenu(&$m){
	global $zbp;
    $m[]=MakeLeftMenu("root","幻灯片管理",$zbp->host . "zb_users/plugin/SlidesExpress/main.php","nav_SlidesExpress","aSlidesExpress",$zbp->host . "zb_system/image/common/file_1.png");
}
function SlidesExpress_SubMenu($id){
	$aryCSubMenu = array(	
		0 => array('添加幻灯片', 'main.php', 'left', false),		
		7 => array('技术支持', 'http://www.ytecn.com/', 'right', true)
	);
	foreach($aryCSubMenu as $k => $v){
		echo '<a href="'.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$k?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function SlidesExpress_set(&$template){
    global $zbp;
    $slidesArray = json_decode($zbp->Config('SlidesExpress')->slidesArray,true);
    $template->SetTags('slidesArray', $slidesArray);
}

function InstallPlugin_SlidesExpress(){
	global $zbp;
	if(!$zbp->Config('SlidesExpress')->HasKey('Version')){
		$zbp->Config('SlidesExpress')->Version = '1.0';
		$zbp->Config('SlidesExpress')->slidesArray='[{"title":"这是标题","img":"'.$zbp->host . 'zb_users/plugin/SlidesExpress/images/slides/1.jpg","url":"'.$zbp->host . '","order":"1"}]';
		$zbp->SaveConfig('SlidesExpress');
	}
	$zbp->Config('SlidesExpress')->Version = '1.0';
	$zbp->SaveConfig('SlidesExpress');
}
function UninstallPlugin_SlidesExpress(){
	global $zbp;
	if ($zbp->Config('SlidesExpress')->clearSetting){
		$zbp->DelConfig('SlidesExpress');
	}
}
?>