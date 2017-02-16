<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='标题优化 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

$arraystructure=array(
'category'=>'分类首页标题结构',
'category_list'=>'分类列表页标题结构',
'tag'=>'Tag首页标题结构',
'tag_list'=>'Tag列表页标题结构',
'date'=>'日期首页标题结构',
'date_list'=>'日期列表页标题结构',
'author'=>'用户首页标题结构',
'author_list'=>'用户列表页标题结构');
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
  
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse = $_POST['BeautyTitle_IsUse'];//插件是否启用
	$zbp->Config('Nobird_BeautyTitle')->Use_DIY_article = $_POST['Use_DIY_article'];

	$zbp->Config('Nobird_BeautyTitle')->Title_Separator = $_POST['Title_Separator'];
	$zbp->Config('Nobird_BeautyTitle')->s_index = $_POST['s_index'];
	$zbp->Config('Nobird_BeautyTitle')->s_list = $_POST['s_list'];


foreach( $arraystructure as $k=>$v){
$key="s_".$k;
	$zbp->Config('Nobird_BeautyTitle')->$key = $_POST[$key];
}
	
	$zbp->Config('Nobird_BeautyTitle')->s_article = $_POST['s_article'];
	$zbp->Config('Nobird_BeautyTitle')->s_page = $_POST['s_page'];
	$zbp->Config('Nobird_BeautyTitle')->check = $_POST['check'];
	
	
	$zbp->SaveConfig('Nobird_BeautyTitle');
	$zbp->SetHint('good','参数已保存，重新编译模板后生效');
	Redirect('./beautytitle.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否开启重复标题检测功能？</b></p></td>
	<td><input type="text"  name="check" value="<?php echo $zbp->Config('Nobird_BeautyTitle')->check;?>" style="width:89%;" class="checkbox"/>仅在发布文章时有效。</td>


</td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否启用标题优化？</b></p></td>
	<td><input type="text"  name="BeautyTitle_IsUse" value="<?php echo $zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse;?>" style="width:89%;" class="checkbox"/>此开关可以选择是否启用，不启用此开关，本页面其他设置无效</td>
</td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否开启文章标题自定义标签 %nbname%</b></p></td>
	<td><input type="text"  name="Use_DIY_article" value="<?php echo $zbp->Config('Nobird_BeautyTitle')->Use_DIY_article;?>" style="width:89%;" class="checkbox"/>此开关可以选择是否启用(不启用此开关，文章页标题 %nbname% 标签失效)。</td>
</td>
</tr>
<tr>
	<td><p align='left'><b>设置标题分隔符</b></p></td>
	<td><input id='Title_Separator' name='Title_Separator' style='width:500px;' type='text' value='<?php echo htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->Title_Separator);?>'> 可以使用空格</td>
</tr>
<!-- s stand for structure -->
<tr>
	<td><p align='left'><b>首页标题结构</b></p></td>
	<td><input id='s_index' name='s_index' style='width:500px;' type='text' value='<?php echo htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->s_index);?>'> 可以使用空格</td>
</tr>
<tr>
	<td><p align='left'><b>列表页标题结构</b></p></td>
	<td><input id='s_list' name='s_list' style='width:500px;' type='text' value='<?php echo htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->s_list);?>'> 可以使用空格</td>
</tr>
<?php
foreach( $arraystructure as $k=>$v){
$key="s_".$k;
echo "<tr>
	<td><p align='left'><b>".$v."</b></p></td>
	<td><input id='".$key."' name='".$key."' style='width:500px;' type='text' value='".htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->$key)."'> 可以使用空格</td>
</tr>";
}
?>
<tr>
	<td><p align='left'><b>文章(article)标题结构</b></p></td>
	<td><input id='s_article' name='s_article' style='width:500px;' type='text' value='<?php echo htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->s_article);?>'> 可以使用空格</td>
</tr>
<tr>
	<td><p align='left'><b>页面(page)标题结构</b></p></td>
	<td><input id='s_page' name='s_page' style='width:500px;' type='text' value='<?php echo htmlspecialchars($zbp->Config('Nobird_BeautyTitle')->s_page);?>'> 可以使用空格</td>
</tr>



<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、设置好后，插件会自行替换模板标签，但不会修改模板</p>
	<p>2、确保模板中只有一组title标签，有些模板含有多个if判断的title标签，可能会出错---> 比如网页打不开、页面标题丢失变成只有网址。</p>
	<p>3、文章标题形式为  文章名 - 分类名 - 网站名，具体效果请启用后查看网页。</p>
	<p>4、分隔符可选：空格（ ）短线（-）和竖线（|）或者下划线（_）。</p>
	<p>5、插件设置的标题分隔符仅能控制除插件规范之外的页面标题，规范之内的标题请在内容里直接设置分隔符。</p>
	<p>6、%name%---网站标题，%subname%---网站副标题。</p>
	<p>7、%page%---第%page%页，%postname%---文章名。</p>
	<p>8、%catetagdate%---分类名/tag名/日期/author用户名(StaticName)。</p>
	<p>9、%nbname%，标题附加字段，默认仅在分类与tag页面有效(文章页生效需要开启开关)，可以在分类和tag编辑页面进行设置(文章在编辑文章时设置)。</p>
	<p>注：使用本功能，如果发现上述第二条内容的问题，将主题的title部分恢复成default主题一致即可。</p>
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