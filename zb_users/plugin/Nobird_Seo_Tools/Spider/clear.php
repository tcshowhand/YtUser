<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}


	$s=$zbp->db->sql->Delete($zbp->table['Nobird_Spider_Table'],'');
	$zbp->db->QueryMulit($s);

	Redirect('spider.php');










