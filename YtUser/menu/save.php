<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if(GetVars('type','GET') == 'skin' ){ 
	$zbp->Config('YtUser')->user_template_on = (int)GetVars('user_template_on','POST');
    $zbp->Config('YtUser')->notice = GetVars('notice','POST');
    $zbp->Config('YtUser')->foot = GetVars('foot','POST');
    $zbp->Config('YtUser')->logo = GetVars('logo','POST');
    $zbp->Config('YtUser')->bg = GetVars('bg','POST');
	$zbp->Config('YtUser')->homeids = GetVars('homeids','POST');
    $zbp->Config('YtUser')->color1 = GetVars('color1','POST');
    $zbp->Config('YtUser')->color2 = GetVars('color2','POST');
    $zbp->Config('YtUser')->color3 = GetVars('color3','POST');
    $zbp->Config('YtUser')->color4 = GetVars('color4','POST');
    $zbp->Config('YtUser')->color5 = GetVars('color5','POST');
    $zbp->Config('YtUser')->color6 = GetVars('color6','POST');
    $zbp->Config('YtUser')->color7 = GetVars('color7','POST');
    $zbp->Config('YtUser')->color8 = GetVars('color8','POST');
    $zbp->SaveConfig('YtUser');
	if($zbp->Config('YtUser')->user_template_on == 0){
		$ytuser_templates = array("t_articleedt", "t_articlelist", "t_binding","t_certifi", "t_breadcrumb", "t_buy", "t_changepassword", "t_commentlist", "t_invite","t_consume", "t_favorite", "t_footer", "t_header", "t_integral", "t_login", "t_pagebar", "t_paylist", "t_register", "t_resetpassword", "t_resetpwd", "t_top", "t_upgrade", "t_user");
		foreach($ytuser_templates as $vo){           
            $fullname=$zbp->usersdir .'cache/compiled/'.$zbp->theme .'/'.$vo.'.php';
			if (file_exists($fullname)) {
				@unlink($fullname);
			}  
        }
	}else{
		$zbp->CheckTemplate(false, (bool)(1));
	}
    $zbp->SetHint('good','修改成功');
    Redirect('./skin.php');
}

if(GetVars('type','GET') == 'testingdel' ){
	global $zbp;
	$sql = $zbp->db->sql->Delete($zbp->table['ytuser_ytuser'],array(array('=','tc_uid',0)));
	$zbp->db->Delete($sql);
	Redirect('./testing.php');
}
  		
if(GetVars('type','GET') == 'sms' ){    	 					   		    			 	   	 	 
    $zbp->Config('YtUser')->sms_on = GetVars('sms_on','POST');
	$zbp->Config('YtUser')->sms_upon = GetVars('sms_upon','POST');	 		 	
    $zbp->Config('YtUser')->sms_limit = GetVars('sms_limit','POST');		 	    	 			 	    	 			   
    $zbp->Config('YtUser')->sms_count = GetVars('sms_count','POST');   		  			 	 	
    $zbp->Config('YtUser')->sms_sign = GetVars('sms_sign','POST');   		    				 	 	
    $zbp->Config('YtUser')->sms_code = GetVars('sms_code','POST');     			 	 	   	 
    $zbp->Config('YtUser')->sms_verifycode = GetVars('sms_verifycode','POST');   	 	 	
    $zbp->SaveConfig('YtUser');    		    		    	   	  	  	    	
	$zbp->SetHint('good','修改成功');	 	     	   		 	  
	Redirect('./sms.php');  	  				 			    						 	
} 	  			 	  	     				 	 
	 		   	 
if(GetVars('type','GET') == 'certifi' ){
	if(GetVars('id','GET')<1){
		$zbp->SetHint('good','参数错误');
		Redirect('./certifi.php');
	}else{
		$ytuser = new Ytuser();
		$ytuser->LoadInfoByField('Uid',(int)GetVars('id','GET'));
	}
    if(GetVars('act','GET') == 'edit' ){
		$ytuser->Isidcard=2;
	}
	if(GetVars('act','GET') == 'del' ){  	 	     		  
		$ytuser->Isidcard=3;    	  	  			 	    			 	 						
		$ytuser->Name='';   	 					  
		$ytuser->Idcard='';    							    	  	 		   	 
	}  		     	   					 	 	 
	$ytuser->Save();		 	    			 	  
	$zbp->SetHint('good','修改成功');    	 						    	  						 					
	Redirect('./certifi.php');    						 	    	  	 	 	     		
}

