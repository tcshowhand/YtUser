<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin($dm_tools['name'])) {$zbp->ShowError(48);die();}

$blogtitle='大谋应用基';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(count($_POST)>0){dm_tools_save_config($dm_tools_configs_all,'set.php','参数已提交成功');}
?>
<style>
.hashr{padding-bottom:10px;border-bottom:1px solid #eee;padding-left:10px;}
.hashr:hover{padding-bottom:8px;border-bottom:3px solid #eee;}
.dm_tools_set_main_table b{font-size:1.2em;}
.dm_tools_set_main_table p {line-height:25px;}
</style>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div id="divMain2">
<form method="post">
<table border="1" style="width:100%" class="dm_tools_set_main_table"><tbody>
	<tr style="height:35px">
		<th align="left"><b>配置项目</b></th>
		<th align="left"><b>配置说明</b></th>
	</tr>
<tr>
	<td align="left">

		<p class="hashr">
		<b>编辑器增强</b>
</br>
UEditor短代码 <input type="text" name="dm_tools_ueditorplugs_ueditor"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_ueditorplugs_ueditor;?>" style="display:none;"> / Tinymce短代码 <input type="text" name="dm_tools_ueditorplugs_tinymce"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_ueditorplugs_tinymce;?>" style="display:none;"> 

		</p>
		<p class="hashr">
		<b>文章过滤</b>
		</br>
		过滤文章ID : 
<input name='clist' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->clist;?>'>
</br>
过滤分类ID : 
<input name='clist_cat' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->clist_cat;?>'>
</br>
		</p>
		<p class="hashr">
		<b>小工具</b>
		</br>
		离开当前页面变换标题 : 
<input name='x_head_outtitle' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->x_head_outtitle;?>'>
</br>
		进入页面变换标题 : 
<input name='x_head_intitle' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->x_head_intitle;?>'>
</br>
百度自动推送 <input type="text" name="dm_tools_autobaidu_switch"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_autobaidu_switch;?>" style="display:none;"> / 360自动推送ID <input name='dm_tools_autoso' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->dm_tools_autoso;?>'>
		</p>
		
		<p class="hashr">
		<b>文章图片优化</b>
		</br>
		修改图片Title方式
		</br>
		<label><input name="dm_tools_articleimg_xtitle" type="radio" value="" <?php echo !$zbp->Config($dm_tools['name'])->dm_tools_articleimg_xtitle?'checked="checked"':'';?>/>关闭</label>
		<label><input name="dm_tools_articleimg_xtitle" type="radio" value="1" <?php echo $zbp->Config($dm_tools['name'])->dm_tools_articleimg_xtitle== '1'?'checked="checked"':'';?>/>替换覆盖</label>
		<label><input name="dm_tools_articleimg_xtitle" type="radio" value="2" <?php echo $zbp->Config($dm_tools['name'])->dm_tools_articleimg_xtitle == '2'?'checked="checked"':'';?>/>追加</label>	
		</br>
		修改图片Alt方式</br>
		<label><input name="dm_tools_articleimg_xalt" type="radio" value="" <?php echo !$zbp->Config($dm_tools['name'])->dm_tools_articleimg_xalt?'checked="checked"':'';?>/>关闭</label>
		<label><input name="dm_tools_articleimg_xalt" type="radio" value="1" <?php echo $zbp->Config($dm_tools['name'])->dm_tools_articleimg_xalt== '1'?'checked="checked"':'';?>/>替换覆盖</label>
		<label><input name="dm_tools_articleimg_xalt" type="radio" value="2" <?php echo $zbp->Config($dm_tools['name'])->dm_tools_articleimg_xalt == '2'?'checked="checked"':'';?>/>追加</label>	
		</br>
		多图时末尾追加内容 : 
		<input name='dm_tools_articleimg_lasttxt' type='text' value='<?php echo $zbp->Config($dm_tools['name'])->dm_tools_articleimg_lasttxt;?>'>
		</p>
		<p class="hashr">
		<b>自动TAGS</b>(DZ在线中文分词)
		</br>
		<input type="text" name="dm_tools_autotags_switch"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_autotags_switch;?>" style="display:none;">
		</p>
		<p class="hashr">
		<b>远程图片本地化</b>
		</br>
		<input type="text" name="dm_tools_remoteimg_switch"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_remoteimg_switch;?>" style="display:none;">
		</p>
		<p class="hashr">
		<b>缩略图</b>
		</br>
		开关 : <input type="text" name="dm_tools_thumb_switch"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_thumb_switch;?>" style="display:none;"> / <a class="button" href="action.php?type=delthumb">清理缩略图</a>
		</br>
		伪静态 : 
		<input type="text" name="dm_tools_thumb_changeurl"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_thumb_changeurl;?>" style="display:none;">

		</br>
		是否缓存外部网站的图片的缩略图 : 
		<input type="text" name="dm_tools_thumb_remoteimg"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_thumb_remoteimg;?>" style="display:none;">
		</br>
		防盗链 : 
<input type="text" name="dm_tools_thumb_checkhost"  class="checkbox" value="<?php echo $zbp->Config($dm_tools['name'])->dm_tools_thumb_checkhost;?>" style="display:none;">
<span>伪静态模式下无效！</span>
		</br>
		防盗链白名单
		</br>
<textarea placeholder="多个使用 | 号分隔，需要包含http://" type="text" style="width:100%" name="dm_tools_thumb_checkhostin" ><?php echo $zbp->Config($dm_tools['name'])->dm_tools_thumb_checkhostin ?></textarea>
		</p>
		
	</td>
	
	
	
	
	<td align="left">
<p>文章过滤:<br/>示例A index|tag:22|33 示例B 22|33</p>

<p>分类过滤:<br/>示例A index|tag:2|3 示例B 2|3</p>
	
	<p>nginx规则 nginx.conf</p>
<textarea style="width:100%;height:80px;">rewrite ^/thumbs/(.*)-(.*)-(.*)-(.*)-a.jpg$ /zb_users/plugin/dm_tools/thumb/pic.php?src=$1&width=$2&height=$3&cuttype=$4;</textarea>
<p>Apache / kangle 规则 .htaccess</p>
<textarea style="width:100%;height:80px;">
RewriteRule thumbs/(.*?)-(.*?)-(.*?)-(.*?)-a\.jpg zb_users/plugin/dm_tools/thumb/pic\.php?src=$1&width=$2&height=$3&cuttype=$4
</textarea>
<p>IIS ≥7规则 web.config</p>
<textarea style="width:100%;height:250px;">
<rule name="thumb">
<conditions logicalGrouping="MatchAll">
<add input="{REQUEST_FILENAME}" matchType="IsFile" ignoreCase="false" negate="true" />
<add input="{REQUEST_FILENAME}" matchType="IsDirectory" ignoreCase="false" negate="true" />
</conditions>
<match url="thumbs/(.*?)-(.*?)-(.*?)-(.*?)-a\.jpg"  />
<action type="Rewrite" url="/zb_users/plugin/dm_tools/thumb/pic\.php?src={R:1}&amp;width={R:2}&amp;height={R:3}&amp;cuttype={R:4}"  />
</rule></textarea>



	</td>
</tr>
</tbody></table>
	  <p>
		<input name="" type="submit" class="button" value="提交">
	  </p>
	</form>
	
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/dm_tools/logo.png'; ?>");</script>
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>