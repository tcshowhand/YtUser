<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(count($_POST)>0){

    if(GetVars('reset','POST')=='add'){
		YtUser_CreateCode(10);
	}
	
	if(GetVars('reset','POST')=='del'){
		YtUser_DelUsedCode();
	}

	if(GetVars('reset','POST')=='ept'){
		YtUser_EmptyCode();
	}

    if(GetVars('reset','POST')=='Priceadd'){
		YtUser_Price_CreateCode(10);
	}
	
	if(GetVars('reset','POST')=='Pricedel'){
		YtUser_Price_DelUsedCode();
	}

	if(GetVars('reset','POST')=='Priceept'){
		YtUser_Price_EmptyCode();
	}

    $zbp->Config('YtUser')->dsurl = $_POST['dsurl'];
    $zbp->Config('YtUser')->default_level=(int)$_POST['default_level'];
    $zbp->Config('YtUser')->readme_text=$_POST['readme_text'];
    $zbp->Config('YtUser')->integral_text=$_POST['integral_text'];
    $zbp->SaveConfig('YtUser');
    $zbp->SetHint('good');
    Redirect('./main.php');
}

?>



<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"></div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	<th>
	</th>
</tr>
<tr>
	<td class="td30"><p align='left'><b>多说二级域名</b></p></td>
	<td><input type="text" name="dsurl" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->dsurl);?>" style="width:89%;" /> 例如"ytecn.duoshuo.com"，只需要输入“ytecn”</td>
</tr>


<tr>
	<td class="td30"><p align='left'><b>默认注册的会员等级</b></p></td>
	<td>
	<select name="default_level" style="width:200px;">
		<option value='5' <?php if($zbp->Config('YtUser')->default_level==5)echo 'selected="selected"';?>><?php echo $zbp->lang['user_level_name'][5] ;?></option>
		<option value='4' <?php if($zbp->Config('YtUser')->default_level==4)echo 'selected="selected"';?>><?php echo $zbp->lang['user_level_name'][4] ;?></option>
	</select>
	</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>会员升级相关说明文字</b></p></td>
	<td><textarea name="readme_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->readme_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>充值卡相关说明文字</b></p></td>
	<td><textarea name="integral_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->integral_text);?></textarea></td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>

<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
	<th >升级码</th>
	<th >用户级别(组)</th>
	<th >使用用户</th>
</tr>
<?php
$sql= $zbp->db->sql->Select($tyactivate_Table,'*',null,null,null,null);
$array=$zbp->GetListCustom($tyactivate_Table,$tyactivate_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
	echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td>'.$reg->InviteCode.'</td>';
	echo '<td class="td20">'.$zbp->lang['user_level_name'][$reg->Level].'</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>

	  <hr/>
	  <p>
		<input type="submit" class="button" onclick="$('#reset').val('add');" value="生成10个协作者升级码" />

		<input type="submit" class="button" onclick="$('#reset').val('del');" value="删除已使用过的升级码" />
		
		<input type="submit" class="button" onclick="$('#reset').val('ept');" value="清空所有升级码" />
	  </p>


<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10"></th>
	<th >充值卡</th>
	<th >面值</th>
	<th >使用用户</th>
</tr>
<?php
$sql= $zbp->db->sql->Select($typrepaid_Table,'*',null,null,null,null);
$array=$zbp->GetListCustom($typrepaid_Table,$typrepaid_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
	echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td>'.$reg->InviteCode.'</td>';
	echo '<td class="td20">'.$reg->Price.'</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>

	  <hr/>
	  <p>
		<input type="submit" class="button" onclick="$('#reset').val('Priceadd');" value="生成10张100元充值卡" />

		<input type="submit" class="button" onclick="$('#reset').val('Pricedel');" value="删除已使用过的充值卡" />
		
		<input type="submit" class="button" onclick="$('#reset').val('Priceept');" value="清空所有充值卡" />
	  </p>

	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/RegPage/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>