if(GetVars('type','GET') == 'setorder' ){
	global $zbp;
	$orderid = GetVars('inputorderid','POST');
	$uid = GetVars('userid','POST');
	$pid = GetVars('postid','POST');
	$reset = GetVars('resete','POST');
	$pay = GetVarsByDefault('pay','POST',0);
	$state = GetVars('state','POST');
	$express = GetVars('express','POST');

	if (($zbp->GetMemberByID($uid)->ID)){
		$sql=$zbp->db->sql->Select($zbp->table['ytuser_buy'],'*',array(array('=','buy_LogID',$pid),array('=','buy_AuthorID',$uid)),null,null,null);
		$array=$zbp->GetListCustom($zbp->table['ytuser_buy'],$zbp->datainfo['ytuser_buy'],$sql);
		$count = count($array);
		if ($count){
			if ($reset == 'delid'){
				if ($orderid){
					$where = array('=','buy_OrderID',$orderid);
				}else{
					$where = array(
					array('=','buy_AuthorID',$uid),
					array('=','buy_LogID',$pid)
					);
				}
				$sql= $zbp->db->sql->Delete($zbp->table['ytuser_buy'],$where);
				$zbp->db->Delete($sql);
				$zbp->SetHint('good',"已删除");
				Redirect('./buy.php');
			}else{
				$keyvalue=array(
				'buy_State' => $state,
				'buy_Express' => $express,
				'buy_Pay' => $pay
				);
				if ($orderid){
					$where = array('=','buy_OrderID',$orderid);
				}else{
					$where = array(array('=','buy_AuthorID',$uid),array('=','buy_LogID',$pid));
				}
				$sql = $zbp->db->sql->Update($zbp->table['ytuser_buy'],$keyvalue,$where);
				$zbp->db->Update($sql);
				$zbp->SetHint('good',"订单状态已更新");
				Redirect('./buy.php');
			}
		}else{
			$dataa = array(
				'buy_LogID' => $pid,
				'buy_State' => $state,
				'buy_Pay' => $pay,
				'buy_Express' => $express,
				'buy_OrderID' => $orderid?$orderid:GetGuid(),
				'buy_AuthorID' => $uid,
				'buy_Title' => $postt->ID?$postt->Title:'不存在的商品 LogID='.$pid,
				'buy_PostTime' => time(),
				'buy_IP' => GetGuestIP()
			);
			$sql_in = $zbp->db->sql->Insert($zbp->table['ytuser_buy'],$dataa);
			$zbp->db->Insert($sql_in);
			$zbp->SetHint('good',"订单已添加");
			Redirect('./buy.php');
		}
	}else{
		if($reset == 'delall'){
			$sql = $zbp->db->sql->Delete($zbp->table['ytuser_buy'],array('>','buy_ID',0));
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"全部订单已清除");
            Redirect('./buy.php');     	  			    	  		
		}elseif($reset == 'delnopay'){  	  		 	    	     	 
			$sql = $zbp->db->sql->Delete($zbp->table['ytuser_buy'],array(array('>','buy_ID',0),array('<','buy_State',1)));    	 			  
			$zbp->db->Delete($sql);
			$zbp->SetHint('good',"未付款订单已清除");
            Redirect('./buy.php');
		}else{
	    $zbp->SetHint('good',"用户ID不存在");
        Redirect('./buy.php');
		}
	}
}

