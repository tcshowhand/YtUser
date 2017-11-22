{* Template Name: 分页*}
{if $pagebar}
{foreach $pagebar.buttons as $k=>$v}
{if $pagebar.PageNow==$k}
<li class="active"><span>{$k}</span></li>
{else}
<li><a href="{$v}">{$k}</a></li>
{/if}
{/foreach}
<li><span>总计{$pagebar.PageAll}页</span></li>
{/if}