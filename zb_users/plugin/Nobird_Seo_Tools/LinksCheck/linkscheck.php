<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}
require $blogpath . 'zb_users/plugin/Nobird_Seo_Tools/LinksCheck/class.php';

NB_checklink::getvar();
$blogtitle='首页外链检测 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
require $blogpath . 'zb_users/plugin/Nobird_Seo_Tools/LinksCheck/linkscheck_config.php';

?>

<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php 

echo '
<a href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/LinksCheck/linkscheck.php" style="float: right;"><span class="m-right m-now ">外链检测</span></a>
<a href="'.$zbp->host.'zb_system/cmd.php?act=ModuleEdt"><span class="m-left">新建模块</span></a>
<a href="'.$zbp->host.'zb_system/cmd.php?act=ModuleEdt&amp;filename=navbar"><span class="m-left">导航栏</span></a>
<a href="'.$zbp->host.'zb_system/cmd.php?act=ModuleEdt&amp;filename=link"><span class="m-left">友情链接</span></a>
<a href="'.$zbp->host.'zb_system/cmd.php?act=ModuleEdt&amp;filename=favorite"><span class="m-left">网站收藏</span></a>
<a href="'.$zbp->host.'zb_system/cmd.php?act=ModuleEdt&amp;filename=misc"><span class="m-left">图标汇集</span></a>
';


?></div>
  <div id="divMain2">
				<table name='base' border="1" class="tableFull tableBorder tableBorder-thcenter">
					<tr class="color1">
						<th> 序号 </th>
						<th> 链接内容 </th>
						<th> 链接地址 </th>
						<th> 文本 </th>
						<th> 检测结果 </th>
					</tr>

				<?php NB_Getlink(); ?>
<tr>
	<td colspan="5"><!--<p><b>!*可能会检测一个您的首页在列表里，懒得处理了...</b></p>--></td>
</tr>
				</table>
<form id="sfform" method="post" action="">
<input type='hidden' name="actiontype" value="set5">
<table name='base' style="padding:0px;margin:0px;width:100%;">
</table>
<input name="set" type="button" class="button" value="开始检测友链"/>
</form>
<form method="post">
<table border="1" class="tableFull tableBorder">
<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、插件会检查位于您博客首页的全部外链。</p>
	<p>2、如果对方的页面中没有您外链的静态内容，会给予提示。</p>
	<p>3、检测结果可能会不准，仅供参考。</p>
	<p>4、目前尚未针对nofollow进行详细检测,需要自行查看。</p>
	<p>5、本工具可以模拟百度蜘蛛抓取对方页面[不信可以去看看蜘蛛统计，已经多了一条哦(IP地址与你服务器IP地址一致)]。</p>

	</td>
</tr>
</table>

	</form>

	</div>

	<script type="text/javascript">ActiveLeftMenu("aModuleMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	


<script type="text/javascript">
$(document).ready(function(){
	$("input[name='set']").click(function(){
		NB_LinksCheck_fun(1);
	});
});

function NB_LinksCheck_fun(i){
	var ob=$("tr[check='"+i+"']");
	if(ob!=null && ob.length>0){
		var url=ob.find("td[type='url']").text();
		NB_LinksCheck_url(url,ob);
		i++;
		setTimeout(function(){
		NB_LinksCheck_fun(i);
		},3000);
		
	}
}

function NB_LinksCheck_url(url,ob){
	ob.find("td[type='result']").text("正在检测...");
	$.ajax({
		type:'post',
		async:true,
		url:'',
		data:{
			url:url,
			actiontype:'set5'
		},
		timeout:30000,
		dataType:'html',
		complete:function(){
		},
		success:function(data){
		//	ob.find("td[type='result']").text(data);
				ob.find("td[type='result']").html(data);

		}
	});
}
</script>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>