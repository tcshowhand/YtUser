<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'nb_seotools_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Spider'. DIRECTORY_SEPARATOR .'spider_config.php';  
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BadCheck'. DIRECTORY_SEPARATOR .'badcheck_config.php';  
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Keywordlink'. DIRECTORY_SEPARATOR .'kw_class.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Keywordlink'. DIRECTORY_SEPARATOR .'kwlink_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Sitemap'. DIRECTORY_SEPARATOR .'sitemap_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'BeautyTitle'. DIRECTORY_SEPARATOR .'beautytitle_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'KeyAndDes'. DIRECTORY_SEPARATOR .'keyanddes_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CommentMng'. DIRECTORY_SEPARATOR .'commentmng_config.php';  
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'NoLinks'. DIRECTORY_SEPARATOR .'nolinks_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Nofollow'. DIRECTORY_SEPARATOR .'nofollow_config.php';  
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ImgAlt'. DIRECTORY_SEPARATOR .'imgalt_config.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'HtmlMinify'. DIRECTORY_SEPARATOR .'htmlminify_config.php';  
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Check'. DIRECTORY_SEPARATOR .'check_config.php';   

define('nbseo_batch', true);
$nbseo_batch_register_array = array();
$nbseo_batch_register_cate = array();


RegisterPlugin("Nobird_Seo_Tools","ActivePlugin_Nobird_Seo_Tools");

function ActivePlugin_Nobird_Seo_Tools() {
	global $zbp;
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','Nobird_Seo_Tools_AddMenu');
	Add_Filter_Plugin('Filter_Plugin_Index_Begin','Nobird_Seo_Tools_Filter_Plugin_Index_Begin');
	Add_Filter_Plugin('Filter_Plugin_Index_End','Nobird_Seo_Tools_Filter_Plugin_Index_End');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_kwlink');
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Succeed','Nobird_Seo_Tools_Sitemap');
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Succeed','Nobird_Seo_Tools_PostToBaidu');
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate','Nobird_Seo_Tools_BeautyTitle');
	Add_Filter_Plugin('Filter_Plugin_Edit_End','Nobird_Seo_Tools_Filter_Plugin_Edit_End');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','Nobird_Seo_Tools_KeyAndDes_Edit');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response3','Nobird_Seo_Tools_Edit_Response3');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_KeyAndDes_viewpost');	
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_Nofollow_viewpost');	
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_ImgAlt_viewpost');	
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_Baidu_JS');

	Add_Filter_Plugin('Filter_Plugin_ViewList_Core','Nobird_Seo_Tools_KeyAndDes_viewlist');
	Add_Filter_Plugin('Filter_Plugin_Category_Edit_Response','Nobird_Seo_Tools_Category_Edit_Response');
	Add_Filter_Plugin('Filter_Plugin_Tag_Edit_Response','Nobird_Seo_Tools_Tag_Edit_Response');
	Add_Filter_Plugin('Filter_Plugin_Admin_CommentMng_SubMenu','Nobird_Seo_Tools_CommentMng');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','Nobird_Seo_Tools_ViewComments_Template');
	Add_Filter_Plugin('Filter_Plugin_ViewComments_Template','Nobird_Seo_Tools_ViewComments_Template2');
    Add_Filter_Plugin('Filter_Plugin_Admin_ModuleMng_SubMenu','Nobird_Seo_Tools_Filter_Plugin_Admin_ModuleMng_SubMenu');

	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildModule','Nobird_Seo_Tools_Filter_Plugin_Check');
    Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','Nobird_Seo_Tools_Spider_ShowError');

}


function Nobird_Seo_Tools_AddMenu(&$m){
	global $zbp;
	$m[]=MakeTopMenu("root",'SEO工具',$zbp->host . "zb_users/plugin/Nobird_Seo_Tools/main.php","","topmenu_phpdeer");
}


function Nobird_Seo_Tools_Filter_Plugin_Index_Begin(){
	global $zbp;
  if ($zbp->Config('Nobird_HtmlMinify')->IsUse){
    ob_start();
  }
}

