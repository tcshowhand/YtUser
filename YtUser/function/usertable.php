<?php
$ytuser_database = array(
        'ytuser_ytuser'   => array(
            'name'           => '%pre%ytuser',
            'info'           => array(
                'ID'=>array('tc_id','integer','',0),
                'Uid'=>array('tc_uid','integer','',0),
                'Oid'=>array('tc_oid','string',255,''),
                'Price'=>array('tc_Price','integer','',0),
                'Vipendtime'=>array('tc_Vipendtime','integer','',0),
                'Isidcard'=>array('tc_isidcard','integer','',0),
                'Idcard'=>array('tc_idcard','string',255,''),
                'Name'=>array('tc_name','string',255,''),
                'RootID'=>array('tc_rootid','integer','',0),
                'Tel'=>array('tc_tel','string',255,''),
                'vip'     => array('tc_vip','integer','',0),
                'Cnum'     => array('tc_cknum','integer','',0),
                'Ctime'     => array('tc_cktime','integer','',0),
                'Type'     => array('tc_type','integer','',0)
            ),
        ),
        'ytuser_activate'   => array(
            'name'           => '%pre%ytuser_activate',
            'info'           => array(
                'ID'=>array('reg_ID','integer','',0),
                'InviteCode'=>array('reg_InviteCode','string',50,''),
                'Level'=>array('reg_Level','integer','',5),
                'AuthorID'=>array('reg_AuthorID','integer','',0),
                'IsUsed'=>array('reg_IsUsed','boolean','',false),
                'UpTime' => array('reg_uptime', 'integer', '', 0),
                'Intro'=>array('reg_Intro','string','',''),
            ),
        ),
        'ytuser_prepaid'   => array(
            'name'           => '%pre%ytuser_prepaid',
            'info'           => array(
                'ID'=>array('tc_ID','integer','',0),                  
                'InviteCode'=>array('tc_InviteCode','string',50,''),       
                'Price'=>array('tc_Price','integer','',0),   
                'AuthorID'=>array('tc_AuthorID','integer','',0),            
                'IsUsed'=>array('tc_IsUsed','boolean','',false),    
                'UpTime' => array('tc_uptime', 'integer', '', 0),                  
                'Intro'=>array('tc_Intro','string','',''),      
            ),
        ),
        // 'ytuser_workorder'   => array(
        //         'name'           => '%pre%ytuser_workorder',
        //         'info'           => array(
        //                 'ID' => array('log_ID', 'integer', '', 0),              
        //                 'CateID' => array('log_CateID', 'integer', '', 0),               
        //                 'AuthorID' => array('log_AuthorID', 'integer', '', 0),                    
        //                 'Status' => array('log_Status', 'integer', '', 0),          
        //                 'Title' => array('log_Title', 'string', 250, ''),         
        //                 'Content' => array('log_Content', 'string', '', ''),          
        //                 'PostTime' => array('log_PostTime', 'integer', '', 0),            
        //                 'CommNums' => array('log_CommNums', 'integer', '', 0),  
        //         ),
        // ),
        // 'ytuser_replyworkorder'   => array(
        //         'name'           => '%pre%ytuser_replyworkorder',
        //         'info'           => array(
        //                 'ID' => array('comm_ID', 'integer', '', 0),       
        //                 'LogID' => array('comm_LogID', 'integer', '', 0),                
        //                 'AuthorID' => array('comm_AuthorID', 'integer', '', 0),    
        //                 'Name' => array('comm_Name', 'string', 20, ''),    
        //                 'Content' => array('comm_Content', 'string', '', ''),           
        //                 'PostTime' => array('comm_PostTime', 'integer', '', 0),                     
        //                 'IP' => array('comm_IP', 'string', 15, ''),             
        //                 'Agent' => array('comm_Agent', 'string', '', ''),     
        //         ),
        // ),
        'ytuser_buy'   => array(
                'name'           => '%pre%ytuser_buy',
                'info'           => array(
                        'ID' => array('buy_ID', 'integer', '', 0),     	
                        'OrderID' => array('buy_OrderID', 'string', 40, 0),          
                        'LogID' => array('buy_LogID', 'integer', '', 0),                   
                        'AuthorID' => array('buy_AuthorID', 'integer', '', 0),        
                        'Title' => array('buy_Title', 'string', 255, ''),      
                        'State' => array('buy_State', 'integer', '', 0),           
                        'PostTime' => array('buy_PostTime', 'integer', '', 0),           
                        'Pay' => array('buy_Pay', 'integer', '', 0),      
                        'Express' => array('buy_Express', 'string', '', ''),  
                        'IP' => array('buy_IP', 'string', 15, ''),  
                ),
        ),
        'ytuser_favorite'   => array(
                'name'           => '%pre%ytuser_favorite',
                'info'           => array(
                        'ID'=>array('fa_id','integer','',0),
                        'Uid'=>array('fa_uid','integer','',0),
                        'Pid'=>array('fa_pid','string',255,''),
                        'Type'=>array('fa_type','integer','',0),
                        'Time'=>array('fa_time','integer','',0),
                ),
        ),
        'ytuser_consume'   => array(
                'name'           => '%pre%ytuser_consume',
                'info'           => array(
                        'ID'=>array('cs_id','integer','',0),       
                        'Uid'=>array('cs_uid','integer','',0),           
                        'Pid'=>array('cs_pid','string',255,''),       
                        'Title'=>array('cs_title','string',255,''),            
                        'Time'=>array('cs_time','integer','',0),         
                        'Money'=>array('cs_money','integer','',0),      
                        'Type'=>array('cs_type','integer','',0),
                        'Class'=>array('cs_class','integer','',0),  
                ),
        ),
        'ytuser_verification'   => array(
                'name'           => '%pre%ytuser_verification',
                'info'           => array(
                        'ID'=>array('vf_id','integer','',0),
                        'Uid'=>array('vf_uid','integer','',0),
                        'Count'=>array('vf_count','integer','',0),
                        'Send'=>array('vf_sendtime','integer','',0),
                        'Expire'=>array('vf_expiretime','integer','',0),
                        'IP'=>array('vf_ip', 'string', 15, ''),
                        'Code'=>array('vf_code', 'string', 100, ''),
                        'Account'=>array('vf_account', 'string', 15, ''),
                        'Type'=>array('vf_type','integer','',0),
                ),
        ),
        // 'ytuser_buyview'   => array(
        //         'name'           => '%pre%ytbuyview',
        //         'info'           => array(
        //                 'ID'=>array('buy_id','integer','',0),        
        //                 'Content'=>array('buy_content','integer','',0),
        //                 'Price'=>array('buy_Price','integer','',0),    	
        //                 'Type'=>array('buy_type','integer','',0),   
        //         ),
        // ),
        'ytuser_code'   => array(
                'name'=> '%pre%ytuser_code',
                'info'=> array(
                    'ID'=>array('reg_ID','integer','',0),
                    'InviteCode'=>array('reg_InviteCode','string',50,''),
                    'Price'=>array('tc_Price','integer','',0),
                    'Level'=>array('reg_Level','integer','',5),
                    'Type'=>array('reg_Type','integer','',5),
                    'AuthorID'=>array('reg_AuthorID','integer','',0),
                    'IsUsed'=>array('reg_IsUsed','boolean','',false),
                    'UpTime' => array('reg_uptime', 'integer', '', 0),
                    'Intro'=>array('reg_Intro','string','',''),
                ),
        ),
        'ytuser_ck'   => array(
            'name'           => '%pre%ytuser_ck',
            'info'           => array(
                'ID'          => array('ck_ID','integer','',0),
                'Pid'     => array('ck_Pid','integer','',0),
                'Uid'     => array('ck_Uid','integer','',0),
                'Time'     => array('ck_Time','integer','',0)
            ),
        ),
    );

