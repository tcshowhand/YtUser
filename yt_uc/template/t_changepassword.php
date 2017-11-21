{* Template Name:密码重置 *}
{template:t_header}

修改密码

用户名:<input type="text" id="edtaccount" value="{$user.Name}" disabled>
{if $user.Password != '0e681aa506fc191c5f2fa9be6abddd01'}
    原密码:<input type="password" id="edtpassword" name="password" placeholder="原密码">
{/if}
设置新密码:<input type="password" id="edtnewpassword" name="newpassword" placeholder="设置一个新的密码">
重复新密码:<input type="password" id="edtrepassword" name="repassword" placeholder="确认新密码">
<input type="text" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}</label>
<button type="button" onclick="return Changepassword();">提交</button>

{template:t_footer}