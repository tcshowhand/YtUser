<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('mizhe')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'base' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/mizhe/include/logo.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=base');
}

if($_GET['type'] == 'bg' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/mizhe/include/bg.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=base');
}

if($_GET['type'] == 'flash' ){
	global $zbp;
	
	if(!$_POST["title"] or !$_POST["img"] or !$_POST["url"]){
		$zbp->SetHint('bad','标题或图片或链接不能为空');
		Redirect('./main.php?act=flash');
		exit();
	}
	
	$DataArr = array(
		't_Title'=>$_POST["title"],
		't_Img'=>$_POST["img"],
		't_Url'=>$_POST["url"],
		't_Order'=>$_POST["order"],
		't_IsUsed'=>$_POST["IsUsed"]
	);

	if($_POST["editid"]){
		$where = array(array('=','t_ID',$_POST["editid"]));
		$sql= $zbp->db->sql->Update($mizhe_Table,$DataArr,$where);
		$zbp->db->Update($sql);
	}else{
		$sql= $zbp->db->sql->Insert($mizhe_Table,$DataArr);
		$zbp->db->Insert($sql);
	}
	mizhe_Get_Flash($mizhe_Table,$mizhe_DataInfo);
	$zbp->SetHint('good','幻灯保存成功');
	Redirect('./main.php?act=flash');
}

if($_GET['type'] == 'flashdel' ){
	global $zbp;
	$where = array(array('=','t_ID',$_GET['id']));
	$sql= $zbp->db->sql->Delete($mizhe_Table,$where);
	$zbp->db->Delete($sql);
	mizhe_Get_Flash($mizhe_Table,$mizhe_DataInfo);
	$zbp->SetHint('good','删除成功');
	Redirect('./main.php?act=flash');
}


?>