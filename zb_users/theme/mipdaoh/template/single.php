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
{if $article.Type==ZC_POST_TYPE_ARTICLE}
{template:post-single}
{else}
{template:post-page}
{/if}
</div>
</div>
</section>
{template:footer}