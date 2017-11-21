<?php
function YtUser_page(){
	global $zbp;
    if($zbp->user->ID){
        $ytuser = new Ytuser();
        $array = $ytuser->YtInfoByField('Uid',$zbp->user->ID);
        if($array){
            $zbp->user->Price=$ytuser->Price;
            $zbp->user->Vipendtime=$ytuser->Vipendtime;
            $zbp->user->Oid=$ytuser->Oid;
        }else{
            $zbp->user->Price=0;
            $zbp->user->Vipendtime=0;
            $zbp->user->Oid="0";
        }
        if($zbp->user->Vipendtime < time() && $zbp->user->Level==4){
            $member = new Member;
            $member->LoadInfoByID($zbp->user->ID);
            $member->Level=5;
            $member->Save();
        }
        $zbp->user->Vipendtime=date('Y-m-d H:i:s', (int) $zbp->user->Vipendtime);
    }

    if(!isset($_GET['Changepassword'])){
        if (substr($zbp->user->Name,0,3) != 'yt_' && $zbp->user->Password=='0e681aa506fc191c5f2fa9be6abddd01'){
            Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Changepassword);die();
        }
    }

    //实名认证
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Certifi)===1) {
        YtUser_Certifi();
        die();
    }
    if(isset($_GET['Certifi'])){
        YtUser_Certifi();
        die();
	}
    
    //评论列表
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Commentlist)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Commentlist/page/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_Commentlist($m['id']);
        }
        YtUser_Commentlist();
        die();
    }
	if(isset($_GET['Commentlist'])){
        YtUser_Commentlist();
        die();
    }

    //购买列表
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Paylist)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Paylist/page/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_Paylist($m['id']);
        }
        YtUser_Paylist();
        die();
    }
	if(isset($_GET['Paylist'])){
        YtUser_Paylist();
        die();
    }

    //用户中心
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_User)===1) {
        YtUser_User();
        die();
    }
    if(isset($_GET['User'])){
        YtUser_User();
        die();
	}

    //VIP卡充值
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Upgrade)===1) {
        YtUser_Upgrade();
        die();
    }
	if(isset($_GET['Upgrade'])){
        YtUser_Upgrade();
	    die();
	}

    //支付状态(推荐直接抛弃这个用快捷支付方式)
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_buy)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/buy/uid/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_buy($m['id']);
        }
        YtUser_buy();
        die();
    }
    if(isset($_GET['buy'])){
        YtUser_buy();
        die();
    }

    //积分充值
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Integral)===1) {
        YtUser_Integral();
        die();
    }
    if(isset($_GET['Integral'])){
        YtUser_Integral();
        die();
	}

    //发布投稿
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Articleedt)===1) {
        YtUser_Articleedt();
        die();
    }
    if(isset($_GET['Articleedt'])){
        YtUser_Articleedt();
        die();
	}

    //投稿列表
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Articlelist)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Articlelist/page/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_Articlelist($m['id']);
        }
        YtUser_Articlelist();
        die();
    }
    if(isset($_GET['Articlelist'])){
    YtUser_Articlelist();
    die();
	}

    //注册页面
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Register)===1) {
        YtUser_Register();
        die();
    }
    if(isset($_GET['Register'])){
        YtUser_Register();
	    die();
	}

    //登录页面
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Login)===1) {
        YtUser_Login();
        die();
    }
    if(isset($_GET['Login'])){
        YtUser_Login();
        die();
    }

    //密码找回
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Resetpwd)===1) {
        YtUser_Resetpwd();
        die();
    }
    if(isset($_GET['Resetpwd'])){
        YtUser_Resetpwd();
        die();
    }

    if(isset($_GET['Resetpassword'])){
        YtUser_Resetpassword();
        die();
    }

    //修改账户名
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Nameedit)===1) {
        YtUser_Nameedit();
        die();
    }
    if(isset($_GET['Nameedit'])){
        YtUser_Nameedit();
        die();
    }

    //修改密码
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Changepassword)===1) {
        YtUser_Changepassword();
        die();
    }
    if(isset($_GET['Changepassword'])){
        YtUser_Changepassword();
        die();
    }
    
    //绑定QQ
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Binding)===1) {
        YtUser_Binding();
        die();
    }
	if(isset($_GET['Binding'])){
        YtUser_Binding();
        die();
    }

    //收藏文章
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Favorite)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Favorite/page/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_Favorite($m['id']);
        }
        YtUser_Favorite();
        die();
    }
    if(isset($_GET['Favorite'])){
        YtUser_Favorite();
    }

    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Consume)===1) {
        $url = trim(urldecode($zbp->currenturl), '/');
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Consume/page/{%id%}", 'cate');
        $m   = array();
        preg_match($r, $url, $m);
        if (preg_match($r, $url, $m) == 1) {
            YtUser_Consume($m['id']);
        }
        YtUser_Consume();
        die();
    }
    if(isset($_GET['Consume'])){
        YtUser_Consume();
    }
}