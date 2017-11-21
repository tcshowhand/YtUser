{* Template Name: 账号绑定 *}
{template:t_header}

{if $article.BindingQQ}
    此账户已绑定过QQ
{else}
    <a target="_blank" href="{$host}zb_users/plugin/YtUser/login.php">绑定QQ</a>
{/if}

{template:t_footer}