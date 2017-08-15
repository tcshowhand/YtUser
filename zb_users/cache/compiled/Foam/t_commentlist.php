<?php  include $this->GetTemplate('header');  ?>
<body class="multi <?php  echo $type;  ?>">
	<div class="wrapper">
		<div class="box">
			<?php  include $this->GetTemplate('navbar');  ?>
			<div class="main">
<?php  foreach ( $articles as $article) { ?>
<div class="post">
	<div class="postblock">
留言的文章：<?php  echo $article->Title;  ?>
留言的链接：<?php  echo $article->Url;  ?>
留言内容：<?php  echo $article->Intro;  ?>
留言发布时间：<?php  echo $article->Time('Y年m月d日 h:i:s');  ?>
<?php }   ?>
分页：<?php  include $this->GetTemplate('pagebar');  ?>
			</div>
			<div class="clear"></div>
<?php  include $this->GetTemplate('footer');  ?>