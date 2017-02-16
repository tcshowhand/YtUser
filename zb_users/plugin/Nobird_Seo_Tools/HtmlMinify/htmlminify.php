<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='页面压缩设置 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
  
<?php
if(count($_POST)>0){

	$zbp->Config('Nobird_HtmlMinify')->IsUse = $_POST['IsUse'];;//插件是否启用
	$zbp->Config('Nobird_HtmlMinify')->compress_css = $_POST['compress_css'];; //是否压缩css
	$zbp->Config('Nobird_HtmlMinify')->info_comment = $_POST['info_comment'];; //是否通过注释信息显示压缩前后对比
	$zbp->Config('Nobird_HtmlMinify')->remove_comments = $_POST['remove_comments'];;//是否移除页面所有注释信息
	$zbp->Config('Nobird_HtmlMinify')->shorten_urls = $_POST['shorten_urls'];; //是否启用相对地址
	$zbp->SaveConfig('Nobird_HtmlMinify');
	$zbp->SetHint('good','参数已保存，刷新首页可以查看是否生效');
	Redirect('./htmlminify.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td><p align='left'><b>是否启用此功能</b></p></td>
	<td><input type="text"  name="IsUse" value="<?php echo $zbp->Config('Nobird_HtmlMinify')->IsUse;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>压缩css</b></p></td>
	<td><input type="text"  name="compress_css" value="<?php echo $zbp->Config('Nobird_HtmlMinify')->compress_css;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>显示压缩前后对比信息</b></p></td>
	<td><input type="text"  name="info_comment" value="<?php echo $zbp->Config('Nobird_HtmlMinify')->info_comment;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>移除html页面所有注释</b></p></td>
	<td><input type="text"  name="remove_comments" value="<?php echo $zbp->Config('Nobird_HtmlMinify')->remove_comments;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>启用短网址(相对地址)</b></p></td>
	<td><input type="text"  name="shorten_urls" value="<?php echo $zbp->Config('Nobird_HtmlMinify')->shorten_urls;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、默认压缩会删除页面所有的空格、换行等信息</p>
	<p>2、压缩css仅针对页面直接写的css内容有效，引用css部分无效。</p>
	<p>3、短网址(相对地址)默认不开启，请自行斟酌。</p>
	<p>4、对于不想让插件压缩部分的内容，请在内容的首尾加上"<?php echo htmlspecialchars('<!--Nobird_Seo_Tools Break-->');?>" (不含引号)。</p>
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