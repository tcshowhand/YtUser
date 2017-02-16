<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}
require 'nbseo_batch.php';
$module = GetVars('module', 'GET');
$module = (isset($nbseo_batch->modules[$module]) ? $nbseo_batch->modules[$module] : NULL);
$blogtitle = $Nobird_Plugin_Name. ($module ? ' - ' . $module['name'] : '');

require $blogpath . 'zb_system/admin/admin_header.php';
echo '<style type="text/css">tr{height: 32px}</style><script type="text/javascript" src="include/nbseo_batch.js"></script>';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?>  </div>

  <div id="divMain2">
<?php

if ($module) {
	require('include/gui_module.inc');
}
else {
	require('include/gui_main.inc');
}
?>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	

  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();




