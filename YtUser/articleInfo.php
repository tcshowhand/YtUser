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
    $a->Status = 2;
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
            $zbp->ShowError('标题长度不能大于'.(int)$zbp->Config('YtUser')->certifititle);die();
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
    echo '投稿成功！';
    die();
?>