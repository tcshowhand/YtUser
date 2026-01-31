<?php
DefinePluginFilter('Filter_Plugin_RegPage_RegSucceed');
DefinePluginFilter('Filter_Plugin_YtUser_Dmuc');
#用户中心插件
include $zbp->usersdir . 'plugin/YtUser/' . 'function/usertable.php';
include $zbp->usersdir . 'plugin/YtUser/' . 'function/yt_event.php';
include $zbp->usersdir . 'plugin/YtUser/' . 'function/yt_page.php';
include $zbp->usersdir . 'plugin/YtUser/' . 'function/common.php';
RegisterPlugin("YtUser", "ActivePlugin_YtUser");

function ActivePlugin_YtUser()
{
    global $zbp;
    Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags', 'YtUser_Main');
    Add_Filter_Plugin('Filter_Plugin_Index_Begin', 'YtUser_page');

    Add_Filter_Plugin('Filter_Plugin_Html_Js_Add', 'YtUser_SyntaxHighlighter_print');
    Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu', 'YtUser_AddMenu');
    Add_Filter_Plugin('Filter_Plugin_ViewPost_Template', 'YtUser_Content');
    Add_Filter_Plugin('Filter_Plugin_ViewList_Template', 'YtUser_ViewList');
    Add_Filter_Plugin('Filter_Plugin_Edit_Response3', 'YtUser_Edit');
    Add_Filter_Plugin('Filter_Plugin_Admin_MemberMng_SubMenu', 'YtUser_Batch_MemberMng_Main');
    Add_Filter_Plugin('Filter_Plugin_Html_Js_ZbpConfig', 'YtUser_Html_Js_ZbpConfig');
    if ($zbp->CheckPlugin('ytecn_payapi')) {
        Add_Filter_Plugin('Filter_Plugin_YtecnPayNotice_Succeed', 'YtUser_Filter_Plugin_AlipayPayNotice_Succeed');
        Add_Filter_Plugin('Filter_Plugin_YtecnPayReturn_Succeed', 'YtUser_Filter_Plugin_AlipayPayReturn_Succeed');
    } else {
        Add_Filter_Plugin('Filter_Plugin_AlipayPayNotice_Succeed', 'YtUser_Filter_Plugin_AlipayPayNotice_Succeed');
        Add_Filter_Plugin('Filter_Plugin_AlipayPayReturn_Succeed', 'YtUser_Filter_Plugin_AlipayPayReturn_Succeed');
    }
    Add_Filter_Plugin('Filter_Plugin_DelArticle_Succeed', 'YtUser_DelArticle');
    Add_Filter_Plugin('Filter_Plugin_RegPage_RegSucceed', 'YtUser_RegSucceed');
    Add_Filter_Plugin('Filter_Plugin_Admin_Begin', 'YtUser_Admin_Begin');
    Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate', 'YtUser_Temp');
    Add_Filter_Plugin('Filter_Plugin_Member_Get', 'YtUser_Member_Get');
    Add_Filter_Plugin('Filter_Plugin_Edit_Response', 'YtUser_Edit_Response1');
    Add_Filter_Plugin('Filter_Plugin_Edit_End', 'YtUser_Edit_End');
    Add_Filter_Plugin('Filter_Plugin_DelMember_Succeed', 'YtUser_DelMember_Succeed');
    Add_Filter_Plugin('Filter_Plugin_PostArticle_Core', 'YtUser_PostArticle_Core');
    Add_Filter_Plugin('Filter_Plugin_Post_Get', 'YtUser_Post_Get');
    Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response', 'YtUser_Category_Edit_Response');
    Add_Filter_Plugin('Filter_Plugin_Edit_Response5', 'YtUser_Edit_Response5');
}

function UpdatePlugin_YtUser()
{
    global $zbp;
    $zbp->Config('YtUser')->api_changepassword = $zbp->host . 'zb_users/plugin/YtUser/common/changepassword.php';
    $zbp->Config('YtUser')->api_login = $zbp->host . 'zb_users/plugin/YtUser/common/verify.php';
    $zbp->Config('YtUser')->api_certifi = $zbp->host . 'zb_users/plugin/YtUser/common/certifi.php';
    $zbp->Config('YtUser')->api_articleinfo = $zbp->host . 'zb_users/plugin/YtUser/common/articleInfo.php';
    $zbp->Config('YtUser')->api_userinfo = $zbp->host . 'zb_users/plugin/YtUser/common/cmd.php?act=MemberPst';
    $zbp->Config('YtUser')->api_nameedit = $zbp->host . 'zb_users/plugin/YtUser/common/nameedit.php';
    $zbp->Config('YtUser')->api_mailto = $zbp->host . 'zb_users/plugin/YtUser/common/mailto.php';
    $zbp->Config('YtUser')->api_resetpwdto = $zbp->host . 'zb_users/plugin/YtUser/common/resetpwdto.php';
    $zbp->Config('YtUser')->api_buypay = $zbp->host . 'zb_users/plugin/YtUser/common/Ytbuypay.php';
    $zbp->Config('YtUser')->api_integral = $zbp->host . 'zb_users/plugin/YtUser/common/Integral.php';
    $zbp->Config('YtUser')->api_resetpassword = $zbp->host . 'zb_users/plugin/YtUser/common/resetpassword.php';
    $zbp->Config('YtUser')->api_register = $zbp->host . 'zb_users/plugin/YtUser/common/register.php';
    $zbp->Config('YtUser')->api_upgrade = $zbp->host . 'zb_users/plugin/YtUser/common/Upgrade.php';
    $zbp->Config('YtUser')->api_sbuy = $zbp->host . 'zb_users/plugin/YtUser/common/YtSbuy.php';
    $zbp->Config('YtUser')->api_qqbin = $zbp->host . 'zb_users/plugin/YtUser/login.php';
    $zbp->Config('YtUser')->api_zfbbuy = $zbp->host . 'zb_users/plugin/YtUser/common/cmd.php?act=UploadPst';
    $zbp->Config('YtUser')->api_code = $zbp->host . 'zb_users/plugin/YtUser/common/mobilecode.php';
    $zbp->Config('YtUser')->api_sign = $zbp->host . 'zb_users/plugin/YtUser/common/sign.php';
    $zbp->Config('YtUser')->api_upmobile = $zbp->host . 'zb_users/plugin/YtUser/common/upmobile.php';
    $zbp->Config('YtUser')->api_clipboard = $zbp->host . 'zb_users/plugin/YtUser/common/clipboard.php';
    $zbp->Config('YtUser')->api_favoriteadd = $zbp->host . 'zb_users/plugin/YtUser/common/favoriteadd.php';
    $zbp->Config('YtUser')->api_favoritedel = $zbp->host . 'zb_users/plugin/YtUser/common/favoritedel.php';
    $zbp->SaveConfig('YtUser');
}

