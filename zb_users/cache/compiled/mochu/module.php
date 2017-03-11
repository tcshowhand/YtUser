<aside class="celanbiao" id="<?php  echo $module->HtmlID;  ?>">
<?php if ((!$module->IsHideTitle)&&($module->Name)) { ?><h3><i class="fa fa-bars"></i><?php  echo $module->Name;  ?></h3><?php }else{  ?><h3 style="display:none;"></h3><?php } ?>
<div class="aside-con"><?php if ($module->Type=='div') { ?><div><?php  echo $module->Content;  ?><div class="clear"></div></div><?php } ?><?php if ($module->Type=='ul') { ?>
<ul><?php  echo $module->Content;  ?><div class="clear"></div></ul><?php } ?>
</div></aside>