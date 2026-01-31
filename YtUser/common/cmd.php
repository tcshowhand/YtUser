<?php
require_once '../../../../zb_system/function/c_system_base.php';
if ($zbp->CheckPlugin('alipay')) {
    require_once '../../../../zb_users/plugin/alipay/function.php';
    require_once '../../../../zb_users/plugin/alipay/api.php';
}
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError', 'RespondError', PLUGIN_EXITSIGNAL_RETURN);
$action = GetVars('act', 'GET');
if ($action == "verify") {
} else {
    if ($zbp->user->ID == 0) {
        Redirect($zbp->host . $zbp->Config('YtUser')->YtUser_Login);
    }
}

foreach ($GLOBALS['Filter_Plugin_Cmd_Begin'] as $fpname => &$fpsignal) {
    $fpname();
}

switch ($action) {
    case 'MemberPst':
        $verifycode = trim(GetVars('verifycode', 'POST'));
        if (!$zbp->CheckValidCode($verifycode, 'User')) {
            ytuser_error('验证码错误，请重新输入');
            die();
        }
        if (!$zbp->ValidToken(GetVars('token', 'Post'))) {
            ytuser_error('系统繁忙，请重新提交');
            die();
        }
        $_POST['Password'] = null;
        $_POST['PasswordRe'] = null;
        if (isset($_POST["meta_Tel"])) {
            $_POST['meta_Tel'] = TransferHTML($_POST['meta_Tel'], '[noscript]');
        }
        if (isset($_POST["meta_Add"])) {
            $_POST['meta_Add'] = TransferHTML($_POST['meta_Add'], '[noscript]');
        }

        if (isset($_FILES['imgFile']) && $_FILES['imgFile']['error'] == 0) {
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            $name = $_FILES['imgFile']['name'];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (in_array($ext, array('jpg', 'jpeg', 'png', 'gif'))) {
                $upload_dir = $zbp->usersdir . 'avatar/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                move_uploaded_file($tmp_name, $upload_dir . $zbp->user->ID . '.png');
            }
        }

        PostMember();
        $zbp->BuildModule();
        $zbp->SaveCache();
        $zbp->SetHint('good');
        ytuser_success('修改成功！');
        break;
    case 'UploadPst':
        $LogID = (int) $_POST['LogID'];
        if ($LogID == 0) {
            $vipstate = (int) $_POST['vipstate'];
            $Pricetemp = [];
            $Pricetemp[1] = (int) $zbp->Config('YtUser')->pricetemp1;
            $Pricetemp[2] = (int) $zbp->Config('YtUser')->pricetemp2;
            $Pricetemp[3] = (int) $zbp->Config('YtUser')->pricetemp3;
            $Pricetemp[4] = (int) $zbp->Config('YtUser')->pricetemp4;
            $Pricetemp[5] = (int) $zbp->Config('YtUser')->pricetemp5;
            $Pricetemp[6] = (int) $zbp->Config('YtUser')->pricetemp6;
            $Pricetemp[7] = (int) $zbp->Config('YtUser')->pricetemp7;
            $Titletemp = [];
            $Titletemp[1] = $zbp->Config('YtUser')->brand . "VIP一个月";
            $Titletemp[2] = $zbp->Config('YtUser')->brand . "VIP三个月";
            $Titletemp[3] = $zbp->Config('YtUser')->brand . "VIP一年";
            $Titletemp[4] = $zbp->Config('YtUser')->brand . "终生会员";
            $Titletemp[5] = $zbp->Config('YtUser')->brand . "100积分";
            $Titletemp[6] = $zbp->Config('YtUser')->brand . "200积分";
            $Titletemp[7] = $zbp->Config('YtUser')->brand . "300积分";
            $Price = (int) $Pricetemp[$vipstate];
            if ($Price == 0) {
                ytuser_error('选项错误！');
                die();
            }
            $userbuy = new YtuserBuy();
            $userbuy->OrderID = $vipstate . GetGuid();
            $userbuy->LogID = 0;
            $userbuy->Pay = $Price;
            $userbuy->AuthorID = $zbp->user->ID;
            $userbuy->Title = $Titletemp[$vipstate];
            $userbuy->State = 0;
            $userbuy->PostTime = time();
            $userbuy->IP = GetGuestIP();
            $userbuy->Save();
        } else {
            $articles = $zbp->GetPostByID($LogID);
            $w = array();
            $w['LogID'] = $LogID;
            $w['AuthorID'] = $zbp->user->ID;
            $userbuy = new YtuserBuy();
            $userbuy->LoadInfoByFields($w);
            if ($zbp->user->Level < 5) {
                $Price = (int) $articles->Metas->price * ($zbp->Config('YtUser')->vipdis / 100);
            } else {
                $Price = (int) $articles->Metas->price;
            }
            if ($Price < 1) {
                echo '订单异常';
                die();
            }
            if ($userbuy->ID) {
                if ($userbuy->State) {
                    echo '已付款，请不要重复提交！';
                    die();
                }
            } else {
                $userbuy->OrderID = GetGuid();
                $userbuy->LogID = $articles->ID;
                $userbuy->AuthorID = $zbp->user->ID;
                $userbuy->Title = $articles->Title;
                $userbuy->State = 0;
                $userbuy->Pay = $Price;
                $userbuy->PostTime = time();
                $userbuy->IP = GetGuestIP();
                $userbuy->Save();
            }
        }
        if ($zbp->Config('YtUser')->apipayment == 1) {
            $url = "https://api.ytecn.com/alipay";
            $data = array();
            $data['send'] = (int) $zbp->Config('YtUser')->apiuid;
            $data['number'] = $Price;
            $data['order'] = $userbuy->OrderID;
            $data['returnurl'] = $zbp->host . $zbp->Config('YtUser')->YtUser_User;
            $data['noticeurl'] = $zbp->host . 'zb_users/plugin/YtUser/common/ytpay_notify_url.php';
            $data['type'] = 1;
            $data['mm'] = $zbp->Config('YtUser')->apikey;
            $ajax = Network::Create();
            $ajax->open('POST', $url);
            $u = AppCentre_Get_UserAgent();
            $c = AppCentre_Get_Cookies();
            $ajax->setTimeOuts(120, 120, 0, 0);
            $ajax->setRequestHeader('User-Agent', $u);
            $ajax->setRequestHeader('Cookie', $c);
            $ajax->setRequestHeader('Website', $zbp->host);
            $ajax->send($data);
            $encrypted = $ajax->responseText;
            print_r($encrypted);
            die();
        } else {
            $parameter = array(
                "out_trade_no" => $userbuy->OrderID,
                "subject" => $userbuy->Title,
                "total_fee" => $Price,
                "body" => $userbuy->Title,
                "show_url" => $zbp->host . $zbp->Config('YtUser')->YtUser_Paylist,
            );
            if ($zbp->CheckPlugin('ytecn_pay')) {
                ytecn_payapi_start($parameter);
            } elseif ($zbp->CheckPlugin('alipay')) {
                AlipayAPI_Start($parameter);
            } elseif ($zbp->CheckPlugin('ytecn_payapi')) {
                if (zbp_is_mobile()) {
                    ytecn_payapi($parameter, 12);
                } else {
                    ytecn_payapi($parameter, 13);
                }
            } else {
                ytuser_error('未配置在线支付.');
                die();
            }
        }

        break;
    default:
        break;
}