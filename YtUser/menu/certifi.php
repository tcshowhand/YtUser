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
		<?php echo YtUser_SubMenu('certifi'); ?>
		<a href="http://www.kancloud.cn/showhand/zbloguser" target="_blank"><span class="m-left" style="color:#F00">适配教程</span></a>
		<?php if ($act == 'buy'){?>
		<a href="?act=buy&buystate=nopay"><span class="m-right" style="color:red">未付款</span></a>
		<a href="?act=buy&buystate=paid"><span class="m-right" style="color:green">已付款</span></a>
		<?php }?>
    </div>
  <div id="divMain2">

    <form enctype="multipart/form-data" method="post" action="save.php?type=setcertifi">  
  <input id="reset" name="reset" type="hidden" value="" />
  <table border="1" class="tableFull tableBorder">
  <tr>
	  <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
	  <th>说明</th>
  </tr>
  <tr>
	  <td><p align='left'><b>是否开启强制实名认证</b></p></td>
	  <td><input type="text" class="checkbox" name="Oncertif" value="<?php echo $zbp->Config('YtUser')->Oncertif;?>" /></td>
  </tr>
  <tr>
	  <td><p align='left'><b>设置投稿标题限制字数</b></p></td>
	  <td><input type="text" name="certifititle" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->certifititle ? $zbp->Config('YtUser')->certifititle : "0" ;?>" style="width:89%;" />0为不限制</td>
  </tr>
  </table>
		<hr/>
		<p>
		  <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
		</p>
  </form>
  <table border="1" class="tableFull tableBorder">
  <tr>
	  <th class="td10"></th>
	  <th >用户</th>
	  <th >姓名</th>
	  <th >身份证</th>
	  <th >状态</th>
	  <th >操作</th>
  </tr>
<?php

$p=new Pagebar('{%host%}?Consume{&page=%page%}',false);
$page = GetVars('page', 'GET');
$page = (int) $page == 0 ? 1 : (int) $page;
$p->PageCount = $zbp->option['ZC_DISPLAY_COUNT'];
$p->PageNow=$page;
$p->PageBarCount=$zbp->pagebarcount;
$l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);
$op = array('pagebar' => $p);
  $favorite = new YtUser;
  $array = $favorite->GetYtuserList($l,$op);
  foreach ($array as $key => $reg) {
	  echo '<tr>';
	  echo '<td class="td15">'.$reg->ID.'</td>';
	  echo '<td>'.$reg->Uid.'('.$reg->User->Name.')'.'</td>';
	  echo '<td>'.$reg->Name.'</td>';
	  echo '<td class="td20">'.$reg->Idcard.'</td>';
	  echo '<td class="td20">'.($reg->Isidcard==1 ? "待审核" : ($reg->Isidcard==2 ? "已通过" : "未通过")).'</td>';
	  echo '<td class="td20">';
		if($reg->Isidcard==1){
		echo '<a onclick="return window.confirm(\'审核通过\');" href="save.php?type=certifi&act=edit&id='.$reg->Uid.'"><img src="'.$zbp->host.'zb_system/image/admin/user_edit.png" width="16" /></a>' . 
		'&nbsp;&nbsp;&nbsp;&nbsp;
		<a onclick="return window.confirm(\'审核不通过\');" href="save.php?type=certifi&act=del&id='.$reg->Uid.'"><img src="'.$zbp->host.'zb_system/image/admin/delete.png" width="16" /></a>';
		}
	  echo '</td>';
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