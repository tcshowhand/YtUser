<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();


if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$vipstate=1;
$state=array(15,40,120);
$mame=array("视女郎一个月vip","视女郎三个月vip","视女郎一年vip");
$Price=$state[$vipstate];
		$parameter = array(
			"out_trade_no" => time(), //订单号
			"subject" => $mame[$vipstate],
			"total_fee" => $Price, //金额
			"body" => $mame[$vipstate],
			"show_url" => $zbp->host."?Upgrade",
		);
		AlipayAPI_Start($parameter);
?>
