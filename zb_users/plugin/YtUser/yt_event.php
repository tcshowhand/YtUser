<?php
    if($zbp->user->ID){
        $sql=$zbp->db->sql->Select($GLOBALS['tysuer_Table'],'*',array(array('=','tc_uid',$zbp->user->ID)),null,array(1),null);
        $array=$zbp->GetListCustom($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'],$sql);
        $num=count($array);
        if($num==0){
        $DataArr = array(
            'tc_uid'    => $zbp->user->ID,
            'tc_oid'    => 0,
        );
        $sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
        $zbp->db->Insert($sql);
	    $Price=0;
	    $Vipendtime=0;
        }else{
        $reg=$array[0];
        $Price=$reg->Price;
        $Vipendtime=$reg->Vipendtime;
        if($reg->Vipendtime<time() && $zbp->user->Level==4){
                $keyvalue=array();
                $keyvalue['mem_Level']=5;
                $sql = $zbp->db->sql->Update($zbp->table['Member'],$keyvalue,array(array('=','mem_ID',$zbp->user->ID)));
                $zbp->db->Update($sql);
        }
        }
        $zbp->user->Vipendtime=$Vipendtime;
        $zbp->user->Price=$Price;
    }
function YtUser_ReplacePre(&$s) {
        global $zbp;
        $s = str_replace('%pre%', $zbp->db->dbpre, $s);
        return $s;
}

function YtUser_SubMenu($id){
    $arySubMenu = array(
        0 => array('插件说明', 'guide', 'left', false),
        1 => array('网站设置', 'base', 'left', false),
        2 => array('VIP月卡', 'upgrade', 'left', false),
        3 => array('充值卡', 'recharge', 'left', false),
        4 => array('购买记录', 'buy', 'left', false),
        5 => array('修复插件', 'testing', 'left', false),
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
	    $Vipendtime=0;
        }else{
        $reg=$array[0];
        $Price=$reg->Price;
        $Vipendtime=$reg->Vipendtime;
        }
        $zbp->user->Price=$Price;
        if($zbp->user->Level <5){
            if($Vipendtime==0){
                $zbp->user->Vipendtime="永久会员";
            }else{
                $zbp->user->Vipendtime=date("Y-m-d H:i:s",$Vipendtime);
            }
        }else{
            $zbp->user->Vipendtime="请升级会员";
        }
    }

    if(!isset($_GET['Nameedit'])){
        if (substr($zbp->user->Name,0,3) == 'yt_'){
            Redirect($zbp->host."?Nameedit");die();
        }
    }

    if(!isset($_GET['Changepassword'])){
        if (substr($zbp->user->Name,0,3) != 'yt_' && $zbp->user->Password=='0e681aa506fc191c5f2fa9be6abddd01'){
            Redirect($zbp->host."?Changepassword");die();
        }
    }
	
	if(isset($_GET['Commentlist'])){
    $template = 'index';
    if($zbp->template->hasTemplate('t_commentlist')){
		$template = 't_commentlist';
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
    $zbp->template->Display();
	die();
	}

	if(isset($_GET['Paylist'])){
    $template = 'index';
    if($zbp->template->hasTemplate('t_paylist')){
		$template = 't_paylist';
	}
    $page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "购买列表";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
	$p=new Pagebar('{%host%}?Paylist{&page=%page%}',false);
	$p->PageCount=20;
	$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$p->PageBarCount=$zbp->pagebarcount;
	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
	$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');

	$sql= $zbp->db->sql->Select($GLOBALS['YtUser_buy_Table'],'*',array(array('=', 'buy_AuthorID', $zbp->user->ID)),'buy_ID ASC',null,null);

	$array=$zbp->GetListCustom($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo'],$sql);
    foreach ($array as $a) {
        $articles = $zbp->GetPostByID($a->LogID);
        if ($articles->ID==0) $articles = NULL; 
        $a->Title="购买的产品：".$articles->Title;
        $a->Intro=$articles->Intro;;
        $a->Url=$articles->Url;
        $a->IsTop=0;
        $a->ViewNums=$articles->ViewNums;
        $a->CommNums=$articles->CommNums;
        $a->PostTime=date("Y-m-d H:i:s",$a->PostTime);
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
    $zbp->template->Display();
	die();
	}

    if(isset($_GET['User'])){
	$article = new Post;
	$article->Title="用户中心";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=User" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=User&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="'.$zbp->user->ID.'" />';
        $article->Content .='<input id="edtGuid" name="Guid" type="hidden" value="'.$zbp->user->Guid.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户级别:'.$zbp->lang['user_level_name'][$zbp->user->Level].' <a href="'.$zbp->host.'?Upgrade" class="">购买升级会员</a></p></p></th></tr>';
	    if($zbp->user->Level <5){
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>到期时间:'.$zbp->user->Vipendtime.'</p></p></th></tr>';
        }
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$Price.' <a href="'.$zbp->host.'?Integral" class="">购买积分</a></p></p></th></tr>';
	    $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>修改密码 <a href="'.$zbp->host.'?Changepassword" class="">点击修改</a></p></p></th></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)账户：</td><td  style="border:none;" >'.$zbp->user->Name;
        if (substr($zbp->user->Name,0,3) == 'yt_'){
        $article->Content .='<a href="'.$zbp->host.'?Nameedit">修改账户名（仅一次机会）</a>';
        }
        $article->Content .='</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">(*)昵称：</td><td  style="border:none;" ><input required="required" type="text" id="edtAlias" name="Alias" value="'.$zbp->user->StaticName.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)电话：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Tel" name="meta_Tel" value="'.$zbp->user->Metas->Tel.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)会员地址：</td><td  style="border:none;" ><input required="required" type="text" id="meta_Add" name="meta_Add" value="'.$zbp->user->Metas->Add.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" id="edtEmail" name="Email" value="'.$zbp->user->Email.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">网站：</td><td  style="border:none;" ><input type="text" id="edtHomePage" name="HomePage" value="'.$zbp->user->HomePage.'" style="width:250px;font-size:1.2em;" /></td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)摘要：</td><td  style="border:none;" ><textarea cols="3" rows="6" id="edtIntro" name="Intro" style="width:250px;font-size:1.2em;">'.$zbp->user->Intro.'</textarea>';
	    $article->Content .='</td></tr>';
	    $article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	    $article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><button onclick="return checkInfo();">确定</button></td></tr>';
	    $article->Content .='</table>';
        $article->js =<<<js
    <script type="text/javascript">function checkInfo(){
    $.post(bloghost+'zb_users/plugin/YtUser/cmd.php?act=MemberPst&token={$zbp->GetToken()}',
        {
        "ID":$("input[name='ID']").val(),
        "Guid":$("input[name='Guid']").val(),
        "Alias":$("input[name='Alias']").val(),
        "meta_Tel":$("input[name='meta_Tel']").val(),
        "meta_Add":$("input[name='meta_Add']").val(),
        "Email":$("input[name='Email']").val(),
        "HomePage":$("input[name='HomePage']").val(),
        "Intro":$("textarea[name='Intro']").val(),
        "verifycode":$("input[name='verifycode']").val(),
        },
        function(data){
            var s =data;
            if((s.search("faultCode")>0)&&(s.search("faultString")>0))
            {
                alert(s.match("<string>.+?</string>")[0].replace("<string>","").replace("</string>",""));
				$("#reg_verfiycode").attr("src",bloghost+"zb_system/script/c_validcode.php?id=User&amp;tm="+Math.random());
            }
            else{
                var s =data;
                alert(s);
                window.location=bloghost+'?User';
            }
        }
    );
    }</script>
js;
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

	if(isset($_GET['Upgrade'])){
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="使用VIP月卡";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=RegPage&amp;tm=\'+Math.random();"/>';
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
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;';
                    $article->Content .= $article->verifycode;
                    $article->Content .='</td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return RegPage()" /></td></tr>';
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
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Ytbuypay" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Ytbuypay&amp;tm=\'+Math.random();"/>';
    $articles = $zbp->GetPostByID($uid);
    $sql=$zbp->db->sql->Select($GLOBALS['YtUser_buy_Table'],'*',array(array('=','buy_LogID',$uid),array('=','buy_AuthorID',$zbp->user->ID),array('=','buy_State',1)),null,1,null);
    $array=$zbp->GetListCustom($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo'],$sql);
    $num=count($array);
    $article->buynum=$num;
    $article->ID=$articles->ID;
    $article->BuyID=$articles->ID;
    $article->BuyTitle=$articles->Title;
    $article->BuyTUrl=$articles->Url;
    $article->BuyPrice=$articles->Metas->price;
    if($zbp->user->ID){
    	$article->Content .='<input type="hidden" name="LogID" id="LogID" value="'.$uid.'" />';
        $article->Content .='<input type="hidden" name="LogUrl" id="LogUrl" value="'.$article->Url.'" />';
        $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr><td style="text-align:right;border:none;">产品：</td><td  style="border:none;" >'.$articles->Title.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">价格：</td><td  style="border:none;" >'.$articles->Metas->price.'</td></tr>';
        $article->Content .='<tr><td style="text-align:right;border:none;">账户余额：</td><td  style="border:none;" >'.$Price.'</td></tr>';
        if($num){
        $article->Content .='<tr><td style="text-align:right;border:none;">状态：</td><td  style="border:none;" >已购买</td></tr>';
        }else{
		$article->Content .='<tr><td style="text-align:right;border:none;">验证码(*)：</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="付款" onclick="return Ytbuypay()" /></td></tr>';
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('uid',$uid);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Integral'])){
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="用户积分充值";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Integral" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Integral&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
    	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
        $article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>用户积分:'.$Price.'</p></th></tr>';
		$article->Content .='<tr style=""><th style="border:none;" colspan="2" scope="col"><p>'.$zbp->Config('YtUser')->integral_text.'</p></th></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)充值卡：</td><td  style="border:none;" ><input required="required" type="text" name="invitecode" style="width:250px;font-size:1.2em;" />';
		$article->Content .='</td></tr>';
		$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;';
        $article->Content .= $article->verifycode;
        $article->Content .='</td></tr>';
		$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Integral()" /></td></tr>';
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Articleedt'])){
        $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="投稿";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=Articleedt" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=Articleedt&amp;tm=\'+Math.random();"/>';
    if($zbp->user->ID){
        $article->UEditor ='<script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.config.php"></script><script type="text/javascript" src="'.$zbp->host.'zb_users/plugin/UEditor/ueditor.all.min.js"></script><div id=\'tarea\' class="editmod editmod3"><textarea id="editor_intro" name="Content"></textarea></div><script type="text/javascript">var editor_api={editor:{content:{obj:{},get:function(){return ""},insert:function(){return ""},put:function(){return ""},focus:function(){return ""}},intro:{obj:{},get:function(){return ""},insert:function(){return ""},put:function(){return ""},focus:function(){return ""}}}};function editor_init(){editor_api.editor.content.obj=$(\'#editor_content\');editor_api.editor.intro.obj=$(\'#editor_intro\');editor_api.editor.content.get=function(){return this.obj.val()};editor_api.editor.content.put=function(str){return this.obj.val(str)};editor_api.editor.content.focus=function(){return this.obj.focus()};editor_api.editor.intro.get=function(){return this.obj.val()};editor_api.editor.intro.put=function(str){return this.obj.val(str)};editor_api.editor.intro.focus=function(){return this.obj.focus()};sContent=editor_api.editor.content.get();}</script><script type="text/javascript">var EditorIntroOption = {toolbars:[[\'Source\', \'bold\', \'italic\',\'Undo\', \'Redo\']],autoHeightEnabled:false,initialFrameHeight:200};function getContent(){return editor_api.editor.content.get();}function getIntro(){return editor_api.editor.intro.get();}function setContent(s){editor_api.editor.content.put(s);}function setIntro(s){editor_api.editor.intro.put(s);};function editor_init(){editor_api.editor.content.obj=UE.getEditor(\'editor_content\');editor_api.editor.intro.obj=UE.getEditor(\'editor_intro\',EditorIntroOption);editor_api.editor.content.get=function(){return this.obj.getContent()};editor_api.editor.content.put=function(str){return this.obj.setContent(str)};editor_api.editor.content.focus=function(){return this.obj.focus()};editor_api.editor.intro.get=function(){return this.obj.getContent()};editor_api.editor.intro.put=function(str){return this.obj.setContent(str)};editor_api.editor.intro.focus=function(){return this.obj.focus()};editor_api.editor.content.obj.ready(function(){sContent=editor_api.editor.content.get();});editor_api.editor.intro.obj.ready(function(){sIntro=editor_api.editor.intro.get();});$(document).ready(function(){$(\'#edit\').submit(function(){if(editor_api.editor.content.obj.queryCommandState(\'source\')==1) editor_api.editor.content.obj.execCommand(\'source\');if(editor_api.editor.intro.obj.queryCommandState(\'source\')==1) editor_api.editor.intro.obj.execCommand(\'source\');});if (("http://" + bloghost + "/").indexOf(location.host.toLowerCase()) < 0) alert("您设置了域名固化，请使用" + bloghost + "访问或进入后台修改域名，否则图片无法上传。");});}</script><script type="text/javascript">editor_init();</script>';
        $article->Content .='<input id="edtID" name="ID" type="hidden" value="0" />';
        $article->Content .='<input id="edtType" name="Type" type="hidden" value="0" />';    
        $article->Content .='<input type="hidden" name="token" id="token" value="'.$zbp->GetToken().'" />';
        $article->Content .='<p><span class="title">标题:</span><br><input id="edtTitle" class="edit" size="40" name="Title" type="text"></p>';
        $article->Content .= '<span class="title">内容:</span><br>'.$article->UEditor.'</div>';
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}
    if(isset($_GET['Articlelist'])){
    $template = 'index';
    if($zbp->template->hasTemplate('t_articlelist')){
		$template = 't_articlelist';
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

    if(isset($_GET['Register'])){
    if($zbp->user->ID){
        Redirect($zbp->host."?User");die();
    }
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="会员注册";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=RegPage" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=register&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)名称：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)密码：</td><td  style="border:none;" ><input required="required" type="password" name="password" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)确认密码：</td><td  style="border:none;" ><input required="required" type="password" name="repassword" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" name="email" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">网站：</td><td  style="border:none;" ><input type="text" name="homepage" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='</td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return register()" /></td></tr>';
	$article->Content .='</table>';
    $article->Content .='使用其它帐号登录：<div class="ds-login"></div>';
	$mt=microtime();
    if($zbp->template->hasTemplate('t_register')){
        $article->Template = 't_register';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

	if(isset($_GET['Login'])){
    if($zbp->user->ID){
        Redirect($zbp->host."?User");die();
    }
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="会员登录";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">账户：</td><td  style="border:none;" ><input required="required" type="text" id="edtUserName" name="edtUserName" value="'.GetVars('username', 'COOKIE').'" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">密码：</td><td  style="border:none;" ><input required="required" type="password" id="edtPassWord" name="edtPassWord" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='</td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;"><input type="checkbox" name="chkRemember" id="chkRemember"  tabindex="3" /></td><td  style="border:none;" >下次自动登录</td></tr>';
    $article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input id="loginbtnPost" onclick="return Ytuser_Login()" name="loginbtnPost" type="submit" value="登录" class="button" tabindex="4"/></td></tr>';
	$article->Content .='</table>';
    $article->Content .='使用其它帐号登录：<div class="ds-login"></div>';
    if($zbp->template->hasTemplate('t_login')){
        $article->Template = 't_login';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Resetpwd'])){
	$zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
	$article = new Post;
	$article->Title="密码找回";
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
    $article->verifycode ='<img id="reg_verfiycode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=resetpwd" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=resetpwd&amp;tm=\'+Math.random();"/>';
    $article->Content .='<table style="width:90%;border:none;font-size:1.1em;line-height:2.5em;">';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)用户名：</td><td  style="border:none;" ><input required="required" type="text" name="name" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)邮箱：</td><td  style="border:none;" ><input type="text" name="email" style="width:250px;font-size:1.2em;" /></td></tr>';
	$article->Content .='<tr><td style="text-align:right;border:none;">(*)</td><td  style="border:none;" ><input required="required" type="text" name="verifycode" style="width:150px;font-size:1.2em;" />&nbsp;&nbsp;'.$article->verifycode.'</td></tr>';
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return resetpwd()" /></td></tr>';
	$article->Content .='</table>';
	$mt=microtime();
    if($zbp->template->hasTemplate('t_resetpwd')){
        $article->Template = 't_resetpwd';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}
    if(isset($_GET['Resetpassword'])){
    $zbp->header .='<script src="'.$zbp->host.'zb_system/script/md5.js" type="text/javascript"></script>' . "\r\n";
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}

    if(isset($_GET['Nameedit'])){
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
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
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}
    if(isset($_GET['Changepassword'])){
    if($zbp->user->ID){
    $zbp->header .='<script src="'.$zbp->host.'zb_users/plugin/YtUser/Upgrade.js" type="text/javascript"></script>' . "\r\n";
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
	$article->Content .='<tr><td  style="border:none;" ></td><td  style="border:none;" ><input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="提交" onclick="return Changepassword()" /></td></tr>';
	$article->Content .='</table>';
    }else{
        Redirect($zbp->host."?Login");die();
    }
    if($zbp->template->hasTemplate('t_changepassword')){
        $article->Template = 't_changepassword';
	}
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTags('type',$article->type=0?'article':'page');
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',null);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
	die();
	}
}