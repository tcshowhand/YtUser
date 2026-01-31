<?php 
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->user->ID){
    ytuser_error('请登录账户');die();
}else{
    $LogID = GetVars('LogID', 'POST');
    if(!$LogID){
        ytuser_error('错误的ID参数');die();
    }     
    $LogID = (int)trim($LogID);
    
    //获取文章信息
    $article = $zbp->GetPostByID($LogID);
    if($article->Buypay==1){
        ytuser_error('已购买');die();
    }

    $Price = (int)$article->price;
    if($Price<1){
        ytuser_error('订单异常');die();
    }

    //获取用户信息
    $ytuser = new Ytuser();
    $ytuser->LoadInfoByField('Uid',$zbp->user->ID);
    if (!$ytuser->ID){
        $ytuser = new Ytuser();
        $ytuser->Uid=$zbp->user->ID;
        $ytuser->Oid=0;
        $ytuser->Save();
    }
     if(!$article->Author->ID){
        ytuser_error('作者ID错误');die();
    }
    if($ytuser->Price - $Price < 0){
        ytuser_error('积分不够，请充值.',$zbp->host.$zbp->Config('YtUser')->YtUser_Integral);die();
    }
    //更新购买表
    $w=array();
    $w['LogID']=$post->ID;
    $w['AuthorID']=$zbp->user->ID;
    $userbuy = new YtuserBuy();
    $userbuy->LoadInfoByFields($w);
    $userbuy->State=1;
    $userbuy->Pay=$Price;
    $userbuy->Save();

    if ($article->Author->ID != $zbp->user->ID){
        //更新用户信息
        $jf=-$Price;
        $title="购买".$article->Title."消费".$Price."积分";
        YtUser_add_coin($zbp->user->ID,$article->ID,$jf,$title,3);
        $buypay_on=(int)$zbp->Config('YtUser')->buypay_on;
        if($buypay_on){
            $title="出售".$article->Title."获得".$Price."金币";
            YtUser_add_coin($article->Author->ID,$article->ID,$Price,$title,0);
        }
    }
    ytuser_success('购买成功！');die();
} 
?>