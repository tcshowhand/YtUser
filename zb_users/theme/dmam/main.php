<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('dmam')) {$zbp->ShowError(48);die();}

$blogtitle='D.M 主题 '.$dmam_ver;


require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
$linlink=$zbp->host .'zb_system/admin/module_edit.php?act=ModuleEdt&id=';

dmam_check_pluin();

$act = "";
if ($_GET['act']){
	$act = $_GET['act'] == "" ? 'notice' : $_GET['act'];
}

if(count($_POST)>0){

		foreach (dmam_theme_sets($act) as $theme_set => $theme_set_post) {
		$zbp->Config('dmam')->$theme_set = GetVars($theme_set,'post');
		}

	$zbp->SaveConfig('dmam');
	$zbp->ShowHint('good','设置修改成功');
}
?>
<script src="source/colorset.js" type="text/javascript"></script>
<link href="source/evol-colorpicker.min.css" rel="stylesheet" />
<script src="source/evol-colorpicker.min.js" type="text/javascript"></script>

<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
    	<?php dmam_SubMenu($act);?>
        <a href="http://www.imlgm.com/" target="_blank"><span class="m-right">&nbsp;帮助</span></a>
    </div>
<div id="divMain2">
<?php if ($act == 'notice'){?>
	<table class="themeset-form"  id="set-notice">
		 <tr><td>【使用须知】</td></tr>
		 <tr><td>1，请进群提问！！请进群提问！！请进群提问！！</br>
		 →→→→<a href="https://jq.qq.com/?_wv=1027&k=45fX2q6 target="_blank">点击链接加入群【ZBLOG PHP 互助交流群】</a>←←←←</td></tr>
		 <tr><td>2，请详细阅读此页面的须知，千万莫做“问题儿童”</td></tr>
		 <tr><td>3，版权可以选择不显示，但是不显示版权的不提供任何帮助</td></tr>
		 <tr><td>4，主题首页、首页分页和分类页、文章页、独立页面侧栏分别是sidebar 1/2/3/4</td></tr>
		 <tr><td>5，使用此主题必装dm_tools和ggavatar插件，其他插件会做兼容处理</td></tr>
	</table>
<?php }
if ($act == 'updata'){
?>
	<table class="themeset-form"  id="set-updata">
		 <tr><th colspan="2" style="text-align:left;">【更新日志】</th></tr>
<tr>
<td style="text-align:right;">20170309:</td>
<td>1，移动端头部修改；2，头部和底部html调整；</td>
</tr>
<tr>
<td style="text-align:right;">20170306:</td>
<td>1，修复t_paylist模版一处字段错误</td>
</tr>
<tr>
<td style="text-align:right;">20170306:</td>
<td>1，修复一些没有完善的自定义字段；2，更换主题封面</td>
</tr>
<tr>
<td style="text-align:right;">20170303:</td>
<td>1，YTUSER插件变动适配</td>
</tr>
<tr>
<td style="text-align:right;">20170301:</td>
<td>1，正式开始适配 YT USER用户中心插件</td>
</tr>	
<tr>
<td style="text-align:right;">20170227:</td>
<td>1，修复独立页面；2，修复文章下面的几个按钮，调整了LOGO位置处理方式</td>
</tr>	
<tr>
<td style="text-align:right;">20170225:</td>
<td>1，修复文章归档</td>
</tr>	
 
		 
<tr><td style="text-align:right;">20161119:</td><td>1，后台一些没完成的功能暂时屏蔽;2，滚动加载设置选择方式修改;</td></tr>
		 		 <tr>
		 <td style="text-align:right;">20161007:</td>
		 <td>1，修复PJAX失效的问题；2，完善主题的一些功能</td>
		 </tr><tr>
		 <td style="text-align:right;">20160929:</td>
		 <td>1，加入PJAX模式并在后台提供开关；2，修改了一点评论的css样式；3，给非Pjax模式下的网站启用不同的侧栏 1、2、3、4</td>
		 </tr>
		 <tr>
		 <td style="text-align:right;">20160923:</td>
		 <td>1，替换了随机图；</td>
		 </tr>
	</table>
<?php }
if ($act == 'uploadpic'){
?>
<form method="post">
   <div id="pics_logo" class="imageshow">
    <div class="title">LOGO 上传
      <small>(* 大小 推荐高度 85px)</small></div>
    <input type="hidden" id="url_updatapic1" class="pics_logo-val" name="pics_logo" <?php echo $zbp->Config('dmam')->pics_logo?'value="'.$zbp->Config('dmam')->pics_logo.'"':'';?>>
    <img <?php echo $zbp->Config('dmam')->pics_logo?'src="'.$zbp->Config('dmam')->pics_logo.'"':'';?> id="pic_updatapic1">
    <input type="button" id="updatapic1" class="button" value="更换图片"><a onclick="$('.pics_logo-val').val('');$('#pic_updatapic1').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="pics_wx" class="imageshow">
    <div class="title">微信 上传
      <small>(* 推荐大小 200 × 200)</small></div>
    <input type="hidden" id="url_updatapic2" class="pics_wx-val" name="pics_wx" <?php echo $zbp->Config('dmam')->pics_wx?'value="'.$zbp->Config('dmam')->pics_wx.'"':'';?>>
    <img style="max-width:200px" <?php echo $zbp->Config('dmam')->pics_wx?'src="'.$zbp->Config('dmam')->pics_wx.'"':'';?> id="pic_updatapic2">
    <input type="button" id="updatapic2" class="button" value="更换图片"><a onclick="$('.pics_wx-val').val('');$('#pic_updatapic2').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="pics_zfb" class="imageshow">
    <div class="title">支付宝 上传
      <small>(* 推荐大小 200 × 200)</small></div>
    <input type="hidden" id="url_updatapic3" class="pics_zfb-val" name="pics_zfb" <?php echo $zbp->Config('dmam')->pics_zfb?'value="'.$zbp->Config('dmam')->pics_zfb.'"':'';?>>
    <img style="max-width:200px" <?php echo $zbp->Config('dmam')->pics_zfb?'src="'.$zbp->Config('dmam')->pics_zfb.'"':'';?> id="pic_updatapic3">
    <input type="button" id="updatapic3" class="button" value="更换图片"><a onclick="$('.pics_zfb-val').val('');$('#pic_updatapic3').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="pics_qq" class="imageshow">
    <div class="title">QQ 上传
      <small>(* 推荐大小 200 × 200)</small></div>
    <input type="hidden" id="url_updatapic4" class="pics_qq-val" name="pics_qq" <?php echo $zbp->Config('dmam')->pics_qq?'value="'.$zbp->Config('dmam')->pics_qq.'"':'';?>>
    <img <?php echo $zbp->Config('dmam')->pics_qq?'src="'.$zbp->Config('dmam')->pics_qq.'"':'';?> id="pic_updatapic4">
    <input type="button" id="updatapic4" class="button" value="更换图片"><a onclick="$('.pics_qq-val').val('');$('#pic_updatapic4').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="pics_skm" class="imageshow">
    <div class="title">收款码 上传
      <small>(* 推荐大小 200 × 200)</small></div>
    <input type="hidden" id="url_updatapic5" class="pics_skm-val" name="pics_skm" <?php echo $zbp->Config('dmam')->pics_skm?'value="'.$zbp->Config('dmam')->pics_skm.'"':'';?>>
    <img style="max-width:200px" <?php echo $zbp->Config('dmam')->pics_skm?'src="'.$zbp->Config('dmam')->pics_skm.'"':'';?> id="pic_updatapic5">
    <input type="button" id="updatapic5" class="button" value="更换图片"><a onclick="$('.pics_skm-val').val('');$('#pic_updatapic5').removeAttr('src')" href="javascript:;">删除</a></div>

  <div id="pics_fv" class="imageshow">
    <div class="title">网址图标 上传
      <small>(* 推荐大小 16 × 16)</small></div>
    <input type="hidden" id="url_updatapic7" class="pics_fv-val" name="pics_fv" <?php echo $zbp->Config('dmam')->pics_fv?'value="'.$zbp->Config('dmam')->pics_fv.'"':'';?>>
    <img style="max-width:50px" <?php echo $zbp->Config('dmam')->pics_fv?'src="'.$zbp->Config('dmam')->pics_fv.'"':'';?> id="pic_updatapic7">
    <input type="button" id="updatapic7" class="button" value="更换图片"><a onclick="$('.pics_fv-val').val('');$('#pic_updatapic7').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="apple_ico" class="imageshow">
    <div class="title">apple图标 上传
      <small>(* 推荐大小 114 × 114)</small></div>
    <input type="hidden" id="url_updatapic8" class="apple_ico-val" name="apple_ico" <?php echo $zbp->Config('dmam')->apple_ico?'value="'.$zbp->Config('dmam')->apple_ico.'"':'';?>>
    <img style="max-width:100px" <?php echo $zbp->Config('dmam')->apple_ico?'src="'.$zbp->Config('dmam')->apple_ico.'"':'';?> id="pic_updatapic8">
    <input type="button" id="updatapic8" class="button" value="更换图片"><a onclick="$('.apple_ico-val').val('');$('#pic_updatapic8').removeAttr('src')" href="javascript:;">删除</a></div>
  <div id="pics_avatar" class="imageshow">
    <div class="title">默认头像 上传
      <small>(* 推荐大小 200 × 200)</small></div>
    <input type="hidden" id="url_updatapic9" class="pics_avatar-val" name="pics_avatar" <?php echo $zbp->Config('dmam')->pics_avatar?'value="'.$zbp->Config('dmam')->pics_avatar.'"':'';?>>
    <img style="max-width:100px"  <?php echo $zbp->Config('dmam')->pics_avatar?'src="'.$zbp->Config('dmam')->pics_avatar.'"':'';?> id="pic_updatapic9">
    <input type="button" id="updatapic9" class="button" value="更换图片"><a onclick="$('.pics_avatar-val').val('');$('#pic_updatapic9').removeAttr('src')" href="javascript:;">删除</a></div>
<input type="hidden" name="check_isbuy" <?php echo $zbp->Config('dmam')->check_isbuy?'value="1"':'value="1"';?>>
<p class="botton_p"><input name="" type="Submit" class="button theme_set_form_button" value="保存"/></p>
</form>
<?php } 
if ($act == 'general'){
?>
<form method="post">
	<table class="themeset-form"  id="set-general">
<?php
if ($zbp->Config('dmam')->pics_logo){
$arr = array();
$arr = getimagesize($zbp->Config('dmam')->pics_logo);
echo '<input type="hidden" name="logo_width" value="'.$arr[0].'" />';
}
?>
	  <tr><th width="20%"><p align="right">配置项目</p></th><th width="50%"><p align="center">内容设定</p></th><th width="30%"><p align="left">设置说明</p></th></tr>
	  <tr>
		<td><p align="right">管理员ID</p></td>
		<td>
		  <p align="left"><input style="width:100px;" type="text" name="admin_id" value="<?php echo $zbp->Config('dmam')->admin_id;?>" /></p>
		</td>
		<td><p align="left">网站页面的最大宽度<br/>如 1200 px</p></td>
	  </tr>
	  <tr>
		<td><p align="right">网站主配色</p></td>
		<td style="background-color: <?php echo $zbp->Config('dmam')->color;?>;">
		  <p align="left"><input type="text" id="hideButton" name="color" value="<?php echo $zbp->Config('dmam')->color;?>" /></p>
		</td>
		<td><p align="left">选择网站颜色<br/>如 #FF00FF</p></td>
	  </tr>
<!-- 	  	  <tr>
		<td><p align="right">通用超文本协议</p></td>
		<td>
			<p>
			<label><input name="http" type="radio" value="" <?php echo !$zbp->Config('dmam')->http?'checked="checked"':'';?>/>关闭</label>
			<label><input name="http" type="radio" value="1" <?php echo $zbp->Config('dmam')->http?'checked="checked"':'';?>/>开启</label>
</p>
		</td>
		<td><p align="left">设置后需要重新上传主题设置的图片，幻灯片不需要,网站本身开启https时此处才会出现https选项</p></td>
	  </tr> -->
	  <tr>
		<td>
		  <p align="right">顶部导航跟随</p></td>
		<td>
			<p>
			<label><input name="topbar_fix" type="radio" value="" <?php echo !$zbp->Config('dmam')->topbar_fix?'checked="checked"':'';?>/>无变化</label>
			<label><input name="topbar_fix" type="radio" value="1" <?php echo $zbp->Config('dmam')->topbar_fix == '1'?'checked="checked"':'';?>/>导航跟随</label>	
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">最大宽度</p></td>
		<td>
		  <p align="left"><input style="width:100px;" type="text" name="site_maxwidth" value="<?php echo $zbp->Config('dmam')->site_maxwidth;?>" /> px</p>
		</td>
		<td><p align="left">网站页面的最大宽度<br/>如 1200 px</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">分隔符</p></td>
		<td>
			<p>
			<label><input name="fgf" type="radio" value=" " <?php echo $zbp->Config('dmam')->fgf == ' '?'checked="checked"':'';?>/>空格</label>
			<label><input name="fgf" type="radio" value="-" <?php echo $zbp->Config('dmam')->fgf == '-'?'checked="checked"':'';?>/>中横杠"-"</label>	
			<label><input name="fgf" type="radio" value="_" <?php echo $zbp->Config('dmam')->fgf == '_'?'checked="checked"':'';?>/>下划线"_"</label>
			<label><input name="fgf" type="radio" value="|" <?php echo $zbp->Config('dmam')->fgf == '|'?'checked="checked"':'';?>/>竖线"|"</label>
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">关键词</p></td>
		<td>
		  <p align="left"><textarea style="height:35px;line-height:35px;width:100%;" name="keywords" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->keywords;?></textarea></p>
		</td>
		<td><p align="left">注意必须使用英文的逗号","</p></td>
	  </tr>
	  <tr>
		<td><p align="right">网站描述</p></td>
		<td>
		  <p align="left"><textarea style="height:45px;line-height:22px;width:100%;" name="description" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->description;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">页头代码</p></td>
		<td>
		  <p align="left"><textarea style="height:45px;line-height:22px;width:100%;" name="headmate" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->headmate;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">页尾代码</p></td>
		<td>
		  <p align="left"><textarea style="height:45px;line-height:22px;width:100%;" name="footmate" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->footmate;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">顶部导航</p></td>
		<td>
		  <p align="left"><textarea style="height:45px;line-height:22px;width:100%;" name="top_nav" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->top_nav;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
					  <tr>
		<td>
		  <p align="right">前台登陆口</p></td>
		<td>
			<p>
			<label><input name="top_login" type="radio" value="0" <?php echo !$zbp->Config('dmam')->top_login?'checked="checked"':'';?>/>关闭</label>
			<label><input name="top_login" type="radio" value="1" <?php echo $zbp->Config('dmam')->top_login?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
					  <tr>
		<td>
		  <p align="right">使用新的登录页面</p></td>
		<td>
			<p>
			<label><input name="new_login" type="radio" value="0" <?php echo !$zbp->Config('dmam')->new_login?'checked="checked"':'';?>/>关闭</label>
			<label><input name="new_login" type="radio" value="1" <?php echo $zbp->Config('dmam')->new_login?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
					  <tr>
		<td>
		  <p align="right">Pjax(实验)</p></td>
		<td>
			<p>
			<label><input name="pjax" type="radio" value="0" <?php echo !$zbp->Config('dmam')->pjax?'checked="checked"':'';?>/>关闭</label>
			<label><input name="pjax" type="radio" value="1" <?php echo $zbp->Config('dmam')->pjax?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">整站变灰</p></td>
		<td>
			<p>
			<label><input name="site_gray" type="radio" value="0" <?php echo !$zbp->Config('dmam')->site_gray?'checked="checked"':'';?>/>关闭</label>
			<label><input name="site_gray" type="radio" value="1" <?php echo $zbp->Config('dmam')->site_gray?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">列表使用文章摘要</p></td>
		<td>
			<p>
			<label><input name="multi_intro" type="radio" value="0" <?php echo !$zbp->Config('dmam')->multi_intro?'checked="checked"':'';?>/>关闭</label>
			<label><input name="multi_intro" type="radio" value="1" <?php echo $zbp->Config('dmam')->multi_intro?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">随机头像</p></td>
		<td>
			<p>
			<label><input name="rand_avatar" type="radio" value="0" <?php echo !$zbp->Config('dmam')->rand_avatar?'checked="checked"':'';?>/>关闭</label>
			<label><input name="rand_avatar" type="radio" value="1" <?php echo $zbp->Config('dmam')->rand_avatar?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">搜索增强</p></td>
		<td>
			<p>
			<label><input name="new_search" type="radio" value="0" <?php echo !$zbp->Config('dmam')->new_search?'checked="checked"':'';?>/>关闭</label>
			<label><input name="new_search" type="radio" value="1" <?php echo $zbp->Config('dmam')->new_search?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">图片延迟加载</p></td>
		<td>
			<p>
			<label><input name="lasyload_imgs" type="radio" value="0" <?php echo !$zbp->Config('dmam')->lasyload_imgs?'checked="checked"':'';?>/>关闭</label>
			<label><input name="lasyload_imgs" type="radio" value="1" <?php echo $zbp->Config('dmam')->lasyload_imgs?'checked="checked"':'';?>/>打开</label>
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>

	  <tr>
		<td>
		  <p align="right">版权风格</p></td>
		<td>
			<p>
			<label><input name="copyright" type="radio" value="0" <?php echo !$zbp->Config('dmam')->copyright?'checked="checked"':'';?>/>不显示</label></p>
			<p>
			<label><input name="copyright" type="radio" value="1" <?php echo $zbp->Config('dmam')->copyright == 1?'checked="checked"':'';?>/>本站由 <a href="http://www.zblogcn.com/" title="RainbowSoft Z-BlogPHP" target="_blank">Z-BlogPHP</a> 强力驱动，<a href="http://www.imlgm.com/" title="大谋提供主题支持" target="_blank">大谋</a> 提供主题支持.</label></p>
			<p>
			<label><input name="copyright" type="radio" value="2" <?php echo $zbp->Config('dmam')->copyright == 2?'checked="checked"':'';?>/>Powered By <a href="http://www.zblogcn.com/" title="RainbowSoft Z-BlogPHP" target="_blank">Z-BlogPHP</a> Theme By <a href="http://www.imlgm.com/" title="模板由大谋提供" target="_blank">大谋</a></label></p>
			<p>
			<label><input name="copyright" type="radio" value="3" <?php echo $zbp->Config('dmam')->copyright  == 3?'checked="checked"':'';?>/>Powered By Z-BlogPHP Theme By 大谋.</label></p>
			<label><input name="copyright" type="radio" value="4" <?php echo $zbp->Config('dmam')->copyright  == 3?'checked="checked"':'';?>/>本站前端 Amaze UI , 后端 Zblog ，风格 by <a href="http://www.imlgm.com/" title="大谋博客" target="_blank">大谋</a>.</label></p>
<!-- 			<p>
			<label><input name="copyright" type="radio" value="4" <?php echo $zbp->Config('dmam')->copyright  == 4?'checked="checked"':'';?>/>copyright@<a href="<?php echo $zbp->host;?>" title="<?php echo $zbp->subname;?>" target="_blank"><?php echo $zbp->name;?></a></label>	  
			</p>
-->	
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">置顶设置</p></td>
		<td>
			<p>置顶样式：
			<label><input name="istop_style" type="radio" value="0" <?php echo !$zbp->Config('dmam')->istop_style?'checked="checked"':'';?>/>默认</label>
			<label><input name="istop_style" type="radio" value="1" <?php echo $zbp->Config('dmam')->istop_style == 1?'checked="checked"':'';?>/>浮动</label>
			<label><input name="istop_style" type="radio" value="2" <?php echo $zbp->Config('dmam')->istop_style == 2?'checked="checked"':'';?>/>带框</label>
			</p>
			<p>置顶排列：
			<label><input name="istop_m_num" type="radio" value="0" <?php echo !$zbp->Config('dmam')->istop_m_num?'checked="checked"':'';?>/>小2中3大4</label>
			<label><input name="istop_m_num" type="radio" value="1" <?php echo $zbp->Config('dmam')->istop_m_num == 1?'checked="checked"':'';?>/>小2中4大4</label>
			<label><input name="istop_m_num" type="radio" value="2" <?php echo $zbp->Config('dmam')->istop_m_num == 2?'checked="checked"':'';?>/>小3中3大4</label>
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
		<tr>
		<td>
		  <p align="right">前端CDN</p></td>
		<td>
			<p>
			<label><input name="site_cdn" type="radio" value="0" <?php echo !$zbp->Config('dmam')->site_cdn?'checked="checked"':'';?>/>本地</label>
			<label><input name="site_cdn" type="radio" value="1" <?php echo $zbp->Config('dmam')->site_cdn == 1?'checked="checked"':'';?>/>bootcdn</label>
			<label><input name="site_cdn" type="radio" value="2" <?php echo $zbp->Config('dmam')->site_cdn == 2?'checked="checked"':'';?>/>baidu</label>
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>

	  <tr>
		<td>
		  <p align="right">主题自带SEO</p></td>
		<td>
			<p>
			<label><input name="theme_seo" type="radio" value="0" <?php echo !$zbp->Config('dmam')->theme_seo?'checked="checked"':'';?>/>关闭</label>
			<label><input name="theme_seo" type="radio" value="1" <?php echo $zbp->Config('dmam')->theme_seo?'checked="checked"':'';?>/>打开</label>
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">分页导航</p></td>
		<td>
			<p>
			<label><input name="pagenav_style" value="0" onclick="$('.pagenav_style_on').val('0');" type="radio" <?php echo !$zbp->Config('dmam')->pagenav_style?'checked="checked"':'';?>/>数字</label>
			<label><input name="pagenav_style" value="1" onclick="$('.pagenav_style_on').val('1');" type="radio" <?php echo $zbp->Config('dmam')->pagenav_style == 1?'checked="checked"':'';?>/>上下页</label>
			<label><input name="pagenav_style" onclick="$('.pagenav_style_on').val('2');" type="radio" <?php echo $zbp->Config('dmam')->pagenav_style > 1?'checked="checked"':'';?>/>无限滚动</label>
			<input class="pagenav_style_on" style="width:30px;margin-left:10px;text-align:center;" type="text" name="pagenav_style" value="<?php echo $zbp->Config('dmam')->pagenav_style;?>" />←自定义滚动页数
			</p>
		</td>
		<td>
		  <p align="left">一次滚动多少页必须大于1，滚动1页后手动则设置成1.X，滚动次数会自动舍弃小数位取整。直接设置成1则为上下页模式</p></td>
	  </tr>
	  <tr>
		<td>
		  <label>
			<p align="right">评论屏蔽email</p></label>
		</td>
		<td>
			<p align="left"><textarea style="height:80px;line-height:22px;width:100%;" name="notinemail" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->notinemail;?></textarea></p>
		</td>
		<td>
			<p align="left">-</p>
		</td>
	  </tr>
	  <tr>
		<td>
		  <label>
			<p align="right">自定义CSS</p></label>
		</td>
		<td>
			<p align="left"><textarea style="height:80px;line-height:22px;width:100%;" name="user_css" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->user_css;?></textarea></p>
		</td>
		<td>
			<p align="left">如 .article261 h2 a{color:red}
			  <br/>.otitle-112{color:red}
			  <br/>#dm-topbar .am-container{padding-left:252px}<br/>@media (max-width:640px) {#dm-topbar .am-topbar-brand{margin-left:-101px;}}</p>
		</td>
	  </tr>
	</table>
<p class="botton_p"><input name="" type="Submit" class="button theme_set_form_button" value="保存"/></p>
</form>
<?php }
if ($act == 'pages'){
?>
<form method="post">
	<table class="themeset-form"  id="set-pages">
	  <tr><th width="20%"><p align="right">配置项目</p></th><th width="50%"><p align="center">内容设定</p></th><th width="30%"><p align="left">设置说明</p></th></tr>
	  <tr>
		<td><p align="right">首页</p></td>
		<td>
		  <p align="left">-列表标题导航：<textarea style="height:45px;line-height:22px;width:100%;" name="index_titlebar_nav" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->index_titlebar_nav;?></textarea></p>		  <!-- <p align="left">-右下角弹窗：<input style="width:100px;" type="text" name="index_onece_article" value="<?php echo $zbp->Config('dmam')->index_onece_article;?>" /></p> -->
		</td>
		<td><p align="left">右下角弹窗每天只在第一次打开网页显示</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">文章页</p></td>
		<td>
			<p>-摘要：
			<label><input name="article_intro" type="radio" value="0" <?php echo !$zbp->Config('dmam')->article_intro?'checked="checked"':'';?>/>关闭</label>
			<label><input name="article_intro" type="radio" value="1" <?php echo $zbp->Config('dmam')->article_intro?'checked="checked"':'';?>/>打开</label>	  
			</p>
			<p>-点赞：
			<label><input name="article_prise" type="radio" value="0" <?php echo !$zbp->Config('dmam')->article_prise?'checked="checked"':'';?>/>关闭</label>
			<label><input name="article_prise" type="radio" value="1" <?php echo $zbp->Config('dmam')->article_prise?'checked="checked"':'';?>/>打开</label>	  
			</p>
			<p>-分享：
			<label><input name="article_share" type="radio" value="0" <?php echo !$zbp->Config('dmam')->article_share?'checked="checked"':'';?>/>关闭</label>
			<label><input name="article_share" type="radio" value="1" <?php echo $zbp->Config('dmam')->article_share==1?'checked="checked"':'';?>/>开启</label>  
			</p>
			<p>-版权风格：
			<label><input name="article_copy" type="radio" value="0" <?php echo !$zbp->Config('dmam')->article_copy?'checked="checked"':'';?>/>不显示</label>
			<label><input name="article_copy" type="radio" value="1" <?php echo $zbp->Config('dmam')->article_copy == 1?'checked="checked"':'';?>/>简约</label>
			<label><input name="article_copy" type="radio" value="2" <?php echo $zbp->Config('dmam')->article_copy == 2?'checked="checked"':'';?>/>多信息</label>						
			</p>			<p>-相关文章：
			<label><input name="article_relevant" type="radio" value="0" <?php echo !$zbp->Config('dmam')->article_relevant?'checked="checked"':'';?>/>不显示</label>
			<label><input name="article_relevant" type="radio" value="1" <?php echo $zbp->Config('dmam')->article_relevant == 1?'checked="checked"':'';?>/>纯文字4条</label>
			<label><input name="article_relevant" type="radio" value="2" <?php echo $zbp->Config('dmam')->article_relevant == 2?'checked="checked"':'';?>/>纯文字8条</label>	
			<label><input name="article_relevant" type="radio" value="3" <?php echo $zbp->Config('dmam')->article_relevant == 3?'checked="checked"':'';?>/>图文4条</label>
			<label><input name="article_relevant" type="radio" value="4" <?php echo $zbp->Config('dmam')->article_relevant == 4?'checked="checked"':'';?>/>图文8条</label>						
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">独立页</p></td>
		<td>
			<p>-单页面导航：
<textarea style="height:45px;line-height:22px;width:100%;" name="page_navi" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->page_navi;?></textarea> 
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>		
<!-- 	 <tr>
		<td><p align="right">侧栏滚动跟随</p></td>
		<td>
		  <p align="left">-首页：<input style="margin-left:10px;width:100px;" type="text" name="side_scroll_index" value="<?php echo $zbp->Config('dmam')->side_scroll_index;?>" /></p>		  <p align="left">-分类：<input style="margin-left:10px;width:100px;" type="text" name="side_scroll_category" value="<?php echo $zbp->Config('dmam')->side_scroll_category;?>" /></p>		  <p align="left">-文章：<input style="margin-left:10px;width:100px;" type="text" name="side_scroll_article" value="<?php echo $zbp->Config('dmam')->side_scroll_article;?>" /></p>		  <p align="left">-页面：<input style="margin-left:10px;width:100px;" type="text" name="side_scroll_page" value="<?php echo $zbp->Config('dmam')->side_scroll_page;?>" /></p>		  <p align="left">-其他：<input style="margin-left:10px;width:100px;" type="text" name="side_scroll_other" value="<?php echo $zbp->Config('dmam')->side_scroll_other;?>" /></p>
		</td>
		<td><p align="left">设置多项可用空格隔开</p></td>
	  </tr> -->

	  <tr>
		<td>
		  <p align="right">侧栏增强</p></td>
		<td>
			<p>-最新评论：
			<label><input name="side_new_comments" type="radio" value="0" <?php echo !$zbp->Config('dmam')->side_new_comments?'checked="checked"':'';?>/>关闭</label>
			<label><input name="side_new_comments" type="radio" value="1" <?php echo $zbp->Config('dmam')->side_new_comments?'checked="checked"':'';?>/>打开</label>		  
			</p>
						<p>-最新文章：
			<label><input name="side_new_previous" type="radio" value="0" <?php echo !$zbp->Config('dmam')->side_new_previous?'checked="checked"':'';?>/>关闭</label>
			<label><input name="side_new_previous" type="radio" value="1" <?php echo $zbp->Config('dmam')->side_new_previous?'checked="checked"':'';?>/>打开</label>		  
			</p>
						<p>-标签云：
			<label><input name="side_new_tags" type="radio" value="0" <?php echo !$zbp->Config('dmam')->side_new_tags?'checked="checked"':'';?>/>关闭</label>
			<label><input name="side_new_tags" type="radio" value="1" <?php echo $zbp->Config('dmam')->side_new_tags?'checked="checked"':'';?>/>打开</label>		  
			</p>
						<p>-归档：
			<label><input name="side_new_archives" type="radio" value="0" <?php echo !$zbp->Config('dmam')->side_new_archives?'checked="checked"':'';?>/>关闭</label>
			<label><input name="side_new_archives" type="radio" value="1" <?php echo $zbp->Config('dmam')->side_new_archives?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  
	  <tr>
		<td>
		  <p align="right">侧栏读者</p></td>
		<td>
			<p>
			<label>统计天数：<input style="width:30px;margin-left:10px;text-align:center;" type="text" name="side_readers_day" value="<?php echo $zbp->Config('dmam')->side_readers_day;?>" /></label>
			<label>显示人数：<input style="width:30px;margin-left:10px;text-align:center;" type="text" name="side_readers_num" value="<?php echo $zbp->Config('dmam')->side_readers_num;?>" /></label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td>
		  <p align="right">读者墙</p></td>
		<td>
			<p>
			<label>统计天数：<input style="width:30px;margin-left:10px;text-align:center;" type="text" name="page_readers_day" value="<?php echo $zbp->Config('dmam')->page_readers_day;?>" /></label>
			<label>显示人数：<input style="width:30px;margin-left:10px;text-align:center;" type="text" name="page_readers_num" value="<?php echo $zbp->Config('dmam')->page_readers_num;?>" /></label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	</table>
<p class="botton_p"><input name="" type="Submit" class="button theme_set_form_button" value="保存"/></p>
</form>
<?php }
if ($act == 'ads'){
?>
<form method="post">
	<table class="themeset-form"  id="set-ads">
	  <tr><th width="20%"><p align="right">配置项目</p></th><th width="50%"><p align="center">内容设定 （主题的广告还未写）</p></th><th width="30%"><p align="left">设置说明</p></th></tr>
	  <tr>
		<td>
		  <p align="right">广告开关</p></td>
		<td>
			<p>PC端：
			<label><input name="ads_pc" type="radio" value="0" <?php echo !$zbp->Config('dmam')->ads_pc?'checked="checked"':'';?>/>关闭</label>
			<label><input name="ads_pc" type="radio" value="1" <?php echo $zbp->Config('dmam')->ads_pc?'checked="checked"':'';?>/>打开</label>		  
			</p>
			<p>移动端：
			<label><input name="ads_m" type="radio" value="0" <?php echo !$zbp->Config('dmam')->ads_m?'checked="checked"':'';?>/>关闭</label>
			<label><input name="ads_m" type="radio" value="1" <?php echo $zbp->Config('dmam')->ads_m?'checked="checked"':'';?>/>打开</label>		  
			</p>
		</td>
		<td>
		  <p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">列表顶部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_top" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_top;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_topm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_topm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">列表内部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_in" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_in;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_inm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_inm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>
	  <tr>
		<td><p align="right">列表底部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_foot" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_foot;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_list_footm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_list_footm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>	  
	  <tr>
		<td><p align="right">文章顶部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_article_top" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_article_top;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_article_topm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_article_topm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>	  
	  <tr>
		<td><p align="right">文章底部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_article_foot" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_article_foot;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_article_footm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_article_footm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>	  
	  <tr>
		<td><p align="right">评论顶部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_comment_top" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_comment_top;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_comment_topm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_comment_topm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>	  
	  <tr>
		<td><p align="right">评论底部</p></td>
		<td>
		  <p align="left">PC端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_comment_foot" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_comment_foot;?></textarea></p>
		  <p align="left">移动端：<textarea style="height:45px;line-height:22px;width:100%;" name="ads_comment_footm" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->ads_comment_footm;?></textarea></p>
		</td>
		<td><p align="left">-</p></td>
	  </tr>	  
	  </table>
<p class="botton_p"><input name="" type="Submit" class="button theme_set_form_button" value="保存"/></p>
</form>
<?php }
if ($act == 'other'){
?>
<form method="post">
	<table class="themeset-form"  id="set-other">
	  <tr><th width="20%"><p align="right">配置项目</p></th><th width="50%"><p align="center">内容设定</p></th><th width="30%"><p align="left">设置说明</p></th></tr>
	    <tr>
		<td>
		  <p align="right">用户公告</p></td>
		<td>
			<p align="left"><textarea style="height:80px;line-height:22px;width:100%;" name="user_notice" type="text" style="width:98%;"><?php echo $zbp->Config('dmam')->user_notice;?></textarea></p>
		</td>
		<td>
		  <p align="right">前台用户中心的公告</p></td>
		  </tr>
	  <tr>
		<td>
		  <p align="right">卸载主题操作</p></td>
		<td>
			<p>删除配置？
			<label><input name="del_config" type="radio" value="0" <?php echo !$zbp->Config('dmam')->del_config?'checked="checked"':'';?>/>否</label>
			<label><input name="del_config" type="radio" value="1" <?php echo $zbp->Config('dmam')->del_config?'checked="checked"':'';?>/>是</label>		  
			</p>
<!--  			<p>删除幻灯片数据？
			<label><input name="del_slidedb" type="radio" value="0" <?php echo !$zbp->Config('dmam')->del_slidedb?'checked="checked"':'';?>/>否</label>
			<label><input name="del_slidedb" type="radio" value="1" <?php echo $zbp->Config('dmam')->del_slidedb?'checked="checked"':'';?>/>是</label>		  
			</p>
			<p>删除幻灯片文件？
			<label><input name="del_slideimg" type="radio" value="0" <?php echo !$zbp->Config('dmam')->del_slideimg?'checked="checked"':'';?>/>否</label>
			<label><input name="del_slideimg" type="radio" value="1" <?php echo $zbp->Config('dmam')->del_slideimg?'checked="checked"':'';?>/>是</label>		  
			</p>
			<p>重置模块？
			<label><input name="rb_moudle" type="radio" value="0" <?php echo !$zbp->Config('dmam')->rb_moudle?'checked="checked"':'';?>/>否</label>
			<label><input name="rb_moudle" type="radio" value="1" <?php echo $zbp->Config('dmam')->rb_moudle?'checked="checked"':'';?>/>是</label>		  
			</p>
			<p>删除模块？
			<label><input name="del_moudle" type="radio" value="0" <?php echo !$zbp->Config('dmam')->del_moudle?'checked="checked"':'';?>/>否</label>
			<label><input name="del_moudle" type="radio" value="1" <?php echo $zbp->Config('dmam')->del_moudle?'checked="checked"':'';?>/>是</label>		  
			</p>  -->
		</td>
		<td>
		  <p align="left">-</p></td>
	 </tr>
	  <tr>
		<td>
		  <p align="right">其他操作</p></td>
		<td>
			<p><a href="save.php?type=flashdel">删除幻灯片数据库</a></p>
			<p><a href="save.php?type=readers_cache">缓存读者墙</a></p>
			<p><a href="save.php?type=archive_cache">缓存归档</a></p>
			<p><a href="save.php?type=create_module">重建模块</a></p>
		</td>
		<td>
		  <p align="left">-</p></td>
	 </tr>
	</table>
<p class="botton_p"><input name="" type="Submit" class="button theme_set_form_button" value="保存"/></p>
</form>

<?php }
if ($act == 'slide'){
		$show_slideform = '';
		$show_slideform .= '<form id="upslide" action="save.php?type=flash" method="post">
                <table width="95%" style="padding:0;margin:10px 0 0;" cellspacing="0" cellpadding="0" class="tableBorder">
				
                <tr>
                    <th scope="col" width="3%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="25%">信息</th>
                    <th scope="col" >图片 （blog推荐 820*200 cms推荐1200*350）</th>
                    <th scope="col" width="15%">选项</th>
                    <th scope="col" width="10%">操作</th>
                </tr>';
        $show_slideform .= '<tr>';
        $show_slideform .= '<td align="center">0</td>';
        $show_slideform .= '<td><input style="width:95%;" type="text" class="sedit" name="title" value="图片名称ALT"><br/><input type="text" class="sedit" name="url" style="width:95%;" value="http://"></td>';
		if ($zbp->CheckPlugin('UEditor')) {
			$show_slideform .= '<td><span class="slideimg"><input  type="hidden"  id="url_updatapic1" name="img"  value="" /><img src="" width="100%" border="0" alt="" id="pic_updatapic1"><input type="button"  id="updatapic1"  class="updatapic" value="更换图片" /></span></td>';
		}else{
			$show_slideform .= '<td><input type="text" style="width:95%" class="sedit" name="img" value=""> <a href="'.$zbp->host.'zb_system/admin/?act=UploadMng" target="_blank">去上传</a></td>';
		}
        $show_slideform .= '<td><p>_blank ? <input type="text" class="checkbox" name="Code" value="1" /></p><p>排序 ? <input type="number" min="1" max="60" name="Order" value="9" style="width:40px"></p><p>显示 ? <input type="text" class="checkbox" name="IsUsed" value="1" /></p></td>';
        $show_slideform .= '<td><input type="hidden" name="editid" value="">
                        <input name="add" type="submit" value="增加"/></td>';
        $show_slideform .= '</tr>';
        $show_slideform .= '</form>';
        $where = array(array('=','slide_Type','0'));
        $order = array('slide_IsUsed'=>'DESC','slide_Order'=>'ASC');
        $sql= $zbp->db->sql->Select($dmam_Slide_Table,'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($dmam_Slide_Table,$dmam_Slide_DataInfo,$sql);
        $i =1;
        foreach ($array as $key => $reg) {
			$ii = $i+1;
            $show_slideform .= '<form id="upslide" action="save.php?type=flash" method="post" name="flash">';
            $show_slideform .= '<tr>';
            $show_slideform .= '<td align="center">'.$i.'</td>';
            $show_slideform .= '<td><input type="text" style="width:95%;" name="title" value="'.$reg->Title.'" ><br/><input type="text" name="url" value="'.$reg->Url.'" style="width:95%;"></td>';
			if ($zbp->CheckPlugin('UEditor')) {
            $show_slideform .= '<td><span class="slideimg"><img src="'.$reg->Img.'" width="98%" border="0" id="pic_updatapic'.$ii.'"><input type="hidden" id="url_updatapic'.$ii.'" name="img"  value="'.$reg->Img.'" /><input type="button" id="updatapic'.$ii.'" class="updatapic" value="更换图片" /></span></td>';
			}else{
			$show_slideform .= '<td><img src="'.$reg->Img.'" height="80" border="0"><input type="text" style="width:95%" class="sedit" name="img" value="'.$reg->Img.'" ></td>';
			}
            $show_slideform .= '<td><p>_blank ? <input type="text" class="checkbox" name="Code" value="'.$reg->Code.'" /></p><p>排序 ? <input type="number" min="1" max="99" class="sedit" name="Order" value="'.$reg->Order.'" style="width:40px"></p><p>显示 ? <input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></p></td>';
            $show_slideform .= '<td nowrap="nowrap">
                        <input type="hidden" name="editid" value="'.$reg->ID.'">
                        <input name="edit" type="submit" value="修改"/><br/>
                        <input name="del" type="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=flashdel&id='.$reg->ID.'\'}"/>
                    </td>';
            $show_slideform .= '</tr>';
            $show_slideform .= '</form>';
            $i++;
        }
        $show_slideform .='</table>';
		echo $show_slideform;
	 } 

if ($zbp->CheckPlugin('UEditor')) {
?>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.config.php"></script>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.all.min.js"></script>
<?php
}
?>
<textarea name="ueimg" id="ueimg" style="display:none"></textarea>
	</div>
</div>
<script type="text/javascript">ActiveTopMenu("topmenu_dmam");</script>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/theme/dmam/screenshot.png'; ?>");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>