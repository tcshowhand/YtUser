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
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/archive.php"><span class="m-left m-now">Archive 存档</span></a>';

		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/coustom.php"><span class="m-left ">自定义Url</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/ping.php"><span class="m-left">Ping中心</span></a>';

?>
</div>

  <div id="divMain2">

<table style="width:95%" class="table_border table_border_cells table_stripes">
		<thead>
			<tr class="color1">
				<th align="left" colspan="2">Html Archive</th>
			</tr>
		</thead>
		<tbody>

      <tr class="color3">
				<td width="80%"><a href="<?php echo $zbp->host;?>zb_users/plugin/Nobird_Seo_Tools/Batch/nbseo_batch_main.php?module=nbararticle">批量重建全站Html Archive</a></td>
				<td>批量重建全站的html 存档地图静态化文件,存放于<?php echo $zbp->host.'archiver/';?></td>
			</tr>
					</tbody>
	</table>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>