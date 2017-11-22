{* Template Name: 积分充值*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}
用户积分:{$user.Price}<br>
充值介绍：{$zbp.Config('YtUser').integral_text}<br>
(*)充值卡：<input required="required" type="text" name="invitecode"  /><br>
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}<br>
<input type="submit" value="提交" onclick="return Integral()"><br>
{template:t_footer}
