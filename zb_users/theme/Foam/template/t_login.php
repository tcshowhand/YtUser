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
登录{$user.Name}
<input type="text" id="edtUserName" name="edtUserName" placeholder="Username">
<input type="password" id="edtPassWord" name="edtPassWord" placeholder="Password">
<input type="checkbox" id="chkRemember" name="chkRemember" >Remember me
<button type="submit" id="loginbtnPost" name="loginbtnPost" onclick="return Ytuser_Login()">Login</button>
第三方登录：<div class="ds-login"></div>

		</div>
	</div>
</div>

			</div>
{template:footer}