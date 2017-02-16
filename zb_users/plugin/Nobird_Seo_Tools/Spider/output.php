<?php
@set_time_limit(0);

require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

        $where = '';
        $order = array('t_ID'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $Nobird_Spider_Table,
        '*',
        $where,
        $order,
        '',
        ''
        );
        $array=$zbp->GetListCustom($Nobird_Spider_Table,$Nobird_Spider_DataInfo,$sql);
header("Content-type:application/vnd.ms-excel");
header('Content-type: charset=GB2312');
header("Content-Type: application/force-download");

header('Pragma: no-cache');
HEADER('Expires: 0');
header("Content-Disposition:filename=蜘蛛来访记录".date("Ymd",time()).".xls");
$str='';
$str.= "序号\t";
$str.= "蜘蛛名称\t";
$str.= "来访IP\t";
$str.= "抓取链接\t";
$str.= "抓取状态\t";
$str.= "来访时间\t\r\n";

echo iconv("UTF-8","GB2312//IGNORE",$str);


foreach ($array as $key => $spider) {

 echo $spider->ID."\t";
 echo iconv("UTF-8","GB2312//IGNORE",$spider->spidername)."\t";//$spider->spidername
 echo $spider->spiderip."\t";
 echo $spider->url."\t";
 echo $spider->status."\t";
 echo date('Y-m-d H:i:s',$spider->dateline)."\t\r\n";
}
       












