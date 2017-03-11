<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('mochu')) {$zbp->ShowError(48);die();}
////图片上传
if($_GET['type'] == 'logo' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/logo.png');

			}
		}
	}
	$zbp->SetHint('good','logo上传成功');
	Redirect('./editor.php?act=jiben');
}

if($_GET['type'] == 'erweio' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/erweio.png');

			}
		}
	}
	$zbp->SetHint('good','图片上传成功');
	Redirect('./editor.php?act=jiben');
}

if($_GET['type'] == 'bgimg' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/bgimg.png');

			}
		}
	}
	$zbp->SetHint('good','背景图片上传成功');
	Redirect('./editor.php?act=yangshi');
}
//zanimg
if($_GET['type'] == 'zanwei' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/zanwei.png');

			}
		}
	}
	$zbp->SetHint('good','微信打赏图片上传成功');
	Redirect('./editor.php?act=jiben');
}
if($_GET['type'] == 'qq' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/qq.png');

			}
		}
	}
	$zbp->SetHint('good','QQ打赏图片上传成功');
	Redirect('./editor.php?act=jiben');
}
if($_GET['type'] == 'zanzhi' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/zanzhi.png');

			}
		}
	}
	$zbp->SetHint('good','支付宝打赏图片上传成功');
	Redirect('./editor.php?act=jiben');
}
if($_GET['type'] == 'ico' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'cache/mochuimg/favicon.ico');

			}
		}
	}
	$zbp->SetHint('good','网站ICO图标上传成功');
	Redirect('./editor.php?act=jiben');
}
if($_GET['type'] == 'duzhe' ){
	global $zbp;
	mochu_Readers();
	$zbp->SetHint('good','读者墙缓存成功');
	Redirect('./editor.php?act=yangshi');
}
if($_GET['type'] == 'guidang' ){
	global $zbp;
	mochu_CacheArchive();
	$zbp->SetHint('good','文章归档缓存成功');
	Redirect('./editor.php?act=yangshi');
}
//////图片END******幻灯片GO
if($_GET['type'] == 'flash' ){
	global $zbp; $mochu_url;
	$mochu_url = '';
	
if(!$_POST["title"] or !$_POST["url"]){
		$zbp->SetHint('bad','标题或链接不能为空');
		Redirect('./editor.php?act=huandeng');
		exit();
	}
if($_POST["img"])
  {$mochu_url = $_POST["img"];}
	else{
		foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/mochu/img/hdpian/'.$name);
				$mochu_url = $zbp->host . 'zb_users/theme/mochu/img/hdpian/'.$_FILES[$key]['name'];
				}
             }}
	
	}
	
	$DataArr = array(
		'sean_Title'=>$_POST["title"],
        'sean_Img'=>$mochu_url,
        'sean_Url'=>$_POST["url"],
		'sean_Order'=>$_POST["order"],
		'sean_IsUsed'=>$_POST["IsUsed"]
	);

	if($_POST["editid"]){
		$where = array(array('=','sean_ID',$_POST["editid"]));
		$sql= $zbp->db->sql->Update($Mochu_CMS_Table,$DataArr,$where);
		$zbp->db->Update($sql);
	}else{
		$sql= $zbp->db->sql->Insert($Mochu_CMS_Table,$DataArr);
		$zbp->db->Insert($sql);
	}
	mochu_huandeng($Mochu_CMS_Table,$Mochu_CMS_DataInfo);
	$zbp->SetHint('good','幻灯片保存成功');
	Redirect('./editor.php?act=huandeng');
}
if($_GET['type'] == 'flashdel' ){
	global $zbp;
	$where = array(array('=','sean_ID',$_GET['id']));
	$sql= $zbp->db->sql->Delete($Mochu_CMS_Table,$where);
	$zbp->db->Delete($sql);
	mochu_huandeng($Mochu_CMS_Table,$Mochu_CMS_DataInfo);
	$zbp->SetHint('good','幻灯片删除成功');
	Redirect('./editor.php?act=huandeng');
}
///幻灯END
?>