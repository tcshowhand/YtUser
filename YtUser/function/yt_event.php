<?php
//实名认证        
function YtUser_Certifi() {
    global $zbp;
    if (!$zbp->user->ID){      
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);            
        die(); 
    }
    $article = new Post;           
    $article->Title="实名认证";    	
    $article->IsLock=true;         
    $article->Type=ZC_POST_TYPE_PAGE;      
    $ytuser = new Ytuser();       
    $ytuser->LoadInfoByField('Uid',$zbp->user->ID);           
    if($ytuser->Isidcard==1){
        $article->Content .='待审核';
    }elseif($ytuser->Isidcard==2){
        $article->Content .='已实名';
    }else{
        $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Certifi" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Certifi&amp;tm=\'+Math.random();"/>';
        $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_certifi.'" method="post" novalidate="novalidate">
        <table>';
        if($ytuser->Isidcard==3){ 
            $article->Content .='<tr><td>状态：</td><td  >未通过</td></tr>';             
        }
        $article->Content .='<tr><td>(*)姓名：</td><td  ><input required="required" type="text" name="name" /></td></tr>';             
        $article->Content .='<tr><td>(*)身份证号：</td><td  ><input required="required" type="text" name="idcard" /></td></tr>';           
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';     
        $article->Content .='<tr><td  ></td><td  ><button class="js-ajax-submit"  type="submit" >提交</button></td></tr>';          
        $article->Content .='</table>
        </form>
        ';
    }      
    if($zbp->template->hasTemplate('t_certifi')){           
        $article->Template = 't_certifi';   	
    }     
    $zbp->template->SetTags('title',$article->Title);         
    $zbp->template->SetTags('article',$article);
    $zbp->template->SetTags('type','page');          
    $zbp->template->SetTags('isidcard',$ytuser->Isidcard);        
    $zbp->template->SetTemplate($article->Template);       
    $zbp->template->SetTags('page',1); 
    $zbp->template->SetTags('pagebar',null);          
    $zbp->template->SetTags('comments',array());            
    $zbp->template->Display();
    die();
}
//修改密码     	
function YtUser_Changepassword() {
    global $zbp; 
    if($zbp->user->ID){
        $article = new Post;           
        $article->Title="修改密码";    	
        $article->IsLock=true;  
        $article->Type=ZC_POST_TYPE_PAGE;        
        $article->verifycode ='<img id="verify_img reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Changepassword" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Changepassword&amp;tm=\'+Math.random();"/>';     	
        $article->Content .='<form class="js-ajax-form ytuser_css"  action="'.$zbp->Config('YtUser')->api_changepassword.'" method="post" novalidate="novalidate"><table>';    
        $article->Content .='<tr><td>(*)账户：</td><td  >'.$zbp->user->Name.'</td></tr>';         
        $article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';             
        if($zbp->user->Password!='0e681aa506fc191c5f2fa9be6abddd01'){   	
            $article->Content .='<tr><td>(*)原密码：</td><td  ><input required="required" type="password" name="password" /></td></tr>';     
        }           
        $article->Content .='<tr><td>(*)重置密码：</td><td  ><input required="required" type="password" name="newpassword" /></td></tr>';           
        $article->Content .='<tr><td>(*)确认密码：</td><td  ><input required="required" type="password" name="repassword" /></td></tr>';           
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';            
        $article->Content .='<tr><td  ></td><td><button type="submit" class="js-ajax-submit">提交</button></td></tr>';       
        $article->Content .='</table></form>';           
    }else{
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();            
    }
    if($zbp->template->hasTemplate('t_changepassword')){          
        $article->Template = 't_changepassword';       
    }          
    $zbp->template->SetTags('title',$article->Title);            
    $zbp->template->SetTags('article',$article);     
    $zbp->template->SetTags('type','page');         
    $zbp->template->SetTemplate($article->Template);  
    $zbp->template->SetTags('page',1);            
    $zbp->template->SetTags('pagebar',null);   
    $zbp->template->SetTags('comments',array());  
    $zbp->template->Display();  
    die();            
}

//绑定手机号     	
function YtUser_Upmobile() {
    global $zbp; 
    if (YtUser_check_mobile($zbp->user->Name)) {
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Binding);die();
    }
    if($zbp->user->ID){
        $article = new Post;
        $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=register" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=register&amp;tm=\'+Math.random();"/>';
        $article->captcha ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=captcha" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=captcha&amp;tm=\'+Math.random();"/>';
        $article->Title="绑定手机号";
        $article->IsLock=true;
        $article->Type=ZC_POST_TYPE_PAGE;
        $article->Content .='<form class="js-ajax-form ytuser_css"  action="'.$zbp->Config('YtUser')->api_upmobile.'" method="post" novalidate="novalidate"><input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'"><table>';
        $article->Content .='<tr><td>(*)手机号码：</td><td  ><input required="required" type="text" name="mobile" class="tx-input" id="js-mobile-input"></td></tr>';        
        $article->Content .='<tr><td>验证码</td><td class="yt_captcha_div"><input required="required" type="text" name="captcha" />&nbsp;&nbsp;'.$article->captcha.'</td></tr>';           
        $article->Content .='<tr><td>手机验证码</td><td class="yt_captcha_div"><input required="required" type="text" name="mobilecode" />&nbsp;&nbsp;<a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="'.$zbp->host.'zb_users/plugin/YtUser/common/mobilecode.php" daty-type="register" data-init-second-left="60">获取手机验证码</a></td></tr>';
        $article->Content .='<tr><td  ></td><td><button type="submit" class="js-ajax-submit">提交</button></td></tr>';       
        $article->Content .='</table></form>';
    }else{
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
    }
    if($zbp->template->hasTemplate('t_upmobile')){          
        $article->Template = 't_upmobile';       
    }          
    $zbp->template->SetTags('title',$article->Title);            
    $zbp->template->SetTags('article',$article);     
    $zbp->template->SetTags('type','page');         
    $zbp->template->SetTemplate($article->Template);  
    $zbp->template->SetTags('page',1);            
    $zbp->template->SetTags('pagebar',null);   
    $zbp->template->SetTags('comments',array());  
    $zbp->template->Display();  
    die();            
}

