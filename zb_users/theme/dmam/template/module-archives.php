{* Template Name:文章归档模块 *}
<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;"><h2 style="font-size:60px;margin-bottom:32px;">打开这个网页的是傻逼</h2>吼吼!</div>';die();?>
<div class="am-form-group am-form-select">
<select onchange="document.location.href=this.options[this.selectedIndex].value;" >
<option value="">选择月份</option>
{foreach $urls as $url}
<option value="{$url.Url}">{$url.Name} ({$url.Count})</option>
{/foreach}
</select>
</div>