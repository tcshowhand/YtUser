{template:header}
<body class="multi {$type}">
	<div class="wrapper">
		<div class="box">
			{template:navbar}
			<div class="main">
{foreach $articles as $article}

{if $article.IsTop}
{template:post-istop}
{else}
{template:post-multi}
{/if}

{/foreach}
				
				<div class="pagebar">{template:pagebar}</div>
			</div>
			<div class="clear"></div>
{template:footer}