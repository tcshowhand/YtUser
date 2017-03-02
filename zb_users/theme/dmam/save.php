<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('dmam')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'flash' ){
	global $zbp;
	
	if(!$_POST["title"] or !$_POST["img"] or !$_POST["url"]){
		$zbp->SetHint('bad','标题或图片或链接不能为空');
		Redirect('main.php?act=ddd');
		exit();
	}
	
	$DataArr = array(
		'slide_Title'=>$_POST["title"],
		'slide_Img'=>str_replace($zbp->host,"{#ZC_BLOG_HOST#}",$_POST["img"]),
		'slide_Url'=>str_replace($zbp->host,"{#ZC_BLOG_HOST#}",$_POST["url"]),
		'slide_Code'=>$_POST["Code"],
		'slide_Order'=>$_POST["Order"],
		'slide_IsUsed'=>$_POST["IsUsed"]
	);

	if($_POST["editid"]){
		$where = array(array('=','slide_ID',$_POST["editid"]));
		$sql= $zbp->db->sql->Update($dmam_Slide_Table,$DataArr,$where);
		$zbp->db->Update($sql);
	}else{
		$sql= $zbp->db->sql->Insert($dmam_Slide_Table,$DataArr);
		$zbp->db->Insert($sql);
	}
	dmam_Slide_Get_Flash($dmam_Slide_Table,$dmam_Slide_DataInfo);
	$zbp->SetHint('good','幻灯保存成功');
	Redirect('main.php?act=slide');
}

if($_GET['type'] == 'flashdel' ){
	global $zbp;
	$where = array(array('=','slide_ID',$_GET['id']));
	$sql= $zbp->db->sql->Delete($dmam_Slide_Table,$where);
	$zbp->db->Delete($sql);
	dmam_Slide_Get_Flash($dmam_Slide_Table,$dmam_Slide_DataInfo);
	$zbp->SetHint('good','删除成功');
	Redirect('main.php?act=other');
}
if($_GET['type'] == 'readers_cache' ){
	global $zbp;
	dmam_page_readers_cache('page');
	$zbp->SetHint('good','读者墙已缓存');
	Redirect('main.php?act=other');
}
if($_GET['type'] == 'archive_cache' ){
	global $zbp;
	dmam_page_archive_cache();
	$zbp->SetHint('good','文章归档已缓存');
	Redirect('main.php?act=other');
}
if($_GET['type'] == 'create_module' ){
	global $zbp;
	dmam_create_module();
	$zbp->SetHint('good','需要更新主题自带模块请删除该模块再点击 重建模块 或者直接重新保存一次模块即可');
	Redirect('main.php?act=other');
}
/* if($_GET['type'] == "del_img"){
	$file=$blogpath.'static/';
	if(file_exists($file)){
		IMAGE_deleteDir($file);
	}
	$zbp->SetHint('good','image缓存清理成功');
	Redirect('main.php?act=other');
} */
?>