<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('mizhe')) {$zbp->ShowError(48);die();}
$blogtitle='拓源米折主题配置';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


if(isset($_POST['PostLEFTNAV'])){
  $zbp->Config('mizhe')->PostLEFTNAV = $_POST['PostLEFTNAV'];
  $zbp->Config('mizhe')->PostRIGHTNAV = $_POST['PostRIGHTNAV'];
  $zbp->Config('mizhe')->PostBLOG = $_POST['PostBLOG'];
  $zbp->Config('mizhe')->PostINDEXADS = $_POST['PostINDEXADS'];
  $zbp->Config('mizhe')->PostCATALOGADS = $_POST['PostCATALOGADS'];
  $zbp->Config('mizhe')->PostSINGLEADS = $_POST['PostSINGLEADS'];
  $zbp->Config('mizhe')->PostSHARE = $_POST['PostSHARE'];
  $zbp->Config('mizhe')->PostFLOATNAV = $_POST['PostFLOATNAV'];
  $zbp->Config('mizhe')->PostFOOTSIGN = $_POST['PostFOOTSIGN'];
  $zbp->SaveConfig('mizhe');
  $zbp->ShowHint('good');
}
?>

<style>
input.color{padding:0}
input.sedit{ width:93%;}
table input{margin:0.25em 0;}
table input.text{padding: 2px 5px;}
table .button{padding: 2px 12px 5px 12px; margin: 0.25em 0;}
.tc{border: solid 2px #E1E1E1;width: 50px;height: 23px;float: left;margin: 0.25em;cursor: pointer}
.tc:hover,.active{border: 2px solid #2694E8;}
.upinfo{position: relative;left: 3px;top: -19px;color: white;background: #5EAAE4;width: 190px;height: 23px;display: inline-block;text-align: center;opacity: 0.8;filter: alpha(opacity=80);}
.imageshow{margin:0.25em 0;}.imageshow img{margin:0 10px;margin-bottom:-10px;}
.divHeader { background-position:0 11px !important; }
</style>


<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php mizhe_SubMenu($act);?>
		<a href="http://www.toyean.com/post/mizhe.html" target="_blank"><span class="m-left" style="color:#F00">帮助</span></a>
    </div>
	<div id="divMain2">
	<?php
	if ($act == 'base'){
	?>
<form enctype="multipart/form-data" method="post" action="save.php?type=base">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <td width="15%"><label for="logo.png"><p align="center">上传LOGO</p></label></td>
    <td width="50%"><p align="center"><input name="logo.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
    </form>
<form enctype="multipart/form-data" method="post" action="save.php?type=bg">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <td width="15%"><label for="bg.png"><p align="center">上传网站背景图片</p></label></td>
    <td width="50%"><p align="center"><input name="bg.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
    </form>
  <form id="form1" name="form1" method="post">
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="15%"><p align="center">配置名称</p></th>
    <th width="50%"><p align="center">配置内容</p></th>
  <th width="25%"><p align="center">配置说明</p></th>
  </tr>
  <tr>
    <td><label for="PostLEFTNAV"><p align="center">网站顶部左侧导航</p></label></td>
    <td><p align="left"><textarea name="PostLEFTNAV" type="text" id="PostLEFTNAV" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostLEFTNAV;?></textarea></p></td>
  <td><p align="left">请编辑网站顶部左侧导航</p></td>
  </tr>
  <tr>
    <td><label for="PostRIGHTNAV"><p align="center">网站顶部右侧导航</p></label></td>
    <td><p align="left"><textarea name="PostRIGHTNAV" type="text" id="PostRIGHTNAV" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostRIGHTNAV;?></textarea></p></td>
  <td><p align="left">请编辑网站顶部右侧导航</p></td>
  </tr>
    <tr>
    <td><label for="PostBLOG"><p align="center">微博设置</p></label></td>
    <td><p align="left"><textarea name="PostBLOG" type="text" id="PostBLOG" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostBLOG;?></textarea></p></td>
  <td><p align="left">请输入微博代码</p></td>
  </tr>
  <tr>
    <td><label for="PostINDEXADS"><p align="center">首页广告设置</p></label></td>
    <td><p align="left"><textarea name="PostINDEXADS" type="text" id="PostINDEXADS" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostINDEXADS;?></textarea></p></td>
  <td><p align="left">请输入首页广告代码</p></td>
  </tr>
  <tr>
    <td><label for="PostCATALOGADS"><p align="center">分类列表页广告设置</p></label></td>
    <td><p align="left"><textarea name="PostCATALOGADS" type="text" id="PostCATALOGADS" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostCATALOGADS;?></textarea></p></td>
  <td><p align="left">请输入分类列表页广告代码</p></td>
  </tr>
  <tr>
    <td><label for="PostSINGLEADS"><p align="center">文章及页面广告设置</p></label></td>
    <td><p align="left"><textarea name="PostSINGLEADS" type="text" id="PostSINGLEADS" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostSINGLEADS;?></textarea></p></td>
  <td><p align="left">请输入文章及页面广告代码</p></td>
  </tr>
  <tr>
    <td><label for="PostSHARE"><p align="center">分享代码设置</p></label></td>
    <td><p align="left"><textarea name="PostSHARE" type="text" id="PostSHARE" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostSHARE;?></textarea></p></td>
  <td><p align="left">请输入分享代码</p></td>
  </tr>
  <tr>
    <td><label for="PostFLOATNAV"><p align="center">分类页浮动侧栏菜单</p></label></td>
    <td><p align="left"><textarea name="PostFLOATNAV" type="text" id="PostFLOATNAV" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostFLOATNAV;?></textarea></p></td>
  <td><p align="left">请输入分类页浮动侧栏菜单（仅限catalog）</p></td>
  </tr>
    <tr>
    <td><label for="PostFOOTSIGN"><p align="center">首页底部认证图标代码</p></label></td>
    <td><p align="left"><textarea name="PostFOOTSIGN" type="text" id="PostFOOTSIGN" style="width:98%;"><?php echo $zbp->Config('mizhe')->PostFOOTSIGN;?></textarea></p></td>
  <td><p align="left">请输入底部认证图标代码（仅首页显示）</p></td>
  </tr>
  <tr>
  	<td colspan="3">
  		<input name="" type="Submit" class="button" value="保存"/>
  	</td>
  </tr>
</table>
    </form>
	<?php
	}
	if ($act == 'flash'){
		$str = '<form action="save.php?type=flash" method="post">
				<table width="100%" border="1" class="tableBorder">
				<tr>
					<th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
					<th scope="col" width="25%">标题</th>
					<th scope="col" width="25%">图片</th>
					<th scope="col" width="25%">链接</th>
					<th scope="col" width="5%">排序</th>
					<th scope="col" width="5%">显示</th>
					<th scope="col" width="10%">操作</th>
				</tr>';
		$str .= '<tr>';
		$str .= '<td align="center">0</td>';
		$str .= '<td><input type="text" class="sedit" name="title" value=""></td>';
		$str .= '<td><input type="text" class="sedit" name="img" value=""></td>';
		$str .= '<td><input type="text" class="sedit" name="url" value=""></td>';
		$str .= '<td><input type="text" name="order" value="99" style="width:40px"></td>';
		$str .= '<td><input type="text" class="checkbox" name="IsUsed" value="1" /></td>';
		$str .= '<td><input type="hidden" name="editid" value="">
						<input name="add" type="submit" class="button" value="增加"/></td>';
		$str .= '</tr>';
		$str .= '</form>';
		$where = array(array('=','t_Type','0'));
		$order = array('t_IsUsed'=>'DESC','t_Order'=>'ASC');
		$sql= $zbp->db->sql->Select($mizhe_Table,'*',$where,$order,null,null);
		$array=$zbp->GetListCustom($mizhe_Table,$mizhe_DataInfo,$sql);
		$i =1;
		foreach ($array as $key => $reg) {
			$str .= '<form action="save.php?type=flash" method="post" name="flash">';
			$str .= '<tr>';
			$str .= '<td align="center">'.$i.'</td>';
			$str .= '<td><input type="text" class="sedit" name="title" value="'.$reg->Title.'" ></td>';
			$str .= '<td><input type="text" class="sedit" name="img" value="'.$reg->Img.'" ></td>';
			$str .= '<td><input type="text" class="sedit" name="url" value="'.$reg->Url.'" ></td>';
			$str .= '<td><input type="text" class="sedit" name="order" value="'.$reg->Order.'" style="width:40px"></td>';
			$str .= '<td><input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></td>';
			$str .= '<td nowrap="nowrap">
						<input type="hidden" name="editid" value="'.$reg->ID.'">
						<input name="edit" type="submit" class="button" value="修改"/>
						<input name="del" type="button" class="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=flashdel&id='.$reg->ID.'\'}"/>
					</td>';
			$str .= '</tr>';
			$str .= '</form>';
			$i++;
		}
		$str .='</table>';
		$str .='<p style="font-size:12px; color:#999;">*提示：如果不需要幻灯功能，请将以上幻灯“显示”栏全部设置为“OFF”或全部删除，首页则自动隐藏幻灯模块。</p>';
		echo $str;
	};
	?>
 <br />
	</div>
</div>
<script type="text/javascript">ActiveTopMenu("topmenu_mizhe");</script>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/theme/mizhe/screenshot.png';?>");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>