//绑定QQ    
function YtUser_Binding() {
    global $zbp;
    if($zbp->user->ID){
        $article = new Post;  
        $article->Title="绑定第三方";
        $article->IsLock=true;
        $article->Type=ZC_POST_TYPE_PAGE;
        $article->Name=$zbp->user->Name;
        $article->Content .='<table class="ytuser_css">';
        if($zbp->user->Oid!='0'){
            $article->BindingQQ = 1;
            $article->Content .='<tr><td>绑定QQ：</td><td >已绑定QQ</td></tr>';  
        }else{
            $article->BindingQQ = 0;
            $article->Content .='<tr><td>绑定QQ：</td><td ><a href="'.$zbp->host.'zb_users/plugin/YtUser/login.php" target="_blank">绑定QQ</a></td></tr>';    
        }
        if($zbp->Config('YtUser')->sms_on==1){
            if (YtUser_check_mobile($article->Name)) { 
                $article->mobile = 1;
                $article->Content .='<tr><td>绑定手机号：</td><td >已绑定手机号</td></tr>';  
            }else{
                $article->mobile = 0;
                $article->Content .='<tr><td>绑定手机号：</td><td >已绑定手机号</td></tr>';  
            }
        }
        $article->Content .='</table>';
    }else{
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
    }
    if($zbp->template->hasTemplate('t_binding')){
        $article->Template = 't_binding';
    }
    $zbp->template->SetTags('title',$article->Title);
    $zbp->template->SetTags('article',$article);
    $zbp->template->SetTags('type','page');
    $zbp->template->SetTemplate($article->Template);
    $zbp->template->SetTags('page',1);
    $zbp->template->SetTags('pagebar',null);
    $zbp->template->SetTags('comments',array());
    $zbp->template->Display();
    die();   
}            
//修改账户名
function YtUser_Nameedit() {
    global $zbp;           
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    if (substr($zbp->user->Name,0,3) != 'yt_'){      
        echo "链接已失效！";die();        
    }  	
    $article = new Post;    
    $article->Title="修改账户名（仅一次机会）";  
    $article->IsLock=true;     	
    $article->Type=ZC_POST_TYPE_PAGE;     
    $article->verifycode ='<img id="verify_img reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Nameedit" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Nameedit&amp;tm=\'+Math.random();"/>';         
    $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_nameedit.'" method="post" novalidate="novalidate"><table>';           
    $article->Content .='<tr><td>(*)原账户：</td><td  >'.$zbp->user->Name.'</td></tr>'; 
    $article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';  
    $article->Content .='<tr><td>(*)修改账户：</td><td  ><input required="required" type="text" name="name" /></td></tr>';  
    $article->Content .='<tr><td>(*)确认账户：</td><td  ><input required="required" type="text" name="rename" /></td></tr>';  
    $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';        
    $article->Content .='<tr><td  ></td><td ><button type="submit" class="js-ajax-submit">提交</button></td></tr>';            
    $article->Content .='</table></form>';
    if($zbp->template->hasTemplate('t_nameedit')){             
        $article->Template = 't_nameedit';           
    }  
    $zbp->template->SetTags('title',$article->Title); 
    $zbp->template->SetTags('article',$article);      
    $zbp->template->SetTags('type','page');  

    $zbp->template->SetTemplate($article->Template);             
    $zbp->template->SetTags('page',1);       
    $zbp->template->SetTags('pagebar',null);      
    $zbp->template->SetTags('comments',array());            
    $zbp->template->Display();       
    die();           
}
//密码找回
function YtUser_Resetpwd() {
    global $zbp;
    $article = new Post; 
    $article->Title="密码找回"; 
    $article->IsLock=true;     
    $article->Type=ZC_POST_TYPE_PAGE;     
    $article->captcha ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=captcha" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=captcha&amp;tm=\'+Math.random();"/>';
    $article->verifycode ='<img class="verify_img reg_verfiycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=resetpwd" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=resetpwd&amp;tm=\'+Math.random();"/>';           
    $article->Content .='<form class="js-ajax-form ytuser_css"  action="'.$zbp->Config('YtUser')->api_mailto.'" method="post" novalidate="novalidate"><table>';    
    $article->Content .='<tr><td>(*)用户名：</td><td  ><input required="required" type="text" name="name" /></td></tr>';            
    $article->Content .='<tr><td>(*)邮箱：</td><td  ><input type="text" name="email" /></td></tr>';     	
    $article->Content .='<tr><td>(*)</td><td  ><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';        
    $article->Content .='<tr><td  ></td><td  ><button type="submit" class="js-ajax-submit">提交</button></td></tr>';  
    $article->Content .='</table></form>';            
    $mt=microtime();      
    if($zbp->template->hasTemplate('t_resetpwd')){ 
        $article->Template = 't_resetpwd';
    }    
    $zbp->template->SetTags('title',$article->Title);          
    $zbp->template->SetTags('article',$article);    
    $zbp->template->SetTags('type','page');        

    $zbp->template->SetTemplate($article->Template);
    $zbp->template->SetTags('page',1); 
    $zbp->template->SetTags('pagebar',null);     
    $zbp->template->SetTags('comments',array());     
    $zbp->template->Display(); 
    die();            
}
//评论列表         
function YtUser_Commentlist($page=1){
    global $zbp;
    $template = 'index';
    if($zbp->template->hasTemplate('t_commentlist')){
        $template = 't_commentlist';        
    }

    if($zbp->Config('YtUser')->YtUser_OnRW != 1){             
        $page = GetVars('page', 'GET');
    }else{      
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');     
    }     	

    $page = (int) $page == 0 ? 1 : (int) $page;  	
    $article = new Post;
    $article->ID = 0;
    $article->Title = "评论列表";        
    $article->IsLock = true;      
    $article->Type = ZC_POST_TYPE_PAGE;  
    if (!$zbp->user->ID){      
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);            
        die(); 
    }      
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){   
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Commentlist/page/{%page%}',false);        
    }else{     
        $p=new Pagebar('{%host%}?Commentlist{&page=%page%}',false);         
    }      
    $p->PageCount=$zbp->option['ZC_DISPLAY_COUNT'];           
    $p->PageNow=$page;  
    $p->PageBarCount=$zbp->pagebarcount;            
    $w=array();           
    $w[]=array('=','comm_AuthorID',$zbp->user->ID);            
    $w[]=array('=','comm_Ischecking',(int)GetVars('ischecking'));            
    $s='';
    $or=array('comm_ID'=>'DESC'); 
    $l=array(($p->PageNow-1) * $p->PageCount,$p->PageCount);            
    $op=array('pagebar'=>$p);     
    $array=$zbp->GetCommentList($s,$w,$or,$l,$op);           
    foreach ($array as $a) {          
        $articles = $zbp->GetPostByID($a->LogID);    
        if ($articles->ID==0) $articles = NULL;      
        $a->Title="评论主题：".$articles->Title;         
        $a->Intro="评论：".$a->Content; 
        $a->Url=$articles->Url;       
        $a->IsTop=0;
        $a->TopType=0;
        $a->ViewNums=$articles->ViewNums;      
        $a->CommNums=$articles->CommNums;     	
        $arr=array('ID'=>$articles->Category->ID,'Name'=>$articles->Category->Name,'Url'=>$articles->Category->Url);     
        $a->Category=(object)$arr;      
        $arr=array();     	
        $a->Tags=(object)$arr;          
    }
    $mt=microtime();      
    $zbp->template->SetTags('title', $article->Title);           
    $zbp->template->SetTags('article', $article);  
    $zbp->template->SetTags('articles', $array);             
    $zbp->template->SetTags('type', $article->TypeName);            

    $zbp->template->SetTags('page', $page);            
    $zbp->template->SetTags('pagebar', $p);             
    $zbp->template->SetTags('comments', array());           
    if ($zbp->template->hasTemplate($template)) {
        $zbp->template->SetTemplate($template);            
    } else {     
        $zbp->template->SetTemplate('index');
    }    
    $zbp->template->Display();    
    die(); 
}
//购买列表      
function YtUser_Paylist($page=1){
    global $zbp;   
    $template = 'index';        
    if($zbp->template->hasTemplate('t_paylist')){     	
        $template = 't_paylist';         
    }

    if($zbp->Config('YtUser')->YtUser_OnRW != 1){ 
        $page = GetVars('page', 'GET');      
    }else{           
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');           
    }            

    $page = (int) $page == 0 ? 1 : (int) $page;         
    $article = new Post;     
    $article->ID = 0;             
    $article->Title = "购买列表";        
    $article->IsLock = true;  
    $article->Type = ZC_POST_TYPE_PAGE;  	
    if (!$zbp->user->ID){           
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);    
        die();       
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){       
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Paylist/page/{%page%}',false);   
    }else{ 
        $p=new Pagebar('{%host%}?Paylist&page={%page%}',false); 
    }    
    $p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];     
    $p->PageNow=$page; 
    $p->PageBarCount=$zbp->pagebarcount;   
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);        
    $op = array('pagebar' => $p);         
    $favorite = new YtuserBuy;
    $where = array();
    $where['AuthorID']=1;
    $order = array();
    $order['PostTime']="DESC";
    $array = $favorite->GetList(null, $where,$order,$l,$op);         
    foreach ($array as $a) {           
        $articles = $zbp->GetPostByID($a->LogID);     	
        $a->Intro=$articles->Intro;       
        $a->Url=$articles->Url;           
        $a->IsTop=0;
        $a->TopType=0;
        $a->ViewNums=$articles->ViewNums;          
        $a->CommNums=$articles->CommNums;    
        $a->PostTime=date("Y-m-d H:i:s",$a->PostTime);            
        if ($articles->Metas->isphysical){             
            $a->isphysical = true;   
        }else{         
            $a->isphysical = false;         
        }
        if (!$a->LogID){
            $a->Url="";
            $a->PayUrl="";
        }else{
            $a->Url=$articles->Url;
            $a->PayUrl=$zbp->host.$zbp->Config('YtUser')->YtUser_buy.'/uid/'.$a->LogID;
        }
    }           
    $mt=microtime(); 
    $zbp->template->SetTags('title', $article->Title);  
    $zbp->template->SetTags('article', $article);           
    $zbp->template->SetTags('articles', $array);          
    $zbp->template->SetTags('type', $article->TypeName);  
    $zbp->template->SetTags('page', $page);  
    $zbp->template->SetTags('pagebar', $p);           
    $zbp->template->SetTags('comments', array());          
    if ($zbp->template->hasTemplate($template)) {   
        $zbp->template->SetTemplate($template);  
    } else {       
        $zbp->template->SetTemplate('index');   
    }     
    $zbp->template->Display();       
    die();        
}     
//支付状态(推荐直接抛弃这个用快捷支付方式)
function YtUser_buy($uid=0) {
    global $zbp;
    if (!$zbp->user->ID){
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);    
        die();
    }
    if($zbp->Config('YtUser')->YtUser_OnRW != 1){          
        $uid = (int)GetVars('uid', 'GET');    
    }else{  
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $uid = (int)GetVars('uid', 'GET');
    }
    $article = new Post;
    $article->Title="支付状态";
    $article->IsLock=true; 
    $article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="verify_img reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Ytbuypay" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Ytbuypay&amp;tm=\'+Math.random();"/>';      
    $articles = $zbp->GetPostByID($uid);
    if ($articles->price<1 || $articles->Buypay==1){
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Paylist);    
        die();
    }
    $userbuy=new YtuserBuy();
    $num=$article->Buypay;
    $article->ID=$articles->ID;
    $article->BuyID=$articles->ID;
    $article->BuyTitle=$articles->Title;
    $article->BuyTUrl=$articles->Url;
    $article->BuyPrice=$articles->Metas->price;
    if($zbp->user->Price<$articles->Metas->price){
        $zbp->user->Price='<a href="'.$zbp->host.'?Integral">账户积分不足请充值！</a>';
    }
    if($zbp->user->ID){  
        $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_buypay.'" method="post" novalidate="novalidate">';
        $article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';     
        $article->Content .='<input type="hidden" name="LogUrl" id="LogUrl" value="'.$article->Url.'" />';        
        $article->Content .='<table>';          
        $article->Content .='<tr><td>产品：</td><td  >'.$articles->Title.'</td></tr>';          
        $article->Content .='<tr><td>价格：</td><td  >'.$articles->Metas->price.'</td></tr>';      
        $article->Content .='<tr><td>积分余额：</td><td  >'.$zbp->user->Price.'</td></tr>';
        $article->Content .='<tr><td  ></td><td  ><button type="submit" class="js-ajax-submit">付款</button></td></tr>'; 
        $article->Content .='</form>';
        if($num){           
            $article->Content .='<tr><td>状态：</td><td  >已购买</td></tr>';
        }else{            
            if($zbp->Config('YtUser')->payment==1){
                $article->Content .='<form class="ytarticleedt" id="edit" name="edit" method="post" action="#">';     
                $article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';     
                $article->Content .='<tr><td  ></td><td  ><input type="submit" value="支付宝付款" onclick="return VipRegPage()" /></td></tr>'; 
                $article->Content .='</form>';           
                $article->Content .='<script type="text/javascript">function VipRegPage(){document.getElementById("edit").action="'.$zbp->Config('YtUser')->api_zfbbuy.'&token='.$zbp->GetToken().'";}</script>';           
            }           
        }          
        $article->Content .='</table>';         
    }else{            
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();    
    }      
    $mt=microtime();           
    $s=	'';       
    $article->Content .=$s;         
    if($zbp->template->hasTemplate('t_buy')){          
        $article->Template = 't_buy';          
    } 
    $zbp->template->SetTags('title',$article->Title); 
    $zbp->template->SetTags('article',$article);            
    $zbp->template->SetTags('type','page');        
    $zbp->template->SetTemplate($article->Template);             
    $zbp->template->SetTags('page',1);             
    $zbp->template->SetTags('pagebar',null);
    $zbp->template->SetTags('uid',$uid); 
    $zbp->template->SetTags('comments',array());      
    $zbp->template->Display();        
    die();        
}
//积分充值            
function YtUser_Integral() {
    global $zbp;
    $article = new Post;
    $article->Title="用户积分充值";
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img class="verify_img reg_verfiycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Integral" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Integral&amp;tm=\'+Math.random();"/>';    
    if($zbp->user->ID){
        $article->Content .='<form class="js-ajax-form ytuser_css"  action="'.$zbp->Config('YtUser')->api_integral.'" method="post" novalidate="novalidate">';
        $article->Content .='<table>';
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>用户积分:'.$zbp->user->Price.'</p></th></tr>';
        if($zbp->Config('YtUser')->integral_text){
            $article->Content .='<tr style=""><th colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->integral_text.'</p></th></tr>';
        }
        $article->Content .='<tr><td>(*)充值卡：</td><td  ><input required="required" type="text" name="invitecode" />';
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td ></td><td  ><button type="submit" class="js-ajax-submit">提交</button></td></tr>';
        $article->Content .='</table>';
        $article->Content .='</form>';
    }else{  
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();     
    }            
    $mt=microtime();  
    $s=	'';      
    $article->Content .=$s;    
    if($zbp->template->hasTemplate('t_integral')){            
        $article->Template = 't_integral';    
    }   
    $zbp->template->SetTags('title',$article->Title);            
    $zbp->template->SetTags('article',$article);           
    $zbp->template->SetTags('type','page');        

    $zbp->template->SetTemplate($article->Template);  
    $zbp->template->SetTags('page',1);          
    $zbp->template->SetTags('pagebar',null);    
    $zbp->template->SetTags('comments',array());      
    $zbp->template->Display();           
    die();  
}       
//投稿列表          
function YtUser_Articlelist($page=1) {
    global $zbp;       
    if (!$zbp->user->ID){            
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);        
        die();  	
    }
    $template = 'index';
    if($zbp->template->hasTemplate('t_articlelist')){
        $template = 't_articlelist'; 
    }

    if($zbp->Config('YtUser')->YtUser_OnRW != 1){     
        $page = GetVars('page', 'GET');    
    }else{       
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');         
    }         

    $page = (int) $page == 0 ? 1 : (int) $page;  
    $article = new Post;     	
    $article->ID = 0; 
    $article->Title = "投稿列表";   
    $article->IsLock = true;       
    $article->Type = ZC_POST_TYPE_PAGE;            
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){             
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Articlelist/page/{%page%}',false);    
    }else{          
        $p=new Pagebar('{%host%}?Articlelist{&page=%page%}',false);      
    }    
    $p->PageCount=$zbp->option['ZC_DISPLAY_COUNT'];             
    $p->PageNow=$page; 
    $p->PageBarCount=$zbp->pagebarcount;  
    $w=array();         
    $w[]=array('=','log_AuthorID',$zbp->user->ID);        
    $s='';   	
    $or=array('log_Status' => 'DESC', 'log_PostTime' => 'DESC');       
    $l=array(($p->PageNow-1) * $p->PageCount,$p->PageCount);         
    $op=array('pagebar'=>$p);    
    $array = $zbp->GetArticleList($s, $w, $or, $l, $op, false);     
    foreach ($array as $a) {    
        $a->Title=($a->Status == 0 ? '' : '[' . $zbp->lang['post_status_name'][$a->Status] . ']') . $a->Title;            
    }        
    $mt=microtime();  
    $zbp->template->SetTags('title', $article->Title);            
    $zbp->template->SetTags('article', $article);           
    $zbp->template->SetTags('articles', $array);     
    $zbp->template->SetTags('type', $article->TypeName);        
    $zbp->template->SetTags('page', $page); 
    $zbp->template->SetTags('pagebar', $p); 
    $zbp->template->SetTags('comments', array());        
    if ($zbp->template->hasTemplate($template)) {   
        $zbp->template->SetTemplate($template);    
    } else {            
        $zbp->template->SetTemplate('index');             
    }            
    $zbp->template->Display();   	
    die();    
}

