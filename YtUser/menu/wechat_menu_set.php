<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = GetVars('act', 'GET');
if (!$zbp->CheckRights('root')) {
    $zbp->ShowError(6);
    die();
}
if (!$zbp->CheckPlugin('YtUser')) {
    $zbp->ShowError(48);
    die();
}

$blogtitle = '微信公众号菜单配置';

if (!function_exists('ytuser_official_http_post')) {
    function ytuser_official_http_post($url, $data)
    {
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
}

if (!function_exists('ytuser_official_http_get')) {
    function ytuser_official_http_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

function ytuser_get_access_token_v2()
{
    global $zbp;
    $appid = $zbp->Config('YtUser')->wechat_appid;
    $appsecret = $zbp->Config('YtUser')->wechat_appsecret;
    $cache_dir = $zbp->usersdir . 'plugin/YtUser/cache/';
    if (!file_exists($cache_dir)) {
        @mkdir($cache_dir, 0755, true);
    }
    $token_file = $cache_dir . 'access_token.json';

    if (file_exists($token_file)) {
        $token_data = json_decode(file_get_contents($token_file), true);
        if (isset($token_data['expire_time']) && $token_data['expire_time'] > time()) {
            return $token_data['access_token'];
        }
    }

    $url = "https://api.weixin.qq.com/cgi-bin/stable_token";
    $data = json_encode([
        'grant_type' => 'client_credential',
        'appid' => $appid,
        'secret' => $appsecret,
        'force_refresh' => false
    ]);

    $res = json_decode(ytuser_official_http_post($url, $data), true);

    if (isset($res['access_token'])) {
        file_put_contents($token_file, json_encode([
            'access_token' => $res['access_token'],
            'expire_time' => time() + intval($res['expires_in']) - 300
        ]));
        return $res['access_token'];
    }
    return false;
}

if ($action == 'save') {
    $token = ytuser_get_access_token_v2();
    if (!$token) {
        $zbp->SetHint('bad', '获取 Access Token 失败，请检查配置');
    } else {
        $menu = $_POST['menu_json'];
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $token;
        $res = json_decode(ytuser_official_http_post($url, $menu), true);
        if ($res['errcode'] == 0) {
            $zbp->Config('YtUser')->wechat_custom_menu = $menu;
            $zbp->SaveConfig('YtUser');
            $zbp->SetHint('good', '菜单发布成功');
        } else {
            $zbp->SetHint('bad', '发布失败: ' . $res['errmsg']);
        }
    }
    Redirect('./wechat_menu_set.php');
}

if ($action == 'delete') {
    $token = ytuser_get_access_token_v2();
    if (!$token) {
        $zbp->SetHint('bad', '获取 Access Token 失败');
    } else {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $token;
        $res = json_decode(ytuser_official_http_get($url), true);
        if ($res['errcode'] == 0) {
            $zbp->SetHint('good', '菜单删除成功');
        } else {
            $zbp->SetHint('bad', '删除失败: ' . $res['errmsg']);
        }
    }
    Redirect('./wechat_menu_set.php');
}

if ($action == 'get') {
    $token = ytuser_get_access_token_v2();
    if (!$token) {
        $zbp->SetHint('bad', '获取 Access Token 失败');
    } else {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=" . $token;
        $res = json_decode(ytuser_official_http_get($url), true);
        if (isset($res['menu'])) {
            $current_menu = json_encode($res['menu'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $zbp->Config('YtUser')->wechat_custom_menu = $current_menu;
            $zbp->SaveConfig('YtUser');
            $zbp->SetHint('good', '获取成功');
        } elseif (isset($res['errcode']) && $res['errcode'] == 46003) {
            // 46003 means menu does not exist
            $zbp->Config('YtUser')->wechat_custom_menu = '';
            $zbp->SaveConfig('YtUser');
            $zbp->SetHint('good', '当前未配置个性化菜单或菜单为空');
        } else {
            $zbp->SetHint('bad', '获取失败: ' . json_encode($res));
        }
    }
    Redirect('./wechat_menu_set.php');
}

require $zbp->path . 'zb_system/admin/admin_header.php';
require $zbp->path . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
    <div class="divHeader">
        <?php echo $blogtitle; ?>
    </div>
    <div class="SubMenu">
        <?php echo YtUser_SubMenu('wechat'); ?>
    </div>
    <div id="divMain2">
        <form id="edit" name="edit" method="post" action="?act=save">
            <table border="1" class="tableFull tableBorder">
                <tr>
                    <th class="td30">说明</th>
                    <th>菜单 JSON 配置</th>
                </tr>
                <tr>
                    <td class="td30">
                        <p>请在此处填入符合微信接口规范的 JSON 数据。</p>
                        <p>AppID:
                            <?php echo $zbp->Config('YtUser')->wechat_appid ? '已配置' : '<span style="color:red">未配置</span>'; ?>
                        </p>
                        <p>AppSecret:
                            <?php echo $zbp->Config('YtUser')->wechat_appsecret ? '已配置' : '<span style="color:red">未配置</span>'; ?>
                        </p>
                        <p><a href="https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Creating_Custom-Defined_Menu.html"
                                target="_blank">点击查看微信官方文档</a></p>
                        <p><input type="button" class="button" value="获取当前线上菜单"
                                onclick="window.location.href='?act=get'" /></p>
                        <p><input type="button" class="button" value="删除当前线上菜单"
                                onclick="if(confirm('确定要删除吗？')){window.location.href='?act=delete'}" /></p>
                        <hr />
                        <p><b>不熟悉 JSON？</b><br />点击下方按钮填入示例，修改网址即可：</p>
                        <p><input type="button" class="button" value="插入示例菜单" onclick="insertTemplate()" /></p>

                        <script>
                            function insertTemplate() {
                                var host = '<?php echo $zbp->host; ?>';
                                var template = {
                                    "button": [
                                        {
                                            "type": "view",
                                            "name": "首页",
                                            "url": host
                                        },
                                        {
                                            "type": "view",
                                            "name": "用户中心",
                                            "url": host + "?User"
                                        },
                                        {
                                            "name": "更多服务",
                                            "sub_button": [
                                                {
                                                    "type": "view",
                                                    "name": "发布投稿",
                                                    "url": host + "?ArticleEdt"
                                                },
                                                {
                                                    "type": "view",
                                                    "name": "联系我们",
                                                    "url": host + "?Contact"
                                                }
                                            ]
                                        }
                                    ]
                                };
                                document.getElementsByName('menu_json')[0].value = JSON.stringify(template, null, 4);
                            }
                        </script>
                    </td>
                    <td>
                        <textarea name="menu_json"
                            style="width: 98%; height: 500px; font-family: monospace;"><?php echo htmlspecialchars($zbp->Config('YtUser')->wechat_custom_menu); ?></textarea>
                    </td>
                </tr>
            </table>
            <p>
                <input type="submit" class="button" value="发布菜单" />
            </p>
        </form>
    </div>
</div>
<?php
require $zbp->path . 'zb_system/admin/admin_footer.php';
RunTime();
?>