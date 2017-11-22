{* Template Name: 我的评论*}
{template:t_header}
我的评论
<br>
ID---评论内容---评论文章---评论日期
<br>
{foreach $articles as $key=>$article}
{$article.ID}
{$article.Intro}
{$article.Title}
{$article.Time('Y年m月d日 h:i:s')}
<br>
{/foreach}

{template:t_pagebar}

{template:t_footer}
