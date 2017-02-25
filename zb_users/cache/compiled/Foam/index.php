<?php  include $this->GetTemplate('header');  ?>
<body class="multi <?php  echo $type;  ?>">
	<div class="wrapper">
		<div class="box">
			<?php  include $this->GetTemplate('navbar');  ?>
			<div class="main">

                <input type="submit" value="签到" onclick="return Ytbuypay()"/>

<?php  foreach ( $articles as $article) { ?>

<?php if ($article->IsTop) { ?>
<?php  include $this->GetTemplate('post-istop');  ?>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-multi');  ?>
<?php } ?>

<?php }   ?>

				<div class="pagebar"><?php  include $this->GetTemplate('pagebar');  ?></div>
			</div>
			<div class="clear"></div>
<?php  include $this->GetTemplate('footer');  ?>