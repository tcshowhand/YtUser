<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Foam')) {$zbp->ShowError(48);die();}
$blogtitle='泡沫主题配置';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div id="divMain2">

	<form enctype="multipart/form-data" method="post" action="save.php?type=base">	
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="15%"><p align="center">配置项</p></th>
    <th width="50%"><p align="center">配置内容</p></th>
	<th width="25%"><p align="center">配置说明</p></th>
  </tr>
  <tr>
    <td><label for="logo.jpg"><p align="center">上传头像</p></label></td>
    <td><p align="left"><input name="logo.jpg" type="file"/></p></td>
	<td><p align="left">泡沫主题头像设置</p></td>
  </tr>
</table>
 <br />
   <input name="" type="Submit" class="button" value="保存"/>
    </form>
<br />

	</div>
</div>
<script type="text/javascript">ActiveTopMenu("topmenu_Foam");</script> 
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>