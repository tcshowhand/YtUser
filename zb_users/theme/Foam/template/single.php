{template:header}
<body class="single {$type}">
	<div class="wrapper">
		<div class="box">
			{template:navbar}
			<div class="main">
{if $article.Type==ZC_POST_TYPE_ARTICLE}
{template:post-single}
{else}
{template:post-page}
{/if}
			</div>
{template:footer}