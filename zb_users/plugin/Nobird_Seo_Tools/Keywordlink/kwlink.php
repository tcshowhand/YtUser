<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='关键词链接';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>

  <div id="divMain2">
<!--代码-->
<?php
Nobird_Keywordlink_Install();
if(count($_POST)>0){
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags = $_POST['Keywordlink_UseTags'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCoustomKeys = $_POST['Keywordlink_UseCoustomKeys'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Times = $_POST['Keywordlink_Times'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Num = $_POST['Keywordlink_Num'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME = $_POST['Keywordlink_CLASSNAME'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCSS = $_POST['Keywordlink_UseCSS'];
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_LinkColor = $_POST['Keywordlink_LinkColor'];
	$zbp->Config('Nobird_Keywordlink')->protect_pre = $_POST['protect_pre'];
	$zbp->Config('Nobird_Keywordlink')->protect_script = $_POST['protect_script'];
	$zbp->Config('Nobird_Keywordlink')->protect_vars = $_POST['protect_vars'];
	$zbp->SaveConfig('Nobird_Keywordlink');
	$zbp->SetHint('good','参数已保存，刷新首页可以查看是否生效');
	Redirect('./kwlink.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">

<tr>
	<td><p align='left'><b>开启Tag标签替换功能</b></p></td>
	<td><input type="text"  name="Keywordlink_UseTags" value="<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>

<tr>
	<td><p align='left'><b>开启自定义关键词替换功能</b></p></td>
	<td><input type="text"  name="Keywordlink_UseCoustomKeys" value="<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCoustomKeys;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>
<tr>
	<td><p align='left'><b>单个关键词在某一篇文章内被替换次数</b></p></td>
	<td><input id='Keywordlink_Times' name='Keywordlink_Times' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_Times;?>'></td>
</tr>
<tr>
	<td><p align='left'><b>替换前多少个Tag(按使用次数排序)</b></p></td>
	<td><input id='Keywordlink_Num' name='Keywordlink_Num' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_Num;?>'></td>
</tr>
<tr>
	<td><p align='left'><b>替换成为a链接后的类名</b></p></td>
	<td><input id='Keywordlink_CLASSNAME' name='Keywordlink_CLASSNAME' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME;?>'></td>
</tr>

<tr>
	<td><p align='left'><b>载入自定义CSS样式</b></p></td>
	<td><input type="text"  name="Keywordlink_UseCSS" value="<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_UseCSS;?>" style="width:89%;" class="checkbox"/><b></b></td>
</tr>

<tr>
	<td><p align='left'><b>链接颜色(载入自定义CSS样式开启后有效)</b></p></td>
	<td><input id='Keywordlink_LinkColor' name='Keywordlink_LinkColor'  type='color' value='<?php echo $zbp->Config('Nobird_Keywordlink')->Keywordlink_LinkColor;?>'></td>
</tr>
<tr>
	<td><p align='left'><b>保护pre标签(开启后，代码高亮区域内的内容不会被替换，如果不需要代码高亮功能，可以关闭此项，可以提速)</b></p></td>
	<td><input type="text"  name="protect_pre" value="<?php echo $zbp->Config('Nobird_Keywordlink')->protect_pre;?>" style="width:89%;" class="checkbox"/><b></b></td>
<tr>
<tr>
	<td><p align='left'><b>保护script标签(开启后，文章内的脚本标签不会被替换，如果文章内容没有脚本代码，可以关闭此项，可以提速)</b></p></td>
	<td><input type="text"  name="protect_script" value="<?php echo $zbp->Config('Nobird_Keywordlink')->protect_script;?>" style="width:89%;" class="checkbox"/><b></b></td>
<tr>
<tr>
	<td><p align='left'><b>保护普通html标签(开启后，基本上可以保证严格的html不会错位，推荐开启)</b></p></td>
	<td><input type="text"  name="protect_vars" value="<?php echo $zbp->Config('Nobird_Keywordlink')->protect_vars;?>" style="width:89%;" class="checkbox"/><b></b></td>
<tr>
</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>
<?php
		$str = '<form action="save.php?type=add" method="post">
				<table width="100%" border="1" class="tableBorder">
				<tr>
					<th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
					<th scope="col" width="25%">自定义关键词</th>
					<th scope="col" width="50%">链接(自己设置的关键字的优先级会比标签的优先级更高)</th>
					<th scope="col" width="10%">替换</th>
					<th scope="col" width="10%">操作</th>
				</tr>';
		$str .= '<tr>';
		$str .= '<td align="center">0</td>';
		$str .= '<td><input type="text" class="sedit" name="title" value=""></td>';
		$str .= '<td><input type="text" style="width:500px;"  class="sedit" name="url" value=""></td>';
		$str .= '<td><input type="text" class="checkbox" name="IsUsed" value="1" /></td>';
		$str .= '<td><input type="hidden" name="editid" value="">
						<input name="add" type="submit" class="button" value="增加"/></td>';
		$str .= '</tr>';
		$str .= '</form>';
		$where = array(array('=','KeyWord_Type','0'));
		$order = array('KeyWord_IsUsed'=>'DESC','KeyWord_Order'=>'ASC');
		$sql= $zbp->db->sql->Select($zbp->table['Nobird_Keywords_table'],'*',$where,$order,null,null);
		$array=$zbp->GetListType('nobird_seo_tools_keyword',$sql);
		$i =1;
		foreach ($array as $key => $reg) {
			$str .= '<form action="save.php?type=add" method="post" name="keyword">';
			$str .= '<tr>';
			$str .= '<td align="center">'.$i.'</td>';
			$str .= '<td><input type="text" class="sedit" name="title" value="'.$reg->Title.'" ></td>';
			$str .= '<td><input type="text" style="width:500px;"  class="sedit" name="url" value="'.$reg->Url.'" ></td>';
			$str .= '<td><input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></td>';
			$str .= '<td nowrap="nowrap">
						<input type="hidden" name="editid" value="'.$reg->ID.'">
						<input name="edit" type="submit" class="button" value="修改"/>
						<input name="del" type="button" class="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=del&id='.$reg->ID.'\'}"/>
					</td>';
			$str .= '</tr>';
			$str .= '</form>';
			$i++;
		}
		$str .='</table>';
		echo $str;
?>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	

  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>