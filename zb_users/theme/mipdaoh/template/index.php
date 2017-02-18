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
{php}$flids = explode(',','1,2,3,4,5,6,7');{/php}
{foreach $flids as $flid}
<div class="item item-0">
{foreach GetList(1,$flid) as $article}
<h2><a href="{$article.Category.Url}" target="_blank" title="{$article.Category.Name}">{$article.Category.Name}</a></h2>
{/foreach}
<ul class="xoxo blogroll">
{foreach GetList(10,$flid) as $key=>$article}	
<li><a href="{$article.Url}" title="{$article.Title}" target="_blank">{$article.Title}</a><br>{$article.Metas.itbulu_info}</li>
{/foreach}
</ul>
</div>
{/foreach}
</div>
</section>
{template:footer}