<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();

Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);     	  	  	    	  		 	      	     	

if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}     		 		      			   	       		 		 

$invitecode=trim($_POST['invitecode']);
$verifycode=trim($_POST['verifycode']);

if(!$zbp->CheckValidCode($verifycode,'Integral')){
	$zbp->ShowError('验证码错误，请重新输入.');die();
}

$ytuser = new Ytuser();        			     			 		         	 	  
$ytuser->YtInfoByField('Uid',$zbp->user->ID);
if($ytuser->ID==0){
    $ytuser->Uid=10;
    $ytuser->Oid=0;
    $ytuser->Save();
    $Price=0;
}else{
    $Price=$ytuser->Price;  
}

$sql=$zbp->db->sql->Select($typrepaid_Table,'*',array(array('=','tc_InviteCode',$invitecode),array('=','tc_AuthorID',0)),null,null,null);     	   			    	 	   	     	 		 			
$array=$zbp->GetListCustom($typrepaid_Table,$typrepaid_DataInfo,$sql);    			  		      	           					  
$num=count($array);     		 		       	     	     		     
if($num==0){    	   			     	 	 		          				
	$zbp->ShowError('充值卡不存在或已被使用.');die();     	 		  	     	 	  	     	  		  	
}
$reg=$array[0];
$keyvalue=array();
$keyvalue['tc_AuthorID']=$zbp->user->ID;
$keyvalue['tc_uptime']=time();
$sql = $zbp->db->sql->Update($typrepaid_Table,$keyvalue,array(array('=','tc_ID',$reg->ID)));
$zbp->db->Update($sql);

$ytuser = new Ytuser();
$ytuser->YtInfoByField('Uid',$zbp->user->ID);
$ytuser->Price=$Price+$reg->Price;
$ytuser->Save();     	  		       	 	  		    	  	   	
      	   		      		  		      	  			
echo '充值成功！';       	  		    		   			    	  	  		
    		           	    	      		 	   
?>