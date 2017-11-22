{* Template Name: 消费日志*}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
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
