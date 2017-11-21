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
		<?php echo YtUser_SubMenu('viplist'); ?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">

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

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>