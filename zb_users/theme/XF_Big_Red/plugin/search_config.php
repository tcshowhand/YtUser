<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'searchstr.php';
function XF_Big_Red_SearchMain() {
	global $zbp;
	foreach ($GLOBALS['Filter_Plugin_ViewSearch_Begin'] as $fpname => &$fpsignal) {
		$fpreturn = $fpname();
		if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
			$fpsignal=PLUGIN_EXITSIGNAL_NONE;return $fpreturn;
		}
	}
	if(!$zbp->CheckRights($GLOBALS['action'])){Redirect('./');}
	$q = trim(htmlspecialchars(GetVars('q','GET')));
	$qc = '<b style=\'color:red\'>' . $q . '</b>';
	$articles = array();
	$category = new Metas;
	$author = new Metas;
	$tag = new Metas;
	$zbp->title = '有关【' . $q . '】的内容：';
	$template = $zbp->option['ZC_INDEX_DEFAULT_TEMPLATE'];
	if($zbp->template->hasTemplate('search')){
		$template = 'search';
	}
	$w=array();
	$w[]=array('=','log_Type','0');
	if($q){
		$w[]=array('search','log_Content','log_Intro','log_Title',$q);
	}else{
		Redirect('./');
	}
	if(!($zbp->CheckRights('ArticleAll')&&$zbp->CheckRights('PageAll'))){
		$w[]=array('=','log_Status',0);
	}
$pagebar=new Pagebar('{%host%}search.php?{q='.$q.'}&{page=%page%}',false);
$pagebar->PageCount=$zbp->displaycount; 
$pagebar->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$pagebar->PageBarCount=$zbp->pagebarcount;
	$articles = $zbp->GetArticleList(
		'*', 
		$w,
		array('log_PostTime' => 'DESC'), array(($pagebar->PageNow - 1) * $pagebar->PageCount, $pagebar->PageCount),
		array('pagebar' => $pagebar),
		null
	);
if ($articles){
	foreach($articles as $article){
		$intro = preg_replace('/[\r\n\s]+/', '', trim(XF_Big_Red_SubStrStartUTF8(TransferHTML($article->Content,'[nohtml]'),$q,150)) . '...');
		$article->Intro = str_ireplace($q,$qc,$intro);
		$article->Title = str_ireplace($q,$qc,$article->Title);
	}
		$zbp->template->SetTags('XF_Big_RedSearchSubtitle','');
}else{
   	$zbp->title = '没有找到有关【' . $q . '】的内容！';
		$zbp->template->SetTags('XF_Big_RedSearchSubtitle','');
    $pagebar='';
    foreach($articles as $article){
		$article->Intro = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),150)).'...');
    }
}
	$zbp->header .= '<meta name="robots" content="noindex,follow" />' . "\r\n";
	$zbp->template->SetTags('title', $zbp->title);
	$zbp->template->SetTags('articles',$articles);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',$pagebar);
	if ($zbp->template->hasTemplate('search')) {
		$zbp->template->SetTemplate($template);
	} else {
		$zbp->template->SetTemplate('index');
	}
	foreach ($GLOBALS['Filter_Plugin_ViewList_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	} 
	$zbp->template->Display();
	RunTime();
	die();
}
?>