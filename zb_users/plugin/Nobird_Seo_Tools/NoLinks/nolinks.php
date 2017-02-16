<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='灭外链 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php 
	$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
	echo '<a href="'. $zbp->host .'zb_system/admin/?act=CommentMng"><span class="m-left">系统评论管理</span></a>';
		echo '<a href="'. $zbp->host .'zb_users/plugin/Nobird_Seo_Tools/CommentMng/commentmng.php"><span class="m-left ' . ($filename=='commentmng.php'?'m-now':'') . '">评论SEO管理</span></a>';
	echo '<a href="'. $zbp->host .'zb_system/admin/?act=CommentMng&ischecking=1"><span class="m-left">审核评论</span></a>';
		echo '<a href="'. $zbp->host .'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/NoLinks/nolinks.php"><span class="m-right ' . ($filename=='nolinks.php'?'m-now':'') . '">灭外链</span></a>';

?></div>

  <div id="divMain2">
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_NoLinks')->NoLinkskey = $_POST['NoLinkskey'];
	$zbp->Config('Nobird_NoLinks')->Use_NoLinks = $_POST['Use_NoLinks'];
	$zbp->SaveConfig('Nobird_NoLinks');
	$zbp->SetHint('good','参数已保存');
	Redirect('./nolinks.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否启用灭外链？</b></p></td>
	<td><input type="text"  name="Use_NoLinks" value="<?php echo $zbp->Config('Nobird_NoLinks')->Use_NoLinks;?>" style="width:89%;" class="checkbox"/>此开关可以选择是否启用，不启用此开关，本页面其他设置无效</td>
</td>
</tr>
<tr>
	<td><p align='left'><b>设置密钥</b></p></td>
	<td><input id='NoLinkskey' name='NoLinkskey' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_NoLinks')->NoLinkskey;?>'> </td>
</tr>
<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、这里只是一个简单的说明页面。</p>
	<p>2、插件没有修改数据库，只是修改了链接输出内容。</p>
	<p>3、链接预先加密输出，用户打开的时候再解密跳转。</p>
	<p>4、无需nofollow也会让你的页面权重不流失。</p>
	<p>5、设置一个密钥，其他人不知道你的密钥时，无法通过urlredirect.php进行跳转。密钥格式随意，设置后去页面点击试一下，能正常跳转即可。</p>
	</td>
</tr>
</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>

	<script type="text/javascript">ActiveLeftMenu("aCommentMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>