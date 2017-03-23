
<?php if ((!$module->IsHideTitle)&&($module->Name)) { ?>
    <div class="ap <?php  echo $module->HtmlID;  ?>">
        <div class="apt" style="height: 26px;">
            <p class="entit"><span><?php  echo $module->Name;  ?></span></p>
        </div>
        <div class="apc">
            <ul class="ulist">
				<?php  echo $module->Content;  ?>
            </ul>
        </div>
    </div>
<?php }else{  ?>
	<?php  echo $module->Content;  ?>
<?php } ?>