function YtUser_Articletop() {    	 		 			
    global $zbp;
    if(!$zbp->user->ID){
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
    }
    $id=(int) GetVars('id', 'GET');
    $title=$zbp->GetPostByID($id)->Title;
    $article = new Post;
    if($zbp->template->hasTemplate('t_articletop')){
        $article->Template = 't_articletop';
    }       
    $zbp->template->SetTags('title',$title);
    $zbp->template->SetTags('aid',$id);
    $zbp->template->SetTags('article',$article);
    $zbp->template->SetTemplate($article->Template);
    $zbp->template->Display();
    die();            			
}


//发布投稿  
function YtUser_Articleedt() {
    global $zbp;
    if($zbp->CheckRights('ArticlePst')==0){
        Redirect($zbp->host."?Upgrade");die();
    }
    if($zbp->Config('YtUser')->Oncertif){
        $ytuser = new Ytuser();
        $ytuser->LoadInfoByField('Uid',$zbp->user->ID);
        if($ytuser->Isidcard!=2){
            Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Certifi);die();
        }
    }
    $article = new Post;
    $article->Title="投稿";
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img class="verify_img verifycode" id="verify_img reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Articleedt" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Articleedt&amp;tm=\'+Math.random();"/>';        
    if($zbp->user->ID){
        $article->UEditor ='<script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.config.php"></script><script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.all.min.js"></script><textarea name="Content" id="editor_Content" datatype="*"></textarea><script type="text/javascript">var editor = new baidu.editor.ui.Editor({toolbars: [["Source", "bold", "italic", "Undo","insertimage","Redo"]],initialFrameHeight: 200,initialFrameWidth: "100%",});editor.render("editor_Content");editor.sync("Content"); </script>';
        $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_articleinfo.'" method="post" novalidate="novalidate">';
        $article->Content .='<table>';
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="0" />';        
        $article->Content .='<input id="edtType" name="Type" type="hidden" value="0" />';  
        $article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';             
        $article->Content .='<p><span class="title">标题:</span><input id="edtTitle" class="edit" size="40" name="Title" type="text"></p>'; 
        $article->Content .='<p><span class="title">分类:</span><select name="CateID" size="1" class="form-control user_input">'.Yt_Categories(0).'</select></p>';        
        $article->Content .= '<span class="title">内容:</span>'.$article->UEditor;  
        $article->Content .='<p><span class="title">验证码:</span><input required="required" name="verifycode" class="edit" size="40" type="text">'.$article->verifycode.'</p>';        
        $article->Content .='<p><button class="js-ajax-submit">确定</button></p></table>';
        $article->Content .='</form>';
    }else{  
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die(); 
    }            
    $mt=microtime();         
    $s=	'';          
    $article->Content .=$s; 
    if($zbp->template->hasTemplate('t_articleedt')){
        $article->Template = 't_articleedt';
    }
    $zbp->template->SetTags('title',$article->Title); 
    $zbp->template->SetTags('article',$article);        
    $zbp->template->SetTags('type','page');          
    $zbp->template->SetTemplate($article->Template);
    $zbp->template->SetTags('page',1);   
    $zbp->template->SetTags('pagebar',null);          
    $zbp->template->SetTags('comments',array()); 
    $zbp->template->Display(); 
}

