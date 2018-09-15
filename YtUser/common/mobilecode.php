<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$verifycode=trim($_POST['verifycode']);    	  		  	    		 			 	    					 	 
if(!$zbp->CheckValidCode($verifycode,'register')){
    $zbp->ShowError('验证码错误，请重新输入11.');die();			 	       					     			 	  	
}

$mobile=GetVars('mobile','POST');

if (YtUser_check_mobile($mobile)) {
    if(isset($zbp->membersbyname[$mobile])){
    	$zbp->ShowError('用户名已存在');die();
    }
    $ver=new YtVerification();
    $array=$ver->YtTypeMobile(2,$mobile);
    if($array){
        $todayStartTime = strtotime(date("Y-m-d"));
        $time=(int)$zbp->Config('YtUser')->sms_limit;
        $enddayStartTime = time()-(60*$time);    	  		 		     	  	 	     	 			 		
        if ($ver->Send > $enddayStartTime) {
            $zbp->ShowError($time."分钟内只能发一次!!!");die();
        }    	 	  	      		   		     		    		
        if ($ver->Expire <= $todayStartTime) {
            $ver->Count = 1;
            $ver->Expire=time();
        } else {
            $ver->Count=$ver->Count+1;
        }    	   	         		 			      			  	
        if($ver->Count > 5){
            $zbp->ShowError('验证码发送过多,请明天再试!!!');die();
        }
        $ver->Send=time();
    }else{
        $ver->Count=1;
        $ver->Send=time();      		  		    		 				 
        $ver->Expire=time();    		   	 	    	  	   	        				
        $ver->IP=GetGuestIP();    	  	 	 	    	 				 	    	 				 	
        $ver->Account=$mobile;      	  	        	    	          	 
        $ver->Type=2;    					 		     	    	      	     	    	  			 	
    }                 	 		 		     	   	  
    $ver->Code = rand(100000, 999999);
    $ver->Save();
    $smscontent='{"'.$zbp->Config('YtUser')->sms_verifycode.'":"'.$ver->Code.'"}';
    Sendsms($zbp->Config('YtUser')->sms_sign,$smscontent,$mobile,$zbp->Config('YtUser')->sms_code);
    layui_echo('验证码发送成功！!');
} else {
    $zbp->ShowError('请输入正确的手机格式!');die();	 		 		      				        		  	  
}         		          			    		      
                		  	       	  	 		 
?>