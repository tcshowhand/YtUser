{* Template Name: 账号绑定 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">这里是用户中心模版</h2>哈哈</div>';die();?>
{template:t_header}

{if $article.BindingQQ}
    此账户已绑定过QQ
{else}
    <a target="_blank" href="{$host}zb_users/plugin/YtUser/login.php">绑定QQ</a>
{/if}

{template:t_footer}