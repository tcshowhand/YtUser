{template:header}
</head>
<body class="page page-id-5013 page-template page-template-pagesnav-php">
<div class="pageheader">
	<div class="container">
		<div class="note">{$name}</div>
	</div>
</div>
<section class="container" id="navs">	 
	<nav>{module:navbar}</nav>	
	<div class="items">
<div class="item item-0">
<h2>{$category.Name}</h2>
<ul class="xoxo blogroll">
{foreach $articles as $article}
{template:post-multi}
{/foreach}
</ul>
</div>
</div>
</section>
{template:footer}