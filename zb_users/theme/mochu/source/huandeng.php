<?php
$Mochu_CMS_Table='%pre%Mochu_CMS';
$Mochu_CMS_DataInfo=array(
    'ID'=>array('sean_ID','integer','',0),
    'Type'=>array('sean_Type','integer','',0),
    'Title'=>array('sean_Title','string',255,''),
    'Url'=>array('sean_Url','string',255,''),
    'Img'=>array('sean_Img','string',255,''),
    'Order'=>array('sean_Order','integer','',99),
    'Code'=>array('sean_Code','string',255,''),
    'IsUsed'=>array('sean_IsUsed','boolean','',true),
    'Intro'=>array('sean_Intro','string',255,''),
    'Addtime'=>array('sean_Addtime','integer','',0),
    'Endtime'=>array('sean_Endtime','integer','',0),
);

function Mochu_CMS_CreateTable(){
    global $zbp;
    $s=$zbp->db->sql->CreateTable($GLOBALS['Mochu_CMS_Table'],$GLOBALS['Mochu_CMS_DataInfo']);
    $zbp->db->QueryMulit($s);
}

function mochu_huandeng($Mochu_CMS_Table,$Mochu_CMS_DataInfo){
    global $zbp;
    $where = array(array('=','sean_Type','0'),array('=','sean_IsUsed','1'));
    $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
    $sql= $zbp->db->sql->Select($Mochu_CMS_Table,'*',$where,$order,null,null);
    $array=$zbp->GetListCustom($Mochu_CMS_Table,$Mochu_CMS_DataInfo,$sql);
    $i =1;
    $str = '<div class="huandeng"> <ul class="rslides" id="slider1">';
    foreach ($array as $key => $reg) {
        $str .= '<li><a href="'.$reg->Url.'" title="'.$reg->Title.'" target="_blank"><img alt="'.$reg->Title.'" src="'.$reg->Img.'" /><p class="caption">'.$reg->Title.'</p></a></li>';
        $i++;
    }
    $str .='</ul></div>';
 @file_put_contents($zbp->usersdir . 'theme/'.$zbp->theme.'/template/mochu_huandeng.php', $str);}
?>