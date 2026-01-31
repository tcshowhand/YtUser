<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();

function ytuser_get_url_contents($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

$appid = $zbp->Config('YtUser')->wechat_appid;
$appsecret = $zbp->Config('YtUser')->wechat_appsecret;
$redirect_uri = $zbp->host . "zb_users/plugin/YtUser/login_wechat.php";

if ($zbp->user->ID) {
    if (isset($_GET['state']) && $_GET['state'] != 'STATE') {
        $url = base64_decode($_GET['state']);
        if (filter_var($url, FILTER_VALIDATE_URL) && strpos($url, $zbp->host) === 0) {
            Redirect($url);
        }
    }
    Redirect($zbp->host);
    die();
}

if (!isset($_GET['code'])) {
    die('No code provided.');
} else {
    $code = $_GET['code'];
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";
    $json = ytuser_get_url_contents($url);
    $data = json_decode($json, true);

    if (isset($data['errcode'])) {
        die('WeChat Login Error: ' . $data['errmsg']);
    }

    $openid = $data['openid'];
    // snsapi_base only gives openid. userinfo is not available unless we upgrade scope.
    // For "senseless" login, we usually don't have userinfo unless the user previously authorized.

    if (empty($openid)) {
        die('Error: OpenID is empty.');
    }

    // Check if OpenID exists in DB
    $ytuser = new Ytuser();
    $ytuser->LoadInfoByField('Oid', $openid);

    if ($ytuser->ID) {
        // User exists, login
        $zbpuid = $ytuser->Uid;
        $m = $zbp->GetMemberByID($zbpuid);
        if ($m->ID) {
             if ($m->Status == ZC_MEMBER_STATUS_AUDITING) {
                $zbp->ShowError(79, __FILE__, __LINE__);
                die();
            }
            if ($m->Status == ZC_MEMBER_STATUS_LOCKED) {
                $zbp->ShowError(80, __FILE__, __LINE__);
                die();
            }
            $zbp->user = $m;
            SetLoginCookie($m, 0);
            if (isset($_GET['state']) && $_GET['state'] != 'STATE') {
                $url = base64_decode($_GET['state']);
                if (filter_var($url, FILTER_VALIDATE_URL) && strpos($url, $zbp->host) === 0) {
                    Redirect($url);
                }
            }
            Redirect($zbp->host); 
            die();
        }
    } else {
        $guid = GetGuid();
        $member = new Member;
        $member->Guid = $guid;
        $member->Name = "wx_" . substr($guid, 0, 8);
        $member->Alias = "微信用户";
        $member->Password="0e681aa506fc191c5f2fa9be6abddd01";
        $member->HomePage = "";
        $member->Level = 5;
        $member->PostTime = time();
        $member->IP = GetGuestIP();
        $member->Metas->Img = "";
        $member->Save();

        $ytuser = new YtUser();
        $ytuser->Uid = $member->ID;
        $ytuser->Oid = $openid;

        if ($zbp->Config('YtUser')->inv_on == 1){
            if(empty($_COOKIE["uuu"])){
                $ytuser->roodid=0;
            }else{
                $rootid=(int)$_COOKIE["uuu"];
                $memberrid= new Member();
                $memberrid->LoadInfoByID($rootid);
                $ytuser->roodid=$memberrid->ID;
            }
        }else{
            $ytuser->roodid=0;
        }

        $ytuser->Save();

        // Login the new user
        $zbp->user = $member;
        SetLoginCookie($member, 0);

        if (isset($_GET['state']) && $_GET['state'] != 'STATE') {
            $url = base64_decode($_GET['state']);
            if (filter_var($url, FILTER_VALIDATE_URL) && strpos($url, $zbp->host) === 0) {
                Redirect($url);
            }
        }
        Redirect($zbp->host);
        die();
    }
}
?>