function Nobird_Seo_Tools_Filter_Plugin_Index_End(){
	global $zbp;

  if ($zbp->Config('Nobird_Spider')->UseSpider){
    Nobird_Seo_Tools_Spider_InsertLog('200');
  }

if ($zbp->Config('Nobird_HtmlMinify')->IsUse){
	$html = ob_get_contents();
	ob_get_clean();
if (!function_exists('nb_absolute_to_relative_url'))	{
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'HtmlMinify'. DIRECTORY_SEPARATOR .'absolute-to-relative-urls.php';
}
	$compress_css = $zbp->Config('Nobird_HtmlMinify')->compress_css ; //是否压缩css
	$compress_js = $zbp->Config('Nobird_HtmlMinify')->compress_js ; //是否压缩js|| ZBP插件默认没有使用并且也未设置此开关，htmlminify源码作者表示这里尚未完善，可能会出错。
	$info_comment = $zbp->Config('Nobird_HtmlMinify')->info_comment ; //是否通过注释信息显示压缩前后对比
	$remove_comments = $zbp->Config('Nobird_HtmlMinify')->remove_comments ;//是否移除页面所有注释信息
	$shorten_urls = $zbp->Config('Nobird_HtmlMinify')->shorten_urls ; //是否启用相对地址
	echo new NB_HTML_Minify($html, $compress_css, $compress_js, $info_comment, $remove_comments, $shorten_urls);
	}
}



function Nobird_Seo_Tools_CommentMng(){
	global $zbp;
	$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
//	Redirect('../../zb_users/plugin/Nobird_Seo_Tools/CommentMng/commentmng.php');
  if ($zbp->CheckRights('root')) {
	echo '<a href="'. $zbp->host .'zb_system/admin/?act=CommentMng"><span class="m-left m-now">系统评论管理</span></a>';
	echo '<a href="'. $zbp->host .'zb_users/plugin/Nobird_Seo_Tools/CommentMng/commentmng.php"><span class="m-left ' . ($filename=='commentmng.php'?'m-now':'') . '">评论SEO管理</span></a>';
		echo '<a href="'. $zbp->host .'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/NoLinks/nolinks.php"><span class="m-right ' . ($filename=='nolinks.php'?'m-now':'') . '">灭外链</span></a>';
}
}
function Nobird_Seo_Tools_Filter_Plugin_Admin_ModuleMng_SubMenu(){
	global $zbp;
	$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
		echo '<a href="'. $zbp->host .'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/LinksCheck/linkscheck.php"><span class="m-right ' . ($filename=='linkscheck.php'?'m-now':'') . '">外链检测</span></a>';

}




function InstallPlugin_Nobird_Seo_Tools(){
	global $zbp;
	Nobird_Spider_Install();
	Nobird_KeyWordLinks_CreateTable();
    Nobird_Keywordlink_Install();
    Nobird_BeautyTitle_Install();
    Nobird_KeyAndDes_Install();
    Nobird_NoLinks_Install();
    Nobird_Nofollow_Install();
    Nobird_Sitemap_Install();
    Nobird_ImgAlt_Install();
    Nobird_HtmlMinify_Install();
}

function UninstallPlugin_Nobird_Seo_Tools(){
	global $zbp;
  //Nobird_Seo_Tools_DeleteSetting();
}

function Nobird_Seo_Tools_DeleteSetting(){
	global $zbp;

    Nobird_Spider_Uninstall();
    Nobird_KeyWordLinks_Uninstall();
	Nobird_BeautyTitle_Uninstall();
    Nobird_KeyAndDes_Uninstall();
    Nobird_NoLinks_Uninstall();
    Nobird_Nofollow_Uninstall();
    Nobird_Sitemap_Uninstall();
    Nobird_ImgAlt_Uninstall();
    Nobird_HtmlMinify_Uninstall();
//	$zbp->DelConfig('Nobird_Seo_Tools');

}

?>