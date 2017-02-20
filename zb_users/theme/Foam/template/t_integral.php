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

用户积分:{$user.Price}
充值介绍：{$zbp.Config('YtUser').integral_text}
(*)充值卡：<input required="required" type="text" name="invitecode"  />
(*)验证码：<input required="required" type="text" name="verifycode"  />{$article.verifycode}


			
		</div>
	</div>
</div>

			</div>
{template:footer}