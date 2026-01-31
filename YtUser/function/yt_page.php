<?php
function YtUser_page(){        
	global $zbp;
    $hasKey = $zbp->db->ExistColumn($zbp->table['ytuser_ytuser'], 'tc_vip');
    if(!$hasKey){
      $zbp->db->sql->get()->ALTER($zbp->table['ytuser_ytuser'])
      ->ADDCOLUMN('tc_vip integer DEFAULT \'0\'')
      ->ADDCOLUMN('tc_cknum integer DEFAULT \'0\'')
      ->ADDCOLUMN('tc_cktime integer DEFAULT \'0\'')
      ->query;
    }
    
    $uid=(int)$zbp->user->ID;
    
    if($uid==0){
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($ua, 'MicroMessenger') !== false && !$zbp->user->ID) {
            $current_url = GetRequestUri();
            if (strpos($current_url, 'login_wechat') === false && 
                strpos($current_url, 'login') === false && 
                strpos($current_url, 'register') === false &&
                strpos($current_url, 'cmd.php') === false && 
                strpos($current_url, 'verify.php') === false && 
                !isset($_GET['code'])) {
                
                $appid = $zbp->Config('YtUser')->wechat_appid;
                if (!empty($appid)) {
                    $redirect_uri = urlencode($zbp->host . "zb_users/plugin/YtUser/login_wechat.php");
                    $state = base64_encode($current_url);
                    $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
                    Redirect($url);
                }
            }
        }
    }

    if(isset($_GET['download'])){
        if(!$zbp->user->ID){
            Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
        }
        $pid = GetVars('download', 'GET');
        $post=GetPost((int)$pid);    	
        if($post->AuthorID){
            $ver=new YtVerification();
            $array=$ver->YtTypeCount(5);  
            if($post->Buypay==2){ 
                $zsum=(int)$zbp->Config('YtUser')->downloadzsum;
                if($zsum>0){
                    if($ver->Count > $zsum){    
                        echo "每天仅能下载".$zbp->Config('YtUser')->downloadzsum."次!!!";
                        die();
                    }
                }
            }
            if($post->Metas->xzurl){
                header('Location: '.$post->Metas->xzurl);
                die();
            }
            if($array){       
                $todayStartTime = strtotime(date("Y-m-d")); 
                if ($ver->Expire <= $todayStartTime) {    
                    $ver->Count = 1;               
                    $ver->Expire=time(); 
                } else {       
                    $ver->Count=$ver->Count+1;    	
                }
                $sum=(int)$zbp->Config('YtUser')->downloadsum;
                if($sum>0){
                    if($ver->Count > $sum){    
                        echo "每天仅能下载".$zbp->Config('YtUser')->downloadsum."次!!!";
                        die();
                    }
                }
                $ver->Send=time();            
            }else{              
                $ver->Uid=$zbp->user->ID;  	
                $ver->Count=1;                
                $ver->Send=time();         
                $ver->Expire=time();        
                $ver->IP=GetGuestIP();      
                $ver->Type=5;     
            }          
            $ver->Save();              
            $file = $post->Metas->downloadurl;        
            $file =str_replace($zbp->host,"./",$file);  	
            $cnt = file_get_contents($file);    
            header("Content-type: application/octet-stream");      
            header("Accept-Ranges: bytes");          
            header("Accept-Length: " . filesize($file));           
            header("Content-Disposition: attachment; filename=" . basename($file)); 
            echo $cnt;
        }
        die();
	}

    //修改密码
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Changepassword)===1) {
        if (substr($zbp->user->Name,0,3) != 'yt_' && $zbp->user->Password=='0e681aa506fc191c5f2fa9be6abddd01'){
        YtUser_Changepassword();
        die();
        }
    }

    // if(!isset($_GET['Changepassword'])){   
    //     if (substr($zbp->user->Name,0,3) != 'yt_' && $zbp->user->Password=='0e681aa506fc191c5f2fa9be6abddd01'){
    //         YtUser_Changepassword();
    //         die();
    //     }
    // }

    //绑定手机号
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Upmobile)===1) {
        YtUser_Upmobile();
        die();
    }

    if(isset($_GET['Upmobile'])){         
        YtUser_Upmobile();               
        die();       
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
    
    //修改资料
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_UserEdit)===1) {
        YtUser_UserEdit();
        die();
    }
    if(isset($_GET['UserEdit'])){
        YtUser_UserEdit();
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
        YtUser_Integral();die();
    }
    if(isset($_GET['Integral'])){
        YtUser_Integral();die();
	}

    //邀请好友
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Invite)===1) {
        YtUser_Invite();die();
    }
    if(isset($_GET['Invite'])){
        YtUser_Invite();die();
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

    if(isset($_GET['Articletop'])){         
        YtUser_Articletop();
        die();
	}

    //注册页面            
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,$zbp->Config('YtUser')->YtUser_Register_u)===1) { 
        $url = trim(urldecode($zbp->currenturl), '/');            
        $r   = UrlRule::OutputUrlRegEx("{%host%}".$zbp->Config('YtUser')->YtUser_RWURL."/Register/u/{%id%}", 'cate');             
        $m   = array();         
        preg_match($r, $url, $m);    
        if (preg_match($r, $url, $m) == 1) {     
            YtUser_Register($m['id']);       
            die();               
        }    
        YtUser_Register();   
        die();      
    }        
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