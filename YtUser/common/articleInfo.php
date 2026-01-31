<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
$con=(int)$zbp->Config('YtUser')->tverifycode_on;
if($con==0 && $zbp->CheckValidCode(GetVars('verifycode','POST'),'Articleedt')){
    ytuser_error('验证码错误，请重新输入.');die();
}
if(!$zbp->ValidToken(GetVars('token','POST'))){
    ytuser_error('权限不足，请联系网站管理员！');die();
}
if(empty($_POST['Title'])){
    ytuser_error('请填写文章标题！！！');die();
}

if(empty($_POST['Content'])){
    ytuser_error('请填写文章内容！！！');die();
}
if($zbp->user->Level > $zbp->Config('YtUser')->contribute_level){
    ytuser_error('权限不足，请联系网站管理员！');die();
}
$jf=(int)$zbp->Config('YtUser')->contribute_jf;
if($jf<0){
    $w=array();
    $w['Uid']=$zbp->user->ID;
    $uuser = new Ytuser();
    $uuser->LoadInfoByFields($w);
    if(($uuser->Price+$jf) < 0){
        ytuser_error('积分不足，无法发布！');die();
    }
}

$a = new Post();
$a->CateID = 0;
if (isset($_POST['CateID'])) {
    $a->CateID = $_POST['CateID'];
}
$a->AuthorID = $zbp->user->ID;
$a->Tag = '';
if (isset($_POST['Tag'])) {
    $_POST['Tag'] = TransferHTML($_POST['Tag'], '[noscript]');
    $_POST['Tag'] = PostArticle_CheckTagAndConvertIDtoString($_POST['Tag']);
    $a->Tag = $_POST['Tag'];
}
$a->Status = (int)$zbp->Config('YtUser')->contribute_status;
$a->Type = ZC_POST_TYPE_ARTICLE;
$a->Alias = '';
if (isset($_POST['Alias'])) {
    $_POST['Alias'] = TransferHTML($_POST['Alias'], '[noscript]');
    $a->Alias = $_POST['Alias'];
}
$a->IsTop = false;
$a->IsLock = false;
$a->Title = TransferHTML($_POST['Title'], '[noscript]');
if((int)$zbp->Config('YtUser')->certifititle > 0){
    if(mb_strwidth($a->Title) > ($zbp->Config('YtUser')->certifititle) ){
        ytuser_error('标题长度不能大于'.(int)$zbp->Config('YtUser')->certifititle);die();
    }
}
$a->Content = '';
$a->Intro = '';
if (isset($_POST['Content'])) {
    $_POST['Content'] = str_replace('<hr class="more" />', '<!--more-->', $_POST['Content']);
    $_POST['Content'] = str_replace('<hr class="more"/>', '<!--more-->', $_POST['Content']);
    $a->Content = $_POST['Content'];
    if (strpos($_POST['Content'], '<!--more-->') !== false) {
        if (isset($_POST['Intro'])) {
            $_POST['Intro'] = GetValueInArray(explode('<!--more-->', $_POST['Content']), 0);
            $a->Intro = $_POST['Intro'];
        }
    }
}
$a->IP = GetGuestIP();
$a->PostTime = time();
$a->CommNums = 0;
$a->ViewNums = 0;
$a->Template = '';
foreach ($_POST as $key => $value) {
    if (substr($key, 0, 5) == 'meta_') {
        $name = substr($key, 5 - strlen($key));
        $a->Metas->$name = $value;
    }
}
$a->Save();
FilterPost($a);
if($jf<0){
    $title=$a->Title."投稿成功,消耗".$jf."积分";
    YtUser_add_coin($zbp->user->ID,$a->ID,$jf,$title,3);
}
ytuser_success('投稿成功！',$zbp->host.$zbp->Config('YtUser')->YtUser_Articlelist);die();
?>