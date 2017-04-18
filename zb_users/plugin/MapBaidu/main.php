<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MapBaidu')) {$zbp->ShowError(48);die();}
$blogtitle='地图设置';
if(count($_POST)>0){
	$zbp->Config('MapBaidu')->title=$_POST['title'];
	$zbp->Config('MapBaidu')->content=$_POST['content'];
	$zbp->Config('MapBaidu')->poi=$_POST['poi'];
	$zbp->SaveConfig('MapBaidu');
	$zbp->SetHint('good');
	Redirect('./main.php');
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php MapBaidu_SubMenu();?></div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>title</b></p></td>
	<td><input type="text"  name="title" value="<?php echo $zbp->Config('MapBaidu')->title;?>" style="width:89%;"/></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>content</b></p></td>
	<td><input type="text" name="content" value="<?php echo htmlspecialchars($zbp->Config('MapBaidu')->content);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>poi</b></p></td>
	<td><input type="text"  name="poi" value="<?php echo $zbp->Config('MapBaidu')->poi;?>" style="width:89%;"/></td>
</tr>

</table>
使用说明：<br>
1、在需要的地方调用{$mapbaidu}<br>
<br>
功能：<br>
1、poi获取地址：<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank"><span>http://api.map.baidu.com/lbsapi/getpoint/index.html</span></a><br>
	  <hr/>
	  <p>
	<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MapBaidu/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>