<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('IMAGE')) {$zbp->ShowError(48);die();}

$blogtitle='缩略图插件';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<?php


$actiontype=GetVars('actiontype', 'POST');
if($actiontype == "set1"){
	$zbp->Config('IMAGE')->checkhost=GetVars("checkhost","POST");
	$zbp->Config('IMAGE')->on=GetVars("on","POST");
	$zbp->Config('IMAGE')->otherurl=GetVars("otherurl","POST");
	$zbp->Config('IMAGE')->changeurl=GetVars("changeurl","POST");
	$zbp->Config('IMAGE')->CacheExternalUrl=GetVars("CacheExternalUrl","POST");
	$zbp->SaveConfig('IMAGE');
	$zbp->SetHint('good','修改成功');
	Redirect('main.php');
}else if($actiontype=="clearcache"){
	$file=$blogpath.'static/';
	if(file_exists($file)){
		IMAGE_deleteDir($file);
	}
	$zbp->SetHint('good','清理成功');
	Redirect('main.php');
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
				<li><a goto="tab1" style="cursor: pointer;"  class="default-tab"><span>配置</span></a></li>
			</ul>
		</div>
		<!-- End .content-box-header -->
		<div class="content-box-content">
			<div from="1" class="tab-content default-tab" style="border:none;padding:0px;margin:0;" id="tab1">
				<div style="clear:both;" ></div>
				<table name='base' style="padding:0px;margin:0px;width:700px;">
					<form  method="post" action="main.php">
					<input type='hidden' name="actiontype" value="clearcache">
					<tr>
					<td width="35%"><label><p align="center">清空缩略图缓存</p></label></td>
					<td width="75%"><input name="" type="Submit" class="button" value="清空缓存"/></p></td>
					</tr>
					</form> 
				</table>
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
							<p align="center"><b>启用缩略图</b></p>
						</td>
						<td>
							<p><input type="text" name="on"  class="checkbox" value="<?php echo $zbp->Config('IMAGE')->on;?>" style="display:none;"></p>
						</td>
						<td>
							<span align="center">启用时IMAGE相关函数返回处理后的url，关闭时返回原url</span>
						</td>
					</tr>
			<tr>
						<td>
							<p align="center"><b>是否缓存外部网站的图片的缩略图</b></p>
						</td>
						<td>
							<p><input type="text" name="CacheExternalUrl"  class="checkbox" value="<?php echo $zbp->Config('IMAGE')->CacheExternalUrl;?>" style="display:none;"></p>
						</td>
						<td>
							<span align="center">启用时IMAGE相关函数返回处理后的url，关闭时返回原url</span>
						</td>
					</tr>
					<tr>
						<td>
							<p align="center"><b>防盗链</b></p>
						</td>
						<td>
							<p><input type="text" name="checkhost"  class="checkbox" value="<?php echo $zbp->Config('IMAGE')->checkhost;?>" style="display:none;"></p>
						</td>
						<td>
							<span align="center">只能在本站域名下查看缩略图[仅对动态模式下有效，伪静态模式下无效！]</span>
						</td>
					</tr>
					<tr>
						<td>
							<p align="center"><b>防盗链时允许的域名</b></p>
						</td>
						<td>
							<p><textarea type="text" style="width:100%" name="otherurl" ><?php echo $zbp->Config('IMAGE')->otherurl ?></textarea></p>
						</td>
						<td>
							<span align="center">多个使用英文,号分隔，需要包含http://</span>
						</td>
					</tr>
					<tr>
						<td>
							<p align="center"><b>缩略图伪静态</b></p>
						</td>
						<td>
							<p><input type="text" name="changeurl"  class="checkbox" value="<?php echo $zbp->Config('IMAGE')->changeurl;?>" style="display:none;"></p>
						</td>
						<td>
						
						</td>
					</tr>
<tr>
    	<td colspan="3">
							<span align="center"><p>如果您不了解什么是伪静态，请勿启用</p>
							<p>nginx规则</p>
							<textarea style="width:800px;height:100px;">rewrite ^/static/(.*)-(.*)-(.*)-(.*)-a.jpg$ /zb_users/plugin/IMAGE/pic.php?src=$1&width=$2&height=$3&cuttype=$4;</textarea>
							<p>Apache规则</p>
							<textarea style="width:800px;height:100px;">
RewriteRule static/(.*?)-(.*?)-(.*?)-(.*?)-a\.jpg zb_users/plugin/IMAGE/pic\.php?src=$1&width=$2&height=$3&cuttype=$4 
</textarea>
<p>IIS web.config</p>
<textarea style="width:800px;height:200px;"><rule name="IMAGE">
 <conditions logicalGrouping="MatchAll">
                        <add input="{REQUEST_FILENAME}" matchType="IsFile" ignoreCase="false" negate="true" />
                        <add input="{REQUEST_FILENAME}" matchType="IsDirectory" ignoreCase="false" negate="true" />
                    </conditions>
<match url="static/(.*?)-(.*?)-(.*?)-(.*?)-a\.jpg"  />
<action type="Rewrite" url="/zb_users/plugin/IMAGE/pic\.php?src={R:1}&amp;width={R:2}&amp;height={R:3}&amp;cuttype={R:4}"  />
</rule></textarea>
							</span>
						</td>
    </tr>
				</table>
				<input name="set1" type="button" class="button" value="提交"/>&nbsp;&nbsp;
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
	$("div[from='1']").hide();
	$("#tab1").show();
});
</script>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>