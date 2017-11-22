<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('yt_uc')) {$zbp->ShowError(48);die();}

if (isset($_GET['act'])){$act = $_GET['act'];}else{$act = 'base';}

$blogtitle='用户中心模版配置';
  global $zbp;
  $yt_uc_templates = array();
  $yt_uc_theme = 0;
  $yt_uc_index = 0;
  $yt_uc_templatesname=array("头部","用户认证","发布投稿", "文章列表", "第三方登录", "积分购买", "修改密码", "评论列表", "消费日志", "文章收藏", "底部", "积分充值", "用户登录", "用户名修改", "分页条", "交易列表", "用户注册", "重置密码", "找回密码","VIP充值", "用户中心");
  $yt_uc_templatesLabel='';
  foreach ($GLOBALS['hooks']['Filter_Plugin_YtUser_Dmuc'] as $fpname => &$fpsignal) {
    $fpname($yt_uc_templates,$yt_uc_theme);
  }
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
require './function.php';

function yt_uc_SubMenu($id){
    $arySubMenu = array(
        0 => array('插件说明', 'guide', 'left', false),
		1 => array('插件设置', 'base', 'left', false),
        2 => array('模版编辑', 'tpl', 'left', false),
    );
    foreach($arySubMenu as $k => $v){
        echo '<a href="?act='.$v[1].'"><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
    }
}

