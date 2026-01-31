<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError', 'RespondError', PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {
    $zbp->ShowError(48);
    die();
}
if (!$zbp->user->ID) {
    ytuser_error('请登录账户');
    die();
} else {
    $pid = (int)GetVars('LogID', 'POST');
    $type = (int)GetVars('type', 'POST');
    if ($type == 1) {
        $name = "点赞";
    } else {
        $name = "收藏";
    }
    if (!$pid) {
        ytuser_error('取消' . $name . '失败');
        die();
    }
    $w=array();
    $w['Pid']=$pid;
    $w['Uid']=$zbp->user->ID;
    $w['Type']=$type;
    $favorite = new YtFavorite;
    $favorite->LoadInfoByFields($w);
    if ($favorite->ID) {
        $favorite->Del();
        ytuser_success('操作成功！');
        die();
    }
}
