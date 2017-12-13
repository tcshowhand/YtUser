<?php
$tysuer_Table='%pre%ytuser';
$tysuer_DataInfo=array(
    'ID'=>array('tc_id','integer','',0),
    'Uid'=>array('tc_uid','integer','',0),
    'Oid'=>array('tc_oid','string',255,''),
    'Price'=>array('tc_Price','integer','',0),
    'Vipendtime'=>array('tc_Vipendtime','integer','',0),
    'Isidcard'=>array('tc_isidcard','integer','',0),
    'Idcard'=>array('tc_idcard','string',255,''),
    'Name'=>array('tc_name','string',255,''),
    'Tel'=>array('tc_tel','string',255,''),
);
$tyactivate_Table='%pre%activate';
$tyactivate_DataInfo=array(
	'ID'=>array('reg_ID','integer','',0),
	'InviteCode'=>array('reg_InviteCode','string',50,''),
	'Level'=>array('reg_Level','integer','',5),
	'AuthorID'=>array('reg_AuthorID','integer','',0),
	'IsUsed'=>array('reg_IsUsed','boolean','',false),
	'Intro'=>array('reg_Intro','string','',''),
);

$typrepaid_Table='%pre%prepaid';
$typrepaid_DataInfo=array(
	'ID'=>array('tc_ID','integer','',0),
	'InviteCode'=>array('tc_InviteCode','string',50,''),
	'Price'=>array('tc_Price','integer','',0),
	'AuthorID'=>array('tc_AuthorID','integer','',0),
	'IsUsed'=>array('tc_IsUsed','boolean','',false),
	'Intro'=>array('tc_Intro','string','',''),
);

$tyworkorder_Table='%pre%ytworkorder';
$tyworkorder_DataInfo=array(
        'ID' => array('log_ID', 'integer', '', 0),
        'CateID' => array('log_CateID', 'integer', '', 0),
        'AuthorID' => array('log_AuthorID', 'integer', '', 0),
        'Status' => array('log_Status', 'integer', '', 0),
        'Title' => array('log_Title', 'string', 250, ''),
        'Content' => array('log_Content', 'string', '', ''),
        'PostTime' => array('log_PostTime', 'integer', '', 0),
        'CommNums' => array('log_CommNums', 'integer', '', 0),
);
$tyreplyworkorder_Table='%pre%ytreplyworkorder';
$tyreplyworkorder_DataInfo=array(
        'ID' => array('comm_ID', 'integer', '', 0),
        'LogID' => array('comm_LogID', 'integer', '', 0),
        'AuthorID' => array('comm_AuthorID', 'integer', '', 0),
        'Name' => array('comm_Name', 'string', 20, ''),
        'Content' => array('comm_Content', 'string', '', ''),
        'PostTime' => array('comm_PostTime', 'integer', '', 0),
        'IP' => array('comm_IP', 'string', 15, ''),
        'Agent' => array('comm_Agent', 'string', '', ''),
);

$YtUser_buy_Table='%pre%YtUser_buy';
$YtUser_buy_DataInfo=array(
        'ID' => array('buy_ID', 'integer', '', 0),
        'OrderID' => array('buy_OrderID', 'string', 30, 0),
        'LogID' => array('buy_LogID', 'integer', '', 0),
        'AuthorID' => array('buy_AuthorID', 'integer', '', 0),
        'Title' => array('buy_Title', 'string', 255, ''),
        'State' => array('buy_State', 'integer', '', 0),
        'PostTime' => array('buy_PostTime', 'integer', '', 0),
        'Pay' => array('buy_Pay', 'integer', '', 0),
        'Express' => array('buy_Express', 'string', '', ''),
        'IP' => array('buy_IP', 'string', 15, ''),
);

$YtFavorite_Table='%pre%favorite';
$YtFavorite_DataInfo=array(
        'ID'=>array('fa_id','integer','',0),
        'Uid'=>array('fa_uid','integer','',0),
        'Pid'=>array('fa_pid','string',255,''),
        'Time'=>array('fa_time','integer','',0),
);

$YtConsume_Table='%pre%consume';
$YtConsume_DataInfo=array(
        'ID'=>array('cs_id','integer','',0),
        'Uid'=>array('cs_uid','integer','',0),
        'Pid'=>array('cs_pid','string',255,''),
        'Title'=>array('cs_title','string',255,''),
        'Time'=>array('cs_time','integer','',0),
        'Money'=>array('cs_money','integer','',0),
        'Type'=>array('cs_type','integer','',0),
);

$YtVerification_Table='%pre%ytverification';
$YtVerification_DataInfo=array(
        'ID'=>array('vf_id','integer','',0),
        'Uid'=>array('vf_uid','integer','',0),
        'Count'=>array('vf_count','integer','',0),
        'Send'=>array('vf_sendtime','integer','',0),
        'Expire'=>array('vf_expiretime','integer','',0),
        'IP'=>array('comm_IP', 'string', 15, ''),
        'Type'=>array('vf_type','integer','',0),
);