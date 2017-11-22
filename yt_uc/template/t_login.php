{* Template Name: 用户登录*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}

登录{$user.Name}
<input type="text" id="edtUserName" name="edtUserName" placeholder="Username">
<input type="password" id="edtPassWord" name="edtPassWord" placeholder="Password">
<input type="checkbox" id="chkRemember" name="chkRemember" >Remember me
<button type="submit" id="loginbtnPost" name="loginbtnPost" onclick="return Ytuser_Login()">Login</button>
使用快捷登录：<a href="{$host}zb_users/plugin/YtUser/login.php" class="">QQ登录</a>

{template:t_footer}