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
  $zbp->Config('YtUser')->appid = GetVars('appid','POST');
  $zbp->Config('YtUser')->appkey = GetVars('appkey','POST');
  $zbp->Config('YtUser')->readme_text = GetVars('readme_text','POST');
  $zbp->Config('YtUser')->integral_text = GetVars('integral_text','POST');
  $zbp->Config('YtUser')->vipdis = GetVars('vipdis','POST');
  $zbp->Config('YtUser')->sign = GetVars('sign','POST');
  $zbp->Config('YtUser')->open_reg = GetVars('open_reg','POST');
  $zbp->Config('YtUser')->regneedemail = GetVars('regneedemail','POST');
  $zbp->Config('YtUser')->regipdate = GetVars('regipdate','POST');
  $zbp->Config('YtUser')->login_verifycode = GetVars('login_verifycode','POST');
  $zbp->Config('YtUser')->login_wxon = GetVars('login_wxon','POST');
  $zbp->Config('YtUser')->login_qqon = GetVars('login_qqon','POST');
  $zbp->Config('YtUser')->login_kon = GetVars('login_kon','POST');
  $zbp->Config('YtUser')->onfavorite = GetVars('onfavorite','POST');
  $zbp->Config('YtUser')->xyurl = GetVars('xyurl','POST');
  $zbp->Config('YtUser')->xyon = (int)GetVars('xyon','POST');
  $zbp->Config('YtUser')->loginsd = (int)GetVars('loginsd','POST');
  $zbp->Config('YtUser')->zxyon = (int)GetVars('zxyon','POST');
  $zbp->Config('YtUser')->dxyon = (int)GetVars('dxyon','POST');
  if($zbp->Config('YtUser')->apipayment==1){
  $zbp->Config('YtUser')->payment=1;
  }
  $zbp->Config('YtUser')->wechat_appid = GetVars('wechat_appid','POST');
  $zbp->Config('YtUser')->wechat_appsecret = GetVars('wechat_appsecret','POST');
  $zbp->Config('YtUser')->wechat_token = GetVars('wechat_token','POST');

  $zbp->SaveConfig("YtUser");
  $zbp->SetHint('good');
  Redirect('./base.php');
}

$blogtitle='用户中心';     	  		 	 	 	    			
require $blogpath . 'zb_system/admin/admin_header.php';    						 	   			   	 	
require $blogpath . 'zb_system/admin/admin_top.php';   	     	  					    	    		
	  	   	 	 
?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('base'); ?>
    </div>
  <div id="divMain2">
<form enctype="multipart/form-data" method="post" action="?act=save">
<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	<th>
	</th>
</tr>

<tr>
	<td class="td30"><p align='left'><b>是否显示社交账号登录</b></p></td>
    <td><input type="text" class="checkbox" name="login_kon" value="<?php echo $zbp->Config('YtUser')->login_kon;?>" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>是否开启QQ登录</b></p></td>
    <td><input type="text" class="checkbox" name="login_qqon" value="<?php echo $zbp->Config('YtUser')->login_qqon;?>" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>QQ互联APPID</b></p></td>
	<td><input type="text" name="appid" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appid);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联APPKey</b></p></td>
	<td><input type="text" name="appkey" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appkey);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联回调地址</b></p></td>
	<td><?php echo $zbp->host?>zb_users/plugin/YtUser/login.php</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>是否开启我的收藏页面</b></p></td>
    <td><input type="text" class="checkbox" name="onfavorite" value="<?php echo (int)$zbp->Config('YtUser')->onfavorite;?>" />此功能需要主题模板支持</td>
</tr>



<tr>
	<td class="td30"><p align='left'><b>协议勾选状态</b></p></td>
	<td>
	<?php 
		$array=array();
		$array['0']="关闭";
		$array['1']="注册页面";
		$array['2']="注册和登录页面";
		echo zbpform::radio('xyon', $array, $zbp->Config('YtUser')->xyon); ?>
	</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>注册页面协议默认勾选</b></p></td>
    <td><input type="text" class="checkbox" name="zxyon" value="<?php echo $zbp->Config('YtUser')->zxyon;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>登录页面协议默认勾选</b></p></td>
    <td><input type="text" class="checkbox" name="dxyon" value="<?php echo $zbp->Config('YtUser')->dxyon;?>" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>用户及隐私协议url地址</b></p></td>
	<td><input type="text" name="xyurl" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->xyurl);?>" style="width:89%;" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>用户登录时长控制</b></p></td>
	<td><input type="text" name="loginsd" style="width:50px;" value="<?php echo (int)htmlspecialchars($zbp->Config('YtUser')->loginsd);?>" style="width:89%;" />天</td>
</tr>


<tr>
	<td class="td30"><p align='left'><b>是否开启微信登录</b></p></td>
    <td><input type="text" class="checkbox" name="login_wxon" value="<?php echo $zbp->Config('YtUser')->login_wxon;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>微信服务号AppID</b></p></td>
	<td><input type="text" name="wechat_appid" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->wechat_appid);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>微信服务号AppSecret</b></p></td>
	<td><input type="text" name="wechat_appsecret" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->wechat_appsecret);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>微信服务号Token</b></p></td>
	<td><input type="text" name="wechat_token" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->wechat_token);?>" style="width:89%;" /><br><span class="note">请在微信公众号后台“服务器配置”中填写相同的Token</span></td>
</tr>


<tr>
	<td class="td30"><p align='left'><b>登录时是否开启验证码</b></p></td>
    <td><input type="text" class="checkbox" name="login_verifycode" value="<?php echo $zbp->Config('YtUser')->login_verifycode;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>注册时是否显示邮件选项</b></p></td>
    <td><input type="text" class="checkbox" name="regneedemail" value="<?php echo $zbp->Config('YtUser')->regneedemail;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>同IP同天 是否只能注册一个ID</b></p></td>
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
	<td class="td30"><p align='left'><b>每日签到</b></p></td>
	<td><input type="text" name="sign" style="width:50px;" value="<?php echo (int)htmlspecialchars($zbp->Config('YtUser')->sign);?>" style="width:89%;" />金币</td>
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