foreach ($ytuser_database as $k => $v) {
    $table[$k] = $v['name'];
    $datainfo[$k] = $v['info'];
}

function YtUser_CreateTable() {
        global $zbp, $ytuser_database;
        foreach ($ytuser_database as $k => $v) {
            if (!$zbp->db->ExistTable($v['name'])) {
                $s = $zbp->db->sql->CreateTable($v['name'],$v['info']);
                @$zbp->db->QueryMulit($s);
            }
        }
}

class ytuser_ck extends Base {
        public function __construct() {
            global $zbp;
            parent::__construct($zbp->table['ytuser_ck'], $zbp->datainfo['ytuser_ck'], __CLASS__);
        }
}

class ytuser_code extends Base {
    public function __construct() {
        global $zbp;
        parent::__construct($zbp->table['ytuser_code'], $zbp->datainfo['ytuser_code'], __CLASS__);
    }
}

class Ytuser extends Base {
    public function __construct() {
        global $zbp;
        parent::__construct($zbp->table['ytuser_ytuser'],$zbp->datainfo['ytuser_ytuser'], __CLASS__);

    }

    public function Time($s = 'Y-m-d H:i:s') {
        return '';
    }
    
    public function __get($name) {
        global $zbp;
        switch ($name) {
        case 'Author':   			 	 	 	 		  
            return $zbp->GetMemberByID($this->Uid);    
            break;  
        case 'Category':
            return $zbp->GetCategoryByID($this->Uid);
            break;
        case 'User':
            return $zbp->GetMemberByID($this->Uid);
            break;
        case 'TypeName':
            if($this->Type){
                return "企业";
            }else{
                return "个人";
            }
        default:
            $res = parent::__get($name);
            if ($res !== null) return $res;
            return $this->User->$name;
            break;
        }
    }

