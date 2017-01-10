<?php  /* Template Name:用户中心 */  ?>
<?php  include $this->GetTemplate('header');  ?>
<body class="single <?php  echo $type;  ?>">
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="<?php  echo $host;  ?>"><?php  echo $name;  ?></a></h1>
			<h3 id="BlogSubTitle"><?php  echo $subname;  ?></h3>
		</div>
		<div id="divNavBar">
<ul>
<?php  echo $modules['navbar']->Content;  ?>
</ul>
		</div>
		<div id="divMain">


<div class="post page">
	<h2 class="post-title"><?php  echo $article->Title;  ?></h2>
222
</div>


		</div>
		<div id="divSidebar">
<?php  include $this->GetTemplate('sidebar');  ?>
		</div>
<?php  include $this->GetTemplate('footer');  ?>