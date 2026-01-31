<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
if ($zbp->VerifyCSRFToken(GetVars('csrfToken' , 'POST'), 'register', 'minute') == false) {
    ytuser_error('请求异常，请刷新后重试.');die();
}
if($zbp->Config('YtUser')->xyon){
    $agreed = trim(GetVars('agreed', 'POST'));
    if (!$agreed) {
        ytuser_error('请阅读并同意《用户注册协议》！');
        die();
    }
}
if ($zbp->Config('YtUser')->sms_on == 0) {
    $verifycode = trim($_POST['verifycode']);
    if (!$zbp->CheckValidCode($verifycode, 'register')) {
        ytuser_error('验证码错误，请重新输入.');
        die();
    }
}
if ($zbp->Config('YtUser')->regipdate) {
    $sql = $zbp->db->sql->Select($zbp->table['Member'], array('mem_Name,mem_PostTime'), array('=', 'mem_IP', GetGuestIP()), null, null, null);
    $array = $zbp->GetListType('Member', $sql);
    foreach ($array as $arr) {
        if (date('Y-m-d', $arr->PostTime) == date('Y-m-d', time())) {
            ytuser_error('当前IP地址：' . GetGuestIP() . ' 今天已经注册过啦!已注册的用户名：' . $arr->Name);
            die();
        }
    }
}
$guid = GetGuid();
$member = new Member;
$member->Guid = $guid;
$member->Level = 5;
if ($zbp->Config('YtUser')->sms_on == 1) {
    $mobile = trim(GetVars('mobile', 'POST'));
    $code = trim(GetVars('mobilecode', 'POST'));
    if (($zbp->GetMemberByName($mobile)->ID)) {
        ytuser_error('用户名已存在.');
        die();
    }
    $ver = new YtVerification();
    $array = $ver->YtTypeMobile(2, $mobile);
    if ($array) {
        $todayStartTime = strtotime(date("Y-m-d"));
        $time = (int)$zbp->Config('YtUser')->sms_limit;
        $enddayStartTime = time() - (60 * $time);
        if ($ver->Send > $enddayStartTime) {
            if ($code != $ver->Code) {
                ytuser_error('短信验证码不正确!!!');
                die();
            }
        } else {
            ytuser_error('短信验证码已过期!!!');
            die();
        }
    } else {
        ytuser_error('请输入短信验证码!!!');
        die();
    }
    $member->Name = $mobile;
}elseif($zbp->Config('YtUser')->sms_on == 2){
    $email = trim(GetVars('email', 'POST'));
    $code = trim(GetVars('mobilecode', 'POST'));
    if (($zbp->GetMemberByEmail($email)->ID)) {
        ytuser_error('用户名已存在.');
        die();
    }
    $ver = new YtVerification();
    $array = $ver->YtTypeMobile(2, $email);
    if ($array) {
        $todayStartTime = strtotime(date("Y-m-d"));
        $time = (int)$zbp->Config('YtUser')->sms_limit;
        $enddayStartTime = time() - (60 * $time);
        if ($ver->Send > $enddayStartTime) {
            if ($code != $ver->Code) {
                ytuser_error('邮箱验证码不正确!!!');
                die();
            }
        } else {
            ytuser_error('邮箱验证码已过期!!!');
            die();
        }
    } else {
        ytuser_error('请输入邮箱验证码!!!');
        die();
    }
    $name = trim(GetVars('name', 'POST'));
    $member->Name = $name;
    $member->Email = $email;
} else {
    $name = trim(GetVars('name', 'POST'));
    if (strlen($name) < $zbp->option['ZC_USERNAME_MIN'] || strlen($name) > $zbp->option['ZC_USERNAME_MAX']) {
        ytuser_error('用户名不能过长或过短.');
        die();
    }
    if (!CheckRegExp($name, '[username]')) {
        ytuser_error('用户名只能包含字母数字._和中文.');
        die();
    }
    if (($zbp->GetMemberByName($name)->ID)) {
        ytuser_error('用户名已存在');
        die();
    }
    $member->Name = $name;
}

