<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle = 'Nobird_Seo_Tools';

if (GetVars('action', 'GET') == 'save_setting') {
	//var_dump($zbp);exit;
	$zbp->Config('Nobird_Seo_Tools')->pingtool_strData = GetVars('data', 'POST');
	$zbp->SaveConfig('Nobird_Seo_Tools');
	$zbp->SetHint('good');
	Redirect('ping.php');
	exit;
}

$data = '';
$data = $zbp->Config('Nobird_Seo_Tools')->pingtool_strData;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
<div class="SubMenu">
<?php 
if($zbp->Config('Nobird_Sitemap')->Use_BigData){
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/sitemap_large.php"><span class="m-left">Sitemap索引</span></a>';
}
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/archive.php"><span class="m-left">Archive 存档</span></a>';

		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/coustom.php"><span class="m-left ">自定义Url</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Sitemap/ping.php"><span class="m-left  m-now">Ping中心</span></a>';

?>
</div>
  <div id="divMain2">
    <form border="1" name="edit" id="edit" method="post" action="ping.php?action=save_setting">
      <p><b>设置Ping中心(一行一个ping地址,如不需要此功能，请留空)</b></p>
      <p>
        <textarea style="height:300px;width:100%" name="data" id="data"><?php echo TransferHTML($data, '[textarea]');?></textarea>
      </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" class="button" value="提交" name="B1"/>
      </p>
      几个常用地址(<b style="color:red;">注意：国内主机添加墙外的地址可能会导致网站速度变慢！</b>)：
      <div id="ccdz">
        <p>谷歌Ping地址：<a href="http://blogsearch.google.com/ping/RPC2" onclick="return false;">http://blogsearch.google.com/ping/RPC2</a></p>
        <p>百度Ping地址：<a href="http://ping.baidu.com/ping/RPC2" onclick="return false;">http://ping.baidu.com/ping/RPC2</a></p>
        <p>PingOmatic:<a href="http://rpc.pingomatic.com/" onclick="return false">http://rpc.pingomatic.com/</a></p>
      </div>
    </form>
  </div>
</div>
        <script type="text/javascript">$(document).ready(function(e) {$("#ccdz a").each(function(i){$(this).bind("click",function(){$("#data").html($("#data").html()+$(this).attr("href")+"\n")})})});</script>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
