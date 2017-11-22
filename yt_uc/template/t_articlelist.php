{* Template Name: 文章列表*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}

{foreach $articles as $article}
{$article.Time()}、{$article.Url}、{$article.Title}、{$article.Intro}、{$article.Author.StaticName}、{$article.Category.Name}、{$article.ViewNums}、{$article.CommNums}
{/foreach}

{template:t_pagebar}