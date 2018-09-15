{* Template Name:dm_uc 分页*}
{if $pagebar}
{foreach $pagebar.buttons as $k=>$v}
{if $pagebar.PageNow==$k}
<span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{$k}</em></span>
{else}
<a href="{$v}" data-page="{$k}">{$k}</a>
{/if}
{/foreach}
<span class="layui-laypage-last"><em class="layui-laypage-em"></em><em>总计{$pagebar.PageAll}页</em></span>
{/if}


