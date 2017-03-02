<?php
require '../../../zb_system/function/c_system_base.php';

$zbp->CheckGzip();
$zbp->Load();
if ($zbp->CheckRights('admin')) {
    Redirect('cmd.php?act=admin');
}
if (!$zbp->Config('dmam')->new_login) {
    Redirect('../../../zb_system/cmd.php?act=login');
    die();
}

?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title><?php echo $blogname . '-' . $lang['msg']['login'] ?></title>
<?php if (strpos(GetVars('HTTP_USER_AGENT', 'SERVER'), 'Trident/')) {?>
	<meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<?php }?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  	<meta name="robots" content="none" />
	<meta name="generator" content="<?php echo $option['ZC_BLOG_PRODUCT_FULL']?>" />
  <link rel="alternate icon" type="image/png" href="<?php echo $zbp->host ; ?>favicon.png">
  <link rel="stylesheet" href="style/amaze/css/amazeui.css"/>
  <script src="../../../zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
  	<script src="../../../zb_system/script/common.js" type="text/javascript"></script>
	<script src="../../../zb_system/script/md5.js" type="text/javascript"></script>
	<script src="../../../zb_system/script/c_admin_js_add.php" type="text/javascript"></script>
	<?php
foreach ($GLOBALS['Filter_Plugin_Login_Header'] as $fpname => &$fpsignal) {$fpname();}
?>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>
<div class="header">
  <div class="am-g">
    <h1><?php echo htmlspecialchars($blogname) ?></h1>
    <p><?php echo $zbp->subname; ?></p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>登录</h3>
    <hr>
    
	<?php if ($zbp->CheckPlugin('HaloQQ')) echo '<div class="am-btn-group"><a href="'.$zbp->host.'zb_users/plugin/HaloQQ/qqcmd.php" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-qq am-icon-sm"></i> QQ</a><!-- <a href="#" class="am-btn am-btn-warning am-btn-sm"><i class="am-icon-weibo am-icon-sm"></i> 微博</a>
      <a href="#" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-wechat am-icon-sm"></i> 微信</a> -->
    </div>';?>
	

		
    <br>
    <br>

    <form method="post" class="am-form">
      <label for="email"><?php echo $lang['msg']['username'] ?>:</label>
      <input type="email" name="edtUserName" id="email" value="<?php echo GetVars('username', 'COOKIE') ?>">
      <br>
      <label for="password"><?php echo $lang['msg']['password'] ?>:</label>
      <input type="password" name="edtPassWord" id="password" value="">
      <br>
      <label for="remember-me">
        <input id="remember-me" name="chkRemember" type="checkbox">
        <?php echo $lang['msg']['stay_signed_in'] ?>
      </label>
      <br />
      <div class="am-cf">
        <input id="btnPost" type="submit" name="btnPost" value="<?php echo $lang['msg']['login'] ?>" class="am-btn am-btn-primary am-btn-sm am-fl">
        <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
		
	<input type="hidden" name="username" id="username" value="" />
	<input type="hidden" name="password" id="password" value="" />
	<input type="hidden" name="savedate" id="savedate" value="0" />
	<input type="hidden" name="dishtml5" id="dishtml5" value="0" />
      </div>
    </form>
    <hr>
<p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo $zbp->name; ?><br/>Powered By <a href="http://www.zblogcn.com/" title="RainbowSoft Z-BlogPHP" target="_blank">Z-BlogPHP</a></p>
  </div>
</div>
<script type="text/javascript">
$("#btnPost").click(function(){
	var strUserName=$("#email").val();
	var strPassWord=$("#password").val();
	var strSaveDate=$("#remember-me").val()

	if((strUserName=="")||(strPassWord=="")){
        layer.msg('<?php echo $lang['error']['66']; ?>', function(){});
		return false;
	}

	$("#email").remove();
	$("#password").remove();

	$("form").attr("action","../../../zb_system/cmd.php?act=verify");
	$("#username").val(strUserName);
	$("#password").val(MD5(strPassWord));
	$("#savedate").val(strSaveDate);
})

$("#chkRemember").click(function(){
	$("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
})

if (!$.support.leadingWhitespace) {
	$("#dishtml5").val(1);<?php
if ($option['ZC_ADMIN_HTML5_ENABLE']) {
    echo 'alert("' . $lang['error']['74'] . '");';
}

?>
}
</script>
</body>
</html>
<?php
RunTime();
?>