function YtUser_Category_Edit_Response()
{
    global $zbp, $cate;
    echo '<table border="1" class="tableFull tableBorder">';
    echo '<tr class="p_block" data-ret="a">
	<td colspan="3" style="text-align: center;">+++++ 用户中心玩法配置 +++++</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>收费方法</b></p></td>
	<td>';
    echo zbpform::radio('meta_showtype', array('无', '登录可见', 'VIP可见', '积分购买', '支付宝购买', '密码访问', '实名会员'), (int) htmlspecialchars($cate->Metas->showtype));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容显示位置</b></p></td>
	<td>';
    echo zbpform::radio('meta_showpay', array('段落后显示', '文章开头', '文章结尾', '自定义', '阅读更多[查看全文]', '全文'), (int) htmlspecialchars($cate->Metas->showpay));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>模式选择</b></p></td>
	<td>';
    echo zbpform::radio('meta_showmode', array('文章模式', '下载站模式', '商城实物商品模式'), (int) htmlspecialchars($cate->Metas->showmode));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容显示段落</b></p></td>
	<td><input type="text" name="meta_seat" style="width:50px;" value="' . (int) htmlspecialchars($cate->Metas->seat) . '" style="width:89%;" /> /* 仅选择 段落后显示 时生效 */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容标题</b></p></td>
	<td><input type="text" name="meta_buyname" style="width:250px;" value="' . htmlspecialchars($cate->Metas->buyname) . '" style="width:89%;" /> /* 比如  付费内容 */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>阅读更多隐藏百分比</b></p></td>
	<td><input type="text" name="meta_viewall" style="width:50px;" value="' . htmlspecialchars($cate->Metas->viewall) . '" style="width:89%;" />% /* 默认50% */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>默认密码</b></p></td>
	<td><input type="text" name="meta_default_password" style="width:150px;" value="' . htmlspecialchars($cate->Metas->default_password) . '" style="width:89%;" /></td>
    </tr>';
    echo '</table>';
    echo '
    <script>
    $(document).on("click", ".p_block", function() {
        var e = $(this).attr("data-ret");
        $(".p_none"+e).toggle();
    });
    </script>
    ';
}
function YtUser_Post_Get($post, $name)
{
    global $zbp;
    $data = null;
    switch ($name) {
        case 'price':
            if ($zbp->user->Level < 5) {
                $data = (int) $post->Metas->price * ($zbp->Config('YtUser')->vipdis / 100);
            } else {
                $data = (int) $post->Metas->price;
            }
            break;
        case 'Buypay':
            $onpay = 0;
            if ($zbp->user->Level > 0 && $zbp->user->Level < 3) {
                $onpay = 1;
            } else {
                $showtype = (int) $post->showtype;
                $showmode = (int) $post->showmode;
                if ($showtype == 0) {
                    $onpay = 0;
                    if ($showmode == 1) {
                        $log = new ytuser_ck();
                        $log->LoadInfoByField('Uid', $zbp->user->ID);
                        $day = strtotime(date('Y-m-d 00:00:00'));
                        if ($log->ID) {
                            if ($log->Time == $day) {
                                $onpay = 1;
                            }
                        }
                    }
                } elseif ($showtype == 1) {
                    if ($zbp->user->Level < 6)
                        $onpay = 1;
                } elseif ($showtype == 2) {
                    if ($zbp->user->onvip)
                        $onpay = 1;
                } elseif ($showtype == 3 || $showtype == 4) {
                    $price = (int) $post->price;
                    if ($price > 0) {
                        $w = array();
                        $w['LogID'] = $post->ID;
                        $w['AuthorID'] = $zbp->user->ID;
                        $userbuy = new YtuserBuy();
                        $userbuy->LoadInfoByFields($w);
                        if ($userbuy->ID) {
                            if ($userbuy->State) {
                                $onpay = 1;
                            }
                        }
                    }
                } elseif ($showtype == 6) {
                    if ($zbp->user->User->Isidcard)
                        $onpay = 1;
                }
            }
            $data = $onpay;
            break;
        case 'paynum':
            $fields = array();
            $fields['LogID'] = $post->ID;
            $fields['State'] = 1;
            $data = ytuser_table_num('ytuser_buy', $fields);
            break;
        case 'pays':
            $userbuy = new YtuserBuy;
            $where = array();
            $where['LogID'] = $post->ID;
            $order = array();
            $order['PostTime'] = "DESC";
            $data = $userbuy->GetList(null, $where);
            break;
        case 'showtype':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->showtype;
            } else {
                $data = (int) $post->Metas->showtype;
            }
            break;
        case 'buyname':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $buyname = $post->Category->Metas->buyname;
            } else {
                $buyname = $post->Metas->buyname;
            }
            if (strlen($buyname)) {
                $data = '<h2 id="buyname">' . $buyname . '：</h2>';
            } else {
                $data = '';
            }
            break;
        case 'showpay':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->showpay;
            } else {
                $data = (int) $post->Metas->showpay;
            }
            break;
        case 'seat':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->seat;
            } else {
                $data = (int) $post->Metas->seat;
            }
            break;
        case 'default_password':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->default_password;
            } else {
                $data = (int) $post->Metas->default_password;
            }
            break;
        case 'showmode':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->showmode;
            } else {
                $data = (int) $post->Metas->showmode;
            }
            break;
        case 'viewall':
            $utypeon = (int) $post->Metas->utypeon;
            if ($utypeon == 0) {
                $data = (int) $post->Category->Metas->viewall;
            } else {
                $data = (int) $post->Metas->viewall;
            }
            break;
        case 'iscollect':
            $data = 0;
            $w = array();
            $w['Pid'] = $post->ID;
            $w['Uid'] = $zbp->user->ID;
            $w['Type'] = 0;
            $favorite = new YtFavorite;
            $favorite->LoadInfoByFields($w);
            if ($favorite->ID)
                $data = 1;
            break;
        case 'islike':
            $data = 0;
            $w = array();
            $w['Pid'] = $post->ID;
            $w['Uid'] = $zbp->user->ID;
            $w['Type'] = 1;
            $favorite = new YtFavorite;
            $favorite->LoadInfoByFields($w);
            if ($favorite->ID)
                $data = 1;
            break;
        case 'likes':
            $fields = array();
            $fields['Pid'] = $post->ID;
            $fields['Type'] = 1;
            $data = ytuser_table_num('ytuser_favorite', $fields);
            break;
        default:
            break;
    }
    if ($data !== null) {
        $GLOBALS['hooks']['Filter_Plugin_Post_Get'][__METHOD__] = PLUGIN_EXITSIGNAL_RETURN;
        return $data;
    }
}

