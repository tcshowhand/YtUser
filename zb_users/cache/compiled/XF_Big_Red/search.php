
<?php  include $this->GetTemplate('header');  ?>
	<div class="search_title"><?php  echo $title;  ?><?php  echo $XF_Big_RedSearchSubtitle;  ?></div>
	<?php  foreach ( $articles as $article) { ?><?php  include $this->GetTemplate('post-search');  ?><?php }   ?>
	</div>
	<div id="pagebar"><ul class="pagebar-list"><?php  include $this->GetTemplate('pagebar');  ?><ul></div>
</div>
<div class="right">
	<?php  include $this->GetTemplate('sidebar');  ?>
</div>
</div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
