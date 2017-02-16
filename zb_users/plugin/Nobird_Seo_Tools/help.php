<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='帮助 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


if(GetVars('delsetting', 'GET')=='1'){
Nobird_Seo_Tools_DeleteSetting();
DisablePlugin('Nobird_Seo_Tools');

	Redirect($zbp->host.'zb_system/cmd.php?act=PluginMng');
}
?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">

    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
     <tr height="32"><td>使用帮助：</td></tr>
     <tr height="32"><td style="color:#F00">        1、SEO标签、标题分隔符一经设置不建议经常更改；</td></tr>
     <tr height="32"><td>       2、<a href="http://zhanzhang.baidu.com/wiki/112">百度已支持Canonical标签</a>；</td></tr>
     <tr height="32"><td>       3、首次使用本插件，蜘蛛信息可能要过一阵子才能查看的到；</td></tr>
     <tr height="32"><td>       4、<a href="io.php">数据导出和导入</a>[测试版，不包含数据库，仅备份设置参数]；</td></tr>
     <tr height="32"><td>       5、如有宝贵意见还望提出，将在下一版中进行修订；</td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td><input type="button" onclick="window.location.href='?delsetting=1'" value="停用插件并删除配置信息和数据库" />
</td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       APP作者：Nobird。主页：<a href="http://www.birdol.com" target="_blank">鸟儿博客</a></td></tr>
     <tr height="32"><td>       如果在使用过程中有什么问题，请到作者主页进行反馈。</td></tr>
     <tr height="32"><td>       快速解决问题的方法：联系QQ：8769298，竭诚为您服务。</td></tr> 
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