function YtUser_PostArticle_Core(&$article)
{
    global $zbp;
    if ($article->Status == 0) {
        $jf = (int) $zbp->Config('YtUser')->contribute_jf;
        if ($jf > 0) {
            $sum = (int) $article->Metas->Statussum;
            $article->Metas->Statussum = $sum + 1;
            if ($article->Metas->Statussum == 1) {
                $title = $article->Title . "投稿成功,送" . $jf . "积分";
                YtUser_add_coin($article->Author->ID, $article->ID, $jf, $title, 3);
            }
        }
    }
    $showmode = (int) $article->Category->Metas->showmode;
    if ($showmode == 2) {
        $article->Metas->isphysical = 1;
    }
}

function YtUser_DelMember_Succeed($mem)
{
    global $zbp;
    $id = $mem->ID;
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_ytuser'], array(array('=', 'tc_uid', $id)));
    $zbp->db->Delete($sql);
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_buy'], array(array('=', 'buy_AuthorID', $id)));
    $zbp->db->Delete($sql);
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_favorite'], array(array('=', 'fa_uid', $id)));
    $zbp->db->Delete($sql);
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_consume'], array(array('=', 'cs_uid', $id)));
    $zbp->db->Delete($sql);
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_verification'], array(array('=', 'vf_uid', $id)));
    $zbp->db->Delete($sql);
}

function YtUser_Edit_Response5()
{
    global $zbp, $article;
    if ($_GET['act'] == 'PageEdt')
        return;

    $list1 = json_decode($zbp->Config('YtUser')->limit_dirz1, true);
    $list2 = json_decode($zbp->Config('YtUser')->limit_dirz2, true);
    if (!empty($list1)) {
        echo '<table border="1" class="tableFull tableBorder">';
        echo '<tr class="p_ytuserpost" data-ret="post">
            <td colspan="2" style="text-align: center;">+++++  投稿扩展字段 +++++</td>
            </tr>';
        foreach ($list1 as $key => $reg) {
            $name = $list2[$key];
            echo '<tr style="display: none;" class="p_ytecn_post">
                    <td>' . $reg . '</td>
                    <td><input name="meta_' . $name . '" type="text" value="' . $article->Metas->$name . '"></td>
                    </tr>';
        }
        echo '</table>';
        echo '<script>
            $(document).on("click", ".p_ytuserpost", function() {
                var e = $(this).attr("data-ret");
                $(".p_ytecn_"+e).toggle();
            });
            </script>';
    }
}
function YtUser_Edit_Response1()
{
    global $zbp, $article;
    if ($_GET['act'] == 'PageEdt')
        return;
    echo '<table border="1" class="tableFull tableBorder">';
    echo '<tr class="p_block" data-ret="a">
	<td colspan="3" style="text-align: center;">+++++ 用户中心玩法配置 +++++</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td colspan="3">
    <label for="editor_content" class="editinputname">付费内容</label>
    <div id="carea" style="margin:6px 0 0 0;" class="editmod editmod3" >
        <textarea id="editor_buyview" name="meta_buyview" style="width: 100%;height: 100px;margin: 0;padding: 0.5em 0.5em;">' . $article->Metas->buyview . '</textarea>
    </div>
    </td>
    </tr>';
    if ($zbp->Config('YtUser')->isdownload) {
        echo '<tr style="display: none;" class="p_nonea">
        <td class="td30"><p align=\'left\'><b>本地下载地址</b></p></td>
        <td><input type="text" name="meta_downloadurl" style="width:250px;" value="' . htmlspecialchars($article->Metas->downloadurl) . '" style="width:89%;" /></td>
        </tr>';
        echo '<tr style="display: none;" class="p_nonea">
        <td class="td30"><p align=\'left\'><b>网盘下载地址</b></p></td>
        <td><input type="text" name="meta_xzurl" style="width:250px;" value="' . htmlspecialchars($article->Metas->xzurl) . '" style="width:89%;" /></td>
        </tr>';
        echo '<tr style="display: none;" class="p_nonea">
        <td class="td30"><p align=\'left\'><b>网盘密码：</b></p></td>
        <td><input type="text" name="meta_xzmm" style="width:250px;" value="' . htmlspecialchars($article->Metas->xzmm) . '" style="width:89%;" /></td>
        </tr>';
    }
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>玩法模式</b></p></td>
	<td>';
    echo zbpform::radio('meta_utypeon', array('延用分类里面的配置', '这篇我要单独设置'), (int) htmlspecialchars($article->Metas->utypeon));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>收费方法</b></p></td>
	<td>';
    echo zbpform::radio('meta_showtype', array('无', '登录可见', 'VIP可见', '积分购买', '支付宝购买', '密码访问', '实名会员'), (int) htmlspecialchars($article->Metas->showtype));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容显示位置</b></p></td>
	<td>';
    echo zbpform::radio('meta_showpay', array('段落后显示', '文章开头', '文章结尾', '自定义', '阅读更多[查看全文]', '全文'), (int) htmlspecialchars($article->Metas->showpay));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>模式选择</b></p></td>
	<td>';
    echo zbpform::radio('meta_showmode', array('文章模式', '下载站模式', '商城实物商品模式'), (int) htmlspecialchars($article->Metas->showmode));
    echo '</td></tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容显示段落</b></p></td>
	<td><input type="text" name="meta_seat" style="width:50px;" value="' . (int) htmlspecialchars($article->Metas->seat) . '" style="width:89%;" /> /* 仅选择 段落后显示 时生效 */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>付费内容标题</b></p></td>
	<td><input type="text" name="meta_buyname" style="width:250px;" value="' . htmlspecialchars($article->Metas->buyname) . '" style="width:89%;" /> /* 比如  付费内容 */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>阅读更多隐藏百分比</b></p></td>
	<td><input type="text" name="meta_viewall" style="width:50px;" value="' . htmlspecialchars($article->Metas->viewall) . '" style="width:89%;" />% /* 默认50% */</td>
    </tr>';
    echo '<tr style="display: none;" class="p_nonea">
	<td class="td30"><p align=\'left\'><b>默认密码</b></p></td>
	<td><input type="text" name="meta_default_password" style="width:150px;" value="' . htmlspecialchars($article->Metas->default_password) . '" style="width:89%;" /></td>
    </tr>';
    echo '</table>';
    if ($zbp->CheckPlugin('UEditor')) {
        echo '
    <script>
    var editor_api2 = {
        editor: {
            buyview: {
                obj: {},
                get: function () {
                    return ""
                },
                insert: function () {
                    return ""
                },
                put: function () {
                    return ""
                },
                focus: function () {
                    return ""
                }
            }
        }
    };
    editor_api2.editor.buyview.obj=UE.getEditor("editor_buyview");
    editor_api2.editor.buyview.get=function(){return this.obj.getContent()};
    editor_api2.editor.buyview.put=function(str){return this.obj.setContent(str)};
    editor_api2.editor.buyview.focus=function(){return this.obj.focus()};
    editor_api2.editor.buyview.obj.ready(function(){sIntro=editor_api2.editor.buyview.get();});
    </script>';
    }
    echo '
    <script>
    $(document).on("click", ".p_block", function() {
        var e = $(this).attr("data-ret");
        $(".p_none"+e).toggle();
    });
    </script>';
}


