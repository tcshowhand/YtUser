<?php

//实名认证
function YtUser_Certifi() {
    global $zbp;
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="实名认证";
	$article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    $ytuser = new Ytuser();
    $ytuser->YtInfoByField('Uid',$zbp->user->ID);
    if($ytuser->Isidcard==1){
        $article->Content .='待审核';
    }elseif($ytuser->Isidcard==2){
        $article->Content .='已实名';
    }else{
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Certifi" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Certifi&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
    if($ytuser->Isidcard==3){
        $article->Content .='<tr><td style="text-align:right;border:none;">状态：</td><td  style="border:none;" >未通过</td></tr>';
    }
    $article->Content .='<tr><td style="text-align:right;border:none;">(*)姓名：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)身份证号：</td><td  style="border:none;" ><input required="required" type="text" name="idcard" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Certifi()" /></td></tr>';
    $article->Content .='</table>';
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="修改密码";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Changepassword" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Changepassword&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)账户：</td><td  style="border:none;" >'.$zbp->user->Name.'</td></tr>';
	$article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';
    if($zbp->user->Password!='0e681aa506fc191c5f2fa9be6abddd01'){
    $article->Content .='<tr><td style="text-align:right;border:none;">(*)原密码：</td><td  style="border:none;" ><input required="required" type="password" name="password" style="width:250px;font-size:1.2em;" /></td></tr>';
    }
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)重置密码：</td><td  style="border:none;" ><input required="required" type="password" name="newpassword" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)确认密码：</td><td  style="border:none;" ><input required="required" type="password" name="repassword" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="YtUserbnt" type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Changepassword()" /></td></tr>';
	$article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
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

