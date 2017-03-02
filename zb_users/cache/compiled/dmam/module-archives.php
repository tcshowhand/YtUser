<?php  /* Template Name:文章归档模块 */  ?>

<div class="am-form-group am-form-select">
<select onchange="document.location.href=this.options[this.selectedIndex].value;" >
<option value="">选择月份</option>
<?php  foreach ( $urls as $url) { ?>
<option value="<?php  echo $url->Url;  ?>"><?php  echo $url->Name;  ?> (<?php  echo $url->Count;  ?>)</option>
<?php }   ?>
</select>
</div>