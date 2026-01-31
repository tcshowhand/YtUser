<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();

// 辅助函数：网络请求
function ytuser_official_http_get($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function ytuser_official_http_post($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$act = GetVars('act', 'GET');
$cache_dir = $zbp->usersdir . 'plugin/YtUser/cache/';

if (!file_exists($cache_dir)) {
    @mkdir($cache_dir, 0755, true);
}

// 1. 获取带参数的二维码
if ($act == 'get_qrcode') {
    $appid = $zbp->Config('YtUser')->wechat_appid;
    $appsecret = $zbp->Config('YtUser')->wechat_appsecret;

    if (!$appid || !$appsecret) {
        echo json_encode(['status' => 0, 'msg' => '请先在后台配置 AppID 和 AppSecret']);
        die();
    }

    $token_file = $cache_dir . 'access_token.json';

    // 封装获取 AccessToekn 函数 (使用 stable_token)
    if (!function_exists('ytuser_get_access_token')) {
        function ytuser_get_access_token($appid, $appsecret, $force_refresh = false, $token_file = '') {
            global $cache_dir;
            if (empty($token_file)) $token_file = $cache_dir . 'access_token.json';

            // 1. 尝试从缓存读取
            if (!$force_refresh && file_exists($token_file)) {
                $token_data = json_decode(file_get_contents($token_file), true);
                if (isset($token_data['expire_time']) && $token_data['expire_time'] > time()) {
                    return $token_data['access_token'];
                }
            }

            // 2. 调用 stable_token 接口
            $url = "https://api.weixin.qq.com/cgi-bin/stable_token";
            $data = json_encode([
                'grant_type' => 'client_credential',
                'appid' => $appid,
                'secret' => $appsecret,
                'force_refresh' => $force_refresh
            ]);
            
            $res = json_decode(ytuser_official_http_post($url, $data), true);
            
            if (isset($res['access_token'])) {
                // 保存缓存 (提前 5 分钟过期，确保安全)
                file_put_contents($token_file, json_encode([
                    'access_token' => $res['access_token'], 
                    'expire_time' => time() + intval($res['expires_in']) - 300
                ]));
                return $res['access_token'];
            }
            
            return false; // 获取失败
        }
    }

    // 尝试获取 Token 并生成二维码 (带一次重试机制)
    $access_token = ytuser_get_access_token($appid, $appsecret);
    
    // 如果第一次获取 access_token 就失败了 (可能是配置错误)
    if (!$access_token) {
        echo json_encode(['status' => 0, 'msg' => '获取 Access Token 失败，请检查 AppID 和 Secret']);
        die();
    }
    
    // 生成 scene_id
    $scene_id = rand(100000, 999999);
    
    // 生成二维码函数
    function ytuser_create_qrcode($access_token, $scene_id) {
         $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
         $data = '{"expire_seconds": 600, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": ' . $scene_id . '}}}';
         return json_decode(ytuser_official_http_post($url, $data), true);
    }
    
    $res = ytuser_create_qrcode($access_token, $scene_id);

    // 检查是否 token 无效 (40001, 40014, 42001 等)
    if (isset($res['errcode']) && in_array($res['errcode'], [40001, 40014, 42001])) {
        // 强制刷新 Token
        $access_token = ytuser_get_access_token($appid, $appsecret, true);
        if ($access_token) {
            // 重试生成二维码
            $res = ytuser_create_qrcode($access_token, $scene_id);
        }
    }

    if (isset($res['ticket'])) {
        $qrcode_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode($res['ticket']);
        echo json_encode([
            'status' => 1,
            'scene_id' => $scene_id,
            'qrcode_url' => $qrcode_url
        ]);
    } else {
        $msg = isset($res['errmsg']) ? $res['errmsg'] : '未知错误';
        // 附加错误码以便排查
        $errcode = isset($res['errcode']) ? " ({$res['errcode']})" : "";
        echo json_encode(['status' => 0, 'msg' => '二维码生成失败: ' . $msg . $errcode]);
    }
    die();
}

// 验证签名
function ytuser_check_signature($token) {
    $signature = GetVars('signature', 'GET');
    $timestamp = GetVars('timestamp', 'GET');
    $nonce = GetVars('nonce', 'GET');

    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode($tmpArr);
    $tmpStr = sha1($tmpStr);

    return $tmpStr == $signature;
}

// 调试日志函数
function ytuser_debug_log($msg) {
    global $zbp;
    $log_file = $zbp->usersdir . 'plugin/YtUser/cache/debug_log.txt';
    $time = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$time] $msg" . PHP_EOL, FILE_APPEND);
}

// 2. 微信服务器回调处理
if ($act == 'callback') {
    $token = $zbp->Config('YtUser')->wechat_token;
    
    // 记录请求到达
    ytuser_debug_log("Callback reached. Method: " . $_SERVER['REQUEST_METHOD']);

    // 如果没有配置 Token，为了方便调试，暂时允许通过 (但不建议)
    // 或者强制要求配置
    if ($token && !ytuser_check_signature($token)) {
        ytuser_debug_log("Signature check failed. Token: $token, Query: " . json_encode($_GET));
        die('Invalid Signature');
    }

    // 微信验证签名 (如果是首次配置服务器，微信会发送 GET 请求)
    $echostr = GetVars('echostr', 'GET');
    if ($echostr) {
        ytuser_debug_log("EchoStr verification success.");
        echo $echostr;
        die();
    }

    // 接收 POST 数据
    $postStr = file_get_contents("php://input");
    if (!empty($postStr)) {
        ytuser_debug_log("Received POST data: " . $postStr);
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $FromUserName = (string)$postObj->FromUserName; // OpenID
        $Event = (string)$postObj->Event;
        $EventKey = (string)$postObj->EventKey; // qrscene_123123 or 123123

        ytuser_debug_log("Parsed event: $Event, Key: $EventKey, User: $FromUserName");

        $scene_id = '';
        if ($Event == 'subscribe') {
            // 扫码关注，EventKey 格式为 qrscene_123123
            $scene_id = substr($EventKey, 8);
        } elseif ($Event == 'SCAN') {
            // 已关注扫码，EventKey 格式为 123123
            $scene_id = $EventKey;
        }

        if ($scene_id) {
            // 将 OpenID 写入对应 scene_id 的缓存文件
            $file_path = $cache_dir . 'login_' . $scene_id . '.txt';
            $res = file_put_contents($file_path, $FromUserName);
            if ($res === false) {
                 ytuser_debug_log("Failed to write to file: $file_path");
            } else {
                 ytuser_debug_log("Successfully wrote OpenID to $file_path");
            }
        } else {
            ytuser_debug_log("No scene_id found.");
        }
    } else {
        ytuser_debug_log("Empty POST input.");
    }
    echo "success"; // 必须返回 success
    die();
}

// 3. 前端轮询检查登录
if ($act == 'check_login') {
    $scene_id = (int)GetVars('scene_id', 'GET');
    if (!$scene_id) die(json_encode(['status' => 0]));

    $file = $cache_dir . 'login_' . $scene_id . '.txt';
    if (file_exists($file)) {
        $openid = file_get_contents($file);
        @unlink($file); // 读取后删除

        if ($openid) {
            // 执行登录逻辑 (复用 login_wechat.php 的逻辑)
            
            // 下面代码大部分逻辑与 login_wechat.php 相同，建议重构为公共函数，这里先直接写
            $ytuser = new Ytuser(); // 假设插件已定义此类，通常在 include.php 中
            $ytuser->LoadInfoByField('Oid', $openid);

            if ($ytuser->ID) {
                // 用户存在
                $zbpuid = $ytuser->Uid;
                $m = $zbp->GetMemberByID($zbpuid);
                if ($m->ID) {
                     if ($m->Status == ZC_MEMBER_STATUS_AUDITING) {
                        echo json_encode(['status' => 0, 'msg' => '账号审核中']); die();
                    }
                    if ($m->Status == ZC_MEMBER_STATUS_LOCKED) {
                        echo json_encode(['status' => 0, 'msg' => '账号被锁定']); die();
                    }
                    $zbp->user = $m;
                    SetLoginCookie($m, 0);
                    echo json_encode(['status' => 1, 'msg' => '登录成功']);
                    die();
                }
            } else {
                // 新用户自动注册
                $guid = GetGuid();
                $member = new Member;
                $member->Guid = $guid;
                $member->Name = "wx_" . substr($guid, 0, 8);
                $member->Alias = "微信用户";
                $member->Password = "0e681aa506fc191c5f2fa9be6abddd01"; // 默认密码
                $member->HomePage = "";
                $member->Level = 5;
                $member->PostTime = time();
                $member->IP = GetGuestIP();
                $member->Metas->Img = "";
                $member->Save();

                $ytuser = new YtUser();
                $ytuser->Uid = $member->ID;
                $ytuser->Oid = $openid;
                
                // 处理推广逻辑 (复用)
                if ($zbp->Config('YtUser')->inv_on == 1 && !empty($_COOKIE["uuu"])){
                    $rootid = (int)$_COOKIE["uuu"];
                    $memberrid = new Member();
                    $memberrid->LoadInfoByID($rootid);
                    $ytuser->roodid = $memberrid->ID;
                } else {
                    $ytuser->roodid = 0;
                }

                $ytuser->Save();

                // 登录新用户
                $zbp->user = $member;
                SetLoginCookie($member, 0);
                echo json_encode(['status' => 1, 'msg' => '注册并登录成功']);
                die();
            }
        }
    }
    
    echo json_encode(['status' => 0]); // 未扫码或文件未生成
    die();
}
?>
