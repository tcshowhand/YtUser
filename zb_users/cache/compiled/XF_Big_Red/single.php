
<?php  include $this->GetTemplate('header');  ?>
	<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
		<?php  include $this->GetTemplate('post-single');  ?>
	<?php }else{  ?>
		<?php  include $this->GetTemplate('post-page');  ?>
	<?php } ?>
	</div>
</div>
<div class="right">
	<?php  include $this->GetTemplate('sidebar2');  ?>
</div>
</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>