$password = trim(GetVars('password', 'POST'));
$repassword = trim(GetVars('repassword', 'POST'));
if (strlen($password) < $zbp->option['ZC_PASSWORD_MIN'] || strlen($password) > $zbp->option['ZC_PASSWORD_MAX']) {
    ytuser_error('密码必须在' . $zbp->option['ZC_PASSWORD_MIN'] . '位-' . $zbp->option['ZC_PASSWORD_MAX'] . '位间.');
    die();
}
if ($password != $repassword) {
    ytuser_error('请核对密码.');
    die();
}
$member->Password = Member::GetPassWordByGuid($password, $guid);

$member->PostTime = time();
$member->IP = GetGuestIP();

FilterMeta($member);
foreach ($GLOBALS['hooks']['Filter_Plugin_PostMember_Core'] as $fpname => &$fpsignal) {
    $fpname($member);
}
FilterMember($member);

if($zbp->Config('YtUser')->sms_on != 2){
    $email = trim(GetVars('email', 'POST'));
    if ($zbp->Config('YtUser')->regneedemail) {
        if ($email && CheckRegExp($email, '[email]')) {
            $member->Email = $email;
        } else {
            ytuser_error('必须输入邮箱.');
            die();
        }
        if (YT_CheckEmail($member->Email) == true) {
            ytuser_error('该邮箱已被注册使用.');
            die();
        }
    } else {
        if ($email && CheckRegExp($email, '[email]')) {
            $member->Email = $email;
        } else {
            $member->Email = 'null@null.com';
        }
    }
}

$homepage = trim(GetVars('homepage', 'POST'));
if ($homepage) {
    if (strlen($homepage) > $zbp->option['ZC_HOMEPAGE_MAX']) {
        ytuser_error('网址不能过长.');
        die();
    }
    if (CheckRegExp($homepage, '[homepage]')) {
        $member->HomePage = $homepage;
    }
} else {
    $member->HomePage = $homepage;
}

if ($zbp->Config('YtUser')->inv_twoon) {
    $invitecode = trim(GetVars('invitecode', 'POST'));
    $w=array();
    $w[]=array('=','reg_InviteCode',$invitecode);
    $w[]=array('=','reg_AuthorID',0);
    $w[]=array('=','reg_Type',1);
    $sql=$zbp->db->sql->Select($zbp->table['ytuser_code'],'*',$w);
    $array=$zbp->GetListCustom($zbp->table['ytuser_code'],$zbp->datainfo['ytuser_code'],$sql);
    $num=count($array);
    if($num==0){
        ytuser_error('邀请码不存在或已被使用.');die();
    }
}
$member->Save();


if ($zbp->Config('YtUser')->inv_twoon) {
    $reg=$array[0];
    $keyvalue=array();
    $keyvalue['reg_AuthorID']=$member->ID;
    $keyvalue['reg_uptime']=time();
    $sql = $zbp->db->sql->Update($zbp->table['ytuser_code'],$keyvalue,array(array('=','reg_ID',$reg->ID)));
    $zbp->db->Update($sql);
    $member->Save();
    $member->zcprice=$reg->Price;
}else{
    $member->zcprice=0;
}

foreach ($GLOBALS['hooks']['Filter_Plugin_RegPage_RegSucceed'] as $fpname => &$fpsignal) {
    $fpname($member);
}
ytuser_success("恭喜您注册成功,请在登录页面登录.!",$zbp->host.$zbp->Config('YtUser')->YtUser_Login);
die();
function YT_CheckEmail($email)
{
    global $zbp;
    $email = trim(strtolower($email));
    $sql = $zbp->db->sql->Select($zbp->table['Member'], '*', array(array('LIKE', 'mem_Email', $email)), null, 1, null);
    $am = $zbp->GetListType('Member', $sql);
    if (count($am) > 0) {
        return true;
    };
}
