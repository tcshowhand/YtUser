<?php
$DEFALUT_FLASH="5qyi6L+O5L2/55So5ouT5rqQWkJQ5Zui6LSt5Li76aKYbWl6aGUhfHpiX3VzZXJzL3RoZW1lL21pemhlL2luY2x1ZGUvc2xpZGUwMS5qcGd8aHR0cDovL3d3dy50b3llYW4uY29tLw==";
$mizhe_Table='%pre%mizhe';
$mizhe_DataInfo=array(
	'ID'=>array('t_ID','integer','',0),
	'Type'=>array('t_Type','integer','',0),
	'Title'=>array('t_Title','string',255,''),
	'Url'=>array('t_Url','string',255,''),
	'Img'=>array('t_Img','string',255,''),
	'Order'=>array('t_Order','integer','',99),
	'Code'=>array('t_Code','string',255,''),
	'IsUsed'=>array('t_IsUsed','boolean','',true),
	'Intro'=>array('t_Intro','string',255,''),
	'Addtime'=>array('t_Addtime','integer','',0),
	'Endtime'=>array('t_Endtime','integer','',0),
);
$mizhe_Default_Data = array('new','hot','comm','rand');

function mizhe_SubMenu($id){
	$arySubMenu = array(
		0 => array('网站设置', 'base', 'left', false),
		1 => array('幻灯设置', 'flash', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'"><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function mizhe_Get_Flash($mizhe_Table,$mizhe_DataInfo){
	global $zbp;
	$where = array(array('=','t_Type','0'),array('=','t_IsUsed','1'));
	$order = array('t_IsUsed'=>'DESC','t_Order'=>'ASC');
	$sql= $zbp->db->sql->Select($mizhe_Table,'*',$where,$order,null,null);
	$array=$zbp->GetListCustom($mizhe_Table,$mizhe_DataInfo,$sql);
	$str = "";
	foreach ($array as $key => $reg) {
		$str .= "<li><a href='".$reg->Url."' style='background:url(".$reg->Img.") no-repeat center;' title='".$reg->Title."' target='_blank'></a></li>";
	}
	@file_put_contents($zbp->usersdir . 'theme/mizhe/include/slide.php', $str);
}



function mizhe_Get_Content($str){
	global $zbp;
	$strContent = @file_get_contents($zbp->usersdir . $str);
	echo $strContent;
}
?>