{* Template Name:标签云页面 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
{php}
$pagefix = '<ul class="tagslist">'.dmam_pages('tags').'</ul>';
{/php}
{template:single}