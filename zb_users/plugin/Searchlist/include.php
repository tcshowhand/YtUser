<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function' . DIRECTORY_SEPARATOR . 'searchstr.php';
RegisterPlugin("Searchlist","ActivePlugin_Searchlist");

function ActivePlugin_Searchlist() {
	Add_Filter_Plugin('Filter_Plugin_Search_Begin','Searchlist_Main');

}

function Searchlist_Main() {
	global $zbp;
	foreach ($GLOBALS['Filter_Plugin_ViewSearch_Begin'] as $fpname => &$fpsignal) {
		$fpreturn = $fpname();
		if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
			$fpsignal=PLUGIN_EXITSIGNAL_NONE;return $fpreturn;
		}
	}
	if(!$zbp->CheckRights($GLOBALS['action'])){Redirect('./');}
	$q = trim(htmlspecialchars(GetVars('q','GET')));
	$qc = '<span class=\'schwords\'>' . $q . '</span>';
	$page = GetVars('page', 'GET');
    $page = (int) $page == 0 ? 1 : (int) $page;
    $article = new Post;
    $article->ID = 0;
    $article->Title = "搜索有关【 $q 】的内容：";
    $article->IsLock = true;
    $article->Type = ZC_POST_TYPE_PAGE;
	$p=new Pagebar('{%host%}search.php?q='.$q.'{&page=%page%}',false);
	$p->PageCount=5;
	$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
	$p->PageBarCount=$zbp->pagebarcount;
	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
	$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');
    $w=array();
	$w[]=array('=','log_Type','0');
    $cid = trim(htmlspecialchars(GetVars('cid','GET')));
    if($cid){
		$w[]=array('search','log_CateID',$cid);
	}
	if($q){
		$w[]=array('search','log_Content','log_Intro','log_Title',$q);
	}else{
		Redirect('./');
	}
	if(!($zbp->CheckRights('ArticleAll')&&$zbp->CheckRights('PageAll'))){
		$w[]=array('=','log_Status',0);
	}
	$s='';
	$or=array('log_PostTime'=>'DESC');
	$l=array(($p->PageNow-1) * $p->PageCount,$p->PageCount);
	$op=array('pagebar'=>$p);
    $array = $zbp->GetArticleList($s, $w, $or, $l, $op, false);
    foreach($array as $arrays){
		$intro = preg_replace('/[\r\n\s]+/', '', trim(Searchlist_SubStrStartUTF8(TransferHTML($arrays->Content,'[nohtml]'),$q,$zbp->Config('thope')->PostINTRONUM)) . '...');
		$arrays->Intro = str_ireplace($q,$qc,$intro);
		$arrays->Title = str_ireplace($q,$qc,$arrays->Title);
	}
	$mt=microtime();
	$template = $zbp->option['ZC_INDEX_DEFAULT_TEMPLATE'];
	$zbp->template->SetTags('title', $article->Title);
    $zbp->template->SetTags('article', $article);
    $zbp->template->SetTags('articles', $array);
    $zbp->template->SetTags('type', $article->TypeName);
    $zbp->template->SetTags('page', $page);
    $zbp->template->SetTags('pagebar', $p);
    $zbp->template->SetTags('comments', array());
    if($zbp->template->hasTemplate('search')){
		$zbp->template->SetTemplate($template);
	} else {
		$zbp->template->SetTemplate('index');
	}
    foreach ($GLOBALS['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	RunTime();
	die();
}

function InstallPlugin_Searchlist() {
	global $zbp;

}

function UninstallPlugin_Searchlist() {
	global $zbp;

}