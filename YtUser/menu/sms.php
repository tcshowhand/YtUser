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
		<?php echo YtUser_SubMenu('sms'); ?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">

  <form enctype="multipart/form-data" method="post" action="save.php?type=sms">  
  <input id="reset" name="reset" type="hidden" value="" />
  <table border="1" class="tableFull tableBorder">
  <tr>
	  <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	  <th>请先安装并启动 - 相关的短信插件(如未开启会导致用户无法注册账户)
	  </th>
  </tr>
  <tr>
	  <td><p align='left'><b>是否开启短信注册功能</b></p></td>
	  <td><input type="text" class="checkbox" name="sms_on" value="<?php echo $zbp->Config('YtUser')->sms_on;?>" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>N分钟内只可接收一条短信</b></p></td>
	  <td><input type="text" name="sms_limit" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->sms_limit ? $zbp->Config('YtUser')->sms_limit : 5 ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>一天仅可接受N条短信</b></p></td>
	  <td><input type="text" name="sms_count" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->sms_count ? $zbp->Config('YtUser')->sms_count : 5 ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>短信签名</b></p></td>
	  <td><input type="text" name="sms_sign" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_sign ? $zbp->Config('YtUser')->sms_sign : '豫唐';?>" style="width:89%;" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>模版CODE</b></p></td>
	  <td><input type="text" name="sms_code" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_code ? $zbp->Config('YtUser')->sms_code : 'SMS_119225029' ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>验证码变量</b></p></td>
	  <td><input type="text" name="sms_verifycode" style="width:150px;" value="<?php echo $zbp->Config('YtUser')->sms_verifycode ? $zbp->Config('YtUser')->sms_verifycode : 'verifycode' ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>短信案例：</b></p></td>
	  <td>您的手机正在注册豫唐网账户，您的验证码为：${verifycode}</td>
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