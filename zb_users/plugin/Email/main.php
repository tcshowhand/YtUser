<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Email')) {$zbp->ShowError(48);die();}
$blogtitle='邮件发送';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
		<a href="" ><span class="m-left">配置首页</span></a>
        <a href="https://www.ytecn.com/" target="_blank"><span class="m-right">帮助</span></a>
  </div>
  <div id="divMain2">
	<!--代码-->
    <?php
	if(isset($_POST['MAIL_SMTP'])){
		$zbp->Config('Email')->MAIL_SMTP = $_POST['MAIL_SMTP'];
		$zbp->Config('Email')->MAIL_PORT = $_POST['MAIL_PORT'];
		$zbp->Config('Email')->MAIL_SENDEMAIL = $_POST['MAIL_SENDEMAIL'];
		$zbp->Config('Email')->MAIL_PASSWORD = $_POST['MAIL_PASSWORD'];
                    $zbp->Config('Email')->MAIL_NAME = $_POST['MAIL_NAME'];
		$zbp->SaveConfig('Email');
		$zbp->SetHint('good','配置已保存');
		Redirect('./main.php');
	}
	?>
	<form id="form1" name="form1" method="post"> 
		<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
			<tr>
				<th width="15%"><p align="center">配置名称</p></th>
				<th width="50%"><p align="center">配置内容</p></th>
			</tr>
			<tr>
				<td><div align="center">SMTP服务器</div></td>
				<td><input name="MAIL_SMTP" type="text" id="MAIL_SMTP" value="<?php echo $zbp->Config('Email')->MAIL_SMTP;?>"/>如:smtp.163.com</td>
			</tr>
			<tr>
				<td><div align="center">SMTP端口</div></td>
				<td><input name="MAIL_PORT" type="text" id="MAIL_PORT" value="<?php echo $zbp->Config('Email')->MAIL_PORT;?>"/>一般默认为:25</td>
			</tr>
			<tr>
				<td><div align="center">发信邮箱</div></td>
				<td><input name="MAIL_SENDEMAIL" type="text" id="MAIL_SENDEMAIL" value="<?php echo $zbp->Config('Email')->MAIL_SENDEMAIL;?>"/></td>
			</tr>
			<tr>
				<td><div align="center">发信密码</div></td>
				<td><input type="password" name="MAIL_PASSWORD" value="<?php echo $zbp->Config('Email')->MAIL_PASSWORD;?>"/>授权码非邮箱密码，</td>
			</tr>
			<tr>
				<td><div align="center">发件人名称</div></td>
				<td><input name="MAIL_NAME" type="text" id="MAIL_SMTP" value="<?php echo $zbp->Config('Email')->MAIL_NAME;?>"/>如:豫唐</td>
			</tr>
			<tr>
				<td><div align="center">配置保存</div></td>
				<td><input name="" type="Submit" class="button" value="保　存" /></td>
			</tr>
		</table>
                    <table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder table_striped table_hover">
                        <tbody><tr height="32"><td><font color="green"><b>使用方法：</b></font>send_mail('接收人邮件地址','邮件标题','邮件内容');返回值为true/false</td></tr>
                    </tbody></table>
                    <table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder table_striped table_hover">
                        <tbody><tr height="32"><td><font color="green"><b>温馨提示：</b></font>发信邮箱必须支持smtp并且开启smtp服务才能发送成功。</td></tr>
                    </tbody></table>
		<table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder table_striped table_hover">
			<tbody><tr height="32"><td>友情提示：<a href="http://service.mail.qq.com/cgi-bin/help?subtype=1&amp;&amp;id=28&amp;&amp;no=1001256" target="_Blank" id="code" style="">查看QQ邮箱授权码获取方法</a><a href="http://help.mail.163.com/faq.do?m=list&categoryID=197" target="_Blank" id="code" style="margin-left: 10px;">查看网易邮箱授权码获取方法</a></td></tr>
		</tbody></table>
	</form>
  </div>
</div>

<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Email/logo.png';?>");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>