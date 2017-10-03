<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->user->ID){
    $zbp->ShowError('请登录账户');
    die();
}else{
        $pid = GetVars('LogID', 'POST');
        if(!$pid)   $zbp->ShowError('取消收藏失败');
        $favorite = new YtFavorite;
        $array = $favorite->YtInfoByField('Pid',$pid);
        if ($array) {
            $favorite->Del();
            echo '取消收藏成功';
        }
}