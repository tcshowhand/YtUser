
<?php  include $this->GetTemplate('header');  ?>
		<?php  foreach ( $articles as $article) { ?>
			<?php if ($article->IsTop) { ?>
				<?php  include $this->GetTemplate('post-istop');  ?>
			<?php }else{  ?>
				<?php  include $this->GetTemplate('post-multi');  ?>
			<?php } ?>
		<?php }   ?>
		</div>
		<div id="pagebar"><ul class="pagebar-list"><?php  include $this->GetTemplate('pagebar');  ?><ul></div>
	</div>
	<div class="right">
		<?php  include $this->GetTemplate('sidebar');  ?>
	</div>
</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>