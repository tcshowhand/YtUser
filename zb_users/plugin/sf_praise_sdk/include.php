<?php
#注册插件
RegisterPlugin("sf_praise_sdk","ActivePlugin_sf_praise_sdk");
require dirname(__FILE__).'/sf_praise_sdk.php';

function ActivePlugin_sf_praise_sdk() {
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','sf_praise_sdk_makeTemplatetags');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Begin','sf_praise_sdk_post_begin');
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Succeed','sf_praise_sdk_post_succeed');
	Add_Filter_Plugin('Filter_Plugin_DelArticle_Succeed','sf_praise_sdk_post_delete');
	
}
function InstallPlugin_sf_praise_sdk() {
	SF_praise_sdk::createDb();
	sf_praise_sdk_checkconfig();
}
function UninstallPlugin_sf_praise_sdk() {
	//这个就不删了，免得表都没了,界面提供重置
	//	SF_praise_sdk::dropDb();
}

function sf_praise_sdk_makeTemplatetags(&$template){
	global $zbp;
	if($zbp->CheckPlugin('duoshuo')){
		//多说插件会干掉底部脚本，只能放头部了
		$zbp->header .= "<script type=\"text/javascript\" src=\"{$zbp->host}zb_users/plugin/sf_praise_sdk/js/sf_praise_sdk.js\"></script>\r\n";	
	}else{
		$zbp->footer .= "<script type=\"text/javascript\" src=\"{$zbp->host}zb_users/plugin/sf_praise_sdk/js/sf_praise_sdk.js\"></script>\r\n";	
	}
}

function sf_praise_sdk_post_begin($id,$alias){
	global $zbp;
	if($id!=null){
		$sf_praise_sdk=SF_praise_sdk::findPostCount($id);
		$zbp->template->SetTags('sf_praise_sdk',$sf_praise_sdk);
	}else if($alias!=null){
		if($zbp->option['ZC_POST_ALIAS_USE_ID_NOT_TITLE']==false){
			$w[] = array('array', array(array('log_Alias', $alias), array('log_Title', $alias)));
		}else{
			$w[] = array('array', array(array('log_Alias', $alias), array('log_ID', $alias)));
		}
		if (!($zbp->CheckRights('ArticleAll') && $zbp->CheckRights('PageAll'))) {
			$w[] = array('=', 'log_Status', 0);
		}
		$articles = $zbp->GetPostList('*', $w, null, 1, null);
		if (count($articles) > 0) {
			$article = $articles[0];
			$sf_praise_sdk=SF_praise_sdk::findPostCount($article->ID);
			$zbp->template->SetTags('sf_praise_sdk',$sf_praise_sdk);
		}
	}
}

function sf_praise_sdk_post_delete($article){
	$sf_praise=new SF_praise_sdk();
	$sf_praise->deleteBase($article->ID);
}

function sf_praise_sdk_post_succeed($article){
	$sf_praise_sdk=new SF_praise_sdk();
	$sf_praise_sdk->saveBase($article->ID);
}

function sf_praise_sdk_checkconfig(){
	global $zbp;
	if(!$zbp->Config('sf_praise_sdk')->HasKey('version')) {
		$zbp->Config('sf_praise_sdk')->version="1.0";
		$zbp->Config('sf_praise_sdk')->basevalue="0,0,0,0,0";
		$zbp->Config('sf_praise_sdk')->addvalue="0,0,0,0,0";
		$zbp->SaveConfig('sf_praise_sdk');	
	}
}