//邀请好友记录
function YtUser_Invite($page=1) {
    global $zbp;
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/template/js/clipboard.min.js" ></script>' . "\r\n";
    $zbp->footer .="<script>var clipboard = new ClipboardJS('.urlbtn', {text: function() {return '发现一个好玩的网站".$zbp->user->Regurl." ，真的很不错哦。快去看看吧！';}});</script>" . "\r\n";
    $template = 'index';
    if($zbp->template->hasTemplate('t_invite')){
        $template = 't_invite';
    }
    if($zbp->Config('YtUser')->YtUser_OnRW != 1){
        $page = GetVars('page', 'GET');
    }else{
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    }
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "邀请记录";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if (!$zbp->user->ID){
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){    
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Invite/page/{%page%}',false);
    }else{
        $p=new Pagebar('{%host%}?Invite{&page=%page%}',false);
    }
    $p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];
    $p->PageNow=$page;
    $p->PageBarCount=$zbp->pagebarcount; 
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
    $op = array('pagebar' => $p);
    $w=array();
    $w[]=array('=', 'tc_rootid', $zbp->user->ID);
    $array = Ytuser::GetList(null, $w, null, $l, $op);
    foreach ($array as $a) {
        $articles = $zbp->GetMemberByID($a->ID);
        $a->username=$articles->StaticName;
        $a->TopType=0;
        $a->Url='';
        $a->Title=$articles->StaticName;
        $a->Intro='';
        $a->ViewNums='';
        $a->CommNums='';
        $a->usertime=date('Y-m-d H:i:s', (int) $articles->CreateTime);
    }
    $mt=microtime();
    $zbp->template->SetTags('title', $article->Title);
    $zbp->template->SetTags('article', $article);
    $zbp->template->SetTags('articles', $array);
    $zbp->template->SetTags('type', $article->TypeName);
    $zbp->template->SetTags('page', $page);
    $zbp->template->SetTags('pagebar', $p);
    $zbp->template->SetTags('comments', array());
    if ($zbp->template->hasTemplate($template)) {
        $zbp->template->SetTemplate($template);
    } else {
        $zbp->template->SetTemplate('index');
    }
    $zbp->template->Display();
    die();
}
//消费记录
function YtUser_Consume($page=1) {
    global $zbp;
    $template = 'index';
    if($zbp->template->hasTemplate('t_consume')){
        $template = 't_consume';
    }
    if($zbp->Config('YtUser')->YtUser_OnRW != 1){
        $page = GetVars('page', 'GET');
    }else{
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    }
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "消费记录";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if (!$zbp->user->ID){
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){    
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Consume/page/{%page%}',false);
    }else{
        $p=new Pagebar('{%host%}?Consume{&page=%page%}',false);
    }
    $p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];
    $p->PageNow=$page;
    $p->PageBarCount=$zbp->pagebarcount; 
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
    $op = array('pagebar' => $p);
    $favorite = new YtConsume;
    $array = $favorite->GetConsumeList($l,$op);
    foreach ($array as $a) {
        $articles = $zbp->GetPostByID($a->Pid);
        if (!$articles->ID){
            $a->Url="";
        }else{
            $a->Url=$articles->Url;
        }
        $a->Intro="";
        $a->IsTop=0;
        $a->TopType=0;
        $a->ViewNums=$articles->ViewNums;
        $a->CommNums=$articles->CommNums;
    }
    $mt=microtime();
    $zbp->template->SetTags('title', $article->Title);
    $zbp->template->SetTags('article', $article);
    $zbp->template->SetTags('articles', $array);
    $zbp->template->SetTags('type', $article->TypeName);
    $zbp->template->SetTags('page', $page);
    $zbp->template->SetTags('pagebar', $p);
    $zbp->template->SetTags('comments', array());
    if ($zbp->template->hasTemplate($template)) {
        $zbp->template->SetTemplate($template);
    } else {
        $zbp->template->SetTemplate('index');
    }
    $zbp->template->Display();
    die();
}