function YtUser_Edit_End()
{
    global $zbp;
    if ($zbp->CheckPlugin('TinyMCE')) {
        ?>
        <script>
            tinymce.init({
                selector: "#editor_buyview",
                language: "zh_CN",
            });
        </script>
        <?php
    }
}

function YtUser_Member_Get($member, $name)
{
    global $zbp;
    $data = null;
    switch ($name) {
        case 'sign':
            $todayStartTime = strtotime(date("Y-m-d"));
            $w = array();
            $w[] = array('=', 'vf_type', 1);
            $w[] = array('=', 'vf_uid', $member->ID);
            $w[] = array('>=', 'vf_expiretime', $todayStartTime);
            $sql = $zbp->db->sql->get()->select($zbp->table['ytuser_verification'])
                ->where($w)
                ->count(array('vf_uid' => 'num'))
                ->query;
            $data = (int) $sql[0]['num'];
            break;
        case 'Vip':
            if ($member->Level < 5) {
                $data = 'VIP会员';
            } else {
                $data = '普通会员';
            }
            break;
        case 'Vipendtime':
            $data = 0;
            if ($member->Level == 4) {
                $endtime = (int) $member->User->Vipendtime;
                if ($endtime < time()) {
                    $zbp->db->sql->get()->update($zbp->table['Member'])->where('=', 'mem_ID', $member->ID)->data(array('mem_Level' => 5))->query;
                }
                if ($endtime == 2147483647) {
                    $data = "永久";
                } else {
                    $data = date('Y-m-d H:i:s', (int) $endtime);
                }
            }
            break;
        case 'onvip':
            if ($member->Level < 5) {
                $endtime = (int) $member->User->Vipendtime;
                if ($endtime < time() && $member->Level == 4) {
                    $zbp->db->sql->get()->update($zbp->table['Member'])->where('=', 'mem_ID', $member->ID)->data(array('mem_Level' => 5))->query;
                } else {
                    $data = 1;
                }
            } else {
                $data = 0;
            }
            break;
        case 'Oid':
            $ytuser = new Ytuser();
            $ytuser->LoadInfoByField('Uid', $member->ID);
            $Oid = (int) $ytuser->Oid;
            $data = $Oid;
            break;
        case 'Price':
            $ytuser = new Ytuser();
            $ytuser->LoadInfoByField('Uid', $member->ID);
            $data = (int) $ytuser->Price;
            break;
        case 'Regurl':
            if ($zbp->Config('YtUser')->YtUser_OnRW == 1) {
                $regurl = $zbp->host . $zbp->Config('YtUser')->YtUser_Register_u . $member->ID;
            } else {
                $regurl = $zbp->host . "?Register&u=" . $member->ID;
            }
            $data = $regurl;
            break;
        case 'User':
            $ytuser = new Ytuser();
            $ytuser->LoadInfoByField('Uid', $member->ID);
            $data = $ytuser;
            break;
        default:
            break;
    }

    if ($data !== null) {
        $GLOBALS['hooks']['Filter_Plugin_Member_Get'][__METHOD__] = PLUGIN_EXITSIGNAL_RETURN;
        return $data;
    }

}

function YtUser_Temp(&$templates)
{
    global $zbp;
    if ($zbp->Config('YtUser')->user_template_on == 1) {
        $ytuser_templates = array("t_user_menu", "t_articleedt", "t_articlelist", "t_binding", "t_certifi", "t_breadcrumb", "t_buy", "t_changepassword", "t_commentlist", "t_consume", "t_invite", "t_favorite", "t_footer", "t_header", "t_integral", "t_login", "t_pagebar", "t_paylist", "t_register", "t_resetpassword", "t_resetpwd", "t_top", "t_upgrade", "t_user", "t_useredit", "t_articletop", "t_upmobile");
    } else {
        $ytuser_templates = array();
    }
    $ytuser_theme = 'YtUser';
    foreach ($GLOBALS['hooks']['Filter_Plugin_YtUser_Dmuc'] as $fpname => &$fpsignal) {
        $fpname($ytuser_templates, $ytuser_theme);
    }
    if (is_array($ytuser_templates) && count($ytuser_templates) && $ytuser_theme) {
        foreach ($ytuser_templates as $vo) {
            $zfullname = $zbp->usersdir . 'theme/' . $zbp->theme . '/template/' . $vo . '.php';
            if (file_exists($zfullname)) {
                $templates[$vo] = file_get_contents($zfullname);
            } else {
                $fullname = $zbp->usersdir . 'plugin/' . $ytuser_theme . '/template/' . $vo . '.php';
                $templates[$vo] = file_get_contents($fullname);
            }
        }
    }
}

