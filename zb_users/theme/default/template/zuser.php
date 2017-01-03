{* Template Name:文章页单页 *}
{template:header}
<body class="single {$type}">
<div id="divAll">
	<div id="divPage">
	<div id="divMiddle">
		<div id="divTop">
			<h1 id="BlogTitle"><a href="{$host}">{$name}</a></h1>
			<h3 id="BlogSubTitle">{$subname}</h3>
		</div>
		<div id="divNavBar">
<ul>
{$modules['navbar'].Content}
</ul>
		</div>
		<div id="divMain">


<div class="post page">
	<h2 class="post-title">{$article.Title}</h2>
222
</div>


		</div>
		<div id="divSidebar">
{template:sidebar}
		</div>
{template:footer}