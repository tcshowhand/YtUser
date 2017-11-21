{* Template Name: 文章列表*}
{template:t_header}

{foreach $articles as $article}
{$article.Time()}、{$article.Url}、{$article.Title}、{$article.Intro}、{$article.Author.StaticName}、{$article.Category.Name}、{$article.ViewNums}、{$article.CommNums}
{/foreach}

{template:t_pagebar}