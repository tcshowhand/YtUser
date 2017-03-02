<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('ggravatar')) {$zbp->ShowError(48);die();}

$blogtitle = 'Gravatar头像Ⅱ';

if (count($_POST) > 0) {
	$zbp->Config('ggravatar')->s = GetVars('s','post');
	$zbp->Config('ggravatar')->default_url = GetVars('default_url','post');
	$zbp->Config('ggravatar')->d = GetVars('d','post');
	$zbp->Config('ggravatar')->dd = GetVars('dd','post');
	$zbp->Config('ggravatar')->r = GetVars('r','post');
	$zbp->Config('ggravatar')->local_priority = GetVars('local_priority','post');
	$zbp->Config('ggravatar')->check = GetVars('check','post');
	$zbp->SaveConfig('ggravatar');

	$zbp->SetHint('good');
	Redirect('./main.php');
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle; ?></div>
  <div class="SubMenu"></div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<table border="1" class="tableFull tableBorder tableBorder-thcenter">
<tr>
	<th width="20%">项目</th>
	<th width="50%">设置</th>
	<th width="30%">说明</th>
</tr>
<tr>
<td><p align='left'><b>·Gravatar URL</b><br/><span class='note'></span></p></td>
<td><p><input id='default_url' name='default_url' style='width:90%;' type='text' value='<?php echo $zbp->Config('ggravatar')->default_url ?>' /></p></td>
<td>
	<p><b>V2EX</b>：<a href="javascript:void(0)" class="enterGravatar">https://cdn.v2ex.com/gravatar/</a></p>
	<p><b>MoeNet公共库</b>：<a href="javascript:void(0)" class="enterGravatar">https://gravatar.moefont.com/avatar/</a></p>
	<p><b>多说CDN</b>：<a href="javascript:void(0)" class="enterGravatar">http://gravatar.duoshuo.com/avatar/</a></p>
	<p><b>官方加密</b>：<a href="javascript:void(0)" class="enterGravatar">https://secure.gravatar.com/avatar/</a></p>
</td>
</tr>
<tr>
<td><p align='left'><b>·判断G头像开通后是否是默认头像</b><br/><span class='note'></span></p></td>
<td><p><input id='check' name='check' class="checkbox" type='text' value='<?php echo $zbp->Config('ggravatar')->check ?>' /></p></td>
<td><p>打开后一次性需要判断的请求比较多的话会很慢！缓存数据请无视</p></td>
</tr>
<tr>
<td><p align='left'><b>·头像尺寸</b><br/><span class='note'></span></p></td>
<td><p><input id='s' name='s' style='width:90%;' type='text' value='<?php echo $zbp->Config('ggravatar')->s ?>' /></p></td>
<td><p>整数，最大500</p></td>
</tr>
<tr>
<td><p align='left'><b>·默认头像</b><br/><span class='note'></span></p></td>
<td><p><input id='d' name='d' style='width:90%;' type='text' value='<?php echo $zbp->Config('ggravatar')->d ?>' /></p></td>
<td>
	<p><b>神秘人(一个灰白头像)</b>：<a href="javascript:void(0)" class="rGravatar">mm</a></p>
	<p><b>抽象几何图形</b>：<a href="javascript:void(0)" class="rGravatar">identicon</a></p>
	<p><b>小怪物</b>：<a href="javascript:void(0)" class="rGravatar">monsterid</a></p>
	<p><b>用不同面孔和背景组合生成的头像</b>：<a href="javascript:void(0)" class="rGravatar">wavatar</a></p>
	<p><b>八位像素复古头像</b>：<a href="javascript:void(0)" class="rGravatar">retro</a></p>
	<p><b>本地随机头像</b>：<a href="javascript:void(0)" class="rGravatar">local_rg</a></p>
	<p><b>本地默认头像</b>：<a href="javascript:void(0)" class="rGravatar">local_g</a></p>
</td>
</tr>
<tr>
<td><p align='left'><b>·自定义默认头像</b><br/><span class='note'></span></p></td>
<td><p><input id='dd' name='dd' style='width:90%;' type='text' value='<?php echo $zbp->Config('ggravatar')->dd ?>' /></p></td>
<td><p><b>默认</b>：<a href="javascript:void(0)" class="lGravatar"><?php echo $zbp->host; ?>zb_users/avatar/0.png</a></p></td>
</tr>

<tr>
<td><p align='left'><b>·限制级别</b><br/><span class='note'></span></p></td>
<td><p><input id='r' name='r' style='width:90%;' type='text' value='<?php echo $zbp->Config('ggravatar')->r ?>' /></p></td>
<td><p>（G普通级、PG辅导级、R和X为限制级），一般情况下都是G</p></td>
</tr>
<tr>
<td><p align='left'><b>·注册会员优先查找本地头像</b><br/><span class='note'></span></p></td>
<td><p><input id='local_priority' name='local_priority' class="checkbox" type='text' value='<?php echo $zbp->Config('ggravatar')->local_priority ?>' /></p></td>
<td><p></p></td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit'] ?>" />
	  </p>
	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/ggravatar/logo.png'; ?>");</script>
  </div>
</div>

<script>
$(function() {
	$(".enterGravatar").click(function() {
		var $this = $(this);
		$("#default_url").val($this.text());
	});
});
$(function() {
	$(".rGravatar").click(function() {
		var $this = $(this);
		$("#d").val($this.text());
	});
});
$(function() {
	$(".lGravatar").click(function() {
		var $this = $(this);
		$("#dd").val($this.text());
	});
});
</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>