<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$verifycode=trim($_POST['verifycode']);
if(!$zbp->CheckValidCode($verifycode,'resetpwd')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}

$name=trim($_POST['name']);
$email=trim($_POST['email']);
if(CheckRegExp($email,'[email]')){
}else{
	$zbp->ShowError('邮箱格式不正确.');die();
}
if(isset($zbp->membersbyname[$name])){
    $m=$zbp->membersbyname[$name];
}else{
    $zbp->ShowError('用户名不存在');die();
}

if($m->Email!=$email){
    $zbp->ShowError('账户与邮箱不匹配');die();
}
$hash = YtUser_password_verify_emailhash($name);
$mailurl = $zbp->host."?Resetpassword&username=$name&hash=$hash";
$content = <<<EOT
        <div><includetail><table cellpadding="0" cellspacing="0" align="center" style="text-align:left;font-family:'微软雅黑','黑体',arial;" width="742">
    <tbody><tr>
        <td>
<table cellpadding="0" cellspacing="0" style="text-align:left;border:1px solid #50a5e6;color:#fff;font-size:18px;" width="740">
    <tbody><tr height="39" style="background-color:#50a5e6;">
        <td style="padding-left:15px;font-family:'微软雅黑','黑体',arial;">

        </td>
    </tr>
</tbody></table>
<table cellpadding="0" cellspacing="0" style="text-align:left;border:1px solid #f0f0f0;border-top:none;color:#585858;background-color:#fafafa;" width="740">
    <tbody><tr height="25">
        <td></td>
    </tr>

    <tr height="40">
        <td style="padding-left:25px;padding-right:25px;font-size:18px;font-family:'微软雅黑','黑体',arial;">
            你好,$name:
            </td>
    </tr>
    <tr height="15">
        <td></td>
    </tr>

    <tr height="30">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
            您刚刚在 $zbp->name 使用了找回密码功能。
            </td>
    </tr>
    <tr height="30">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
                请在<span style="color:rgb(255,0,0)">60分钟</span>内点击下面链接设置您的新密码：
        </td>
    </tr>
    <tr height="60">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
            <a href="$mailurl" target="_blank" style="color: rgb(255,255,255);text-decoration: none;display: block;min-height: 39px;width: 158px;line-height: 39px;background-color:rgb(80,165,230);font-size:20px;text-align:center;">重置密码</a>
        </td>
    </tr>
    <tr height="10">
        <td></td>
    </tr>
    <tr height="20">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:12px;">
                如果上面的链接点击无效，请复制以下链接至浏览器的地址栏直接打开。
        </td>
    </tr>
    <tr height="30">
        <td style="padding-left:55px;padding-right:65px;font-family:'微软雅黑','黑体',arial;">
            <a href="$mailurl" target="_blank" style="color:#0c94de;font-size:12px;">
            $mailurl
                    </a>
        </td>
    </tr>
    <tr height="20">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:12px;">
                    如果您不知道为什么收到了这封邮件，可能是他人试图获取您的密码，请联系管理员追查来源，并及时提供防范。
        </td>
    </tr>
    <tr height="20">
        <td></td>
    </tr>
</tbody></table>

<table cellpadding="0" cellspacing="0" style="text-align:left;border:1px solid #50a5e6;color:#fff;font-size:18px;" width="740">
    <tbody><tr height="39" style="background-color:#50a5e6;">
        <td style="padding-left:15px;font-family:'微软雅黑','黑体',arial;">

        </td>
    </tr>
</tbody></table></table></includetail></div>
EOT;
$emailtitle='您正在找回在'.$zbp->name.'的登录密码';
send_mail($email,$emailtitle,$content);
echo "请进入邮箱重置密码";
?>