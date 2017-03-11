<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();


if (!$zbp->CheckPlugin('sf_praise_sdk')) {$zbp->ShowError(48);die();}

$sf_praise_value=GetVars("sf_praise_value","POST");
$postid=GetVars("postid","POST");

if(empty($sf_praise_value)==false && empty($postid)==false){
	$sf_praise_sdk=new SF_praise_sdk();
	$flag=$sf_praise_sdk->savePostCount($postid,$sf_praise_value);
	if($flag==true){
		echo "ok";
	}else{
		echo "check";
	}
}else{
	echo 'error';
}

?>