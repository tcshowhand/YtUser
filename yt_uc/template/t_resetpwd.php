{* Template Name:dm_uc 找回密码*}
{template:t_header}

找回密码     记起来啦？<a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}">去登录</a>

用户名：<input type="text" id="edtname" name="name">
邮箱：<input type="email" id="edtemail" name="email">
<input type="text" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}
<button type="button" onclick="return resetpwd();">提交</button>
*提交后记得去查看邮件

{template:t_footer}