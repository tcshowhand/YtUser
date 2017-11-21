<?php
require '../../../zb_system/function/c_system_base.php';
if ($zbp->CheckPlugin('alipay')) {
require_once '../../../zb_users/plugin/alipay/function.php';
require_once '../../../zb_users/plugin/alipay/api.php';
}
$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
$action=GetVars('act','GET');

if($action=="verify"){
}else{
    if($zbp->user->ID==0){Redirect($zbp->host);}
}

foreach ($GLOBALS['Filter_Plugin_Cmd_Begin'] as $fpname => &$fpsignal) {$fpname();}

if(!$zbp->CheckRights($action)){$zbp->ShowError(6,__FILE__,__LINE__);die();}

switch ($action) {
    case 'verify':
	if ($zbp->Config('YtUser')->login_verifycode){
		$verifycode=trim($_POST['verifycode']);
		if(!$zbp->CheckValidCode($verifycode,'User')){
			$zbp->ShowError('验证码错误，请重新输入.');die();
		}
	}
    $_POST['username']=$_POST['username'];
    $_POST['password']=$_POST['edtPassWord'];
    if(isset($_POST['strSaveDate'])) $_POST['savedate']=$_POST['strSaveDate'];
    if (VerifyLogin()) echo '登录成功！';
    break;
    case 'ArticlePst':
    	if(empty($_POST['Title']) || empty($_POST['Content'])){
    		$zbp->ShowError('骚年，不要捣乱！！！');die();
    	}
        if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
        $_POST['Status'] = 2;
		PostArticle();
		$zbp->BuildModule();
		$zbp->SaveCache();
		$zbp->SetHint('good');
		Redirect($zbp->host.'?Articlelist');
		break;
	case 'MemberPst':
        $verifycode=trim($_POST['verifycode']);
        if(!$zbp->CheckValidCode($verifycode,'User')){
            $zbp->ShowError('验证码错误，请重新输入.');die();
        }
		if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
		$_POST['Password'] = null;
		$_POST['PasswordRe'] = null;
        if (isset($_POST["meta_Tel"])) {
            $_POST['meta_Tel']=TransferHTML($_POST['meta_Tel'], '[noscript]');
        }
        if (isset($_POST["meta_Add"])) {
        $_POST['meta_Add']=TransferHTML($_POST['meta_Add'], '[noscript]');
        }
		PostMember();
		$zbp->BuildModule();
		$zbp->SaveCache();
		$zbp->SetHint('good');
		echo '修改成功！';
		break;
case 'UploadPst':
        $LogID=(int)$_POST['LogID'];
        $articles = $zbp->GetPostByID($LogID);
        $userbuy=new YtuserBuy();
		$array = $userbuy->YtInfoByField('LogID',$LogID);
		if($array){
			if($userbuy->State){
				echo '已付款！';
				die();
			}
		}else{
			$userbuy->OrderID=GetGuid();
			$userbuy->LogID=$post->ID;
			$userbuy->AuthorID=$zbp->user->ID;
			$userbuy->Title=$post->Title;
			$userbuy->State=0;
			$userbuy->PostTime=time();
			$userbuy->IP=GetGuestIP();
			$userbuy->Save();
		}
        if($zbp->user->Level < 5){
            $Price=(int)$articles->Metas->price * ($zbp->Config('YtUser')->vipdis/100);
        }else{
            $Price=$articles->Metas->price;
        }
        $sql=$zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=','buy_LogID',$LogID),array('=','buy_AuthorID',$zbp->user->ID)),null,null,null);
	    $array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);
	    $num=count($array);
        $reg=$array[0];
		$parameter = array(
			"out_trade_no" => $reg->OrderID, //订单号
			"subject" => $reg->Title,
			"total_fee" => $Price, //金额
			"body" => $reg->Title,
			"show_url" => $zbp->host."?Upgrade&vip=1",
		);
		AlipayAPI_Start($parameter);
		break;
	default:
		# code...
		break;
}