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
  $zbp->Config('YtUser')->inv_on = GetVars('inv_on','POST');
  $zbp->Config('YtUser')->inv_oneon = GetVars('inv_oneon','POST');		    	   	  
  $zbp->Config('YtUser')->inv_jifen = (int)GetVars('inv_jifen','POST');
  $zbp->Config('YtUser')->inv_zcjifen = (int)GetVars('inv_zcjifen','POST');
  $zbp->Config('YtUser')->inv_twoon = (int)GetVars('inv_twoon','POST');
  $zbp->Config('YtUser')->inv_twoonurl = GetVars('inv_twoonurl','POST');
  $zbp->Config('YtUser')->inv_shareshow = (int)GetVars('inv_shareshow','POST');
  $zbp->Config('YtUser')->inv_shareimgon = (int)GetVars('inv_shareimgon','POST');
  $zbp->Config('YtUser')->inv_shareimg = GetVars('inv_shareimg','POST');
  $zbp->SaveConfig("YtUser");
  $zbp->SetHint('good');
  Redirect('./invite.php');
}

if ($act === "inviterecharge") {
  CheckIsRefererValid();
	if(GetVars('resetd','POST')=='del'){
		YtUser_Code_Del(1,1);
	}
	if(GetVars('resetd','POST')=='Pricedeln'){
		YtUser_Code_Del(2,1);
	}
	if(GetVars('resetd','POST')=='Priceept'){
		YtUser_Code_Del(3,1);
	}
    if(GetVars('resetd','POST')=='generate'){
        $Number = $_POST['Number'];
		    $Price = $_POST['Price'];
        YtUser_Code_Create($Number,$Price,1);
	}
	if(GetVars('resetd','POST')=='xz1'){
		YtUser_xz1(3,1);
	}
	if(GetVars('resetd','POST')=='xz2'){
		YtUser_xz1(3,2);
	}
	$zbp->SetHint('good','操作成功');
	Redirect('./invite.php');
}

$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.config.php"></script>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo $zbp->host; ?>zb_users/plugin/YtUser/template/js/lib.upload.js"></script>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('invite'); ?>
  </div>
  <div id="divMain2">
  <form method="post" action="?act=save">
  <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
  <table border="1" class="tableFull tableBorder">
  <tr>
    <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
    <th>说明</th>
  </tr>
	<tr>
    <td><p align='left'><b>是否开启邀请注册</b></p></td>
    <td><input type="text" class="checkbox" name="inv_on" value="<?php echo $zbp->Config('YtUser')->inv_on;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>是否开启仅邀请链接可注册账户</b></p></td>
    <td><input type="text" class="checkbox" name="inv_oneon" value="<?php echo $zbp->Config('YtUser')->inv_oneon;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>是否开启仅支持邀请码注册</b></p></td>
    <td><input type="text" class="checkbox" name="inv_twoon" value="<?php echo $zbp->Config('YtUser')->inv_twoon;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>邀请码说明链接</b></p></td>
    <td><input type="text" class="text" name="inv_twoonurl" style="width:100%;" value="<?php echo $zbp->Config('YtUser')->inv_twoonurl;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>邀请好友送积分</b></p></td>
    <td><input type="text" name="inv_jifen" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->inv_jifen ? $zbp->Config('YtUser')->inv_jifen : 0 ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>注册送积分</b></p></td>
    <td><input type="text" name="inv_zcjifen" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->inv_zcjifen ? $zbp->Config('YtUser')->inv_zcjifen : 0 ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>是否开启会员分享文章功能</b></p></td>
    <td><input type="text" class="checkbox" name="inv_shareshow" value="<?php echo $zbp->Config('YtUser')->inv_shareshow;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>是否开启引导图</b></p></td>
    <td><input type="text" class="checkbox" name="inv_shareimgon" value="<?php echo $zbp->Config('YtUser')->inv_shareimgon;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>分享文章进入文章后的注册引导图</b></p></td>
    <td><input name="inv_shareimg" value="<?php echo $zbp->Config('YtUser')->inv_shareimg;?>" style="width:390px;">
	<input type="button" class="upimg-btn tx-submit-btn" value="点击上传"></td>
  </tr>
  <tr>
    <td><input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" /></td>
    <td></td>
  </tr>
  </table>
  </form>
  <form method="post" action="?act=inviterecharge">
			<input id="resetd" name="resetd" type="hidden" value="" />
      <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
			<table border="1" class="tableFull tableBorder">
				<tr>
					<th colspan="2" class="td30">
						<p align='center'><b>生成邀请码</b></p>
					</th>
				</tr>
				<tr>
					<td class="td30">
						<p align='center'><b>生成 </b>
							<input type="text" name="Number" style="width:50px;" value="10" /> 张送<input type="text" name="Price" style="width:50px;" value="0" />积分的邀请码
						</p>
					</td>
					<td>
						<input type="submit" class="button" onclick="$('#resetd').val('generate');" value="<?php echo $lang['msg']['submit'] ?>" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会删除已使用的邀请码，数据无法恢复，确定要这样做吗？')?$('#resetd').val('del'):false;" value="删除已使用" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会删除未使用的邀请码，数据无法恢复，确定要这样做吗？')?$('#resetd').val('Pricedeln'):false;" value="删除未使用" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会清空所有邀请码，数据无法恢复，确定要这样做吗？')?$('#resetd').val('Priceept'):false;" value="清空所有" />
            <input type="submit" class="button" onclick="$('#resetd').val('xz1');" value="下载已使用" />
			  		<input type="submit" class="button" onclick="$('#resetd').val('xz2');" value="下载未使用" />
					</td>
				</tr>
			</table>
		</form>

    <table border="1" class="tableFull tableBorder">
			<tr>
				<th class="td10"></th>
				<th>邀请码</th>
				<th>面值</th>
				<th>使用用户</th>
				<th>使用时间</th>
			</tr>
			<?php
			$sql = $zbp->db->sql->Select($zbp->table['ytuser_code'], '*', null, 'reg_ID desc', null, null);
			$array = $zbp->GetListCustom($zbp->table['ytuser_code'], $zbp->datainfo['ytuser_code'], $sql);
			foreach ($array as $key => $reg) {
				echo '<tr>';
				echo '<td class="td15">' . $reg->ID . '</td>';
				echo '<td>' . $reg->InviteCode . '</td>';
        echo '<td class="td20">' . $reg->Price . '</td>';
				echo '<td class="td20">' . ($reg->AuthorID == 0 ? '' : $zbp->GetMemberByID($reg->AuthorID)->Name) . '</td>';
				echo '<td class="td20">' . ($reg->UpTime == 0 ? '' : date('Y-m-d H:i:s', $reg->UpTime)) . '</td>';
				echo '</tr>';
			}
			?>
		</table>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';	 	  
RunTime();					
?>