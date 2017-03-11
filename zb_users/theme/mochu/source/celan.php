<?php
//最新访客
function mochu_newke ($num){
	    global $zbp,$str,$order;
	$i = $num;	
    $str = '';
    $comments = $zbp->GetCommentList('*', array(array('=', 'comm_IsChecking', 0), array('<>', 'comm_AuthorID','1'),array('<>', 'comm_Name', '访客')), array('comm_PostTime' => 'DESC'),$i , null);
    foreach ($comments as $comment) {      
        $temp=rand(1,8);
        $randimg = $zbp->host . 'zb_users/theme/mochu/img/prand/'.$temp.'.jpg';
        $str .= "<div class=\"newke\"><a href=\"{$comment->Author->HomePage}\" title=\"{$comment->Author->Name}\"  target=\"_blank\" rel=\"nofollow\">";
        $str .='<img src="'.$comment->Author->Avatar.'" alt="'.$comment->Author->Name.'" />';
        $str .="<p>{$comment->Author->Name}</p></a></div>";
        $str .="\r\n";
    }
    return $str;
	
}

//最新评论
function mochu_newcon($num){
	 global $zbp,$str,$order;
	 $str = '';
	 $i = $num;
    $comments = $zbp->GetCommentList('*', array(array('=', 'comm_IsChecking', 0), array('<>', 'comm_AuthorID','1')), array('comm_PostTime' => 'DESC'),$i, null);
    foreach ($comments as $comment) {
        $clpl = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($comment->Content,'[nohtml]'),80)).'');
		$temp=rand(1,8);
        $randimg = $zbp->host . 'zb_users/theme/mochu/img/prand/'.$temp.'.jpg';
        $str .= "<li><span><a href=\"{$comment->Post->Url}#cmt{$comment->ID}\">";
            $str .='<img src="'.$comment->Author->Avatar.'" alt="'.$comment->Author->Name.'" />';
  
        $str .= "</a></span><p><a href=\"{$comment->Post->Url}#cmt{$comment->ID}\">{$clpl}</a></p>
        <small>{$comment->Author->Name} 评论于：{$comment->Time('m-d')}</small>
        </li>";
    }
    return $str;

	}
