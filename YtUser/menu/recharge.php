<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$act = GetVars("act", "GET");
if ($act === "setidjf") {
  CheckIsRefererValid();
  $uid = GetVars('UID','POST');   	    	 			 	     	 	
	if (($zbp->GetMemberByID($uid)->ID)){
		$add = GetVars('Price','POST');    			   	     			 		 
        $ytuser = new Ytuser(); 			   	   
        $ytuser->LoadInfoByField('Uid',$uid);    	 	 			  	    		     	  	 	 	
        if(!$ytuser->ID){
            $ytuser = new Ytuser();
            $ytuser->Uid=$uid;
            $ytuser->Oid=0;
            $ytuser->Save();
        }
		if(GetVars('resetc','POST')=='getjf'){
			$Price = $ytuser->Price;
			$zbp->SetHint('good',"用户ID: $uid 积分 $Price");
		}elseif(GetVars('resetc','POST')=='delidjf'){
            $ytuser->Price=0;
            $ytuser->Save();
			$zbp->SetHint('good',"用户ID: $uid 当前积分已清零");
		}elseif(GetVars('resetc','POST')=='delalljf'){  	 	    	 				 	
			$sql = $zbp->db->sql->Update($zbp->table['ytuser_ytuser'],array('tc_Price'=>0),array(array('>','tc_uid',0)));    	  		 	  			    	 				 	
			$zbp->db->Update($sql);    	  				     	   	   	 	 
			$zbp->SetHint('good','所有用户积分都已清零');
		}else{    	  	 
			$title="管理员赠送".(int)$add."积分";
			YtUser_add_coin($uid,0,$add,$title,0); 	  
			$zbp->SetHint('good',"用户ID: $uid 充值 $add 积分成功");
			$zbp->SetHint('good',"用户ID: $uid 当前积分 $ytuser->Price");    	  		 		   	     	  	 	     
		}     			  
	}else{     	   			    	 					     			 		 	    	 			 		
	    $zbp->SetHint('good',"用户ID错误");     			    		   	   	 	 								 			 	
	}
  Redirect('./recharge.php');
}

if ($act === "recharge") {
	CheckIsRefererValid();
	if(GetVars('resetd','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
	}
	if(GetVars('resetd','POST')=='Pricedeln'){
		YtUser_Price_DelnoUsedCode();
	}
	if(GetVars('resetd','POST')=='Priceept'){
		YtUser_Price_EmptyCode();
	}
    if(GetVars('resetd','POST')=='generate'){
        $Number = $_POST['Number'];
        $Price = $_POST['Price'];
        YtUser_Price_CreateCode($Number,$Price);
	}
	if(GetVars('resetd','POST')=='xz1'){
		YtUser_xz1(2,1);
	}
	if(GetVars('resetd','POST')=='xz2'){
		YtUser_xz1(2,2);
	}
	$zbp->SetHint('good','修改成功'); 
	Redirect('./recharge.php');
}

$blogtitle = '用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle; ?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('recharge'); ?>
	</div>
	<div id="divMain2">
	<form method="post" action="?act=setidjf">
		<input id="resetc" name="resetc" type="hidden" value="" />
		<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
			<table border="1" class="tableFull tableBorder">
				<tr>
					<th><p align='center'><b>操作信息</b></p></th>
					<th><p align='center'><b>积分充值</b></p></th>
					<th><p align='center'><b>获取积分</b></p></th>
					<th><p align='center'><b>清空积分</b></p></th>
				</tr>
				<tr>
					<td class="td30">
						<p align='center'>给用户ID为
							<input type="text" name="UID" style="width:50px;" value="1" /> 的用户充值
							<input type="text" name="Price" style="width:50px;" value="100" /> 积分
					</td>
					<td>
						<p align='center'><input type="submit" class="button" value="确认充值" /></p>
					</td>
					<td>
						<p align='center'><input type="submit" onclick="$('#resetc').val('getjf');" class="button" value="获取信息" /></p>
					</td>
					<td>
						<p align='center'><input type="submit" onclick="$('#resetc').val('delidjf');" class="button" value="清空该ID积分" /><input type="submit" onclick="$('#resetc').val('delalljf');" class="button" value="清空所有用户积分" /></p>
					</td>
				</tr>
			</table>
	</form>
	<form method="post" action="?act=recharge">
	<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
	<input id="resetd" name="resetd" type="hidden" value="" />
			<table border="1" class="tableFull tableBorder">
				<tr>
					<th colspan="2" class="td30">
						<p align='center'><b>生成积分卡</b></p>
					</th>
				</tr>
				<tr>
					<td class="td30">
						<p align='center'><b>生成 </b>
							<input type="text" name="Number" style="width:50px;" value="10" /> 张
							<input type="text" name="Price" style="width:50px;" value="100" /> 积分充值卡
						</p>
					</td>
					<td>
						<input type="submit" class="button" onclick="$('#resetd').val('generate');" value="<?php echo $lang['msg']['submit'] ?>" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会删除已使用的充值卡，数据无法恢复，确定要这样做吗？')?$('#resetd').val('Pricedel'):false;" value="删除已使用" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会删除未使用的充值卡，数据无法恢复，确定要这样做吗？')?$('#resetd').val('Pricedeln'):false;" value="删除未使用" />
						<input type="submit" class="button" onclick="return confirm('点击确认将会清空所有充值卡，数据无法恢复，确定要这样做吗？')?$('#resetd').val('Priceept'):false;" value="清空所有" />
						<input type="submit" class="button" onclick="$('#resetd').val('xz1');" value="下载已使用" />
			  			<input type="submit" class="button" onclick="$('#resetd').val('xz2');" value="下载未使用" />
					</td>
				</tr>
			</table>
		</form>
		<table border="1" class="tableFull tableBorder">
			<tr>
				<th class="td10"></th>
				<th>充值卡</th>
				<th>面值</th>
				<th>使用用户</th>
				<th>使用时间</th>
			</tr>
			<?php
			$sql = $zbp->db->sql->Select($zbp->table['ytuser_prepaid'], '*', null, 'tc_ID DESC', null, null);
			$array = $zbp->GetListCustom($zbp->table['ytuser_prepaid'], $zbp->datainfo['ytuser_prepaid'], $sql);
			foreach ($array as $key => $reg) {
				echo '<tr>';
				echo '<td class="td15">' . $reg->ID . '</td>';
				echo '<td>' . $reg->InviteCode . '</td>';
				echo '<td class="td20">' . $reg->Price . '</td>';
				echo '<td class="td20">' . ($reg->AuthorID == 0 ? '' : $zbp->GetMemberByID($reg->AuthorID)->Name) . '</td>';
				echo '<td class="td20">' . ($reg->UpTime == 0 ? '' : date('Y-m-d H:i:s', $reg->UpTime)) . '</td>';
				echo '</tr>';
			}
			?>
		</table>
		<script type="text/javascript">
			ActiveLeftMenu("aPluginMng");
		</script>
		<script type="text/javascript">
			AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png'; ?>");
		</script>
	</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>