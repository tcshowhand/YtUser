<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
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
		<?php echo YtUser_SubMenu('base'); ?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">


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
	<td class="td30"><p align='left'><b>是否强制跳转User页面</b></p></td>
    <td><input type="text" class="checkbox" name="login_user" value="<?php echo $zbp->Config('YtUser')->login_user;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>登录验证码</b></p></td>
    <td><input type="text" class="checkbox" name="login_verifycode" value="<?php echo $zbp->Config('YtUser')->login_verifycode;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否关闭插件自带注册</b></p></td>
    <td><input type="text" class="checkbox" name="open_reg" value="<?php echo $zbp->Config('YtUser')->open_reg;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>开启插件自带注册 邮件是否必须</b></p></td>
    <td><input type="text" class="checkbox" name="regneedemail" value="<?php echo $zbp->Config('YtUser')->regneedemail;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>开启插件自带注册 同IP同天 是否只能注册一个ID</b></p></td>
    <td><input type="text" class="checkbox" name="regipdate" value="<?php echo $zbp->Config('YtUser')->regipdate;?>" /></td>
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



	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>