function YtUser_ViewList(&$template)
{
    $articles = $template->GetTags('articles') ? $template->GetTags('articles') : $template->GetTags('article');
    if (!$articles)
        return;
    if (is_array($articles) && count($articles) > 0) {
        foreach ($articles as $article) {
            YtUser_ViewList_Tags($article, $template);
        }
    } else {
        YtUser_ViewList_Tags($articles, $template);
    }
}
function YtUser_ViewList_Tags(&$article, &$template)
{
    global $zbp;
    ZBlogException::ClearErrorHook();
    $intro = preg_replace("/\[BuyView\](.*?)\[\/BuyView\]/sm", '', $article->Intro);
    $article->Intro = $intro;
}
function YtUser_Admin_Begin()
{
    global $zbp;
    if ($zbp->user->Level > 3) {
        Redirect($zbp->host . $zbp->Config('YtUser')->YtUser_User);
    }
}
function YtUser_RegSucceed(&$member)
{
    global $zbp;
    if ($zbp->Config('YtUser')->inv_on == 1) {
        $rootid = (int) $_COOKIE["uuu"];
        $memberrid = new Member();
        $memberrid->LoadInfoByID($rootid);
        $roodid = $memberrid->ID;
    } else {
        $roodid = 0;
    }
    $ytuser = new Ytuser();
    $ytuser->Uid = $member->ID;
    $ytuser->Oid = 0;
    $ytuser->Price = 0;
    $ytuser->RootID = $roodid;
    $ytuser->Save();
    if ((int) $zbp->Config('YtUser')->inv_zcjifen > 0) {
        $price = (int) $zbp->Config('YtUser')->inv_zcjifen;
        $title = "注册账户送" . $price . "积分";
        YtUser_add_coin($ytuser->Uid, 0, (int) $zbp->Config('YtUser')->inv_zcjifen, $title, 0);
    }
    if ($member->zcprice > 0) {
        $price = (int) $member->zcprice;
        $title = "邀请码注册，送" . $price . "积分";
        YtUser_add_coin($ytuser->Uid, 0, $price, $title, 2);
    }
    if ($ytuser->RootID > 0) {
        $price = (int) $zbp->Config('YtUser')->inv_jifen;
        if ($price > 0) {
            $title = "邀请好友:" . $member->Name . "，奖励" . $price . "积分";
            YtUser_add_coin($ytuser->RootID, 0, $price, $title, 0);
        }
    }
}
function YtUser_DelArticle(&$data)
{
    global $zbp;
    $sql = $zbp->db->sql->Delete($zbp->table['ytuser_buy'], array(array('=', 'buy_LogID', $data->ID)));
    $zbp->db->Delete($sql);
    if ($zbp->user->Level == 1) {
        if ($data->Status == 2) {
            $jf = (int) $zbp->Config('YtUser')->contribute_jf;
            if ($jf < 0) {
                $jf = -$jf;
                $title = $data->Title . "投稿被退回,返还" . $jf . "积分";
                YtUser_add_coin($data->Author->ID, $data->ID, $jf, $title, 0);
            }
        }
    }
}
function YtUser_AddMenu(&$m)
{
    global $zbp;
    $m[] = MakeTopMenu("root", '用户中心', $zbp->host . "zb_users/plugin/YtUser/menu/show.php", "", "topmenu_metro");
    $m[] = MakeTopMenu("root", '购买记录', $zbp->host . "zb_users/plugin/YtUser/menu/buy.php", "", "topmenu_metro");
    $m[] = MakeTopMenu("root", '微信菜单', $zbp->host . "zb_users/plugin/YtUser/menu/wechat_menu_set.php", "", "topmenu_metro");
}
function YtUser_Batch_MemberMng_Main()
{
    global $zbp;
    if ($zbp->CheckRights('root')) {
        Redirect('../../zb_users/plugin/YtUser/common/membermng.php');
    }
}

function YtUser_Html_Js_ZbpConfig()
{
    global $zbp;
    $vg = 'var GV = {
    ROOT: "' . $zbp->host . '",
    WEB_ROOT: "' . $zbp->host . 'zb_users/plugin/YtUser/",
    JS_ROOT: "/style/js/"
};
';
    echo $vg;
}

function YtUser_Main()
{
    global $zbp;
    $zbp->header .= '<link rel="stylesheet" href="' . $zbp->host . 'zb_users/plugin/YtUser/style/ytuser.css" type="text/css" media="screen" />' . "\r\n";
    $zbp->header .= '<script src="' . $zbp->host . 'zb_users/plugin/YtUser/style/js/wind.js"></script>' . "\r\n";
    $zbp->footer .= '<script src="' . $zbp->host . 'zb_users/plugin/YtUser/style/js/frontend.js"></script>' . "\r\n";
}

