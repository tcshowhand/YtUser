<?php  /* Template Name:标签云页面 */  ?>

<?php 
$pagefix = '<ul class="tagslist">'.dmam_pages('tags').'</ul>';
 ?>
<?php  include $this->GetTemplate('single');  ?>