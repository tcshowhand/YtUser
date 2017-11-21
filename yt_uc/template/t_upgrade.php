{* Template Name: VIP卡充值*}
{template:t_header}
VIP卡充值<br>
用户级别：{$lang['user_level_name'][$user.Level]}<br>
{if $user.Level < 5}
到期时间:{$user.Vipendtime}<br>
{/if}
页面介绍：{$zbp.Config('YtUser').readme_text}<br>
(*)充值卡：<input required="required" type="text" name="invitecode" /><br>
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}<br>
<input type="submit" value="提交" onclick="return RegPage()" />
{template:t_footer}