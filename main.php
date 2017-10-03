<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

if (isset($_GET['act'])){$act = $_GET['act'];}else{$act = 'base';}

$blogtitle='用户中心';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php YtUser_SubMenu($act);?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">

  	<?php
	if ($act == 'base'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=base">  
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	<th>
	</th>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联APPID</b></p></td>
	<td><input type="text" name="appid" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appid);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联APPKey</b></p></td>
	<td><input type="text" name="appkey" style="width:200px;" value="<?php echo htmlspecialchars($zbp->Config('YtUser')->appkey);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>QQ互联回调地址</b></p></td>
	<td><?php echo $zbp->host?>zb_users/plugin/YtUser/login.php</td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>登录验证码</b></p></td>
    <td><input type="text" class="checkbox" name="login_verifycode" value="<?php echo $zbp->Config('YtUser')->login_verifycode;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>是否关闭插件自带注册</b></p></td>
    <td><input type="text" class="checkbox" name="open_reg" value="<?php echo $zbp->Config('YtUser')->open_reg;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>开启插件自带注册 邮件是否必须</b></p></td>
    <td><input type="text" class="checkbox" name="regneedemail" value="<?php echo $zbp->Config('YtUser')->regneedemail;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>开启插件自带注册 同IP同天 是否只能注册一个ID</b></p></td>
    <td><input type="text" class="checkbox" name="regipdate" value="<?php echo $zbp->Config('YtUser')->regipdate;?>" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>会员升级相关说明文字</b></p></td>
	<td><textarea name="readme_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->readme_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>充值卡相关说明文字</b></p></td>
	<td><textarea name="integral_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->integral_text);?></textarea></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>Vip折扣</b></p></td>
	<td><input type="text" name="vipdis" style="width:50px;" value="<?php echo (int)htmlspecialchars($zbp->Config('YtUser')->vipdis);?>" style="width:89%;" />%</td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>支付方式</b></p></td>
	<td>
	    <?php echo YtUser_payment_radio((int)htmlspecialchars($zbp->Config('YtUser')->payment))?>
	</td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
  	<?php
	}
    if ($act == 'guide'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=base">  
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td30"><p align='left'><b>页面</b><br><span class='note'></span></p></th>
	<th>链接
	</th>
</tr>
<tr>
	<td class="td30"><p align='left'><b>登录页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Login' ?>" target="_blank"><?php echo $zbp->host.'?Login' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>注册页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Register' ?>" target="_blank"><?php echo $zbp->host.'?Register' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>投稿列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Articlelist' ?>" target="_blank"><?php echo $zbp->host.'?Articlelist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>发布投稿</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Articleedt' ?>" target="_blank"><?php echo $zbp->host.'?Articleedt' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>积分充值</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Integral' ?>" target="_blank"><?php echo $zbp->host.'?Integral' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>支付状态</b></p></td>
	<td><a href="<?php echo $zbp->host.'?buy' ?>" target="_blank"><?php echo $zbp->host.'?buy' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>VIP卡充值</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Upgrade' ?>" target="_blank"><?php echo $zbp->host.'?Upgrade' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>购买列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Paylist' ?>" target="_blank"><?php echo $zbp->host.'?Paylist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>用户中心</b></p></td>
	<td><a href="<?php echo $zbp->host.'?User' ?>" target="_blank"><?php echo $zbp->host.'?User' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>评论列表</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Commentlist' ?>" target="_blank"><?php echo $zbp->host.'?Commentlist' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>密码找回页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Resetpwd' ?>" target="_blank"><?php echo $zbp->host.'?Resetpwd' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>密码重置页面</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Resetpassword' ?>" target="_blank"><?php echo $zbp->host.'?Resetpassword' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>修改账户名</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Nameedit' ?>" target="_blank"><?php echo $zbp->host.'?Nameedit' ?></a></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>绑定QQ</b></p></td>
	<td><a href="<?php echo $zbp->host.'?Binding' ?>" target="_blank"><?php echo $zbp->host.'?Binding' ?></a></td>
</tr>
<tr>
    <td class="td30"><p align='left'><b>收藏文章</b></p></td>
    <td><a href="<?php echo $zbp->host.'?Favorite' ?>" target="_blank"><?php echo $zbp->host.'?Favorite' ?></a></td>
</tr>
<tr>
    <td class="td30"><p align='left'><b>消费记录</b></p></td>
    <td><a href="<?php echo $zbp->host.'?Consume' ?>" target="_blank"><?php echo $zbp->host.'?Consume' ?></a></td>
</tr>
</table>
</form>
  	<?php
	}
	if ($act == 'upgrade'){
	?>
<form id="cbyid" enctype="multipart/form-data" method="post" action="save.php?type=setidvip">  
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
		<input type="text" name="Price" style="width:50px;" value="100" /> 天的VIP
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
<form enctype="multipart/form-data" method="post" action="save.php?type=upgrade">  
<input id="resetb" name="resetb" type="hidden" value="add" />
<table border="1" class="tableFull tableBorder">
    <tr>
	    <th  colspan="2" class="td30"><p align='center'><b>生成VIP卡</b><br><span class='note'></span></p></th>
    </tr>
    <tr>
	    <td class="td30"><p align='center'><b>生成</b><input type="text" name="Number" style="width:50px;" value="10" />张<input type="text" name="Price" style="width:50px;" value="30" />天vip卡</p></td>
	    <td>
            <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
            <input type="submit" class="button" onclick="$('#resetb').val('del');" value="删除已使用过的VIP卡" />
			<input type="submit" class="button" onclick="$('#resetb').val('deln');" value="删除未使用过的VIP卡" />
		    <input type="submit" class="button" onclick="$('#resetb').val('ept');" value="清空所有VIP卡" />
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
</tr>
<?php
$sql= $zbp->db->sql->Select($tyactivate_Table,'*',null,null,null,null);
$array=$zbp->GetListCustom($tyactivate_Table,$tyactivate_DataInfo,$sql);
foreach ($array as $key => $reg) {
	echo '<tr>';
	echo '<td class="td15">'.$reg->ID.'</td>';
	echo '<td>'.$reg->InviteCode.'</td>';
	echo '<td class="td20">'.$reg->Level.'</td>';
	echo '<td class="td20">'.($reg->AuthorID==0?'':$zbp->GetMemberByID($reg->AuthorID)->Name).'</td>';
	echo '</tr>';
}
?>
</table>
  	<?php
	}
	if ($act == 'recharge'){
	?>

<form id="cbyid" enctype="multipart/form-data" method="post" action="save.php?type=setidjf">  
<input id="resetc" name="resetc" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
    <tr>
	 <th><p align='center'><b>操作信息</b></p></th>
	    <th><p align='center'><b>积分充值</b></p></th>
		<th><p align='center'><b>获取积分</b></p></th>
		<th><p align='center'><b>清空积分</b></p></th>
	</tr>
    <tr>
	<td class="td30"><p align='center'>给用户ID为 
		<input type="text" name="UID" style="width:50px;" value="1" /> 的用户充值 
		<input type="text" name="Price" style="width:50px;" value="100" /> 积分
        </td>
	    <td>
            <p align='center'><input type="submit" class="button" value="确认充值" /></p>
			</td> <td>
			<p align='center'><input type="submit" onclick="$('#resetc').val('getjf');" class="button" value="获取信息" /></p>
			</td> <td>
			<p align='center'><input type="submit" onclick="$('#resetc').val('delidjf');" class="button" value="清空该ID积分" /><input type="submit" onclick="$('#resetc').val('delalljf');" class="button" value="清空所有用户积分" /></p>
        </td>
    </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=recharge">  
<input id="resetd" name="resetd" type="hidden" value="generate" />
<table border="1" class="tableFull tableBorder">
    <tr>
	    <th colspan="2" class="td30"><p align='center'><b>生成积分卡</b></p></th>
	</tr>
    <tr>
	    <td class="td30"><p align='center'><b>生成 </b>
		<input type="text" name="Number" style="width:50px;" value="10" /> 张 
		<input type="text" name="Price" style="width:50px;" value="100" /> 积分充值卡</p></td>
	    <td>
            <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
            <input type="submit" class="button" onclick="$('#resetd').val('Pricedel');" value="删除已使用的充值卡" />
			<input type="submit" class="button" onclick="$('#resetd').val('Pricedeln');" value="删除未使用的充值卡" />
            <input type="submit" class="button" onclick="$('#resetd').val('Priceept');" value="清空所有充值卡" />
        </td>
    </tr>
</table>
</form>

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

  	<?php
	}
	if ($act == 'buy'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=setorder">  
<input id="resete" name="resete" type="hidden" value="" />
<table border="1" class="tableFull tableBorder table_striped table_hover">
<tbody>
<tr>
	<th style="text-align:center">订单编号</th>
	<th style="text-align:center">用户ID</th>
	<th style="text-align:center">文章ID</th>
	<th style="text-align:center">金额</th>
	<th style="text-align:center">状态</th>
	<th style="text-align:center">物流单号</th>
	<th style="text-align:center">操作</th>
</tr>
<tr>
<td align="center"><input type="text" id="inputorderid" name="inputorderid" style="width:100%;" value="<?php echo GetGuid();?>" /></td>
<td align="center" class="td5"><input type="text" id="inputuserid" name="userid" style="width:100%;" value="" /></td>
<td align="center" class="td5"><input type="text" id="inputpostid" name="postid" style="width:100%;" value="" /></td>
<td align="center" class="td5">
<p align="center">
<input type="text" name="pay" id="inputpay" style="width:100%;" value="" /></p>
</td>
<td align="center">
<label><input name="state" id="stateno" type="radio" value="0" checked="checked">未付款</label><br>
<label><input name="state" id="stateyes" type="radio" value="1">已付款</label>
</td>
<td align="center" class="td15">
	<input type="text" name="express" id="inputexpress" style="width:100%;" value="" />
	</td>
<td align="center">
<p>
<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
<input type="submit" class="button" onclick="$('#resete').val('delid');" value="删除这个订单" />
</p>
<p>
<input type="submit" class="button" onclick="$('#resete').val('delnopay');" value="删除未付款订单" />
<input type="submit" class="button" onclick="$('#resete').val('delall');" value="删除所有订单" />
</p>
</td>
</tr>
</tbody>
</table>
</form>

<table width="100%">
        <tr class="firstRow">
            <th width="5%" valign="middle" align="center">
                ID
            </th>
            <th valign="middle" rowspan="1" colspan="2" align="center">
                订单信息
            </th>
            <th valign="middle" align="center" rowspan="1" colspan="2">
                用户信息
            </th>
            <th width="15%" valign="middle" align="center">
                订单状态<br/>
            </th>
        </tr>
<?php
$buystate = GetVars('buystate','GET');
    $p = new Pagebar('{%host%}zb_users/plugin/YtUser/main.php?act=buy'.($buystate?'&buystate='.$buystate:'').'{&page=%page%}', false);
    $p->PageCount = $zbp->option['ZC_MANAGE_COUNT'];
    $p->PageNow = (int) GetVars('page', 'GET') == 0 ? 1 : (int) GetVars('page', 'GET');
    $p->PageBarCount = $zbp->pagebarcount;
    $l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
    $op = array('pagebar' => $p);	
if ($buystate == 'paid'){
	$sql= $zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('>', 'buy_State', 0)),array('buy_ID'=>'desc'),$l,$op);
}elseif($buystate == 'nopay'){
	$sql= $zbp->db->sql->Select($YtUser_buy_Table,'*',array(array('=', 'buy_State', 0)),array('buy_ID'=>'desc'),$l,$op);	
}else{
	$sql= $zbp->db->sql->Select($YtUser_buy_Table,'*',null,array('buy_ID'=>'desc'),$l,$op);	
}
$array=$zbp->GetListCustom($YtUser_buy_Table,$YtUser_buy_DataInfo,$sql);


	
foreach ($array as $key => $reg) {
	$regname = $regalias = $regphone = $regadd = $regmail = $regrname = '';
	$postt = $zbp->GetPostByID($reg->LogID);
	if (isset($zbp->members[$reg->AuthorID])){
		$regname = $zbp->members[$reg->AuthorID]->Name;
		$regalias = $zbp->members[$reg->AuthorID]->Alias;
		$regurl = $zbp->members[$reg->AuthorID]->HomePage;
		$regmail = $zbp->members[$reg->AuthorID]->Email;
		if ($zbp->members[$reg->AuthorID]->Metas->Tel)$regphone = $zbp->members[$reg->AuthorID]->Metas->Tel;
		if ($zbp->members[$reg->AuthorID]->Metas->Add)$regadd = $zbp->members[$reg->AuthorID]->Metas->Add;
		if ($zbp->members[$reg->AuthorID]->Metas->Rname)$regrname = $zbp->members[$reg->AuthorID]->Metas->Rname;
	}else{
		$regname = '-YTID: '.$reg->AuthorID.' 未注册-';	
	}
	echo '<tr>';
	echo '   <td width="5%" valign="middle" align="center" rowspan="4" colspan="1">'.$reg->ID;
	echo '    </td>';
	echo '    <td width="10%" valign="middle" align="right">';
	echo '        订单编号：';
	echo '    </td>';
	echo '   <td width="30%" valign="middle" align="left"><a onclick="'.($reg->State?'$(\'#stateyes\').prop(\'checked\',true);$(\'#stateno\').prop(\'checked\',false);':'$(\'#stateno\').prop(\'checked\',true);$(\'#stateyes\').prop(\'checked\',false);').'$(\'#inputorderid\').val(\''.$reg->OrderID.'\');$(\'#inputpostid\').val(\''.$reg->LogID.'\');$(\'#inputuserid\').val(\''.$reg->AuthorID.'\');$(\'#inputpay\').val(\''.$reg->Pay.'\');$(\'#inputexpress\').val(\''.$reg->Express.'\');" href="javascript:;">'.$reg->OrderID.'</a></td>';
	echo '   <td width="10%" valign="middle" align="right">';
	echo '        用户ID：';
	echo '   </td>';
	echo '   <td width="30%" valign="middle" align="left"><a onclick="$(\'#inputuserid\').val(\''.$reg->AuthorID.'\');" href="javascript:;">'.$reg->AuthorID.'</a><small style="float:right">'.$regmail.'</small></td>';
	echo '   <td width="15%" valign="middle" align="center">'.($reg->State?'':'<span style="color:red;">未付款</span>');
	echo '   </td>';
	echo '</tr>';
	echo '<tr>';
	echo '   <td width="10%" valign="middle" align="right">';
	echo '       购买价格：';
	echo '   </td>';
	echo '   <td width="30%" valign="middle" align="left">'.$reg->Pay.'<small style="float:right"><a onclick="$(\'#inputpostid\').val(\''.$reg->LogID.'\');" href="javascript:;">文章ID：'.$reg->LogID.'</a></small></td>';
	echo '   <td width="10%" valign="middle" align="right">';
	echo '       账户：';
	echo '   </td>';
	echo '   <td width="30%" valign="middle" align="left">'.$regname.'('.$regalias.')</td>';
	echo '   <td width="15%" valign="middle" align="center">'.($reg->State?'<span style="color:green;">已付款</span>':'');
	echo '   </td>';
	echo '</tr>';
	echo '<tr>';
	echo '   <td width="10%" valign="middle" align="right">';
	echo '       订单名称：';
	echo '  </td>';
	echo '   <td width="30%" valign="middle" align="left"><a target="_blank" href="'.$postt->Url.'">'.($postt->ID?$reg->Title:'<span style="color:red">不存在的商品 LogID='.$reg->LogID).'</span></a></td>';
	echo '   <td width="10%" valign="middle" align="right" rowspan="2" colspan="1">';
	echo '       <span style="text-align: -webkit-right;">收货信息：</span>';
	echo '   </td>';
	echo '   <td width="30%" valign="middle" align="left" rowspan="2" colspan="1">地址：'.$regadd.'<br>收货人:'.$regrname.'<br>电话:'.$regphone.'</td>';
	echo '  <td width="15%" valign="middle" align="center">'.($reg->Express?'<span style="color:green;">已发货</span>':'');
	echo '   </td>';
	echo '</tr>';
	echo '<tr>';
	echo '   <td width="10%" valign="middle" align="right">';
	echo '       购买时间：';
	echo '   </td>';
	echo '   <td width="30%" valign="middle" align="left">'.date("Y-m-d H:i:s",$reg->PostTime).'</td>';
	echo '   <td width="15%" valign="middle" align="center">'.($reg->Express?'<a target="_blank" href="https://www.kuaidi100.com/chaxun?nu='.$reg->Express.'">'.$reg->Express.'</a>':'');
	echo '   </td>';
	echo '</tr>';
	echo '<tr>';
	echo '   <td valign="middle" align="center" rowspan="1" colspan="6"></br></td>';
	echo '</tr>';
	}
?>
</table>
<?php
echo '<hr/><p class="pagebar">';
foreach ($p->Buttons as $key => $value) {
	if($p->PageNow == $key)
		echo '<span class="now-page">' . $key . '</span>&nbsp;&nbsp;';
	else
		echo '<a href="' . $value . '">' . $key . '</a>&nbsp;&nbsp;';
}
echo '</p></div>';
?>
	<?php
	}
	if ($act == 'testing'){
	?>
	<form enctype="multipart/form-data" method="post" action="save.php?type=testing"> 
	  <p>
		<input type="submit" class="button" value="一键修复插件表" />
	  </p>
	</form>
	<?php
	}
	?>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>