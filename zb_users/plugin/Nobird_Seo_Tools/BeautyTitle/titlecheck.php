<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();

$action='ArticlePst';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

if(count($_POST)>0){
	$title = '';
	$alias = '';
	$id=0;
	if (isset($_POST['title'])) {
	$title = $_POST['title'];
	}

	if (isset($_POST['alias'])) {
	$alias = $_POST['alias'];
	}

	if (isset($_POST['id'])) {
	$id = $_POST['id'];
	}
	
	$array=array();
$array['uid']="0";
if(Nobird_Seo_Tools_CheckSameTitle($title,$id)&&$title){
$array['uid']="-1";
}
if(Nobird_Seo_Tools_CheckSameAlias($alias,$id)&&$alias){
$array['uid']="-2";
}
echo json_encode($array);
}


function Nobird_Seo_Tools_CheckSameTitle($title,$id){
	global $zbp;
    $where=array(
            array('=','log_Title',$title),
            array('<>','log_ID',$id)
    );

$array=$zbp->GetPostList(
  '',
	$where
);

	
	if(count($array)>0){
			//$zbp->SetHint('tips','检测到重复的文章标题，请修改！');
			return true;
	}
	return false;
	}

function Nobird_Seo_Tools_CheckSameAlias($alias,$id){
	global $zbp;
    $where=array(
            array('=','log_Alias',$alias),
            array('<>','log_ID',$id)
    );

$array=$zbp->GetPostList(
  '',
	$where
);

	
	if(count($array)>0){
		//	$zbp->SetHint('tips','检测到重复的文章别名，请修改！');
		return true;
	}
	return false;
	
	}	