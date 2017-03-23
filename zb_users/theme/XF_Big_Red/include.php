<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/search_config.php'; // searchplus
RegisterPlugin("XF_Big_Red","ActivePlugin_XF_Big_Red");
function ActivePlugin_XF_Big_Red(){
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','XF_Big_Red_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_Search_Begin','XF_Big_Red_SearchMain');
	Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response','XF_Big_Red_Category_Edit_Response');
	Add_Filter_Plugin('Filter_Plugin_Tag_Edit_Response','XF_Big_Red_Tag_Edit_Response');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','XF_Big_Red_Edit_Response5');
}
function XF_Big_Red_AddMenu(&$m){
global $zbp;
	array_unshift($m, MakeTopMenu("root",'主题配置',$zbp->host . "zb_users/theme/XF_Big_Red/main.php?act=explain","","topmenu_XF_Big_Red"));
}

function XF_Big_Red_SubMenu($id){
	$arySubMenu = array(
		0 => array('基本设置', 'config', 'left', false),
		1 => array('主题说明', 'explain', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}
function XF_Big_Red_tags_set(&$template){
	global $zbp;
	$template->SetTags('XF_Big_Red_keywords',$zbp->Config('XF_Big_Red')->keywords);
    $template->SetTags('XF_Big_Red_description',$zbp->Config('XF_Big_Red')->description);
	$template->SetTags('XF_Big_Red_recommend',$zbp->Config('XF_Big_Red')->recommend);
	$template->SetTags('XF_Big_Red_seo',$zbp->Config('XF_Big_Red')->seo);
	$template->SetTags('XF_Big_Red_post_category',$zbp->Config('XF_Big_Red')->post_category);
	$template->SetTags('XF_Big_Red_page_subname',$zbp->Config('XF_Big_Red')->page_subname);
}
function InstallPlugin_XF_Big_Red(){
	global $zbp;
	if(!$zbp->Config('XF_Big_Red')->HasKey('Version')){
		$zbp->Config('XF_Big_Red')->Version = '1.0';
		$zbp->Config('XF_Big_Red')->keywords = '请填写您的网站关键词，可用英文逗号(,)分开。';
		$zbp->Config('XF_Big_Red')->description = '请填写您的网站描述。';
		$zbp->Config('XF_Big_Red')->recommend = '欢迎来到小锋博客！';
		$zbp->Config('XF_Big_Red')->seo = 'b';
		$zbp->Config('XF_Big_Red')->post_category = 'a';
		$zbp->Config('XF_Big_Red')->page_subname = 'a';
		$zbp->SaveConfig('XF_Big_Red');
	}
}
function XF_Big_Red_Edit_Response5(){
    global $zbp,$article;
	if ($zbp->Config('XF_Big_Red')->seo=="b"){
		echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:99%;" type="text" name="meta_gjc" value="'.htmlspecialchars($article->Metas->gjc).'"/></div>';
		echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:99%;" type="text" name="meta_ms" value="'.htmlspecialchars($article->Metas->ms).'"/></div>';
		echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:99%;" type="text" name="meta_fjbt" value="'.htmlspecialchars($article->Metas->fjbt).'"/></div>';
	}
}
function XF_Big_Red_Tag_Edit_Response(){
    global $zbp,$tag;
	if ($zbp->Config('XF_Big_Red')->seo=="b"){
		echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:293px;" type="text" name="meta_gjc" value="'.htmlspecialchars($tag->Metas->gjc).'"/></div>';
		echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:293px;" type="text" name="meta_ms" value="'.htmlspecialchars($tag->Metas->ms).'"/></div>';
		echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:293px;" type="text" name="meta_fjbt" value="'.htmlspecialchars($tag->Metas->fjbt).'"/></div>';
	}
}
function XF_Big_Red_Category_Edit_Response(){
    global $zbp,$cate;
	if ($zbp->Config('XF_Big_Red')->seo=="b"){
		echo '<div><label for="meta_gjc"><span style="font-weight: bold;">关键词:</span></label><br></label><input style="width:293px;" type="text" name="meta_gjc" value="'.htmlspecialchars($cate->Metas->gjc).'"/></div>';
		echo '<div><label for="meta_ms"><span style="font-weight: bold;">描述:</span></label><br><input style="width:293px;" type="text" name="meta_ms" value="'.htmlspecialchars($cate->Metas->ms).'"/></div>';
		echo '<div><label for="meta_fjbt"><span style="font-weight: bold;">附加标题（留空即为不显示）:</span></label><br><input style="width:293px;" type="text" name="meta_fjbt" value="'.htmlspecialchars($cate->Metas->fjbt).'"/></div>';
	}
}
//卸载主题
function UninstallPlugin_XF_Big_Red(){
	global $zbp;
}
?>