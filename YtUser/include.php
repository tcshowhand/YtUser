<?php
DefinePluginFilter('Filter_Plugin_RegPage_RegSucceed');
DefinePluginFilter('Filter_Plugin_YtUser_Dmuc');
#用户中心插件
include 'function/usertable.php';
include 'function/yt_is_login.php';
include 'function/yt_event.php';
include 'function/yt_page.php';
RegisterPlugin("YtUser","ActivePlugin_YtUser");

function ActivePlugin_YtUser() {
    Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','YtUser_Main');
    Add_Filter_Plugin('Filter_Plugin_Index_Begin','YtUser_page');
    Add_Filter_Plugin('Filter_Plugin_Html_Js_Add', 'YtUser_SyntaxHighlighter_print');
    Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu', 'YtUser_AddMenu');
    Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','YtUser_Content');
    Add_Filter_Plugin('Filter_Plugin_ViewList_Template','YtUser_ViewList');
    Add_Filter_Plugin('Filter_Plugin_Edit_Response3','YtUser_Edit');
    Add_Filter_Plugin('Filter_Plugin_Admin_MemberMng_SubMenu','YtUser_Batch_MemberMng_Main');
    Add_Filter_Plugin('Filter_Plugin_AlipayPayNotice_Succeed','YtUser_Filter_Plugin_AlipayPayNotice_Succeed');
    Add_Filter_Plugin('Filter_Plugin_AlipayPayReturn_Succeed','YtUser_Filter_Plugin_AlipayPayReturn_Succeed');
    Add_Filter_Plugin('Filter_Plugin_DelArticle_Succeed','YtUser_DelArticle');
    Add_Filter_Plugin('Filter_Plugin_RegPage_RegSucceed','YtUser_RegSucceed');
    Add_Filter_Plugin('Filter_Plugin_Admin_Begin','YtUser_Admin_Begin');
    Add_Filter_Plugin('Filter_Plugin_Login_Header','YtUser_Login_Header');
    Add_Filter_Plugin('Filter_Plugin_Autoload','YtUser_Autoload');
    Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate','YtUser_Temp');
    Add_Filter_Plugin('Filter_Plugin_ViewSearch_Begin','YtUser_ViewSearch_Begin');
    Add_Filter_Plugin('Filter_Plugin_Member_Call', 'YtUser_Member_HelloWorld');
    Add_Filter_Plugin('Filter_Plugin_Post_Call', 'YtUser_Post_HelloWorld');
    AutoloadClass('ytuser');
    AutoloadClass('ytuserbuy');
    AutoloadClass('yt_favorite');
    AutoloadClass('ytconsume');
}


function YtUser_Post_HelloWorld($member,$method, $args){
    global $zbp;
    if($method == 'Favorite'){
        $GLOBALS['hooks']['Filter_Plugin_Post_Call']['YtUser_Post_HelloWorld']=PLUGIN_EXITSIGNAL_RETURN;
        $favorite = new YtFavorite;
        $array = $favorite->YtInfoByField('Pid',$member->ID);
        if ($array) {
            return 1;
        }else{
            return 0;
        }
    }
}

function YtUser_Member_HelloWorld($member,$method, $args){
    global $zbp;
    if($method == 'YtUser'){
        $GLOBALS['hooks']['Filter_Plugin_Member_Call']['YtUser_Member_HelloWorld']=PLUGIN_EXITSIGNAL_RETURN;
        $ytuser = new Ytuser();
        $ytuser->YtInfoByField('Uid',$zbp->user->ID);
        if($args[0] == 'Vipendtime'){
            return date('Y-m-d H:i:s', (int) $ytuser->$args[0]);
        }else{
            return $ytuser->$args[0];
        }
    }
}

function YtUser_ViewSearch_Begin(){
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
}

