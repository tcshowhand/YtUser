<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->CheckValidCode(GetVars('verifycode','POST'),'Articleedt')){
    $zbp->ShowError('验证码错误，请重新输入.');die();
}
if(!$zbp->ValidToken(GetVars('token','POST'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
    if(empty($_POST['Title']) || empty($_POST['Content'])){
            $zbp->ShowError('骚年，不要捣乱！！！');die();
    }
if($zbp->user->Level >4){
    $zbp->ShowError('权限不足，请联系网站管理员！');die();
}
    $a = new Post();
    $a->CateID = 0;
    $a->AuthorID = $zbp->user->ID;
    $a->Tag = '';
    $a->Status = 2;
    $a->Type = ZC_POST_TYPE_ARTICLE;
    $a->Alias = '';
    $a->IsTop = false;
    $a->IsLock = false;
    $a->Title = $_POST['Title'];
    $a->Content = $_POST['Content'];
    $a->IP = GetGuestIP();
    $a->PostTime = time();
    $a->CommNums = 0;
    $a->ViewNums = 0;
    $a->Template = '';
    $a->Meta = '';
    $a->Save();
    echo '投稿成功！';die();
?>