function YtUser_Filter_Plugin_AlipayPayReturn_Succeed(&$data)
{
    global $zbp;
    echo "支付成功！";
    Redirect($zbp->host);
}
function YtUser_Filter_Plugin_AlipayPayNotice_Succeed(&$data)
{
    global $zbp;
    $LogID = $data['out_trade_no'];
    if (empty($LogID))
        die();
    $userbuy = new YtuserBuy();
    $userbuy->LoadInfoByField('OrderID', $LogID);
    if ($userbuy->ID) {
        $userbuy->State = 1;
        $userbuy->Save();
        if (strlen($LogID) == 33) {
            $vipstate = (int) (substr($LogID, 0, 1));
            $Pricetemp = array('', '2592000', '7776000', '31104000', '3110400000', '100', '200', '300');
            $uid = $userbuy->AuthorID;
            $newtime = $Pricetemp[$vipstate];
            if ($vipstate < 5) {
                $keyvalue = array();
                $keyvalue['mem_Level'] = 4;
                $sql = $zbp->db->sql->Update($zbp->table['Member'], $keyvalue, array(array('=', 'mem_ID', $uid)));
                $zbp->db->Update($sql);
                $ytuser = new Ytuser();
                $ytuser->LoadInfoByField('Uid', $uid);
                if ($ytuser->Vipendtime < time()) {
                    $ytuser->Vipendtime = time() + $newtime;
                } else {
                    $ytuser->Vipendtime = $ytuser->Vipendtime + $newtime;
                }
                if ($ytuser->Vipendtime > 2147483647)
                    $ytuser->Vipendtime = 2147483647;
                $ytuser->Save();
            } else {
                $title = "支付宝充值" . $newtime . "积分";
                YtUser_add_coin($uid, 0, $newtime, $title, 1);
            }
        }
    }
}
function YtUser_Edit()
{
    global $article;
    if ($_GET['act'] == 'PageEdt')
        return;
    echo '<div id="price" class="editmod"><label for="edtIslock" class="editinputname">价格</label><input type="text" name="meta_price" id="price" value="' . (int) $article->Metas->price . '" style="width:180px;"></div>';
    echo '<div id="password" class="editmod"><label for="edtIslock" class="editinputname">密码</label><input type="text" name="meta_password" id="price" value="' . $article->Metas->password . '" style="width:180px;"></div>';
}
function YtUser_Content(&$template)
{
    global $zbp;
    $article = $template->GetTags('article');
    $userid = $article->ID;
    $content = $article->Content;
    $ontype = 0;
    if ($article->Buypay == 1) {
        $ontype = 1;
    }
    $showtype = $article->showtype;
    $buyname = $article->buyname;
    $showpay = $article->showpay;
    $seat = $article->seat;
    $default_password = $article->default_password;
    $showmode = $article->showmode;
    $viewall = $article->viewall;
    $ff = '';
    if ($ontype == 0 && $showmode < 2) {

        if ($showtype == 0 && $showmode == 1) {
            $ff = $buyname . '<form class="js-ajax-form" action="' . $zbp->host . 'zb_users/plugin/YtUser/common/ck.php" method="post" novalidate="novalidate">
            <input type="hidden" name="csrfToken" value="' . $zbp->GetCSRFToken() . '">
            <input type="hidden" name="LogID" id="LogID" value="' . $article->ID . '" />
            <button type="submit" class="js-ajax-submit ytecn_btn">点击查看下载方式</button>
            </form>';
        }


        if ($showtype == 1)
            $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Login . '">请登录后查阅</a>';
        if ($showtype == 2)
            $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Upgrade . '">请开通vip查阅</a>';
        if ($article->price > 0) {
            if ($zbp->user->Level == 6) {
                $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Login . '">请登录购买后查阅</a>';
            } else {
                if ($showtype == 3) {
                    $ff = $buyname . '<form class="js-ajax-form" action="' . $zbp->Config('YtUser')->api_sbuy . '" method="post" novalidate="novalidate">
                        <input type="hidden" name="LogID" id="LogID" value="' . $article->ID . '" />
                        <button class="js-ajax-submit ytecn_btn">本文需' . (int) $article->price . '积分可见</button>
                        </form>';
                } elseif ($showtype == 4) {
                    $ff = $buyname . '<form method="post" action="' . $zbp->Config('YtUser')->api_zfbbuy . '" target="_blank">
                    <input type="hidden" name="LogID" id="LogID" value="' . $article->ID . '" />
                    <input type="hidden" name="token" id="token" value="' . $zbp->GetToken() . '" />
                    <button type="submit" class="ytecn_btn">本文需支付' . $article->price . '元可见</button>
                    </form>';
                }
            }
        }
        if ($showtype == 5) {
            if (isset($_POST['password']) && $_POST['password'] != '') {
                if ($default_password != '') {
                    if (GetVars('password', 'POST') != $default_password) {
                        echo '<script type="text/javascript">alert("密码错误，请重新输入！");window.location="' . $article->Url . '";</script>';
                        die();
                    }
                }
            } else {
                if ($zbp->user->Level == 6) {
                    $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Login . '">请登录后输入密码查阅</a>';
                } else {
                    $ff = $buyname . '<form action="#" method="post" novalidate="novalidate">
                    <p class="ytecn-center"><input placeholder="查阅密码" required="required" type="password" name="password" class="ytecn-input" data-required="on"></p>
                    <p class="ytecn-center"><button type="submit" class="ytecn_btn">查看</button></p>
                    </form>';
                }
            }
        }
        if ($showtype == 6)
            $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Certifi . '">实名认证后可查阅</a>';

    }


    if ($ontype == 0 && $zbp->user->ID && $zbp->Config('YtUser')->sms_upon == 1 && !YtUser_check_mobile($zbp->user->Name))
        $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . $zbp->Config('YtUser')->YtUser_Upmobile . '">请先绑定手机号</a>';

    if ($ontype == 1 && $showmode == 0) {
        $ff = $buyname . $article->Metas->buyview;
    }

    $fz = 0;
    if ($ontype == 1 && $showmode == 1) {
        $ff = $buyname . '<a class="ytecn_btn" href="' . $zbp->host . '?download=' . $article->ID . '" target="_blank">点击下载</a>';
        if ($article->Metas->xzmm) {
            $fz == 1;
            $zbp->footer .= "<script>var clipboard = new ClipboardJS('.urlbtnxzmm', {text: function() {return '" . $article->Metas->xzmm . "';}});</script>" . "\r\n";
            $ff = $ff . '<form class="js-ajax-form" action="' . $zbp->Config('YtUser')->api_clipboard . '" method="post" novalidate="novalidate">
            <p class="ytecn-center"><button type="submit" class="js-ajax-submit ytecn_btn urlbtnxzmm">网盘密码：' . $article->Metas->xzmm . '</button></p>
            </form>';
        }
    }

    if ($showmode == 2) {
        if ($showtype == 3) {
            $ff = '<h2>售价：' . (int) $article->price . '积分</h2>';
            $ff .= '<form class="js-ajax-form" action="' . $zbp->Config('YtUser')->api_sbuy . '" method="post" novalidate="novalidate">
            <input type="hidden" name="LogID" id="LogID" value="' . $article->ID . '" />
            <input type="hidden" name="isphysical" id="isphysical" value="1" />
            <button class="js-ajax-submit ytecn_btn">购买</button>
            </form>';
        }
        if ($showtype == 4) {
            $ff = '<h2>售价：' . (int) $article->price . '元</h2>';
            $ff .= '<form id="edit" name="edit" method="post" action="#">
            <input type="hidden" name="LogID" id="LogID" value="' . $article->ID . '" />
            <input type="hidden" name="isphysical" id="isphysical" value="1" />
            <div class="error"><input class="ytecn_btn" type="submit" value="购买" onclick="return VipRegPage()" /></div></form>
            <script type="text/javascript">function VipRegPage(){document.getElementById("edit").action="' . $zbp->Config('YtUser')->api_zfbbuy . '&token=' . $zbp->GetToken() . '";}</script>';
        }
    }

    if ($showpay == 1)
        $content = $ff . $article->Content;
    if ($showpay == 2)
        $content = $article->Content . $ff;

    if ($showpay == 0) {
        if ($seat == 0)
            $seat = 2;
        $content = ytuser_prefix_insert_post_ads($content, $ff, $seat);
    }

    if ($showpay == 4) {
        if ($ontype == 0) {
            $bili = $viewall ? (int) $viewall : 50;
            $bili = $bili > 99 ? 50 : ($bili < 1 ? 50 : $bili);
            $func_strlen = function_exists('mb_strlen') ? 'mb_strlen' : 'strlen';
            $str_length = $func_strlen($article->Content);
            $show_percent = (100 - $bili) / 100;
            $show_length = round($str_length * $show_percent);
            $func_substr = function_exists('mb_substr') ? 'mb_substr' : 'substr';
            $article->Content = ytuser_dom_element_serialize(ytuser_dom_element_load($func_substr($article->Content, 0, $show_length)));
            $content = $article->Content . $ff;
        } else {
            $content = $article->Content;
        }
    }

    if ($showpay == 5) {
        if ($ontype == 0) {
            $content = $ff;
        } else {
            $content = $article->Content;
        }
    }

    $article->Content = $content;





    if ($zbp->Config('YtUser')->inv_shareshow == 1 && $article->Type == 0) {
        if ($zbp->user->ID > 0) {
            $ontype = 0;
            if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE') {
                $regurl = $article->Url . "?u=" . $zbp->user->ID;
            } else {
                $regurl = $article->Url . "&u=" . $zbp->user->ID;
            }
            $fz == 1;
            $zbp->footer .= "<script>var clipboard = new ClipboardJS('.urlbtn', {text: function() {return '发现一个篇好文章：" . $article->Title . " ，" . $regurl . " ，真的很不错哦。快去看看吧！';}});</script>" . "\r\n";
            $ff = '<h2>分享文章</h2><form class="js-ajax-form" action="' . $zbp->Config('YtUser')->api_clipboard . '" method="post" novalidate="novalidate">
            <p class="ytecn-center"><input value="发现一个篇好文章：' . $article->Title . ' ，' . $regurl . ' ，真的很不错哦。快去看看吧！" class="ytecn-inputmax"></p>
            <p class="ytecn-center"><button type="submit" class="js-ajax-submit ytecn_btn urlbtn">一键复制分享链接</button></p>
            </form>';
            $article->Content = $article->Content . $ff;
        } else {
            $u = (int) GetVars('u', 'GET');
            if ($u > 0) {
                $secure = HTTP_SCHEME == 'https://';
                setcookie("uuu", $u, time() + 86400, $zbp->cookiespath, '', $secure, true);
                if ($zbp->Config('YtUser')->YtUser_OnRW == 1) {
                    $regurl = $zbp->host . $zbp->Config('YtUser')->YtUser_Register_u . $u;
                } else {
                    $regurl = $zbp->host . "?Register&u=" . $u;
                }
                $ff = '<p class="ytecn-center"><a href="' . $regurl . '"><img src="' . $zbp->Config('YtUser')->inv_shareimg . '" ></a></p>';
                $article->Content = $ff . $article->Content;
            }
        }
    }
    if ($fz = 1) {
        $zbp->header .= '<script src="' . $zbp->host . 'zb_users/plugin/YtUser/template/js/clipboard.min.js"></script>' . "\r\n";
    }
    $template->SetTags('article', $article);
}
function YtUser_SyntaxHighlighter_print()
{
    global $zbp;
    $zbp->Load();
    if ($zbp->user->ID) {
        echo '$(function() {var $cpLogin = $(".cp-login").find("a");var $cpVrs = $(".cp-vrs").find("a");$(".cp-hello").html("欢迎 ' . $zbp->user->StaticName . '  <a href=\"' . $zbp->host . $zbp->Config('YtUser')->YtUser_Articleedt . '\">投稿</a> <a href=\"' . BuildSafeCmdURL("act=logout") . '\">退出</a>");$cpLogin.html("会员中心");$cpLogin.attr("href", bloghost + "' . $zbp->Config('YtUser')->YtUser_User . '");$cpVrs.html("评论列表");$cpVrs.attr("href", bloghost + "' . $zbp->Config('YtUser')->YtUser_Commentlist . '");});';
    } else {
        echo '$(function () {$(".cp-login").html("<p><a href=\"' . $zbp->host . $zbp->Config('YtUser')->YtUser_Login . '\">会员登录</a><a href=\"' . $zbp->host . $zbp->Config('YtUser')->YtUser_Register . '\">会员注册</a><p>");$(".cp-vrs").html("<div class=\"ds-login\"></div>");$(".cp-hello").hide();$("#divContorPanel br").hide();$("#divContorPanel").each(function() { var text = String($(this).html()).replace(/&nbsp;/g, "");text = text;$(this).html(text);});});';
    }
}