//热文
function mochu_hot($num){
global $zbp,$str,$order;$i;
    $i = $num;
    $str = '';
    $order = array('log_ViewNums'=>'DESC');
    $where = array(array('=','log_Status','0'));
    $array = $zbp->GetArticleList(array('*'),$where,$order,array($i),'');
    foreach ($array as $related) {
        $str .= "<li><span class=\"lr hui\">{$related->ViewNums}°C</span><a href=\"{$related->Url}\" title=\"{$related->Title}\" target=\"_blank\">{$related->Title}</a></li>";
    }
    return $str;
}
//随标
function mochu_rtag($num){
global $zbp,$str;$i;
    $i = $num;
	$order = '';
  if ($zbp->db->type=="sqlite"){$order = array('random()'=>'');}
   else {$order = array('rand()'=>'');}
    $str = '';
    $array = $zbp->GetTagList('','',$order,$i,'');
    foreach ($array as $tag) {
        $str .= "<li><a href=\"{$tag->Url}\" title=\"{$tag->Name}\" target=\"_blank\">{$tag->Name}</a></li>";
    }
    return $str;
}
//热标
function mochu_htag($num){
global $zbp,$str;$i;
    $i = $num;
    $str = '';
    $array = $zbp->GetTagList('','',array('tag_Count'=>'DESC'),$i,'');
    foreach ($array as $tag) {
        $str .= "<li><a href=\"{$tag->Url}\" title=\"{$tag->Name}\" target=\"_blank\">{$tag->Name}</a></li>";
    }
    return $str;
}
//新文
function mochu_news($num){
global $zbp,$str,$order;$i;
    $i = $num;
    $str = '';
    $order = array('log_PostTime'=>'DESC');
    $where = array(array('=','log_Status','0'));
    $array = $zbp->GetArticleList(array('*'),$where,$order,array($i),'');
    foreach ($array as $related) {
        $str .= "<li><span class=\"lr hui\">{$related->Time('m-d')}</span><a href=\"{$related->Url}\" title=\"{$related->Title}\" target=\"_blank\">{$related->Title}</a></li>";
    }
    return $str;
}
//评文
function mochu_comm($num){
global $zbp,$str,$order;$i;
    $i = $num;
    $str = '';
    $order = array('log_CommNums'=>'DESC');
    $where = array(array('=','log_Status','0'));
    $array = $zbp->GetArticleList(array('*'),$where,$order,array($i),'');
    foreach ($array as $related) {
        $str .= "<li><span class=\"lr hui\">{$related->CommNums}评论</span><a href=\"{$related->Url}\" title=\"{$related->Title}\" target=\"_blank\">{$related->Title}</a></li>";
    }
    return $str;
}
//多个tab侧栏
function mochu_tabname() {
	global $zbp;
     $s = '';
     $s.= '<ul id="tab">
   <li id="one1" onclick="setTab(\'one\',1,4)" class="tabhover" >热门</li>
   <li id="one2" onclick="setTab(\'one\',2,4)" >随机</li>
   <li id="one3" onclick="setTab(\'one\',3,4)" >评论</li>
   <li id="one4" onclick="setTab(\'one\',4,4)" >最新</li>
   <div class="clear"></div>
</ul>';
	return $s;
}
function mochu_tabcn() {
	global $zbp;
	$i = $zbp->modulesbyfilename['tabcelan']->MaxLi;
	if ($i == 0) $i = 10;$s = '';
     $s.= '<dd id="con_one" ><ul id="con_one_1" style="display:block;">'.mochu_hot($i).'</ul>
<ul id="con_one_2" style="display:none">'.mochu_rand($i).'</ul>
<ul id="con_one_3" style="display:none">'.mochu_comm($i).'</ul>
<ul id="con_one_4" style="display:none">'.mochu_news($i).'</ul></dd>';
	return $s;
}
/*
//不用rand()函数的解决方法，去掉注释即可
//随文
function mochu_rand($num){
global $zbp,$str,$order;$i;
    $i = $num;
    $str = '';
	$arr = array();
	$arand = array();
    $order = array('log_ViewNums'=>'ASC');
    $where = array(array('=','log_Status','0'));
    $array = $zbp->GetArticleList(array('*'),$where,$order,array(20),'');
	$arr = array_rand($array,$i);
	for($j=0;$j<$i;$j++)
	{
		$arand[]=$array[$arr[$j]];
		}
    foreach ($arand as $related) {
        $str .= "<li><a href=\"{$related->Url}\" title=\"{$related->Title}\" target=\"_blank\">{$related->Title}</a></li>";
    }

    return $str;
}
*/
//数据库RAND方法，不用加上注释
//随文
function mochu_rand($num){
global $zbp,$str,$order;$i;
    $i = $num;
    $str = '';
	if ($zbp->db->type=="sqlite"){	$order = array('random()'=>'');}
   else {$order = array('rand()'=>'');}
    $where = array(array('=','log_Status','0'));
    $array = $zbp->GetArticleList(array('*'),$where,$order,array($i),'');
    foreach ($array as $related) {
        $str .= "<li><span class=\"lr hui\">{$related->Time('m-d')}</span><a href=\"{$related->Url}\" title=\"{$related->Title}\" target=\"_blank\">{$related->Title}</a></li>";
    }

    return $str;
}
//以下是侧栏目
function mochu_celan()
{	global $zbp;

    if(!isset($zbp->modulesbyfilename['newke']))
	{
		$t = new Module();
		$t->Name = "最新访客";
		$t->FileName = "newke";
		$t->Source = "newke";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "newke";
 		$t->Type = "div";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}

  	if(!isset($zbp->modulesbyfilename['newcon']))
	{
		$t = new Module();
		$t->Name = "最新评论";
		$t->FileName = "newcon";
		$t->Source = "newcon";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "newcon";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}
	  	if(!isset($zbp->modulesbyfilename['htagcelan']))
	{
		$t = new Module();
		$t->Name = "热门标签";
		$t->FileName = "htagcelan";
		$t->Source = "htagcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "htagcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}
	  	if(!isset($zbp->modulesbyfilename['rtagcelan']))
	{
		$t = new Module();
		$t->Name = "随机标签";
		$t->FileName = "rtagcelan";
		$t->Source = "rtagcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "rtagcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}
  	if(!isset($zbp->modulesbyfilename['newcelan']))
	{
		$t = new Module();
		$t->Name = "最新文章";
		$t->FileName = "newcelan";
		$t->Source = "newcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "newcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}

	if(!isset($zbp->modulesbyfilename['hotcelan']))
	{
		$t = new Module();
		$t->Name = "热门文章";
		$t->FileName = "hotcelan";
		$t->Source = "hotcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "hotcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}
	if(!isset($zbp->modulesbyfilename['comcelan']))
	{
		$t = new Module();
		$t->Name = "热评文章";
		$t->FileName = "comcelan";
		$t->Source = "comcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "comcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}
	if(!isset($zbp->modulesbyfilename['randcelan']))
	{
		$t = new Module();
		$t->Name = "随机文章";
		$t->FileName = "randcelan";
		$t->Source = "randcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=false;
		$t->HtmlID = "randcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}	
		if(!isset($zbp->modulesbyfilename['tabcelan']))
	{
		$t = new Module();
		$t->Name = "TAB切换";
		$t->FileName = "tabcelan";
		$t->Source = "tabcelan";
		$t->SidebarID = 0;
		$t->Content = "";
		$t->IsHideTitle=true;
		$t->HtmlID = "tabcelan";
 		$t->Type = "ul";
		$t->MaxLi=8;
		$t->Content = '';
		$t->Save();
	}	
}
///////模块数据调用
function mochu_celanneirong(){
global $zbp;
if(isset($zbp->modulesbyfilename['newcelan'])){
$i = $zbp->modulesbyfilename['newcelan']->MaxLi;
$zbp->modulesbyfilename['newcelan']->Content = mochu_news($i);
}
if(isset($zbp->modulesbyfilename['hotcelan'])){
$i = $zbp->modulesbyfilename['hotcelan']->MaxLi;
$zbp->modulesbyfilename['hotcelan']->Content = mochu_hot($i);
}
if(isset($zbp->modulesbyfilename['comcelan'])){
$i = $zbp->modulesbyfilename['comcelan']->MaxLi;
$zbp->modulesbyfilename['comcelan']->Content = mochu_comm($i);
}
if(isset($zbp->modulesbyfilename['randcelan'])){
$i = $zbp->modulesbyfilename['randcelan']->MaxLi;
$zbp->modulesbyfilename['randcelan']->Content = mochu_rand($i);
}
if(isset($zbp->modulesbyfilename['tabcelan'])){
$i = $zbp->modulesbyfilename['tabcelan']->MaxLi;
$zbp->modulesbyfilename['tabcelan']->Content .= mochu_tabname();
$zbp->modulesbyfilename['tabcelan']->Content .= mochu_tabcn();
}
if(isset($zbp->modulesbyfilename['rtagcelan'])){
$i = $zbp->modulesbyfilename['rtagcelan']->MaxLi;
$zbp->modulesbyfilename['rtagcelan']->Content = mochu_rtag($i);
}
if(isset($zbp->modulesbyfilename['htagcelan'])){
$i = $zbp->modulesbyfilename['htagcelan']->MaxLi;
$zbp->modulesbyfilename['htagcelan']->Content = mochu_htag($i);
}
//最新评论
if(isset($zbp->modulesbyfilename['newcon'])){
$i = $zbp->modulesbyfilename['newcon']->MaxLi;
$zbp->modulesbyfilename['newcon']->Content = mochu_newcon($i);
}
//最新访客
if(isset($zbp->modulesbyfilename['newke'])){
$i = $zbp->modulesbyfilename['newke']->MaxLi;
$zbp->modulesbyfilename['newke']->Content = mochu_newke($i);
}
}
?>