    public static function GetList($select = null, $w = null, $order = null, $limit = null, $option = null) {
        global $zbp;
        if (empty($select)) {
            $select = array('*');
        }
        if (empty($w)) {
            $w = array();
        }
        $sql = $zbp->db->sql->Select(
            $zbp->table['ytuser_ytuser'],
            $select,
            $w,
            $order,
            $limit,
            $option
        );
        $result = $zbp->GetListType('Ytuser', $sql);
        return $result;
    }
}

class YtFavorite extends Base {
    public function __construct() {
        global $zbp;
        parent::__construct($zbp->table['ytuser_favorite'],$zbp->datainfo['ytuser_favorite'], __CLASS__);
    }
    public function Time($s = 'Y-m-d H:i:s') {
        return date($s, (int) $this->Time);
    }
    public function __get($name) {   	  	 			 	   
        global $zbp;  			    	   					 
        switch ($name) {     		    	
        case 'Author':   			 	 	 	 		  
            return $zbp->GetMemberByID($this->Uid);    
            break;    						 	
        case 'Post':    	 
            return $zbp->GetPostByID($this->Pid);		 				   		    				 	 	
            break;     	   	   	  		   
        case 'Category':
            return $zbp->GetCategoryByID($this->Post->CateID);
            break;
        case 'Tags':
            return $zbp->LoadTagsByIDString($this->Post->Tag);
            break;
        default:
            return parent::__get($name);
            break;
        }
    }

    public function GetFavoriteList($l,$op,$type=0) {
        global $zbp;    	  	  	    					 	 		 	
        $field_table = $zbp->table['ytuser_favorite'];     	  	    	 	    	 	 			     	  		   
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'fa_uid', $zbp->user->ID),array('=', 'fa_type', $type)), null, $l, $op);    	   	   						 
        $array = null;    	 	   		    			 				    				    			  
        $list = array();    	    			     					 	 				 	
        $array = $this->db->Query($sql);     		 	   	 			
        if (!isset($array)) {return array();}  	     		   	 		 	     		   		 
        foreach ($array as $a) {	  	
            $l = new YtFavorite();     		     	  		     				 
            $l->LoadInfoByAssoc($a);    				    	 	
            $list[] = $l;    	 	  			     		  
        }     	     			 	 			 	     
        return $list;    	     		
    }  		

}

