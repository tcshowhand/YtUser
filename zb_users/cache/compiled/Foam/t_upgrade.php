<?php  include $this->GetTemplate('header');  ?>
<body class="single <?php  echo $type;  ?>">
	<div class="wrapper">
		<div class="box">
			<?php  include $this->GetTemplate('navbar');  ?>
			<div class="main">

<div class="post">
	<div class="postblock">
		<h3 class="posttitle"><?php  echo $article->Title;  ?></h3>
		<div class="postintro">
用户级别：<?php  echo $lang['user_level_name'][$user->Level];  ?><br>
<?php if ($user->Level < 5) { ?>
到期时间:<?php  echo $user->Vipendtime;  ?><br>
<?php } ?>
页面介绍：<?php  echo $zbp->Config('YtUser')->readme_text;  ?><br>
(*)充值卡：<input required="required" type="text" name="invitecode" /><br>
(*)验证码：<input required="required" type="text" name="verifycode"  /><?php  echo $article->verifycode;  ?>
<input type="submit" value="提交" onclick="return RegPage()" />
			
		</div>
	</div>
</div>

			</div>
<?php  include $this->GetTemplate('footer');  ?>