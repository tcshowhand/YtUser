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

<input type="hidden" name="LogID" id="LogID" value="<?php  echo $article->BuyID;  ?>" />
<input type="hidden" name="LogUrl" id="LogUrl" value="<?php  echo $article->BuyTUrl;  ?>" />
产品：<?php  echo $article->BuyTitle;  ?>
价格：<?php  echo $article->BuyPrice;  ?>
账户余额：<?php  echo $user->Price;  ?>
<?php if ($article->buynum) { ?>
已购买
<?php }else{  ?>
(*)验证码：<input required="required" type="text" name="verifycode"  /><?php  echo $article->verifycode;  ?>
<input type="submit" style="width:100px;font-size:1.0em;padding:0.2em" value="付款" onclick="return Ytbuypay()" />
<?php } ?>
		</div>
	</div>
</div>

			</div>
<?php  include $this->GetTemplate('footer');  ?>