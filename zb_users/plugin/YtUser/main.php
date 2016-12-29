<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if (isset($_GET['act'])){$act = $_GET['act'];}else{$act = 'base';}

$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php YtUser_SubMenu($act);?>
		<a href="http://www.ytecn.com/" target="_blank"><span class="m-left" style="color:#F00">帮助</span></a>
    </div>
  <div id="divMain2">

  	<?php
	if ($act == 'base'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=base">  
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	<th>
	</th>
</tr>
<tr>
	<td class="td30"><p align='left'><b>多说二级域名</b></p></td>
	<td><input type="text" name="dsurl" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->dsurl);?>" style="width:89%;" /> 例如"ytecn.duoshuo.com"，只需要输入“ytecn”</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>会员升级相关说明文字</b></p></td>
	<td><textarea name="readme_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->readme_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>充值卡相关说明文字</b></p></td>
	<td><textarea name="integral_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->integral_text);?></textarea></td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
  	<?php
	}
	if ($act == 'upgrade'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=upgrade"> 
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
	<th >VIP月卡</th>
	<th >增长天数</th>
	<th >使用用户</th>
</tr>
<?php
$sql= $zbp->db->sql->Select($tyactivate_Table,'*',null,null,null,null);
$array=$zbp->GetListCustom($tyactivate_Table,$tyactivate_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
	echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td>'.$reg->InviteCode.'</td>';
	echo '<td class="td20">30天</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" onclick="$('#reset').val('add');" value="生成10个VIP月卡" />
		<input type="submit" class="button" onclick="$('#reset').val('del');" value="删除已使用过的VIP月卡" />
		<input type="submit" class="button" onclick="$('#reset').val('ept');" value="清空所有VIP月卡" />
	  </p>
</form>
  	<?php
	}
	if ($act == 'recharge'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=recharge"> 
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
	<th >充值卡</th>
	<th >面值</th>
	<th >使用用户</th>
</tr>
<?php
$sql= $zbp->db->sql->Select($typrepaid_Table,'*',null,null,null,null);
$array=$zbp->GetListCustom($typrepaid_Table,$typrepaid_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
	echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td>'.$reg->InviteCode.'</td>';
	echo '<td class="td20">'.$reg->Price.'</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>

	  <hr/>
	  <p>
		<input type="submit" class="button" onclick="$('#reset').val('Priceadd');" value="生成10张100元充值卡" />

		<input type="submit" class="button" onclick="$('#reset').val('Pricedel');" value="删除已使用过的充值卡" />
		
		<input type="submit" class="button" onclick="$('#reset').val('Priceept');" value="清空所有充值卡" />
	  </p>

	</form>
  	<?php
	}
	if ($act == 'buy'){
	?>
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
	echo '<td>'.$zbp->members[$reg->AuthorID]->Name.'</td>';
	echo '<td class="td20">'.$reg->Title.'</td>';
	echo '<td>'.$post->Metas->price.'</td>';
    echo '<td class="td20">'.date("Y-m-d H:i:s",$reg->PostTime).'</td>';
	echo '</tr>';
}
?>
</table>

	<?php
	}
	if ($act == 'testing'){
	?>
	<form enctype="multipart/form-data" method="post" action="save.php?type=testing"> 
	  <p>
		<input type="submit" class="button" value="一键修复插件表" />
	  </p>
	</form>
	<?php
	}
	?>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/RegPage/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>