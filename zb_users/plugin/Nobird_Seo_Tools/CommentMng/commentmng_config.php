<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class_ip.php';   

function Nobird_Seo_Tools_CommentMng_Main(){

	global $zbp;
	echo '<div class="divHeader">评论批量管理 - Nobird_Seo_Tools - Nobird为您提供的SEO功能</div>';
	echo '<div class="SubMenu">';
/*		foreach ($GLOBALS['Filter_Plugin_Admin_CommentMng_SubMenu'] as $fpname => &$fpsignal) {
		$fpname();
	} //注释掉了  这个接口不正常
	*/
		$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
	echo '<a href="'. $zbp->host .'zb_system/admin/?act=CommentMng"><span class="m-left">系统评论管理</span></a>';
		echo '<a href="'. $zbp->host .'zb_users/plugin/Nobird_Seo_Tools/CommentMng/commentmng.php"><span class="m-left ' . ($filename=='commentmng.php'?'m-now':'') . '">评论SEO管理</span></a>';
	echo '<a href="'. $zbp->host .'zb_system/admin/?act=CommentMng&ischecking=1"><span class="m-left">审核评论</span></a>';
//可批量删除评论、批量屏蔽昵称，批量删除URL地址
	echo '</div>';
	echo '<div id="divMain2">';
if(!file_exists('qqwry.dat')&&$zbp->host!="http://www.birdol.com/"){
echo '<span style="color:#F00">错误！请按照插件下载页面的提示安装纯真IP地址库！</span>';   
exit();   
}


	echo '<form class="search" id="search" method="post" action="#">';
	echo '<p>' . $zbp->lang['msg']['search'] . '&nbsp;&nbsp;&nbsp;&nbsp;<input name="search" style="width:450px;" type="text" value="" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="button" value="' . $zbp->lang['msg']['submit'] . '"/></p>';
	echo '</form>';
	echo '<form method="post" action="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/CommentMng/mng.php">';
	echo '<table border="1" class="tableFull tableBorder tableBorder-thcenter">';
	echo '<tr>
	<th>' . $zbp->lang['msg']['id'] . '</th>
	<th>' . $zbp->lang['msg']['parend_id'] . '</th>
	<th>' . $zbp->lang['msg']['name'] . '</th>
	<th>IP/所在地</th>
	<th>网址/邮箱</th>
	<th>' . $zbp->lang['msg']['content'] . '</th>
	<th>编辑</th>
	<th>' . $zbp->lang['msg']['article'] . '</th>
	<th>' . $zbp->lang['msg']['date'] . '</th>
	<th><a href="" onclick="BatchSelectAll();return false;">' . $zbp->lang['msg']['select_all'] . '</a></th>
	</tr>';

$p=new Pagebar('{%host%}zb_users/plugin/Nobird_Seo_Tools/CommentMng/commentmng.php?act=CommentMng{&page=%page%}{&search=%search%}',false);
$p->PageCount=$zbp->managecount;
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;

$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));

$w=array();
if(!$zbp->CheckRights('CommentAll')){
	$w[]=array('=','comm_AuthorID',$zbp->user->ID);
}
if(GetVars('search')){
	$w[]=array('search','comm_Content','comm_Name',GetVars('search'));
}

//$w[]=array('=','comm_Ischecking',(int)GetVars('ischecking'));



$array=$zbp->GetCommentList(
	'',
	$w,
	array('comm_ID'=>'DESC'),
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p)
);

foreach ($array as $cmt) {
	
	$article = new Post;
	if (!$article->LoadInfoById($cmt->LogID)) $article = NULL;
$p->UrlRule->Rules['{%ischecking%}']=(boolean)GetVars('ischecking');
if($cmt->IsChecking){
	echo '<tr style="background-color:#996699;color:#fff;">';
}else{
	echo '<tr>';
}
	echo '<td class="td5">' . $cmt->ID .  '</td>';
	echo '<td class="td5">' . $cmt->ParentID . '</td>';
	echo '<td class="td5">' . $cmt->Author->Name . '</td>';
$ip = new nobird_seo_tools_ip();
$addr = $ip -> ip2addr($cmt->IP);
	echo '<td class="td15">' . $cmt->IP . '<br />'. $addr['country'].$addr['area'] . '</td>';
	echo '<td class="td10">' . $cmt->Author->HomePage . '<br />'. $cmt->Author->Email . '</td>';
	echo '<td><div style="overflow:hidden;max-width:500px;">';
	if ($article)
		echo '<a href="'. $article->Url . '" target="_blank"><img src="../../../../zb_system/image/admin/link.png" alt="" title="" width="16" /></a> ';
	else
		echo '<a href="javascript:void(0)"><img src="../../../../zb_system/image/admin/delete.png" alt="no exists" title="no exists" width="16" /></a>';
	echo $cmt->Content . '<div></td>';
	echo '<td class="td5"><a href="../../../../zb_users/plugin/Nobird_Seo_Tools/CommentMng/comment_edit.php?act=CmtEdt&amp;id='. $cmt->ID .'"><img src="../../../../zb_system/image/admin/comment_edit.png" alt="'.$zbp->lang['msg']['edit'] .'" title="'.$zbp->lang['msg']['edit'] .'" width="16" /></a></td>';
	echo '<td class="td5">' . $cmt->LogID .  '</td>';
	echo '<td class="td10">' .$cmt->Time() . '</td>';

	echo '<td class="td5 tdCenter">' . '<input type="checkbox" id="id'.$cmt->ID.'" name="id[]" value="'.$cmt->ID.'"/>' . '</td>';

	echo '</tr>';
}
	echo '</table>';
	echo '<hr/>';

	echo'<p style="float:right;">';


		echo '<input type="submit" name="all_rename"  value="批量屏蔽用户名"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="submit" name="all_xurl"  value="批量屏蔽网址"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="submit" name="all_xcomment"  value="批量屏蔽评论内容"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="submit" name="all_xall"  value="同时执行左侧三个任务"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
if ($zbp->CheckPlugin('Geetest')) {
		echo '<input type="submit" name="submit_spam"  value="提交为Spam"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="submit" name="submit_blackip"  value="IP加入黑名单"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		echo '<input type="submit" name="submit_ham"  value="这不是Spam"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

}


	echo '</p>';

	echo'<p class="pagebar">';

foreach ($p->buttons as $key => $value) {
	echo '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}

	echo '</p>';


	echo '<hr/></form>';



	echo '</div>';
	echo '<script type="text/javascript">ActiveLeftMenu("aCommentMng");</script>';
	echo '<script type="text/javascript">AddHeaderIcon("'. $zbp->host . 'zb_system/image/common/comments_32.png' . '");</script>';
}



?>