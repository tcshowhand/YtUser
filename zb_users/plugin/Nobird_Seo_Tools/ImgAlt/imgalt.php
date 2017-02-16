<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='ImgAlt设置 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
  
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_ImgAlt')->IsUseTitle = $_POST['IsUseTitle'];
	$zbp->Config('Nobird_ImgAlt')->Titleappend = $_POST['Titleappend'];

	$zbp->Config('Nobird_ImgAlt')->IsUseAlt = $_POST['IsUseAlt'];
	$zbp->Config('Nobird_ImgAlt')->Altappend = $_POST['Altappend'];

	$zbp->Config('Nobird_ImgAlt')->suffix = $_POST['suffix'];

	$zbp->SaveConfig('Nobird_ImgAlt');
	$zbp->SetHint('good','参数已保存，刷新首页可以查看是否生效');
	Redirect('./imgalt.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
    <td>配置项</td>
    <td>配置参数</td>
    <td>备注</td>
</tr>
<tr>
	<td><p align='left'><b>是否修改图片Title</b></p></td>
	<td><input type="text"  name="IsUseTitle" value="<?php echo $zbp->Config('Nobird_ImgAlt')->IsUseTitle;?>" style="width:89%;" class="checkbox"/><b></b></td>
	<td><input type="text"  name="Titleappend" value="<?php echo $zbp->Config('Nobird_ImgAlt')->Titleappend;?>" style="width:89%;" class="checkbox"/><b>(新的title，是覆盖原有的title还是追加?)OFF表示覆盖</b></td>

</tr>
<tr>
	<td><p align='left'><b>是否修改图片Alt</b></p></td>
	<td><input type="text"  name="IsUseAlt" value="<?php echo $zbp->Config('Nobird_ImgAlt')->IsUseAlt;?>" style="width:89%;" class="checkbox"/><b></b></td>
	<td><input type="text"  name="Altappend" value="<?php echo $zbp->Config('Nobird_ImgAlt')->Altappend;?>" style="width:89%;" class="checkbox"/><b>(新的alt，是覆盖原有的alt还是追加?)OFF表示覆盖</b></td>

</tr>
<tr>
	<td><p align='left'><b>多张图时末尾增加的内容</b></p></td>
	<td colspan="2"><input id='suffix' name='suffix' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_ImgAlt')->suffix;?>'></td>
</tr>
<tr>
	<td><p><b>说明</b></p></td>
	<td colspan="2">
	<p>1、对于原有包含alt/title标签的内容不会进行修改，新的title/alt会追加在原有title和alt的后面</p>
	<p>2、新的title/alt格式为：原有的title/alt+文章名+分类名</p>
	<p>3、多张图末尾增加内容，%d为自增加参数，设置为“第%d张”，就会在末尾增加第1张、第2张、第3张</p>
	</td>
</tr>
</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>