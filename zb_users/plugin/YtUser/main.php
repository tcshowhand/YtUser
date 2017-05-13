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
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">二次开发教程</span></a>
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
	<td class="td30"><p align='left'><b>QQ互联APPID</b></p></td>
	<td><input type="text" name="appid" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appid);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联APPKey</b></p></td>
	<td><input type="text" name="appkey" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appkey);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联回调地址</b></p></td>
	<td><?php echo $zbp->host?>zb_users/plugin/YtUser/login.php</td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>会员升级相关说明文字</b></p></td>
	<td><textarea name="readme_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->readme_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>充值卡相关说明文字</b></p></td>
	<td><textarea name="integral_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->integral_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>Vip折扣</b></p></td>
	<td><input type="text" name="vipdis" style="width:50px;" value="<?php echo (int)htmlspecialchars($zbp->Config('YtUser')->vipdis);?>" style="width:89%;" />%</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>支付方式</b></p></td>
	<td>
	    <?php echo YtUser_payment_radio((int)htmlspecialchars($zbp->Config('YtUser')->payment))?>
	</td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
  	<?php
	}
    if ($act == 'guide'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=base">  
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>页面</b><br><span class='note'></span></p></th>
	<th>链接
	</th>
</tr>
<tr>
	<td class="td30"><p align='left'><b>登录页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Login' ?>" target="_blank"><?php echo $zbp->host.'?Login' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>注册页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Register' ?>" target="_blank"><?php echo $zbp->host.'?Register' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>投稿列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Articlelist' ?>" target="_blank"><?php echo $zbp->host.'?Articlelist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>发布投稿</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Articleedt' ?>" target="_blank"><?php echo $zbp->host.'?Articleedt' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>积分充值</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Integral' ?>" target="_blank"><?php echo $zbp->host.'?Integral' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>支付状态</b></p></td>
	<td><a href="<?php echo $zbp->host.'?buy' ?>" target="_blank"><?php echo $zbp->host.'?buy' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>VIP卡充值</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Upgrade' ?>" target="_blank"><?php echo $zbp->host.'?Upgrade' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>购买列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Paylist' ?>" target="_blank"><?php echo $zbp->host.'?Paylist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>用户中心</b></p></td>
	<td><a href="<?php echo $zbp->host.'?User' ?>" target="_blank"><?php echo $zbp->host.'?User' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>评论列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Commentlist' ?>" target="_blank"><?php echo $zbp->host.'?Commentlist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>密码找回页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Resetpwd' ?>" target="_blank"><?php echo $zbp->host.'?Resetpwd' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>密码重置页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Resetpassword' ?>" target="_blank"><?php echo $zbp->host.'?Resetpassword' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>修改账户名</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Nameedit' ?>" target="_blank"><?php echo $zbp->host.'?Nameedit' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>绑定QQ</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Binding' ?>" target="_blank"><?php echo $zbp->host.'?Binding' ?></a></td>
</tr>
</table>
</form>
  	<?php
	}
	if ($act == 'upgrade'){
	?>

<form enctype="multipart/form-data" method="post" action="save.php?type=upgrade">  
<input id="reset" name="reset" type="hidden" value="add" />
<table border="1" class="tableFull tableBorder">
    <tr>
	    <th class="td30"><p align='left'><b>生成VIP卡</b><br><span class='note'></span></p></th>
	    <th>
	    </th>
    </tr>
    <tr>
	    <td class="td30"><p align='left'><b>生成</b><input type="text" name="Number" style="width:50px;" value="10" />张<input type="text" name="Price" style="width:50px;" value="30" />天vip卡</p></td>
	    <td>
            <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
            <input type="submit" class="button" onclick="$('#reset').val('del');" value="删除已使用过的VIP卡" />
		    <input type="submit" class="button" onclick="$('#reset').val('ept');" value="清空所有VIP卡" />
        </td>
    </tr>
</table>
</form>
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
	<th >VIP卡</th>
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
	echo '<td class="td20">'.$reg->Level.'</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>
  	<?php
	}
	if ($act == 'recharge'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=recharge">  
<input id="reset" name="reset" type="hidden" value="generate" />
<table border="1" class="tableFull tableBorder">
    <tr>
	    <th class="td30"><p align='left'><b>生成积分卡</b><br><span class='note'></span></p></th>
	    <th>
	    </th>
    </tr>
    <tr>
	    <td class="td30"><p align='left'><b>生成</b><input type="text" name="Number" style="width:50px;" value="10" />张<input type="text" name="Price" style="width:50px;" value="100" />积分充值卡</p></td>
	    <td>
            <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
            <input type="submit" class="button" onclick="$('#reset').val('Pricedel');" value="删除已使用过的充值卡" />
            <input type="submit" class="button" onclick="$('#reset').val('Priceept');" value="清空所有充值卡" />
        </td>
    </tr>
</table>
</form>
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
	echo '<td>'.$zbp->members[$reg->AuthorID]->StaticName.'</td>';
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
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>