<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('yt_uc')) {$zbp->ShowError(48);die();}

if (isset($_GET['act'])){$act = $_GET['act'];}else{$act = 'base';}

$blogtitle='YtUser用户中心模版编辑';
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
<STYLE type=text/css>
BODY { FONT-SIZE: 14px; FONT-FAMILY: "宋体" }
OL LI { MARGIN: 8px }
#con { FONT-SIZE: 12px; MARGIN: 0px auto; WIDTH: 100% }
#tags { PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; MARGIN: 0px 0px 0px 10px; WIDTH: 400px; PADDING-TOP: 0px; HEIGHT: 23px }
#tags LI { BACKGROUND: url(<?php echo $zbp->host.'zb_users/plugin/yt_uc/';?>/images/tagleft.gif) no-repeat left bottom; FLOAT: left; MARGIN-RIGHT: 1px; LIST-STYLE-TYPE: none; HEIGHT: 23px }
#tags LI A { PADDING-RIGHT: 10px; PADDING-LEFT: 10px; BACKGROUND: url(<?php echo $zbp->host.'zb_users/plugin/yt_uc/';?>images/tagright.gif) no-repeat right bottom; FLOAT: left; PADDING-BOTTOM: 0px; COLOR: #999; LINE-HEIGHT: 23px; PADDING-TOP: 0px; HEIGHT: 23px; TEXT-DECORATION: none }
#tags LI.emptyTag { BACKGROUND: none transparent scroll repeat 0% 0%; WIDTH: 4px }
#tags LI.selectTag { BACKGROUND-POSITION: left top; MARGIN-BOTTOM: -2px; POSITION: relative; HEIGHT: 25px }
#tags LI.selectTag A { BACKGROUND-POSITION: right top; COLOR: #000; LINE-HEIGHT: 25px; HEIGHT: 25px }
#tagContent { BORDER-RIGHT: #aecbd4 1px solid; PADDING-RIGHT: 1px; BORDER-TOP: #aecbd4 1px solid; PADDING-LEFT: 1px; PADDING-BOTTOM: 1px; BORDER-LEFT: #aecbd4 1px solid; PADDING-TOP: 1px; BORDER-BOTTOM: #aecbd4 1px solid; BACKGROUND-COLOR: #fff }
.tagContent { PADDING-RIGHT: 10px; DISPLAY: none; PADDING-LEFT: 10px; BACKGROUND: url(<?php echo $zbp->host.'zb_users/plugin/yt_uc/';?>images/bg.gif) repeat-x; PADDING-BOTTOM: 10px; WIDTH:100%; COLOR: #474747; PADDING-TOP: 10px; HEIGHT: 250px }
#tagContent DIV.selectTag { DISPLAY: block }
</STYLE>

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
	<td  class="td30"><p align='center'><b>编辑器代码的样式</b></p></td>
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
	<td  class="td30"><p align='center'><b>启用用户中心模版</b></p></td>
    <td  class="td30"><p align="left"><input type="radio" name="tplaction"  id="tplaction" value="0"<?php if($zbp->Config('yt_uc')->tpl_action == 0){echo ' checked';}?>>  仅修改模版，暂时不启用</p><p align="left"><input type="radio" name="tplaction"  id="tplaction" value="1"<?php if($zbp->Config('yt_uc')->tpl_action == 1){echo ' checked';}?>>  启用新的用户中心模版</p></td>
</tr>	
</table>
	  <hr/>
	  <p  align='center'>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
</form>
  	<?php
	}

	if ($act == 'tpl'){
		?>
<form method="post" action="main.php?act=edit"  id="formSubmit">  
<input id="tplid" name="tplid" type="hidden" value="" />
<input type="hidden" name="token" id="token" value="<?php echo $zbp->GetToken();?>" />
<table border="1" class="tableFull tableBorder">
<tr>
	<th><p align='center'><b>YtUser用户中心模版编辑</b><br><span class='note'></span></p></th>
<tr>
    <td class="td30"  valign="top"><input class="button" type="button" value="保存模版" id="saveButton" style="margin: 0; height: 32px;" style="display:none">					
	<select style="width: 60%; height: 32px; padding: 0;" id="fileSelect" name="fileSelect">
  	<option value="" disabled="disabled" selected="selected">请选择您需要编辑的模版文件...</option>
  <?php
$options = scan_plugin_Dir();
foreach ($options as $id => $value) {
	echo '<option value="' . $value . '">' . $value . '</option>';
}
?>
  </select>
	</td>
</tr>
<tr>
<td  valign="top">
<p><div id="editor"></div></p>
</td>
</tr>
</table>
<script src="ace/ace.js" type="text/javascript"></script>
<script src="ace/ext-emmet.js" type="text/javascript"></script>
<script src="ace/ext-beautify.js" type="text/javascript"></script>
<script src="ace/emmet.js"></script>
<script src="<?php echo $zbp->host . 'zb_users/plugin/YtUser/js'?>/layui/layui.all.js"></script>
<script>
$(function() {

	var fileChangeState = false;
	var defaultTheme = localStorage.themeEditorTheme || '<?php echo $zbp->Config('yt_uc')->tpl_Css;?>';
	var emmet = require('ace/ext/emmet');
	var beautify = require('ace/ext/beautify');
	var editor = ace.edit("editor");
	var editorSession = editor.getSession();
	$("#saveButton").hide();
	var saveEditor = function() {
		$(".hideLayer").show();
		$.ajax({
			url: 'ajax.php?action=save&token=' + $("#token").val() + '&filename=' + encodeURI($("#fileSelect").val()),
			data: {
				content: editorSession.getValue()
			},
			type: 'POST',
			dataType: 'json'
		}).done(function(data) {
			fileChangeState = false;
			document.title = document.title.replace("(*) ", "");
			layer.msg('模版文件保存完毕!');
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
			$("#saveButton").show();
			document.title = "(*) " + document.title;
		}
	});
	$("#fileSelect").change(function(e) {
		if (!fileChangeState || confirm('你当前编辑的文件还没保存，确定要切换文件吗？')) {
			$(".hideLayer").show();
			$.ajax({
				url: 'ajax.php?action=load&token=' + $("#token").val() + '&filename=' + encodeURI($(this).val()),
				type: 'GET',
				dataType: 'json'
			}).done(function(data) {
				editorSession.setMode('ace/mode/' + data.aceMode);
				editorSession.setValue(data.content);
				fileChangeState = false;
				document.title = "Editing " + $("#fileSelect").val();
				layer.msg('模版文件加载完毕!');
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
</script>
</form> 
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
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Ux_Plus/logo.png';?>");</script>	
  </div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>