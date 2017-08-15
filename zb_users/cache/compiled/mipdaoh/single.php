<?php  include $this->GetTemplate('header');  ?>
</head>
<body class="page page-id-5013 page-template page-template-pagesnav-php">
<div class="pageheader">
	<div class="container">
		<div class="note"><?php  echo $name;  ?></div>
	</div>
</div>
<section class="container" id="navs">	 
	<nav><?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?></nav>	
	<div class="items">
<div class="item item-0">
<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
<?php  include $this->GetTemplate('post-single');  ?>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-page');  ?>
<?php } ?>
</div>
</div>
</section>
<?php  include $this->GetTemplate('footer');  ?>