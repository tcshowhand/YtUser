<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}
$data=array();
$data['Nobird_Seo_Tools']=$zbp->Config('Nobird_Seo_Tools')->GetData();
$data['Nobird_Spider']=$zbp->Config('Nobird_Spider')->GetData();
$data['Nobird_Sitemap']=$zbp->Config('Nobird_Sitemap')->GetData();
$data['Nobird_NoLinks']=$zbp->Config('Nobird_NoLinks')->GetData();
$data['Nobird_Nofollow']=$zbp->Config('Nobird_Nofollow')->GetData();
$data['Nobird_Keywordlink']=$zbp->Config('Nobird_Keywordlink')->GetData();
$data['Nobird_KeyAndDes']=$zbp->Config('Nobird_KeyAndDes')->GetData();
$data['Nobird_ImgAlt']=$zbp->Config('Nobird_ImgAlt')->GetData();
$data['Nobird_HtmlMinify']=$zbp->Config('Nobird_HtmlMinify')->GetData();
$data['Nobird_BeautyTitle']=$zbp->Config('Nobird_BeautyTitle')->GetData();


					$ua               = $_SERVER["HTTP_USER_AGENT"];
					$filename         = 'Nobird_Seo_Tools_BackUp.json';
					
						header('Content-Type: application/octet-stream');
						if (preg_match("/MSIE/", $ua)) {
							header('Content-Disposition: attachment; filename="' . $filename . '"');
						} elseif (preg_match("/Firefox/", $ua)) {
							header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
						} else {
							header('Content-Disposition: attachment; filename="' . $filename . '"');
						}
						ob_clean();

echo json_encode($data);

