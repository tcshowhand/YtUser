<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle = 'Nobird_Seo_Tools - 配置信息导入导出';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

$type=GetVars('type','GET');

if($type == 'import' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				$jsonfile=file_get_contents($_FILES[$key]['tmp_name']);
				$json=json_decode($jsonfile);
foreach ($json as $config=>$content){
  foreach($content as $k=>$v){
    $zbp->Config($config)->$k=$v;
  }
		$zbp->SaveConfig($config);

}
				//@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/'.$zbp->theme.'/style/img/logo.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./io.php');
}


?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle; ?></div>
  <div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">


<form enctype="multipart/form-data" method="post" action="io.php?type=import">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td><p align='left'><b>导出</b></p></td>
	<td><a target="_blank" href="export.php">点击导出配置信息</a>
</td>
</tr>
<tr>
	<td><p align='left'><b>导入</b></p></td>
	<td><input name="configjson" type="file"/> </td>
</tr>
</table>
	  <p><input name="" type="Submit" class="button" value="上传配置文件并导入"/>
	  </p>
	</form>


  
<script type="text/javascript">ActiveLeftMenu("aNobird_Seo_Tools");</script>
<script type="text/javascript">ActiveTopMenu("topmenu_Nobird_Seo_Tools");</script>

	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Nobird_Seo_Tools/logo.png'; ?>");</script>
</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>