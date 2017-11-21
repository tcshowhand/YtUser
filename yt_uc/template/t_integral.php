{* Template Name: 积分充值*}
{template:t_header}
用户积分:{$user.Price}<br>
充值介绍：{$zbp.Config('YtUser').integral_text}<br>
(*)充值卡：<input required="required" type="text" name="invitecode"  /><br>
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}<br>
<input type="submit" value="提交" onclick="return Integral()"><br>
{template:t_footer}
