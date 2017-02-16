<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='首页 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
/*
$result = AppCentre_App_Check_ISBUY('481');//$appid为收费应用在应用中心上的数字ID（即文章ID）
if (!$result['data']['buy']) {
    $zbp->SetHint('bad', '您未购买本插件，请到Z-BlogPHP应用中心购买.');
    //Redirect($bloghost.'zb_users/plugin/AutoBackup/main.php');
//    exit;
}
*/
//badcheck

?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">

    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
     <tr height="32"><td>温馨提示：</td></tr>
     <tr height="32"><td style="color:#F00">        1、本页面是插件设置页面，请谨慎操作；</td></tr>
     <tr height="32"><td>       2、插件在您<b style="color:#F00">发布新文章后</b>自动生成符合规范的<a href ="<?php echo $zbp->host?>sitemap.xml">sitemap.xml</a>，请停用其他Sitemap插件；</td></tr>
     <tr height="32"><td>       3、部分功能可能需要更新缓存后生效；</td></tr>
     <tr height="32"><td>       4、如有宝贵意见还望提出，将在下一版中进行修订；</td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       主题作者：Nobird。主页：<a href="http://www.birdol.com" target="_blank">鸟儿博客</a></td></tr>
     <tr height="32"><td>       如果在使用过程中有什么问题，请到作者主页进行反馈。</td></tr>
  </tr>
</table>


	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>