<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('sf_praise_sdk')) {$zbp->ShowError(48);die();}

$blogtitle='文章点赞插件';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<?php


$actiontype=GetVars('actiontype', 'POST');
if($actiontype == "set1"){
	$zbp->Config('sf_praise_sdk')->basevalue=GetVars("basevalue","POST");
	$zbp->Config('sf_praise_sdk')->addvalue=GetVars("addvalue","POST");
	$zbp->SaveConfig('sf_praise_sdk');
	$zbp->SetHint('good','修改成功');
	Redirect('main.php');
}else if($actiontype == "set10"){
	$zbp->Config('sf_praise_sdk')->version="1.0";
	$zbp->Config('sf_praise_sdk')->basevalue="0,0,0,0,0";
	$zbp->Config('sf_praise_sdk')->addvalue="0,0,0,0,0";
	$zbp->SaveConfig('sf_praise_sdk');
	SF_praise_sdk::dropDb();
	SF_praise_sdk::createDb();
	$zbp->SetHint('good','修改成功');
	Redirect('main.php');
}else{
	sf_praise_sdk_checkconfig();
}

?>

<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
  </div>
  <div id="divMain2">
<!--代码-->
	<div class="content-box">
		<!-- Start Content Box -->
		<div class="content-box-header">
			<ul class="content-box-tabs">
				<li><a goto="tab1" style="cursor: pointer;"  class="default-tab"><span>描述配置</span></a></li>
				<li><a goto="tab10" style="cursor: pointer;"  ><span style='color:red;'>重置配置</span></a></li>
			</ul>
		</div>
		<!-- End .content-box-header -->
		<div class="content-box-content">
			<div from="1" class="tab-content default-tab" style="border:none;padding:0px;margin:0;" id="tab1">
				<div style="clear:both;" ></div>
				<p style='color:red;'>请确认使用的主题支持本插件。如果您的主题不支持本插件，可以使用非开发版获得此功能：<a href='http://app.zblogcn.com/?id=489' target="_Blank">http://app.zblogcn.com/?id=489</a> </p>
				<form id="form1" method="post" action="main.php">
				<input type='hidden' name="actiontype" value="set1">
				<table name='base' style="padding:0px;margin:0px;width:100%;">
					<tr>
						<th width="15%">
							<p><b>项目</b></p>
						</th>
						<th width="65%">
							<p><b>配置</b></p>
						</th>
						<th width="20%">
							<p><b>说明</b></p>
						</th>
					</tr>
					<tr>
						<td>
							<p align="center"><b>基础值（传说中的金手指）</b></p>
						</td>
						<td>
							<p><textarea type="text" style="width:100%" name="basevalue" ><?php echo $zbp->Config('sf_praise_sdk')->basevalue ?></textarea></p>
						</td>
						<td>
							<span align="center">从左至右5个基础值，使用英文,号分隔。即，文章刚发表时就会有该数值</span>
						</td>
					</tr>
					<tr>
						<td>
							<p align="center"><b>（向上）浮动值</b></p>
						</td>
						<td>
							<p><textarea type="text" style="width:100%" name="addvalue" ><?php echo $zbp->Config('sf_praise_sdk')->addvalue ?></textarea></p>
						</td>
						<td>
							<span align="center">所有文章都从相同的5个数值开始会不会有些假呢？不说了，依旧从左至右5个数字，使用英文,号分隔。</span>
						</td>
					</tr>
				</table>
				<input name="set1" type="button" class="button" value="提交"/>&nbsp;&nbsp;
				</form>
			</div>
			<!-- 重置配置 -->
			<div from="1" class="tab-content default-tab" style="border:none;padding:0px;margin:0;" id="tab10">
				<form id="form10" method="post" action="main.php">
				<input type='hidden' name="actiontype" value="set10" />
				<div style="clear:both;" ></div>
				<span style="color:red;">重置配置将删除该插件数据，包括记录和配置！，请确认无误后点击下方按钮重置！</span>
				<div style="clear:both;" ></div>
				<br/>
				<input name="set10" type="button" class="button" value="重置配置"/>&nbsp;&nbsp;
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$("a[goto]").click(function(){
		var goto=$(this).attr("goto");
		$("div[from='1']").hide();
		$("#"+goto).show();
	});
	$("table[name='base']").each(function(){
		$(this).find("tr:even").addClass("color2");
		$(this).find("tr:odd").addClass("color3");
	});
	$("input[name='set1']").click(function(){
		//无数据校验
		$("#form1").submit();
	});
	$("input[name='set10']").click(function(){
		//无数据校验
		$("#form10").submit();
	});
	$("div[from='1']").hide();
	$("#tab1").show();
});
</script>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>