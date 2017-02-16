<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='Nofollow设置 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
  
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_Nofollow')->IsUse = $_POST['IsUse'];
	$zbp->Config('Nobird_Nofollow')->followUrl = $_POST['followUrl'];
	$zbp->SaveConfig('Nobird_Nofollow');
	$zbp->SetHint('good','参数已保存，刷新首页可以查看是否生效');
	Redirect('./nofollow.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td><p align='left'><b>是否将文章中的外链都设置为nofollow?</b></p></td>
	<td><input type="text"  name="IsUse" value="<?php echo $zbp->Config('Nobird_Nofollow')->IsUse;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>排除的域名</b></p></td>
	<td><input id='followUrl' name='followUrl' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Nofollow')->followUrl;?>'>用|分割，默认已经增加了您的博客地址，无需额外填写</td>
</tr>

<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、启用后，插件会将文章正文部分的外链都自动增加nofollow属性</p>
	<p>2、排除的域名或字符串使用|分割，开头不写http://，末尾不加/或者|。</p>
	<p>×！排除baidu.com，则所有百度的二级域名都会被排除。</p>
	<p>×！排除wenku.baidu.com，则只排除wenku.baidu.com的链接。</p>
	<p>×！排除wenku.baidu.com/123，则只排除这一个目录。</p>
	<p>3、插件不会修改你已有nofollow属性的链接。</p>
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