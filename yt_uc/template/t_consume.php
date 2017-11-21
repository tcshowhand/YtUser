{* Template Name: 消费日志*}
{template:t_header}

消费日志
<br>
ID--标题--日期
<br>
{foreach $articles as $key=>$article}
{$key+1}
{$article.Title}
{$article.Time('Y年m月d日 h:i:s')}
<br>
{/foreach}

{template:t_pagebar}

{template:t_footer}
