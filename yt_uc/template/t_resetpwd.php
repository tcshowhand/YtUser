{* Template Name: 找回密码*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}

找回密码     记起来啦？<a href="{$host}{$zbp->Config('YtUser')->YtUser_Login}">去登录</a>

用户名：<input type="text" id="edtname" name="name">
邮箱：<input type="email" id="edtemail" name="email">
<input type="text" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}
<button type="button" onclick="return resetpwd();">提交</button>
*提交后记得去查看邮件

{template:t_footer}