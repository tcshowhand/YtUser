<?php  /* Template Name:分页导航 */  ?>

	<?php if ($pagebar) { ?>
	<?php if ($zbp->Config('dmam')->pagenav_style) { ?>
	<nav<?php if ($type) { ?> class="nav-<?php  echo $type;  ?>"<?php } ?>>
	<ul class="dm-pagination am-pagination">
		<?php  foreach ( $pagebar->buttons as $k=>$v) { ?>
			<?php if ($k == '‹') { ?>
			<li class="am-pagination-prev prev-page"><a href="<?php  echo $v;  ?>"><?php  echo $k;  ?></a></li>
			<?php }elseif($k == '›') {  ?>
			<li class="am-pagination-next next-page"><a href="<?php  echo $v;  ?>"><?php  echo $k;  ?></a></li>
			<?php }else{  ?>

			<?php } ?>
		<?php }   ?>
	</ul>
	</nav>
	<?php }else{  ?>
	<nav<?php if ($type) { ?> class="nav-<?php  echo $type;  ?>"<?php } ?>>
	<ul class="dm-pagination am-pagination am-pagination-centered">
		<?php  foreach ( $pagebar->buttons as $k=>$v) { ?>
		<?php if ($pagebar->PageNow==$k) { ?>
		<li class="am-active"><span><?php  echo $k;  ?></span></li>
		<?php }else{  ?>
			<?php if ($k == '‹') { ?>
			<li class="prev-page">
			<?php }elseif($k == '›') {  ?>
			<li class="next-page">
			<?php }else{  ?>
			<li>
			<?php } ?>
			<a href="<?php  echo $v;  ?>"><?php  echo $k;  ?></a>
			</li>
		<?php } ?>
		<?php }   ?>
		<li><span>总计<?php  echo $pagebar->PageAll;  ?>页</span></li>
	</ul>
	</nav>
	<?php } ?>
	<?php } ?>