//绑定QQ
function YtUser_Binding() {
    global $zbp;
    if($zbp->user->ID){
    $article = new Post;
	$article->Title="绑定第三方";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	if($zbp->user->Oid!='0'){
	$article->BindingQQ = 1;
	$article->Content .='<tr><td style="text-align:right;border:none;">绑定QQ：</td><td style="border:none;" >已绑定QQ</td></tr>';
	}else{
	$article->BindingQQ = 0;
	$article->Content .='<tr><td style="text-align:right;border:none;">绑定QQ：</td><td style="border:none;" ><a href="'.$zbp->host.'zb_users/plugin/YtUser/login.php" target="_blank">绑定QQ</a></td></tr>';
	}
	$article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    if (substr($zbp->user->Name,0,3) != 'yt_'){
        echo "链接已失效！";die();
    }
	$article = new Post;
	$article->Title="修改账户名（仅一次机会）";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Nameedit" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Nameedit&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)原账户：</td><td  style="border:none;" >'.$zbp->user->Name.'</td></tr>';
	$article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';
    $article->Content .='<tr><td style="text-align:right;border:none;">(*)修改账户：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)确认账户：</td><td  style="border:none;" ><input required="required" type="text" name="rename" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Nameedit()" /></td></tr>';
	$article->Content .='</table>';
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="密码找回";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=resetpwd" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=resetpwd&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)用户名：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" name="email" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="YtUserbnt" type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return resetpwd()" /></td></tr>';
	$article->Content .='</table>';
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
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "评论列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if (!$zbp->user->ID){
        Redirect($zbp->host."?Login");
        die();
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Commentlist{/page/%page%}',false);
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
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
        $page = (int) $page == 0 ? 1 : (int) $page;
        $article = new Post;
        $article->ID = 0;
        $article->Title = "购买列表";
        $article->IsLock = true;
        $article->Type = ZC_POST_TYPE_PAGE;
        if (!$zbp->user->ID){
        	Redirect($zbp->host."?Login");
        	die();
        }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Paylist{/page/%page%}',false);
    }else{
        $p=new Pagebar('{%host%}?Paylist{&page=%page%}',false);
    }
	$p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];
	$p->PageNow=$page;
	$p->PageBarCount=$zbp->pagebarcount;
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
    $op = array('pagebar' => $p);
    $favorite = new YtuserBuy;
    $array = $favorite->GetYtuserBuyList($l,$op);
    foreach ($array as $a) {
        $articles = $zbp->GetPostByID($a->LogID);
            if (!$articles->ID){
                $a->Title='不存在的商品 LogID='.$a->LogID;
            }else{
                $a->Title="购买的产品：".$articles->Title;	
            }
        $a->Intro=$articles->Intro;
        $a->Url=$articles->Url;
        $a->IsTop=0;
        $a->ViewNums=$articles->ViewNums;
        $a->CommNums=$articles->CommNums;
        $a->PostTime=date("Y-m-d H:i:s",$a->PostTime);
        if ($articles->Metas->isphysical){
            $a->isphysical = true;
        }else{
            $a->isphysical = false;
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
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $uid = (int)GetVars('uid', 'GET');
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="支付状态";
	$article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    
    if($uid<1){
        print_r('<h2 style="font-size:60px;margin-bottom:32px;color:f00;">骚年，你在做什么</h2></div>');
        die();
    }
    if($zbp->user->Level<5) $article->Metas->price=$article->Metas->price*$zbp->Config('YtUser')->vipdis*0.01;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Ytbuypay" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Ytbuypay&amp;tm=\'+Math.random();"/>';
    $articles = $zbp->GetPostByID($uid);
    $userbuy=new YtuserBuy();
    $num = $userbuy->YtBuyByField('LogID',$article->ID);
    $article->buynum=$num;
    $article->ID=$articles->ID;
    $article->BuyID=$articles->ID;
    $article->BuyTitle=$articles->Title;
    $article->BuyTUrl=$articles->Url;
    $article->BuyPrice=$articles->Metas->price;
    if($zbp->user->Price<$articles->Metas->price){
        $zbp->user->Price='<a href="'.$zbp->host.'?Integral">账户积分不足请充值！</a>';
    }
    if($zbp->user->ID){
    	$article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';
        $article->Content .='<input type="hidden" name="LogUrl" id="LogUrl" value="'.$article->Url.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr><td style="text-align:right;border:none;">产品：</td><td  style="border:none;" >'.$articles->Title.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">价格：</td><td  style="border:none;" >'.$articles->Metas->price.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">积分余额：</td><td  style="border:none;" >'.$zbp->user->Price.'</td></tr>';
        if($num){
        $article->Content .='<tr><td style="text-align:right;border:none;">状态：</td><td  style="border:none;" >已购买</td></tr>';
        }else{
        if($zbp->Config('YtUser')->payment==0){
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="付款" onclick="return Ytbuypay()" /></td></tr>';
        }else{
        $article->Content .='<form class="ytarticleedt" id="edit" name="edit" method="post" action="#">';
        $article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="支付宝付款" onclick="return VipRegPage()" /></td></tr>';
		$article->Content .='</form>';
        $article->Content .='<script type="text/javascript">function VipRegPage(){document.getElementById("edit").action="'.$zbp->host.'zb_users/plugin/YtUser/cmd.php?act=UploadPst&token='.$zbp->GetToken().'";}</script>';
        }
        }
        $article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="用户积分充值";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Integral" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Integral&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
    	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$zbp->user->Price.'</p></th></tr>';
		$article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->integral_text.'</p></th></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)充值卡：</td><td  style="border:none;" ><input required="required" type="text" name="invitecode" style="width:250px;font-size:1.2em;" />';
		$article->Content .='</td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="YtUserbnt" type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Integral()" /></td></tr>';
		$article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
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
	    Redirect($zbp->host."?Login");
	    die();
    }
    $template = 'index';
    if($zbp->template->hasTemplate('t_articlelist')){
		$template = 't_articlelist';
    }
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "投稿列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){
    $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Articlelist{/page/%page%}',false);
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

//发布投稿
function YtUser_Articleedt() {
    global $zbp;
    if($zbp->CheckRights('ArticlePst')==0){
        Redirect($zbp->host."?Upgrade");die();
    }
    if($zbp->Config('YtUser')->Oncertif){
        $ytuser = new Ytuser();
        $ytuser->YtInfoByField('Uid',$zbp->user->ID);
        if($ytuser->Isidcard!=2){
            Redirect($zbp->host."?Certifi");die();
        }
    }
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="投稿";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Articleedt" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Articleedt&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
        $article->UEditor ='<script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.config.php"></script><script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.all.min.js"></script><textarea name="Content" id="editor_Content" datatype="*"></textarea><script type="text/javascript">var editor = new baidu.editor.ui.Editor({toolbars: [["Source", "bold", "italic", "Undo","Redo"]],initialFrameHeight: 200,});editor.render("editor_Content");editor.sync("Content"); </script>';
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="0" />';
        $article->Content .='<input id="edtType" name="Type" type="hidden" value="0" />';    
        $article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';
        $article->Content .= '<p><span class="title">标题:</span><br><input id="edtTitle" class="edit" size="40" name="Title" type="text"></p>';
        $article->Content .='<p><span class="title">分类:</span><select name="CateID" size="1" class="form-control user_input">'.Yt_Categories(0).'</select></p>';
        $article->Content .= '<span class="title">内容:</span><br>'.$article->UEditor;
        $article->Content .='<p><span class="title">验证码:</span><br><input required="required" name="verifycode" class="edit" size="40" type="text">'.$article->verifycode.'</p>';
        $article->Content .='<p><button onclick="return checkArticleInfo();">确定</button></p>';
    }else{
        Redirect($zbp->host."?Login");die();
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

//消费记录
function YtUser_Consume($page=1) {
    global $zbp;
    $template = 'index';
    if($zbp->template->hasTemplate('t_consume')){
        $template = 't_consume';
    }
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "消费记录";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if (!$zbp->user->ID){
        Redirect($zbp->host."?Login");
        die();
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Consume{/page/%page%}',false);
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
            $a->Url="#";
        }else{
            $a->Url=$articles->Url;
        }
        $a->Intro="";
        $a->IsTop=0;
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    $template = 'index';
    if($zbp->template->hasTemplate('t_favorite')){
        $template = 't_favorite';
    }
    if($zbp->option['ZC_STATIC_MODE'] != 'REWRITE') $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "收藏列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
    if (!$zbp->user->ID){
        Redirect($zbp->host."?Login");
        die();
    }
    if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE'){
        $p=new Pagebar('{%host%}'.$zbp->Config('YtUser')->YtUser_RWURL.'/Favorite{/page/%page%}',false);
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
        Redirect($zbp->host."?User");die();
    }
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    $article = new Post;
    $article->Title="会员登录";
    $article->IsLock=true;
    $article->Type=ZC_POST_TYPE_PAGE;
    if ($zbp->Config('YtUser')->login_verifycode){
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';
    }else{
        $article->verifycode = '';
    }
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
    $article->Content .='<tr><td style="text-align:right;border:none;">账户：</td><td  style="border:none;" ><input required="required" type="text" id="edtUserName" name="edtUserName" value="'.GetVars('username', 'COOKIE').'" style="width:250px;font-size:1.2em;" /></td></tr>';
    $article->Content .='<tr><td style="text-align:right;border:none;">密码：</td><td  style="border:none;" ><input required="required" type="password" id="edtPassWord" name="edtPassWord" style="width:250px;font-size:1.2em;" /></td></tr>';
    if ($zbp->Config('YtUser')->login_verifycode){
    $article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
    }
    $article->Content .='</td></tr>';
    $article->Content .='<tr><td style="text-align:right;border:none;"><input type="checkbox" name="chkRemember" id="chkRemember"  tabindex="3" /></td><td  style="border:none;" >下次自动登录</td></tr>';
    $article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="YtUserbnt" onclick="return Ytuser_Login()" name="loginbtnPost" type="submit" value="登录" class="button" tabindex="4"/><a href="'.$zbp->host.'?Resetpwd">找回密码</a>
    </td></tr>';
    $article->Content .='</table>';
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
    if($zbp->user->Level<3){
        Redirect($zbp->host."zb_system/login.php");
    }
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="用户中心";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
        $article->Content .='<form role="form" action="#" method="POST" id="signup-form"><input id="edtID" name="ID" type="hidden" value="'.$zbp->user->ID.'" />';
        $article->Content .='<input id="edtGuid" name="Guid" type="hidden" value="'.$zbp->user->Guid.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        if($zbp->user->Level < 5){$temp="VIP会员";}else{$temp="普通会员";}
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$temp.' <a href="'.$zbp->host.'?Upgrade" class="">续费VIP</a></p></p></th></tr>';
        if($zbp->user->Level == 4){
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>到期时间:'.$zbp->user->Vipendtime.'</p></p></th></tr>';
        }
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$zbp->user->Price.' <a href="'.$zbp->host.'?Integral" class="">购买积分</a></p></p></th></tr>';
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>修改密码 <a href="'.$zbp->host.'?Changepassword" class="">点击修改</a></p></p></th></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)账户：</td><td  style="border:none;" >'.$zbp->user->Name;
        if (substr($zbp->user->Name,0,3) == 'yt_'){
        $article->Content .='<a href="'.$zbp->host.'?Nameedit">修改账户名（仅一次机会）</a>';
        }
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">(*)昵称：</td><td  style="border:none;" ><input required="required" type="text" id="edtAlias" name="Alias" value="'.$zbp->user->StaticName.'" style="width:250px;font-size:1.2em;" /></td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)收货人：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Rname" name="meta_Rname" value="'.$zbp->user->Metas->Rname.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)电话：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Tel" name="meta_Tel" value="'.$zbp->user->Metas->Tel.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)会员地址：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Add" name="meta_Add" value="'.$zbp->user->Metas->Add.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" id="edtEmail" name="Email" value="'.$zbp->user->Email.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">网站：</td><td  style="border:none;" ><input type="text" id="edtHomePage" name="HomePage" value="'.$zbp->user->HomePage.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)摘要：</td><td  style="border:none;" ><textarea cols="3" rows="6" id="edtIntro" name="Intro" style="width:250px;font-size:1.2em;">'.$zbp->user->Intro.'</textarea>';
	    $article->Content .='</td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
        $article->Content .='<tr><td style="border:none;" ></td><td style="border:none;"><input id="YtUserbnt" onclick="return checkInfo()"  type="submit" value="确定" class="button" tabindex="4"/></td></tr>';
	    $article->Content .='</table></form>';
        $article->js ='';
    }else{
        Redirect($zbp->host."?Login");die();
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

//重置密码
function YtUser_Resetpassword() {
    global $zbp;
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
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
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Resetpassword" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Resetpassword&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)名称：</td><td  style="border:none;" >'.$username.'</td></tr>';
    $article->Content .='<input type="hidden" name="username" id="inpId" value="'.$username.'" />';
    $article->Content .='<input type="hidden" name="hash" id="inpId" value="'.$hash.'" />';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)重置密码：</td><td  style="border:none;" ><input required="required" type="password" name="password" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)确认密码：</td><td  style="border:none;" ><input required="required" type="password" name="repassword" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Resetpassword()" /></td></tr>';
	$article->Content .='</table>';
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
function YtUser_Register() {
    global $zbp;
    if($zbp->user->ID) Redirect($zbp->host."?User");
    if($zbp->Config('YtUser')->open_reg) Redirect($zbp->host."?reg");
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="会员注册";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=register" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=register&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)账户名：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">邮箱：</td><td  style="border:none;" ><input'.($zbp->Config('YtUser')->regneedemail?' required="required"':'').' type="email" id="email" name="email" value="'.GetVars('email', 'COOKIE').'" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)密码：</td><td  style="border:none;" ><input required="required" type="password" name="password" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)确认密码：</td><td  style="border:none;" ><input required="required" type="password" name="repassword" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='</td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="YtUserbnt" type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return register()" /></td></tr>';
	$article->Content .='</table>';
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
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="使用VIP卡";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
    	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        if($zbp->user->Level < 5){$temp="VIP会员";}else{$temp="普通会员";}
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$temp.' </p></th></tr>';
        if($zbp->user->Level == 4){
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>到期时间:'.$zbp->user->Vipendtime.'</p></p></th></tr>';
        }
		$article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->readme_text.'</p></th></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)VIP卡</td><td  style="border:none;" ><input required="required" type="text" name="invitecode" style="width:250px;font-size:1.2em;" />';
		$article->Content .='</td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" id="YtUserbnt" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return RegPage()" /></td></tr>';
		$article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
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