//文章收藏列表      
function YtUser_Favorite($page=1) {
    global $zbp;
    $template = 'index';  
    if($zbp->template->hasTemplate('t_favorite')){        
        $template = 't_favorite';   
    }           

    if($zbp->Config('YtUser')->YtUser_OnRW != 1){ 
        $page = GetVars('page', 'GET');    	
    }else{          
        if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');  
    }     

    $page = (int) $page == 0 ? 1 : (int) $page;           
    $article = new Post;             
    $article->ID = 0;   	
    $article->Title = "收藏列表";         
    $article->IsLock = true;         
    $article->Type = ZC_POST_TYPE_PAGE;            
    if (!$zbp->user->ID){             
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);        
        die();   
    }     
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){        
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Favorite/page/{%page%}',false);    
    }else{      
        $p=new Pagebar('{%host%}?Favorite{&page=%page%}',false);      
    }         
    $p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];         
    $p->PageNow=$page;      
    $p->PageBarCount=$zbp->pagebarcount;   
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount); 
    $op = array('pagebar' => $p);  
    $favorite = new YtFavorite;     	
    $array = $favorite->GetFavoriteList($l,$op);   
    foreach ($array as $a) {            
        $articles = $zbp->GetPostByID($a->Pid);  
        if (!$articles->ID){          
            $a->Title='已删除的文章 ID='.$a->Pid;
        }else{ 	
            $a->Title=$articles->Title;
        }          
        $a->Intro=$articles->Intro;            
        $a->Content=$articles->Content;  
        $a->Status=$articles->Status;    
        $a->Url=$articles->Url;	   	
        $a->IsTop=0;
        $a->TopType=0;
        $a->ViewNums=$articles->ViewNums;    
        $a->CommNums=$articles->CommNums;            
    }   
    $mt=microtime();            
    $zbp->template->SetTags('title', $article->Title);         
    $zbp->template->SetTags('article', $article);    
    $zbp->template->SetTags('articles', $array);  	
    $zbp->template->SetTags('type', $article->TypeName);       
    $zbp->template->SetTags('page', $page);         
    $zbp->template->SetTags('pagebar', $p);     	
    $zbp->template->SetTags('comments', array());
    if ($zbp->template->hasTemplate($template)) {     
        $zbp->template->SetTemplate($template);        
    } else {
        $zbp->template->SetTemplate('index');        
    }  
    $zbp->template->Display();  
    die();          
}
//登录页面
function YtUser_Login() {
    global $zbp;  
    if($zbp->user->ID){  
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_User);die();          
    }
    $article = new Post;        
    $article->Title="会员登录";     
    $article->IsLock=true;      
    $article->Type=ZC_POST_TYPE_PAGE;     
    if ($zbp->Config('YtUser')->login_verifycode){ 
        $article->verifycode ='<img id="verify_img reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';          
    }else{         
        $article->verifycode = '';            
    }  
    $article->Content .='<form class="js-ajax-form ytuser_css"  action="'.$zbp->Config('YtUser')->api_login.'" method="post" novalidate="novalidate"><table>';     
    $article->Content .='<tr><td>账户：</td><td  ><input required="required" type="text" id="edtUserName" name="username" value="'.GetVars('username', 'COOKIE').'" /></td></tr>';    
    $article->Content .='<tr><td>密码：</td><td  ><input required="required" type="password" id="edtPassWord" name="password" /></td></tr>';      
    if ($zbp->Config('YtUser')->login_verifycode){
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';         
    }         
    $article->Content .='</td></tr>';     
    $article->Content .='<tr><td><input type="checkbox" name="chkRemember" id="chkRemember"  tabindex="3" /></td><td  >下次自动登录</td></tr>';
    $article->Content .='<tr><td  ></td><td  ><button type="submit" id="loginbtnPost" name="loginbtnPost"  class="js-ajax-submit button">登录</button><a href="'.$zbp->host.'?Resetpwd">找回密码</a>
    </td></tr>';
    $article->Content .='</table></form>';     
    if($zbp->Config('YtUser')->appkey !=""){
        $article->Content .='使用其它帐号登录：<a href="'.$zbp->host.'zb_users/plugin/YtUser/login.php" class="">QQ登录</a>';             
    }     
    if($zbp->template->hasTemplate('t_login')){
        $article->Template = 't_login';        
    }             
    $zbp->template->SetTags('title',$article->Title);          
    $zbp->template->SetTags('article',$article); 
    $zbp->template->SetTags('type','page');

    $zbp->template->SetTemplate($article->Template);  
    $zbp->template->SetTags('page',1);     
    $zbp->template->SetTags('pagebar',null);     	
    $zbp->template->SetTags('comments',array());       
    $zbp->template->Display();     
}
//会员中心首页        
function YtUser_User() {
    global $zbp;          
    if($zbp->user->Level>2){
        if($zbp->Config('YtUser')->sms_upon){
            if (!YtUser_check_mobile($zbp->user->Name)) {
                Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Upmobile);die();
            }
        }
    }
    $article = new Post;
    if ($zbp->Config('YtUser')->YtUser_OnRW == 1){
        $regurl=$zbp->host.$zbp->Config('YtUser')->YtUser_Register_u.$zbp->user->ID;
    }else{
        $regurl=$zbp->host."?Register&u=".$zbp->user->ID;
    }
    $article->Regurl=$regurl;
    $article->Title="用户中心";  
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;            
    $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';       
    if($zbp->user->ID){
        $article->Content .='<table class="ytuser_css">';             
        if($zbp->user->Level < 5){$temp="VIP会员";}else{$temp="普通会员";}   
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>用户级别:'.$temp.' <a href="'.$zbp->host.'?Upgrade" class="">续费VIP</a></p></th></tr>';       
        if($zbp->user->Level == 4){
            $article->Content .='<tr style=""><th colspan="2" scope="col"><p>到期时间:'.$zbp->user->Vipendtime.'</p></th></tr>';            
        }
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>用户积分:'.$zbp->user->Price.' <a href="'.$zbp->host.'?Integral" class="">购买积分</a></p></th></tr>';   
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>修改密码 <a href="'.$zbp->host.'?Changepassword" class="">点击修改</a></p></th></tr>';       
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>邀请链接 <a href="'.$regurl.'" class="">'.$regurl.'</a></p></th></tr>';  
        $article->Content .='<tr><td>(*)账户：</td><td  >'.$zbp->user->Name;             
        if (substr($zbp->user->Name,0,3) == 'yt_'){     	
            $article->Content .='<a href="'.$zbp->host.'?Nameedit">修改账户名（仅一次机会）</a>';           
        }         
        $article->Content .='</td></tr>';
        $article->Content .='</table></form>';
        $article->js ='';
    }else{        
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();        
    }   
    $mt=microtime();             
    $s=	'';    
    $article->Content .=$s;	
    if($zbp->template->hasTemplate('t_user')){
        $article->Template = 't_user';         
    }else{  
        $zbp->footer.=$article->js;            
    }         
    $zbp->template->SetTags('title',$article->Title);      
    $zbp->template->SetTags('article',$article);     	
    $zbp->template->SetTags('type','page');         
    $zbp->template->SetTemplate($article->Template);        
    $zbp->template->SetTags('page',1);     
    $zbp->template->SetTags('pagebar',null);       
    $zbp->template->SetTags('comments',array());    
    $zbp->template->Display();      
}


