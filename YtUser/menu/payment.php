<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$act = GetVars("act", "GET");
if ($act === "save") {
  CheckIsRefererValid();
  $zbp->Config('YtUser')->payment = (int)(GetVars('payment','POST'));
  $zbp->Config('YtUser')->paywx = (int)(GetVars('paywx','POST'));
  $zbp->Config('YtUser')->brand = GetVars('brand','POST');
  $zbp->Config('YtUser')->pricetemp1 = (int)(GetVars('pricetemp1','POST'));
  $zbp->Config('YtUser')->pricetemp2 = (int)(GetVars('pricetemp2','POST'));
  $zbp->Config('YtUser')->pricetemp3 = (int)(GetVars('pricetemp3','POST'));
  $zbp->Config('YtUser')->pricetemp4 = (int)(GetVars('pricetemp4','POST'));
  $zbp->Config('YtUser')->pricetemp5 = (int)(GetVars('pricetemp5','POST'));
  $zbp->Config('YtUser')->pricetemp6 = (int)(GetVars('pricetemp6','POST'));
  $zbp->Config('YtUser')->pricetemp7 = (int)(GetVars('pricetemp7','POST'));
  $zbp->Config('YtUser')->apipayment = (int)(GetVars('apipayment','POST'));
  $zbp->Config('YtUser')->apiuid = (int)(GetVars('apiuid','POST'));
  $zbp->Config('YtUser')->apikey = GetVars('apikey','POST');
  $zbp->Config('YtUser')->apisecret = GetVars('apisecret','POST');
  if($zbp->Config('YtUser')->apipayment==1){
	  $zbp->Config('YtUser')->payment=1;
  }
  $zbp->SaveConfig("YtUser");
  $zbp->SetHint('good');
  Redirect('./payment.php');
}

$blogtitle = '用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle; ?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('payment'); ?>
	</div>
	<div id="divMain2">
		<form enctype="multipart/form-data" method="post" action="?act=save">
		<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
			<table border="1" class="tableFull tableBorder">
				<tr>
					<th>
						<p align='left'><b>选项</b><br><span class='note'></span></p>
					</th>
					<th>请先安装并启动 - 《豫唐支付组件》
					</th>
				</tr>
				<tr>
					<td>
						<p align='left'><b>是否开启支付宝</b></p>
					</td>
					<td><input type="text" class="checkbox" name="payment" value="<?php echo $zbp->Config('YtUser')->payment; ?>" /></td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>是否开启微信支付</b></p>
					</td>
					<td><input type="text" class="checkbox" name="paywx" value="<?php echo $zbp->Config('YtUser')->paywx; ?>" /></td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>品牌名</b></p>
					</td>
					<td><input type="text" name="brand" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->brand; ?>" style="width:89%;" /></td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>VIP一个月</b></p>
					</td>
					<td><input type="text" name="pricetemp1" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp1; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>VIP三个月</b></p>
					</td>
					<td><input type="text" name="pricetemp2" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp2; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>VIP一年</b></p>
					</td>
					<td><input type="text" name="pricetemp3" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp3; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>终生会员</b></p>
					</td>
					<td><input type="text" name="pricetemp4" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp4; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>100积分</b></p>
					</td>
					<td><input type="text" name="pricetemp5" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp5; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>200积分</b></p>
					</td>
					<td><input type="text" name="pricetemp6" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp6; ?>" style="width:89%;" />元</td>
				</tr>
				<tr>
					<td>
						<p align='left'><b>300积分</b></p>
					</td>
					<td><input type="text" name="pricetemp7" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->pricetemp7; ?>" style="width:89%;" />元</td>
				</tr>
			</table>
			<hr />
			<p>
				<input type="submit" class="button" value="<?php echo $lang['msg']['submit'] ?>" />
			</p>
		</form>

		<script type="text/javascript">
			ActiveLeftMenu("aPluginMng");
		</script>
		<script type="text/javascript">
			AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png'; ?>");
		</script>
	</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>