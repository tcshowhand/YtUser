<?php
//搜索优化
function dmam_SearchPlus_Main() {
	global $zbp;
	if (!$zbp->Config('dmam')->new_search){
	
	$q = trim(htmlspecialchars(GetVars('q','GET')));
	$zbp->template->SetTags('searchq',$q);
	
	}else{
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
	$zbp->title = $zbp->lang['msg']['search'] . ' &quot;' . $q . '&quot;';
	$template = $zbp->option['ZC_INDEX_DEFAULT_TEMPLATE'];
/* 	if($zbp->template->hasTemplate('b_search')){
		$template = 'b_search';
	} */
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
	foreach($articles as $article){
		$article->Intro = str_ireplace($q,$qc,trim(dmam_SubStrStartUTF8($article->Intro,$q,90) . '...'));
		$article->Content = str_ireplace($q,$qc,trim(dmam_SubStrStartUTF8($article->Content,$q,90) . '...')); 
		$article->Title = str_ireplace($q,$qc,$article->Title);
	}
	$zbp->header .= '<meta name="robots" content="noindex,follow">' . "\r\n";
	$zbp->template->SetTags('title', $zbp->title);
	$zbp->template->SetTags('articles',$articles);
	$zbp->template->SetTags('page',1);
	$zbp->template->SetTags('pagebar',$pagebar);
	$zbp->template->SetTags('type','search');
	$zbp->template->SetTags('searchq',$q);
	$zbp->template->SetTemplate($template);
	foreach ($GLOBALS['Filter_Plugin_ViewList_Template'] as $fpname => &$fpsignal) {
		$fpreturn=$fpname($zbp->template);
	}
	$zbp->template->Display();
	RunTime();
	die();
	}
}
function dmam_SubStrStartUTF8($sourcestr,$startstr,$cutlength) {
	global $zbp;
	if( function_exists('mb_substr') && function_exists('mb_internal_encoding') && function_exists('mb_stripos') ){
		mb_internal_encoding('UTF-8');
		return mb_substr($sourcestr, mb_stripos($sourcestr, $startstr), $cutlength);
	}
	if( function_exists('iconv_substr') && function_exists('iconv_set_encoding') && function_exists('iconv_strpos') ){
		iconv_set_encoding ( "internal_encoding" ,  "UTF-8" );
		iconv_set_encoding ( "output_encoding" ,  "UTF-8" );
		return iconv_substr($sourcestr, iconv_strpos($sourcestr, $startstr), $cutlength);
	}
	$returnstr = '';
	$i = stripos($sourcestr, $startstr);
	$n = 0;
	$str_length = strlen($sourcestr);
	while (($n < $cutlength) and ($i <= $str_length)) {
		$temp_str = substr($sourcestr, $i, 1);
		$ascnum = Ord($temp_str);
		if ($ascnum >= 224)
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 3);
			$i = $i + 3;
			$n++;
		} elseif ($ascnum >= 192)
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 2);
			$i = $i + 2;
			$n++;
		} elseif ($ascnum >= 65 && $ascnum <= 90)
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 1);
			$i = $i + 1;
			$n++;
		} else
		{
			$returnstr = $returnstr . substr($sourcestr, $i, 1);
			$i = $i + 1;
			$n = $n + 0.5;
		}
	}
	if ($str_length > $cutlength) {
		$returnstr = $returnstr;
	}
	return $returnstr;
}
?>