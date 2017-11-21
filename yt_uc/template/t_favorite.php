{* Template Name: 我的收藏*}
{template:t_header}

我的收藏
<br>			
ID--文章标题--分类--收藏日期--操作
<br>
{foreach $articles as $key=>$article}
{$article.Pid}--<a target="_blank" href="{$article.Url}">{$article.Title}</a>
<a target="_blank" href="{$article.Category.Url}">{$article.Category.Name}</a>
{$article.Time('Y年m月d日')}
<a type="button" onclick="return window.confirm('单击“确定”继续。单击“取消”停止。');" href="javascript:YtFavorite('del',{$article.Pid},$('#myfav-{$article.Pid}'));">删除</a>
<br>
{/foreach}

{template:t_pagebar}

{template:t_footer}
