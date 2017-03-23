<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/Metas.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/pages.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/module.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/slide.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/searchplus.php';

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin/prise.php';
RegisterPlugin("dmam","ActivePlugin_dmam");
$dmam_ver = "20170311";
//函数接口
function ActivePlugin_dmam(){
	global $zbp;
//	Add_Filter_Plugin('Filter_Plugin_Admin_Header','dmam_editor_style');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response','dmam_editor_style');
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','dmam_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response3','dmam_Edit_3');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','dmam_Edit_5');
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildModule','dmam_rebuild_Main');
	Add_Filter_Plugin('Filter_Plugin_Search_Begin','dmam_SearchPlus_Main');
	Add_Filter_Plugin('Filter_Plugin_Html_Js_Add','dmam_AddJS');
	Add_Filter_Plugin('Filter_Plugin_Member_Edit_Response','dmam_Edit_user');
	Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response','dmam_Edit_cat');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','dmam_Content');
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','dmam_list');
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate','dmam_create_module');
	//Add_Filter_Plugin('Filter_Plugin_Edit_End','dmam_new_intro');
	Add_Filter_Plugin('Filter_Plugin_Cmd_Ajax', 'dmam_prise_do');
	Add_Filter_Plugin('Filter_Plugin_Cmd_Begin','dmam_Cmd_Begin');
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','dmam_Tmptags');
}
function dmam_Tmptags(&$template){
	global $zbp;
/* 	$zbp->footer .= '<script src="'.$zbp->host.'zb_users/theme/dmam/script/jquery.gifplayer.js"></script>' . "\r\n";
	$zbp->footer .= '<link rel="stylesheet" type="text/css" href="'.$zbp->host.'zb_users/theme/dmam/script/gifplayer.css">' . "\r\n"; */
}

// 主题拦截登录
function dmam_Cmd_Begin() {
    global $zbp;
    $action = GetVars('act','GET');
    if ($zbp->Config('dmam')->new_login) {
        if ($action=='verifys'){
            if(VerifyLogin()){
                if ($zbp->user->ID>0 && GetVars('redirect','COOKIE')) {
                    Redirect(GetVars('redirect','COOKIE'));
                }
                Redirect($zbp->host.'zb_system/admin/?act=admin');
            }else{
                Redirect($zbp->host.'zb_users/theme/dmam/login.php');
            }
        } elseif ($action=='login') {
            if ($zbp->user->ID>0 && GetVars('redirect','GET')) {
                Redirect(GetVars('redirect','GET'));
            }
            if ($zbp->CheckRights('admin')) {
                Redirect($zbp->host.'zb_system/admin/?act=admin');
            }
            if ($zbp->user->ID==0 && GetVars('redirect','GET')) {
                setcookie("redirect", GetVars('redirect','GET'),0,$zbp->cookiespath);
            }
            Redirect($zbp->host.'zb_users/theme/dmam/login.php');
        }
    }
}

//PHP JS内添加版本
function dmam_AddJS(){
	global $zbp,$dmam_ver;
	echo "\r\n".'<!-- dmam last fix : '.$dmam_ver.'-->'."\r\n";
}

//后台顶部导航
function dmam_AddMenu(&$m){
	global $zbp;
	array_unshift($m, MakeTopMenu("root","主题设置",$zbp->host . "zb_users/theme/dmam/main.php?act=notice","","topmenu_dmam"));
	}

//SubMenu
function dmam_SubMenu($id){
	global $zbp;
		$arySubMenu = array(
			array('说明', 'notice', 'left', false),
			array('自定义图', 'uploadpic', 'left', false),
			array('通用设定', 'general', 'left', false),
			array('页面设定', 'pages', 'left', false),
			array('广告配置', 'ads', 'left', false),
			array('其他设置', 'other', 'left', false),
			array('版本更新', 'updata', 'left', false),
			array('幻灯片', 'slide', 'left', false),
		);
		foreach($arySubMenu as $k => $v){
			echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
		}
}

