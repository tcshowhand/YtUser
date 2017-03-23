<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('XF_Big_Red')) {$zbp->ShowError(48);die();}
$blogtitle='主题配置';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(isset($_POST['keywords'])){
  $zbp->Config('XF_Big_Red')->keywords = $_POST['keywords'];
  $zbp->Config('XF_Big_Red')->description = $_POST['description'];
  $zbp->Config('XF_Big_Red')->recommend = $_POST['recommend'];
  $zbp->Config('XF_Big_Red')->seo = $_POST['seo'];
  $zbp->Config('XF_Big_Red')->post_category = $_POST['post_category'];
  $zbp->Config('XF_Big_Red')->page_subname = $_POST['page_subname'];
  $zbp->SaveConfig('XF_Big_Red');
  $zbp->ShowHint('good');
}
?>

<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
		<div class="SubMenu">
	<?php XF_Big_Red_SubMenu($act);?>
     <a href="http://www.songhaifeng.com/zblogphp-free-theme/96.html" target="_blank"><span class="m-right">技术支持</span></a>
    </div>
		<div id="divMain2">
		<?php if ($act == 'config') { ?>
			<form enctype="multipart/form-data" method="post" action="save.php?type=logo">  
				<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
					<tr>
						<td width="15%"><label for="logo.png"><p align="center">上传Logo（356*100）</p></label></td>
						<td width="50%"><p align="center"><input name="logo.png" type="file"/></p></td>
						<td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
					</tr>
				</table>
			</form>
			<form id="form1" name="form1" method="post">
					<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
						<tr>
							<th width="15%"><p align="center">配置名称</p></th>
							<th width="50%"><p align="center">配置内容</p></th>
							<th width="5%"><p align="center">其它配置</p></th>
							<th width="25%"><p align="center">配置说明</p></th>
						</tr>
						<tr>
							<td><label for="keywords"><p align="center">网站关键词</p></label></td>
							<td><p align="left"><textarea name="keywords" type="text" id="keywords" style="width:98%;"><?php echo $zbp->Config('XF_Big_Red')->keywords;?></textarea></p></td>
							<td><p align="left"></p></td>
							<td><p align="left">网站首页关键词</p></td>
						</tr>
						<tr>
							<td><label for="description"><p align="center">网站描述</p></label></td>
							<td><p align="left"><textarea name="description" type="text" id="description" style="width:98%;"><?php echo $zbp->Config('XF_Big_Red')->description;?></textarea></p></td>
							<td><p align="left"></p></td>
							<td><p align="left">网站首页描述</p></td>
						</tr>
						<tr>
							<td><label for="recommend"><p align="center">网站一句话</p></label></td>
							<td><p align="left"><textarea name="recommend" type="text" id="recommend" style="width:98%;"><?php echo $zbp->Config('XF_Big_Red')->recommend;?></textarea></p></td>
							<td><p align="left"></p></td>
							<td><p align="left">位于Logo下方。</p></td>
						</tr>
						<tr>
							<td><label for="seo"><p align="center">SEO</p></label></td>
							<td>
								<p align="center">
									<select name="seo" id="seo">
										<option value="a" <?php if($zbp->Config('XF_Big_Red')->seo == 'a') echo 'selected'?>>打开</option>
										<option value="b" <?php if($zbp->Config('XF_Big_Red')->seo == 'b') echo 'selected'?>>关闭</option>
									</select>
								</p>
							</td>
							<td>
								
							</td>
							<td><p align="left">兼容SEO工具大全</p></td>
						</tr>
						<tr>
							<td><label for="post_category"><p align="center">文章是否显示分类名</p></label></td>
							<td>
								<p align="center">
									<select name="post_category" id="post_category">
										<option value="a" <?php if($zbp->Config('XF_Big_Red')->post_category == 'a') echo 'selected'?>>打开</option>
										<option value="b" <?php if($zbp->Config('XF_Big_Red')->post_category == 'b') echo 'selected'?>>关闭</option>
									</select>
								</p>
							</td>
							<td>
								
							</td>
							<td><p align="left">只显示当前分类，不显示父分类。<br/>兼容SEO工具大全打开时此项无效。</p></td>
						</tr>
						<tr>
							<td><label for="page_subname"><p align="center">单页是否显示网站副标题</p></label></td>
							<td>
								<p align="center">
									<select name="page_subname" id="page_subname">
										<option value="a" <?php if($zbp->Config('XF_Big_Red')->page_subname == 'a') echo 'selected'?>>打开</option>
										<option value="b" <?php if($zbp->Config('XF_Big_Red')->page_subname == 'b') echo 'selected'?>>关闭</option>
									</select>
								</p>
							</td>
							<td>
								
							</td>
							<td><p align="left">兼容SEO工具大全打开时此项无效。</p></td>
						</tr>
					</table>
					<br/>
					<input name="" type="Submit" class="button" value="保存"/>
			</form>
    <?php } if ($act == 'explain') { ?>
			<form id="form3" name="form3" method="post">
				<table width="100%" style="padding:0;margin-top:5px;" cellspacing="0" cellpadding="0" class="tableBorder">
					<tbody>
						<tr class="color1">
							<th width="100%"><p>承接基于ZblogPhp的仿站、主题定制、修改和dedecms程序的仿站、修改等业务，欢迎联系小锋QQ：284204003</p></th>
						</tr>
					</tbody>
				</table>
				<table width="100%" style="padding:0;margin-top:5px;" cellspacing="0" cellpadding="0" class="tableBorder">
					<tbody>
						<tr class="color1">
							<th width="100%"><p>【使用说明】</p></th>
						</tr>
						<tr class="color3">
							<td>
								<p>1、首页、分类页、搜索页使用侧栏1；文章页使用侧栏2；在模块管理-右边，对应的把模块拖进去即可。</p>
								<p>2、支持二级导航，具体请看应用中心主题介绍。</p>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%" style="padding:0;margin-top:5px;" cellspacing="0" cellpadding="0" class="tableBorder">
					<tbody>
						<tr class="color1">
							<th width="100%"><p>【安装须知】</p></th>
						</tr>
						<tr class="color3">
							<td>
								<p>感谢喜欢，感谢使用！</p>
								<p>有问题可以在我博客或者应用中心主题页反馈，我会找时间修复的。谢谢。</p>
								<p>如果觉得主题哪方面不合心意，可自由修改。或者找我付费解决。QQ：284204003</p>
								<p>Zblog技术交流群：4243058</p>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
    <?php } ?>
		</div>
</div>
<script type="text/javascript">
ActiveTopMenu("topmenu_Lipop");
</script> 
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
