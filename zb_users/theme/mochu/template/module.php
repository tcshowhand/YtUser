<aside class="celanbiao" id="{$module.HtmlID}">
{if (!$module.IsHideTitle)&&($module.Name)}<h3><i class="fa fa-bars"></i>{$module.Name}</h3>{else}<h3 style="display:none;"></h3>{/if}
<div class="aside-con">{if $module.Type=='div'}<div>{$module.Content}<div class="clear"></div></div>{/if}{if $module.Type=='ul'}
<ul>{$module.Content}<div class="clear"></div></ul>{/if}
</div></aside>