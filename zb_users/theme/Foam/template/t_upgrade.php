{template:header}
<body class="single {$type}">
	<div class="wrapper">
		<div class="box">
			{template:navbar}
			<div class="main">

<div class="post">
	<div class="postblock">
		<h3 class="posttitle">{$article.Title}</h3>
		<div class="postintro">
用户级别：{$lang['user_level_name'][$user.Level]}<br>
{if $user.Level < 5}
到期时间:{$user.Vipendtime}<br>
{/if}
页面介绍：{$zbp.Config('YtUser').readme_text}<br>
(*)充值卡：<input required="required" type="text" name="invitecode" /><br>
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}
<input type="submit" value="提交" onclick="return RegPage()" />
			
		</div>
	</div>
</div>

			</div>
{template:footer}