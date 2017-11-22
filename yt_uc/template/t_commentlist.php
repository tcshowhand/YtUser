{* Template Name: 我的评论*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
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
