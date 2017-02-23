{template:header}
<body class="multi {$type}">
	<div class="wrapper">
		<div class="box">
			{template:navbar}
			<div class="main">
{foreach $articles as $article}
<div class="post">
	<div class="postblock">
留言的文章：{$article.Title}
留言的链接：{$article.Url}
留言内容：{$article.Intro}
留言发布时间：{$article.Time('Y年m月d日 h:i:s')}
{/foreach}
分页：{template:pagebar}
			</div>
			<div class="clear"></div>
{template:footer}