//主题设置判断插件
function dmam_check_pluin(){
	global $zbp;
		$prerequisite = array('ggravatar'=>'Gravatar头像Ⅱ','dm_tools'=>'ZB小工具集合');
		foreach ($prerequisite as $key=>$pre){
			if (!$zbp->CheckPlugin($key)){
			$zbp->ShowHint('bad', '请安装 '.$pre.' ('.$key.') 应用');
			}
		}
	}

//文章编辑页面 编辑器js css
function dmam_editor_style(){
	global $zbp;
	echo '<script src="' . $zbp->host . 'zb_users/theme/'.$zbp->theme.'/script/editor.js" type="text/javascript"></script>';
	echo '<link rel="stylesheet" href="' . $zbp->host . 'zb_users/theme/'.$zbp->theme.'/source/editor.css" type="text/css" media="screen" />';
}

function dmam_Content(&$template){
	global $zbp;
	$article = $template->GetTags('article');
	if($article->Type != ZC_POST_TYPE_ARTICLE)return;
		$pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|tiff?|icon?)('|\")(.*?)>/i";
		if ($zbp->Config('dmam')->lasyload_imgs){
		$replacement = '<img class="thumb-post" src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/loader.gif" data-echo="$3.$4" $1 $6>';
		}else{
		$replacement = '<img class="thumb-post" src="$3.$4" $1 $6>';	
		}
		$article->Content = preg_replace($pattern, $replacement, $article->Content);
		
$loginurl = dmam_login_url("login");
$regurl = dmam_login_url("regist");
		

	if ($zbp->user->Level < 6 || $zbp->CheckRights('root')) {
		$article->Intro   = preg_replace("/\[LoginView5\](.*)\[\/LoginView5\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView5\](.*)\[\/LoginView5\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Content);
	} else {
		$article->Intro = preg_replace("/\[BuyView\](.*)\[\/BuyView\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后付费可见******</br><small><a href="'.$loginurl.'">登录</a> / <a href="'.$regurl.'">注册</a></small></div>', $article->Intro);
		$article->Content = preg_replace("/\[BuyView\](.*)\[\/BuyView\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后付费可见******</br><small><a href="'.$loginurl.'">登录</a> / <a href="'.$regurl.'">注册</a></small></div>', $article->Content);
		$article->Intro   = preg_replace("/\[LoginView5\](.*)\[\/LoginView5\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level6可见******</br><small><a href="'.$loginurl.'">登录</a> / <a href="'.$regurl.'">注册</a></small></div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView5\](.*)\[\/LoginView5\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level6可见******</br><small><a href="'.$loginurl.'">登录</a> / <a href="'.$regurl.'">注册</a></small></div>', $article->Content);
	}	
	if ($zbp->user->Level < 5 || $zbp->CheckRights('root')) {
		$article->Intro   = preg_replace("/\[LoginView4\](.*)\[\/LoginView4\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView4\](.*)\[\/LoginView4\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Content);
	} else {
		$article->Intro   = preg_replace("/\[LoginView4\](.*)\[\/LoginView4\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-4可见******</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView4\](.*)\[\/LoginView4\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-4可见******</div>', $article->Content);
	}
	if ($zbp->user->Level < 4 || $zbp->CheckRights('root')) {
		$article->Intro   = preg_replace("/\[LoginView3\](.*)\[\/LoginView3\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView3\](.*)\[\/LoginView3\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Content);
	} else {
		$article->Intro   = preg_replace("/\[LoginView3\](.*)\[\/LoginView3\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-3可见******</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView3\](.*)\[\/LoginView3\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-3可见******</div>', $article->Content);
	}
	if ($zbp->user->Level < 3 || $zbp->CheckRights('root')) {
		$article->Intro   = preg_replace("/\[LoginView2\](.*)\[\/LoginView2\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView2\](.*)\[\/LoginView2\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Content);
	} else {
		$article->Intro   = preg_replace("/\[LoginView2\](.*)\[\/LoginView2\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-2可见******</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView2\](.*)\[\/LoginView2\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******登录后Level-2可见******</div>', $article->Content);
	}
	if ($zbp->CheckRights('root')) {
		$article->Intro   = preg_replace("/\[LoginView1\](.*)\[\/LoginView1\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView1\](.*)\[\/LoginView1\]/Uims", '<div class="am-alert am-alert-success" data-am-alert>\1</div>', $article->Content);
	} else {
		$article->Intro   = preg_replace("/\[LoginView1\](.*)\[\/LoginView1\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******仅管理员可见******</div>', $article->Intro);
		$article->Content = preg_replace("/\[LoginView1\](.*)\[\/LoginView1\]/Uims", '<div class="am-alert am-text-center am-alert-danger" data-am-alert>******仅管理员可见******</div>', $article->Content);
	}

		$template->SetTags('article', $article);

}
function dmam_list(&$template){
	global $zbp;
	$articles = $template->GetTags('articles');
	foreach ($articles as $key => $article) {
if($zbp->user->ID>0){
		$article->Intro   = preg_replace("/\[(BuyView|LoginView[12345])\](.*)\[\/(BuyView|LoginView[12345])\]/Uims", '<div class="am-alert am-alert-danger" data-am-alert>******隐藏内容请点击正文查看******</div>', $article->Intro);
		$article->Content = preg_replace("/\[(BuyView|LoginView[12345])\](.*)\[\/(BuyView|LoginView[12345])\]/Uims", '<div class="am-alert am-alert-danger" data-am-alert>******隐藏内容请点击正文查看******</div>', $article->Content);
	}
	}
	$template->SetTags('articles', $articles);
}


/* function dmam_login_level($a_t) {
    global $zbp;
    $s = '';
    switch ($a_t) {
        case 'login':
			if ($zbp->CheckPlugin('YtUser')){
				$s = $zbp->host.'?Login';
			}else{
				$s = $zbp->host.'zb_users/theme/dmam/login.php';	
			}
        break;
        case 'regist':
			if ($zbp->CheckPlugin('YtUser')){
				$s = $zbp->host.'?Register';
			}else{
				$s = $zbp->CheckPlugin('RegPage')?$zbp->host.'?reg':$zbp->host.'zb_users/theme/dmam/login.php';	
			}
        break;
        default:
            $s = '';
    }
    echo $s;
} */

function dmam_login_url($a_t) {
    global $zbp;
    $s = '';
    switch ($a_t) {
        case 'login':
			if ($zbp->CheckPlugin('YtUser')){
				$s = $zbp->host.'?Login';
			}else{
				$s = $zbp->host.'zb_users/theme/dmam/login.php';	
			}
        break;
        case 'regist':
			if ($zbp->CheckPlugin('YtUser')){
				$s = $zbp->host.'?Register';
			}else{
				$s = $zbp->CheckPlugin('RegPage')?$zbp->host.'?reg':$zbp->host.'zb_users/theme/dmam/login.php';	
			}
        break;
        default:
            $s = '';
    }
    return $s;
}
//纯文处理	
function dmam_txt($a,$b,$c,$d) {
    global $zbp;
    $s = '';
	if (!$c){$c = 80;}
	if ($d){$d = $d;}else{$d='';}
	if ($zbp->Config('dmam')->multi_intro){$b = $zbp->Config('dmam')->multi_intro;}else{$b = '';}
	
	if ($b){
	$s = trim(SubStrUTF8(TransferHTML($a->Intro,'[nohtml]'),$c)).$d;
	}else{
	$s = trim(SubStrUTF8(TransferHTML($a->Content,'[nohtml]'),$c)).$d;
	}
    return $s;
}

//摘要优化
/* function dmam_new_intro(){
	global $zbp;
	echo <<<JS
	<script type="text/javascript">function AutoIntro(d){var a=[],i=0,l=0,m={$zbp->option['ZC_ARTICLE_EXCERPT_MAX']},t="",s=editor_api.editor.content.get(),c=s.match(/<hr.*?class=['|"]more['|"].*?>/i),o=$("#divIntro");if(c){s=s.substr(0,c.index)}else{t=s.replace(/(<a.*?>.*?<\/a>|<strong.*?>.*?<\/strong>|<b.*?>.*?<\/b>|<img.*?>)/img,function(b){a.push(b);l+=b.match(/<[a-z]+.*?>(.*?)<\/[a-z]>/)?b.match(/<[a-z]+.*?>(.*?)<\/[a-z]>/)[1].length:0;return"<meta/>"}).substr(0,m+l);s=t.replace(/(<meta\/>)/img,function(){return a[i++]})}editor_api.editor.intro.put(s+(d?d:""));o[d?"hide":"show"]();!d&&$("html,body").animate({scrollTop:o.offset().top})}$("#edit").submit(function(){if(!editor_api.editor.intro.get())AutoIntro("<!--autointro-->")});</script>
JS;
} */

//图片延迟加载
function dmam_islasy($lasy,$real){
	global $zbp;
	$islasy = '';
	if ($lasy == 'avatar'){
		$lasy = $zbp->Config('dmam')->pics_avatar?$zbp->Config('dmam')->pics_avatar:$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/avatar.png';
	}else{
		$lasy = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/loader.gif';
	}
	if ($zbp->Config('dmam')->lasyload_imgs){
		$islasy = 'src="'.$lasy.'" data-echo="'.$real.'"';
	}else{
		$islasy = 'src="'.$real.'"';
	}
	return $islasy;
}

//判断手机浏览
function dmam_is_mobile() {
	global $zbp;
	$is_mobile = false;
	
	//SB MEIZU SB UC  FUCK
	$regex = '/android|adr|iphone|ipad|windows\sphone|kindle|gt\-p|gt\-n|rim\stablet|opera|meego|Mobile|Silk|BlackBerry|Opera\Mini/i';
	if (preg_match($regex, GetVars('HTTP_USER_AGENT', 'SERVER'))) $is_mobile = true;
	
	if (isset($_COOKIE['view_m'])){
	$is_mobile = true;
	}
	return $is_mobile;
}

//底部版权
function dmam_theme_copy() {
    global $zbp;
    $str = '';
    switch ($zbp->Config('dmam')->copyright) {
        case '1':
            $str= '本站由 Zblog 强力驱动，<a href="http://www.imlgm.com/" title="大谋提供主题支持" target="_blank">大谋</a> 提供主题支持.';
        break;
        case '2':
            $str= 'Powered By <a href="http://www.zblogcn.com/" title="RainbowSoft Z-BlogPHP" target="_blank">Z-BlogPHP</a> Theme By <a href="http://www.imlgm.com/" title="模板由大谋提供" target="_blank">大谋</a>';
        break;
        case '3':
			$str= 'Powered By Z-BlogPHP Theme By 大谋.';
        break;
        case '4':
            $str= '本站前端 Amaze UI , 后端 Zblog , 风格 by <a href="http://www.imlgm.com/" title="大谋博客" target="_blank">大谋</a>.';
		break;
        default:
            $str= '';
    }
    echo $str;
}

//新时间显示
function dmam_NewTime( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

//百度分享
function dmam_get_share(){
	global $zbp;
    $shares = array(
        'qzone',
        'tsina',
        'weixin',
        'sqq',
/*		'tqq',
         'bdhome',
        'douban',
        'fbook',
        'twi', */
        'mail',
        'copy'
    );

    $html = '';
    foreach ($shares as $value) {
        $html .= '<a class="bds_'.$value.'" data-cmd="'.$value.'"></a>'."\r\n";
    }
    echo '<div class="bdsharebuttonbox" data-tag="share_1"><span>分享到：</span>'.$html.'<a class="bds_more am-icon-plus" data-cmd="more"></a></div>';
}	
function dmam_istoplist($a_tyle){
	global $zbp;
	$avg = '';
	$avgstyle = '';
	if ($zbp->Config('dmam')->istop_m_num == 1){
	$avg = "am-avg-sm-2 am-avg-md-4 am-avg-lg-4";
	}elseif ($zbp->Config('dmam')->istop_m_num == 2){
		$avg = "am-avg-sm-3 am-avg-md-3 am-avg-lg-4";
		}else{
			$avg = "am-avg-sm-2 am-avg-md-3 am-avg-lg-4";
			}
	if ($zbp->Config('dmam')->istop_style == 1){
		$avgstyle = "am-gallery-overlay";
		}elseif ($zbp->Config('dmam')->istop_style == 2){
			$avgstyle = "am-gallery-bordered";
			}else{
				$avgstyle = "am-gallery-default";
				}
	if ($a_tyle){return $avg.' '.$avgstyle.' istop-'.$a_tyle;}else{return $avg.' '.$avgstyle;}
}
//添加自定义CSS
function dmam_head_css($post_css) {
global $zbp;
    $styles = '';
    if ($zbp->Config('dmam')->site_maxwidth){
		$styles .= ".D_M section.am-container,.dm-topbar-fixed header#dm-topbar,.dm-footer .am-container,header#dm-topbar{max-width:{$zbp->Config('dmam')->site_maxwidth}px;margin-left: auto;margin-right: auto;}"."\r\n";
		}

    if( $zbp->Config('dmam')->site_gray ){
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}"."\r\n";
    }

    if($zbp->Config('dmam')->color){
        $skc = $zbp->Config('dmam')->color;
		$styles .= "a:hover, a:focus,.dm-multi:hover .am-article-title a,.pads a:hover h4{color:{$skc};}"."\r\n";
		$styles .= ".pads a time{background-color:{$skc};}"."\r\n";
    }
	if ($zbp->Config('dmam')->logo_width){
		$styles .= '#dm-topbar .am-container{padding-left:'.($zbp->Config('dmam')->logo_width+50).'px}'."\r\n";
		$styles .= '@media (max-width:640px) {#dm-topbar .am-container{padding-left:0;}#dm-topbar .am-topbar-brand{margin-left:-'.($zbp->Config('dmam')->logo_width/2).'px;}}'."\r\n";
	}
	
	
	if ($zbp->Config('dmam')->user_css){
		$styles .= "\r\n".$zbp->Config('dmam')->user_css."\r\n";
		}
	if ($post_css){
		$styles .= "\r\n".$post_css."\r\n";
		}
    if( $styles ){
		echo '<style>'."\r\n".$styles."\r\n".'</style>';
		}
}

//ads 暂时未启用
/* function dmam_ads($a_ads,$b_position){
	global $zbp;
	if (!$zbp->Config('dmam')->kgguanggao) return;
	if ($ad_pc){$ad_pc = $ad_pc;}else{$ad_pc = '';}
	if ($ad_m){$ad_m = $ad_m;}else{$ad_m = '';}
	if (dmam_is_mobile() && $a_ads['m'][$b_position]){
		echo '<div class="ads ads-m">';
		echo $ad_m;
		echo '</div>';
	}elseif ($a_ads['no_m'][$b_position]){
		echo '<div class="ads ads-no_m">';
		echo $ad_pc;
		echo '</div>';	
	}else{
		echo '';
	}
} */

//专题列表
function dmam_multi_pro($explode){
	global $zbp;
	$s = '';
	if (!$explode) return;
	if (strpos($explode,'|')){
	$pro_ids = explode('|',$explode);
		foreach ($pro_ids as $key=>$pro_id) {
			$num = $key+1;
			$post = $zbp->GetPostByID($pro_id);
			$s .= '<li><a href="' .$post->Url. '">' .$post->Title. '</a></li>'."\r\n";
		}
	}
	return $s;
}

//escape解密
function dmam_unescape($str){ 
	$ret = ''; 
	$len = strlen($str); 
	for ($i = 0; $i < $len; $i++){ 
	if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
	$val = hexdec(substr($str, $i+2, 4)); 
	if ($val < 0x7f) $ret .= chr($val); 
	else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
	else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
	$i += 5; 
	} 
	else if ($str[$i] == '%'){ 
	$ret .= urldecode(substr($str, $i, 3)); 
	$i += 2; 
	} 
	else $ret .= $str[$i]; 
	} 
	return $ret; 
} 

function dmam_isblank($blank) {
	global $zbp;
	$s = '';
	if ($zbp->Config('dmam')->pjax)$blank = false;
	if ($blank)$s = 'target="_blank"';
	return $s;
} 

//获取各种数量
function dmam_GetCount($hello) {
    global $zbp;
		//文章数量{dmam_GetCount('article')}
	if ($hello == 'article')
		$s = $zbp->db->sql->Count(
			$zbp->table['Post'], 
			array(array('COUNT', 'log_ID', 'num')), 
			array(array('=', 'log_Type', 0),  array('=', 'log_Status', 0))
		);
		//获取总共评论的数量{dmam_GetCount('comment')}
	if ($hello == 'comment')
		$s = $zbp->db->sql->Count(
			$zbp->table['Comment'], 
			array(array('COUNT', 'comm_ID', 'num')), 
			array(array('=', 'comm_IsChecking', 0))
		);
		//获取标签数量{dmam_GetCount('tag')}
	if ($hello == 'tag')
		$s = $zbp->db->sql->Count(
			$zbp->table['Tag'], 
			array(array('COUNT', 'tag_ID', 'num')), 
			null
		);
		//获取置顶数量{dmam_GetCount('istop')}  global  index category
	if ($hello == 'istop'){
		$s = $zbp->db->sql->Count(
			$zbp->table['Post'], 
			array(array('COUNT', 'log_ID', 'num')), 
			array(array('=', 'log_Type', 0), array('=', 'log_IsTop', 1),array('=', 'log_Status', 0))
		);
}
	$s = GetValueInArrayByCurrent($zbp->db->Query($s), 'num');
	return $s;
}

function dmam_load_source($a_loc,$b_page,$c_postjs) {
	global $zbp;
	if (!$a_loc) $a_loc = null;
	if (!$b_page) $b_page = null;
	if (!$c_postjs) $c_postjs = null;
	$s = '';
	if ($a_loc == 'header'){
		if ($zbp->Config('dmam')->site_cdn=='1'){
		$s .= "\r\n".'<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>'."\r\n";
		$s .= '<!--[if lt IE 9]><script src="//cdn.bootcss.com/amazeui/2.7.2/js/amazeui.ie8polyfill.min.js"></script><![endif]-->'."\r\n";
		$s .= '<link rel="stylesheet" href="//cdn.bootcss.com/amazeui/2.7.2/css/amazeui.min.css" type="text/css" media="all" />'."\r\n";
		$s .= '<script src="//cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js"></script>'."\r\n";
		$s .= $zbp->Config('dmam')->lasyload_imgs?'<script id="lazyload" src="//cdn.bootcss.com/echo.js/1.7.3/echo.min.js"></script>'."\r\n":'';
		$s .= $zbp->Config('dmam')->pjax?'<script id="pjaxid" src="//cdn.bootcss.com/jquery.pjax/1.9.6/jquery.pjax.min.js"></script>'."\r\n":'';
		}else{
		$s .= "\r\n".'<script src="'.$zbp->host.'zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>'."\r\n";
		$s .= '<!--[if lt IE 9]><script src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/amaze/js/amazeui.ie8polyfill.min.js"></script><![endif]-->'."\r\n";
		$s .= '<script src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/amaze/js/amazeui.min.js"></script>'."\r\n";
		$s .= '<link rel="stylesheet" href="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/amaze/css/amazeui.css" type="text/css" media="all" />'."\r\n";
		$s .= $zbp->Config('dmam')->lasyload_imgs?'<script id="lazyload" src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/script/echo.js"></script>'."\r\n":'';
		$s .= $zbp->Config('dmam')->pjax?'<script id="pjaxid" src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/script/jquery.pjax.min.js"></script>'."\r\n":'';
		}
		$s .= '<script src="'.$zbp->host.'zb_system/script/zblogphp.js" type="text/javascript"></script>'."\r\n";
		$s .= '<script src="'.$zbp->host.'zb_system/script/c_html_js_add.php" type="text/javascript"></script>'."\r\n";
		if ($c_postjs){
		$s .= $c_postjs."\r\n";
		}
		$s .= '<script type="text/javascript" src="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/script/main.js"></script>'."\r\n";
		$s .= '<link rel="stylesheet" href="'.$zbp->host.'zb_users/theme/'.$zbp->theme.'/style/css/main.css" type="text/css" media="all"/>'."\r\n";
	}else{
		$s .= "\r\n".'<script type="text/javascript">'."\r\n";
		$s .= 'window.d_m_ui = {'."\r\n";
		$s .= 'source: "'.$zbp->host.'zb_users/theme/'.$zbp->theme.'",'."\r\n";
		$s .= $zbp->Config('dmam')->pjax?'pjax:"on",'."\r\n":'';
		$s .= $zbp->Config('dmam')->lasyload_imgs?'date_echo:"on",'."\r\n":'';
		if ($b_page == 'index'){
		$s .= 'roll: "'.$zbp->Config('dmam')->side_scroll_index.'",'."\r\n";
		} elseif ($b_page == 'category'){
		$s .= 'roll: "'.$zbp->Config('dmam')->side_scroll_category.'",'."\r\n";
		} elseif ($b_page == 'article'){
		$s .= 'roll: "'.$zbp->Config('dmam')->side_scroll_article.'",'."\r\n";
		} elseif ($b_page == 'page'){
		$s .= 'roll: "'.$zbp->Config('dmam')->side_scroll_page.'",'."\r\n";
		} else{
		$s .= 'roll: "'.$zbp->Config('dmam')->side_scroll_other.'",'."\r\n";
		}
		if ($zbp->Config('dmam')->pagenav_style > 1){
		$s .= 'iaspager: "'.$zbp->Config('dmam')->pagenav_style.'"'."\r\n";
		}
		$s .= '}'."\r\n";	
		$s .= '</script>'."\r\n";
		$s .= $zbp->Config('dmam')->pjax?'<div id="pjaxloading"><i class="am-icon-spinner am-icon-pulse am-icon-5x am-icon-fw"></i></div>'."\r\n":'';
	}
	echo $s;
}

//初始安装参数
function dmam_theme_sets($set_form_array){
	global $zbp;
	$uploadpic = array(
		'logo_width' => '',
		'pics_logo'	=>  $zbp->host.'zb_users/theme/dmam/style/images/logo.png',
		'pics_wx'	=>  '',
		'pics_zfb'	=>  '',
		'apple_ico'	=>  '',
		'pics_skm'	=>  '',
		'pics_qq'	=>  '',
		'pics_fv'	=>  '',
		'pics_avatar'	=>  $zbp->host.'zb_users/theme/dmam/style/images/avatar.png'
	);
	$general = array(
		'color'	=>  '',
		'topbar_fix' => '1',
		'admin_id'	=>  '1',
		'site_maxwidth'	=>  '',
		'fgf'	=>  '-',
		'keywords'	=>  '',
		'description'	=>  '',
		'site_gray'	=>  '',
		'multi_intro'	=>  '',
		'top_login'	=>  '1',
		'new_login'	=>  '1',
		'pjax'	=>  '0',
		'headmate'	=>  '',
		'footmate'	=>  '',
		'top_nav'	=>  '',
/* 		'rand_avatar'	=>  '1', */
		'new_search'	=>  '1',
		'copyright'	=>  '1',
		'site_cdn'	=>  '1',
		'lasyload_imgs'	=>  '1',
		'ajaxpager'	=>  '1',
		'theme_seo'	=>  '1',
		'pagenav_style'	=>  '1',
		'istop_style'	=>  '',
		'istop_m_num'	=>  '',
		'notinemail'	=>  '',
		'user_css'	=>  ''
	);
	$pages = array(
		'index_titlebar_nav'	=>  '<a href="#">项目1</a><a href="#">项目2</a><a href="#">项目3</a>',
		'index_onece_article'	=>  '',
		'article_intro'	=>  '1',
		'article_share'	=>  '1',
		'article_prise' => '1',
		'article_copy'	=>  '1',
		'article_relevant'	=>  '1',
		'page_navi' => '<li><a href="#">导航1</a></li><li><a href="#">导航2</a></li><li><a href="#">导航3</a></li>',
		'page_readers_day'	=>  '90',
		'page_readers_num'	=>  '50',
		'side_readers_day'	=>  '90',
		'side_readers_num'	=>  '21',
		'side_scroll_index'	=>  '1 2',
		'side_scroll_category'	=>  '1 2',
		'side_scroll_article'	=>  '1 2',
		'side_scroll_page'	=>  '1 2',
		'side_scroll_other'	=>  '1 2',
		'side_new_comments'	=>  '1',
		'side_new_archives'	=>  '1',
		'side_new_previous'	=>  '1',
		'side_new_tags'	=>  '1'
	);

	$ads = array(
		'ads_pc'	=> '',
		'ads_m'	=>  '',
		
		'ads_list_top'	=> '',
		'ads_list_in'	=>  '',
		'ads_list_foot'	=>  '-',
		'ads_article_top'	=>  '',
		'ads_article_foot'	=>  '',
		'ads_comment_top'	=>  '',
		'ads_comment_foot'	=>  '',
		
		'ads_list_topm'	=> '',
		'ads_list_inm'	=>  '',
		'ads_list_footm'	=>  '-',
		'ads_article_topm'	=>  '',
		'ads_article_footm'	=>  '',
		'ads_comment_topm'	=>  '',
		'ads_comment_footm'	=>  ''
	);
	$slide = array('pc_slide'=>'0','m_slide'=>'0');
	$other = array(
	'del_config'=>'',
	'user_notice'=>''
/* 		'image_checkhost'=>'',
		'image_on'=>'1',
		'image_otherurl'=>'',
		'image_changeurl'=>'',
		'image_CacheExternalUrl'=>'1',
		'del_slidedb'=>'',
		'del_slideimg'=>'',
		'rb_moudle'=>'',
		'del_moudle'=>'' */
	);
	$notice = array();
	$updata = array();
	$theme_sets = array_merge($uploadpic,$general,$pages,$ads,$slide,$other);
	switch ($set_form_array) {
		case 'uploadpic':
			return $uploadpic;
		break;
		case 'general':
			return $general;
		break;
		case 'pages':
			return $pages;
		break;
		case 'ads':
			return $ads;
		break;
		case 'slide':
			return $slide;
		break;
		case 'updata':
			return $updata;
		break;	
		case 'other':
			return $other;
		break;	
		case 'notice':
			return $notice;
		break;	
		default:
			return $theme_sets;
		}
}

function dmam_CreateTable(){
    global $zbp;
	if ($zbp->db->ExistTable($GLOBALS['dmam_prise_Table']) == false) {
		$s = $zbp->db->sql->CreateTable($GLOBALS['dmam_prise_Table'], $GLOBALS['dmam_prise_DataInfo']);
		$zbp->db->QueryMulit($s);
	}
	if ($zbp->db->ExistTable($GLOBALS['dmam_Slide_Table']) == false) {
		$s=$zbp->db->sql->CreateTable($GLOBALS['dmam_Slide_Table'],$GLOBALS['dmam_Slide_DataInfo']);
		$zbp->db->QueryMulit($s);
	}

}

//安装主题
function InstallPlugin_dmam(){
    global $zbp;
		dmam_CreateTable();
		dmam_rebuild_Main();
		if(!$zbp->Config('dmam')->HasKey('Version')){
			foreach (dmam_theme_sets('theme_sets') as $value => $intro) {
				$zbp->Config('dmam')->$value = $intro;
			}
		}
		$zbp->Config('dmam')->Version = '1.0';
		$zbp->SaveConfig('dmam');
}

//卸载主题处理
function UninstallPlugin_dmam(){
          global $zbp;
		  if ($zbp->Config('dmam')->del_config){
			$zbp->DelConfig('dmam');  
		  }
		  $zbp->SetHint('good','OK'); 
}
?>