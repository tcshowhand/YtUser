{* Template Name: 用户登录*}
{template:t_header}

登录{$user.Name}
<input type="text" id="edtUserName" name="edtUserName" placeholder="Username">
<input type="password" id="edtPassWord" name="edtPassWord" placeholder="Password">
<input type="checkbox" id="chkRemember" name="chkRemember" >Remember me
<button type="submit" id="loginbtnPost" name="loginbtnPost" onclick="return Ytuser_Login()">Login</button>
使用快捷登录：<a href="{$host}zb_users/plugin/YtUser/login.php" class="">QQ登录</a>

{template:t_footer}