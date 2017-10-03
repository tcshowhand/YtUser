<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu" style="display: block;">
        <a href="http://www.see-girl.com/zb_users/plugin/YtUser/main.php"><span class="m-left">基础配置</span></a>
        <a href="http://www.see-girl.com/zb_users/plugin/YtUser/record.php"><span class="m-left">购买记录</span></a>
</div>
  <div id="divMain2">

<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
    <th >订单号</th>
	<th >用户</th>
	<th >产品</th>
	<th >价格</th>
    <th >时间</th>
</tr>
<?php
$sql= $zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=', 'buy_State', 1)),null,null,null);
$array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
    echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td class="td15">'.$reg->OrderID.'</td>';
	$post=GetPost((int)$reg->LogID);
	echo '<td>'.$zbp->members[$reg->AuthorID]->StaticName.'</td>';
	echo '<td class="td20">'.$reg->Title.'</td>';
	echo '<td>'.$post->Metas->price.'</td>';
    echo '<td class="td20">'.date("Y-m-d H:i:s",$reg->PostTime).'</td>';
	echo '</tr>';
}
?>
</table>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/RegPage/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>