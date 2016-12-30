{* Template Name:文章页单页 *}
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title>{$name}-{$title}</title>
	<link href="{$host}zb_users/theme/{$theme}/style/base.css" rel="stylesheet" type="text/css"/>
	<link href="{$host}zb_users/theme/{$theme}/style/home.css" rel="stylesheet" type="text/css"/>
	<script src="{$host}zb_system/script/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="{$host}zb_system/script/zblogphp.js" type="text/javascript"></script>
	<script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
	<script type="text/javascript" src="{$host}zb_users/theme/{$theme}/script/jquery.cookie.js"></script>
	<script type="text/javascript" src="http://www.xiuren.com/scripts/global.js"></script>
	<script type="text/javascript" src="http://www.xiuren.com/scripts/poster.js"></script>
	<script type="text/javascript" src="http://www.xiuren.com/scripts/artDialog/jquery.artDialog.js?skin=idialog"></script>
	<script type="text/javascript">
		try{document.execCommand("BackgroundImageCache", false, true);}catch(e){}
	</script>
	{$header}
	<script src="{$host}zb_system/script/common.js" type="text/javascript"></script>
<script src="{$host}zb_system/script/md5.js" type="text/javascript"></script>
<script src="{$host}zb_system/script/c_admin_js_add.php" type="text/javascript"></script>
</head>
	<style type="text/css">
		body { background-image:url("http://xiuren.com/skin/suit/12/background.png");background-repeat:repeat;background-color:rgb(33, 27, 37);}
		.topWrap{background:url("http://xiuren.com/skin/suit/12/skin.jpg") center top no-repeat scroll;}
		.home-profile-pic {background:url("http://xiuren.com/skin/suit/12/cover.jpg") center top repeat;}
		.home-profile {background:fff;}
	</style>
<body class="fix">
	<div class="topWrap fix">

	<div class="wrap fix">

		<div class="home-body fix">
			<div class="home-nav yh"></div>

	    	<div class="home-wrap">
	    		<div class="home-content">
	    			<div class="home-albumPage feedList">
						<h1 class="lh30 fix yh f24 fb mb10" nodetype="projectTitle">{$article.Title}</h1>
						<div class="home-albumPageBig fix mt10">
							
							
<div class="index-logina opacity70W grey lh30">



    <form method="post" action="#">
        <div class="f14 pl10">用户登录</div>
		<div class="mt20 pl10" id="inputbox">
			<p>
				<input type="text" class="inputTxt inputTxtH30" id="edtUserName" name="edtUserName" size="20" value="{php} echo GetVars('username', 'COOKIE') {/php}" tabindex="1" />
			</p>
			<p class="pt10">
				<input type="password" class="inputTxt inputTxtH30" id="edtPassWord" name="edtPassWord" size="20" tabindex="2" />
			</p>
		</div>
		<div class="fix pt10 pl10">
			<div class="fl">
				<label>
				    <input type="checkbox" name="chkRemember" id="chkRemember"  tabindex="3" />下次自动登录
				</label>
            </div>
            <div class="fr"> <a href="{$host}zb_users/plugin/DF_findpassword" class="blue">忘记密码？</a></div>
		</div>
		<div class="pt10 pl10"><input id="btnPost" name="btnPost" type="submit" value="登录" class="button" tabindex="4"/> 还没有帐号？<a href="{$host}?reg" class="red">立即注册！</a></div>
	<input type="hidden" name="username" id="username" value="" />
	<input type="hidden" name="password" id="password" value="" />
	<input type="hidden" name="savedate" id="savedate" value="0" />
	<input type="hidden" name="dishtml5" id="dishtml5" value="0" />
    </form>

  
  <script type="text/javascript">
$("#btnPost").click(function(){
	var strUserName=$("#edtUserName").val();
	var strPassWord=$("#edtPassWord").val();
	var strSaveDate=$("#savedate").val()
	if((strUserName=="")||(strPassWord=="")){
		alert("用户名和密码不能为空");
		return false;
	}
	$("#edtUserName").remove();
	$("#edtPassWord").remove();
	$("form").attr("action","{$host}zb_users/plugin/YtUser/cmd.php?act=verify");
	$("#username").val(strUserName);
	$("#password").val(MD5(strPassWord));
	$("#savedate").val(strSaveDate);
})

$("#chkRemember").click(function(){
	$("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
})

</script>
