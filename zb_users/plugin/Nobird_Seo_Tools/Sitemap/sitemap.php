<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='Sitemap - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
<div class="SubMenu">
<?php 
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/sitemap_large.php"><span class="m-left">Sitemap索引</span></a>';
}
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/archive.php"><span class="m-left">Archive 存档</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/coustom.php"><span class="m-left">自定义Url</span></a>';


?>
</div>
  <div id="divMain2">
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_Sitemap')->Use_SitemapPost = $_POST['Use_SitemapPost'];
	$zbp->Config('Nobird_Sitemap')->SitemapPostKey = $_POST['SitemapPostKey'];
	$zbp->Config('Nobird_Sitemap')->IndexPercent = $_POST['IndexPercent'];
	$zbp->Config('Nobird_Sitemap')->CategoryPercent = $_POST['CategoryPercent'];
	$zbp->Config('Nobird_Sitemap')->TagPercent = $_POST['TagPercent'];
	$zbp->Config('Nobird_Sitemap')->ArticlePercent = $_POST['ArticlePercent'];
	$zbp->Config('Nobird_Sitemap')->PagePercent = $_POST['PagePercent'];
	$zbp->Config('Nobird_Sitemap')->Use_BigData = $_POST['Use_BigData'];
	$zbp->Config('Nobird_Sitemap')->Use_Baidu_JS = $_POST['Use_Baidu_JS'];
	$zbp->Config('Nobird_Sitemap')->BigDataPer = $_POST['BigDataPer'];

	$zbp->SaveConfig('Nobird_Sitemap');
	$zbp->SetHint('good','参数已保存');
	Redirect('./sitemap.php');
}
if(!$zbp->Config('Nobird_Sitemap')->IndexPercent){
	$zbp->Config('Nobird_Sitemap')->IndexPercent = '1';
	$zbp->Config('Nobird_Sitemap')->CategoryPercent = '0.8';
	$zbp->Config('Nobird_Sitemap')->TagPercent = '0.8';
	$zbp->Config('Nobird_Sitemap')->ArticlePercent = '0.5';
	$zbp->Config('Nobird_Sitemap')->PagePercent = '0.6';
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否使用Sitemap索引功能？</b></p></td>
	<td><input type="text"  name="Use_BigData" value="<?php echo $zbp->Config('Nobird_Sitemap')->Use_BigData;?>" style="width:89%;" class="checkbox"/> <br />
	[推荐虚拟主机1000篇以上文章用户选择，云主机或VPS视自身主机情况选择<b>文章数量少于1000篇，请勿开启！</b>]</td>
</td>
<tr>
	<td class="td30"><p align='left'><b>Sitemap索引中，单个sitemap文件最大Url数量设置：</b></p></td>
		<td><input id='BigDataPer' name='BigDataPer' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->BigDataPer;?>'> <br />
		[数量默认1000，数量越大对主机要求越高，但是生成速度快，分割的文件个数少]
		</td>

</td>	
<tr>
	<td class="td30" colspan="2"><p align='left' style="color:#3399CC"><b>实时推送设置：</b></p></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否启用百度站长工具实时推送？</b></p></td>
	<td><input type="text"  name="Use_SitemapPost" value="<?php echo $zbp->Config('Nobird_Sitemap')->Use_SitemapPost;?>" style="width:89%;" class="checkbox"/>[需要在百度站长工具中有实时推送的权限]</td>
</td>
</tr>
<tr>
	<td><p align='left'><b>设置接口调用地址</b></p></td>
	<td><input id='SitemapPostKey' name='SitemapPostKey' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->SitemapPostKey;?>'> </td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否启用百度站长工具自动推送JS？</b></p></td>
	<td><input type="text"  name="Use_Baidu_JS" value="<?php echo $zbp->Config('Nobird_Sitemap')->Use_Baidu_JS;?>" style="width:89%;" class="checkbox"/></td>
</td>
</tr>
<tr>
	<td class="td30" colspan="2"><p align='left' style="color:#3399CC"><b>sitemap文件设置：权重1即为100%，以此类推。</b></p></td>
</tr>
<tr>
	<td><p align='left'><b>首页权重</b></p></td>
	<td><input id='IndexPercent' name='IndexPercent' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->IndexPercent;?>'> </td>
</tr>
<tr>
	<td><p align='left'><b>分类页权重</b></p></td>
	<td><input id='CategoryPercent' name='CategoryPercent' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->CategoryPercent;?>'> </td>
</tr>
<tr>
	<td><p align='left'><b>标签页权重</b></p></td>
	<td><input id='TagPercent' name='TagPercent' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->TagPercent;?>'> </td>
</tr>
<tr>
	<td><p align='left'><b>文章页权重</b></p></td>
	<td><input id='ArticlePercent' name='ArticlePercent' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->ArticlePercent;?>'> </td>
</tr>
<tr>
	<td><p align='left'><b>独立页面权重</b></p></td>
	<td><input id='PagePercent' name='PagePercent' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Sitemap')->PagePercent;?>'> </td>
</tr>
<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、请到zhanzhang.baidu.com/linksubmit/察看自己的接口调用地址。</p>
	<p>2、确保主机有访问外部网络权限，否则可能会出错。</p>
	<p>3、确保网站有主动推送(实时)权限再开启实时推送功能。</p>

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