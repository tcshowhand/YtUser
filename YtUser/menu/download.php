<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';    
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$act = GetVars("act", "GET");
if ($act === "save") {
  CheckIsRefererValid();
  $zbp->Config('YtUser')->isdownload = GetVars('isdownload','POST');
  $zbp->Config('YtUser')->download_notice = GetVars('download_notice','POST');
  $zbp->Config('YtUser')->downloadsum = (int)GetVars('downloadsum','POST');
  $zbp->Config('YtUser')->downloadzsum = (int)GetVars('downloadzsum','POST');
  $zbp->Config('YtUser')->downloadsumy = (int)GetVars('downloadsumy','POST');
  $zbp->Config('YtUser')->downloadsumj = (int)GetVars('downloadsumj','POST');
  $zbp->Config('YtUser')->downloadsumn = (int)GetVars('downloadsumn','POST');
  $zbp->Config('YtUser')->downloadsumz = (int)GetVars('downloadsumz','POST');
  $zbp->SaveConfig("YtUser");
  $zbp->SetHint('good');
  
  Redirect('./download.php');
}

$blogtitle='用户中心';       	 
require $blogpath . 'zb_system/admin/admin_header.php';						   
require $blogpath . 'zb_system/admin/admin_top.php';			
     				
?>

<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php echo YtUser_SubMenu('download'); ?>
  </div>
  <div id="divMain2">

  <form enctype="multipart/form-data" method="post" action="?act=save">
  <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken(); ?>">
  <table border="1" class="tableFull tableBorder">
  <tr>
 <th><p align='left'><b>选项</b><br><span class='note'></span></p></th>
 <th></th>
  </tr>
  <tr>
    <td><p align='left'><b>是否开启下载站功能</b></p></td>
    <td><input type="text" class="checkbox" name="isdownload" value="<?php echo $zbp->Config('YtUser')->isdownload;?>" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>普通用户每日下载次数</b></p></td>
    <td><input type="text" name="downloadzsum" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->downloadzsum ? $zbp->Config('YtUser')->downloadzsum : "1" ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>月卡用户每日下载次数</b></p></td>
    <td><input type="text" name="downloadsumy" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->downloadsumy ? $zbp->Config('YtUser')->downloadsumy : "5" ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>季卡用户每日下载次数</b></p></td>
    <td><input type="text" name="downloadsumj" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->downloadsumj ? $zbp->Config('YtUser')->downloadsumj : "10" ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>年卡用户每日下载次数</b></p></td>
    <td><input type="text" name="downloadsumn" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->downloadsumn ? $zbp->Config('YtUser')->downloadsumn : "15" ;?>" style="width:89%;" /></td>
  </tr>
  <tr>
    <td><p align='left'><b>终身用户每日下载次数</b></p></td>
    <td><input type="text" name="downloadsumz" style="width:150px;" value="<?php echo (int)$zbp->Config('YtUser')->downloadsumz ? $zbp->Config('YtUser')->downloadsumz : "30" ;?>" style="width:89%;" /></td>
  </tr>

  <tr>
	<td class="td30"><p align='left'><b>下载说明文字</b></p></td>
	<td><textarea name="download_notice" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('YtUser')->download_notice);?></textarea></td>
</tr>
  </table>
		<hr/>
		<p>
	 <input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
		</p>
  </form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/YtUser/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';      	  	
RunTime();    				   				
?>