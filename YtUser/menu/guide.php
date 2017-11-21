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
		<?php echo YtUser_SubMenu('guide'); ?>
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
	  <th class="td30"><p align='left'><b>页面</b><br><span class='note'></span></p></th>
	  <th>链接</th>
               <th>PHP调用标签 </th>
  </tr>
  <tr>
    <td class="td30"><p align='left'><b>登录页面</b></p></td>
    <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Login ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Login ?></a></td>
    <td>{%host%}.$zbp->Config('YtUser')->YtUser_Login<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Login</td>
  </tr>
  <tr>
    <td class="td30"><p align='left'><b>注册页面</b></p></td>
    <td><a href="<?php $zbp->host.$zbp->Config('YtUser')->YtUser_Register ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Register ?></a></td>
    <td>{%host%}.$zbp->Config('YtUser')->YtUser_Register<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Register</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>投稿列表</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Articlelist ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Articlelist ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Articlelist<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Articlelist</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>发布投稿</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Articleedt ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Articleedt ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Articleedt<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Articleedt</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>积分充值</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Integral ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Integral ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Integral<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Integral</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>支付状态</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_buy ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_buy ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_buy<br>$zbp->host.$zbp->Config('YtUser')->YtUser_buy</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>VIP卡充值</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Upgrade ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Upgrade ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Upgrade<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Upgrade</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>购买列表</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Paylist ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Paylist ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Paylist<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Paylist</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>用户中心</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_User ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_User ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_User<br>$zbp->host.$zbp->Config('YtUser')->YtUser_User</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>评论列表</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Commentlist ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Commentlist ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Commentlist<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Commentlist</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>密码找回页面</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Resetpwd ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Resetpwd ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Resetpwd<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Resetpwd</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>密码重置页面</b></p></td>
	  <td><a href="<?php echo $zbp->host.'?Resetpassword' ?>" target="_blank"><?php echo $zbp->host.'?Resetpassword' ?></a></td>
      <td>{%host%}?Resetpassword<br>$zbp->host.'?Resetpassword'</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>修改账户名</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Nameedit ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Nameedit ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Nameedit<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Nameedit</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>修改密码</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Changepassword ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Changepassword ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Changepassword<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Changepassword</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>绑定QQ</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Binding ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Binding ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Binding<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Binding</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>收藏文章</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Favorite ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Favorite ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Favorite<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Favorite</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>消费记录</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Consume ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Consume ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Consume<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Consume</td>
  </tr>
  <tr>
	  <td class="td30"><p align='left'><b>实名认证</b></p></td>
	  <td><a href="<?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Certifi ?>" target="_blank"><?php echo $zbp->host.$zbp->Config('YtUser')->YtUser_Certifi ?></a></td>
      <td>{%host%}.$zbp->Config('YtUser')->YtUser_Certifi<br>$zbp->host.$zbp->Config('YtUser')->YtUser_Certifi</td>
  </tr>
  </table>
  </form>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>