<?php
$plugin_Path = $zbp->path . 'zb_users/plugin/yt_uc/template';
$extension_List = array();
$extensionToyt_uc = array(
	'php' => 'php',
);
foreach ($extensionToyt_uc as $extensionKey => $extensionValue) {
	$extension_List[] = $extensionKey;
}

function scan_plugin_Dir() {
	global $zbp;
	global $extension_List;
	global $plugin_Path;

	$return = array();
	$extensionRegEx = '/\.(' . implode('|', $extension_List) . ')$/ui';
	$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($plugin_Path), RecursiveIteratorIterator::CHILD_FIRST);
	foreach ($iterator as $path) {
		$fileName = $path->__toString();
		if ($path->isFile()) {
			if (!preg_match('/(\/|\\\\)compile/', $fileName) && preg_match($extensionRegEx, $path)) {
				$return[] = str_replace($plugin_Path, '', $fileName);
			}
		}
	}
	return $return;
}

function save_plugin_yt_uc() {

}

function yt_uc_plugin_theme() {
global $zbp;
$theme_liststr = '';
$theme_liststr .= '<DIV id="con">';
$theme_liststr .= '  <UL id="tags">';
$theme_liststr .= '    <LI class="selectTag"><A onClick="selectTag(\'tagContent0\',this)"  href="javascript:void(0)">用户中心标签</A></LI>';
$theme_liststr .= '    <LI><A onClick="selectTag(\'tagContent1\',this)" href="javascript:void(0)">系统标签</A></LI>';
$theme_liststr .= '    <LI><A onClick="selectTag(\'tagContent2\',this)" href="javascript:void(0)">其他常用标签</A></LI>';
$theme_liststr .= '      </UL>';
$theme_liststr .= '      <DIV id="tagContent">';
$theme_liststr .= '        <DIV class="tagContent selectTag" id="tagContent0">';

$theme_liststr .= '        </DIV>';
$theme_liststr .= '        <DIV class="tagContent" id="tagContent1">';
$theme_liststr .= '';
$theme_liststr .= '        </DIV>';
$theme_liststr .= '        <DIV class="tagContent" id="tagContent2">';
$theme_liststr .= '';
$theme_liststr .= '        </DIV>';
$theme_liststr .= '      </DIV>';
$theme_liststr .= '    </DIV>';
echo $theme_liststr;
}