<?php
require_once dirname(__FILE__).'/class/PHPMailerAutoload.php';
#注册插件
RegisterPlugin("Email","ActivePlugin_Email");

function send_mail($mailto,$subject,$content) {
	global $zbp;
	$mail = new PHPMailer;
	$mail->CharSet = "UTF-8";
	$mail->Encoding = "base64";
	$mail->IsSMTP();
	$mail->Debugoutput = 'html';
	$mail->Host = $zbp->Config('Email')->MAIL_SMTP;
	$mail->Port = (int)$zbp->Config('Email')->MAIL_PORT;
	$mail->SMTPAuth = true;
	$mail->Username = $zbp->Config('Email')->MAIL_SENDEMAIL;
	$mail->Password = $zbp->Config('Email')->MAIL_PASSWORD;
	$mail->setFrom($zbp->Config('Email')->MAIL_SENDEMAIL, $zbp->Config('Email')->MAIL_NAME);
	$mail->addAddress($mailto);
	$mail->Subject =$subject;
	$mail->msgHTML($content);
	if(!$mail->Send()) {
		echo $mail->ErrorInfo;
		return false;
	}
	else {
		return true;
	}
}

function InstallPlugin_Email() {
	global $zbp;
	if(!$zbp->Config('Email')->HasKey('Version')) {
		$zbp->Config('Email')->Version = '1';
		$zbp->Config('Email')->MAIL_SMTP = 'smtp.139.com';
		$zbp->Config('Email')->MAIL_PORT = '25';
		$zbp->Config('Email')->MAIL_SENDEMAIL = 'admin@139.com';
		$zbp->Config('Email')->MAIL_PASSWORD = '123456';
		$zbp->Config('Email')->MAIL_NAME = '豫唐';
		$zbp->SaveConfig('Email');
	}
}

function UninstallPlugin_Email() {
	global $zbp;
	$zbp->DelConfig('Email');
}
