{* Template Name:修改帐户名 *}
{template:t_header}
修改帐户名

原用户名：<input type="text" id="edtaccount" placeholder="{$user.Name}" disabled>
<input type="hidden" name="token" id="token" value="{$zbp->GetToken()}" />
修改账户：<input type="password" id="edtname" name="name" placeholder="修改账户">
确认账户：<input type="password" id="edtrename" name="rename" placeholder="确认账户">
<input type="text" class="form-control user_input" id="edtverifycode" name="verifycode" placeholder="验证码">{$article.verifycode}
<button type="button" class="btn btn-block" onclick="return Nameedit();">提交</button>

{template:t_footer}