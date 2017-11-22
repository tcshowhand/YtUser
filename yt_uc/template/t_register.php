{* Template Name: 账号注册*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
注册新账户----已有账户？<a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}">去登陆</a>
<BR>
(*)名称：<input required="required" type="text" name="name"><BR>
(*)密码：<input required="required" type="password" name="password"><BR>
(*)确认密码：<input required="required" type="password" name="repassword"><BR>
<BR>
(*)验证码<input required="required" type="text" name="verifycode" >{$article.verifycode}<BR><BR>
<input type="submit" value="提交" onclick="return register()"><BR>
一键注册：<a href="{$host}zb_users/plugin/YtUser/login.php" class="">QQ注册</a>
{template:t_footer}
