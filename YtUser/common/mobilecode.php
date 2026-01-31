<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
$verifycode=trim(GetVars('captcha','POST'));
if(!$zbp->CheckValidCode($verifycode,'captcha')){
	ytuser_error('验证码错误，请重新输入.');die();
}

if($zbp->Config('YtUser')->sms_on==1){
$mobile=GetVars('mobile','POST');
if (YtUser_check_mobile($mobile)) {
    $ver=new YtVerification();
    $array=$ver->YtTypeMobile(2,$mobile);
    if($array){
        $todayStartTime = strtotime(date("Y-m-d"));
        $time=(int)$zbp->Config('YtUser')->sms_limit;
        $enddayStartTime = time()-(60*$time);
        if ($ver->Send > $enddayStartTime) {
            ytuser_error($time."分钟内只能发一次!!!");die();
        }
        if ($ver->Expire <= $todayStartTime) {
            $ver->Count = 1;
            $ver->Expire=time();
        } else {
            $ver->Count=$ver->Count+1;
        }
        if($ver->Count > 5){
            ytuser_error("验证码发送过多,请明天再试!!!");die();
            die();
        }
        $ver->Send=time();
    }else{
        $ver->Count=1;
        $ver->Send=time();
        $ver->Expire=time();
        $ver->IP=GetGuestIP();
        $ver->Account=$mobile;
        $ver->Type=2;
    }
    $ver->Code = rand(100000, 999999);
    $ver->Save();
    $smscontent='{"'.$zbp->Config('YtUser')->sms_verifycode.'":"'.$ver->Code.'"}';
    Sendsms($zbp->Config('YtUser')->sms_sign,$smscontent,$mobile,$zbp->Config('YtUser')->sms_code);
    ytuser_success("验证码发送成功！!");die();
} else {
    ytuser_error("请输入正确的手机格式!");die(); 
}
}



if($zbp->Config('YtUser')->sms_on==2){
    $mobile = trim(GetVars('mobile', 'POST'));
    if ($mobile && CheckRegExp($mobile, '[email]')) {
        $email=$mobile;
        $ver=new YtVerification();
        $array=$ver->YtTypeMobile(2,$mobile);
        if($array){
            $todayStartTime = strtotime(date("Y-m-d"));
            $time=(int)$zbp->Config('YtUser')->sms_limit;
            $enddayStartTime = time()-(60*$time);
            if ($ver->Send > $enddayStartTime) {
                ytuser_error($time."分钟内只能发一次!!!");die();
            }
            if ($ver->Expire <= $todayStartTime) {
                $ver->Count = 1;
                $ver->Expire=time();
            } else {
                $ver->Count=$ver->Count+1;
            }
            if($ver->Count > 5){
                ytuser_error("验证码发送过多,请明天再试!!!");die();
                die();
            }
            $ver->Send=time();
        }else{
            $ver->Count=1;
            $ver->Send=time();
            $ver->Expire=time();
            $ver->IP=GetGuestIP();
            $ver->Account=$mobile;
            $ver->Type=2;
        }
        $ver->Code = rand(100000, 999999);
        $ver->Save();

        $emailtitle='您正在'.$zbp->name.'注册账户';


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
        验证码 $ver->Code ,你好,:
            </td>
    </tr>
    <tr height="15">
        <td></td>
    </tr>

    <tr height="30">
        <td style="padding-left:55px;padding-right:55px;font-family:'微软雅黑','黑体',arial;font-size:14px;">
            您刚刚在 $zbp->name 进行了账户注册。
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


        if($zbp->CheckPlugin('tpure') && $zbp->Config('tpure')->PostMAILON == '1'){
            tpure_SendEmail($email,$emailtitle,$content);
        }elseif($zbp->CheckPlugin('XF_Email')){
            send_xf_mail($email,$emailtitle,$content);
        }elseif($zbp->CheckPlugin('tx_mail')){
            tx_mail($email,$emailtitle,$content);
        }else{
            ytuser_error('未配置发送邮箱.');die();
        }
        ytuser_success("验证码发送成功！!");die();
    } else {
        ytuser_error("请输入正确的邮箱格式!");die(); 
        die();
    }
}


?>