if(GetVars('type','GET') == 'rewrite' ){
    $zbp->Config('YtUser')->YtUser_OnRW = GetVars('YtUser_OnRW','POST');
    $zbp->Config('YtUser')->YtUser_RWURL = GetVars('YtUser_RWURL','POST');
    if(GetVars('YtUser_OnRW','POST')){
		$zbp->Config('YtUser')->YtUser_UCenter = GetVars('YtUser_RWURL','POST').'/UCenter.html';
		$zbp->Config('YtUser')->YtUser_Login = GetVars('YtUser_RWURL','POST').'/Login.html';
		$zbp->Config('YtUser')->YtUser_Register = GetVars('YtUser_RWURL','POST').'/Register.html';
		$zbp->Config('YtUser')->YtUser_Register_u = GetVars('YtUser_RWURL','POST').'/Register/u/';
		$zbp->Config('YtUser')->YtUser_Articlelist = GetVars('YtUser_RWURL','POST').'/Articlelist';
		$zbp->Config('YtUser')->YtUser_Articlelist_page = GetVars('YtUser_RWURL','POST').'/Articlelist/page/';
		$zbp->Config('YtUser')->YtUser_Articleedt = GetVars('YtUser_RWURL','POST').'/Articleedt.html';
		$zbp->Config('YtUser')->YtUser_Integral = GetVars('YtUser_RWURL','POST').'/Integral.html';
		$zbp->Config('YtUser')->YtUser_Invite = GetVars('YtUser_RWURL','POST').'/Invite.html';
		$zbp->Config('YtUser')->YtUser_buy = GetVars('YtUser_RWURL','POST').'/buy';
		$zbp->Config('YtUser')->YtUser_buy_ID = GetVars('YtUser_RWURL','POST').'/buy/uid/';
		$zbp->Config('YtUser')->YtUser_Upgrade = GetVars('YtUser_RWURL','POST').'/Upgrade.html';
		$zbp->Config('YtUser')->YtUser_Upgrade_vip = GetVars('YtUser_RWURL','POST').'/Upgrade.html?vip=';
		$zbp->Config('YtUser')->YtUser_Paylist = GetVars('YtUser_RWURL','POST').'/Paylist';
		$zbp->Config('YtUser')->YtUser_Paylist_page = GetVars('YtUser_RWURL','POST').'/Paylist/page/';
		$zbp->Config('YtUser')->YtUser_User = GetVars('YtUser_RWURL','POST').'/User.html';
		$zbp->Config('YtUser')->YtUser_UserEdit = GetVars('YtUser_RWURL','POST').'/UserEdit.html';
		$zbp->Config('YtUser')->YtUser_Commentlist = GetVars('YtUser_RWURL','POST').'/Commentlist';
		$zbp->Config('YtUser')->YtUser_Commentlist_page = GetVars('YtUser_RWURL','POST').'/Commentlist/page/';
		$zbp->Config('YtUser')->YtUser_Resetpwd = GetVars('YtUser_RWURL','POST').'/Resetpwd.html';
		$zbp->Config('YtUser')->YtUser_Resetpassword = GetVars('YtUser_RWURL','POST').'/Resetpassword.html';
		$zbp->Config('YtUser')->YtUser_Nameedit = GetVars('YtUser_RWURL','POST').'/Nameedit.html';
		$zbp->Config('YtUser')->YtUser_Changepassword = GetVars('YtUser_RWURL','POST').'/Changepassword.html';
		$zbp->Config('YtUser')->YtUser_Binding = GetVars('YtUser_RWURL','POST').'/Binding.html';
		$zbp->Config('YtUser')->YtUser_Favorite = GetVars('YtUser_RWURL','POST').'/Favorite';
		$zbp->Config('YtUser')->YtUser_Favorite_page = GetVars('YtUser_RWURL','POST').'/Favorite/page/';
		$zbp->Config('YtUser')->YtUser_Consume = GetVars('YtUser_RWURL','POST').'/Consume';
		$zbp->Config('YtUser')->YtUser_Consume_page = GetVars('YtUser_RWURL','POST').'/Consume/page/';
		$zbp->Config('YtUser')->YtUser_Certifi = GetVars('YtUser_RWURL','POST').'/Certifi.html';
		$zbp->Config('YtUser')->YtUser_Upmobile = GetVars('YtUser_RWURL','POST').'/Upmobile.html';
	}else{
		$zbp->Config('YtUser')->YtUser_UCenter = '?UCenter';
		$zbp->Config('YtUser')->YtUser_Login = '?Login';
		$zbp->Config('YtUser')->YtUser_Register = '?Register';
		$zbp->Config('YtUser')->YtUser_Articlelist = '?Articlelist';
		$zbp->Config('YtUser')->YtUser_Articlelist_page = '?Articlelist&page=';
		$zbp->Config('YtUser')->YtUser_Articleedt = '?Articleedt';
		$zbp->Config('YtUser')->YtUser_Integral = '?Integral';
		$zbp->Config('YtUser')->YtUser_Invite = '?Invite';
		$zbp->Config('YtUser')->YtUser_buy = '?buy';
		$zbp->Config('YtUser')->YtUser_buy_ID = '?buy&uid=';
		$zbp->Config('YtUser')->YtUser_Upgrade = '?Upgrade';
		$zbp->Config('YtUser')->YtUser_Upgrade_vip = '?Upgrade&vip=';
		$zbp->Config('YtUser')->YtUser_Paylist = '?Paylist';
		$zbp->Config('YtUser')->YtUser_Paylist_page = '?Paylist&page=';
		$zbp->Config('YtUser')->YtUser_User = '?User';
		$zbp->Config('YtUser')->YtUser_UserEdit = '?UserEdit';
		$zbp->Config('YtUser')->YtUser_Commentlist = '?Commentlist';
		$zbp->Config('YtUser')->YtUser_Commentlist_page = '?Commentlist&page=';
		$zbp->Config('YtUser')->YtUser_Resetpwd = '?Resetpwd';
		$zbp->Config('YtUser')->YtUser_Resetpassword = '?Resetpassword';
		$zbp->Config('YtUser')->YtUser_Nameedit = '?Nameedit';
		$zbp->Config('YtUser')->YtUser_Changepassword ='?Changepassword';
		$zbp->Config('YtUser')->YtUser_Binding = '?Binding';
		$zbp->Config('YtUser')->YtUser_Favorite = '?Favorite';
		$zbp->Config('YtUser')->YtUser_Favorite_page = '?Favorite&page=';
		$zbp->Config('YtUser')->YtUser_Consume = '?Consume';
		$zbp->Config('YtUser')->YtUser_Consume_page = '?Consume&page=';
		$zbp->Config('YtUser')->YtUser_Certifi = '?Certifi';
		$zbp->Config('YtUser')->YtUser_Upmobile = '?Upmobile';
	}
    $zbp->SaveConfig('YtUser');
	$zbp->SetHint('good','修改成功');
	Redirect('./rewrite.php');
}