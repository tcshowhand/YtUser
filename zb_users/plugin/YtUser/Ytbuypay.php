<?php

require '../../../zb_system/function/c_system_base.php';

$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if(!$zbp->user->ID){
	$zbp->ShowError('请登录账户');
	die();
}else{
	$LogID = GetVars('LogID', 'POST');
	if(!$LogID){
		$zbp->ShowError('错误的ID参数');
		die();
	}
	$LogID = (int)trim($LogID);
	
	//获取文章信息
	$article = $zbp->GetPostByID($LogID);
	
	//获取用户信息
	$sql_user=$zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$zbp->user->ID)),null,null,null);
	$arr_user=$zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql_user);
	if (!isset($arr_user[0])){
		$DataArr = array(
			'tc_uid'    => $zbp->user->ID,
			'tc_oid'    => 0,
		);
		$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
		$zbp->db->Insert($sql);
		$arr_user = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql_user);
	}

	//获取作者信息
	if(!$article->Author->ID){
		$zbp->ShowError('作者ID错误');
		die();
	}else{
		$sql_author = $zbp->db->sql->Select($tysuer_Table,'*',array(array('=','tc_uid',$article->Author->ID)),null,null,null);
		$array_author = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql_author);
		if (!isset($array_author[0])){
			$DataArr = array(
				'tc_uid'    => $article->Author->ID,
				'tc_oid'    => 0,
			);
			$sql= $zbp->db->sql->Insert($tysuer_Table,$DataArr);
			$zbp->db->Insert($sql);
			$array_author = $zbp->GetListCustom($tysuer_Table,$tysuer_DataInfo,$sql_user);
		}
	}

	if($arr_user[0]->Price - $article->Metas->price < 0){
		$zbp->ShowError('积分不够，请充值.');
	}

	//更新购买表
	$keyvalue=array(
		'buy_State' => '1',
		'buy_Pay' => $article->Metas->price
	);
	$sql_user = $zbp->db->sql->Update($YtUser_buy_Table,$keyvalue,array(array('=','buy_AuthorID',$zbp->user->ID),array('=','buy_LogID',$LogID)));
	$zbp->db->Update($sql_user);
	if ($article->Author->ID != $zbp->user->ID){
	//更新用户信息
	$keyvalue=array('tc_Price' => $arr_user[0]->Price - $article->Metas->price);
	$sql_user = $zbp->db->sql->Update($tysuer_Table,$keyvalue,array(array('=','tc_uid',$zbp->user->ID)));
	$zbp->db->Update($sql_user);


	//更新作者信息
	
	$keyvalue = array('tc_Price' => $array_author[0]->Price + $article->Metas->price);
	$sql_user = $zbp->db->sql->Update($tysuer_Table,$keyvalue,array(array('=','tc_uid',$article->Author->ID)));
	$zbp->db->Update($sql_user);
	}

	echo '购买成功！';
}
?>