<?php /* EL PSY CONGROO */ /* EL PSY CONGROO */ /* EL PSY CONGROO */        				     	  	  	    		 	   	
require '../../../../zb_system/function/c_system_base.php';     		 	        	 			 	      	  	 	
$zbp->Load();     			 		        	   	     	 	  	 
Add_Filter_Plugin('Filter_Plugin_Zbp_ShowError','RespondError',PLUGIN_EXITSIGNAL_RETURN);    	 	  		      	  	       	  	  		
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}       	 	       			 	 	     	   			
    	  				     	  			 	    			    	
if(!$zbp->user->ID){    			    	           	     	  	   
    Redirect($zbp->host.$zbp->Config('YtUser')->YtUser_Login);die();       		  	     	   			      				 	
}     	 	 	       							     	 				 
    			 	 	      	 			 	       		  	
$ver=new YtVerification();     	 	 		        	        		 		 	 
$array=$ver->YtTypeCount(1);     		   		       					    			 		 	
if($array){     					 	    	  			 	    		  		 	
    $todayStartTime = strtotime(date("Y-m-d"));    		 		 	     	  	         			 			
    if ($ver->Expire <= $todayStartTime) {     		         	 					     	 		  		
        $ver->Count = 1;    	  		  	     	  		 	     		  			
        $ver->Expire=time();        		 	        	  	      		 		 
    } else {    		 				     	 	 	 		    	   	   
        $ver->Count=$ver->Count+1;      	  			     	   		      	 					
    }    	  	  		      	 		 	    		 	  	 
    if($ver->Count > 1){    	 		 			    			 		       				 	 
        echo "今天已经签到!!!";      	  			     	 				     	    			
        die();    				  	     	 			 	     	  		   
    }       		  	    		   			     	   	  
    $ver->Send=time();    	 	 	        					      	 			  	
}else{      	 	       	 		   	    			  			
    $ver->Uid=$zbp->user->ID;    			 	 		                  		  		
    $ver->Count=1;       	  	     	      	            
    $ver->Send=time();    	   				      	  		     			  		 
    $ver->Expire=time();     	 	 	       		 		 	    		 			 	
    $ver->IP=GetGuestIP();     				 	        			 	      	 	   
    $ver->Type=1;    		 	 	 	    	  	   	     		 	   
}    				 		       	  		       					 
$ver->Save();     	    	      					 	      	 	  	
$sign=(int)$zbp->Config('YtUser')->sign;    		  			     			  	      			   		
$YtConsume = new YtConsume();     	  	 	     		   			    			 	   
$YtConsume->Uid=$zbp->user->ID;    		    		     	 		 	      			  	 
$YtConsume->Time=time();    		  	        	  	       			 				
$YtConsume->Money=$sign;    		 			 	    				 	 	    	 				 	
$YtConsume->Type=0;    				  		    		 		 		        				
$YtConsume->Title="签到获得".$sign."积分";     	 	 			    	 		 	 	    	  	 	  
$YtConsume->Save();     		 			      				 	       		    
$ytuser = new Ytuser();          		    	   				      			  	
$ytuser->YtInfoByField('Uid',$zbp->user->ID);        			     	 				         		 	 
$ytuser->Price=$ytuser->Price + $sign;    		  			     		 	 	        			 	 
$ytuser->Save();      	  			        	  	     	      
     						       				 	    	 	  	  
echo '签到成功!!!';die();       		        		 	 		    	  					
        			     	 	  		     			  	  
?>