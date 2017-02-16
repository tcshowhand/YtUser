<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Tctitleseo')) {$zbp->ShowError(48);die();}

$blogtitle='关键词与描述';

if(count($_POST)>0){
	$zbp->Config('Tctitleseo')->title_keywords=$_POST['title_keywords'];
	$zbp->Config('Tctitleseo')->title_description=$_POST['title_description'];
	$zbp->Config('Tctitleseo')->title_change=$_POST['title_change'];
	$zbp->Config('Tctitleseo')->title_picalt=$_POST['title_picalt'];	
	$zbp->SaveConfig('Tctitleseo');
	$zbp->SetHint('good');
	Redirect('./main.php');
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"></div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>文章标题前置</b></p></td>
	<td><input type="text"  name="title_change" value="<?php echo $zbp->Config('Tctitleseo')->title_change;?>" style="width:89%;" class="checkbox"/></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>关键词</b></p></td>
	<td><input type="text"  name="title_keywords" value="<?php echo $zbp->Config('Tctitleseo')->title_keywords;?>" style="width:89%;"/></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>描述</b></p></td>
	<td><input type="text" name="title_description" value="<?php echo htmlspecialchars($zbp->Config('Tctitleseo')->title_description);?>" style="width:89%;" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>开启图片alt优化</b></p></td>
	<td><input type="text"  name="title_picalt" value="<?php echo $zbp->Config('Tctitleseo')->title_picalt;?>" style="width:89%;" class="checkbox"/> 如果你当前的主题或插件有对图片特效处理，请勿开启此功能</td>
</tr>

</table>
使用说明：<br>
0、分类页和标签页的描述在相应配置的“摘要”里面填写。<br>
1、发现任何问题可以留言给作者，请勿给差评。<br>
2、请认真阅读第一条。<br>
3、请再次阅读第一条。<br>
<br>
功能：<br>
1、可在后台设置网站的关键词和描述。<br>
2、可在后台设置文章页的关键词和描述。<br>
3、可在后台设置分类页的关键词和描述。<br>
3、可自定义首图。调用标签为{$related.Metas.tccptu}。<br>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />

	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Tctitleseo/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>