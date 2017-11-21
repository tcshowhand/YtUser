<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
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
		<?php echo YtUser_SubMenu('buy'); ?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">

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
	  $p = new Pagebar('{%host%}zb_users/plugin/YtUser/menu/buy.php'.'{?page=%page%}'.($buystate?'&buystate='.$buystate:''), false);
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

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>