<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}
$blogtitle='用户中心';

$act = GetVars("act", "GET");
if ($act === "setidvip") {
	CheckIsRefererValid();
	$uid = GetVars('UID','POST');    	    					     	     		     
	if (($zbp->GetMemberByID($uid)->ID)){  			 			
		$add = GetVars('Price','POST');     						     	  	 			     		 			
        $ytuser = new Ytuser();		   	 	    	  			 
        $array=$ytuser->LoadInfoByField('Uid',$uid);   			 	     		
        if(!$array){     		    	    		     	  	   
            $ytuser = new Ytuser();   					    		   	 			 
            $ytuser->Uid=$uid;    		    				 	 	
            $ytuser->Oid=0;    	
            $ytuser->Save();    				    				 	 	
        }    			 	   	    	  
		if(GetVars('reseta','POST')=='getvip'){     	  				    
			if ($ytuser->Vipendtime){ 				    	 	  		    	    	 		   	
			$time = $ytuser->Vipendtime;     			    	 	 
			$time = date("Y-m-d H:i:s",$time);       	 			
			$zbp->SetHint('good',"用户ID: $uid 当前VIP到期时间 $time");    			 				    	 	    	  		     	 
			}else{			   			  
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已过期"); 	  
			}  		 	  	     					 	    	    		 
			Redirect('./viplist.php'); 	    	 			 
		}elseif(GetVars('reseta','POST')=='delidvip'){    			 				 	    
            $ytuser->Vipendtime=time();
            $ytuser->Save();
			$zbp->SetHint('good',"用户ID: $uid 当前VIP已设置为过期");
			Redirect('./viplist.php');
		}elseif(GetVars('reseta','POST')=='delallvip'){
			$sql = $zbp->db->sql->Select($zbp->table['ytuser_ytuser'],'*',array('>','tc_Vipendtime',0),null,null,null);
			$array = $zbp->db->Query($sql);
			foreach ($array as $key=>$arrr){
				$key = $key+1;
				$uid = $arrr['tc_uid'];
				if (($zbp->GetMemberByID($uid)->ID)){
					$sql = $zbp->db->sql->Update($zbp->table['Member'],array('mem_Level'=>5),array(array('=','mem_ID',$uid),array('=','mem_Level',4)));
					$zbp->db->Update($sql);
				}
                $ytuser = new Ytuser();
                $ytuser->LoadInfoByField('Uid',$uid);
                $ytuser->Vipendtime=time();
                $ytuser->Save();
				$zbp->SetHint('good',$key."，用户ID:$uid 当前VIP已设置为过期");
			}
			$zbp->SetHint('good',count($array)+1 .'，所有用户VIP都已设置为过期');
			Redirect('./viplist.php');
		}else{
			$sql = $zbp->db->sql->Update($zbp->table['Member'],array('mem_Level'=>4),array(array('=','mem_ID',$uid),array('>','mem_Level',4)));    	    		   					 			
			$zbp->db->Update($sql);
			$zbp->SetHint('good',"用户ID: $uid 用户 Level 升级成功");
			$YtConsume = new YtConsume();
			$YtConsume->Uid=$uid;
			$YtConsume->Pid=0;
			$YtConsume->Time=time();
			$YtConsume->Money=0;
			$YtConsume->Type=1;
			$YtConsume->Title="管理员赠送".(int)$add."天VIP";
			$YtConsume->Save();
			$Vipendtime=$ytuser->Vipendtime;
			if($Vipendtime<time()){$Vipendtime=time();}
			$add = $Vipendtime + 86400*(int)$add;
			$ytuser->Vipendtime=$add;
			$ytuser->Save();
			$add = date("Y-m-d H:i:s",$add);
			$zbp->SetHint('good',"用户ID: $uid 当前VIP 到期时间 $add");
			Redirect('./viplist.php');    		   		     		    		    		     	  	  
		}    	 	  			    	 				 	 		 
	}    	 
}

