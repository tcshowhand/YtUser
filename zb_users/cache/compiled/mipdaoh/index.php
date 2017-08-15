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
<?php $flids = explode(',','1,2,3,4,5,6,7'); ?>
<?php  foreach ( $flids as $flid) { ?>
<div class="item item-0">
<?php  foreach ( GetList(1,$flid) as $article) { ?>
<h2><a href="<?php  echo $article->Category->Url;  ?>" target="_blank" title="<?php  echo $article->Category->Name;  ?>"><?php  echo $article->Category->Name;  ?></a></h2>
<?php }   ?>
<ul class="xoxo blogroll">
<?php  foreach ( GetList(10,$flid) as $key=>$article) { ?>	
<li><a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>" target="_blank"><?php  echo $article->Title;  ?></a><br><?php  echo $article->Metas->itbulu_info;  ?></li>
<?php }   ?>
</ul>
</div>
<?php }   ?>
</div>
</section>
<?php  include $this->GetTemplate('footer');  ?>