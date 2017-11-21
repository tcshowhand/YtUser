<?php
require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);


    if(!$zbp->user->ID){
	    $zbp->ShowError('请登录账户');
	    header('Location: ' . $zbp->host .'?Login');
	    die();
    }
    $LogID=trim($_POST['LogID']);
    $post=GetPost((int)$LogID);
    $userbuy=new YtuserBuy();
    $array = $userbuy->YtInfoByField('LogID',$LogID);
    if($array){
        if($userbuy->State){
            echo '已付款！';
            die();
        }
    }else{
        $userbuy->OrderID=GetGuid();
        $userbuy->LogID=$post->ID;
        $userbuy->AuthorID=$zbp->user->ID;
        $userbuy->Title=$post->Title;
        $userbuy->State=0;
        $userbuy->PostTime=time();
        $userbuy->IP=GetGuestIP();
        $userbuy->Save();
    }

    $LogID = $post->ID;

    $LogID = trim($_POST['LogID']);
    //获取文章信息
    $article = $zbp->GetPostByID($LogID);
    if($zbp->user->Level<5) $article->Metas->price=$article->Metas->price*$zbp->Config('YtUser')->vipdis*0.01;
    //获取用户信息
    $ytuser = new Ytuser();
    $array=$ytuser->YtInfoByField('Uid',$zbp->user->ID);
    if (!$array){
        $ytuser = new Ytuser();
        $ytuser->Uid=$zbp->user->ID;
        $ytuser->Oid=0;
        $ytuser->Save();
    }

    //获取作者信息
    if(!$article->Author->ID){
        $zbp->ShowError('作者ID错误');
        die();
    }

    if($ytuser->Price - $article->Metas->price < 0){
        $zbp->ShowError('积分不够，请充值.');
        die();
    }

    //更新购买表
    $userbuy->State=1;
    $userbuy->Pay=$article->Metas->price;
    $userbuy->Save();

    if ($article->Author->ID != $zbp->user->ID){
        //更新用户信息
        $ytuser->Price=$ytuser->Price - $article->Metas->price;
        $ytuser->Save();
        $YtConsume = new YtConsume();
        $YtConsume->Uid=$zbp->user->ID;
        $YtConsume->Pid=$article->ID;
        $YtConsume->Time=time();
        $YtConsume->Money=$article->Metas->price;
        $YtConsume->Type=1;
        $YtConsume->Title="购买".$article->Title."消费".$article->Metas->price."金币";
        $YtConsume->Save();
        //更新作者信息
        $ytuser->YtInfoByField('Uid',$article->Author->ID);
        $ytuser->Price=$ytuser->Price + $article->Metas->price;
        $ytuser->Save();
        $YtConsume = new YtConsume();
        $YtConsume->Uid=$article->Author->ID;
        $YtConsume->Pid=$article->ID;
        $YtConsume->Time=time();
        $YtConsume->Money=$article->Metas->price;
        $YtConsume->Type=0;
        $YtConsume->Title="出售".$article->Title."获得".$article->Metas->price."金币";
        $YtConsume->Save();
    }

    echo '购买成功！';
?>