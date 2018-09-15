<?php
require_once '../../../zb_system/function/c_system_base.php';
require_once '../../../zb_system/function/c_system_admin.php';
if ($zbp->CheckPlugin('alipay')) { 
require_once '../../../zb_users/plugin/alipay/function.php';
require_once '../../../zb_users/plugin/alipay/api.php';
}
$zbp->Load();
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);
$action=GetVars('act','GET');
if($action=="verify"){    		  	 		    		 	        	  	    
}else{    	   		 	     		 		         	 	 	
    if($zbp->user->ID==0){Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);}
}

foreach ($GLOBALS['Filter_Plugin_Cmd_Begin'] as $fpname => &$fpsignal) {$fpname();}

switch ($action) {      	   	     		 	  	          			
    case 'verify':    	  			 	    		  		 	    	       
	if ($zbp->Config('YtUser')->login_verifycode){     		  	      		 	 		      	 		   
		$verifycode=trim($_POST['verifycode']);    	 	 				      						    	  	 	  
		if(!$zbp->CheckValidCode($verifycode,'User')){      		   	       		       				   	
			$zbp->ShowError('验证码错误，请重新输入.');die();    	 	  	 	      	   	     	  	 			
		}    		   	 	    			  		     			 	 		
	}    		 	 		        	   	     	    		
    $_POST['username']=$_POST['username'];     	    		     	 	 	       	 		   
    $_POST['password']=$_POST['edtPassWord'];     	 	  		       		 		    			 			 
    if(isset($_POST['strSaveDate'])) $_POST['savedate']=$_POST['strSaveDate'];     			 	 	    			  	      	 	  	 	
	if (VerifyLogin()){
		layui_echo('登入成功!');
	}
    break;
    case 'ArticlePst':    	 	 	  	     		 	 		      	   		
    	if(empty($_POST['Title']) || empty($_POST['Content'])){     	  				    	  	 	      	  			  
    		$zbp->ShowError('骚年，不要捣乱！！！');die();    	  		  	    	 	  		     		   			
    	}     	 		  	     	 	 	       		 	  	
        if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}        		      		    	     	    	 	
        $_POST['Status'] = 2;
		PostArticle();     			  		    		 			 	    	 	 			 
		$zbp->BuildModule();     		   	     	    		      				 		
		$zbp->SaveCache();    		 		  	    				  		    	 	 	   
		$zbp->SetHint('good');     	  	         	 			        	  		
		Redirect($zbp->host.'?Articlelist');
		break;
	case 'MemberPst':
        $verifycode=trim($_POST['verifycode']);
        if(!$zbp->CheckValidCode($verifycode,'User')){
            $zbp->ShowError('验证码错误，请重新输入.');die();
        }
		if(!$zbp->ValidToken(GetVars('token','GET'))){$zbp->ShowError(5,__FILE__,__LINE__);die();}
		$_POST['Password'] = null;
		$_POST['PasswordRe'] = null;
        if (isset($_POST["meta_Tel"])) {    		  	  	     	 				     	 						
            $_POST['meta_Tel']=TransferHTML($_POST['meta_Tel'], '[noscript]');    	    			    			    	    	     		
        }     	   		     		  				     	  			 
        if (isset($_POST["meta_Add"])) {      	  	 	    	    		     	 			   
        $_POST['meta_Add']=TransferHTML($_POST['meta_Add'], '[noscript]');    			    	    		  			             
        }
		PostMember();
		$zbp->BuildModule();    	 	  	 	       	   	     			    
		$zbp->SaveCache();     			 	 	    	   		 	    	 	  	  
		$zbp->SetHint('good');
		layui_echo('修改成功！');
		break;    	 		 	      	  	        	  		 		
case 'UploadPst':    	    		     					 		     	 		 	 
        $LogID=(int)$_POST['LogID'];
        if($LogID==0){    				 	           		      		     
            $vipstate=(int)$_POST['vipstate'];
            $Pricetemp=[];
            $Pricetemp[1]=(int)$zbp->Config('YtUser')->pricetemp1;
			$Pricetemp[2]=(int)$zbp->Config('YtUser')->pricetemp2;
			$Pricetemp[3]=(int)$zbp->Config('YtUser')->pricetemp3;
            $Pricetemp[5]=(int)$zbp->Config('YtUser')->pricetemp5;
            $Pricetemp[6]=(int)$zbp->Config('YtUser')->pricetemp6;
            $Pricetemp[7]=(int)$zbp->Config('YtUser')->pricetemp7;
            $Titletemp=[];    	   	  	        	       	  	 	 	
            $Titletemp[1]=$zbp->Config('YtUser')->brand."VIP一个月";
            $Titletemp[2]=$zbp->Config('YtUser')->brand."VIP三个月";
            $Titletemp[3]=$zbp->Config('YtUser')->brand."VIP一年";
            $Titletemp[5]=$zbp->Config('YtUser')->brand."100积分";
            $Titletemp[6]=$zbp->Config('YtUser')->brand."200积分";
            $Titletemp[7]=$zbp->Config('YtUser')->brand."300积分";
            $Price=(int)$Pricetemp[$vipstate];
            if($Price==0){
                echo '选项错误！';die();
            }
    		$userbuy =new YtuserBuy();     	   	 	     	  			        	  	 
    		$userbuy->OrderID=$vipstate.GetGuid();
			$userbuy->LogID=0;
			$userbuy->Pay=$Price;
    		$userbuy->AuthorID=$zbp->user->ID;
    		$userbuy->Title=$Titletemp[$vipstate];
    		$userbuy->State=0;
    		$userbuy->PostTime=time();
    		$userbuy->IP=GetGuestIP();
    		$userbuy->Save();    		 	  		     	  		       	 	 	  
        }else{     	           	  			     	    			
            $articles = $zbp->GetPostByID($LogID);
            $userbuy=new YtuserBuy();
    		$array = $userbuy->YtInfoByField('LogID',$LogID); 
    		if($zbp->user->Level < 5){
                $Price=(int)$articles->Metas->price * ($zbp->Config('YtUser')->vipdis/100);
            }else{
                $Price=$articles->Metas->price;
            }
    		if($array){
    			if($userbuy->State){
    				echo '已付款！';
    				die();
    			}
    		}else{
    			$userbuy->OrderID=GetGuid();
    			$userbuy->LogID=$articles->ID;
    			$userbuy->AuthorID=$zbp->user->ID;
    			$userbuy->Title=$articles->Title;
    			$userbuy->State=0;
    			$userbuy->Pay=$Price;
    			$userbuy->PostTime=time();
    			$userbuy->IP=GetGuestIP();
    			$userbuy->Save();
    		}    			 				    		   		     		 	   	
        }    		 		 	        	  		    		    	 

		$parameter = array(
			"out_trade_no" => $userbuy->OrderID,
			"subject" => $userbuy->Title,
			"total_fee" => $Price,
			"body" => $userbuy->Title,
			"show_url" => $zbp->host.$zbp->Config('YtUser')->YtUser_Paylist,
		);
		AlipayAPI_Start($parameter);
		break;
	default:
		break;
}    		 			      	 		 	 	    					 		