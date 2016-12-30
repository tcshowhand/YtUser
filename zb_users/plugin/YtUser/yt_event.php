<?php
function YtUser_ReplacePre(&$s) {
        global $zbp;
        $s = str_replace('%pre%', $zbp->db->dbpre, $s);
        return $s;
}

function YtUser_SubMenu($id){
    $arySubMenu = array(
        0 => array('网站设置', 'base', 'left', false),
        1 => array('VIP月卡', 'upgrade', 'left', false),
        2 => array('充值卡', 'recharge', 'left', false),
        3 => array('购买记录', 'buy', 'left', false),
        4 => array('检测表', 'testing', 'left', false),
    );
    foreach($arySubMenu as $k => $v){
        echo '<a href="?act='.$v[1].'"><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
    }
}


function YtUser_page(){
	global $zbp;
    if($zbp->user->ID){
        $sql=$zbp->db->sql->Select($GLOBALS['tysuer_Table'],'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
        $array=$zbp->GetListCustom($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'],$sql);
        $num=count($array);
        if($num==0){
	    $Price=0;
        }else{
        $reg=$array[0];
        $Price=$reg->Price;
        }
        $Vipendtime=$reg->Vipendtime;
    }
	
	if(isset($_GET['Commentlist'])){
    $template = 'index';
    if($zbp->template->hasTemplate('Commentlist')){
		$template = 'Commentlist';
	}
    $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "评论列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
	$p=new Pagebar('{%host%}?Commentlist{&page=%page%}{&ischecking=%ischecking%}{&search=%search%}',false);
	$p->PageCount=20;
	$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$p->PageBarCount=$zbp->pagebarcount;
	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
	$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');
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
        $arr=array('ID'=>$articles->Category->ID,'Name'=>$articles->Category->Name);
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
    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewList_Template'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname($zbp->template);
    }
    $zbp->template->Display();
	die();
	}

	if(isset($_GET['Paylist'])){
	$YtUser_buy_Table='%pre%YtUser_buy';
	$YtUser_buy_DataInfo=array(
        'ID' => array('buy_ID', 'integer', '', 0),
        'OrderID' => array('buy_OrderID', 'string', 15, 0),
        'LogID' => array('buy_LogID', 'integer', '', 0),
        'AuthorID' => array('buy_AuthorID', 'integer', '', 0),
        'Title' => array('buy_Title', 'string', 20, ''),
        'State' => array('buy_State', 'integer', '', 0),
        'PostTime' => array('buy_PostTime', 'integer', '', 0),
        'IP' => array('buy_IP', 'string', 15, ''),
	);
    $template = 'index';
    if($zbp->template->hasTemplate('Paylist')){
		$template = 'Paylist';
	}
    $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "评论列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
	$p=new Pagebar('{%host%}?Paylist{&page=%page%}{&ischecking=%ischecking%}{&search=%search%}',false);
	$p->PageCount=20;
	$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$p->PageBarCount=$zbp->pagebarcount;
	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
	$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');

	$sql= $zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=', 'buy_AuthorID', $zbp->user->ID)),'buy_ID ASC',null,null);

	$array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);
    foreach ($array as $a) {
        $articles = $zbp->GetPostByID($a->LogID);
        if ($articles->ID==0) $articles = NULL; 
        $a->Title="购买的产品：".$articles->Title;
        $a->Intro="评论：";
        $a->Url=$articles->Url;
        $a->IsTop=0;
        $a->ViewNums=$articles->ViewNums;
        $a->CommNums=$articles->CommNums;
        $arr=array('ID'=>$articles->Category->ID,'Name'=>$articles->Category->Name);
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
    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewList_Template'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname($zbp->template);
    }
    $zbp->template->Display();
	die();
	}

    if(isset($_GET['User'])){
	$article = new Post;
	$article->Title="用户中心";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	
    if($zbp->user->ID){
        $article->Content .='<form class="ytuseredit" id="edit" method="post" action="#">';
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="'.$zbp->user->ID.'" />';
        $article->Content .='<input id="edtGuid" name="Guid" type="hidden" value="'.$zbp->user->Guid.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$zbp->lang['user_level_name'][$zbp->user->Level].' <a href="'.$zbp->host.'?Upgrade" class="">购买升级会员</a></p></p></th></tr>';
	    if($zbp->user->Level <5){
        if($Vipendtime==0){$temp="永久会员";}else{$temp=date("Y-m-d H:i:s",$Vipendtime);}
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>到期时间:'.$temp.'</p></p></th></tr>';
        }
	    
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$Price.' <a href="'.$zbp->host.'?Integral" class="">购买积分</a></p></p></th></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)用户名：</td><td  style="border:none;" ><input required="required" type="text" id="edtAlias" name="Alias" value="'.$zbp->user->StaticName.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)电话：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Tel" name="meta_Tel" value="'.$zbp->user->Metas->Tel.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)会员地址：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Add" name="meta_Add" value="'.$zbp->user->Metas->Add.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" id="edtEmail" name="Email" value="'.$zbp->user->Email.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">网站：</td><td  style="border:none;" ><input type="text" id="edtHomePage" name="HomePage" value="'.$zbp->user->HomePage.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)摘要：</td><td  style="border:none;" ><textarea cols="3" rows="6" id="edtIntro" name="Intro" style="width:250px;font-size:1.2em;">'.$zbp->user->Intro.'</textarea>';
	    $article->Content .='</td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;<img style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/></td></tr>';
	    $article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><button id="btnPost" onclick="return checkInfo();">确定</button></td></tr>';
	    $article->Content .='</table>';
        $article->Content .='</form>';
        $article->Content .='<script type="text/javascript">function checkInfo(){document.getElementById("edit").action="'.$zbp->host.'zb_users/plugin/YtUser/cmd.php?act=MemberPst&token='.$zbp->GetToken().'";}</script>';
    }else{
        $article->Content .='<h2 style="font-size:60px;margin-bottom:32px;color:f00;">请登录用户</h2></div>';
    }

	$mt=microtime();
	$s=	'';
	$article->Content .=$s;	
    if($zbp->template->hasTemplate('User')){
        $article->Template = 'User';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	die();
	}

	if(isset($_GET['Upgrade'])){
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="使用VIP月卡";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	
    if($zbp->user->ID){
    	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$zbp->lang['user_level_name'][$zbp->user->Level].'</p></p></th></tr>';
        if($zbp->user->Level <5){
        if($Vipendtime==0){$temp="永久会员";}else{$temp=date("Y-m-d H:i:s",$Vipendtime);}
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>到期时间:'.$temp.'</p></p></th></tr>';
        }
		$article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->readme_text.'</p></th></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)VIP月卡</td><td  style="border:none;" ><input required="required" type="text" name="invitecode" style="width:250px;font-size:1.2em;" />';
		$article->Content .='</td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;<img style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/></td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return RegPage()" /></td></tr>';
		$article->Content .='</table>';
    }else{
        $article->Content .='<h2 style="font-size:60px;margin-bottom:32px;color:f00;">请登录用户</h2></div>';
    }
	$mt=microtime();
	$s=	'';
	$article->Content .=$s;	
    if($zbp->template->hasTemplate('Upgrade')){
        $article->Template = 'Upgrade';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['buy'])){
    $uid = (int)GetVars('uid', 'GET');
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="支付状态";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;

    if($uid<1){
        print_r('<h2 style="font-size:60px;margin-bottom:32px;color:f00;">骚年，你在做什么</h2></div>');
        die();
    }
    $articles = $zbp->GetPostByID($uid);
    $sql=$zbp->db->sql->Select($GLOBALS['YtUser_buy_Table'],'*',array(array('=','buy_LogID',$uid),array('=','buy_AuthorID',$zbp->user->ID),array('=','buy_State',1)),null,1,null);
    $array=$zbp->GetListCustom($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo'],$sql);
    $num=count($array);

    if($zbp->user->ID){
    	$article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';
        $article->Content .='<input type="hidden" name="LogUrl" id="LogUrl" value="'.$articles->Url.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr><td style="text-align:right;border:none;">产品：</td><td  style="border:none;" >'.$articles->Title.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">价格：</td><td  style="border:none;" >'.$articles->Metas->price.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">账户余额：</td><td  style="border:none;" >'.$Price.'</td></tr>';
        if($num){
        $article->Content .='<tr><td style="text-align:right;border:none;">状态：</td><td  style="border:none;" >已购买</td></tr>';
        }else{
		$article->Content .='<tr><td style="text-align:right;border:none;">验证码(*)：</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;<img style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Ytbuypay" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Ytbuypay&amp;tm=\'+Math.random();"/></td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="付款" onclick="return Ytbuypay()" /></td></tr>';
		}
        $article->Content .='</table>';
    }else{
        $article->Content .='<h2 style="font-size:60px;margin-bottom:32px;color:f00;">请登录用户</h2></div>';
    }
	$mt=microtime();
	$s=	'';
	$article->Content .=$s;	
    if($zbp->template->hasTemplate('buy')){
        $article->Template = 'buy';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('uid',$uid);
	$zbp->template->SetTags('comments',array());
	foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Integral'])){
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="用户积分充值";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	
    if($zbp->user->ID){
    	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$Price.'</p></th></tr>';
		$article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->integral_text.'</p></th></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)充值卡：</td><td  style="border:none;" ><input required="required" type="text" name="invitecode" style="width:250px;font-size:1.2em;" />';
		$article->Content .='</td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;<img style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Integral" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Integral&amp;tm=\'+Math.random();"/></td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Integral()" /></td></tr>';
		$article->Content .='</table>';
    }else{
        $article->Content .='<h2 style="font-size:60px;margin-bottom:32px;color:f00;">请登录用户</h2></div>';
    }
	$mt=microtime();
	$s=	'';
	$article->Content .=$s;	
    if($zbp->template->hasTemplate('Integral')){
        $article->Template = 'Integral';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Articleedt'])){
	$article = new Post;
	$article->Title="投稿";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    if($zbp->user->ID){
        $article->Content .='<form class="ytarticleedt" id="edit" name="edit" method="post" action="#">';
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="0" />';
        $article->Content .='<input id="edtType" name="Type" type="hidden" value="0" />';    
	    $article->Content .='<p><span class="title">标题:</span><br><input id="edtTitle" class="edit" size="40" name="Title" type="text"></p>';
        $article->Content .='<script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.config.php"></script><script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.all.min.js"></script><div id=\'tarea\' class="editmod editmod3"><span class="title">内容:</span><br><textarea id="editor_intro" name="Content"></textarea></div><script type="text/javascript">var editor_api={editor:{content:{obj:{},get:function(){return ""},insert:function(){return ""},put:function(){return ""},focus:function(){return ""}},intro:{obj:{},get:function(){return ""},insert:function(){return ""},put:function(){return ""},focus:function(){return ""}}}};function editor_init(){editor_api.editor.content.obj=$(\'#editor_content\');editor_api.editor.intro.obj=$(\'#editor_intro\');editor_api.editor.content.get=function(){return this.obj.val()};editor_api.editor.content.put=function(str){return this.obj.val(str)};editor_api.editor.content.focus=function(){return this.obj.focus()};editor_api.editor.intro.get=function(){return this.obj.val()};editor_api.editor.intro.put=function(str){return this.obj.val(str)};editor_api.editor.intro.focus=function(){return this.obj.focus()};sContent=editor_api.editor.content.get();}</script><script type="text/javascript">var EditorIntroOption = {toolbars:[[\'Source\', \'bold\', \'italic\',\'Undo\', \'Redo\']],autoHeightEnabled:false,initialFrameHeight:200};function getContent(){return editor_api.editor.content.get();}function getIntro(){return editor_api.editor.intro.get();}function setContent(s){editor_api.editor.content.put(s);}function setIntro(s){editor_api.editor.intro.put(s);};function editor_init(){editor_api.editor.content.obj=UE.getEditor(\'editor_content\');editor_api.editor.intro.obj=UE.getEditor(\'editor_intro\',EditorIntroOption);editor_api.editor.content.get=function(){return this.obj.getContent()};editor_api.editor.content.put=function(str){return this.obj.setContent(str)};editor_api.editor.content.focus=function(){return this.obj.focus()};editor_api.editor.intro.get=function(){return this.obj.getContent()};editor_api.editor.intro.put=function(str){return this.obj.setContent(str)};editor_api.editor.intro.focus=function(){return this.obj.focus()};editor_api.editor.content.obj.ready(function(){sContent=editor_api.editor.content.get();});editor_api.editor.intro.obj.ready(function(){sIntro=editor_api.editor.intro.get();});$(document).ready(function(){$(\'#edit\').submit(function(){if(editor_api.editor.content.obj.queryCommandState(\'source\')==1) editor_api.editor.content.obj.execCommand(\'source\');if(editor_api.editor.intro.obj.queryCommandState(\'source\')==1) editor_api.editor.intro.obj.execCommand(\'source\');});if (("http://" + bloghost + "/").indexOf(location.host.toLowerCase()) < 0) alert("您设置了域名固化，请使用" + bloghost + "访问或进入后台修改域名，否则图片无法上传。");});}</script><script type="text/javascript">editor_init();</script>';  
        $article->Content .='<p><button id="btnPost" onclick="return checkArticleInfo();">确定</button></p>';
        $article->Content .='</form>';
        $article->Content .='<script type="text/javascript">function checkArticleInfo(){
            document.getElementById("edit").action="'.$zbp->host.'zb_users/plugin/YtUser/cmd.php?act=ArticlePst&token='.$zbp->GetToken().'";isSubmit=true;}</script>';
    }else{
        $article->Content .='<h2 style="font-size:60px;margin-bottom:32px;color:f00;">请登录用户</h2></div>';
    }

	$mt=microtime();
	$s=	'';
	$article->Content .=$s;	
    if($zbp->template->hasTemplate('Articleedt')){
        $article->Template = 'Articleedt';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	die();
	}
    if(isset($_GET['Articlelist'])){
    $template = 'index';
    if($zbp->template->hasTemplate('Articlelist')){
		$template = 'Articlelist';
	}
    $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "投稿列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
	$p=new Pagebar('{%host%}?Articlelist{&page=%page%}{&ischecking=%ischecking%}{&search=%search%}',false);
	$p->PageCount=50;
	$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$p->PageBarCount=$zbp->pagebarcount;
	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
	$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');
    $w=array();
	$w[]=array('=','log_AuthorID',$zbp->user->ID);
	$s='';
	$or=array('log_ID'=>'DESC');
	$l=array(($p->PageNow-1) * $p->PageCount,$p->PageCount);
	$op=array('pagebar'=>$p);
    $array = $zbp->GetArticleList($s, $w, $or, $l, $op, false);
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
}