// class YtBuyview extends Base {
//     public function __construct() {
//         global $zbp;
//         parent::__construct($zbp->table['ytuser_buyview'], $zbp->datainfo['ytuser_buyview'], __CLASS__);   	 	  	    	 	
//     }
// }

class YtConsume extends Base { 		 	    	 	 			 	 	    	 	 		 	
    	 		   	 	  					    	  	 	  
    public function __construct() {    	 			 			 	 		 	  		
        global $zbp; 			    			    	 	   	
        parent::__construct($zbp->table['ytuser_consume'],$zbp->datainfo['ytuser_consume'], __CLASS__);  		 			     	  	   
    }			 	    			   	 
     		     	    
    public function __get($name) {   	    	 
        global $zbp;    			    	 						   	 			
        switch ($name) {    	  	    	 	    	  
        case 'Author':    	   	  	   	   		 	
            return $zbp->GetMemberByID($this->Uid);  	 		    	  		 	 
            break;    	 	 	 		 	  
        case 'Post':    	  	 	 						     		     
            return $zbp->GetPostByID($this->Pid);    	  			    	
            break;    				 	    	    							
        case 'Category':    	     
            return $zbp->GetCategoryByID($this->Post->CateID);    	 								  
            break;     		 			    	   	 	     			 				
        case 'Tags':     	  				     		    	
            return $zbp->LoadTagsByIDString($this->Post->Tag);   	     		     						  
            break;     		    	 	 	  	
        default:    		    		    						
            return parent::__get($name);    	 	  	 	    			 		 		 
            break;    	 	  						  	  	 		  
        }     			   	     	  	  				     				    
    }    	 		 				   
    	 	 	 		    	   		  
    public function Time($s = 'Y-m-d H:i:s') {    	  	 	 	    	  	    						 	
        return date($s, (int) $this->Time);  		  	  		
    }     							
					    							
    public function GetConsumeList($l,$op) {    	  	  	     	 	    	 		 			    							 
        global $zbp;    	   	   		   	   	
        $field_table = $zbp->table['ytuser_consume'];     	  	   	   			 
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'cs_uid', $zbp->user->ID)), 'cs_id DESC', $l, $op);   	  	 				
        $array = null; 			    	 	 		 	    	   		 	  		
        $list = array();    	 	  	 	     			 			    	    	     	
        $array = $this->db->Query($sql); 		 	  	    	 	 
        if (!isset($array)) {return array();} 							    				   	    				 	 	
        foreach ($array as $a) {    		     	    	 				 			 	
            $l = new YtConsume();		   	     	    		   	 
            $l->LoadInfoByAssoc($a);   	    	    		     	  				
            $list[] = $l;	 	    		   	  
        } 	 	    	  			 	 	 
        return $list;     			 	 	    				 	   	  	 		
    }   	    	  				 
}  	


class YtuserBuy extends Base {    	 	 				
					     					 	    		  
    public function __construct() {    	  	 	 	   	
        global $zbp;  	     	   	   	   	
        parent::__construct($zbp->table['ytuser_buy'],$zbp->datainfo['ytuser_buy'], __CLASS__);    	 	  			 		 		   	 	 
    } 	    			   	 
 				    	     		    	 	 
    public function Time($s = 'Y-m-d H:i:s') {  	 	  	  
        return date($s, (int) $this->PostTime);    			     	  	     	  	 	 					
    }    	  	 						     			 			    			     
     				 	     			 	   			