function YtUser_UserEdit() {
    global $zbp;          
    if($zbp->user->Level>2){
        if($zbp->Config('YtUser')->sms_upon){
            if (!YtUser_check_mobile($zbp->user->Name)) {
                Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Upmobile);die();
            }
        }
    }
    $article = new Post;
    if ($zbp->Config('YtUser')->YtUser_OnRW == 1){
        $regurl=$zbp->host.$zbp->Config('YtUser')->YtUser_Register_u.$zbp->user->ID;
    }else{
        $regurl=$zbp->host."?Register&u=".$zbp->user->ID;
    }
    $article->Regurl=$regurl;
    $article->Title="用户中心";  
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;            
    $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';       
    if($zbp->user->ID){
        $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_userinfo.'" method="post" novalidate="novalidate"><input id="edtID" name="ID" type="hidden" value="'.$zbp->user->ID.'" />';          
        $article->Content .='<input id="edtGuid" name="Guid" type="hidden" value="'.$zbp->user->Guid.'" />'; 
        $article->Content .='<input id="token" name="token" type="hidden" value="'.$zbp->GetToken().'" />';
        $article->Content .='<table>';
        $article->Content .='<tr><td>(*)昵称：</td><td  ><input required="required" type="text" id="edtAlias" name="Alias" value="'.$zbp->user->StaticName.'" /></td></tr>';
        $article->Content .='<tr><td>(*)收货人：</td><td  ><input required="required" type="text" id="meta_Rname" name="meta_Rname" value="'.$zbp->user->Metas->Rname.'" /></td></tr>';        
        $article->Content .='<tr><td>(*)电话：</td><td  ><input required="required" type="text" id="meta_Tel" name="meta_Tel" value="'.$zbp->user->Metas->Tel.'" /></td></tr>';             
        $article->Content .='<tr><td>(*)会员地址：</td><td  ><input required="required" type="text" id="meta_Add" name="meta_Add" value="'.$zbp->user->Metas->Add.'" /></td></tr>';            
        $article->Content .='<tr><td>(*)邮箱：</td><td  ><input type="text" id="edtEmail" name="Email" value="'.$zbp->user->Email.'" /></td></tr>';
        $article->Content .='<tr><td>网站：</td><td  ><input type="text" id="edtHomePage" name="HomePage" value="'.$zbp->user->HomePage.'" /></td></tr>';  
        $article->Content .='<tr><td>(*)摘要：</td><td  ><textarea cols="3" rows="6" id="edtIntro" name="Intro">'.$zbp->user->Intro.'</textarea>';           
        $article->Content .='</td></tr>';       
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';           
        $article->Content .='<tr><td ></td><td><button class="js-ajax-submit"  type="submit" tabindex="4">提交</button></td></tr>'; 
        $article->Content .='</table></form>';        
        $article->js ='';
    }else{        
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();        
    }   
    $mt=microtime();             
    $s=	'';    
    $article->Content .=$s;	

    if($zbp->template->hasTemplate('t_useredit')){     	
        $article->Template = 't_useredit';         
    }else{  
        $zbp->footer.=$article->js;            
    }         
    $zbp->template->SetTags('title',$article->Title);      
    $zbp->template->SetTags('article',$article);     	
    $zbp->template->SetTags('type','page');         
    $zbp->template->SetTemplate($article->Template);        
    $zbp->template->SetTags('page',1);     
    $zbp->template->SetTags('pagebar',null);       
    $zbp->template->SetTags('comments',array());    
    $zbp->template->Display();      
}


