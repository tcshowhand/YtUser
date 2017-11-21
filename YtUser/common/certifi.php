<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
if(!$zbp->CheckValidCode(GetVars('verifycode','POST'),'Certifi')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}

if(!idcard_number(GetVars('idcard','POST'))){
	echo '身份证错误';die();
}

$ytuser = new Ytuser();
$ytuser->YtInfoByField('Uid',$zbp->user->ID);
$ytuser->Name=htmlspecialchars(GetVars('name','POST'));
$ytuser->Idcard=htmlspecialchars(GetVars('idcard','POST'));
$ytuser->Isidcard=1;
$ytuser->Save();
echo '提交成功，等待审核！';die();

function idcard_verify_number($idcard_base){
	if (strlen($idcard_base) != 17){ return false; }
	// 加权因子
	$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	// 校验码对应值
	$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	$checksum = 0;
	for ($i = 0; $i < strlen($idcard_base); $i++){
		$checksum += substr($idcard_base, $i, 1) * $factor[$i];
	}
	$mod = strtoupper($checksum % 11);
	$verify_number = $verify_number_list[$mod];
	return $verify_number;
}

function idcard_number($idcard){
	//18位身份证校验码有效性检查function idcard_checksum18($idcard){
	if (strlen($idcard) != 18){ return false; }
	$aCity = array(11 => "北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",
	21=>"辽宁",22=>"吉林",23=>"黑龙江",
	31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",
	41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",
	50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",
	61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",
	71=>"台湾",81=>"香港",82=>"澳门",
	91=>"国外");
	//非法地区
	if (!array_key_exists(substr($idcard,0,2),$aCity)) {
		return false;
	}
	//验证生日
	if (!checkdate(substr($idcard,10,2),substr($idcard,12,2),substr($idcard,6,4))) {
		return false;
	}
	$idcard_base = substr($idcard, 0, 17);
	if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
		return false;
	}else{
		return true;
	}
}

?>