    public function __get($name) {   	   	 
        global $zbp;    	   		   		 	 	  	 
        switch ($name) {	   	 	 	  
        case 'Author':
            return $zbp->GetMemberByID($this->Post->AuthorID);
            break;     				   			     	  	 	 
        case 'Post':     		   	 		    	 
            return $zbp->GetPostByID($this->LogID);  		 	   	 	 
            break; 	 	    	 			 	     	  	 			 		 
        case 'Category':    	  					    		     	     
            return $zbp->GetCategoryByID($this->Post->CateID);  	 	     			   		 	     
            break;  			 	  
        case 'Tags':   		    				 	 	
            return $zbp->LoadTagsByIDString($this->Post->Tag);    	  	  		   					   
            break;  					 	     		    	
        default:    						   			    				 	   	 	
            return parent::__get($name);     			    	  		     	 
            break;    		 		    	  	 				   
        }
    }

    public static function GetList($select = null, $w = null, $order = null, $limit = null, $option = null) {
        global $zbp;
        if (empty($select)) {
            $select = array('*');
        }
        if (empty($w)) {
            $conditions = array();
        }else{
            foreach ($w as $field_key => $field_value) {
                $field_name = $zbp->datainfo['ytuser_buy'][$field_key][0];
                $conditions[] = array('=', $field_name, $field_value);
            }
        }
        if (empty($order)) {
            $orders = array();
        }else{
            foreach ($order as $field_key => $field_value) {
                $field_name = $zbp->datainfo['ytuser_buy'][$field_key][0];
                $orders[$field_name]=$field_value;
            }
        }
        $sql = $zbp->db->sql->Select(
            $zbp->table['ytuser_buy'],
            $select,
            $conditions,
            $orders,
            $limit,
            $option
        );

        $result = $zbp->GetListType('YtuserBuy', $sql);
        return $result;
    }
    
}


class YtVerification extends Base {

    public function __construct() {
        global $zbp;
        parent::__construct($zbp->table['ytuser_verification'], $zbp->datainfo['ytuser_verification'], __CLASS__);
    }

    public function Send($s = 'Y-m-d H:i:s') {    	  			 	     	   							   	
        return date($s, (int) $this->Send); 	 	  		    	  		 		   
    } 		 

    public function Expire($s = 'Y-m-d H:i:s') {    	   				    							 
        return date($s, (int) $this->Expire);    		  	
    }

    public function __get($name) {
        global $zbp;
        switch ($name) {
        case 'Author':
            return $zbp->GetMemberByID($this->Uid);
            break;
        default:
            return parent::__get($name);
            break;
        }
    }

    public function YtByField($field, $field_value) {
        global $zbp;
        $field_table = $zbp->table['ytuser_verification'];
        $field_name = $zbp->datainfo['ytuser_verification'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value)), null, null, null);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new YtVerification();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }
    public function YtTypeCount($type) {
        global $zbp;     			
        $field_table = $zbp->table['ytuser_verification'];    	   	    	 	
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'vf_type', $type),array('=', 'vf_uid', $zbp->user->ID)), null, null, null);
        $array = $this->db->Query($sql);   									 
        if (count($array) > 0) {    					    			  	
            $this->LoadInfoByAssoc($array[0]);         	  			 				  
            return true;    		 	     	    		     	  		 	
        } else {   	    							
            return false;    	     		 	     	  	  	 
        }   						    	   		 	
    }			 			 	  		 		 
     						 		 			
    public function YtTypeMobile($type,$account) {   			    	   		
        global $zbp;    	     	    	 		    			 	
        $field_table = $zbp->table['ytuser_verification'];	  			     				    
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'vf_type', $type),array('=', 'vf_account', $account)), null, null, null);  			    	    	   	 	    	    	  
        $array = $this->db->Query($sql);     	  	 	   	    	 					 
        if (count($array) > 0) { 	  				    			    			 		  
            $this->LoadInfoByAssoc($array[0]);							    	
            return true;  	    	     
        } else {     			 			    	 	 	  	 	 	  	 
            return false;    	 	   	 		 	  		    	   			 
        }    	   	 	   	 
    }     	  	  		
}