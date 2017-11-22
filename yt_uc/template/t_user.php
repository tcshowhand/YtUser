{* Template Name: 个人资料 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{template:t_header}

基本信息
<form role="form" action="#" method="POST" id="signup-form">
<input id="edtID" name="ID" type="hidden" value="{$user.ID}" />
<input id="edtGuid" name="Guid" type="hidden" value="{$user.Guid}" />
(*)账户：{$user.Name}
{if (substr($user.Name,0,3) == 'yt_')}
<a href="'.$zbp->host.'?Nameedit">修改账户名（仅一次机会）</a>
{/if}
用户级别:{if $user.Level < 4}VIP会员{else}普通会员{/if}
<a href="{$host}?Upgrade">{if $user.Level < 4}续费{else}购买{/if}会员</a>
到期时间:{$user.Vipendtime}
用户积分:{$user.Price}<a href="{$zbp->host}?Integral">购买积分</a>
用户名：<input required="required" type="text" id="edtAlias" name="Alias" value="{$user.StaticName}" />
电话：<input required="required" type="text" id="meta_Tel" name="meta_Tel" value="{$user.Metas.Tel}" />
会员地址：<input required="required" type="text" id="meta_Add" name="meta_Add" value="{$user.Metas.Add}" />
邮箱：<input type="text" id="edtEmail" name="Email" value="{$user.Email}" />
网站：<input type="text" id="edtHomePage" name="HomePage" value="{$user.HomePage}" />
摘要：<textarea id="edtIntro" name="Intro" >{$user.Intro}</textarea>
验证码：<input required="required" type="text" name="verifycode" />{$article.verifycode}
<button onclick="return checkInfo();">确定</button>
</form>
{template:t_footer}
