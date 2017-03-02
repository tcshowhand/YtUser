<?php  /* Template Name:连接页面 */  ?>

<?php  $link_name = $modules['link']->Name;  ?>
<?php  $link_content = $modules['link']->Content;  ?>
<?php  $misc_name = $modules['misc']->Name;  ?>
<?php  $misc_content = $modules['misc']->Content;  ?>
<?php 
$pagefix = '<ul class="plinksa">
	<li id="linkcat-1" class="linkcat"><h2>'.$link_name.'</h2>
		<ul>
		'.$link_content.'
		</ul>
	</li>
	<li id="linkcat-2" class="linkcat"><h2>'.$misc_name.'</h2>
		<ul>
		'.$misc_content.'
		</ul>
	</li>
</ul>';
 ?>
<?php  include $this->GetTemplate('single');  ?>