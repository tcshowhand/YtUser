<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
if (!$zbp->CheckPlugin('YtUser')) {die();}
if (!$zbp->user->ID) {ytuser_error('请登录账户');header('Location: ' . $zbp->host . '?Login');die();}
$LogID = GetVars('LogID', 'POST');
$post = GetPost((int)$LogID);
$LogID = (int)$post->ID;
if ($LogID == 0) {ytuser_error('产品ID错误');die();}
//获取文章信息
$article = $zbp->GetPostByID($LogID);
$price = (int)$article->price;
if ($price < 1) {
    ytuser_error('订单异常');
    die();
}
$userbuy = new YtuserBuy();
$isphysical = GetVars('isphysical', 'POST');
if ($isphysical == 0) {
    $w = array();
    $w['LogID'] = $LogID;
    $w['AuthorID'] = $zbp->user->ID;
    $userbuy->LoadInfoByFields($w);
    if ($userbuy->ID) {
        if ($userbuy->State) {
            ytuser_success('已付款！');
            die();
        }
    }
}
$userbuy->OrderID = GetGuid();
$userbuy->LogID = $post->ID;
$userbuy->AuthorID = $zbp->user->ID;
$userbuy->Title = $post->Title;
$userbuy->State = 0;
$userbuy->PostTime = time();
$userbuy->IP = GetGuestIP();
$userbuy->Save();
//获取用户信息  	  	     	
$ytuser = new Ytuser();
$ytuser->LoadInfoByField('Uid', $zbp->user->ID);
if (!$ytuser->ID) {
    $ytuser = new Ytuser();
    $ytuser->Uid = $zbp->user->ID;
    $ytuser->Oid = 0;
    $ytuser->Save();
}
//获取作者信息     	   	  	
if (!$article->Author->ID) {
    ytuser_error('作者ID错误');
    die();
}
if ($ytuser->Price - $price < 0) {
    ytuser_error('积分不够，请充值.', $zbp->host . $zbp->Config('YtUser')->YtUser_Integral);
    die();
}
//更新购买表           	   	  
$userbuy->State = 1;
$userbuy->Pay = $price;
$userbuy->Save();

if ($article->Author->ID != $zbp->user->ID) {
    $jf = -$price;
    $title = "购买" . $article->Title . "消费" . $price . "积分";
    YtUser_add_coin($zbp->user->ID, $article->ID, $jf, $title, 3);
    $buypay_on = (int)$zbp->Config('YtUser')->buypay_on;
    if ($buypay_on) {
        $title = "出售" . $article->Title . "获得" . $price . "金币";
        YtUser_add_coin($article->Author->ID, $article->ID, $price, $title, 0);
    }
}
ytuser_success('购买成功！');
die();
