<?php  include $this->GetTemplate('header');  ?>
<body class="single <?php  echo $type;  ?>">
	<div class="wrapper">
		<div class="box">
			<?php  include $this->GetTemplate('navbar');  ?>
			<div class="main">
<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
<?php  include $this->GetTemplate('post-single');  ?>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-page');  ?>
<?php } ?>
			</div>
<?php  include $this->GetTemplate('footer');  ?>