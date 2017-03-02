<?php
$dmam_Slide_Table = '%pre%dmam_slide';
$dmam_Slide_DataInfo = array(
    'ID'=>array('slide_ID','integer','',0),
    'Type'=>array('slide_Type','integer','',0),
    'Title'=>array('slide_Title','string',255,''),
    'Url'=>array('slide_Url','string',255,''),
    'Img'=>array('slide_Img','string',255,''),
    'Order'=>array('slide_Order','integer','',99),
    'Code'=>array('slide_Code','boolean','',true),
    'IsUsed'=>array('slide_IsUsed','boolean','',true),
    'Intro'=>array('slide_Intro','string',255,''),
    'Addtime'=>array('slide_Addtime','integer','',0),
    'Endtime'=>array('slide_Endtime','integer','',0),
);

function dmam_Slide_Get_Flash($dmam_Slide_Table,$dmam_Slide_DataInfo){
    global $zbp;
	$inner = '';
	$blank='';
	$s = '';
    $where = array(array('=','slide_Type','0'),array('=','slide_IsUsed','1'));
    $order = array('slide_IsUsed'=>'DESC','slide_Order'=>'ASC');
    $sql= $zbp->db->sql->Select($dmam_Slide_Table,'*',$where,$order,null,null);
    $array=$zbp->GetListCustom($dmam_Slide_Table,$dmam_Slide_DataInfo,$sql);
	$count_pics = count($array);
    foreach ($array as $key => $reg) {
		$keykey = $key+1;
		$inner .= '<li><a '.dmam_isblank($reg->Code).' href="'.$reg->Url.'"><img alt="'.$reg->Title.'" src="'.$reg->Img.'"></a><div class="am-slider-desc"><div class="am-slider-counter"><span class="am-active">'.$keykey.'</span>/'.$count_pics.'</div>'.$reg->Title.'</div></li>';
    }
      
	$s .='<div data-am-widget="slider" class="dm-slide-index am-slider am-slider-c3" data-am-slider="{&quot;controlNav&quot;:false}" ><ul class="am-slides">';
	$s .=$inner;
	$s .='</ul></div>';

    return $s;
}

function dmam_slide($hello){
	global $zbp,$dmam_Slide_Table,$dmam_Slide_DataInfo;
	$s ='';
	if ($hello){
		$s = dmam_Slide_Get_Flash($dmam_Slide_Table,$dmam_Slide_DataInfo);
		}
	return $s;
}
?>