//重置密码
function YtUser_Resetpassword() {
    global $zbp;
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    if (isset($_GET["username"])) {
        $username=TransferHTML($_GET['username'], '[noscript]');
    }else{
        echo "链接已失效！";die();
    }
    if (isset($_GET["hash"])) {
        $hash=TransferHTML($_GET['hash'], '[noscript]');
    }else{
        echo "链接已失效！";die();
    }
    if(!YtUser_password_verify_emailhash($username,$hash)){
        echo "链接已失效!！";die();     
    }
    $article = new Post;       
    $article->Title="重置密码";     
    $article->IsLock=true;    
    $article->Type=ZC_POST_TYPE_PAGE;  
    $article->username=$username;    
    $article->hash=$hash;        
    $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Resetpassword" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Resetpassword&amp;tm=\'+Math.random();"/>';  
    $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_resetpassword.'" method="post" novalidate="novalidate">'; 
    $article->Content .='<table>'; 
    $article->Content .='<tr><td>(*)名称：</td><td  >'.$username.'</td></tr>';  
    $article->Content .='<input type="hidden" name="username" id="inpId" value="'.$username.'" />';            
    $article->Content .='<input type="hidden" name="hash" id="inpId" value="'.$hash.'" />';  	
    $article->Content .='<tr><td>(*)重置密码：</td><td  ><input required="required" type="password" name="password" /></td></tr>';       
    $article->Content .='<tr><td>(*)确认密码：</td><td  ><input required="required" type="password" name="repassword" /></td></tr>';         
    $article->Content .='<tr><td>(*)</td><td  ><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';         
    $article->Content .='<tr><td  ></td><td ><button class="js-ajax-submit"  type="submit" tabindex="4">提交</button></td></tr>';    
    $article->Content .='</table>';
    $article->Content .='</form>';
    if($zbp->template->hasTemplate('t_resetpassword')){   	
        $article->Template = 't_resetpassword';    
    }    
    $zbp->template->SetTags('title',$article->Title);     
    $zbp->template->SetTags('article',$article);        
    $zbp->template->SetTags('type','page');
    $zbp->template->SetTemplate($article->Template);    
    $zbp->template->SetTags('page',1);          
    $zbp->template->SetTags('pagebar',null);  
    $zbp->template->SetTags('comments',array());        
    $zbp->template->Display();       
    die();      
}
//注册页面            
function YtUser_Register($u=0) {
    global $zbp;     
    if($zbp->user->ID) Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_User);    
    if($zbp->Config('YtUser')->open_reg) Redirect($zbp->host."?reg");      
    $article = new Post;   	
    if($zbp->Config('YtUser')->inv_on == 1){    
        if($zbp->Config('YtUser')->YtUser_OnRW != 1){          
            $u = GetVars('u', 'GET');      
        }else{
            if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $u = GetVars('u', 'GET');     
        }
        if(empty($zbp->GetMemberByID($u)->ID)){      
            $u=0;
        }else{  
            $u=(int)$zbp->GetMemberByID($u)->ID;
        }    
        if($zbp->Config('YtUser')->inv_oneon==1){        
            if($u==0){   	
            Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();  
            }     	
        }        
    }else{
        $u=0;  
    } 

    $secure = HTTP_SCHEME == 'https://';
    setcookie("uuu", $u, time()+86400, $zbp->cookiespath, '', $secure, true);
    $article->u=$u; 
    $article->Title="会员注册";
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=register" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=register&amp;tm=\'+Math.random();"/>';
    $article->captcha ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=captcha" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=captcha&amp;tm=\'+Math.random();"/>';
    
    $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_register.'" method="post" novalidate="novalidate">';
    $article->Content .='<table>';
    if($zbp->Config('YtUser')->sms_on == 1){    
        $article->Content .='<tr><td>(*)手机号码：</td><td  ><input required="required" type="text" name="mobile" class="tx-input" id="js-mobile-input"></td></tr>';        
        $article->Content .='<tr><td>验证码</td><td class="yt_captcha_div"><input required="required" type="text" name="captcha" />&nbsp;&nbsp;'.$article->captcha.'</td></tr>';           
        $article->Content .='<tr><td>手机验证码</td><td class="yt_captcha_div"><input required="required" type="text" name="mobilecode" />&nbsp;&nbsp;<a class="btn btn-success js-get-mobile-code" data-wait-msg="[second]秒后才能再次获取" data-mobile-input="#js-mobile-input" data-url="'.$zbp->host.'zb_users/plugin/YtUser/common/mobilecode.php" daty-type="register" data-init-second-left="60">获取手机验证码</a></td></tr>';
    }else{        
        $article->Content .='<tr><td>(*)账户名：</td><td  ><input required="required" type="text" name="name" /></td></tr>';     
    }
    $article->Content .='<tr><td>邮箱：</td><td  ><input'.($zbp->Config('YtUser')->regneedemail?' required="required"':'').' type="email" id="email" name="email" value="'.GetVars('email', 'COOKIE').'" /></td></tr>';   
    $article->Content .='<tr><td>(*)密码：</td><td  ><input required="required" type="password" name="password" /></td></tr>';     
    $article->Content .='<tr><td>(*)确认密码：</td><td  ><input required="required" type="password" name="repassword" /></td></tr>';         
    $article->Content .='</td></tr>';   
    if($zbp->Config('YtUser')->inv_on == 1){   	
        $article->Content .='<input type="hidden" name="rootid" id="rootid" value="'.$u.'" />';      
    }        
    if($zbp->Config('YtUser')->sms_on == 0){         
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';             
    }
    $article->Content .='<tr><td ></td><td  ><button class="js-ajax-submit"  type="submit" tabindex="4">提交</button></td></tr>';      
    $article->Content .='</table></form>';           
    if($zbp->Config('YtUser')->appkey !=""){            
        $article->Content .='使用其它帐号登录：<a href="'.$zbp->host.'zb_users/plugin/YtUser/login.php" class="">QQ登录</a>';
    }         
    $mt=microtime();       
    if($zbp->template->hasTemplate('t_register')){           
        $article->Template = 't_register';    
    }            
    $zbp->template->SetTags('title',$article->Title);            
    $zbp->template->SetTags('article',$article);
    $zbp->template->SetTags('type','page');      
    $zbp->template->SetTemplate($article->Template);        
    $zbp->template->SetTags('page',1); 
    $zbp->template->SetTags('pagebar',null);         
    $zbp->template->SetTags('comments',array());       
    $zbp->template->Display();         
}
//使用VIP充值卡        
function YtUser_Upgrade(){
    global $zbp;
    $article = new Post;      
    $article->Title="使用VIP卡";           
    $article->IsLock=true;       
    $article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/>';       
    if($zbp->user->ID){
        $article->Content .='<form class="js-ajax-form ytuser_css" action="'.$zbp->Config('YtUser')->api_upgrade.'" method="post" novalidate="novalidate">'; 
        $article->Content .='<table>';
        if($zbp->user->Level < 5){$temp="VIP会员";}else{$temp="普通会员";}
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>用户级别:'.$temp.' </p></th></tr>';         
        if($zbp->user->Level == 4){
            $article->Content .='<tr style=""><th colspan="2" scope="col"><p>到期时间:'.$zbp->user->Vipendtime.'</p></p></th></tr>';         
        }
        $article->Content .='<tr style=""><th colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->readme_text.'</p></th></tr>';         
        $article->Content .='<tr><td>(*)VIP卡</td><td  ><input required="required" type="text" name="invitecode" />';     
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td>(*)</td><td class="yt_captcha_div"><input required="required" type="text" name="verifycode" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td ></td><td ><button class="js-ajax-submit"  type="submit" tabindex="4">提交</button></td></tr>';   	
        $article->Content .='</table>';
        $article->Content .='</form>';
    }else{
        Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();       
    }
    $mt=microtime();
    $s=	'';    	
    $article->Content .=$s;      
    if($zbp->template->hasTemplate('t_upgrade')){       
        $article->Template = 't_upgrade';   
    } 
    $zbp->template->SetTags('title',$article->Title);          
    $zbp->template->SetTags('article',$article);    
    $zbp->template->SetTags('type','page');         
    $zbp->template->SetTemplate($article->Template);     
    $zbp->template->SetTags('page',1);         
    $zbp->template->SetTags('pagebar',null);             
    $zbp->template->SetTags('comments',array());       
    $zbp->template->Display();      
}

function YtUser_codeimg($name='register'){
    global $zbp;
    echo '<img class="verify_img verifycode" id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id='.$name.'" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id='.$name.'&amp;tm=\'+Math.random();"/>';
}
    
