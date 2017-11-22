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