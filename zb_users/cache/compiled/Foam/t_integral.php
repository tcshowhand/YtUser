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

用户积分:<?php  echo $user->Price;  ?>
充值介绍：<?php  echo $zbp->Config('YtUser')->integral_text;  ?>
(*)充值卡：<input required="required" type="text" name="invitecode"  />
(*)验证码：<input required="required" type="text" name="verifycode"  /><?php  echo $article->verifycode;  ?>


			
		</div>
	</div>
</div>

			</div>
<?php  include $this->GetTemplate('footer');  ?>