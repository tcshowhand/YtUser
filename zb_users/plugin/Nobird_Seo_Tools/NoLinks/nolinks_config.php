<?php

function Nobird_Seo_Tools_ViewComments_Template(&$template){
	global $zbp;
if ($zbp->Config('Nobird_NoLinks')->Use_NoLinks=="1"){	
		$comments = &$template->GetTags('comments');
	#	$comment = array();
	foreach ($comments as $comment) {
		$comment->Author->HomePage=$comment->HomePage=$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/NoLinks/urlredirect.php?url='.Nobird_lock_url($comment->Author->HomePage,$zbp->Config('Nobird_NoLinks')->NoLinkskey);
}
}
}

function Nobird_Seo_Tools_ViewComments_Template2(&$template){
	global $zbp;
if ($zbp->Config('Nobird_NoLinks')->Use_NoLinks=="1"){	
$comments = $template->GetTags('comments');
		$rootid = array();
	foreach ($comments as $comment) {
		$rootid[] = array('comm_RootID', $comment->ID);
		$comment->HomePage=$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/NoLinks/urlredirect.php?url='.Nobird_lock_url($comment->HomePage,$zbp->Config('Nobird_NoLinks')->NoLinkskey);
	}
	
			$comments2 = $zbp->GetCommentList(
		'*',
		array(
			array('=', 'comm_LogID', $comment->Post->ID),
			array('array', $rootid),
			array('=', 'comm_IsChecking', 0),
		),
		array('comm_ID' => ($zbp->option['ZC_COMMENT_REVERSE_ORDER'] ? 'DESC' : 'ASC')),
		null,
		null
	);

	foreach ($comments2 as &$comment) {
		$comment->HomePage=$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/NoLinks/urlredirect.php?url='.Nobird_lock_url($comment->HomePage,$zbp->Config('Nobird_NoLinks')->NoLinkskey);
	}	
}
}




//改进第一改加密之后的算法
// 简化了... 2015.08.20
//加密函数
function Nobird_lock_url($url,$key='Nobird'){
	$url = $url.$key;

    return urlencode(base64_encode($url));
}



function Nobird_NoLinks_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_NoLinks')->HasKey('Version')) {
	$zbp->Config('Nobird_NoLinks')->Version = '1.0';
	$zbp->Config('Nobird_NoLinks')->NoLinkskey= 'Nobird';	
	$zbp->Config('Nobird_NoLinks')->Use_NoLinks =1;
	$zbp->SaveConfig('Nobird_NoLinks');
	}
	
}



function Nobird_NoLinks_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_NoLinks');
}