if ($act === "upgrade") {
	if(GetVars('resetb','POST')=='add'){
        $Number = GetVars('Number','POST');
        $Price = GetVars('Price','POST');
        YtUser_CreateCode($Number,$Price);
	}
	if(GetVars('resetb','POST')=='del'){
		YtUser_DelUsedCode();
	}
	if(GetVars('resetb','POST')=='deln'){
		YtUser_DelUsedCoden();
	}
	if(GetVars('resetb','POST')=='ept'){
		YtUser_EmptyCode();
	}

	if(GetVars('resetb','POST')=='xz1'){
		YtUser_xz1(1,1);
	}

	if(GetVars('resetb','POST')=='xz2'){
		YtUser_xz1(1,2);
	}
	$zbp->SetHint('good','修改成功'); 			    	    		    	
	Redirect('./viplist.php');     	  	 	    			   	
} 

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('viplist'); ?>
    </div>
  <div id="divMain2">

  <form method="post" action="?act=setidvip">
  <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
  <input id="reseta" name="reseta" type="hidden" value="" />
  <table border="1" class="tableFull tableBorder">
	  <tr>
	   <th><p align='center'><b>操作信息</b></p></th>
		  <th><p align='center'><b>VIP充值</b></p></th>
		  <th><p align='center'><b>获取天数</b></p></th>
		  <th><p align='center'><b>删除VIP</b></p></th>
	  </tr>
	  <tr>
	  <td class="td30"><p align='center'>给用户ID为 
		  <input type="text" name="UID" style="width:50px;" value="1" /> 的用户充值 
		  <input type="text" name="Price" style="width:50px;" value="30" /> 天的VIP
		  </td>
		  <td>
			  <p align='center'><input type="submit" class="button" value="确认充值" /></p>
			  </td> <td>
			  <p align='center'><input type="submit" onclick="$('#reseta').val('getvip');" class="button" value="获取信息" /></p>
			  </td> <td>
			  <p align='center'><input type="submit" onclick="$('#reseta').val('delidvip');" class="button" value="删除该ID的VIP" /><input type="submit" onclick="$('#reseta').val('delallvip');" class="button" value="删除所有用户VIP" /></p>
		  </td>
	  </tr>
  </table>
  </form>
  <form method="post" action="?act=upgrade">
  <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">

  <input id="resetb" name="resetb" type="hidden" value="" />
  <table border="1" class="tableFull tableBorder">
	  <tr>
		  <th  colspan="2" class="td30"><p align='center'><b>生成VIP卡</b><br><span class='note'></span></p></th>
	  </tr>
	  <tr>
		  <td class="td30"><p align='center'><b>生成</b><input type="text" name="Number" style="width:50px;" value="10" />张<input type="text" name="Price" style="width:50px;" value="30" />天vip卡</p></td>
		  <td>
			  <input type="submit" class="button" onclick="$('#resetb').val('add');" value="<?php echo $lang['msg']['submit']?>" />
			  <input type="submit" class="button" onclick="$('#resetb').val('del');" value="删除已使用过的" />
			  <input type="submit" class="button" onclick="$('#resetb').val('deln');" value="删除未使用过的" />
			  <input type="submit" class="button" onclick="$('#resetb').val('ept');" value="清空所有" />
			  <input type="submit" class="button" onclick="$('#resetb').val('xz1');" value="下载已使用" />
			  <input type="submit" class="button" onclick="$('#resetb').val('xz2');" value="下载未使用" />
		  </td>
	  </tr>
  </table>
  </form>
  <table border="1" class="tableFull tableBorder">
  <tr>
	  <th class="td10"></th>
	  <th >VIP卡</th>
	  <th >增长天数</th>
	  <th >使用用户</th>
	  <th>使用时间</th>
  </tr>
  <?php
  $sql= $zbp->db->sql->Select($zbp->table['ytuser_activate'],'*',null,'reg_ID DESC',null,null);   		     		    	 							   
  $array=$zbp->GetListCustom($zbp->table['ytuser_activate'],$zbp->datainfo['ytuser_activate'],$sql);    	 			    			  
  foreach ($array as $key => $reg) {
	  echo '<tr>';
	  echo '<td class="td15">'.$reg->ID.'</td>';
	  echo '<td>'.$reg->InviteCode.'</td>';
	  echo '<td class="td20">'.$reg->Level.'</td>';
	  echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	  echo '<td class="td20">'.($reg->UpTime==0?'':date('Y-m-d H:i:s', $reg->UpTime)).'</td>';
	  echo '</tr>';
  }
  ?>
  </table>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';    	 		   	     	  				    	 		 	  
RunTime();    	 		   	 	   		
?>