function Yt_Categories($default) {
    global $zbp;

    foreach ($GLOBALS['hooks']['Filter_Plugin_OutputOptionItemsOfCategories'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname($default);
        if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {$fpsignal = PLUGIN_EXITSIGNAL_NONE;return $fpreturn;}
    }

    $s = null;
    foreach ($zbp->categoriesbyorder as $id => $cate) {
        $s .= '<option ' . ($default == $cate->ID ? 'selected="selected"' : '') . ' value="' . $cate->ID . '">' . $cate->SymbolName . '</option>';
    }

    return $s;
}

function YtUser_Temp(&$templates) {
  global $zbp;
  $ytuser_templates = array("t_articleedt", "t_articlelist", "t_binding", "t_breadcrumb", "t_buy", "t_changepassword", "t_commentlist", "t_consume", "t_favorite", "t_footer", "t_header", "t_integral", "t_login", "t_nameedit", "t_pagebar", "t_paylist", "t_register", "t_resetpassword", "t_resetpwd", "t_sider", "t_top", "t_upgrade", "t_user");
  $ytuser_theme = 0;
  foreach ($GLOBALS['hooks']['Filter_Plugin_YtUser_Dmuc'] as $fpname => &$fpsignal) {
    $fpname($ytuser_templates,$ytuser_theme);
  }
  if( is_array($ytuser_templates) && count($ytuser_templates) && $ytuser_theme ){
    foreach($ytuser_templates as $vo){
        $fullname=$zbp->usersdir .'plugin/'.$ytuser_theme.'/template/'.$vo.'.php';
        $templates[$vo] = file_get_contents($fullname);
    }
  }
}

function YtUser_ViewList(&$template){
    $articles=$template->GetTags('articles')?$template->GetTags('articles'):$template->GetTags('article');
    if(!$articles) return;
    if(is_array($articles)&&count($articles)>0){
        foreach($articles as $article){
            YtUser_ViewList_Tags($article,$template);
        }
    }else{
        YtUser_ViewList_Tags($articles,$template);
    }
}

function YtUser_ViewList_Tags(&$article,&$template){
    global $zbp;    
    ZBlogException::ClearErrorHook();
    $intro = preg_replace("/\[BuyView\](.*?)\[\/BuyView\]/sm",'',$article->Intro);
    $article->Intro=$intro;
}

function YtUser_Autoload(&$classname){
    global $zbp;
    if($classname == 'ytuser'){
        if (is_readable($f = ZBP_PATH . 'zb_users/plugin/YtUser/function/lib/' . strtolower($classname) . '.php')) {
            require $f;
        }
    }
    if($classname == 'ytuserbuy'){
        if (is_readable($f = ZBP_PATH . 'zb_users/plugin/YtUser/function/lib/' . strtolower($classname) . '.php')) {
            require $f;
        }
    }
    if($classname == 'yt_favorite'){
        if (is_readable($f = ZBP_PATH . 'zb_users/plugin/YtUser/function/lib/' . strtolower($classname) . '.php')) {
            require $f;
        }
    }
    if($classname == 'ytconsume'){
        if (is_readable($f = ZBP_PATH . 'zb_users/plugin/YtUser/function/lib/' . strtolower($classname) . '.php')) {
            require $f;
        }
    }
}

function YtUser_Login_Header(){
    global $zbp;
    if($zbp->Config('YtUser')->login_user){
        Redirect($zbp->host."?User");
    }
}

function YtUser_Admin_Begin(){
    global $zbp;
    if($zbp->user->Level>3){
        Redirect($zbp->host."?User");
    }
}

function YtUser_RegSucceed(&$member){
    $ytuser = new Ytuser();
    $ytuser->Uid=$member->ID;
    $ytuser->Oid=0;
    $ytuser->Save();
}

function YtUser_DelArticle(&$data){
    global $zbp;
    $sql = $zbp->db->sql->Delete($GLOBALS['YtUser_buy_Table'],array(array('=','buy_LogID',$data->ID)));
    $zbp->db->Delete($sql);
}

function YtUser_AddMenu(&$m) {
	global $zbp;
	$m[] = MakeTopMenu("root", '用户中心', $zbp->host . "zb_users/plugin/YtUser/menu/base.php", "", "topmenu_metro");
}

function YtUser_Batch_MemberMng_Main(){
    global $zbp;
    if ($zbp->CheckRights('root')) {
        Redirect('../../zb_users/plugin/YtUser/membermng.php');
    }
}
function YtUser_Main(){
	global $zbp;
    if($zbp->user->ID){}else{$zbp->header .=  '<link rel="stylesheet" type="text/css" href="'.$zbp->host.'zb_users/plugin/YtUser/ytuser.css"/>' . "\r\n";}
}

function YtUser_Filter_Plugin_AlipayPayReturn_Succeed(&$data){
    global $zbp;
    echo "支付成功！";
    Redirect($zbp->host);
}

function YtUser_Filter_Plugin_AlipayPayNotice_Succeed(&$data){
    global $zbp;
    $LogID=$data['out_trade_no'];
	$keyvalue=array();
	$keyvalue['buy_State']=1;
    $sql = $zbp->db->sql->Update($GLOBALS['YtUser_buy_Table'],$keyvalue,array(array('=','buy_OrderID',$LogID)));
    $zbp->db->Update($sql);
}

function YtUser_Edit(){
	global $article;
	echo '<div id="price" class="editmod"><label for="edtIslock" class="editinputname">价格</label><input type="text" name="meta_price" id="price" value="'.(int)$article->Metas->price.'" style="width:180px;"></div>';
	echo '<div id="isphysical" class="editmod"><label for="edtIslock" class="editinputname">实物商品</label><input id="isphysical" name="meta_isphysical" type="text" class="checkbox" value="'.(int)$article->Metas->isphysical.'"></div>';
	$buybutton = '[BuyView]付费内容[/BuyView]';
    echo '<div id="price" class="editmod"><label for="edtIslock" class="editinputname">YtUser快捷操作:</label><a style="cursor: pointer;" onclick="editor_api.editor.content.obj.execCommand(\'insertHtml\',\''.$buybutton.'\');">购买按钮</a><br><a style="cursor: pointer;" onclick="editor_api.editor.content.obj.execCommand(\'insertHtml\', \'[BuyView]\');">[BuyView]</a>付费内容<a style="cursor: pointer;" onclick="editor_api.editor.content.obj.execCommand(\'insertHtml\', \'[/BuyView]\');">[/BuyView]</a></div>';
}

function YtUser_Content(&$template){
    global $zbp;
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/ytjs.php" type="text/javascript"></script>' . "\r\n";
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/js/layui/layui.all.js" type="text/javascript"></script>' . "\r\n";
    $article = $template->GetTags('article');
    $content = $article->Content;
    $userid = $article->ID;
    $article->Buypay = 0;
    if($article->Type==ZC_POST_TYPE_ARTICLE){
        if($zbp->user->Level>2){
        if((int)$article->Metas->price > 0){
        $userbuy=new YtuserBuy();
        $array = $userbuy->YtBuyByField('LogID',$article->ID);
            if($array){
                $article->Buypay = 1;
                $content = preg_replace("/\[(.*?)BuyView\]/sm",'',$content);
            }else{
                $content.= '<input type="hidden" name="LogID" id="LogID" value="'.$userid.'" />';
                if($zbp->Config('YtUser')->payment==0){
                if($zbp->user->Level<5) $article->Metas->price=$article->Metas->price*(int)$zbp->Config('YtUser')->vipdis/100;
                $content = preg_replace("/\[BuyView\](.*?)\[\/BuyView\]/sm",'<div class="ytuser-buy-box"><p>****此部分是付费内容***</p><p><input type="submit" style="width:130px;font-size:1.0em;padding:0.2em" value="购买（'.$article->Metas->price.'积分）" onclick="return YtSbuy()" /></p></div>',$content);
                }else{
                $alipay ='<form class="ytarticleedt" id="edit" name="edit" method="post" action="#">';
                $alipay .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:150px;font-size:1.0em;padding:0.2em" value="支付宝付款（'.$article->Metas->price.'积分）" onclick="return VipRegPage()" /></td></tr>';
                $alipay .='</form>';
                $alipay .='<script type="text/javascript">function VipRegPage(){document.getElementById("edit").action="'.$zbp->host.'zb_users/plugin/YtUser/cmd.php?act=UploadPst&token='.$zbp->GetToken().'";}</script>';
                $content = preg_replace("/\[BuyView\](.*?)\[\/BuyView\]/sm",$alipay,$content);
                }
            }
        $ytuser = new Ytuser();
        $array = $ytuser->YtInfoByField('Uid',$zbp->user->ID);
            if($array){
                $article->Vipendtime = $ytuser->Vipendtime;
            }else{
                $article->Vipendtime =0;
            }
        $num = $userbuy->YtSumByField('LogID',$article->ID);
        $article->paysum = $num;
        $articlebuys = $userbuy->YtArticleByField('LogID',$article->ID);
        $template->SetTags('articlebuys', $articlebuys);
        }
        }
    }
    $content = str_replace("[BuyView]",'',$content);
    $content = str_replace("[/BuyView]",'',$content);
    $article->Content = $content;
    $template->SetTags('article', $article);
    $favorite = new YtFavorite;
    $array = $favorite->YtInfoByField('Pid',$article->ID);
    if ($array) {
        $article->Favorite = 1;
    }else{
        $article->Favorite = 0;
    }
}

function YtUser_SyntaxHighlighter_print() {
    global $zbp;
    if (!$zbp->option['ZC_SYNTAXHIGHLIGHTER_ENABLE']) {
        return;
    }
    $zbp->Load();
    if($zbp->user->ID){echo '$(function() {var $cpLogin = $(".cp-login").find("a");var $cpVrs = $(".cp-vrs").find("a");$(".cp-hello").html("欢迎 '.$zbp->user->StaticName.'  <a href=\"'.$zbp->host.$zbp->Config('YtUser')->YtUser_Articleedt.'\">投稿</a> <a href=\"'.$zbp->host.'zb_users/plugin/YtUser/loginout.php\">退出</a><br>");$cpLogin.html("会员中心");$cpLogin.attr("href", bloghost + "'.$zbp->Config('YtUser')->YtUser_User.'");$cpVrs.html("评论列表");$cpVrs.attr("href", bloghost + "'.$zbp->Config('YtUser')->YtUser_Commentlist.'");});';}else{echo'$(function () {$(".cp-login").html("<p><a href=\"'.$zbp->host.$zbp->Config('YtUser')->YtUser_Login.'\">会员登录</a><a href=\"'.$zbp->host.$zbp->Config('YtUser')->YtUser_Register.'\">会员注册</a><p>");$(".cp-vrs").html("<div class=\"ds-login\"></div>");$(".cp-hello").hide();$("#divContorPanel br").hide();$("#divContorPanel").each(function() { var text = $(this).html().replace(/&nbsp;/g, "");text = text;$(this).html(text);});});';}
}

function InstallPlugin_YtUser() {
	global $zbp;
    YtUser_CreateTable();
    if(!$zbp->Config('YtUser')->HasKey('dsurl')){
	$zbp->Config('YtUser')->dsurl = 'zbloguser';
	$zbp->Config('YtUser')->readme_text = '充满吧？';
	$zbp->Config('YtUser')->integral_text = '';
    $zbp->Config('YtUser')->default_level=4;
    $zbp->Config('YtUser')->vipdis = '100';
	$zbp->Config('YtUser')->payment = 0;
	$zbp->Config('YtUser')->regneedemail = true;
	$zbp->Config('YtUser')->regipdate = true;
    $zbp->Config('YtUser')->login_verifycode = '';
    $zbp->Config('YtUser')->OnRW = 0;
	$zbp->Config('YtUser')->RWURL = 'iPanel';
	$zbp->Config('YtUser')->YtUser_UCenter = '?UCenter';
    $zbp->Config('YtUser')->YtUser_Login = '?Login';
	$zbp->Config('YtUser')->YtUser_Register = '?Register';
	$zbp->Config('YtUser')->YtUser_Articlelist = '?Articlelist';
	$zbp->Config('YtUser')->YtUser_Articlelist_page = '?Articlelist&page=';
	$zbp->Config('YtUser')->YtUser_Articleedt = '?Articleedt';
	$zbp->Config('YtUser')->YtUser_Integral = '?Integral';
	$zbp->Config('YtUser')->YtUser_buy = '?buy';
	$zbp->Config('YtUser')->YtUser_buy_ID = '?buy&uid=';
	$zbp->Config('YtUser')->YtUser_Upgrade = '?Upgrade';
	$zbp->Config('YtUser')->YtUser_Upgrade_vip = '?Upgrade&vip=';
	$zbp->Config('YtUser')->YtUser_Paylist = '?Paylist';
	$zbp->Config('YtUser')->YtUser_Paylist_page = '?Paylist&page=';
	$zbp->Config('YtUser')->YtUser_User = '?User';
	$zbp->Config('YtUser')->YtUser_Commentlist = '?Commentlist';
	$zbp->Config('YtUser')->YtUser_Commentlist_page = '?Commentlist&page=';
	$zbp->Config('YtUser')->YtUser_Resetpwd = '?Resetpwd';
	$zbp->Config('YtUser')->YtUser_Resetpassword = '?Resetpassword';
	$zbp->Config('YtUser')->YtUser_Nameedit = '?Nameedit';
	$zbp->Config('YtUser')->YtUser_Binding = '?Binding';
	$zbp->Config('YtUser')->YtUser_Favorite = '?Favorite';
	$zbp->Config('YtUser')->YtUser_Favorite_page = '?Favorite&page=';
	$zbp->Config('YtUser')->YtUser_Consume = '?Consume';
	$zbp->Config('YtUser')->YtUser_Consume_page = '?Consume&page=';
	$zbp->Config('YtUser')->YtUser_Changepassword = '?Changepassword';
    $zbp->Config('YtUser')->Oncertif = 1;
    $zbp->Config('YtUser')->certifititle = '0';
	$zbp->SaveConfig('YtUser');
    }
}

function UninstallPlugin_YtUser() {
}

//创建表存用户数据
function YtUser_CreateTable(){
    global $zbp;
    $s=$zbp->db->sql->CreateTable($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['tyactivate_Table'],$GLOBALS['tyactivate_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['typrepaid_Table'],$GLOBALS['typrepaid_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['YtFavorite_Table'],$GLOBALS['YtFavorite_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['YtConsume_Table'],$GLOBALS['YtConsume_DataInfo']);
    $zbp->db->QueryMulit($s);
    $s=$zbp->db->sql->CreateTable($GLOBALS['YtVerification_Table'],$GLOBALS['YtVerification_DataInfo']);
    $zbp->db->QueryMulit($s);
}

function YtUser_password_verify_emailhash($name,$hash=''){
    global $zbp;
        if (isset($zbp->membersbyname[$name])){
            $m=$zbp->membersbyname[$name];
            if( $hash ===md5(md5($m->Password.$m->Email).date('Ymdh'))){
                return true;
            }
            if($hash ===md5(md5($m->Password.$m->Email).date('Ymdh',strtotime("-1 Hour")))){
                return true;
            }
            if($hash ==''){
                return md5(md5($m->Password.$m->Email).date('Ymdh'));
            }
            return false;
        }else{
            return false;
        }
}

function YtUser_payment_radio($int) {
    $array=array("积分","支付宝");
    foreach ($array as $key=>$article) {
    echo '<input name="payment" type="radio" value="'.$key.'"';
    if($key==$int){echo 'checked="checked"';}
    echo '/>'.$article.'</label>';
    }
    
}
//TEXT NOT NULL
function YtUser_DB_ADD($a_table,$add,$dbtype,$d_Hint=null){
	global $zbp;
	if (!$a_table || !$add)return;
	$s = "ALTER TABLE $a_table ADD COLUMN $add $dbtype;";
	$zbp->db->QueryMulit($s);
	if ($d_Hint){
		$zbp->SetHint('good',$s.'已执行');
	}
}

function YtUser_DB_UP($a_table,$b_updata=array(),$c_where=array(),$d_Hint=null){
	global $zbp;
	if (!$a_table || !$add)return;
	$sql = $zbp->db->sql->Update($a_table,$b_updata,$c_where);
	$zbp->db->Update($sql);
	if ($d_Hint){
		$zbp->SetHint('good',$d_Hint);
	}
}

function YtUser_DB_DROP($a_table,$add,$d_Hint=null){
	global $zbp;
	if (!$a_table || !$add)return;
	$s = "ALTER TABLE $a_table DROP COLUMN $add;";
	$zbp->db->QueryMulit($s);
	if ($d_Hint){
		$zbp->SetHint('bad',$s.'已执行');
	}
}

