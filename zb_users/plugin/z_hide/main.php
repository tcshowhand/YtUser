<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('z_hide')) {$zbp->ShowError(48);die();}
$blogtitle='回复或登录可见';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if ($zbp->Config('z_hide')->z_hide_Login){$z_hide_Login=$zbp->Config('z_hide')->z_hide_Login;}else{$z_hide_Login=$zbp->host.'?Login';}//登陆链接
if ($zbp->Config('z_hide')->z_hide_Register){$z_hide_Register=$zbp->Config('z_hide')->z_hide_Register;}else{$z_hide_Register=$zbp->host.'?Register';}//注册链接
if ($zbp->Config('z_hide')->z_hide_User){$z_hide_User=$zbp->Config('z_hide')->z_hide_User;}else{$z_hide_User=$zbp->host.'?User';}//用户中心页面
if ($zbp->Config('z_hide')->z_hide_Commnet){$z_hide_Commnet=$zbp->Config('z_hide')->z_hide_Commnet;}else{$z_hide_Commnet='#comment';}//用户评论链接
if(isset($_POST['submit'])){
	
	$zbp->Config('z_hide')->z_hide_Login = $_POST['z_hide_Login'];
	$zbp->Config('z_hide')->z_hide_Register = $_POST['z_hide_Register'];
	$zbp->Config('z_hide')->z_hide_User = $_POST['z_hide_User'];
	$zbp->Config('z_hide')->z_hide_Commnet = $_POST['z_hide_Commnet'];
	$zbp->SaveConfig('z_hide');
	$zbp->ShowHint('good');//成功
}
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
  <a href=""><span class="m-left m-now">文章内容隐藏设置</span></a>
  </div>
  <div id="divMain2">
	<table width="100%">
    <tr height="50px;">
	<td colspan="2"><p>
	<form id="form2" name="form2" method="post" enctype="multipart/form-data">
	<p>
	<strong>登陆链接：</strong><br />登陆地址：<input style="width: 30%;" name="z_hide_Login" type="text" value="<?php echo $z_hide_Login;?>" /><span>&nbsp;内容隐藏后需要显示的登陆页面地址。</span>
	</p>
	<p>
	<strong>注册链接</strong><br />注册地址：<input style="width: 30%;" name="z_hide_Register" type="text" value="<?php echo $z_hide_Register;?>" /><span>&nbsp;内容隐藏后需要显示的注册页面地址。</span>
	</p> 
	<p>
	<strong>用户页面：</strong><br />用户页面：<input style="width: 30%;" name="z_hide_User" type="text" value="<?php echo $z_hide_User;?>" /><span>&nbsp;例:<?php  echo $zbp->host ?>?user&nbsp;&nbsp;留空为默认:<?php  echo $zbp->user->Url ?></span>
	</p> 
	<p>
	<strong>评论链接：</strong><br />评论链接：<input style="width: 30%;" name="z_hide_Commnet" type="text" value="<?php echo $z_hide_Commnet;?>" /><span>&nbsp;例: #comment&nbsp;&nbsp;点击跳到评论框的锚文本地址。</span>
	</p> 
	</td>
	</tr>
	<tr><td height="50px">	<input name="submit" type="Submit" class="button" style="width:15%;" value="保存"/></form></td></tr>
	</table>
	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>