?>
<style type="text/css">
.fixedPanel {
	position: fixed;
	height: 32px;
	top: 0px;
	width: 80%;
	z-index: 8888;
	opacity: 0.8;
	text-align: center;
}
.hideLayer {
	margin: 0px;
	padding: 0px;
	position: fixed;
	top: 0px;
	bottom: 0px;
	left: 0px;
	right: 0px;
	z-index: 9990;
	background-color: rgba(0, 0, 0, 0.298039);
	display: none;
}
.messageBox {
	position: absolute;
	top: 40%;
	left: 50%;
	transform: translate(-50%, -50%);
	-webkit-transform: translate(-50%, -50%);
	height: 100px;
	width: 200px;
	background: white;
	border: 1px black solid;
}
.content {
	text-align: center;
	margin-top: 35px;
	font-size: 20px;
}
</style>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php yt_uc_SubMenu($act);?>
		<a href="javascript:statistic('?act=misc&amp;type=statistic');" id="statistic">[清空缓存并重新编译模板]</a> <img id="statloading" style="display:none" src="<?php echo $zbp->host.'zb_system';?>/image/admin/loading.gif" alt=""/>
    </div>
  <div id="divMain2">

  	<?php
	if ($act == 'base'){
		?>
<form method="post" action="main.php?act=basesave">  
<input id="tplid" name="tplid" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th  class="td30"><p align='center'><b>项目名称</b><br><span class='note'></span></p></th>
	<th  class="td30"></th>
</tr>
<tr>
	<td  class="td30"><p align='left'><b>编辑器CSS样式</b></p></td>
    <td  class="td30"><p align="left"><select style="width: 20%; height: 32px; padding: 0" id="CssSelect" name="tplCss">
  	<option value="dreamweaver"<?php if($zbp->Config('yt_uc')->tpl_Css == 'dreamweaver'){echo ' selected';}?>>Dreamweaver</option>
  	<option value="github"<?php if($zbp->Config('yt_uc')->tpl_Css == 'github'){echo ' selected';}?>>GitHub</option>
  	<option value="monokai"<?php if($zbp->Config('yt_uc')->tpl_Css == 'monokai'){echo ' selected';}?>>Monokai</option>
  	<option value="tomorrow"<?php if($zbp->Config('yt_uc')->tpl_Css == 'tomorrow'){echo ' selected';}?>>Tomorrow</option>
  	<option value="tomorrow_night"<?php if($zbp->Config('yt_uc')->tpl_Css == 'tomorrow_night'){echo ' selected';}?>>Tomorrow_Night</option>
  	<option value="xcode"<?php if($zbp->Config('yt_uc')->tpl_Css == 'xcode'){echo ' selected';}?>>XCode</option>
  </select></p></td>
</tr>
<tr>
	<td  class="td30"><p align='left'><b>模版启用方式</b></p></td>
    <td  class="td30"><p align="left"><input type="radio" name="tplaction"  id="tplaction" value="0"<?php if($zbp->Config('yt_uc')->tpl_action == 0){echo ' checked';}?>>仅修改，暂时不启用</p><p align="left"><input type="radio" name="tplaction"  id="tplaction" value="1"<?php if($zbp->Config('yt_uc')->tpl_action == 1){echo ' checked';}?>>已经完成修改，全部启用</p></td>
</tr>	
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
  	<?php
	}

	if ($act == 'tpl'){

		?>
<form method="post" action="main.php?act=edit"  id="formSubmit">  
<input id="tplid" name="tplid" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th><p align='center'><b>模版编辑</b><br><span class='note'></span></p></th>
	<th><p align='center'><b>常用标签</b><br><span class='note'></span></p></th>
<tr>
    <td class="td30">					
	<select style="width: 60%; height: 32px; padding: 0;" id="fileSelect" name="fileSelect">
  	<option value="" disabled="disabled" selected="selected">请选择...</option>
  <?php
$options = scan_plugin_Dir();
foreach ($options as $id => $value) {
	echo '<option value="' . $value . '">' . $value . '</option>';
}
?>
  </select><input class="button" type="button" value="保存" id="saveButton" style="margin: 0; height: 32px;">
	</td>
    <td class="td30">	</td>
</tr>
<tr>
<td>
<p><div id="editor"></div></p>
<div class="hideLayer">
	<div class="messageBox">
		<div class="content">
			<img src="../../../zb_system/image/admin/loading.gif" style="margin-right: 10px"/>操作进行中..
		</div>
	</div>
</div>
</td>
<td>

</td>
</tr>
</tr>
		<?php
  if( is_array($yt_uc_templates) && count($yt_uc_templates) && $yt_uc_theme ){
    foreach($yt_uc_templates as $vo){
        $fullname=$zbp->usersdir .'plugin/'.$yt_uc_theme.'/template/'.$vo.'.php';
		?>
<tr>
	<td><p align='left'><b><?php echo $yt_uc_templatesname[$yt_uc_index];?></b></p></td>
    <td><p align="left"><b><?php echo $yt_uc_theme.'/template/'.$vo.'.php';?></b></p></td>
	<td><p align="left"><input type="submit" name="" value="配置模版" onclick="tplgo(<?php echo $yt_uc_index;?>);"></td>
</tr>	
	<?php
		$yt_uc_index = $yt_uc_index +1 ;
    }
  }
	?>
</table>
<script src="ace/ace.js" type="text/javascript"></script>
<script src="ace/ext-emmet.js" type="text/javascript"></script>
<script src="ace/ext-beautify.js" type="text/javascript"></script>
<script src="ace/emmet.js"></script>
<script>
$(function() {

	var fileChangeState = false;
	var defaultTheme = localStorage.themeEditorTheme || '<?php echo $zbp->Config('yt_uc')->tpl_Css;?>';
	var emmet = require('ace/ext/emmet');
	var beautify = require('ace/ext/beautify');
	var editor = ace.edit("editor");
	var editorSession = editor.getSession();
	var saveEditor = function() {
		$(".hideLayer").show();
		$.ajax({
			url: 'ajax.php?action=save&filename=' + encodeURI($("#fileSelect").val()),
			data: {
				content: editorSession.getValue()
			},
			type: 'POST',
			dataType: 'json'
		}).done(function(data) {
			fileChangeState = false;
			document.title = document.title.replace("(*) ", "");
		}).always(function() {
			$(".hideLayer").hide();
		});
	};

	editor.setTheme("ace/theme/" + defaultTheme);
	editor.setAutoScrollEditorIntoView(true);
	//editor.setOption("minLines", parseInt(screen.height / 20));
	editor.setOption("maxLines", 10000000);
	editor.setOption("enableEmmet", true);
	editor.commands.addCommands(beautify.commands);
	editor.commands.addCommand({
		name: "showKeyboardShortcuts",
		bindKey: {win: "Ctrl-Alt-h", mac: "Command-Alt-h"},
		exec: function(editor) {
			ace.config.loadModule("ace/ext/keybinding_menu", function(module) {
				module.init(editor);
				editor.showKeyboardShortcuts()
			})
		}
	});
	editor.commands.addCommand({
		name: "Save",
		bindKey: {win: "Ctrl-S", mac: "Command-S"},
		exec: function(editor) {
			saveEditor();
		}
	});
	editorSession.on('change', function() {
		if (!fileChangeState) {
			fileChangeState = true;
			document.title = "(*) " + document.title;
		}
	});
	$("#fileSelect").change(function(e) {
		if (!fileChangeState || confirm('你当前编辑的文件还没保存，确定要切换文件吗？')) {
			$(".hideLayer").show();
			$.ajax({
				url: 'ajax.php?action=load&filename=' + encodeURI($(this).val()),
				type: 'GET',
				dataType: 'json'
			}).done(function(data) {
				editorSession.setMode('ace/mode/' + data.aceMode);
				editorSession.setValue(data.content);
				fileChangeState = false;
				document.title = "Editing " + $("#fileSelect").val();
			}).always(function() {
				$(".hideLayer").hide();
			});
		}
	});
	$("#saveButton").click(saveEditor);
	window.onbeforeunload = function() {
		if (fileChangeState) {
			return '你当前编辑的文件还没保存，确定要退出吗？'
		} else {
			return;
		}
	}
});
</script></form>
 <script language="javascript">
             function tplgo(tid){
          document.getElementById("tplid").value = tid;
                     return true;
             }
     </script>
  	<?php
	}
	if ($act == 'guide'){
	?>
<form method="post" action="main.php?act=base">  
<input id="tplid" name="tplid" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th><p align='center'><b>页面</b><br><span class='note'></span></p></th>
	<th><p align='center'>插件信息</th>
<tr>
	<td class="td30"><p align='center'><b>说明</b></p></td>
	<td>这是个YtUser的用户中心插件模版的自定义编辑插件</td>
</tr>
</tr>
</table>
</form>
  	<?php
	}
	?>
	<?php
	if ($act == 'edit'){	
		if (isset($_POST['tplid'])){
	$tplid = $_POST['tplid'];
	$yt_uc_file_path = $zbp->usersdir .'plugin/' .$yt_uc_theme.'/template/'.$yt_uc_templates[$tplid].'.php';
   if(file_exists($yt_uc_file_path)){
   $yt_uc_str = file_get_contents($yt_uc_file_path);//将整个文件内容读入到一个字符串中
   }
	?>
<form enctype="multipart/form-data" method="post" action="main.php?act=editsave">
<input id="tplname" name="tplname" type="hidden" value="<?php echo $yt_uc_templatesname[$tplid];?>" />
<input id="tplfile" name="tplfile" type="hidden" value="<?php echo $yt_uc_file_path;?>" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th><p align='left'><b>模版:<?php echo $yt_uc_templatesname[$tplid];?></b><br><span class='note'>模版文件:<?php echo $yt_uc_theme.'/template/'.$yt_uc_templates[$tplid].'.php';?></span></p></th>
	<th>标签列表</th>
</tr>
<tr>
    <td class="td30">					
	<textarea name="tplhtml" rows="25" cols="110"><?php echo $yt_uc_str;?></textarea>
	</td>
    <td class="td30">					
	<?php echo $yt_uc_templatesLabel;?>
	</td>
</tr>
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
	<?php
	}else{
?>
<table border="1" class="tableFull tableBorder">
<tr>
	<th><p align='left'><b>提示：</b><br><span class='note'>请从 模版列表 页进入本编辑页面</span></p></th>
</tr>
</table>
<?php
	}
	}
	?>
<?php
if ($act == 'basesave'){
if (isset($_POST['tplCss']) && isset($_POST['tplaction'])){
$zbp->Config('yt_uc')->tpl_Css = $_POST['tplCss'];
$zbp->Config('yt_uc')->tpl_action = $_POST['tplaction'];
$zbp->SaveConfig('yt_uc');
$zbp->SetHint('good','参数保存成功');
Redirect('./main.php?act=base');
}else{
$zbp->SetHint('good','非法操作');
Redirect('./main.php?act=base');
}
}
?>

	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/yt_uc/logo.png';?>");</script>	
  </div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>