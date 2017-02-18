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
<h2><?php  echo $category->Name;  ?></h2>
<ul class="xoxo blogroll">
<?php  foreach ( $articles as $article) { ?>
<?php  include $this->GetTemplate('post-multi');  ?>
<?php }   ?>
</ul>
</div>
</div>
</section>
<?php  include $this->GetTemplate('footer');  ?>