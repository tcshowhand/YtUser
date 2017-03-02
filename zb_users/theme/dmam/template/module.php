{* Template Name:单个模块 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
<dl class="function" id="{$module.HtmlID}">
{if (!$module.IsHideTitle)&&($module.Name)}<dt class="function_t">{$module.Name}</dt>{else}<dt style="display:none;"></dt>{/if}
<dd class="function_c">

{if $module.Type=='div'}
<div>{$module.Content}</div>
{/if}

{if $module.Type=='ul'}
<ul>{$module.Content}</ul>
{/if}

</dd>
</dl>