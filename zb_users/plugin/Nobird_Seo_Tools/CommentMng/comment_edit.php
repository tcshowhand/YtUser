<?php
/**
 * Z-Blog with PHP
 * @author
 * @copyright (C) RainbowSoft Studio
 * @version 2.0 2013-07-05
 */

require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';


$zbp->CheckGzip();
$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6,__FILE__,__LINE__);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='评论编辑 - 评论SEO管理';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<?php

$cmtid=null;
if(isset($_GET['id'])){$cmtid = (integer)GetVars('id','GET');}else{$cmtid = 0;}
$cmt=$zbp->GetCommentByID($cmtid);



if (isset($_POST['name']) && $_POST['name'] != '') {
	$cmt = $zbp->GetCommentByID($_POST['ID']);
	$cmt->Name = $_POST['name'];
	$cmt->Email = $_POST['email'];
	$cmt->HomePage = $_POST['homepage'];
	$cmt->Content = $_POST['content'];
	FilterComment($cmt);
  $cmt->Save();
			foreach ($GLOBALS['hooks']['Filter_Plugin_PostComment_Succeed'] as $fpname => &$fpsignal){
				$fpname($cmt);
				}
	$zbp->SetHint('good');
	Redirect('./commentmng.php');
}




?>

<div id="divMain">
  <div class="divHeader2"><?php echo $blogtitle?></div>
  <div class="SubMenu"></div>
  <div id="divMain2" class="edit cmt_edit">
	<form id="edit" name="edit" method="post" action="#">
	  <input id="edtID" name="ID" type="hidden" value="<?php echo $cmt->ID;?>" />
	  <p>
		<span class="title">名称:</span><span class="star">(*)</span><br />
		<input <?php if($cmt->Author->ID>0){echo 'readonly="readonly"';}?> id="name" class="edit" size="40" name="name" maxlength="50" type="text" value="<?php echo $cmt->Author->Name;?>" />
	  </p>
	  <p>
		<span class="title">邮箱:</span><br />
		<input id="email" class="edit" size="40" name="email" type="text" value="<?php echo $cmt->Author->Email;?>" />
	  </p>
	  <p>
		<span class="title">网址:</span><br />
		<input id="homepage" class="edit" size="40" name="homepage" type="text" value="<?php echo $cmt->Author->HomePage;?>" />
	  </p>
<p>
		<span class="title">评论内容:</span><br>
		<textarea style="width:98%;" id="content" type="text" name="content"><?php echo $cmt->Content;?></textarea>
	  </p>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" id="btnPost" onclick="return checkInfo();" />
	  </p>
	</form>
	<script type="text/javascript">
function checkInfo(){
  if(!$("#name").val()){
    alert("<?php echo $lang['error']['72']?>");
    return false
  }
}
	</script>
	<script type="text/javascript">ActiveLeftMenu("acmtMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $zbp->host . 'zb_system/image/common/comments_32.png';?>");</script>
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>