function InstallPlugin_YtUser()
{
    global $zbp;
    YtUser_CreateTable();
    if (!$zbp->Config('YtUser')->HasKey('dsurl')) {
        $zbp->Config('YtUser')->dsurl = 'zbloguser';
        $zbp->Config('YtUser')->readme_text = '充满吧？';
        $zbp->Config('YtUser')->integral_text = '';
        $zbp->Config('YtUser')->default_level = 4;
        $zbp->Config('YtUser')->vipdis = '100';
        $zbp->Config('YtUser')->payment = 0;
        $zbp->Config('YtUser')->regneedemail = true;
        $zbp->Config('YtUser')->regipdate = true;
        $zbp->Config('YtUser')->login_verifycode = '';
        $zbp->Config('YtUser')->OnRW = 0;
        $zbp->Config('YtUser')->RWURL = 'iPanel';
        $zbp->Config('YtUser')->YtUser_UCenter = '?UCenter';
        $zbp->Config('YtUser')->YtUser_Login = '?Login';
        $zbp->Config('YtUser')->YtUser_Register = '?Register';
        $zbp->Config('YtUser')->YtUser_Articlelist = '?Articlelist';
        $zbp->Config('YtUser')->YtUser_Articlelist_page = '?Articlelist&page=';
        $zbp->Config('YtUser')->YtUser_Articleedt = '?Articleedt';
        $zbp->Config('YtUser')->YtUser_Integral = '?Integral';
        $zbp->Config('YtUser')->YtUser_Invite = '?Invite';
        $zbp->Config('YtUser')->YtUser_buy = '?buy';
        $zbp->Config('YtUser')->YtUser_buy_ID = '?buy&uid=';
        $zbp->Config('YtUser')->YtUser_Upgrade = '?Upgrade';
        $zbp->Config('YtUser')->YtUser_Upgrade_vip = '?Upgrade&vip=';
        $zbp->Config('YtUser')->YtUser_Paylist = '?Paylist';
        $zbp->Config('YtUser')->YtUser_Paylist_page = '?Paylist&page=';
        $zbp->Config('YtUser')->YtUser_User = '?User';
        $zbp->Config('YtUser')->YtUser_UserEdit = '?UserEdit';
        $zbp->Config('YtUser')->YtUser_Commentlist = '?Commentlist';
        $zbp->Config('YtUser')->YtUser_Commentlist_page = '?Commentlist&page=';
        $zbp->Config('YtUser')->YtUser_Resetpwd = '?Resetpwd';
        $zbp->Config('YtUser')->YtUser_Resetpassword = '?Resetpassword';
        $zbp->Config('YtUser')->YtUser_Nameedit = '?Nameedit';
        $zbp->Config('YtUser')->YtUser_Binding = '?Binding';
        $zbp->Config('YtUser')->YtUser_Favorite = '?Favorite';
        $zbp->Config('YtUser')->YtUser_Favorite_page = '?Favorite&page=';
        $zbp->Config('YtUser')->YtUser_Consume = '?Consume';
        $zbp->Config('YtUser')->YtUser_Consume_page = '?Consume&page=';
        $zbp->Config('YtUser')->YtUser_Changepassword = '?Changepassword';
        $zbp->Config('YtUser')->YtUser_Certifi = '?Certifi';
        $zbp->Config('YtUser')->Oncertif = 1;
        $zbp->Config('YtUser')->certifititle = '0';
        $zbp->Config('YtUser')->YtUser_Upmobile = '?Upmobile';
        $zbp->Config('YtUser')->color1 = '2D2B32';
        $zbp->Config('YtUser')->color2 = '111111';
        $zbp->Config('YtUser')->color3 = 'DDDDDD';
        $zbp->Config('YtUser')->color4 = 'CC0000';
        $zbp->Config('YtUser')->color5 = 'FFFFFF';
        $zbp->Config('YtUser')->color6 = 'FAFAFA';
        $zbp->Config('YtUser')->color7 = '5E5E5E';
        $zbp->Config('YtUser')->color8 = '6E6E6E';
        $zbp->Config('YtUser')->upid = 3;
    }
    $zbp->Config('YtUser')->api_changepassword = $zbp->host . 'zb_users/plugin/YtUser/common/changepassword.php';
    $zbp->Config('YtUser')->api_login = $zbp->host . 'zb_users/plugin/YtUser/common/verify.php';
    $zbp->Config('YtUser')->api_certifi = $zbp->host . 'zb_users/plugin/YtUser/common/certifi.php';
    $zbp->Config('YtUser')->api_articleinfo = $zbp->host . 'zb_users/plugin/YtUser/common/articleInfo.php';
    $zbp->Config('YtUser')->api_userinfo = $zbp->host . 'zb_users/plugin/YtUser/common/cmd.php?act=MemberPst';
    $zbp->Config('YtUser')->api_nameedit = $zbp->host . 'zb_users/plugin/YtUser/common/nameedit.php';
    $zbp->Config('YtUser')->api_mailto = $zbp->host . 'zb_users/plugin/YtUser/common/mailto.php';
    $zbp->Config('YtUser')->api_resetpwdto = $zbp->host . 'zb_users/plugin/YtUser/common/resetpwdto.php';
    $zbp->Config('YtUser')->api_buypay = $zbp->host . 'zb_users/plugin/YtUser/common/Ytbuypay.php';
    $zbp->Config('YtUser')->api_integral = $zbp->host . 'zb_users/plugin/YtUser/common/Integral.php';
    $zbp->Config('YtUser')->api_resetpassword = $zbp->host . 'zb_users/plugin/YtUser/common/resetpassword.php';
    $zbp->Config('YtUser')->api_register = $zbp->host . 'zb_users/plugin/YtUser/common/register.php';
    $zbp->Config('YtUser')->api_upgrade = $zbp->host . 'zb_users/plugin/YtUser/common/Upgrade.php';
    $zbp->Config('YtUser')->api_sbuy = $zbp->host . 'zb_users/plugin/YtUser/common/YtSbuy.php';
    $zbp->Config('YtUser')->api_qqbin = $zbp->host . 'zb_users/plugin/YtUser/login.php';
    $zbp->Config('YtUser')->api_zfbbuy = $zbp->host . 'zb_users/plugin/YtUser/common/cmd.php?act=UploadPst';
    $zbp->Config('YtUser')->api_code = $zbp->host . 'zb_users/plugin/YtUser/common/mobilecode.php';
    $zbp->Config('YtUser')->api_sign = $zbp->host . 'zb_users/plugin/YtUser/common/sign.php';
    $zbp->Config('YtUser')->api_upmobile = $zbp->host . 'zb_users/plugin/YtUser/common/upmobile.php';
    $zbp->Config('YtUser')->api_clipboard = $zbp->host . 'zb_users/plugin/YtUser/common/clipboard.php';
    $zbp->Config('YtUser')->api_favoriteadd = $zbp->host . 'zb_users/plugin/YtUser/common/favoriteadd.php';
    $zbp->Config('YtUser')->api_favoritedel = $zbp->host . 'zb_users/plugin/YtUser/common/favoritedel.php';
    $zbp->SaveConfig('YtUser');
}

function UninstallPlugin_YtUser()
{
}