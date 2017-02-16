<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='Sitemap - 添加自定义Url';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_system/script/jquery-ui-timepicker-addon.js"></script>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
<div class="SubMenu">
<?php 
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/sitemap_large.php"><span class="m-left">Sitemap索引</span></a>';
}
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/archive.php"><span class="m-left">Archive 存档</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/coustom.php"><span class="m-left  m-now">自定义Url</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/ping.php"><span class="m-left">Ping中心</span></a>';


?>
</div>

  <div id="divMain2">
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_Sitemap')->UseCoustom = $_POST['UseCoustom'];
	$zbp->SaveConfig('Nobird_Sitemap');
	$zbp->SetHint('good','参数已保存');
	Redirect('./coustom.php');
}

		$s=$zbp->db->sql->CreateTable($zbp->table['nobird_seo_tools_sitemap_coustom'],$zbp->datainfo['nobird_seo_tools_sitemap_coustom']);
		$zbp->db->QueryMulit($s);

?>
<form method="post">

	<table border="1" class="tableFull tableBorder">
		<thead>
			<tr class="color1">
				<th>设置</th>
				<th>内容</th>
			</tr>
		</thead>
		<tbody>

<tr>    
<td colspan="2"><b style="color:red">注意：
<br />
1、自定义Url仅在开启Sitemap索引模式下有效；<br />
2、仅会增加到sitemap中，不会增加到archive存档中；<br />
3、为提升发文章速度，仅在批量刷新时更新！</b></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否启用自定义链接功能？</b></p></td>
	<td><input type="text"  name="UseCoustom" value="<?php echo $zbp->Config('Nobird_Sitemap')->UseCoustom;?>" style="width:89%;" class="checkbox"/>开启后允许用户自定义链接，并且提供接口函数供第三方插件使用。</td>

</tr>
					</tbody>

</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>


<?php
		$str = '<form action="save.php?type=add" method="post">
	<table border="1" class="tableFull tableBorder">
	<thead>
				<tr>
					<th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
					<th scope="col" width="25%">描述</th>
					<th scope="col" width="50%">链接</th>
					<th scope="col" width="5%">最后修改时间</th>
					<th scope="col" width="5%">更新频率</th>
					<th scope="col" width="5%">权重</th>
					<th scope="col" width="10%">操作</th>
				</tr></thead>';
		$str .= '<tr>';
		$str .= '<td align="center">0</td>';
		$str .= '<td><input type="text" class="sedit" name="Title" value="'.$zbp->name.'"></td>';
		$str .= '<td><input type="text"  class="sedit" name="Url" value="'.$zbp->host.'"></td>';
		$str .= '<td><input type="text" class="edtDateTime" name="Lastmod" value="'.date('Y-m-d H:i:s',time()).'"></td>';
		$str .= '<td><select name="Changefreq">
                      <option value ="always">always</option>
                      <option value ="hourly">hourly</option>
                      <option value ="daily">daily</option>
                      <option value ="weekly">weekly</option>
                      <option value="monthly">monthly</option>
                      <option value="yearly">yearly</option>
                    </select></td>';
		$str .= '<td><input type="text"  class="sedit" name="Priority" value="0.8"></td>';
		$str .= '<td><input type="hidden" name="editid" value="">
						<input name="add" type="submit" class="button" value="增加"/></td>';
		$str .= '</tr>';
		$str .= '</form>';
		$where = array();
		$order = array('Sitemap_ID'=>'DESC');
		$sql= $zbp->db->sql->Select($zbp->table['nobird_seo_tools_sitemap_coustom'],'*',$where,$order,null,null);
		$array=$zbp->GetListType('nobird_seo_tools_sitemap_coustom',$sql);
		$i =1;
		foreach ($array as $key => $reg) {
			$str .= '<form action="save.php?type=add" method="post" name="keyword">';
			$str .= '<tr>';
			$str .= '<td align="center">'.$i.'</td>';
			$str .= '<td><input type="text" class="sedit" name="Title" value="'.$reg->Title.'" ></td>';
			$str .= '<td><input type="text"  class="sedit" name="Url" value="'.$reg->Url.'" ></td>';
			$str .= '<td><input type="text"   class="edtDateTime"  name="Lastmod" value="'.date('Y-m-d H:i:s',$reg->Lastmod).'" ></td>';
			$str .= '<td>
			<select name="Changefreq">
                      <option '.($reg->Changefreq=='always'?'selected="selected"':'').' value ="always">always</option>
                      <option '.($reg->Changefreq=='hourly'?'selected="selected"':'').' value ="hourly">hourly</option>
                      <option '.($reg->Changefreq=='daily'?'selected="selected"':'').' value ="daily">daily</option>
                      <option '.($reg->Changefreq=='weekly'?'selected="selected"':'').' value ="weekly">weekly</option>
                      <option '.($reg->Changefreq=='monthly'?'selected="selected"':'').' value="monthly">monthly</option>
                      <option '.($reg->Changefreq=='yearly'?'selected="selected"':'').' value="yearly">yearly</option>
                    </select></td>';
			$str .= '<td><input type="text"  class="sedit" name="Priority" value="'.$reg->Priority.'" ></td>';
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

<script>


//日期时间控件
$.datepicker.regional['zh-CN'] = {
  closeText: '完成',
  prevText: '上个月',
  nextText: '下个月',
  currentText: '现在',
  monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
  monthNamesShort: ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'],
  dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
  dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
  dayNamesMin: ['日','一','二','三','四','五','六'],
  weekHeader: '周',
  dateFormat: 'yy-mm-dd',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: true,
  yearSuffix: ' 年  '
};
$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
$.timepicker.regional['zh-CN'] = {
  timeOnlyTitle: '时间',
  timeText: '时间',
  hourText: '小时',
  minuteText: '分钟',
  secondText: '秒钟',
  millisecText: '毫秒',
  currentText: '现在',
  closeText: '完成',
  timeFormat: 'HH:mm:ss',
  ampm: false
};
$.timepicker.setDefaults($.timepicker.regional['zh-CN']);
$('.edtDateTime').datetimepicker({
  showSecond: true
  //changeMonth: true,
  //changeYear: true
});
</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>