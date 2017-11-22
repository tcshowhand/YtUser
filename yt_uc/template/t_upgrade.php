{* Template Name: VIP卡充值*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
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