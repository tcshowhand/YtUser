<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
function get_url_contents($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
 
$appid = $zbp->Config('YtUser')->appid;    
$appkey = $zbp->Config('YtUser')->appkey;   
$redirect_uri = $zbp->host."zb_users/plugin/YtUser/login.php"; 
      
if (!isset($_GET['code'])) {
	$state = md5(uniqid(rand(), true));    	
	$scope = 'get_user_info';      
	$login_url = "https://graph.qq.com/oauth2.0/authorize?scope={$scope}&state={$state}&response_type=code&client_id={$appid}&redirect_uri={$redirect_uri}";           
	Redirect($login_url);      
} else {      
    $code = $_GET['code'];
	if (empty($code)) {echo 'Error Get Authorization Code';exit();}   
	$urldata = get_url_contents("https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id={$appid}&client_secret={$appkey}&code={$code}&redirect_uri={$redirect_uri}");      
    $qqinfo = array();
    parse_str($urldata,$qqinfo);
    $access_token=$qqinfo['access_token'];
    $expires_in=$qqinfo['expires_in'];
    $refresh_token=$qqinfo['refresh_token'];
	if (empty($access_token)) {if (empty($_SESSION['access_token'])) {echo 'Error Get Access Token';exit();} else {$access_token = $_SESSION['access_token'];} } else {$_SESSION['access_token'] = $access_token;}  
	$urldata = get_url_contents("https://graph.qq.com/oauth2.0/me?access_token={$access_token}");
	$urldata = str_replace("callback(", "", $urldata);
	$urldata = str_replace(');', '', $urldata);
	$urldata = json_decode($urldata, true);
	$openid = $urldata['openid'];
    if (empty($openid)) {echo 'Error Get Open ID';exit();}
    $urldata = get_url_contents("https://graph.qq.com/user/get_user_info?access_token={$access_token}&oauth_consumer_key={$appid}&openid={$openid}&format=json");   
    if (empty($urldata)) {echo 'Error Get User Info';exit();}
    $userinfo = json_decode($urldata, true);
    if($openid!=""){
        $ytuser = new Ytuser();
        $ytuser->LoadInfoByField('Oid',$openid);
        if($zbp->user->ID){
            if ($ytuser->ID) {
                Redirect($zbp->host."?Binding");die();
            }else{
                $ytuser->LoadInfoByField('Uid',$zbp->user->ID);
                $ytuser->Oid=$openid;
                $ytuser->Save();
                Redirect($zbp->host."?Binding");
            }
        }
        if ($ytuser->ID) {
            $zbpuid = $ytuser->Uid;
            $m=$zbp->GetMemberByID($zbpuid);
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
            Redirect($zbp->host);
            die();
        }else{
            $guid=GetGuid();
            $member=new Member;
            $member->Guid=$guid;
            $member->Name="yt_".$guid;
            $member->Alias=$userinfo['nickname'];
            $member->Password="0e681aa506fc191c5f2fa9be6abddd01";
            $member->HomePage="";
            $member->Level=5;
            $member->PostTime=time();
            $member->IP=GetGuestIP();
            $member->Metas->Img="";
            $member->Save();
            $get=$member->ID;
            $get=(int)$get;
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
            $zbp->user = $member;
            SetLoginCookie($member, 0);
            Redirect($zbp->host);
            die();
        }      
    }else{ 	
        Redirect($zbp->host);      
    }        
}          
?>